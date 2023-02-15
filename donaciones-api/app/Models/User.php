<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "firstname",
        "lastname",
        "profile_picture",
        "identification",
        "blood_type",
        "phone_number",
        "conventional_number",
        "date_birth",
        "device_token",
        "country",
        "city",
        "status"

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        "email_verified_at",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function donationCenter()
    {
        return $this->hasManyThrough(
            DonationPoint::class,
            UserDonationCenter::class,
            'user_id',
            'id',
            'id',
            'donation_id',
        );
    }

    public function scheduleDonor()
    {
        return $this->HasMany(Schedule::class,'user_id','id');
    }
}