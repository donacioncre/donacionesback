<?php

use App\Http\Controllers\Api\ScheduleController as ApiScheduleController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

use App\Mail\AppointmentConfirmation;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');

    return view('auth.login');
});



Auth::routes();



Route::get('getUser/{id}',[ApiScheduleController::class,'getUser']);

Route::post('schedules/{id}',[ScheduleController::class,'update']);

Route::group(['middleware'=>['auth']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('benefitDonatings', App\Http\Controllers\BenefitDonatingController::class);
    Route::put('benefitDonatings/addPoint/{id}',[App\Http\Controllers\BenefitDonatingController::class,'addPoint'])->name('benefitDonatings.addPoint');

    Route::resource('donationRequirements', App\Http\Controllers\DonationRequirementsController::class);
    Route::put('donationRequirements/addPoint/{id}',[App\Http\Controllers\DonationRequirementsController::class,'addPoint'])->name('donationRequirements.addPoint');


    Route::resource('myths', App\Http\Controllers\MythController::class);
    Route::put('myths/addPoint/{id}',[App\Http\Controllers\MythController::class,'addPoint'])->name('myths.addPoint');

    Route::resource('questions', App\Http\Controllers\QuestionsController::class);


    Route::resource('newCalls', App\Http\Controllers\NewCallController::class);

    Route::resource('calls', App\Http\Controllers\ConvocationController::class);


    Route::resource('schedule', App\Http\Controllers\ScheduleController::class);

    Route::resource('donation', App\Http\Controllers\DonationController::class);


    Route::resource('countries', App\Http\Controllers\CountryController::class);

    Route::resource('cities', App\Http\Controllers\CityController::class);

    Route::resource('bloodDonationHours',\App\Http\Controllers\BloodDonationHourController::class);
    Route::get('createAppointment/{id}', [\App\Http\Controllers\BloodDonationHourController::class,
                'createAppointment'])->name('createAppointment');
    Route::get('editAppointment/{id}', [\App\Http\Controllers\BloodDonationHourController::class,
                'editAppointment'])->name('editAppointment');
    Route::post('storeAppointment', [\App\Http\Controllers\BloodDonationHourController::class,
                'storeAppointment'])->name('storeAppointment');


    Route::resource('plateletDonationHours',\App\Http\Controllers\PlateletDonationHourController::class);

    Route::get('createAppointmentPlatelet/{id}', [\App\Http\Controllers\PlateletDonationHourController::class,
    'createAppointment'])->name('createAppointmentPlatelet');
    Route::get('editAppointmentPlatelet/{id}', [\App\Http\Controllers\PlateletDonationHourController::class,
        'editAppointment'])->name('editAppointmentPlatelet');
    Route::post('storeAppointmentPlatelet', [\App\Http\Controllers\PlateletDonationHourController::class,
        'storeAppointment'])->name('storeAppointmentPlatelet');



    Route::resource('histories',\App\Http\Controllers\DonationHistoryController::class);

     Route::resource('roles',RolController::class);
     Route::resource('users', App\Http\Controllers\UserController::class);

     Route::get('/donors', [App\Http\Controllers\UserController::class, 'listDonors'])->name('donors');

     Route::get('/consultDonation', [App\Http\Controllers\ConsultController::class, 'index'])->name('consultDonation');

     Route::get('donationCenterDetails/{id}', [App\Http\Controllers\ConsultController::class, 'donationCenterDetails'])->name('donationCenterDetails');
});
