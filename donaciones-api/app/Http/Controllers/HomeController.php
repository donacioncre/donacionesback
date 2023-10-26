<?php

namespace App\Http\Controllers;


use App\Repositories\DonationRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $donationRepo,$userRepo;
    public function __construct(DonationRepository $donationRepo, UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->donationRepo = $donationRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->roles->first()->name == 'donante') {
            $this->guard()->logout();
            return redirect('/');
        }
        $donors = $this->userRepo->listUserDonors()->count();
        $donationCenter  = $this->donationRepo->list()->count();
        return view('home',compact('donors','donationCenter'));
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
