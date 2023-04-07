<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'ordered_at' => Carbon::parse($this->created_at)->diffForHumans(),

            'status' => $this->status,
            'assigned_pharmacy' => new PharmacyResource($this->pharmacy),

        ];
    }
}
