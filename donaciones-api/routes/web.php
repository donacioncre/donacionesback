<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Route::resource('countries', App\Http\Controllers\countriesController::class);


Route::resource('questions', App\Http\Controllers\QuestionsController::class);


Route::resource('newCalls', App\Http\Controllers\NewCallController::class);

Route::resource('schedule', App\Http\Controllers\ScheduleController::class);

Route::resource('donation', App\Http\Controllers\DonationController::class);


Route::resource('countries', App\Http\Controllers\CountryController::class);

Route::resource('cities', App\Http\Controllers\CityController::class);

Route::resource('bloodDonationHours',\App\Http\Controllers\BloodDonationHourController::class);
