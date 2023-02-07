<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\DonationRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Flash;


class DonationController extends Controller
{
    
    
    private $successStatus = 200;
    private $errorStatus = 500;
    protected $donation;

    public function __construct(DonationRepository $donation)
    {
        $this->middleware('permission:ver-centroDonacion|crear-centroDonacion|editar-centroDonacion|eliminar-centroDonacion',['only'=>['index']]);
        $this->middleware('permission:crear-centroDonacion',['only'=>['create','store']]);
        $this->middleware('permission:editar-centroDonacion',['only'=>['edit','update']]);
        $this->middleware('permission:eliminar-centroDonacion',['only'=>['destroy']]);
        $this->donation = $donation;
    }

    public function index()
    {
        
            $donations = $this->donation->list();
            
            return view('donation.index')
            ->with('donations', $donations);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities=$this->donation->create();
        return view('donation.create')->with('cities',$cities);
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

        if ($input['whatsapp_number']== null) {
            $input['whatsapp_number'] = 'N/A';
        }

        $donation = $this->donation->store($input);

        Flash::success('Donation saved successfully.');

        return redirect(route('donation.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation = $this->donation->show($id);

        if (empty($donation)) {
            Flash::error('Donation not found');

            return redirect(route('donation.index'));
        }

        return view('donation.show')->with('donation', $donation);
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
        $cities=$this->donation->create();
        if (empty($donation)) {
            Flash::error('Donation not found');

            return redirect(route('Donation.index'));
        }

        return view('donation.edit',compact('cities','donation'));
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
            Flash::error('Donation not found');

            return redirect(route('donation.index'));
        }

        $donation = $this->donation->update($request->all(), $id);

        Flash::success('Donation updated successfully.');

        return redirect(route('donation.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    
}
