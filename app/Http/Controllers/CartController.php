<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function getSessionID(){
        if(!Auth::check()){
            return 'guest';
        }
        return auth()->id();
    }
    
    public function addToCart(Request $request , Product $product){
        \Cart::session($this->getSessionID())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(
                'size' => $request->size, 
            ),
            'associatedModel' => $product
        ));
        return redirect()->route('product.show',['tag' => $product->tag_number]);
    }

    public function index(){
        $cartTotalQuantity = \Cart::session($this->getSessionID())->getContent()->count();
        $cartItems = \Cart::session($this->getSessionID())->getContent();
        return view('store.cart', compact('cartItems', 'cartTotalQuantity'));
    }

    public function update($id){
        \Cart::session($this->getSessionID())->update($id,[
            'quantity' =>  array(
                'relative' => false,
                'value' => request('quantity'),
            )
        ]);

        return back();
    }

    public function destroy($id)
    {
        $cartItems = \Cart::session($this->getSessionID())->remove($id);

        return back();
    }

    public function checkout(){
        $cartItems = \Cart::session($this->getSessionID())->getContent();
        $cartTotalQuantity = \Cart::session($this->getSessionID())->getContent()->count();
        // $address = Address::where('user_id', auth()->id())->first();
        $order_details = session('order');
        if($cartItems->count() > 0){
            return view('checkout.step-1', compact('cartItems','cartTotalQuantity','order_details'));
        }else{
            return redirect()->route('shop');
        }
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
        $cartItems = \Cart::session($this->getSessionID())->getContent();
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'Standard Shipping',
            'type' => 'shipping',
            'target' => 'total',
            'value' => '50',
        ));
        \Cart::session($this->getSessionID())->condition($condition);
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
            $cartItems = \Cart::session($this->getSessionID())->getContent();
            $condition = \Cart::getCondition('Standard Shipping');
            // $intent = $this->getSessionID() == 'guest' ? (new User())->createSetupIntent() : $request->user()->createSetupIntent();
            $condition_name = $condition->getName(); // the name of the condition
            $condition_value = $condition->getValue(); // the value of the condition
            
            return view('checkout.step-3', compact('order','cartItems','condition_name','condition_value'));
        } catch (\Exception $th) {
            return back()->with('error',$th->getMessage());
        }
    }

}
