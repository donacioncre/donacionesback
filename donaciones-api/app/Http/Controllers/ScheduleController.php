<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Repositories\ScheduleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ScheduleController extends AppBaseController
{
    /** @var ScheduleRepository $ScheduleRepository*/
    private $scheduleRepository;

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
        $schedule = $this->scheduleRepository->showScheduleDonation($id);

      

        foreach($schedule as $value){
            $data[]=[
                'title'=>$value->user->firstname .' '. $value->user->lastname,
                'start'=>$value->donation_date .' '.$value->donation_time,
                'end' => $value->donation_date .' '.date('H:i:s', strtotime($value->donation_time. ' +30 minutes')  )
            ];
        }

        

       /* if (empty($schedule)) {
            Flash::error('Schedule not found');

            return redirect(route('schedule.index'));
        }*/

        return view('schedule.show')->with('schedule', $schedule)->with('dataschedule',$data);
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
