<?php

namespace App\Action;

use App\Models\Order;
// use App\Mail\OrderCreated;
use Illuminate\Support\Str;
use App\Models\PaymentRecord;
use Illuminate\Support\Facades\Auth;
use DB;
// use Illuminate\Support\Facades\Mail;

class OrderActions{

    public function store($order, $amount, $subamount, $user_id = null, $method, $orderItems = null){
        // DB::beginTransaction();
            $newOrder = new Order();
            $ref = Str::random(20);
            $newOrder->order_number = uniqid('#');
            $newOrder->shipping_fname = $order->shipping_fname;
            $newOrder->shipping_lname = $order->shipping_lname;
            $newOrder->shipping_address = $order->shipping_address;
            $newOrder->shipping_city = $order->shipping_city;
            $newOrder->shipping_state = $order->shipping_state;
            $newOrder->shipping_phone = $order->shipping_phone;
            $newOrder->shipping_zipcode = $order->shipping_zipcode;
            $newOrder->shipping_landmark = $order->shipping_landmark ?? 'none';
            $newOrder->shipping_country = $order->shipping_country;
            $newOrder->shipping_email = $order->shipping_email;
            $newOrder->subtotal = $subamount;
            $newOrder->grand_total = $amount;
            $newOrder->item_count = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getContent()->count() ?? count($orderItems);
            $newOrder->user_id = auth()->id() ?? $user_id;
            // $newOrder->plan = $order->plan;
            $newOrder->payment_method = $method;
            // $newOrder->delivery_total = $delivery_fee;
            $newOrder->is_paid = 1;
            $newOrder->status = 1;
            $newOrder->order_reference = $ref;
    
            $newOrder->save();
            
            if($method === "stripe"){
                $cartItems = $orderItems;
                foreach($cartItems as $item){
                    $newOrder->items()->attach($item[0], ['price'=> $item[1], 'quantity'=> $item[2], 'size'=>$item[3]]);
                }
            }else{
                $cartItems =  \Cart::session(auth()->check() ? auth()->id() : 'guest')->getContent();
                foreach($cartItems as $item){
                    $newOrder->items()->attach($item->id, ['price'=> $item->price, 'quantity'=> $item->quantity, 'size'=>$item->attributes->size]);
                }
            }
            
            return $ref;
        // DB::commit();
    }
    
    public static function update($request, $id){
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->update();
        return true;
    }
    
}



?>
