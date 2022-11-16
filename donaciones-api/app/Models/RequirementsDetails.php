<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RequirementsDetails
 * @package App\Models
 * @version November 16, 2022, 10:05 pm UTC
 *
 * @property string $points
 * @property string $points_details
 * @property string $image
 */
class RequirementsDetails extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'requirement_details';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'points',
        'points_details',
        'image',
        'requirement_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'points' => 'string',
        'points_details' => 'string',
        'image' => 'string'
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
