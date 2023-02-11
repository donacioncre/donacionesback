<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\ConsultRepository;
use App\Repositories\DonationRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;

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
            $donations = $this->donationRepo->donationCenterCountry($input);
            $countries= $this->donationRepo->listCountry();
            
           
            $user =Auth::user();

            switch ($user->roles->first()->name) {
                case 'user':
                    $id=Auth::user()->donationCenter->first()->id;
                    return redirect(route('donationCenterDetails',[$id]));
                case 'admin':
                    return view('consult.donation_centers',compact('countries','input'))
                        ->with('donations', $donations);
                    break;
                
            }

          
        
    }

    public function donationCenterDetails(Request $request, $id=0)
    {
            $input=$request->all();

            

            if ($input==[]) {
                $input['date_start'] =null;
                $input['date_end'] = null;
            }
          
            $user =Auth::user();
            switch ($user->roles->first()->name) {
                case 'user':
                        if(count(Auth::user()->donationCenter) ){
                            $input['donation_id'] = Auth::user()->donationCenter->first()->id;
                            $id=Auth::user()->donationCenter->first()->id;
                        }
                case 'admin':
                        $input['donation_id'] = $id;
                    break;
                
            }

            $donations = $this->donationRepo->DonationCenter($input);
            $donors =  $donations['donors'];
            return view('consult.donation_center_details',compact('donors','input','id'))
            ->with('donations', $donations['donation_historial']);
        
    }



   
   
}
