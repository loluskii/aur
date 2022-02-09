<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $products = Product::where('is_featured',true)->get();
        
        return view('welcome', compact('products'));
    }
    
    public function aboutUs(){
        return view('about-us');
    }
    
    public function shippingPolicy(){
        return view('shipping');
    }
}
