<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;


class BloodDonorAppointment extends Model
{
    //use SoftDeletes;

    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'blood_donor_appointments';
    

   // protected $dates = ['deleted_at'];



    public $fillable = [
        'amount',
        'time',
        'donation_hours_id',
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

    public function bloodDonationHour()
    {
        return $this->belongsTo(BloodDonationHour::class,'donation_hours_id','id');
    }
}
