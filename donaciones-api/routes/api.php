<?php

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
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
   // Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::get('userList', 'AuthController@userList');
        Route::post('userUpdate', 'AuthController@userUpdate');

    /* Route::prefix('organization')->group(function () {
            //Route::get('/', 'App\Http\Controllers\Api\IngresoVisitaController@index');
            //Route::post('/updateDate/{id}', 'App\Http\Controllers\Api\IngresoVisitaController@updateDate');
            //Route::get('/getListMiembro/{id}', 'App\Http\Controllers\Api\IngresoVisitaController@getListMiembro');

        });*/



    });
});

Route::group(['middleware' => 'auth:api'], function() {

    Route::get('donations', 'DonationController@index');
    //Route::resource('donations', 'DonationController');
    //Route::post('storeMemberDepartement', 'OrganizationController@storeMemberDepartement');
    //Route::get('organizations/listDepartment/{id}', 'OrganizationController@listDepartment');



});

