<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BenefitDetails
 * @package App\Models
 * @version November 16, 2022, 9:55 pm UTC
 *
 * @property string $points
 */
class BenefitDetails extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'donation_details';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'points',
        'benefit_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'points' => 'string'
    ];

    /**
     * Validation rules
     * 
     * @var array
     */
    public static $rules = [
        'points' => 'required'
    ];

    protected $hidden = [
     
        "created_at",
        "updated_at"
    ];
    
}
