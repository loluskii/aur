<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Address;
use App\Action\UserActions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Auth::user()->orders;
        $address = Auth::user()->getFullAddress();
        $address_id =  Address::firstWhere('user_id', Auth::id());
        
        return view('user.index', compact('orders', 'address', 'address_id'));
    }
    
    public function addAddress(){
        return view('user.create');
    }
    
    public function editAddress(){
        $address =  Address::firstWhere('user_id', Auth::id());
        // dd($address);
        return view('user.update', compact('address'));
    }
    
    public function updateAddress(Request $request){
        try {
            $id = $request->address_id;
            $address = UserActions::update($request, $id);
            if($address){
                return redirect()->route('account')->with('success', 'Updated!');
            }else{
                return back()->with('error', 'An error occured');
            }
        } catch (\Exception $e) {
            return $e->getMEssage();
        }
    }
    
    public function storeAddress(Request $request){
        try {
            $address = UserActions::create($request);
            if($address){
                return redirect()->route('account')->with('success', 'Added!');
            }else{
                return back()->with('error', 'An error occured');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMEssage());
        }
    }
    
    public function deleteAddress($id){
        $address = Address::findOrFail($id);
        $address->delete();
        
        return back()->with('success', 'Address Deleted!');
    }
    
    public function getOrderDetails($id){
        $order = Order::firstWhere('order_reference', $id);
        return view('user.order-show', compact('order'));
    }
}
