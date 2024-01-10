<?php

namespace App\Repositories;

use App\Models\City;
use App\Models\Convocation;
use App\Models\Country;
use App\Models\DonationPoint;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ConvocationRepository extends BaseRepository
{


     /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    protected $donation,$convocation;


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
        return Convocation::class;
    }

    public function list()
    {
        $data=[];
        $convocation=[];
        $user =Auth::user();
        $user_id=$user->id;
        if ($user->roles->first()->name == 'admin' || $user->roles->first()->name == 'donante') {
            $convocation = Convocation::with('donation')->orderBy("id","asc")->get();
        }
        if ($user->roles->first()->name == 'user') {

            $userCenterDonation =  DonationPoint::whereHas('userDonationCenter', function($q) use($user_id)
            {
                $q->where('user_id','=', $user_id);
            })->first();
            $convocation = Convocation::with('donation')->where('donation_id', $userCenterDonation->id)->orderBy("id","asc")->get();
        }

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

    public function createConvocation()
    {
        $user =Auth::user();
        $user_id=$user->id;
        if ($user->roles->first()->name == 'admin') {
            return DonationPoint::with('userDonationCenter')->get()->pluck('name', 'id');
        } else {

            return DonationPoint::whereHas('userDonationCenter', function($q) use($user_id)
            {
                $q->where('user_id','=', $user_id);

            })->get()->pluck('name', 'id');
        }

        return DonationPoint::get()->pluck('name', 'id');
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $convocation =  Convocation::create($data);
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
            $convocation= Convocation::find($id);
            $convocation->update($data);
            DB::commit();
            return  $convocation;

        } catch (Exception $ex) {
            DB::rollBack();
            return 'Register Failed ' .$ex->getMessage();
        }
    }

    public function show($id)
    {
        $data=[];
        $convocation = Convocation::with('donation')->find($id);

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
