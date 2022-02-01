<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;


class CartController extends Controller
{

    public function addToCart(Product $product){
        \Cart::session(auth()->id())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        return redirect()->route('product.show',['tag' => $product->tag_number]);
    }

    public function index(){
        $cartTotalQuantity = \Cart::session(auth()->id())->getContent()->count();
        $cartItems = \Cart::session(auth()->id())->getContent();
        return view('store.cart', compact('cartItems', 'cartTotalQuantity'));
    }

    public function update($id){
        \Cart::session(auth()->id())->update($id,[
            'quantity' =>  array(
                'relative' => false,
                'value' => request('quantity'),
            )
        ]);

        return back();
    }

    public function destroy($id)
    {
        $cartItems = \Cart::session(auth()->id())->remove($id);

        return back();
    }

    public function checkout(){
        $cartItems = \Cart::session(auth()->id())->getContent();
        $cartTotalQuantity = \Cart::session(auth()->id())->getContent()->count();
        // $address = Address::where('user_id', auth()->id())->first();
        $order_details = session('order');
        return view('checkout.step-1', compact('cartItems','cartTotalQuantity','order_details'));
    }
    
    public function contactInformation(Request $request){
        try {            
            if(empty($request->session()->get('order'))){
                $order = new Order;
                $order->fill($request->all());
                $request->session()->put('order', $order);
            }else{
                $order = $request->session()->get('order');
                $order->fill($request->all());
                $request->session()->put('order', $order);
            }
            
            // dd(session('order'));
            return redirect()->route('checkout.step_two.index',['order' => $order]);
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
    }
    
    public function shipping(Request $request){
        $order = $request->session()->get('order');
        $cartItems = \Cart::session(auth()->id())->getContent();
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'Standard Shipping',
            'type' => 'shipping',
            'target' => 'total',
            'value' => '50',
        ));
        \Cart::session(auth()->id())->condition($condition);
        $conditionValue = $condition->getValue();
        return view('checkout.step-2', compact('order','cartItems','conditionValue'));
    }
    
    public function postShipping(Request $request){
        try {            
            $order = $request->session()->get('order');
            $order->fill($request->all());
            $request->session()->put('order', $order);
            return redirect()->route('checkout.step_three.index',['order' => $order]);
        } catch (\Exception $e) {
            return back()->with('error',$e->getMessage());
        }
    }
    
    public function showPayment(Request $request){
        try {
            $order = $request->session()->get('order');
            $cartItems = \Cart::session(auth()->id())->getContent();
            $condition = \Cart::getCondition('Standard Shipping');
            $intent = $request->user()->createSetupIntent();
            $condition_name = $condition->getName(); // the name of the condition
            $condition_value = $condition->getValue(); // the value of the condition
            
            return view('checkout.step-3', compact('order','cartItems','condition_name','condition_value','intent'));
        } catch (\Exception $th) {
            return back()->with('error','Please Check your internet connection!');
        }
    }

}
