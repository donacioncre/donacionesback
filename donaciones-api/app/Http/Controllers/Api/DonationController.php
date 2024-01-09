<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DonationRepository;
//use Barryvdh\DomPDF\PDF;
//use Barryvdh\DomPDF\PDF as PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;



class DonationController extends Controller
{

    private $errorStatus = 500;
    protected $donation;

    public function __construct(DonationRepository $donation)
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
}
