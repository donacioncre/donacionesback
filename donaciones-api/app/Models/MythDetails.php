<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class MythDetails
 * @package App\Models
 * @version November 16, 2022, 10:09 pm UTC
 *
 * @property string $ask
 * @property string $answer
 * @property string $image
 */
class MythDetails extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'myth_details';
    

    //protected $dates = ['deleted_at'];

    public $fillable = [
        'ask',
        'answer',
        'image',
        'myths_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ask' => 'string',
        'answer' => 'string',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ask' => 'required',
        'answer' => 'required'
    ];

    protected $hidden = [
     
        "created_at",
        "updated_at"
    ];
    
}
