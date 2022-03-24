<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index(){
        // DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('Stripe','Flutterwave')");
        $products = Product::where('is_featured',true)->get();
        
        return view('welcome', compact('products'));
    }
    
    public function sweatshirts(){
        $products = Product::where('category_id',1)->get();
        return view('products.sweatshirt.index', compact('products'));
    }
    
    public function tshirts(){
        $products = Product::where('category_id',2)->get();
        // dd($products);
        return view('products.tshirts.index', compact('products'));
    }
    
    public function accessories(){
        $products = Product::where('category_id',3)->get();
        return view('products.accessories.index', compact('products'));
    }
    
    public function outerwear(){
        $products = Product::where('category_id',4)->get();
        return view('products.outerwear.index', compact('products'));
    }
    
    public function bottoms(){
        $products = Product::where('category_id',5)->get();
        return view('products.bottoms.index', compact('products'));
    }
    
    public function aboutUs(){
        $cart = \Cart::session(auth()->check() ? auth()->id() : 'guest')->getContent();
        $x = [];
        foreach($cart as $key => $value){
            $x[] = array($value['id'],$value['price'], $value['quantity'],$value['attributes']['size']);
        }
        
        dd(jsonSerialize()($x));
        // $array = array(12, 10, 0, 18, 27, 0, 46);
        // print_r(array_filter($array));
        
        return view('about-us');
    }
    
    public function shippingPolicy(){
        return view('shipping');
    }
    
    public function contact(){
        return view('contact');
    }
}
