<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class BenefitDonating
 * @package App\Models
 * @version November 16, 2022, 9:51 pm UTC
 *
 * @property string $title
 * @property string $details
 */
class BenefitDonating extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'benefit_donating';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'details'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'details' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'details' => 'required'
    ];

    protected $hidden = [
     
        "created_at",
        "updated_at"
    ];
    public function donation_details()
    {
        return $this->hasMany(DonationDetails::class,'benefit_id','id');
    }
}
