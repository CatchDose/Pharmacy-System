<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        "pharmacy_id",
        "user_id",
        "doctor_id",
        "is_insured",

    ];


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
        return $this->belongsTo(User::class,"doctor_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(

            // get: fn (string $value) => Carbon::createFromFormat('Y-m-d', $value)->toDateTimeString(),

        );
    }

    protected function isInsured(): Attribute
    {
        return Attribute::make(

            set: fn (string $value) => $value =  $value == "Yes" ? 1 : 0,
        );
    }


    public static function totalPrice($qty , $med){

        $total = 0;

        for($x=0 ; $x < count($med) ; $x++){

            $price = Medicine::all()->where('name' , $med[$x] )->first()->price;
            $total = $total + ($price * $qty[$x] );

        }

        return $total ;

    }

    public static function createOrderMedicine($order , $med , $qty ){

        for($x=0 ; $x < count($med) ; $x++){

            $id = Medicine::all()->where('name' , $med[$x] )->first()->id;

            $order->medicines($id)->attach(1 , ['quantity' => $qty[$x] , 'created_at'=>$order->created_at]);
        }

    }

}
