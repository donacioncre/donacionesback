<?php

namespace App\Repositories;

use App\Models\BloodDonationHour;
use App\Repositories\BaseRepository;

/**
 * Class BloodDonationHourRepository
 * @package App\Repositories
 * @version December 12, 2022, 9:08 pm UTC
*/

class BloodDonationHourRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'days',
        'start_time',
        'end_time'
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
