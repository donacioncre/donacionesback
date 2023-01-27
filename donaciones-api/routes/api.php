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
use App\Http\Controllers\AuthController;
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
   // Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', [AuthController::class,'logout']);
        Route::get('user', [AuthController::class,'user'] );
        Route::get('userList', [AuthController::class,'userList'] );
        Route::post('userUpdate', [AuthController::class,'userUpdate'] );

    /* Route::prefix('organization')->group(function () {
            //Route::get('/', 'App\Http\Controllers\Api\IngresoVisitaController@index');
            //Route::post('/updateDate/{id}', 'App\Http\Controllers\Api\IngresoVisitaController@updateDate');
            //Route::get('/getListMiembro/{id}', 'App\Http\Controllers\Api\IngresoVisitaController@getListMiembro');

        });*/
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/digitalDonationCard/{data}',  [DonationHistoryAPIController::class,'digitalDonationCard']);
    
    Route::resource('/convocations', ConvocationController::class);

    Route::prefix('schedule')->group(function () {
        Route::get('listCountry', [ScheduleController::class,'listCountry']);
        Route::get('/listCity/{id}', [ScheduleController::class,'listCity']);
        Route::get('/listDonationCenter/{id}', [ScheduleController::class,'listDonationCenter']);

        Route::post('/listTimeDonation/{id}', [ScheduleController::class,'listTimeDonation']);

        Route::post('store',[ScheduleController::class,'store']);
        Route::get('show/{id}',[ScheduleController::class,'show']);
        Route::post('update/{id}',[ScheduleController::class,'update']);
        

        Route::get('userListSchedule', [ScheduleController::class,'listScheduleDonation']);

        Route::post('cancelScheduleDonation/{id}',[ScheduleController::class,'cancelScheduleDonation']);
        //Route::post('/updateDate/{id}', 'App\Http\Controllers\Api\IngresoVisitaController@updateDate');
        //Route::get('/getListMiembro/{id}', 'App\Http\Controllers\Api\IngresoVisitaController@getListMiembro');

    });

    Route::prefix('donationHistories')->group(function () {
        Route::get('list', [DonationHistoryAPIController::class,'index']);
       
        //Route::post('/updateDate/{id}', 'App\Http\Controllers\Api\IngresoVisitaController@updateDate');
        //Route::get('/getListMiembro/{id}', 'App\Http\Controllers\Api\IngresoVisitaController@getListMiembro');

    });

    //Route::post('storeMemberDepartement', 'OrganizationController@storeMemberDepartement');
    //Route::get('organizations/listDepartment/{id}', 'OrganizationController@listDepartment');
});


Route::resource('/donations', DonationController::class);


Route::resource('/benefitDonating', BenefitDonatingController::class);

Route::resource('/donationRequirements', DonationRequirementsController::class);

Route::resource('/myth', MythController::class);

Route::resource('questions', QuestionsAPIController::class);

Route::resource('new_calls', NewCallAPIController::class);
