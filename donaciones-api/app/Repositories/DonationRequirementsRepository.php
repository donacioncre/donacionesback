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
 
class DonationRequirementsRepository 
{
    protected $requirement,$detailsRequirement;

    public function __construct(DonationRequirements $requirement, RequirementsDetails $detailsRequirement)
    {
        $this->requirement=$requirement;
        $this->detailsRequirement=$detailsRequirement;
       
    }

    public function list()
    {
        return $this->requirement::with('donation_details')->get();
    }

    public function create()
    {
        //return $this->benefit->get();
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $requirement = $this->requirement->create($data);

            foreach($data['details_requirem'] as $key=> $value){

                $this->detailsRequirement->create([
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
            $data=$this->requirement->find($id);
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
        return $this->requirement::with('requirement_details')->find($id);
    }

}
