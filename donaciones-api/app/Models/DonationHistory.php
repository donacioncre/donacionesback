<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class DonationHistory
 * @package App\Models
 * @version December 30, 2022, 1:09 am UTC
 *
 * @property string $code
 * @property string $hemoglobin
 * @property string $weight
 * @property string $blood_pressure
 * @property boolean $status
 * @property string $note
 */
class DonationHistory extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'donation_histories';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'hemoglobin',
        'weight',
        'blood_pressure',
        'status',
        'note',
        'schedule_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'string',
        'hemoglobin' => 'string',
        'weight' => 'string',
        'blood_pressure' => 'string',
        'status' => 'boolean',
        'note' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required'
    ];

    protected $hidden = [
    
        "created_at",
        "updated_at"
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class,'schedule_id','id');
    }
}
