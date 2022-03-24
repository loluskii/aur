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
    
    public function getSessionID(){
        if(!Auth::check()){
            return 'guest';
        }
        return auth()->id();
    }
    
    public function flutterInit(Request $request){
        try {
            // dd($request->all());
            $reference = Flutterwave::generateReference();
            $data = [
                'payment_options' => 'card,banktransfer',
                'amount' => 500,
                'email' => Auth::user()->email ?? $request->email,
                'tx_ref' => $reference,
                'currency' => "USD",
                'redirect_url' => route('flutter.callback'),
                'customer' => [
                    'email' => Auth::user()->email ?? $request->email,
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
            return back()->with('error', 'Please check your internet connection and try again!');
        }
    }
    
    public function flutterwaveCallback()
    {
        $status = request()->status;
        $order = session()->get('order');
        if($status != "cancelled"){
            $transactionID = Flutterwave::getTransactionIDFromCallback();
        }
        // dd($order);
        $amount = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal();
        $subamount = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getSubTotal();
        $method = 'flutterwave';
        $user_id = auth()->check() ? auth()->id() : rand(0000,9999);

        //if payment is successful
        if($status == "cancelled"){
            return redirect()->route("checkout.step_three.index",['order',$order])->with("error", "Transaction Cancelled");
        } 
        elseif ($status ==  'successful') {
            $data = Flutterwave::verifyTransaction($transactionID);
            // dd($data);
            $res = (new OrderActions())->store($order, $amount, $subamount, $method, $user_id);
            $newOrder = OrderQueries::findByRef($res);
        
            DB::beginTransaction();
            if(PaymentRecord::where('payment_ref', $transactionID)->first()){
                throw new Exception('Duplicate transaction');
            }else{
                $payment = new PaymentRecord();
                $payment->user_id = $newOrder->user_id;
                $payment->order_id = $newOrder->id;
                $payment->amount = $amount;
                $payment->description = 'Payment for Order '.$newOrder->order_number;
                $payment->payment_ref = $transactionID;
                $payment->save();
                DB::commit();
                
                $admin = User::where('is_admin', 1)->get();
                $user = $newOrder->shipping_email;
                    
                \Cart::session(auth()->check() ? auth()->id() : 'guest')->clear();
                request()->session()->forget('order');
                
                NotifyAdminOrder::dispatch($newOrder, $admin);
                
                return redirect()->route('payment.success');
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
    
    //Redirect to stripe checkout
    public function stripeInit(Request $request){
        $cart = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getContent();
        $x = [];
        foreach($cart as $key => $value){
            $x[] = array($value['id'],$value['price'], $value['quantity'],$value['attributes']['size']);
        }
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $subamount = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getSubTotal();
        $amount = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal();
        $order = $request->session()->get('order');
        $method = 'stripe';
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Order from 2611 AUR',
                    ],
                    'unit_amount' => $amount * 100,
                ],
                'quantity' => 1,
            ]],
            'payment_intent_data' => [
                'metadata' => [
                    'order' => $order,
                    'subamount' => $subamount,
                    'user_id' => auth()->id() ?? rand(0000,9999),
                    'order_items' => json_encode($x),
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.failure'),
        ]);
        return redirect()->away($checkout_session->url);
    }
    
        //Handle Stripe Webhook
        public function webhook(Request $request)
        {
            try {
                $data = $request->all();
                $method = "stripe";
                $metadata = $data['data']['object']['metadata'];
                $user_id = $metadata['user_id'];
                switch ($data['type']) {
                    case 'charge.succeeded':
                        $subamount = $metadata['subamount'];
                        $amount = $data['data']['object']['amount'] / 100;
                        $payment_id = $data['data']['object']['id'];
                        $order_items = $metadata['order_items'];
                        $res = (new OrderActions())->store(json_decode($metadata['order']), $amount, $subamount, $user_id, $method, json_decode($metadata['order_items']) );
                        $newOrder = (new OrderQueries())->findByRef($res);
                        if ($newOrder) {
                            DB::beginTransaction();
                                if(PaymentRecord::where('payment_ref', $payment_id)->first()){
                                    throw new Exception('Payment Already made!');
                                }
                                $payment = new PaymentRecord();
                                $payment->user_id = auth()->id() ?? $newOrder->user_id;
                                $payment->order_id = $newOrder->id;
                                $payment->amount = $amount;
                                $payment->description = 'Payment for Order '.$newOrder->order_number;
                                $payment->payment_ref = $payment_id;
                                $payment->save();
                            DB::commit();
                            $admin = User::where('is_admin', 1)->get();
                            \Cart::session(auth()->check() ? auth()->id() : 'guest')->clear();
                            $request->session()->forget('order');
                            
                            NotifyAdminOrder::dispatch($newOrder, $admin);
                        }
                        return 'webhook captured!';
                        break;
                    default:
                        return 'webhook event not found';
                }
            } catch (Exception $e) {
                return $e;
            }
        }
    
    
    public function stripeHandlePayment(Request $request){
        $user = $request->user() ?? new User();
        // $order = $request->session()->get('order');     
        // $email = $user->email ?? $order->shipping_email;
        // $paymentMethod = $request->paymentMethod;
        // $amount = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getTotal();
        
        $method = 'stripe';
        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $stripeCharge = $user->charge($amount * 100, $paymentMethod,['receipt_email' => $email]);
            $payment_id = $stripeCharge->jsonSerialize()['id'];
            $subamount = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getSubTotal();
            $res = (new OrderActions())->store($order, $amount, $subamount, $method);
            // dd($res);
            if($res){
                $newOrder = (new OrderQueries())->findByRef($res);
                
                DB::beginTransaction();
            if(PaymentRecord::where('payment_ref', $payment_id)->first()){
                throw new Exception('Duplicate transaction');
            }else{
                $payment = new PaymentRecord();
                $payment->user_id = auth()->id();
                $payment->order_id = $newOrder->id;
                $payment->amount = $amount;
                $payment->description = 'Payment for Order '.$newOrder->order_number;
                $payment->payment_ref = $payment_id;
                $payment->save();
                DB::commit();
                
                $admin = User::where('is_admin', 1)->get();
                // $user = Auth::user()->email;
                    
                \Cart::session(auth()->check() ? auth()->id() : 'guest')->clear();
                $request->session()->forget('order');
                
                NotifyAdminOrder::dispatch($newOrder, $admin);
                
                return redirect()->route('payment.succeess');}
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
