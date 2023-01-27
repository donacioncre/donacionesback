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

class DonationRepository
{
    protected $country,$donation_point,$city,$user;

    public function __construct(City $city, Country $country, DonationPoint $donation_point,User $user)
    {
        $this->country=$country;
        $this->donation_point=$donation_point;
        $this->city=$city;
        $this->user = $user;
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
            $donation_point=$this->donation_point->find($id);
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
        return $this->donation_point->find($id);
    }

    

}