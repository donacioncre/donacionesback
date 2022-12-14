<?php

namespace App\Repositories;

use App\Models\BloodDonationHour;
use App\Models\DonationPoint;
use App\Repositories\BaseRepository;
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
        return $this->bloodDonationHour->with('donation')->get();
    }

    public function pointsDonations()
    {
       return $this->pointsDonation->get()->pluck('name', 'id');
    }

    public function days($nameDay)
    {
        return $this->bloodDonationHour->days($nameDay);
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
}
