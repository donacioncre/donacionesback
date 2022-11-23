<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Questions
 * @package App\Models
 * @version November 23, 2022, 1:05 am UTC
 *
 * @property string $ask
 * @property string $answer
 */
class Questions extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'questions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'ask',
        'answer'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ask' => 'string',
        'answer' => 'string'
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
        "updated_at",
        "deleted_at"
    ];
}
