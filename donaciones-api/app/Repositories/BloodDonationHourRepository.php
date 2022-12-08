<?php

namespace App\Repositories;

use App\Models\BloodDonationHour;
use App\Repositories\BaseRepository;

/**
 * Class QuestionsRepository
 * @package App\Repositories
 * @version November 23, 2022, 1:05 am UTC
*/

class QuestionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'days',
        'start_time',
        'end_time',
    ];

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
}
