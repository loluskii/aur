<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;


class UserQueries{

    public static function orderSalesJson(){
        $currentmonth = Order::where('is_paid',1)->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->get();
        $lastmonth = Order::where('is_paid',1)->whereBetween('created_at', [Carbon::now()->subWeeks(2), Carbon::now()->subWeek()])->get();
        $anothermonth = Order::where('is_paid',1)->whereBetween('created_at', [Carbon::now()->subWeeks(3), Carbon::now()->subWeeks(2)])->get();
        $anothermonth2 = Order::where('is_paid',1)->whereBetween('created_at', [Carbon::now()->subWeeks(4), Carbon::now()->subWeeks(3)])->get();
        $anothermonth3 = Order::where('is_paid',1)->whereBetween('created_at', [Carbon::now()->subWeeks(5), Carbon::now()->subWeeks(4)])->get();
        
        $data = [
            'x' => [
                Carbon::now()->format('Y-m'),
                Carbon::now()->subWeeks(4)->format('Y-m-d'),
                Carbon::now()->subWeeks(3)->format('Y-m-d'),
                Carbon::now()->subWeeks(2)->format('Y-m-d'),
                Carbon::now()->subWeeks()->format('Y-m-d'),
            ],
            'y' => [
                $anothermonth3->sum('grand_total'),
                $anothermonth2->sum('grand_total'),
                $anothermonth->sum('grand_total'),
                $lastmonth->sum('grand_total'),
                $currentmonth->sum('grand_total'),
            ],
        ];
        
        return json_encode($data);
    }
    
    public static function userCountJson(){
        $currentTime1 = User::where('is_admin',0)->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->get();
        $currentTime2 = User::where('is_admin',0)->whereBetween('created_at', [Carbon::now()->subWeeks(2), Carbon::now()->subWeek()])->get();
        $currentTime3 = User::where('is_admin',0)->whereBetween('created_at', [Carbon::now()->subWeeks(3), Carbon::now()->subWeeks(2)])->get();
        $currentTime4 = User::where('is_admin',0)->whereBetween('created_at', [Carbon::now()->subWeeks(4), Carbon::now()->subWeeks(3)])->get();
        $currentTime5 = User::where('is_admin',0)->whereBetween('created_at', [Carbon::now()->subWeeks(5), Carbon::now()->subWeeks(4)])->get();
        
        $data = [
            'x' => [
                Carbon::now()->format('Y-m'),
                Carbon::now()->subWeeks(4)->format('Y-m-d'),
                Carbon::now()->subWeeks(3)->format('Y-m-d'),
                Carbon::now()->subWeeks(2)->format('Y-m-d'),
                Carbon::now()->subWeeks()->format('Y-m-d'),
            ],
            'y' => [
                $currentTime5->count(),
                $currentTime4->count(),
                $currentTime3->count(),
                $currentTime2->count(),
                $currentTime1->count(),
            ]
        ];
        
        return json_encode($data);
    }










}







?>