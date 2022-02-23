<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Action\OrderActions;
use Illuminate\Http\Request;
use App\Models\PaymentRecord;
use App\Jobs\NotifyAdminOrder;
use App\Jobs\SendOrderInvoice;
use App\Services\OrderQueries;
use Illuminate\Support\Facades\Auth;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }
    
    public function flutterInit(Request $request){
        try {
            $reference = Flutterwave::generateReference();
            $data = [
                'payment_options' => 'card,banktransfer',
                'amount' => $request->amount,
                'email' => Auth::user()->email,
                'tx_ref' => $reference,
                'currency' => "USD",
                'redirect_url' => route('flutter.callback'),
                'customer' => [
                    'email' => Auth::user()->email,
                    "phone_number" => $request->phone,
                    "name" => $request->name
                ],
    
                "customizations" => [
                    "title" => 'AUR 2611',
                    "description" => Carbon::now(),
                    "logo" => $request->logo
                ]
            ];
            
            $payment = Flutterwave::initializePayment($data);    
    
            if ($payment['status'] !== 'success') {
                // notify something went wrong
                return back()->with('error', 'Oops! Something went wrong.');
            }
    
            return redirect($payment['data']['link']);
        } catch (\Exception $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    
    public function flutterwaveCallback()
    {
        $status = request()->status;
        $order = session()->get('order');
        if($status != "cancelled"){
            $transactionID = Flutterwave::getTransactionIDFromCallback();
        }
        $amount = \Cart::session(auth()->id())->getTotal();
        $subamount = \Cart::session(auth()->id())->getSubTotal();
        $method = 'flutterwave';

        //if payment is successful
        if($status == "cancelled"){
            return redirect()->route("checkout.step_three.index",['order',$order])->with("error", "Transaction Cancelled");
        } 
        elseif ($status ==  'successful') {
            $data = Flutterwave::verifyTransaction($transactionID);
            // dd($data);
            $res = (new OrderActions())->store($order, $amount, $subamount, $method);
            $newOrder = OrderQueries::findByRef($res);
        
            DB::beginTransaction();
            if(PaymentRecord::where('payment_ref', $transactionID)->first()){
                throw new Exception('Duplicate transaction');
            }else{
                $payment = new PaymentRecord();
                $payment->user_id = auth()->id();
                $payment->order_id = $newOrder->id;
                $payment->amount = $amount;
                $payment->description = 'Payment for Order '.$newOrder->order_number;
                $payment->payment_ref = $transactionID;
                $payment->save();
                DB::commit();
                
                $admin = User::where('is_admin', 1)->get();
                $user = Auth::user()->email;
                    
                \Cart::session(auth()->id())->clear();
                request()->session()->forget('order');
                
                NotifyAdminOrder::dispatch($newOrder, $admin);
                
                return redirect()->route('payment.succeess');
            }
        }
        else{
            return redirect()->route('payment.failure');
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here
        
        
    }
    
    public function stripeHandlePayment(Request $request){
        $user = $request->user();
        $paymentMethod = $request->paymentMethod;
        $amount = \Cart::session(auth()->id())->getTotal();
        $order = $request->session()->get('order');     
        $method = 'stripe';
        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $stripeCharge = $user->charge($amount * 100, $paymentMethod,['receipt_email' => $user->email]);
            $payment_id = $stripeCharge->jsonSerialize()['id'];
            $subamount = \Cart::session(auth()->id())->getSubTotal();
            $res = (new OrderActions())->store($order, $amount, $subamount);
            // dd($res);
            if($res){
                $newOrder = (new OrderQueries())->findByRef($res);
                
                DB::beginTransaction();
                $payment = new PaymentRecord();
                $payment->user_id = auth()->id();
                $payment->order_id = $newOrder->id;
                $payment->amount = $amount;
                $payment->description = 'Payment for Order '.$newOrder->order_number;
                $payment->payment_ref = $payment_id;
                $payment->save();
                DB::commit();
                
                $admin = User::where('is_admin', 1)->get();
                $user = Auth::user()->email;
                    
                \Cart::session(auth()->id())->clear();
                $request->session()->forget('order');
                
                NotifyAdminOrder::dispatch($newOrder, $admin);
                
                return redirect()->route('payment.succeess');
            }

        } catch (\Exception $th) {
            // DB::rollback();
            return redirect()->route('payment.failure', ['error' => $th->getMessage()]);
        }
    }
    
    public function paymentSuccess(Request $request){
        return view('order-status.order-success');
    }
    
    public function paymentFailure(Request $request){
        return view('order-status.order-failure')->with('error', $request->error);
    }
}
