<?php

namespace App\Repositories;

use App\Models\DonationHistory;
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

    // public function __construct(DonationHistory $donationHistory, Schedule $schedule) {
    //     $this->donationHistory = $donationHistory;
    //     $this->schedule = $schedule;
    // }

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

    // public function store($data)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $model = DonationHistory->create($data);
    //         DB::commit();

    //         return 'ok';
    //     } catch (Exception $ex) {
    //         DB::rollBack();
    //         return 'Register Failed ' .$ex->getMessage();
    //     }


    // }

    public function list()
    {
        $user_id=Auth()->user()->id;


        return DonationHistory::get();
    }

    public function  listUser()
    {
        $user_id=Auth()->user()->id;
        $array_donation=[];
        
        $donation_histories=Schedule::with('donationHistory')->where('user_id',$user_id)
                            ->orderBy('donation_date','asc')->get();
        foreach($donation_histories as $key => $donation){

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
}
