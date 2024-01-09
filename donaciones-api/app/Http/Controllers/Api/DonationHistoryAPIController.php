<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\API\CreateDonationHistoryAPIRequest;
use App\Http\Requests\API\UpdateDonationHistoryAPIRequest;
use App\Models\DonationHistory;
use App\Repositories\DonationHistoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Exception;
use Response;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Class DonationHistoryController
 * @package App\Http\Controllers\API
 */

class DonationHistoryAPIController extends AppBaseController
{
    /** @var  DonationHistoryRepository */
    private $donationHistoryRepository;
    private $errorStatus = 500;
    public function __construct(DonationHistoryRepository $donationHistoryRepo)
    {
        $this->donationHistoryRepository = $donationHistoryRepo;
    }

    /**
     * Display a listing of the DonationHistory.
     * GET|HEAD /donationHistories
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        try {
            $data = $this->donationHistoryRepository->listUserDonationHistory();

            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            return response()->json(['status' => false, 'error' => 'Algo a sucedido por favor intente después de unos minutos', 'message' => $ex->getMessage()], $this->errorStatus);
        }


    }

    public function digitalDonationCard($date)
    {

        $data = $this->donationHistoryRepository->digitalDonationCard($date);

        $pdf = PDF::loadView('pdf.digital_donation_card',['data'=> $data]);
        $pdf->setPaper('A4', 'landscape');
        return response()->json([
            'status'=>true,
            'pdf' => base64_encode($pdf->output()),
            'filename' => 'DonationCard'
        ],200);

    }
}
