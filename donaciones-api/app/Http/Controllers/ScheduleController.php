<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Repositories\ScheduleRepository;
use App\Http\Controllers\AppBaseController;
use Exception;
use Illuminate\Http\Request;
use Flash;
use Response;

class ScheduleController extends AppBaseController
{
    /** @var ScheduleRepository $ScheduleRepository*/
    private $scheduleRepository;
    private $errorStatus = 500;

    public function __construct(ScheduleRepository $scheduleRepo)
    {
        $this->scheduleRepository = $scheduleRepo;
    }

    /**
     * Display a listing of the Schedule.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $donations = $this->scheduleRepository->listDonationPoint();
       
        return view('schedule.index')
            ->with('donations', $donations);
    }

    /**
     * Show the form for creating a new Schedule.
     *
     * @return Response
     */
    public function create()
    {
        return view('schedule.create');
    }

    /**
     * Store a newly created Schedule in storage.
     *
     * @param CreateScheduleRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $Schedule = $this->scheduleRepository->create($input);

        Flash::success('Schedule saved successfully.');

        return redirect(route('schedule.index'));
    }

    /**
     * Display the specified Schedule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $days=[0,1,2,3,4,5,6];
       
      
       

        $donation = $this->scheduleRepository->showScheduleDonation($id);

    

        foreach($donation->schedule as $value){
            $data[]=[
                'schedule_id'=>$value->id,
                'title'=>$value->user->firstname .' '. $value->user->lastname,
                'start'=>$value->donation_date .' '.$value->donation_time,
                'end' => $value->donation_date .' '.date('H:i:s', strtotime($value->donation_time. ' +30 minutes')  ),
                'name' => $value->user->firstname,
                'lastname' => $value->user->lastname,
                'blood_type' => $value->user->blood_type,
                'phone_number'=>$value->user->phone_number,
                'email' => $value->user->email,
                'date_birth' => $value->user->date_birth,
                'country' => $donation->city->country->name,
                'city' => $donation->city->name,
                'donation_center' => $donation->name,
                'address' => $donation->address,
                'phone_center' => $donation-> phone,
                'email_center' => $donation->email,
                'donation_date'=>$value->donation_date,
                'donation_time' => $value->donation_time,
            ];
        }
        foreach($donation->donationHour as $value){

            $key=array_search($value->days,$days,true);

            if ($key !== false) {
                unset($days[$key]);
            }

            $donationHour[]=[
                'day' => $value->days,
                'start_time'=>$value->start_time,
                'end_time'=>$value->end_time,
            ];
        } 
        
        $data['daysWithoutSchedules']=$days;
        $user= $this->scheduleRepository->getNameUser();
        
       /* if (empty($schedule)) {
            Flash::error('Schedule not found');

            return redirect(route('schedule.index'));
        }*/

        return view('schedule.show')->with('donation', $donation)->with('dataschedule',$data);
    }

    public function getUser($id)
    {
        try {
            $data = $this->scheduleRepository->getInfoUser($id);
            return response()->json(['status' => true, 'data' => $data]);
        } catch (Exception $ex) {
            dd($ex);
            return response()->json(['status' => false, 'error' => 'Algo a sucedido ', 'message' => $ex->getMessage()], $this->errorStatus);
        }
    }
    /**
     * Show the form for editing the specified Schedule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $schedule = $this->scheduleRepository->find($id);

        if (empty($Schedule)) {
            Flash::error('Schedule not found');

            return redirect(route('schedule.index'));
        }

        return view('schedule.edit')->with('schedule', $schedule);
    }

    /**
     * Update the specified Schedule in storage.
     *
     * @param int $id
     * @param UpdateScheduleRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $schedule = $this->scheduleRepository->find($id);

        if (empty($Schedule)) {
            Flash::error('Schedule not found');

            return redirect(route('Schedule.index'));
        }

        $schedule = $this->scheduleRepository->update($request->all(), $id);

        Flash::success('Schedule updated successfully.');

        return redirect(route('schedule.index'));
    }

    /**
     * Remove the specified Schedule from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $schedule = $this->scheduleRepository->find($id);

        if (empty($schedule)) {
            Flash::error('Schedule not found');

            return redirect(route('schedule.index'));
        }

        $this->scheduleRepository->delete($id);

        Flash::success('Schedule deleted successfully.');

        return redirect(route('schedule.index'));
    }
}
