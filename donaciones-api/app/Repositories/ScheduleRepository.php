<?php

namespace App\Repositories;

use App\Models\DonationPoint;
use App\Models\Questions;
use App\Models\Schedule;
use App\Repositories\BaseRepository;

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

    protected $schedule,$donation,$user;

    public function __construct(Schedule $schedule, DonationPoint $donation) {
        $this->schedule = $schedule;
        $this->donation = $donation;
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

    
}
