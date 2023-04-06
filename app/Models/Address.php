<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'street_name',
        'building_number',
        'floor_number',
        'flat_number',
        'is_main',
        'area_id',
        'user_id'
    ];
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class,'area_id');
    }

    protected function isMain(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value == "1" ? "Yes" : "No",
        );
    }
}
