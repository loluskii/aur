<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Action\OrderActions;
use Illuminate\Http\Request;
use App\Jobs\SendOrderInvoice;
use App\Jobs\UserOrderShipped;
use App\Services\OrderQueries;
use App\Jobs\UserOrderDelivered;
use App\Jobs\NotifyUserOrderUpdate;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all(); 
        $monthlyRevenue = OrderQueries::getMonthlyRevenue()->sum('subtotal');
        $monthlySalesCount = OrderQueries::getMonthlyRevenue()->count();
        $pendingOrders = OrderQueries::getPendingOrders()->count();
        $sales = Order::where('is_paid',1)->sum('subtotal');
        return view('admin.orders.index', compact('orders','sales', 'monthlyRevenue','monthlySalesCount','pendingOrders'));

    }

    /**
     * Show the form for creating a new cresource.
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_reference)
    {
        $order = Order::where('order_reference', $order_reference)->first();
        // dd($order->order_number);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            
            if($request->status == 2){
                $newOrder = Order::findOrFail($id);
                $user = $newOrder->shipping_email;
                $res = OrderActions::update($request, $id);
                if($res){
                    SendOrderInvoice::dispatch($newOrder, $user)->delay(now()->addSecond());
                    return back()->with('success','Successful!');
                    
                }
            }else if($request->status == 4){
                $order = Order::findOrFail($id);
                $user = $order->shipping_email;
                $res = OrderActions::update($request, $id);
                if($res){
                    UserOrderShipped::dispatch($order, $user)->delay(now()->addSecond());
                    return back()->with('success','Successful!');
                    
                }
                
            }else if($request->status == 5){
                $order = Order::findOrFail($id);
                $user = $order->shipping_email;
                $res = OrderActions::update($request, $id);
                if($res){
                    try {
                        UserOrderDelivered::dispatch($order, $user)->delay(now()->addSecond());
                        return back()->with('success','Successful!');
                    } catch (\Exception $e) {
                        return back()->with('error',$e->getMessage());
                    }
                }
            }else{
                $res = OrderActions::update($request, $id);
                if($res){
                    return back()->with('success','Successful!');
                }else{
                    return back()->with('error','An error occured');
                }
            }

        } catch (\Exception $e) {
            return back()->with('error',$e->getMEssage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
