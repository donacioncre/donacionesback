<?php

use App\Http\Controllers\Api\ScheduleController as ApiScheduleController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

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



//Route::resource('countries', App\Http\Controllers\countriesController::class);





Route::get('getUser/{id}',[ApiScheduleController::class,'getUser']);

Route::post('schedules/{id}',[ScheduleController::class,'update']);




//Route::resource('users', 'UserController')->middleware('auth');

Route::group(['middleware'=>['auth']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

    Route::resource('histories',\App\Http\Controllers\DonationHistoryController::class);

     Route::resource('roles',RolController::class);
     Route::resource('users', App\Http\Controllers\UserController::class);

     Route::get('/donors', [App\Http\Controllers\UserController::class, 'listDonors'])->name('donors');

     Route::get('/consultDonation', [App\Http\Controllers\ConsultController::class, 'index'])->name('consultDonation');
});