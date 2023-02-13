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
 
class BenefitDonatingRepository  extends BaseRepository
{
     /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'details'
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
        return BenefitDonating::class;
    }

    public function list()
    {
        return BenefitDonating::with('donation_details')->get();
    }

   

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $benefit = BenefitDonating::create($data);

            foreach($data['points'] as $key=> $value){

                BenefitDetails::create([
                    'benefit_id' => $benefit->id,
                    'points' => $value
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
            $benefit= BenefitDonating::find($id);
            $benefit->update($data);

            BenefitDetails::where('benefit_id',$benefit->id)->delete();

            foreach($data['points'] as $key=> $value){

                BenefitDetails::create([
                    'benefit_id' => $benefit->id,
                    'points' => $value
                ]);
            }
            
            DB::commit();
            return 'ok';
           
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }

    public function show($id)
    {
        return BenefitDonating::with('donation_details')->find($id);
    }

}
