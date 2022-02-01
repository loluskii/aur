<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\UserQueries;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){    
        $totalUsers = User::count();
        $recent_orders = Order::latest()->take(10)->get();
        $orders = Order::count();
        $sales = Order::sum('grand_total');
        $profit = Order::sum('subtotal');
        $chartSales = UserQueries::orderSalesJson();
        $chartCustomers = UserQueries::userCountJson();
        $monthly_users_count = User::where('is_admin',0)->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])->get();
        
        // dd($chartSales);

        return view('admin.dashboard.index',compact('totalUsers','recent_orders','orders','sales','profit','chartSales', 'chartCustomers','monthly_users_count'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
