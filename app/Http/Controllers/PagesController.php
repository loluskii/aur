<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index(){
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('Stripe','Flutterwave')");
        $products = Product::where('is_featured',true)->get();
        
        return view('welcome', compact('products'));
    }
    
    public function aboutUs(){
        return view('about-us');
    }
    
    public function shippingPolicy(){
        return view('shipping');
    }
    
    public function contact(){
        return view('contact');
    }
}
