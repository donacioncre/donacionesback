<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBloodDonationHourRequest;
use App\Http\Requests\UpdateBloodDonationHourRequest;
use App\Repositories\PlateletDonationHourRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PlateletDonationHourController extends AppBaseController
{
    /** @var PlateletDonationHourRepository $PlateletDonationHourRepository*/
    private $plateletDonationHourRepository;

    public function __construct(PlateletDonationHourRepository $plateletDonationHourRepo)
    {
        $this->middleware('permission:ver-horarioDonacion|crear-horarioDonacion|editar-horarioDonacion|eliminar-horarioDonacion',['only'=>['index']]);
        $this->middleware('permission:crear-horarioDonacion',['only'=>['create','store']]);
        $this->middleware('permission:editar-horarioDonacion',['only'=>['edit','update']]);
        $this->middleware('permission:eliminar-horarioDonacion',['only'=>['destroy']]);
        $this->plateletDonationHourRepository = $plateletDonationHourRepo;
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
        $bloodDonationHours = $this->plateletDonationHourRepository->list();

      
        return view('platelet_donation_hours.index')
            ->with('bloodDonationHours', $bloodDonationHours);
    }

    /**
     * Show the form for creating a new BloodDonationHour.
     *
     * @return Response
     */
    public function create()
    {
        $pointsDonations=$this->plateletDonationHourRepository->pointsDonations();
        $weekdays = $this->plateletDonationHourRepository->weekdays();
        //$days=$this->PlateletDonationHourRepository->days();
      
        return view('platelet_donation_hours.create')->with('pointsDonations',$pointsDonations)->with('weekdays',$weekdays);
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
           
            if ($input['weekdays'][$i] != null) {
           
                $data=[
                    'donation_id'=> $input['donation_id'],
                    'days' => $input['weekdays'][$i],
                    'start_time' => $input['start_time'][$i],
                    'end_time' => $input['end_time'][$i],
                    'start_time_1' => $input['start_time_1'][$i],
                    'end_time_1'=> $input['end_time_1'][$i],
                ];
                      
                $bloodDonationHour = $this->plateletDonationHourRepository->store($data);
            }

        }
        

        Flash::success('Blood Donation Hour saved successfully.');

        //return redirect(route('plateletDonationHours.index'));
        return redirect(route('createAppointmentPlatelet',['id'=>$input['donation_id']]));

    }

    public function createAppointment($id)
    {
        
        //$bloodDonationHours = $this->bloodDonationHourRepository->show($id);
        //$days=$this->bloodDonationHourRepository->days();

        $donation_hours = $this->plateletDonationHourRepository->dateDonation($id);

        return view('platelet_donation_hours.create_appointment',compact('donation_hours','id'));
    }

    public function editAppointment($id)
    {
       
        $bloodDonationHours = $this->plateletDonationHourRepository->show($id);

      
        //$days=$this->bloodDonationHourRepository->days();

        //dd($bloodDonationHours->donationHour[0]->bloodDonorAppointment);
        //$donation_hours = $this->bloodDonationHourRepository->dateDonation($id);
      
       //dd($donation_hours[0]);
        return view('platelet_donation_hours.edit_appointment',compact('bloodDonationHours','id'));
    }

    public function storeAppointment(Request $request)
    {
        
       $input = $request->all(); 
       $donation_hours =[];
     
        //$days=$this->bloodDonationHourRepository->days();
        $this->plateletDonationHourRepository->deleteTimeDonator($input['donation_id']);
        foreach ($input['day'] as $keyDay => $day) {
            foreach($input['time_'.$day] as $keyTime => $itemTime){

                foreach($input['num_attention_time_'.$day] as $keyAttention => $itemAttention){

                    if ($keyTime == $keyAttention) {
                        $data=[
                            'donation_id'=>$input['donation_id'],
                            'day' => $day,
                            'time' => $itemTime,
                            'num_attention_time' => $itemAttention
                        ];
                        
                        $donation_hours = $this->plateletDonationHourRepository->saveTimeDonator($data);


                    }    
                    
                }

            }
        }
       
       Flash::success('Blood Donation Hour updated successfully.');

       return redirect(route('plateletDonationHours.index'));
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
        $bloodDonationHours = $this->plateletDonationHourRepository->show($id);


        if (empty($bloodDonationHours)) {
            Flash::error('Blood Donation Hour not found');

            return redirect(route('plateletDonationHours.index'));
        }

        //dd($bloodDonationHours);
        return view('platelet_donation_hours.show')->with('bloodDonationHours', $bloodDonationHours);
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

        
        $pointsDonations=$this->plateletDonationHourRepository->pointsDonations();
        $weekdays = $this->plateletDonationHourRepository->weekdays();
        $bloodDonationHours = $this->plateletDonationHourRepository->show($id);

        $days_available=$weekdays;

        foreach($bloodDonationHours->plateletDonationHour as $key => $value){
            unset($days_available[$value->days]);
        }
        $pointsDonations[]=[
            'name'=>$bloodDonationHours->name,
            'id' =>$bloodDonationHours->id,
        ];

        if (empty($bloodDonationHours)) {
            Flash::error('Blood Donation Hour not found');
            return redirect(route('plateletDonationHours.index'));
        }

        return view('platelet_donation_hours.edit',compact('id'))->with('bloodDonationHours', $bloodDonationHours)
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
        $bloodDonationHour = $this->plateletDonationHourRepository->show($id);
        $input = $request->all();
        if (empty($bloodDonationHour)) {
            Flash::error('Blood Donation Hour not found');

            return redirect(route('plateletDonationHours.index'));
        }

        $bloodDonationHour = $this->plateletDonationHourRepository->delete($id);

        for($i=0 ; $i < count($input['weekdays']); $i++){
           
            if ($input['weekdays'][$i] != null) {
           

                $data=[
                    'donation_id'=> $input['donation_id'],
                    'days' => $input['weekdays'][$i],
                    'start_time' => $input['start_time'][$i],
                    'end_time' => $input['end_time'][$i],
                    'start_time_1' => $input['start_time_1'][$i],
                    'end_time_1'=> $input['end_time_1'][$i],
                ];           
                $bloodDonationHour = $this->plateletDonationHourRepository->store($data);
            }

        }

        Flash::success('Blood Donation Hour updated successfully.');

        return redirect(route('plateletDonationHours.index'));
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
        $bloodDonationHour = $this->plateletDonationHourRepository->find($id);

        if (empty($bloodDonationHour)) {
            Flash::error('Blood Donation Hour not found');

            return redirect(route('plateletDonationHours.index'));
        }

        $this->plateletDonationHourRepository->delete($id);

        Flash::success('Blood Donation Hour deleted successfully.');

        return redirect(route('plateletDonationHours.index'));
    }
}
