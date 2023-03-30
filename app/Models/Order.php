<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory , SoftDeletes;

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
        return $this->belongsTo(Doctor::class,"doctor_id",'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make( 

            get: fn (string $value) => Carbon::parse($value)->format('d/m/Y h:m A'),
            
        );
    }

    protected function isInsured(): Attribute
    {
        return Attribute::make(
           
            set: fn (string $value) => $value =  $value == "Yes" ? 1 : 0,
            get: fn (string $value) => $value =  $value == 0 ? "No" : "Yes",
        );
    }

    protected function status(): Attribute
    {
        return Attribute::make(
           
            get: function (string $value) {

                switch($value){
                    case 1 :
                        return "New";
                    case 2 :
                        return "Processing";
                    case 3 :
                        return "Waiting";
                    case 4 :
                        return "Cancelled";
                    case 5 :
                        return "Confirmed";
                    case 6 :
                        return "Delivered";
                }

            },

            set: function (string $value) {

                switch($value){
                    case "New" :
                        return 1;
                    case "Processing" :
                        return 2;
                    case "Waiting":
                        return 3;
                    case "Cancelled":
                        return 4 ;
                    case "Confirmed":
                        return 5 ;
                    case "Delivered":
                        return 6;
                }
            } 
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
            
            $order->medicines($id)->attach(1 , ['quantity' => $qty[$x]]);
        }

    }
  
}
