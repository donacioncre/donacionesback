<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\DonationRepository;
use App\Repositories\DonationRequirementsRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Flash;

class DonationRequirementsController extends Controller
{

    protected $donation;

    public function __construct(DonationRequirementsRepository $donation)
    {
        $this->middleware('permission:ver-requerimientos|crear-requerimientos|editar-requerimientos|eliminar-requerimientos',['only'=>['index']]);
        $this->middleware('permission:crear-requerimientos',['only'=>['create','store']]);
        $this->middleware('permission:editar-requerimientos',['only'=>['edit','update']]);
        $this->middleware('permission:eliminar-requerimientos',['only'=>['destroy']]);
        $this->donation = $donation;
    }

    public function index()
    {

        $data = $this->donation->list();

        if (count($data)==0) {
            return view('donation_requirements.create');
        }
        return view('donation_requirements.index')
        ->with('donation', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donation_requirements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $details_request=[];

        for ($i = 1; $i <=$input['num'] ; $i++) {
            $details_request[]=[
                'points' => 'punto',
                'points_details' => 'detalles',
                'image' => 'img',
            ];
        }


        $input['details_requirem'] = $details_request;
        $id= $this->donation->store($input);
        $donation= $this->donation->find($id);

        return redirect(route('donationRequirements.edit',$id))->with('donation', $donation);;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation = $this->donation->find($id);

        if (empty($donation)) {
            Flash::error('Donation Requirements not found');

            return redirect(route('donationRequirements.index'));
        }

        return view('donation_requirements.show')->with('donation', $donation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donation = $this->donation->show($id);

        if (empty($donation)) {
            Flash::error('Donation requirements not found');

            return redirect(route('donationRequirements.index'));
        }

        return view('donation_requirements.edit')->with('donation', $donation);
    }

    public function addPoint($id,Request $request)
    {

        $details=[];
        $input = $request->all();
        for ($i = 1; $i <=$input['num'] ; $i++) {
            $details[]=[
                'points' => 'punto 1',
                'points_details' => 'detalles',
                'image' => 'img_req',
            ];

        }

        $input['item'] = $details;
        $donation = $this->donation->addPoints($input, $id);

        return redirect(route('donationRequirements.edit',$id))->with('donation', $donation);

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
        $donation = $this->donation->show($id);

        if (empty($donation)) {
            Flash::error('Donation Requirements not found');

            return redirect(route('donationRequirements.index'));
        }

        $file = null;
        $details_request=[];

        foreach($request->item as $key => $value){
            if (isset($value['image'])) {
                $img = $value['image'];
                $destinationPath = 'image/donation/';
                $filename = time() . '-' . $img->getClientOriginalName();
                $value['image']->move($destinationPath, $filename);
                $file = $destinationPath . $filename;

            }
            $details_request[]=[
                'points' => $value['points'],
                'points_details' => $value['points_details'],
                'image' => $file,
            ];


            $file = null;
        }

        $requestData=$request->all();

        $requestData['item'] = $details_request;

        $donation = $this->donation->update($requestData, $id);

        Flash::success('Donation Requirements updated successfully.');

        return redirect(route('donationRequirements.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donation = $this->donation->show($id);

        if (empty($donation)) {
            Flash::error('Donation Requirements not found');

            return redirect(route('donationRequirements.index'));
        }

        $this->donation->delete($id);

        Flash::success('Donation Requirements deleted successfully.');

        return redirect(route('donationRequirements.index'));
    }
}
