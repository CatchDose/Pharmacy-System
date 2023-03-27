<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    public function medicines()
    {
        return $this->belongsToMany(Medicine::class,'medicines_orders'
            ,'order_id' ,'medicine_id');
    }
}
