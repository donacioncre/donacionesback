<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\ConsultRepository;
use App\Repositories\DonationRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Flash;


class ConsultController extends Controller
{
    
    
    private $successStatus = 200;
    private $errorStatus = 500;
    protected $donationRepo;

    public function __construct(ConsultRepository $donationRepo)
    {
        $this->donationRepo = $donationRepo;
    }

     /*
     *  Ver Centros de donacion y filtrar por : provincia, nombre.
     */
    public function index(Request $request)
    {
            $input=$request->all();
            $donations = $this->donationRepo->getDonationCenter($input);
            $countries= $this->donationRepo->listCountry();
            
            return view('consult.donation_centers',compact('countries','input'))
            ->with('donations', $donations);
        
    }

   
   
}
