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
    private $successStatus = 200;
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
    public function index(Request $request)
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

    /**
     * Store a newly created DonationHistory in storage.
     * POST /donationHistories
     *
     * @param CreateDonationHistoryAPIRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $donationHistory = $this->donationHistoryRepository->create($input);

        return $this->sendResponse($donationHistory->toArray(), 'Donation History saved successfully');
    }

    /**
     * Display the specified DonationHistory.
     * GET|HEAD /donationHistories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DonationHistory $donationHistory */
        $donationHistory = $this->donationHistoryRepository->find($id);

        if (empty($donationHistory)) {
            return $this->sendError('Donation History not found');
        }

        return $this->sendResponse($donationHistory->toArray(), 'Donation History retrieved successfully');
    }

    /**
     * Update the specified DonationHistory in storage.
     * PUT/PATCH /donationHistories/{id}
     *
     * @param int $id
     * @param UpdateDonationHistoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        /** @var DonationHistory $donationHistory */
        $donationHistory = $this->donationHistoryRepository->find($id);

        if (empty($donationHistory)) {
            return $this->sendError('Donation History not found');
        }

        $donationHistory = $this->donationHistoryRepository->update($input, $id);

        return $this->sendResponse($donationHistory->toArray(), 'DonationHistory updated successfully');
    }

    /**
     * Remove the specified DonationHistory from storage.
     * DELETE /donationHistories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DonationHistory $donationHistory */
        $donationHistory = $this->donationHistoryRepository->find($id);

        if (empty($donationHistory)) {
            return $this->sendError('Donation History not found');
        }

        $donationHistory->delete();

        return $this->sendSuccess('Donation History deleted successfully');
    }
}
