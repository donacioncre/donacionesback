<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\DonationRepository;
use App\Repositories\DonationRequirementsRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonationRequirementsController extends Controller
{
    
    protected $donation;

    public function __construct(DonationRequirementsRepository $donation)
    {
        $this->donation = $donation;
    }

    public function index()
    {
        
        $data = $this->donation->list();
            
        return view('donation_requirements.index')
        ->with('donation', $data);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donation_requirements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $donation = $this->donation->create($input);

        Flash::success('Questions saved successfully.');

        return redirect(route('donationRequirements.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation = $this->donation->find($id);

        if (empty($donation)) {
            Flash::error('Donation Requirements not found');

            return redirect(route('donationRequirements.index'));
        }

        return view('donation_requirements.show')->with('donation', $donation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donation = $this->donation->show($id);

        if (empty($donation)) {
            Flash::error('Donation requirements not found');

            return redirect(route('donationRequirements.index'));
        }

        return view('donation_requirements.edit')->with('donation', $donation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $donation = $this->donation->show($id);

        if (empty($donation)) {
            Flash::error('Donation Requirements not found');

            return redirect(route('donationRequirements.index'));
        }

        $donation = $this->donation->update($request->all(), $id);

        Flash::success('Donation Requirements updated successfully.');

        return redirect(route('donationRequirements.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donation = $this->donation->show($id);

        if (empty($donation)) {
            Flash::error('Donation Requirements not found');

            return redirect(route('donationRequirements.index'));
        }

        $this->donation->delete($id);

        Flash::success('Donation Requirements deleted successfully.');

        return redirect(route('donationRequirements.index'));
    }
}
