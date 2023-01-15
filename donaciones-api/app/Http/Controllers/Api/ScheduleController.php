<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\BenefitDonatingRepository;
use App\Repositories\CountryRepository;
use App\Repositories\DonationRepository;
use App\Repositories\ScheduleRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{


    private $successStatus = 200;
    private $errorStatus = 500;
    protected $schedule, $country;

    public function __construct(ScheduleRepository $schedule, CountryRepository $country)
    {
        $this->schedule = $schedule;
        $this->country=$country;
    }

    public function index()
    {
        try {
            $data = $this->schedule->all();
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            dd($ex);
            return response()->json(['status' => false, 'error' => 'Algo a sucedido por favor intente después de unos minutos', 'message' => $ex->getMessage()], $this->errorStatus);
        }
    }


    public function listCountry()
    {
        try {
            $data = $this->country->list();
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            dd($ex);
            return response()->json([
                'status' => false,
                'error' => 'Algo a sucedido por favor intente después de unos minutos',
                'message' => $ex->getMessage()
            ], $this->errorStatus);
        }
    }

    public function listCity($id)
    {
        try {

            $data = $this->schedule->listCities($id);
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            dd($ex);
            return response()->json([
                'status' => false,
                'error' => 'Algo a sucedido por favor intente después de unos minutos',
                'message' => $ex->getMessage()
            ], $this->errorStatus);
        }
    }

    public function listDonationCenter($id)
    {
        try {

            

            $data = $this->schedule->listDonationCenter($id);
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            dd($ex);
            return response()->json([
                'status' => false,
                'error' => 'Algo a sucedido por favor intente después de unos minutos',
                'message' => $ex->getMessage()
            ], $this->errorStatus);
        }
    }

    public function listTimeDonation(Request $request,$id)
    {
        try {

            $data = $this->schedule->dateDonation($request->all(), $id);
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            dd($ex);
            return response()->json([
                'status' => false,
                'error' => 'Algo a sucedido por favor intente después de unos minutos',
                'message' => $ex->getMessage()
            ], $this->errorStatus);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                //'entity_1' => 'required',
                //'entity_2' => 'required',
            ]
        );


        if ($validator->fails()) {
           return response()->json(['status' => false, 'error' => $validator->errors()], 500);
        }


        $input=$request->all();

        $input['user_id']= Auth::user()->id;
        $input['type_donation']=$request->donation_type;

        $data= $this->schedule->store($input);

        if ($data[0]=='ok') {
             return response()->json([
                 'status' =>  $this->successStatus,
                 'message' => 'Successfully',
                 'schedule_id' => $data[1],
             ], 200);
        } else {
             return response()->json([
                 'status' =>  $this->errorStatus,
                 'message' => $data
             ], 500);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = $this->schedule->show($id);
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            dd($ex);
            return response()->json([
                'status' => false,
                'error' => 'Algo a sucedido por favor intente después de unos minutos',
                'message' => $ex->getMessage()
            ], $this->errorStatus);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                //'entity_1' => 'required',
                //'entity_2' => 'required',
            ]
        );


        if ($validator->fails()) {
           return response()->json(['status' => false, 'error' => $validator->errors()], 500);
        }


        $input=$request->all();

        $input['user_id']= Auth::user()->id;
        $input['type_donation']=$request->donation_type;

        $data= $this->schedule->update($input,$id);

        if ($data[0]=='ok') {
             return response()->json([
                 'status' =>  $this->successStatus,
                 'message' => 'Successfully',
                 'schedule_id' => $data[1],
             ], 200);
        } else {
             return response()->json([
                 'status' =>  $this->errorStatus,
                 'message' => $data
             ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
