<?php

namespace App\Repositories;

use App\Models\PlateletDonationHour;
use App\Models\DonationPoint;
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
