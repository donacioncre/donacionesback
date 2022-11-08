<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Convocation;
use App\Models\Country;
use App\Models\DonationPoint;
use Illuminate\Support\Facades\DB;
use Exception;

class ConvocationRepository
{
    protected $convocation,$donation,$city;

    public function __construct(Convocation $convocation, DonationPoint $donation)
    {
        $this->convocation=$convocation;
        $this->donation=$donation;
       
    }

    public function list()
    {
        return $this->convocation::with('city')->get();
    }

    public function create()
    {
        return $this->donation->get();
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $this->convocation->create($data);
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
            $data=$this->convocation->find($id);
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
        return $this->convocation->with('donation')->find($id);
    }

}