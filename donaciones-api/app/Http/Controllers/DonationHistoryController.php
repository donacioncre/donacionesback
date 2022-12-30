<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDonationHistoryRequest;
use App\Http\Requests\UpdateDonationHistoryRequest;
use App\Repositories\DonationHistoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class DonationHistoryController extends AppBaseController
{
    /** @var DonationHistoryRepository $donationHistoryRepository*/
    private $donationHistoryRepository;

    public function __construct(DonationHistoryRepository $donationHistoryRepo)
    {
        $this->donationHistoryRepository = $donationHistoryRepo;
    }

    /**
     * Display a listing of the DonationHistory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $donationHistories = $this->donationHistoryRepository->list();

      

        return view('donation_histories.index')
            ->with('donationHistories', $donationHistories);
    }

    /**
     * Show the form for creating a new DonationHistory.
     *
     * @return Response
     */
    public function create()
    {
        $schedules= $this->donationHistoryRepository->getScheduleUser();
        //dd($schedules);
        return view('donation_histories.create')->with('schedules',$schedules);
    }

    /**
     * Store a newly created DonationHistory in storage.
     *
     * @param CreateDonationHistoryRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $donationHistory = $this->donationHistoryRepository->store($input);

        Flash::success('Donation History saved successfully.');

        return redirect(route('donationHistories.index'));
    }

    /**
     * Display the specified DonationHistory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $donationHistory = $this->donationHistoryRepository->find($id);

        if (empty($donationHistory)) {
            Flash::error('Donation History not found');

            return redirect(route('donationHistories.index'));
        }

        return view('donation_histories.show')->with('donationHistory', $donationHistory);
    }

    /**
     * Show the form for editing the specified DonationHistory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $donationHistory = $this->donationHistoryRepository->find($id);

        if (empty($donationHistory)) {
            Flash::error('Donation History not found');

            return redirect(route('donationHistories.index'));
        }

        return view('donation_histories.edit')->with('donationHistory', $donationHistory);
    }

    /**
     * Update the specified DonationHistory in storage.
     *
     * @param int $id
     * @param UpdateDonationHistoryRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $donationHistory = $this->donationHistoryRepository->find($id);

        if (empty($donationHistory)) {
            Flash::error('Donation History not found');

            return redirect(route('donationHistories.index'));
        }

        $donationHistory = $this->donationHistoryRepository->update($request->all(), $id);

        Flash::success('Donation History updated successfully.');

        return redirect(route('donationHistories.index'));
    }

    /**
     * Remove the specified DonationHistory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $donationHistory = $this->donationHistoryRepository->find($id);

        if (empty($donationHistory)) {
            Flash::error('Donation History not found');

            return redirect(route('donationHistories.index'));
        }

        $this->donationHistoryRepository->delete($id);

        Flash::success('Donation History deleted successfully.');

        return redirect(route('donationHistories.index'));
    }
}
