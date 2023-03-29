<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function created_at(): Attribute
    {
        return Attribute::make(

            // get: fn (string $value) => Carbon::createFromFormat('Y-m-d H', $value)->toDateTimeString(),
            
        );
    }
  
}
