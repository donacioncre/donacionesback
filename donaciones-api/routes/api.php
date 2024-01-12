<?php

use App\Http\Controllers\Api\BenefitDonatingController;
use App\Http\Controllers\Api\ConvocationController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\DonationHistoryAPIController;
use App\Http\Controllers\Api\DonationRequirementsController;
use App\Http\Controllers\Api\MythController;
use App\Http\Controllers\Api\NewCallAPIController;
use App\Http\Controllers\Api\QuestionsAPIController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DonationHistoryController;
use App\Http\Controllers\OrganizationController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ 'prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class,'login']);
    Route::post('signup',  [AuthController::class,'signup']);
    Route::post('forgotPassword', [AuthController::class,'forgotPassword']);
    Route::post('resetPassword', [AuthController::class,'resetPassword']);
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', [AuthController::class,'logout']);
        Route::get('user', [AuthController::class,'user'] );
        Route::get('userList', [AuthController::class,'userList'] );
        Route::post('userUpdate', [AuthController::class,'userUpdate'] );
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/digitalDonationCard/{data}',  [DonationHistoryAPIController::class,'digitalDonationCard']);

    Route::resource('/convocations', ConvocationController::class);

    Route::prefix('schedule')->group(function () {
        Route::get('/listDonationCenter/{id}', [ScheduleController::class,'listDonationCenter']);

        Route::post('/listTimeDonation/{id}', [ScheduleController::class,'listTimeDonation']);

        Route::post('store',[ScheduleController::class,'store']);
        Route::get('show/{id}',[ScheduleController::class,'show']);
        Route::post('update/{id}',[ScheduleController::class,'update']);


        Route::get('userListSchedule', [ScheduleController::class,'listScheduleDonation']);

        Route::get('lastScheduleDonation', [ScheduleController::class,'lastScheduleDonation']);
        Route::post('cancelScheduleDonation/{id}',[ScheduleController::class,'cancelScheduleDonation']);
    });

    Route::prefix('donationHistories')->group(function () {
        Route::get('list', [DonationHistoryAPIController::class,'index']);
    });
});


Route::prefix('schedule')->group(function () {
    Route::get('listCountry', [ScheduleController::class,'listCountry']);
    Route::get('/listCity/{id}', [ScheduleController::class,'listCity']);
});

Route::resource('/donations', DonationController::class);


Route::resource('/benefitDonating', BenefitDonatingController::class);

Route::resource('/donationRequirements', DonationRequirementsController::class);

Route::resource('/myth', MythController::class);

Route::resource('questions', QuestionsAPIController::class);

Route::resource('new_calls', NewCallAPIController::class);
