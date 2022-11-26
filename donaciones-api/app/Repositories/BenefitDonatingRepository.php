<?php

namespace App\Repositories;

use App\Models\BenefitDonating;
use App\Models\BenefitDetails;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class BenefitDonatingRepository
 * @package App\Repositories
 * @version November 16, 2022, 10:16 pm UTC
*/
 
class BenefitDonatingRepository 
{
    protected $benefit,$detailsBenefit;

    public function __construct(BenefitDonating $benefit, BenefitDetails $detailsBenefit)
    {
        $this->benefit=$benefit;
        $this->detailsBenefit=$detailsBenefit;
    }

    public function list()
    {
        return $this->benefit::with('donation_details')->get();
    }

    public function create()
    {
        //return $this->benefit->get();
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $benefit = $this->benefit->create($data);

            foreach($data['details_benefit'] as $key=> $value){

                $this->detailsBenefit->create([
                    'benefit_id' => $benefit->id,
                    'points' => $value['points']
                ]);
            }

            DB::commit();
            
            return 'ok';
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }

       
    }

    public function update($data,$id)
    {
        try {
            DB::beginTransaction();
            $data=$this->benefit->find($id);
            $data->update($data);
            DB::commit();
            return 'ok';
           
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }

    public function show($id)
    {
        return $this->benefit::with('donation_details')->find($id);
    }

}
