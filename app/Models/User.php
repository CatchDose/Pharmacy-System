<?php

namespace App\Models;


use App\Notifications\VerifyEmailApi;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Cog\Contracts\Ban\Bannable as BannableInterface;
use Cog\Laravel\Ban\Traits\Bannable;

class User extends Authenticatable implements BannableInterface,MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;
    use Bannable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
        "avatar_image",
        "national_id",
        'email',
        "date_of_birth",
        "gender",
        "phone",
        "pharmacy_id",
        "last_login"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function addresses()
    {
        return $this->hasMany(Address::class, "user_id");
    }

    public function orders()
    {
        return $this->hasMany(Order::class, "user_id");
    }

    public function owens()
    {
        return $this->hasOne(Pharmacy::class, "owner_id");
    }

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class, "pharmacy_id");
    }


    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::make($value),
        );
    }


    public function sendEmailVerificationNotificationApi()
    {
        $this->notify(new VerifyEmailApi);
    }


}
