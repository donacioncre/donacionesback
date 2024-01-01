<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DonationRepository;
use App\Repositories\MythRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MythController extends Controller
{


    private $successStatus = 200;
    private $errorStatus = 500;
    protected $donation;

    public function __construct(MythRepository $donation)
    {
        $this->donation = $donation;
    }

    public function index()
    {
        try {
            $data = $this->donation->list();
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            return response()->json(['status' => false, 'error' => 'Algo a sucedido por favor intente después de unos minutos', 'message' => $ex->getMessage()], $this->errorStatus);
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

        $file = null;
        $details_request=[];
        //dd($request);
        foreach($request->details_myth as $key => $value){
            if ($value['image']) {
                $img = $value['image'];
                $destinationPath = 'image/donation/';
                $filename = time() . '-' . $img->getClientOriginalName();
                $value['image']->move($destinationPath, $filename);
                $file = $destinationPath . $filename;

            }

            $details_request[]=[
                'ask' => $value['ask'],
                'answer' => $value['answer'],
                'image' => $file,
            ];

            $file = null;
        }

        $requestData=$request->all();

        $requestData['details_myth'] = $details_request;
        $data= $this->donation->store($requestData);

        if ($data=='ok') {
             return response()->json([
                 'status' =>  $this->successStatus,
                 'message' => 'Successfully'
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
            $data = $this->donation->show($id);
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            return response()->json(['status' => false, 'error' => 'Algo a sucedido por favor intente después de unos minutos', 'message' => $ex->getMessage()], $this->errorStatus);
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
        //
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
