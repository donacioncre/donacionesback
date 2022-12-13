<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class BloodDonationHour extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'blood_donation_hours';
    

   // protected $dates = ['deleted_at'];



    public $fillable = [
        'days',
        'start_time',
        'end_time',
        'donation_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
       
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
       
    ];

    protected $hidden = [
     
        "created_at",
        "updated_at",
        
    ];
}
