<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "data"=> [
                'name'=>$this->name,
                'email'=>$this->email,
                'phone'=>$this->phone,
            ],
            "access_token" => $this->createToken(Str::random(5))->plainTextToken
        ];
    }
}
