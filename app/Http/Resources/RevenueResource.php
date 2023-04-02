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

    public function toArray(Request $request):float
    {
        $total=0;

        foreach ($this->orders as $order){
            foreach ($order->medicines as $med){
                $total+=$med->price*$med->pivot->quantity;
            }
        }
        return $total;
    }
}
