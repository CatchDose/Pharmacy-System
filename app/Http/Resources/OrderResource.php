<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $totalPrice = 0 ;
        foreach(MedicineResource::collection($this->medicines) as $medicine){
            $totalPrice += $medicine->price;
        }
        return [

            'id' => $this->id,
            'medicines' => MedicineResource::collection($this->medicines),
            'order_total_price'=> $totalPrice ,
            'status' => $this->status,
            'ordered_at' => $this->created_at,
            'assigned_pharmacy' => new PharmacyResource($this->pharmacy),
    
        ];
    }
}
