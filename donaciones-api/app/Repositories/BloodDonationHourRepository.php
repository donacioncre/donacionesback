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

        //return $this->bloodDonationHour->with('donation')->get();
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
