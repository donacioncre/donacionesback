<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewCallRequest;
use App\Http\Requests\UpdateNewCallRequest;
use App\Repositories\NewCallRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class NewCallController extends AppBaseController
{
    /** @var NewCallRepository $newCallRepository*/
    private $newCallRepository;

    public function __construct(NewCallRepository $newCallRepo)
    {
        $this->middleware('permission:ver-noticias|crear-noticias|editar-noticias|eliminar-noticias',['only'=>['index']]);
        $this->middleware('permission:crear-noticias',['only'=>['create','store']]);
        $this->middleware('permission:editar-noticias',['only'=>['edit','update']]);
        $this->middleware('permission:eliminar-noticias',['only'=>['destroy']]);
        $this->newCallRepository = $newCallRepo;
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
        $newCalls = $this->newCallRepository->all()->sortBy("id");

        return view('new_calls.index')
            ->with('newCalls', $newCalls);
    }

    /**
     * Show the form for creating a new NewCall.
     *
     * @return Response
     */
    public function create()
    {
        $authors = $this->newCallRepository->listUser();

      
        $user =$this->newCallRepository->user();
        
        return view('new_calls.create')->with('authors',$authors)->with('user',$user);
    }

    /**
     * Store a newly created NewCall in storage.
     *
     * @param CreateNewCallRequest $request
     *
     * @return Response
     */
    public function store(CreateNewCallRequest $request)
    {
        $file = 'N/A';
        if ($request->image) {
            $img = $request->image;
            $destinationPath = 'image/donation/';
            $filename = time() . '-' . $img->getClientOriginalName();
            $request->image->move($destinationPath, $filename);
            $file = $destinationPath . $filename;

        }   
        
        $input = $request->all();

        $input['image']= $file;

        $newCall = $this->newCallRepository->create($input);

        Flash::success('New Call saved successfully.');

        return redirect(route('newCalls.index'));
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
        $newCall = $this->newCallRepository->find($id);

        if (empty($newCall)) {
            Flash::error('New Call not found');

            return redirect(route('newCalls.index'));
        }

        return view('new_calls.show')->with('newCall', $newCall);
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
        $newCall = $this->newCallRepository->find($id);

        $authors = $this->newCallRepository->listUser();

        $user =$newCall->author;

        if (empty($newCall)) {
            Flash::error('New Call not found');

            return redirect(route('newCalls.index'));
        }

        return view('new_calls.edit')->with('newCall', $newCall)->with('authors',$authors)->with('user',$user);
    }

    /**
     * Update the specified NewCall in storage.
     *
     * @param int $id
     * @param UpdateNewCallRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNewCallRequest $request)
    {
        $newCall = $this->newCallRepository->find($id);

        $file = 'N/A';
        $input = $request->all();
        if ($request->image) {
            $img = $request->image;
            $destinationPath = 'image/donation/';
            $filename = time() . '-' . $img->getClientOriginalName();
            $request->image->move($destinationPath, $filename);
            $file = $destinationPath . $filename;
            $input['image']= $file;
        }   
        
       

      


        if (empty($newCall)) {
            Flash::error('New Call not found');

            return redirect(route('newCalls.index'));
        }

        $newCall = $this->newCallRepository->update($input, $id);

        Flash::success('New Call updated successfully.');

        return redirect(route('newCalls.index'));
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
        $newCall = $this->newCallRepository->find($id);

        if (empty($newCall)) {
            Flash::error('New Call not found');

            return redirect(route('newCalls.index'));
        }

        $this->newCallRepository->delete($id);

        Flash::success('New Call deleted successfully.');

        return redirect(route('newCalls.index'));
    }
}
