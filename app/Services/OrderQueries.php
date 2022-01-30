<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use DB;
use Exception;


class OrderQueries{

    public function findByRef($ref){
        return Order::firstWhere('order_reference', $ref);
    }
    public function getUserOrderDetails($id){
        $orders = DB::table('orders')->where('user_id', $id)->pluck('id');
        return $orders;
    }



}

?>
