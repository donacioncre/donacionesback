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



    public function donationCenterCountry($data)
    {
        $donation=[];
        $country= isset($data['country_id']) ? $data['country_id']: null;
       
        $donation = $this->donation_point->whereHas('city', function ($q) use($country) {
            $q->Where('country_id',$country);
        })->get();
 
        return $donation;
    }

    public function DonationCenter($data)
    {
        //$user_id= isset($data['user_id']) ? $data['user_id']: null;
        $donation_id = isset($data['donation_id']) ? $data['donation_id']: null;

        //$user = $this->listUserDonors();

        $donations = DonationPoint::with('schedule')->find($donation_id);

       

        $donation_historial=[];
        $donors= [];

       

        if(count($donations->schedule )){
            foreach($donations->schedule as $key => $value){
                $donors[] =  [
                    'id'=>$value->user->id,
                    'name'=>$value->user->firstname .' '.$value->user->lastname .' '.$value->user->identification,
                ];

                if(count($value->donationHistory)){
                    foreach ($value->donationHistory as $key => $itemHistory) {
                        $donation_historial[] =[
                            'name' =>$value->user->firstname .' '.$value->user->lastname,
                            'identification'=>$value->user->identification,
                            'code' => $itemHistory->code,
                            'hemoglobin' => $itemHistory->code,
                            'weight' => $itemHistory->code,
                            'blood_pressure' => $itemHistory->code,
                            'status' => $itemHistory->code,
                            'note' => $itemHistory->note,
                            'date_time' => $value->donation_date . ' '.$value->donation_time,
                            'donation_type' => $value->type_donation
                        ];
                    }
                    
                }
            }
            
        }

       
        $donors = array_map("unserialize", array_unique(array_map("serialize", $donors)));
       
       
        return ['donation_historial'=>$donation_historial,'donors'=>$donors];

    }


    public function listCountry()
    {
        return $this->country->get();
    }

    public function listUserDonors()
    {
        return   User::whereHas("roles", function($q){ $q->where("name", "donante"); })->get();
    }

   

    public function show($id)
    {
        return $this->donation_point->find($id);
    }

    

}