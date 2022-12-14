<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBloodDonationHourRequest;
use App\Http\Requests\UpdateBloodDonationHourRequest;
use App\Repositories\BloodDonationHourRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BloodDonationHourController extends AppBaseController
{
    /** @var BloodDonationHourRepository $bloodDonationHourRepository*/
    private $bloodDonationHourRepository;

    public function __construct(BloodDonationHourRepository $bloodDonationHourRepo)
    {
        $this->bloodDonationHourRepository = $bloodDonationHourRepo;
    }

    /**
     * Display a listing of the BloodDonationHour.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $bloodDonationHours = $this->bloodDonationHourRepository->list();

        return view('blood_donation_hours.index')
            ->with('bloodDonationHours', $bloodDonationHours);
    }

    /**
     * Show the form for creating a new BloodDonationHour.
     *
     * @return Response
     */
    public function create()
    {
        $pointsDonations=$this->bloodDonationHourRepository->pointsDonations();
        //$days=$this->bloodDonationHourRepository->days();
      
        return view('blood_donation_hours.create')->with('pointsDonations',$pointsDonations);
    }

    /**
     * Store a newly created BloodDonationHour in storage.
     *
     * @param CreateBloodDonationHourRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
       
        $input = $request->all();
       
        
        for($i=0 ; $i< count($input['days']); $i++){

            $data=[
                'donation_id'=> $input['donation_id'],
                'days' => $this->bloodDonationHourRepository->days($input['days'][$i]),
                'start_time' => $input['start_time'][$i],
                'end_time' => $input['end_time'][$i],
            ];           
            $bloodDonationHour = $this->bloodDonationHourRepository->store($data);
        }

        Flash::success('Blood Donation Hour saved successfully.');

        return redirect(route('bloodDonationHours.index'));
    }

    /**
     * Display the specified BloodDonationHour.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bloodDonationHour = $this->bloodDonationHourRepository->find($id);

        if (empty($bloodDonationHour)) {
            Flash::error('Blood Donation Hour not found');

            return redirect(route('bloodDonationHours.index'));
        }

        return view('blood_donation_hours.show')->with('bloodDonationHour', $bloodDonationHour);
    }

    /**
     * Show the form for editing the specified BloodDonationHour.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bloodDonationHour = $this->bloodDonationHourRepository->find($id);

        if (empty($bloodDonationHour)) {
            Flash::error('Blood Donation Hour not found');

            return redirect(route('bloodDonationHours.index'));
        }

        return view('blood_donation_hours.edit')->with('bloodDonationHour', $bloodDonationHour);
    }

    /**
     * Update the specified BloodDonationHour in storage.
     *
     * @param int $id
     * @param UpdateBloodDonationHourRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBloodDonationHourRequest $request)
    {
        $bloodDonationHour = $this->bloodDonationHourRepository->find($id);

        if (empty($bloodDonationHour)) {
            Flash::error('Blood Donation Hour not found');

            return redirect(route('bloodDonationHours.index'));
        }

        $bloodDonationHour = $this->bloodDonationHourRepository->update($request->all(), $id);

        Flash::success('Blood Donation Hour updated successfully.');

        return redirect(route('bloodDonationHours.index'));
    }

    /**
     * Remove the specified BloodDonationHour from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bloodDonationHour = $this->bloodDonationHourRepository->find($id);

        if (empty($bloodDonationHour)) {
            Flash::error('Blood Donation Hour not found');

            return redirect(route('bloodDonationHours.index'));
        }

        $this->bloodDonationHourRepository->delete($id);

        Flash::success('Blood Donation Hour deleted successfully.');

        return redirect(route('bloodDonationHours.index'));
    }
}
