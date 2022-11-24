<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class NewCall
 * @package App\Models
 * @version November 23, 2022, 8:20 pm UTC
 *
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $author
 */
class NewCall extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'new_calls';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'description',
        'image',
        'author'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'image' => 'string',
        'author' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'description' => 'required',
        'author' => 'required'
    ];

    protected $hidden = [
       
        "updated_at",
        "deleted_at"
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'author','id');
    }
    
}
