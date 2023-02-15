<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Country;
use App\Models\DonationHistory;
use App\Models\DonationPoint;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

use Illuminate\Support\Facades\Auth;

class DonationRepository extends BaseRepository
{
     /**
     * @var array
     */
    protected $fieldSearchable = [

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
        return DonationPoint::class;
    }

    public function list()
    {
        return DonationPoint::with('city')->orderBy("id","asc")->get();
    }

    public function createDonationCenter()
    {
        return City::get()->pluck('name', 'id');
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            DonationPoint::create($data);
            DB::commit();
            
            return 'ok';
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            return 'Register Failed ' .$ex->getMessage();
        }

       
    }

    public function update($data,$id)
    {
        try {
            DB::beginTransaction();
            $donation_point=DonationPoint::find($id);
            $data['status']= isset($data['status']) == null ? false : true;
            $donation_point->update($data);
            DB::commit();
            return 'ok';
           
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }

    public function show($id)
    {
        return DonationPoint::find($id);
    }

    

}