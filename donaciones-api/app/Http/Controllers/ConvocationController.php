<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewCallRequest;
use App\Http\Requests\UpdateNewCallRequest;

use App\Http\Controllers\AppBaseController;
use App\Repositories\ConvocationRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class ConvocationController extends AppBaseController
{
    /** @var ConvocationRepository $newCallRepository*/
    private $callRepository;

    public function __construct(ConvocationRepository $callRepo)
    {
        $this->callRepository = $callRepo;
    }

    /**
     * Display a listing of the NewCall.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $calls = $this->callRepository->list();
      
        return view('calls.index')
            ->with('calls', $calls);
    }

    /**
     * Show the form for creating a new NewCall.
     *
     * @return Response
     */
    public function create()
    {
        $donations = $this->callRepository->create();

        //$user =$this->callRepository->user();
        
        return view('calls.create',compact('donations'));
    }

    /**
     * Store a newly created NewCall in storage.
     *
     * @param CreateNewCallRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        $input = $request->all();


        $call = $this->callRepository->store($input);

        Flash::success('New Call saved successfully.');

        return redirect(route('calls.index'));
    }

    /**
     * Display the specified NewCall.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $call = $this->callRepository->show($id);

        if (empty($call)) {
            Flash::error('New Call not found');

            return redirect(route('calls.index'));
        }

        return view('calls.show')->with('call', $call);
    }

    /**
     * Show the form for editing the specified NewCall.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $call = $this->callRepository->show($id);

        $donations = $this->callRepository->create();
       
      

        if (empty($call)) {
            Flash::error('New Call not found');

            return redirect(route('calls.index'));
        }

        return view('calls.edit',compact('call','donations'));
    }

    /**
     * Update the specified NewCall in storage.
     *
     * @param int $id
     * @param UpdateNewCallRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $call = $this->callRepository->show($id);

       
        $input = $request->all();
         
        
        if (empty($call)) {
            Flash::error('New Call not found');

            return redirect(route('calls.index'));
        }

        $call = $this->callRepository->update($input, $id);

        Flash::success('New Call updated successfully.');

        return redirect(route('calls.index'));
    }

    /**
     * Remove the specified NewCall from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $newCall = $this->callRepository->show($id);

        if (empty($newCall)) {
            Flash::error('New Call not found');

            return redirect(route('calls.index'));
        }

        $this->callRepository->delete($id);

        Flash::success('New Call deleted successfully.');

        return redirect(route('calls.index'));
    }
}