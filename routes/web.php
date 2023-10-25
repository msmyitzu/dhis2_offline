<?php

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

Route::get('/main','lookupsController@ShowMainTabs');

Route::get('/health-facilities', function(){
    return view('adminlte-template.lp-tbl-hfm');
});

Route::get('/health-facilities', 'lookupsController@show_lookup_page');

Route::get('/chart','lookupsController@show_charts');

Route::post('/patient-register-form','lookupsController@get_patient_registerform');        //

Route::get('/get_existing_form_data/{cf_link_code}', 'lookupsController@get_existing_form_data');

Route::get('/vhv-patient-register-form', 'lookupsController@get_vhv_patient_registerform');

Route::get('/township-summary-report-SC', function(){
    return view('nmcp-template.township-summary-report-SC');
});


Route::get('/get_grab_tbl_individual_case/{cf_link_code}','lookupsController@get_grab_tbl_individual_case');
Route::get('/get_grab_tbl_individual_case_temp/{cf_link_code}','lookupsController@get_grab_tbl_individual_case_temp');
Route::post('/save_tbl_individual_case','lookupsController@save_tbl_individual_case');
Route::post('/save_tbl_individual_case_temp','lookupsController@save_tbl_individual_case_temp');
Route::post('/save_tbl_total_patient','lookupsController@save_tbl_total_patient');
Route::post('/save_tbl_total_patient_temp','lookupsController@save_tbl_total_patient_temp');
Route::post('/update_tbl_total_patient_temp','lookupsController@update_tbl_total_patient_temp');
Route::post('/update_tbl_individual_case','lookupsController@update_tbl_individual_case');
Route::post('/update_tbl_individual_case_temp','lookupsController@update_tbl_individual_case_temp');

Route::get('/get_patient_dataentry_row/{ts_code}', 'lookupsController@get_patient_dataentry_row');
Route::get('/get_vhv_dataentry_row/{ts_code}', 'lookupsController@get_vhv_dataentry_row');
Route::post('/delete_tbl_core_facility_by_code/{cf}', 'lookupsController@delete_tbl_core_facility_by_code');
Route::post('/delete_tbl_individual_by_code/{p_number}', 'lookupsController@delete_tbl_individual_by_code');

/* TOKEN test for API calls */
Route::post('testpost', array('before' => 'csrf', function()
{
    return 'You gave a valid CSRF token!';
}));

Route::get('/testpage', function(){
    return view('test');
});

Route::get('login','lookupsController@show_login');

Route::post('login','lookupsController@auth');

Route::get('/login/signout','lookupsController@signout');

Route::get('/users','lookupsController@show_users');    //can't delete

Route::post('/users/{action}','lookupsController@edit_users');

Route::post('/generate_token','lookupsController@generate_token');

Route::get('/request_token','lookupsController@request_token');
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Sync

Route::get('/sync','syncController@show_sync_page');
Route::get('/sync_upload','syncController@sync_upload');
Route::get('/sync_download','syncController@sync_download');
Route::get('/syncd','syncController@show_syncd_page');
Route::post('/send_delete_request','syncController@send_delete_request');
Route::get('/sync_tbl_hfm','syncController@sync_tbl_hfm');

Route::get('/check_server_hfm', 'syncController@check_server_hfm');
Route::get('/delete_all_hfm', 'syncController@delete_all_hfm');



Route::get('/fetch_data', 'syncController@fetch_data');
Route::get('/pure-login', 'lookupsController@pure_login');
Route::post('/pure_login_auth', 'lookupsController@pure_login_auth');

Route::get('/write_status', 'syncController@write_status_check');





Route::get('/','lookupsController@get_patient_registerform_offline')->name('parent-register');
