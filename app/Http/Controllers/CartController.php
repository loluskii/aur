<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return back();
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
        return view('products.checkout', compact('cartItems','cartTotalQuantity'));

    }

}
