<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RevenueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request):array
    {
        $total=0;
        $orders=$this->orders->whereIn("status",["Delivered","Confirmed"]);
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
