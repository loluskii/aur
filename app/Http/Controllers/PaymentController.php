<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Action\OrderActions;
use Illuminate\Http\Request;
use App\Models\PaymentRecord;
use App\Jobs\NotifyAdminOrder;
use App\Jobs\SendOrderInvoice;
use App\Services\OrderQueries;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }
    
    public function handlePayment(Request $request){
        $user = $request->user();
        $paymentMethod = $request->paymentMethod;
        $amount = \Cart::session(auth()->id())->getTotal();
        $order = $request->session()->get('order');        
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
