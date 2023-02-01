<?php

namespace App\Repositories;

use App\Models\PlateletDonationHour;
use App\Models\DonationPoint;
use App\Models\PlateletDonorAppointment;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class PlateletDonationHourRepository
 * @package App\Repositories
 * @version December 12, 2022, 9:08 pm UTC
*/

class PlateletDonationHourRepository extends BaseRepository
{
    protected $plateletDonationHour,$pointsDonation;

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'days',
        'start_time',
        'end_time',
        'start_time_1',
        'end_time_1'
    ];

    public function __construct(PlateletDonationHour $plateletDonationHour, DonationPoint $pointsDonation) {
        $this->plateletDonationHour = $plateletDonationHour;
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
        return PlateletDonationHour::class;
    }


    public function list()
    {
        $donation = $this->pointsDonation->with('plateletDonationHour')->get();
        $data=[];
        foreach($donation as $key => $value){

            if (count($value->plateletDonationHour)) {
                $data[]=[
                    'id' => $value->id,
                    'name'=>$value->name,
                    'city'=>$value->city->name,
                    'address'=>$value->address
                ];
            }
        }
        //return $this->PlateletDonationHour->with('donation')->get();
        return $data;
    }

    public function pointsDonations()
    {
       
       $donations=[];
       $data =$this->pointsDonation->with('plateletDonationHour')->get();
       foreach ($data as $key => $value) {
           if (!count($value->plateletDonationHour)) {
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
        return $this->plateletDonationHour->days($nameDay);
    }

    public function weekdays()
    {
        return $this->plateletDonationHour->weekdays();
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $pointsDonation =  $this->pointsDonation->find($data['donation_id']);

            $pointsDonation->update(['platelet' => true]);

           $data = $this->plateletDonationHour->create($data);

        
            DB::commit();
            
            return 'ok';
        } catch (Exception $ex) {
            dd($ex);
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }

       
    }

    public function show($id)
    {
       
        $donations =$this->pointsDonation->with('plateletDonationHour')->find($id);
       
       return $donations;
    }


    public function dateDonation($id)
    {
        $dataTime=[];
        $donationHour = $this->plateletDonationHour->where('donation_id',$id)->get();
       
        
        foreach ($donationHour as $key => $value) {
            $range_time=  '120 mins';
    
                $times = $this->create_time_range($value['start_time'],$value['end_time'],$range_time);
    
                if ($value->start_time_1 != null && $value->end_time_1 != null ) {
                    $times_1=  $this->create_time_range($value['start_time_1'],
                                    $value['end_time_1'],'120 mins');
                    array_push($times, ...$times_1);
                }
                
                $dataTime[] =[$value->days => $this->formatTime($times)] ;

                
               
        }
       
        return $dataTime;


    }

    public function saveTimeDonator($data)
    {
        DB::beginTransaction();
        $donation_hour = $this->plateletDonationHour::where('donation_id',$data['donation_id'])
                                ->where('days',$data['day'])->first();

      
        $data_donor = PlateletDonorAppointment::create([
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
        $donation_hour = $this->plateletDonationHour::where('donation_id',$id)->get();


        foreach ($donation_hour as $key => $value) {
            PlateletDonorAppointment::where('donation_hours_id',$value->id)->delete();
        }
      

        DB::commit();

        return 'OK';
    }

    public function create_time_range($start, $end, $interval = '120 mins', $format = '24') {
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
            
            $this->plateletDonationHour->where('donation_id',$id)->delete();
            DB::commit();
            
            return 'ok';
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }

       
    }
}
