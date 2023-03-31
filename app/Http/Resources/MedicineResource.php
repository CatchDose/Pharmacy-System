<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'name' => $this->name,
            'type' => $this->type,
            'quantity'=>$this->pivot->quantity,
            'total_price'=>($this->pivot->quantity * $this->price)
    
        ];
    }
}
