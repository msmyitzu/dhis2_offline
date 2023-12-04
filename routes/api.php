<?php

use App\Http\Controllers\DataEntryController;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Offline Version - 2 */
/* DHIS2 in get Data */
Route::get('/dhis2getDataRegion','APIController@dhis2getDataRegion');
Route::get('/dhis2getDataTownship','APIController@dhis2getDataTownship');
Route::get('/dhis2getDataDistrict','APIController@dhis2getDataDistrict');
Route::get('/dhis2getDataHealthFacility','APIController@dhis2getDataHealthFacility');
Route::get('/dhis2getDataSubCenter','APIController@dhis2getDataSubCenter');
Route::get('/dhis2getDataVillage','APIController@dhis2getDataVillage');
Route::post('/dhis2postData/{pt_current_township}','APIController@dhis2postData');


/* Township */
Route::get('/district/{id}',[DataEntryController::class , 'getDistrictData']);
Route::get('/township/{id}',[DataEntryController::class , 'getTownshipData']);
Route::get('/healthfacility/{id}',[DataEntryController::class , 'getHealthFacilityData']);
Route::get('/subcenter/{id}',[DataEntryController::class , 'getSubCenterData']);
Route::get('/vhv/{id}',[DataEntryController::class , 'getvhvData']);


Route::get('/district/{id}',[DataEntryController::class , 'DistrictData']);
Route::get('/township/{id}',[DataEntryController::class , 'TownshipData']);
Route::get('/healthfacility/{id}',[DataEntryController::class , 'HealthFacilityData']);
Route::get('/subcenter/{id}',[DataEntryController::class , 'SubCenterData']);
Route::get('/vhv/{id}',[DataEntryController::class , 'vhvData']);


//for outsidetsp&Country
Route::get('/outtownship/{id}',[DataEntryController::class , 'outsideTownshipData']);
Route::get('/outhealthfacility/{id}',[DataEntryController::class , 'outsideHealthFacilityData']);


Route::get('/currenttownship/{id}',[DataEntryController::class , 'currentTownshipData']);
Route::get('/currenthealthfacility/{id}',[DataEntryController::class , 'currentHealthFacilityData']);

