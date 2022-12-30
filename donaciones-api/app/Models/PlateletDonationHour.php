<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;


class PlateletDonationHour extends Model
{
    //use SoftDeletes;

    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'platelet_donation_hours';
    

   // protected $dates = ['deleted_at'];



    public $fillable = [
        'days',
        'start_time',
        'end_time',
        //'start_time_1',
        //'end_time_1',
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

    public function days($nameDay)
    {
        $data=[
            '1' =>'Lunes',
            '2' =>'Martes',
            '3' =>'Miercoles',
            '4'=>'Jueves',
            '5'=>'Viernes',
            '6'=>'Sabado',
            '0'=>'Domingo'
        ];

        return array_search($nameDay,$data);
    }

    public function nameDay($nameDay)
    {
        $data=[
            'Lunes' =>'1',
            'Martes' =>'2',
            'Miercoles' =>'3',
            'Jueves'=>'4',
            'Viernes'=>'5',
            'Sabado'=>'6',
            'Domingo'=>'0'
        ];

        return array_search($nameDay,$data);
    }

    public function weekdays()
    {
        $data=[
            '1' =>'Lunes',
            '2' =>'Martes',
            '3' =>'Miercoles',
            '4'=>'Jueves',
            '5'=>'Viernes',
            '6'=>'Sabado',
            '0'=>'Domingo',
           
        ];

        return $data;
    }

    public function donation()
    {
        return $this->belongsTo(DonationPoint::class,'donation_id','id');
    }
}
