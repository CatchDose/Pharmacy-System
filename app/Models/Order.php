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

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class,"pharmacy_id");
    }


    public function doctor()
    {
        return $this->belongsTo(Doctor::class,"doctor_id",'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
}
