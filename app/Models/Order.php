<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'status',
        "pharmacy_id",
        "user_id",
        "doctor_id",
        "is_insured",
    ];


    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'medicines_orders', 'order_id', 'medicine_id')->withPivot('quantity');
    }

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class, "pharmacy_id");
    }


    public function doctor()
    {
        return $this->belongsTo(User::class, "doctor_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function prescription()
    {
        return $this->hasMany(Prescription::class, 'order_id');
    }

    public function totalPrice()
    {
        $total = 0;
        foreach ($this->medicines as $med) {
            $total += $med->price * $med->pivot->quantity;
        }

        return $total;
    }

    protected function isInsured(): Attribute
    {
        return Attribute::make(

            set: fn(string $value) => $value = $value == "Yes" ? 1 : 0,
            get: fn(string $value) => $value = $value == 0 ? "No" : "Yes",
        );
    }

    protected function status(): Attribute
    {
        return Attribute::make(

            get: function (string $value) {

                switch ($value) {
                    case 1:
                        return "New";
                    case 2:
                        return "Processing";
                    case 3:
                        return "Waiting";
                    case 4:
                        return "Cancelled";
                    case 5:
                        return "Confirmed";
                    case 6:
                        return "Delivered";
                }
            },
        );
    }
}
