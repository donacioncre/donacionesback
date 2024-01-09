<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DonationRepository;
use App\Repositories\DonationRequirementsRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonationRequirementsController extends Controller
{


    private $successStatus = 200;
    private $errorStatus = 500;
    protected $donation;

    public function __construct(DonationRequirementsRepository $donation)
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

    public function show($id)
    {
        try {
            $data = $this->donation->show($id);
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            return response()->json(['status' => false, 'error' => 'Algo a sucedido por favor intente después de unos minutos', 'message' => $ex->getMessage()], $this->errorStatus);
        }
    }
}
