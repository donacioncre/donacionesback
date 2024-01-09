<?php

namespace App\Repositories;

use App\Models\DonationHistory;
use App\Models\DonationPoint;
use App\Models\Schedule;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class DonationHistoryRepository
 * @package App\Repositories
 * @version December 30, 2022, 1:14 am UTC
*/

class DonationHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'hemoglobin',
        'weight',
        'blood_pressure'
    ];

    protected $donationHistory,$schedule;


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
        return DonationHistory::class;
    }

    public function getScheduleUser()
    {
        return Schedule::get();
    }


    public function list()
    {
        $user=Auth::user();
        $user_id=$user->id;
        if ($user->roles->first()->name == 'admin') {
            return  DonationHistory::get();
        } else {

           //$data_1= [];
           $histories=[];
            $data_donation =  DonationPoint::whereHas('userDonationCenter', function($q) use($user_id)
            {
                $q->where('user_id','=', $user_id);

            })->with('schedule')->first();

            foreach ($data_donation->schedule as $key => $itemSchedule) {
                foreach ($itemSchedule->donationHistory as $key => $itemHistory) {
                    $histories[]=$itemHistory;

                }
            }


            return $histories;
        }


    }


    public function  listUserDonationHistory()
    {
        $user_id=Auth()->user()->id;
        $array_donation=[];
        $donation_data=[];

        $donation_histories=Schedule::with('donationHistory')->where('user_id',$user_id)
                            ->orderBy('donation_date','asc')->get();
        foreach($donation_histories as $key => $donation){

            if (count($donation->donationHistory)) {
                if ($donation->donationHistory->first()->status) {

                    $donation_data[]=[
                        'donation_date' => $donation->donation_date,
                        'type_donation' =>$donation->type_donation,
                        'code'=> $donation->donationHistory->first()->code,
                        'hemoglobin'=> $donation->donationHistory->first()->hemoglobin,
                        'weight'=> $donation->donationHistory->first()->weight,
                        'blood_pressure'=> $donation->donationHistory->first()->blood_pressure,
                    ];
                }
            }


        }

        $array_chunck= array_chunk($donation_data, 8);

        for ($i=0; $i <count($array_chunck) ; $i++) {
            $array_donation[] =[
                'donation_date' => $array_chunck[$i][0]['donation_date'] ,
                'data'=> $array_chunck[$i],
            ];

        }

        return $array_donation;
    }

    public function searchDate($data)
    {

        $donation=[];
        $user =Auth::user();


        switch ($user->roles->first()->name) {
            case 'user':
                $donationCenter= $user->donationCenter->first()->id;

                $donation = Schedule::with('donation')
                    ->with('user')->where('donation_date',$data)->where('status',true)
                    ->where('donation_id',$donationCenter)->get();
                break;
            case 'admin':
                    $donation = Schedule::with('donation')
                        ->with('user')->where('donation_date',$data)->where('status',true)->get();
                break;

        }


        return $donation;
    }

    public function digitalDonationCard($data)
    {
        $user = Auth::user();

        $donation_history=[];
        $data_history = $this->listUserDonationHistory();


        foreach($data_history as $value){
            if ($value['donation_date']==$data) {
                $donation_history=$value["data"];
            }
        }


        return ['user'=>$user,'donation_history'=>$donation_history];
    }
}
