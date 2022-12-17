<?php

namespace App\Repositories;

use App\Models\BloodDonationHour;
use App\Models\City;
use App\Models\DonationPoint;
use App\Models\Questions;
use App\Models\Schedule;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

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

    protected $schedule,$donation,$user,$city,$bloodDonationHour;

    public function __construct(Schedule $schedule, DonationPoint $donation, City $city, BloodDonationHour $bloodDonationHour) {
        $this->schedule = $schedule;
        $this->donation = $donation;
        $this->city = $city;
        $this->bloodDonationHour=$bloodDonationHour;
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
        $dataTime=[];
      
        $date = Carbon::parse($data['date']);
        $dataSchedule=$this->schedule->where('donation_date',$date)->get();


        $numDay= date('w',strtotime($data['date']));
        $donationHour = $this->bloodDonationHour->where('donation_id',$id)->where('days',$numDay)->first();

        if (is_object($donationHour )) {
            $times= $this->create_time_range($donationHour['start_time'],$donationHour['end_time'],'30 mins');

            if(count($dataSchedule)){
                foreach($dataSchedule as   $schedule){
                    
                    $key=array_search(strtotime($schedule['donation_time']),$times,true);

                    if ($key !== false) {
                        unset($times[$key]);
                    }
                }
             $dataTime =$this->formatTime($times);

            }else{
                $dataTime =$this->formatTime($times);
            }


            return $dataTime;
        }else{
            return "Sin Horario";
        }


    }


    public function store($data)
    {
        try {
            DB::beginTransaction();
            $schedule=$this->schedule->create($data);
            DB::commit();

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
            'country' => $data->donation->city->country->name,
            'city' => $data->donation->city->name,
            'donation_center' => $data->donation->name,
            'address' => $data->donation->address,
            'phone_center' => $data->donation-> phone,
            'email_center' => $data->donation->email,
            'donation_date'=>$data->donation_date,
            'donation_time' => $data->donation_time,
        ];
    }


    public function update($data,$id)
    {
        try {
            DB::beginTransaction();
            $schedule=$this->schedule->find($id);
            $schedule->update($data);
            DB::commit();

            return ['ok',$schedule->id];
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
        $schedule=$this->schedule->with('donation')->with('user')->where('donation_id',$id)->get();

        return $schedule;
    }
}
