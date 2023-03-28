<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->belongsToMany(Order::class,'medicines_orders'
            ,'medicine_id','order_id');
    }
}