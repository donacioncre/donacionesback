<?php

namespace App\Repositories;

use App\Models\BenefitDonating;
use App\Models\benefitDetails;
use App\Models\DonationDetails;
use App\Models\MythDetails;
use App\Models\Myths;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class BenefitDonatingRepository
 * @package App\Repositories
 * @version November 16, 2022, 10:16 pm UTC
*/
 
class MythRepository 
{
    protected $myth,$detailsMyth;

    public function __construct(Myths $myth, MythDetails $detailsMyth)
    {
        $this->myth=$myth;
        $this->detailsMyth=$detailsMyth;
    }

    public function list()
    {
        return $this->myth::with('myth_details')->get();
    }

    public function create()
    {
        //return $this->benefit->get();
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $this->myth->create($data);
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
            $data=$this->myth->find($id);
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
        return $this->myth::with('myth_details')->find($id);
    }

}
