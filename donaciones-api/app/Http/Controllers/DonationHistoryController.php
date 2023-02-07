<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDonationHistoryRequest;
use App\Http\Requests\UpdateDonationHistoryRequest;
use App\Repositories\DonationHistoryRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ScheduleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Response;

class DonationHistoryController extends AppBaseController
{
    /** @var DonationHistoryRepository $donationHistoryRepository*/
    private $donationHistoryRepository, $scheduleRepository;

    public function __construct(DonationHistoryRepository $donationHistoryRepo,ScheduleRepository $scheduleRepo)
    {
        $this->middleware('permission:ver-historialDonacion|crear-historialDonacion|editar-historialDonacion|eliminar-historialDonacion',['only'=>['index']]);
        $this->middleware('permission:crear-historialDonacion',['only'=>['create','store']]);
        $this->middleware('permission:editar-historialDonacion',['only'=>['edit','update']]);
        $this->middleware('permission:eliminar-historialDonacion',['only'=>['destroy']]);
        $this->donationHistoryRepository = $donationHistoryRepo;
        $this->scheduleRepository = $scheduleRepo;
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
    public function create(Request $request)
    {


        $date = $request->donation_date == null ?  Carbon::today()->toDateString() : $request->donation_date;

        $schedules= $this->donationHistoryRepository->searchDate($date);


        return view('donation_histories.create',compact('date','schedules'));
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

        $donationHistory = $this->donationHistoryRepository->create($input);

        if ($donationHistory) {
            $status= false;
            $this->scheduleRepository->updateState($status ,$input['schedule_id']);
        }


        Flash::success('Donation History saved successfully.');

        return redirect(route('histories.index'));
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

            return redirect(route('histories.index'));
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
    public function edit(Request $request,$id)
    {
        $donationHistory = $this->donationHistoryRepository->find($id);
       
        if (empty($donationHistory)) {
            Flash::error('Donation History not found');

            return redirect(route('histories.index'));
        }

        return view('donation_histories.edit',compact('donationHistory'));
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

            return redirect(route('histories.index'));
        }

        $donationHistory = $this->donationHistoryRepository->update($request->all(), $id);

        Flash::success('Donation History updated successfully.');

        return redirect(route('histories.index'));
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

            return redirect(route('histories.index'));
        }

        $this->donationHistoryRepository->delete($id);

        Flash::success('Donation History deleted successfully.');

        return redirect(route('histories.index'));
    }
}
