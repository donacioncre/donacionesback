<?php

namespace App\Repositories;

use App\Models\BenefitDonating;
use App\Models\benefitDetails;
use App\Models\DonationDetails;
use App\Models\DonationRequirements;
use App\Models\RequirementsDetails;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class BenefitDonatingRepository
 * @package App\Repositories
 * @version November 16, 2022, 10:16 pm UTC
*/
 
class DonationRequirementsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'image'
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
        return DonationRequirements::class;
    }

   

    public function list()
    {
        return DonationRequirements::with('donation_details')->get();
    }

    

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $requirement = DonationRequirements::create($data);

            foreach($data['details_requirem'] as $key=> $value){

                RequirementsDetails::create([
                    'requirement_id' => $requirement->id,
                    'points' => $value['points'],
                    'points_details' => $value['points_details'],
                    'image' => $value['image'],
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
            $requirement=DonationRequirements::find($id);
            $requirement->update($data);
            DB::commit();
            return 'ok';
           
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }

    public function show($id)
    {
        return DonationRequirements::with('requirement_details')->find($id);
    }

}
