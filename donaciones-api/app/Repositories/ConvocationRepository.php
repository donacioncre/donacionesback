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
        $data=[];
        $convocation = $this->convocation::with('donation')->orderBy("id","asc")->get();
        foreach($convocation as $key=> $value){
            $data[]=[
                'id' => $value->id,
                'title' => $value->title,
                'blood_type' => $value->blood_type,
                'place' => $value->donation->name,
                'country_city' => $value->donation->city->country->name .', ' .$value->donation->city->name,
                'start_date' => $value->start_date
            ];
        }
        return  $data;
    }

    public function create()
    {
        return $this->donation->get()->pluck('name', 'id');
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $convocation =  $this->convocation->create($data);
            DB::commit();
            
            return $convocation;
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }

       
    }

    public function update($data,$id)
    {
        try {
            DB::beginTransaction();
            $convocation=$this->convocation->find($id);
            $convocation->update($data);
            DB::commit();
            return 'ok';
           
        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }

    public function show($id)
    {
        $data=[];
        $convocation = $this->convocation->with('donation')->find($id);
        
        if (is_object($convocation)) {
            $data=[
                'id' =>$convocation->id,
                'title' => $convocation->title,
                'blood_type' => $convocation->blood_type,
                'place' => $convocation->donation->name,
                'country_city' => $convocation->donation->city->country->name .', ' .$convocation->donation->city->name,
                'start_date' => $convocation->start_date,
                'end_date' => $convocation->end_date,
                'longitude' => $convocation->donation->longitude,
                'latitude' => $convocation->donation->latitude,
                'address' => $convocation->donation->address,
                'phone' => $convocation->donation->phone,
                'email' => $convocation->donation->email,
                'donation_id' =>$convocation->donation->id,
                'whatsapp_number' => $convocation->donation->whatsapp_number,

            ];
        }
            
        
        return  $data;
    }

}