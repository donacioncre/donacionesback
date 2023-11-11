<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBenefitDonatingRequest;
use App\Http\Requests\UpdateBenefitDonatingRequest;
use App\Repositories\BenefitDonatingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BenefitDonatingController extends AppBaseController
{
    /** @var BenefitDonatingRepository $benefitDonatingRepository*/
    private $benefitDonatingRepository;

    public function __construct(BenefitDonatingRepository $benefitDonatingRepo)
    {
        $this->middleware('permission:ver-beneficios|crear-beneficios|editar-beneficios|eliminar-beneficios',['only'=>['index']]);
        $this->middleware('permission:crear-beneficios',['only'=>['create','store']]);
        $this->middleware('permission:editar-beneficios',['only'=>['edit','update']]);
        $this->middleware('permission:eliminar-beneficios',['only'=>['destroy']]);
        $this->benefitDonatingRepository = $benefitDonatingRepo;
    }

    /**
     * Display a listing of the BenefitDonating.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $benefitDonatings = $this->benefitDonatingRepository->all();

        if (count($benefitDonatings)==0) {
            return view('benefit_donatings.create');
        }
        return view('benefit_donatings.index')
            ->with('benefitDonatings', $benefitDonatings);
    }

    /**
     * Show the form for creating a new BenefitDonating.
     *
     * @return Response
     */
    public function create()
    {
        return view('benefit_donatings.create');
    }

    /**
     * Store a newly created BenefitDonating in storage.
     *
     * @param CreateBenefitDonatingRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $details=[];
        for ($i = 1; $i <=$input['num'] ; $i++) {

            array_push($details,'punto');
        }

        $input ['points'] = $details;

        $data = $this->benefitDonatingRepository->store($input);
        $benefitDonating = $this->benefitDonatingRepository->find($data);
        return view('benefit_donatings.edit')->with('benefitDonating', $benefitDonating);
    }

    /**
     * Display the specified BenefitDonating.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $benefitDonating = $this->benefitDonatingRepository->find($id);

        if (empty($benefitDonating)) {
            Flash::error('Benefit Donating not found');

            return redirect(route('benefitDonatings.index'));
        }

        return view('benefit_donatings.show')->with('benefitDonating', $benefitDonating);
    }

    /**
     * Show the form for editing the specified BenefitDonating.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $benefitDonating = $this->benefitDonatingRepository->find($id);

        if (empty($benefitDonating)) {
            Flash::error('Benefit Donating not found');

            return redirect(route('benefitDonatings.index'));
        }

        return view('benefit_donatings.edit')->with('benefitDonating', $benefitDonating);
    }

    /**
     * Update the specified BenefitDonating in storage.
     *
     * @param int $id
     * @param UpdateBenefitDonatingRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $benefitDonating = $this->benefitDonatingRepository->find($id);

        if (empty($benefitDonating)) {
            Flash::error('Benefit Donating not found');

            return redirect(route('benefitDonatings.index'));
        }

        $benefitDonating = $this->benefitDonatingRepository->update($request->all(), $id);

        Flash::success('Benefit Donating updated successfully.');

        return redirect(route('benefitDonatings.index'));
    }

    public function addPoint($id,Request $request)
    {

        $details=[];
        $input = $request->all();
        for ($i = 1; $i <=$input['num'] ; $i++) {
            array_push($details,'punto');

        }
        $input ['points'] = $details;
        $benefitDonating = $this->benefitDonatingRepository->addPoints($input, $id);

        return redirect(route('benefitDonatings.edit', $id))->with('benefitDonating', $benefitDonating);

    }
    /**
     * Remove the specified BenefitDonating from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $benefitDonating = $this->benefitDonatingRepository->find($id);

        if (empty($benefitDonating)) {
            Flash::error('Benefit Donating not found');

            return redirect(route('benefitDonatings.index'));
        }

        $this->benefitDonatingRepository->delete($id);

        Flash::success('Benefit Donating deleted successfully.');

        return redirect(route('benefitDonatings.index'));
    }
}
