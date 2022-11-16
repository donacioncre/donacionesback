<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Myths
 * @package App\Models
 * @version November 16, 2022, 10:07 pm UTC
 *
 * @property string $title
 * @property string $details
 */
class Myths extends Model
{
    //use SoftDeletes;

    use HasFactory;

    public $table = 'myths';
    

    //protected $dates = ['deleted_at'];



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
        'title' => 'required'
    ];

    protected $hidden = [
     
        "created_at",
        "updated_at"
    ];

    public function myth_details()
    {
        return $this->hasMany(MythDetails::class,'myths_id','id');
    }
}
