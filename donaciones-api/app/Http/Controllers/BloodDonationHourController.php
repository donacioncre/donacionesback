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
        $weekdays = $this->bloodDonationHourRepository->weekdays();
        //$days=$this->bloodDonationHourRepository->days();
      
        return view('blood_donation_hours.create')->with('pointsDonations',$pointsDonations)->with('weekdays',$weekdays);
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
        for($i=0 ; $i < count($input['weekdays']); $i++){
           
            if ($input['weekdays'][$i]) {
           

                $data=[
                    'donation_id'=> $input['donation_id'],
                    'days' => $input['weekdays'][$i],
                    'start_time' => $input['start_time'][$i],
                    'end_time' => $input['end_time'][$i],
                    'start_time_1' => $input['start_time_1'][$i],
                    'end_time_1'=> $input['end_time_1'][$i],
                ];           
                $bloodDonationHour = $this->bloodDonationHourRepository->store($data);
            }

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
        $bloodDonationHours = $this->bloodDonationHourRepository->show($id);

        if (empty($bloodDonationHours)) {
            Flash::error('Blood Donation Hour not found');

            return redirect(route('bloodDonationHours.index'));
        }

        //dd($bloodDonationHours);
        return view('blood_donation_hours.show')->with('bloodDonationHours', $bloodDonationHours);
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

        $pointsDonations=$this->bloodDonationHourRepository->pointsDonations();
        $weekdays = $this->bloodDonationHourRepository->weekdays();
        $bloodDonationHours = $this->bloodDonationHourRepository->show($id);

        $days_available=$weekdays;

        foreach($bloodDonationHours->donationHour as $key => $value){
            unset($days_available[$value->days]);
        }

       

       
      

        $pointsDonations[]=[
            'name'=>$bloodDonationHours->name,
            'id' =>$bloodDonationHours->id,
        ];

        if (empty($bloodDonationHours)) {
            Flash::error('Blood Donation Hour not found');
            return redirect(route('bloodDonationHours.index'));
        }

        return view('blood_donation_hours.edit')->with('bloodDonationHours', $bloodDonationHours)
                ->with('pointsDonations',$pointsDonations)->with('weekdays',$weekdays)
                ->with('days_available',$days_available);
    }

    /**
     * Update the specified BloodDonationHour in storage.
     *
     * @param int $id
     * @param UpdateBloodDonationHourRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $bloodDonationHour = $this->bloodDonationHourRepository->show($id);
        $input = $request->all();
        if (empty($bloodDonationHour)) {
            Flash::error('Blood Donation Hour not found');

            return redirect(route('bloodDonationHours.index'));
        }

        $bloodDonationHour = $this->bloodDonationHourRepository->delete($id);

        for($i=0 ; $i < count($input['weekdays']); $i++){
           
            if ($input['weekdays'][$i]) {
           

                $data=[
                    'donation_id'=> $input['donation_id'],
                    'days' => $input['weekdays'][$i],
                    'start_time' => $input['start_time'][$i],
                    'end_time' => $input['end_time'][$i],
                    'start_time_1' => $input['start_time_1'][$i],
                    'end_time_1'=> $input['end_time_1'][$i],
                ];           
                $bloodDonationHour = $this->bloodDonationHourRepository->store($data);
            }

        }

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
