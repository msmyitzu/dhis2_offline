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

Route::get('/','lookupsController@ShowMainTabs');

Route::get('/health-facilities', function(){
    return view('adminlte-template.lp-tbl-hfm');
});

Route::get('/health-facilities', 'lookupsController@show_lookup_page');

Route::get('/chart','lookupsController@show_charts');

Route::post('/patient-register-form', 'lookupsController@get_patient_registerform');
Route::get('/get_existing_form_data/{cf_link_code}', 'lookupsController@get_existing_form_data');

Route::get('/vhv-patient-register-form', 'lookupsController@get_vhv_patient_registerform');

Route::get('/township-summary-report-SC', function(){
    return view('nmcp-template.township-summary-report-SC');
});

Route::get('/get_lp_district/{sr_id}', 'lookupsController@get_lp_district');
Route::get('/get_lp_act_code', 'lookupsController@get_lp_act_code');
Route::get('/get_lp_form_cat', 'lookupsController@get_lp_form_cat');
Route::get('/get_lp_hftype', 'lookupsController@get_lp_hftype');
Route::get('/get_lp_hftype_formcat','lookupsController@get_lp_hftype_formcat');
Route::get('/get_lp_in_out_cat','lookupsController@get_lp_in_out_cat');
Route::get('/get_lp_inouttpa_formcat','lookupsController@get_lp_inouttpa_formcat');
Route::get('/get_lp_malaria_strata','lookupsController@get_lp_malaria_strata');
Route::get('/get_lp_micro_result','lookupsController@get_lp_micro_result');
Route::get('/get_lp_org','lookupsController@get_lp_org');
Route::get('/get_lp_patient_location','lookupsController@get_lp_patient_location');
Route::get('/get_lp_patient_sex','lookupsController@get_lp_patient_sex');
Route::get('/get_lp_pmonth','lookupsController@get_lp_pmonth');
Route::get('/get_lp_pyear','lookupsController@get_lp_pyear');
Route::get('/get_lp_rdt_result','lookupsController@get_lp_rdt_result');
Route::get('/get_lp_state_region','lookupsController@get_lp_state_region');
Route::get('/get_lp_township/{sr_code}','lookupsController@get_lp_township');
Route::get('/get_lp_treatment_given','lookupsController@get_lp_treatment_given');
Route::get('/get_lp_yesno','lookupsController@get_lp_yesno');
Route::get('/get_tbl_hfm','lookupsController@get_tbl_hfm');
Route::get('/get_tbl_hfm/{ts_code}','lookupsController@get_tbl_hfm');
Route::get('/get_grab_hfconnect1/{ts_code}/{form_code}','lookupsController@get_grab_hfconnect1');
Route::get('/get_grab_hfconnect/{ts_code}','lookupsController@get_grab_hfconnect');
Route::get('/get_grab_hfm/{hf_code}','lookupsController@get_grab_hfm');
Route::get('/get_grab_healthfacilitypage/{ts_code}/{hftypeid}','lookupsController@get_grab_healthfacilitypage');
Route::get('/get_tbl_core_facility_by_code','lookupsController@get_tbl_core_facility_by_code');
Route::get('/get_tbl_core_facility_temp_by_code','lookupsController@get_tbl_core_facility_temp_by_code');
Route::get('/get_grab_last_corefacility','lookupsController@get_grab_last_corefacility');
Route::get('/get_grab_all_corefacility','lookupsController@get_grab_all_corefacility');
Route::get('/get_grab_all_corefacility_temp','lookupsController@get_grab_all_corefacility_temp');
Route::get('/get_tbl_individual_case/{cf_link_code}','lookupsController@get_tbl_individual_case');
Route::get('/get_tbl_individual_case_temp/{cf_link_code}','lookupsController@get_tbl_individual_case_temp');

Route::get('/get_tbl_org_vhv', 'lookupsController@get_tbl_org_vhv' );
Route::post('/save_tbl_org_vhv', 'lookupsController@save_tbl_org_vhv' );
Route::post('/update_tbl_org_vhv', 'lookupsController@update_tbl_org_vhv');

Route::get('/get_grab_tbl_individual_case/{cf_link_code}','lookupsController@get_grab_tbl_individual_case');
Route::get('/get_grab_tbl_individual_case_temp/{cf_link_code}','lookupsController@get_grab_tbl_individual_case_temp');
Route::post('/save_tbl_individual_case','lookupsController@save_tbl_individual_case');
Route::post('/save_tbl_individual_case_temp','lookupsController@save_tbl_individual_case_temp');
Route::post('/save_tbl_total_patient','lookupsController@save_tbl_total_patient');
Route::post('/save_tbl_total_patient_temp','lookupsController@save_tbl_total_patient_temp');
Route::post('/update_tbl_total_patient_temp','lookupsController@update_tbl_total_patient_temp');
Route::post('/update_tbl_individual_case','lookupsController@update_tbl_individual_case');
Route::post('/update_tbl_individual_case_temp','lookupsController@update_tbl_individual_case_temp');
Route::get('/forms', 'lookupsController@show_forms_page');
Route::get('/offline-forms', 'lookupsController@show_offline_forms_page');
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

Route::get('/users','lookupsController@show_users');

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

//Data Monitoring

Route::post('/data-monitoring/check_no_malaria_treatment_given','datamonitorController@check_no_malaria_treatment_given');
Route::post('/data-monitoring/check_malaria_pq_notgiven','datamonitorController@check_malaria_pq_notgiven');
Route::post('/data-monitoring/check_pf_or_mix_and_act_not_given','datamonitorController@check_pf_or_mix_and_act_not_given');
Route::post('/data-monitoring/check_pv_and_cq_not_given','datamonitorController@check_pv_and_cq_not_given');
Route::post('/data-monitoring/check_persons_with_pregnant_and_pq_given','datamonitorController@check_persons_with_pregnant_and_pq_given');
Route::post('/data-monitoring/check_under_age_1_year_and_pq_given','datamonitorController@check_under_age_1_year_and_pq_given');
Route::post('/data-monitoring/health_facilities_reported_and_forms_returned','datamonitorController@health_facilities_reported_and_forms_returned');
Route::post('/data-monitoring/check_form_number_for_each_health_facility','datamonitorController@check_form_number_for_each_health_facility');
Route::post('/data-monitoring/number_of_records_in_each_paper_form','datamonitorController@number_of_records_in_each_paper_form');
Route::post('/data-monitoring/number_of_months_reporting_delayed','datamonitorController@number_of_months_reporting_delayed');
Route::post('/data-monitoring/check_under_5_years_and_pq_given_by_vh','datamonitorController@check_under_5_years_and_pq_given_by_vh');
Route::post('/data-monitoring/check_village_and_vhv_names_onlyvhv','datamonitorController@check_village_and_vhv_names_onlyvhv');
Route::post('/data-monitoring/check_persons_with_pregnant_in_irrelevant_age','datamonitorController@check_persons_with_pregnant_in_irrelevant_age');
Route::post('/data-monitoring/check_sex_and_pregnancy','datamonitorController@check_sex_and_pregnancy');
Route::post('/data-monitoring/check_patient_screening_date','datamonitorController@check_patient_screening_date');
Route::post('/data-monitoring/check_patient_age_blank','datamonitorController@check_patient_age_blank');
Route::post('/data-monitoring/check_not_exam_and_text_missing','datamonitorController@check_not_exam_and_text_missing');
Route::post('/data-monitoring/find_duplicate_cases','datamonitorController@find_duplicate_cases');
Route::post('/data-monitoring/validate_10percent_of_data_entered_for_a_month','datamonitorController@validate_10percent_of_data_entered_for_a_month');

//Reporting
Route::post('/report/township_summary_by_period', 'reportController@township_summary_by_period');
Route::post('/report/summary_by_age_group_form_type', 'reportController@summary_by_age_group_form_type');
Route::post('/report/hf_reported_by_period', 'reportController@hf_reported_by_period');
Route::post('/report/list_of_hf_no_reports', 'reportController@list_of_hf_no_reports');
Route::post('/report/age_group_bse_result_sc', 'reportController@age_group_bse_result_sc');
Route::post('/report/age_group_rdt_result_sc', 'reportController@age_group_rdt_result_sc');
Route::post('/report/malaria_mortality_and_morbidity_sr', 'reportController@malaria_mortality_and_morbidity_sr');
Route::post('/report/antenatal_mmm_sc', 'reportController@antenatal_mmm_sc');
Route::post('/report/under5_mmm_sc', 'reportController@under5_mmm_sc');
Route::post('/report/species_wise_examination_result_sc', 'reportController@species_wise_examination_result_sc');
Route::post('/report/summary_report_sc', 'reportController@summary_report_sc');
Route::post('/report/data_in_text_sr', 'reportController@data_in_text_sr');
Route::post('/report/summary_report_rhs', 'reportController@summary_report_rhc');
Route::post('/report/townships_reported_by_period', 'reportController@townships_reported_by_period');
Route::post('/report/summary_examined_report_period', 'reportController@summary_examined_report_period');
Route::post('/report/summary_case_report_period', 'reportController@summary_case_report_period');
Route::post('/report/summary_report_of_hf_sr', 'reportController@summary_report_of_hf_sr');
Route::post('/report/township_hf_reported_percent', 'reportController@township_hf_reported_percent');
Route::post('/report/generate_pudr_form_b', 'reportController@generate_pudr_form_b');
Route::post('/report/generate_pudr_annex_e', 'reportController@generate_pudr_annex_e');
Route::post('/report/malaria_mortality_and_morbidity_sc','reportController@malaria_mortality_and_morbidity_sc');


Route::get('/fetch_data', 'syncController@fetch_data');
Route::get('/pure-login', 'lookupsController@pure_login');
Route::post('/pure_login_auth', 'lookupsController@pure_login_auth');

Route::get('/write_status', 'syncController@write_status_check');

//Charts
Route::get('/chart_exam_and_positive_all','reportController@chart_exam_and_positive_all');
Route::get('/chart_rhc_exam_and_positive','reportController@chart_rhc_exam_and_positive');
Route::get('/chart_exam_and_positve_micrordt','reportController@chart_exam_and_positve_micrordt');
Route::get('/chart_reported_percentages','reportController@chart_reported_percentages');