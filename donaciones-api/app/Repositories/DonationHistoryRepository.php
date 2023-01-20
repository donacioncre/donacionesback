<?php

namespace App\Repositories;

use App\Models\DonationHistory;
use App\Models\Schedule;
use App\Repositories\BaseRepository;
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

    public function listUser()
    {
        $user_id=Auth()->user()->id;
        $data = DonationHistory::with(['schedule'=> function ($query) use($user_id)
                    {
                        $query->where('user_id',$user_id);
                    }
        ])->where('status',true)->get();

        return $data;
    }
}
