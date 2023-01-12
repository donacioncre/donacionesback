<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Country;
use App\Models\DonationPoint;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

use Illuminate\Support\Facades\Auth;

class ConsultRepository
{
    protected $country,$donation_point,$city,$user;

    public function __construct(City $city, Country $country, DonationPoint $donation_point,User $user)
    {
        $this->country=$country;
        $this->donation_point=$donation_point;
        $this->city=$city;
        $this->user = $user;
    }



    public function getDonationCenter($data)
    {
        $donation=[];
        $country= isset($data['country_id']) ? $data['country_id']: null;
       
        $donation = $this->donation_point->whereHas('city', function ($q) use($country) {
            $q->Where('country_id',$country);
        })->get();
 
        return $donation;
    }

    public function listCountry()
    {
        return $this->country->get();
    }

    public function list()
    {
        return $this->donation_point::with('city')->get();
    }

    public function create()
    {
        return $this->city->get()->pluck('name', 'id');
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $this->donation_point->create($data);
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
            $data=$this->donation_point->find($id);
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
        return $this->donation_point->find($id);
    }

    public function digitalDonationCard()
    {
        $user = Auth::user();

        return $user;
    }

}