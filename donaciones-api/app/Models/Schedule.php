<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public $fillable = [
        'donation_date',
        'donation_time',
        'note',
        'user_id',
        'donation_id',
        'note'
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
        "updated_at"
    ];

    public function donation()
    {
        return $this->belongsTo(DonationPoint::class,'donation_id','id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}