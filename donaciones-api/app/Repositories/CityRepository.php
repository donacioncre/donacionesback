<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Country;
use App\Models\DonationPoint;
use Illuminate\Support\Facades\DB;
use Exception;

class CountryRepository
{
    protected $country,$donation,$city;

    public function __construct(City $city, Country $country, DonationPoint $donation)
    {
        $this->country=$country;
        $this->donation=$donation;
        $this->city=$city;
    }

    public function list()
    {
        return $this->country->get();
    }

    public function create()
    {
        return $this->country->get();
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $this->country->create($data);
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
            $data=$this->country->find($id);
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
        return $this->country->find($id);
    }

}