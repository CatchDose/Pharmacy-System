<?php

namespace App\Http\Services;

use App\Models\Pharmacy;

class RevenueService
{
    public function calcRevenue(Pharmacy $pharmacy){
        $total=0;
        $orders=$pharmacy->orders->whereIn("status",["Delivered","Confirmed"]);
        foreach ($orders as $order){
            foreach ($order->medicines as $med){
                $total+=$med->price*$med->pivot->quantity;
            }
        }

        return [
            "Total_Orders"=>$orders->count(),
            "Total_Revenue"=>$total
        ];
    }

}
