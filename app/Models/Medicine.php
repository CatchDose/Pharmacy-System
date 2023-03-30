<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        "type",
        "price",

    ];

    public function orders()
    {
        return $this->belongsToMany(
            Order::class,
            'medicines_orders',
            'medicine_id',
            'order_id'
        );
    }
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (int $value) => intval($value) * 100,
        );
    }
}
