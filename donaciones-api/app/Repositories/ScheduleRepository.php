<?php

namespace App\Repositories;

use App\Mail\AppointmentCancel;
use App\Mail\AppointmentCancelDonationCenter;
use App\Mail\AppointmentConfirmation;
use App\Mail\AppointmentDonationCenter;
use App\Mail\AppointmentReschedule;
use App\Mail\AppointmentRescheduleDonationCenter;
use App\Models\BloodDonationHour;
use App\Models\City;
use App\Models\DonationPoint;
use App\Models\PlateletDonationHour;
use App\Models\Questions;
use App\Models\Schedule;
use App\Models\User;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Class QuestionsRepository
 * @package App\Repositories
 * @version November 23, 2022, 1:05 am UTC
*/

class ScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    protected $schedule,$donation,$user,$city,$bloodDonationHour, $plateletDonationHour;

    public $email_user='estevez.desarrollo@gmail.com';

    public function __construct(Schedule $schedule, DonationPoint $donation, City $city, 
                                    BloodDonationHour $bloodDonationHour, User $user, PlateletDonationHour $plateletDonationHour  ) {
        $this->schedule = $schedule;
        $this->donation = $donation;
        $this->city = $city;
        $this->bloodDonationHour=$bloodDonationHour;
        $this->user=$user;
        $this->plateletDonationHour= $plateletDonationHour;
    }
    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Schedule::class;
    }

    public function listDonationPoint()
    {
        return $this->donation->get();
    }

    public function listCities($id)
    {
        $data= $this->city::where('country_id',$id)->get();

        return $data;
    }

    public function listDonationCenter($id)
    {

        $data= $this->donation::where('city_id',$id)->get();

      

        return $data;
    }

    public function dateDonation($data,$id)
    {
        $date = Carbon::parse($data['date']);
        $dataSchedule=[];
        $date_time=[];
        $numDay= date('w',strtotime($data['date']));

        if ($data['donation_type']== "plaqueta") {
            $donationHour = $this->plateletDonationHour->with('plateletDonorAppointment')
                        ->where('donation_id',$id)
                        ->where('days',$numDay)->first();
            if (!is_object($donationHour)){
                return "Sin Horario";
            }

            foreach ($donationHour->plateletDonorAppointment as $key => $value) {

                $dataSchedule=$this->schedule->where('donation_date',$date)
                        ->where('donation_time',$value->time)->get();
    
                if (count($dataSchedule)  < $value->amount) {
                    $date_time[]= $value->time;
                }
              
            }

        }
        if ($data['donation_type']== "sangre"){
            $donationHour = $this->bloodDonationHour->with('bloodDonorAppointment')
                        ->where('donation_id',$id)->where('days',$numDay)->first();
            
            if (!is_object($donationHour)){
                return "Sin Horario";
            }
            foreach ($donationHour->bloodDonorAppointment as $key => $value) {

                $dataSchedule=$this->schedule->where('donation_date',$date)
                        ->where('donation_time',$value->time)->get();
    
                if (count($dataSchedule)  < $value->amount) {
                    $date_time[]= $value->time;
                }
                
            }
        }
        
        return  $date_time;
       
    }


    public function store($data)
    {
        try {
            DB::beginTransaction();
            $schedule=$this->schedule->create($data);
            DB::commit();
            
            $email=[
                'name' => $schedule->user->firstname,
                'lastname' => $schedule->user->lastname,
                'blood_type' => $schedule->user->blood_type,
                'phone_number' => $schedule->user->phone_number,
                'email' => $schedule->user->email,
                'date_birth' => Carbon::parse($schedule->user->date_birth)->format('d/m/Y'),
                'country' => $schedule->user->country,
                'city' => $schedule->user->city,

                //hemocentro
                'donation_center' => $schedule->donation->name,
                'address' => $schedule->donation->address,
                'donation_type' =>$schedule->type_donation ,
                'phone' => $schedule->donation->phone,
                'email' => $schedule->donation->email,
                'donation_date' => Carbon::parse($schedule->donation_date)->format('d/m/Y'),
                'donation_time' => $schedule->donation_time,
            ];

            //user donation
            $dataEmail=new AppointmentConfirmation($email);
            //$response = Mail::to($schedule->user->email)->send($dataEmail);
            $response=Mail::to($this->email_user)->send($dataEmail);
            //donation center
            $dataEmail=new AppointmentDonationCenter($email);
            //$response = Mail::to($schedule->donation->email)->send($dataEmail);
            $response=Mail::to($this->email_user)->send($dataEmail);


            return ['ok',$schedule->id];
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }


    }

    public function show($id)
    {
        $data= $this->schedule->with('donation')->with('user')->find($id);

        return[
            'schedule_id' =>$data->id,
            'name' => $data->user->firstname,
            'lastname' => $data->user->lastname,
            'blood_type' => $data->user->blood_type,
            'phone_number'=>$data->user->phone_number,
            'email' => $data->user->email,
            'date_birth' => $data->user->date_birth,
            'country_id' => $data->donation->city->country->id,
            'country' => $data->donation->city->country->name,
            'city_id' => $data->donation->city->id,
            'city' => $data->donation->city->name,
            'donation_center_id' => $data->donation->id,
            'donation_center' => $data->donation->name,
            'address' => $data->donation->address,
            'phone_center' => $data->donation-> phone,
            'email_center' => $data->donation->email,
            'donation_date'=>$data->donation_date,
            'donation_time' => $data->donation_time,
            'donation_type' => $data->type_donation,
        ];
    }


    public function update($data,$id)
    {
        try {
            DB::beginTransaction();
            $schedule=$this->schedule->with('user')->find($id);
            $schedule->update($data);

            DB::commit();
            $email=[
                'name' => $schedule->user->firstname,
                'lastname' => $schedule->user->lastname,
                'blood_type' => $schedule->user->blood_type,
                'phone_number' => $schedule->user->phone_number,
                'email' => $schedule->user->email,
                'date_birth' => Carbon::parse($schedule->user->date_birth)->format('d/m/Y'),
                'country' => $schedule->user->country,
                'city' => $schedule->user->city,
    
                //hemocentro
                'donation_center' => $schedule->donation->name,
                'address' => $schedule->donation->address,
                'donation_type' =>$schedule->type_donation ,
                'phone' => $schedule->donation->phone,
                'email' => $schedule->donation->email,
                'donation_date' => Carbon::parse($schedule->donation_date)->format('d/m/Y'),
                'donation_time' => $schedule->donation_time,
            ];
    
            $dataEmail=new AppointmentReschedule($email);
            //$response = Mail::to($schedule->user->email)->send($dataEmail);
            $response=Mail::to($this->email_user)->send($dataEmail);
            //donation center
            $dataEmail=new AppointmentRescheduleDonationCenter($email);
            //$response = Mail::to($schedule->donation->email)->send($dataEmail);
            $response=Mail::to($this->email_user)->send($dataEmail);

            return ['ok',$schedule->id,$schedule->user->id];
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }

    public function updateState($data,$id)
    {
        try {
            DB::beginTransaction();
            $schedule=$this->schedule->with('user')->find($id);
            $schedule->update(['status'=>$data]);
            DB::commit();

            return ['ok',$schedule->id,$schedule->user->id];
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }



    public function create_time_range($start, $end, $interval = '30 mins', $format = '24') {
        $startTime = strtotime($start);
        $endTime   = strtotime($end);
        $returnTimeFormat = ($format == '12')?'g:i:s A':'G:i:s';

        $current   = time();
        $addTime   = strtotime('+'.$interval, $current);
        $diff      = $addTime - $current;

        $times = array();
        while ($startTime < $endTime) {
            $times[] = $startTime; //date($returnTimeFormat, $startTime);
            $startTime += $diff;
        }

        $times[] = $startTime; //date($returnTimeFormat, $startTime);

        return $times;
    }

    public function formatTime($data)
    {
        $returnTimeFormat='G:i:s';
        foreach($data as $value){
            $dataFormat []=date($returnTimeFormat, $value);
        }

        return $dataFormat;
    }

    public function showScheduleDonation($id)
    {
        $donation=$this->donation->with('schedule')->with('donationHour')->find($id);

        return $donation;
    }

    public function listScheduleDonationUser()
    {
        $scheduel_data=[];
        $user_id=Auth()->user()->id;
        $donation=$this->schedule->with('donation')->with('user')
                    ->where('user_id',$user_id)->where('status',true)->orderBy('donation_date','asc')->get();

        foreach($donation as $value){

            $scheduel_data[]=[
                'id'=> $value->id,
                'place' => $value->donation->name,
                'address'=> $value->donation->address,
                'donation_date'=>$value->donation_date,
                'donation_time' =>$value->donation_time,
            ];
        }

        return $scheduel_data;
    }

    public function cancelScheduleDonationUser($id)
    {
        $schedule=$this->schedule->find($id);
        $schedule->update(['status'=>false]);

        $email=[
            'name' => $schedule->user->firstname,
            'lastname' => $schedule->user->lastname,
            'blood_type' => $schedule->user->blood_type,
            'phone_number' => $schedule->user->phone_number,
            'email' => $schedule->user->email,
            'date_birth' => Carbon::parse($schedule->user->date_birth)->format('d/m/Y'),
            'country' => $schedule->user->country,
            'city' => $schedule->user->city,

            //hemocentro
            'donation_center' => $schedule->donation->name,
            'address' => $schedule->donation->address,
            'donation_type' =>$schedule->type_donation ,
            'phone' => $schedule->donation->phone,
            'email' => $schedule->donation->email,
            'donation_date' => Carbon::parse($schedule->donation_date)->format('d/m/Y'),
            'donation_time' => $schedule->donation_time,
        ];

        $dataEmail=new AppointmentCancel($email);
        //$response = Mail::to($schedule->user->email)->send($dataEmail);
        $response=Mail::to($this->email_user)->send($dataEmail);
        //donation center
        $dataEmail=new AppointmentCancelDonationCenter($email);
        //$response = Mail::to($schedule->donation->email)->send($dataEmail);
        $response=Mail::to($this->email_user)->send($dataEmail);
        return $schedule;
    }

    public function getNameUser()
    {
        $user =$this->user->get(['firstname','lastname','id']);

        return $user;
    }

    public function getInfoUser($id)
    {
        return $this->user->find($id);
    }
}
