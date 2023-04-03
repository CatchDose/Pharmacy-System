<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        "path",
    ];

    public function order()
{
    return $this->belongsTo(Order::class,'order_id');
}

    protected function path(): Attribute
    {
        return Attribute::make(

            get: fn (string $value) => asset('storage/prescription/'.$value),
        );
    }

}


