<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function getSessionID(){
        if(!Auth::check()){
            return 'guest';
        }
        return auth()->id();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        
        if(Auth::check()){
            $cartTotalQuantity = \Cart::session($this->getSessionID())->getContent()->count();
            $cartItems = \Cart::session($this->getSessionID())->getContent();
            return view('products.index', compact('products','cartItems','cartTotalQuantity'));
        }else{
            return view('products.index', compact('products'));
        }
        
    }
    
    public function getCategory($id){
        $products = Product::where('category_id','=', $id)->get();
        return view('products.category.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($tag)
    {
        $product = Product::where('tag_number', $tag)->first();
        $similar = Product::where('tag_number','!=',$product->tag_number)->where('category_id', $product->category_id)->take(4)->get();
        if(Auth::check()){
            $cartTotalQuantity = \Cart::session($this->getSessionID())->getContent()->count();
            $cartItems = \Cart::session($this->getSessionID())->getContent();
            return view('products.show', compact('product', 'similar', 'cartItems','cartTotalQuantity'));
        }
        return view('products.show', compact('product', 'similar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
