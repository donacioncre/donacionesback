<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Country;
use App\Models\DonationPoint;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Repositories\BaseRepository;

class CityRepository extends BaseRepository
{
    protected $country,$donation,$city;

    // public function __construct(City $city, Country $country, DonationPoint $donation)
    // {
    //     $this->country=$country;
    //     $this->donation=$donation;
    //     $this->city=$city;
    // }

    protected $fieldSearchable = [
       
    ];
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }
    public function model()
    {
        return City::class;
    }

    public function list()
    {
        return City::with('country')->get();
    }

    public function createCity()
    {
        return Country::get()->pluck('name', 'id');
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            City::create($data);
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
            $city=City::find($id);
            $city->update($data);
            DB::commit();
            return 'ok';
           
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }

    public function show($id)
    {
        return City::find($id);
    }

}