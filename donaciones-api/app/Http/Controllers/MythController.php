<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMythsRequest;
use App\Http\Requests\UpdateMythsRequest;
use App\Repositories\MythRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MythController extends AppBaseController
{
    /** @var MythRepository $mythRepository*/
    private $mythRepository;

    public function __construct(MythRepository $mythRepo)
    {
        $this->mythRepository = $mythRepo;
    }

    /**
     * Display a listing of the Myths.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $myths = $this->mythRepository->all();

        return view('myths.index')
            ->with('myths', $myths);
    }

    /**
     * Show the form for creating a new Myths.
     *
     * @return Response
     */
    public function create()
    {
        return view('myths.create');
    }

    /**
     * Store a newly created Myths in storage.
     *
     * @param CreateMythsRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $myths = $this->mythRepository->create($input);

        Flash::success('Myth saved successfully.');

        return redirect(route('myths.index'));
    }

    /**
     * Display the specified Myths.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $myths = $this->mythRepository->find($id);

        if (empty($myths)) {
            Flash::error('Myth not found');

            return redirect(route('myths.index'));
        }

        return view('myths.show')->with('myths', $myths);
    }

    /**
     * Show the form for editing the specified Myths.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $myths = $this->mythRepository->find($id);

        if (empty($myths)) {
            Flash::error('Myth not found');

            return redirect(route('myths.index'));
        }

        return view('myths.edit')->with('myths', $myths);
    }

    /**
     * Update the specified Myths in storage.
     *
     * @param int $id
     * @param UpdateMythsRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $myths = $this->mythRepository->find($id);

        if (empty($myths)) { 
            Flash::error('Myths not found');

            return redirect(route('myths.index'));
        }


        $file = null;
        $details=[];
   
        foreach($request->item as $key => $value){
            if (isset($value['image'])) {
                $img = $value['image'];
                $destinationPath = 'image/donation/';
                $filename = time() . '-' . $img->getClientOriginalName();
                $value['image']->move($destinationPath, $filename);
                $file = $destinationPath . $filename;
            }

            $details[]=[
                'ask' => $value['ask'],
                'answer' => $value['answer'],
                'image' => $file,
            ];
            $file = null;
        }

        $requestData=$request->all();

        $requestData['item'] = $details;

        $myths = $this->mythRepository->update($requestData, $id);

        Flash::success('Myths updated successfully.');

        return redirect(route('myths.index'));
    }

    /**
     * Remove the specified Myths from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $myths = $this->mythRepository->find($id);

        if (empty($myths)) {
            Flash::error('Myth not found');

            return redirect(route('myths.index'));
        }

        $this->mythRepository->delete($id);

        Flash::success('Myth deleted successfully.');

        return redirect(route('myths.index'));
    }
}
