<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacy extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        "owner_id",
        "area_id",
        "priority"

    ];

    public function doctors()
    {
        return $this->hasMany(User::class, 'pharmacy_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'pharmacy_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
