<?php

namespace App\Repositories;

use App\Models\BloodDonationHour;
use App\Models\BloodDonorAppointment;
use App\Models\DonationPoint;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class BloodDonationHourRepository
 * @package App\Repositories
 * @version December 12, 2022, 9:08 pm UTC
*/

class BloodDonationHourRepository extends BaseRepository
{
    protected $bloodDonationHour,$pointsDonation;

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'days',
        'start_time',
        'end_time'
    ];

    public function __construct(BloodDonationHour $bloodDonationHour, DonationPoint $pointsDonation) {
        $this->bloodDonationHour = $bloodDonationHour;
        $this->pointsDonation=$pointsDonation;
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
        return BloodDonationHour::class;
    }


    public function list()
    {
        $donation = $this->pointsDonation->with('donationHour')->get();

        $data=[];
        foreach($donation as $key => $value){

            if (count($value->donationHour)) {
                $data[]=[
                    'id' => $value->id,
                    'name'=>$value->name,
                    'city'=>$value->city->name,
                    'address'=>$value->address
                ];
            }
        }
        return $data;
    }

    public function pointsDonations()
    {

       $donations=[];
       $data =$this->pointsDonation->with('donationHour')->get();
       foreach ($data as $key => $value) {
           if (!count($value->donationHour)) {
               $donations[]=[
                    'name' => $value->name,
                    'id' =>$value->id,
               ];
           }
       }

      return $donations;
    }

    public function days($nameDay)
    {
        return $this->bloodDonationHour->days($nameDay);
    }

    public function weekdays()
    {
        return $this->bloodDonationHour->weekdays();
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();

            $this->bloodDonationHour->create($data);
            DB::commit();

            return 'ok';
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }


    }

    public function show($id)
    {

        $donations =$this->pointsDonation->with('donationHour')->find($id);

       return $donations;
    }

    public function dateDonation($id)
    {
        $dataTime=[];
        $donationHour = $this->bloodDonationHour->where('donation_id',$id)->get();

        foreach ($donationHour as $key => $value) {
            $range_time=  '30 mins';

                $times = $this->create_time_range($value['start_time'],$value['end_time'],$range_time);

                if ($value->start_time_1 != null && $value->end_time_1 != null ) {
                    $times_1=  $this->create_time_range($value['start_time_1'],
                                    $value['end_time_1'],'30 mins');
                    array_push($times, ...$times_1);
                }

                $dataTime[] =[$value->days => $this->formatTime($times)] ;

        }

        return $dataTime;


    }

    public function saveTimeDonator($data)
    {
        DB::beginTransaction();
        $donation_hour = $this->bloodDonationHour::where('donation_id',$data['donation_id'])
                                ->where('days',$data['day'])->first();


        $data_donor = BloodDonorAppointment::create([
            'time' => $data['time'],
            'amount' => $data['num_attention_time'],
            'donation_hours_id'=>$donation_hour->id,
        ]);

        DB::commit();

        return $data_donor;

    }

    public function deleteTimeDonator($id)
    {
        DB::beginTransaction();
        $donation_hour = $this->bloodDonationHour::where('donation_id',$id)->get();


        foreach ($donation_hour as $key => $value) {
            BloodDonorAppointment::where('donation_hours_id',$value->id)->delete();
        }


        DB::commit();

        return 'OK';
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

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $this->bloodDonationHour->where('donation_id',$id)->delete();
            DB::commit();

            return 'ok';
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }


    }
}
