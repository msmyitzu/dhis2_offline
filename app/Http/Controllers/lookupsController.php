<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\lp_district;
use App\lp_act_code;
use App\lp_form_cat;
use App\lp_hftype;
use App\lp_hftype_formcat;
use App\lp_in_out_cat;
use App\lp_inouttpa_formcat;
use App\lp_malaria_strata;
use App\lp_micro_result;
use App\lp_org;
use App\lp_patient_location;
use App\lp_patient_sex;
use App\lp_pmonth;
use App\lp_pyear;
use App\lp_rdt_result;
use App\lp_state_region;
use App\lp_township;
use App\lp_treatment_given;
use App\lp_yesno;
use App\tbl_hfm;
use App\grab_hfconnect1;
use App\grab_hfm;
use App\grab_healthfacilitypage;
use App\tbl_core_facility;
use App\tbl_individual_case;
use App\tbl_core_facility_temp;
use App\tbl_individual_case_temp;
use App\grab_last_corefacility;
use App\grab_last_corefacility_temp;
use App\grab_all_corefacility;
use App\grab_all_corefacility_temp;
use App\lp_occupation;
use App\tbl_total_patient;
use App\tbl_total_patient_temp;
use App\grab_tbl_individual_case;
use App\grab_tbl_individual_case_temp;
use App\tbl_org_vhv;
use App\tbl_org_vhv_temp;
use App\tbl_village;
use Auth;
use App\User;
use App\grab_users;
use App\user_role;
use App\grab_tbl_hfm_by_region;
use Hash;
use Illuminate\Support\Facades\Crypt;
use Session ;

class lookupsController extends Controller
{

    protected $API_URL = "https:/www.myanmarvbdc.com/" ;

    public function get_grab_all_corefacility()
    {
        $grab_all_corefacility = grab_all_corefacility::all();

        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return response()->json($grab_all_corefacility , 200, $header, JSON_UNESCAPED_UNICODE);

    }

    public function get_grab_all_corefacility_temp()
    {
        $grab_all_corefacility_temp = grab_all_corefacility_temp::orderBy('desc');

        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return response()->json($grab_all_corefacility_temp , 200, $header, JSON_UNESCAPED_UNICODE);

    }

public function show_entry_2_page(){

    return view('nmcp-template.data-entry-2');
}

    //start for entry-_2blade
    public function get_lp_state_region_for_entry_2()
	{
        $lp_state_region = lp_state_region::all();

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return response()->json($lp_state_region , 200, $header, JSON_UNESCAPED_UNICODE);
	}
    //end for entry_2blade

    public function show_forms_page()
    {
        try{
            if(Auth::check())
            {
                if(session('role_id') == '3') // township level
                {
                    $ts_code = session('region_code') ;
                    $name = strtoupper(Auth::user()->name);
                    $grab_all_corefacility = grab_all_corefacility::where('ts_code', '=', $ts_code)
                                            ->orderBy('CF_Code', 'desc')->get();
                    return view('nmcp-template.forms',compact('grab_all_corefacility','name'));
                }else if(session('role_id') == '2'){
                    $sr_code = session('region_code');
                    $name = strtoupper(Auth::user()->name);
                    $grab_all_corefacility = grab_all_corefacility::where('sr_code', '=', $sr_code)
                                            ->orderBy('CF_Code', 'desc')->get();
                    return view('nmcp-template.forms',compact('grab_all_corefacility','name'));
                }
            }else{
                return redirect('login');
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function show_offline_forms_page()
    {
        if($user = Auth::user())
        {
            if(session('role_id') == '3') // township level
            {
                $ts_code = session('region_code') ;
                $name = strtoupper(Auth::user()->name);
                $grab_all_corefacility_temp = grab_all_corefacility_temp::where('ts_code', '=', $ts_code)
                                        ->orderBy('CF_Code', 'desc')->get();
                return view('nmcp-template.forms-offline',compact('grab_all_corefacility_temp','name'));
            }else if(session('role_id') == '2'){ // state/region level
                $sr_code = session('region_code');
                $name = strtoupper(Auth::user()->name);
                $grab_all_corefacility_temp = grab_all_corefacility_temp::where('sr_code', '=', $sr_code)
                                        ->orderBy('CF_Code', 'desc')->get();
                return view('nmcp-template.forms-offline',compact('grab_all_corefacility_temp','name'));
            }else{
                return session('role_id');
            }
        }
        else {
            return redirect('login');
        }
    }

    public function get_grab_last_corefacility()
    {
        if(Auth::check()) {
            $ts_code = session()->get('region_code');
            $last_corefacility_id = tbl_core_facility_temp::where('TS_Code', $ts_code)->max('CF_Code');
            $grab_last_corefacility = grab_last_corefacility_temp::where('CF_Code','=', $last_corefacility_id)->get();

            $header = array (
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );

            return response()->json($grab_last_corefacility , 200, $header, JSON_UNESCAPED_UNICODE);

        }else {
            return redirect('/login');
        }
    }

    public function get_grab_healthfacilitypage($ts_code, $hftypeid)
    {
        try{
            $grab_healthfacilitypage = grab_healthfacilitypage::where([
                ['TS_Code', '=', $ts_code],
                ['HFTypeID', '=', $hftypeid]
            ])->orderBy('SC_Name')->get();

            $header = array (
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );

            return response()->json($grab_healthfacilitypage , 200, $header, JSON_UNESCAPED_UNICODE);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_lp_district($sr_id)
    {
        $lp_district = lp_district::where('sr_id','=', $sr_id)->get();

        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return response()->json($lp_district , 200, $header, JSON_UNESCAPED_UNICODE);
    }

    public function get_lp_act_code()
    {
        $lp_act_code = lp_act_code::all();
        return $lp_act_code;
    }

    public function get_tbl_core_facility_by_code(Request $request)
    {
        $cf_link_code = tbl_core_facility::where([
            ['Form_Code', '=', $request->input("form_code")],
            ['Form_No', '=', $request->input("form_no")],
            ['SC_Code', '=', $request->input("sc_code")],
            ['PMonth', '=', $request->input("pmonth")],
            ['PYear', '=', $request->input("pyear")]
        ])->value('cf_link_code');

        return $cf_link_code;
    }

    public function get_tbl_core_facility_temp_by_code(Request $request)
    {
        $cf_link_code = tbl_core_facility_temp::where([
            ['Form_Code', '=', $request->input("form_code")],
            ['Form_No', '=', $request->input("form_no")],
            ['SC_Code', '=', $request->input("sc_code")],
            ['PMonth', '=', $request->input("pmonth")],
            ['PYear', '=', $request->input("pyear")]
        ])->first();
        if($cf_link_code){
            if($cf_link_code->sync == 1){
                return '1';
            }else{
                return $cf_link_code->cf_link_code ;
            }
        }else{
            return '0';
        }
    }

    public function delete_tbl_individual_by_code($p_number){
        try{
            if(Auth::check()){
                if($p_number){
                    $tbl_individual_case_temp = tbl_individual_case_temp::where('P_Number', '=', $p_number);
                    $tbl_individual_case_temp->delete();
                    return '1';
                }
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function delete_tbl_core_facility_by_code($cf_link_code)
    {
        if($cf_link_code){
            $tbl_core_facility_temp = tbl_core_facility_temp::where('cf_link_code', '=', $cf_link_code);
            $tbl_individual_case_temp = tbl_individual_case_temp::where('cf_link_code', '=', $cf_link_code);
            $tbl_org_vhv = tbl_org_vhv_temp::where('cf_link_code', '=', $cf_link_code);
            $tbl_total_patient_temp = tbl_total_patient_temp::where('cf_link_code', '=', $cf_link_code);
            $tbl_individual_case_temp->delete() ;
            $tbl_core_facility_temp->delete();
            $tbl_org_vhv->delete();
            $tbl_total_patient_temp->delete();
            return '1';
        }
    }

    public function get_lp_form_cat()
    {
        $lp_form_cat = lp_form_cat::orderBy('form_name')->get();
        return $lp_form_cat;
    }

    public function get_lp_hftype()
    {
        $lp_hftype = lp_hftype::all();

        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return response()->json($lp_hftype , 200, $header, JSON_UNESCAPED_UNICODE);
    }

    public function get_lp_hftype_formcat()
    {
        $lp_hftype_formcat = lp_hftype_formcat::all();
        return $lp_hftype_formcat;
    }

    public function get_lp_in_out_cat()
    {
        $lp_in_out_cat = lp_in_out_cat::all();
        return $lp_in_out_cat;
    }

    public function get_lp_inouttpa_formcat()
    {
        $lp_inouttpa_formcat = lp_inouttpa_formcat::all();
        return $lp_inouttpa_formcat;
    }

    public function get_lp_malaria_strata()
    {
        $lp_malaria_strata = lp_malaria_strata::all();
        return $lp_malaria_strata;
    }

	public function get_lp_micro_result()
	{
		$lp_micro_result = lp_micro_result::all();
		return $lp_micro_result;
	}

	public function get_lp_org()
	{
		$lp_org = lp_org::all();
		return $lp_org;
	}

	public function get_lp_patient_location()
	{
		$lp_patient_location = lp_patient_location::all();
		return $lp_patient_location;
	}

	public function get_lp_patient_sex()
	{
		$lp_patient_sex = lp_patient_sex::all();
		return $lp_patient_sex;
	}

	public function get_lp_pmonth()
	{
		$lp_pmonth = lp_pmonth::all();
		return $lp_pmonth;
	}

	public function get_lp_pyear()
	{
		$lp_pyear = lp_pyear::all();
		return $lp_pyear;
    }

    public function get_lp_rdt_result(){
        $lp_rdt_result = lp_rdt_result::all();
        return $lp_rdt_result;
    }

	public function get_lp_state_region()
	{
        $lp_state_region = lp_state_region::all();

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return response()->json($lp_state_region , 200, $header, JSON_UNESCAPED_UNICODE);
	}



	public function get_lp_township($sr_code)
	{
        try{

            if($sr_code === "all"){
                $lp_township = lp_township::all();
            } else {
                $lp_township = lp_township::where('ts_code','LIKE', $sr_code.'%')->orderBy('ts_name')->get();
            }

            $header = array (
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );

            return response()->json($lp_township , 200, $header, JSON_UNESCAPED_UNICODE);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_tbl_hfm()
	{
        try{
            $tbl_hfm = tbl_hfm::take(100)->orderBy('SC_Name')->get();

            $header = array (
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );

            return response()->json($tbl_hfm , 200, $header, JSON_UNESCAPED_UNICODE);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
	}

	public function get_lp_treatment_given()
	{
		$lp_treatment_given = lp_treatment_given::all();
		return $lp_treatment_given;
	}

	public function get_lp_yesno()
	{
		$lp_yesno = lp_yesno::all();
		return $lp_yesno;
    }

    public function ShowMainTabs()
    {

        if($user = Auth::user())
        {
            //Select only related region depends on user role
            if(session('role_id') === 2)
            {
                //role_id 2 is State level
                $sr_code = session('region_code');
                $lp_state_region = lp_state_region::where('sr_code','=',$sr_code)->orderBy('sr_name')->get();
                $lp_township = [] ;
                //return $lp_state_region;
            }
            else if(session('role_id') === "3")
            {
                //role_id 3 is Township level
                $ts_code = lp_township::where('ts_code','=', session('region_code'))->pluck('ts_code')->first();
                //ts_code = MMR001001    sr_code = MMR001
                $sr_code = substr($ts_code, 0, 6);
                $lp_state_region = lp_state_region::where('sr_code','=', $sr_code)->orderBy('sr_name')->get();
                $lp_township = lp_township::where('ts_code','=', $ts_code)->get();
            }
            else
            {
                //role_id 1 is Admin. Select everything

                $lp_state_region = lp_state_region::orderBy('sr_name')->get();
                $lp_township = lp_township::all();
            }

            $name = strtoupper(Auth::user()->name);

            return view('adminlte-template.admin-template',compact(
                            'lp_state_region','lp_township','name'//,'grab_last_corefacility'
                        ));

        }
        else {
            return redirect('login');
        }
    }

    public function get_grab_hfconnect1($ts_code, $form_code)
	{
        try{
            $grab_hfconnect1 = grab_hfconnect1::where([
                ['TS_Code', '=', $ts_code],
                ['Form_Code', '=', $form_code]
            ])->orderBy('HF_Name')->get();

            $header = array (
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );

            return response()->json($grab_hfconnect1 , 200, $header, JSON_UNESCAPED_UNICODE);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

        public function get_grab_hfconnect($ts_code)
    {
        try {
            $grab_hfconnect = DB::table('grab_hfconnect')->where("TS_Code", "=", $ts_code)->where('status', '<>', '0')->get();

            $header = array (
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );

            return response()->json($grab_hfconnect , 200, $header, JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_grab_hfm($hf_code)
    {
        // $grab_hfm = grab_hfm::where('hf_code','=', $hf_code)->orderBy('sc_name')->get();

        $grab_hfm = DB::select('select "SC_Name" as sc_name, "SC_Name_MM" as sc_name_mm, "SC_Code" as sc_code, "HF_Code" as hf_code
                from tbl_hfm where status <> 0 and "HF_Code" = ? order by "SC_Name"', [
                $hf_code
            ]);

        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return response()->json($grab_hfm , 200, $header, JSON_UNESCAPED_UNICODE);
    }

    public function get_patient_registerform(Request $request){
        //dd($request);
        $lp_patient_location = lp_patient_location::all();
        $lp_patient_sex = lp_patient_sex::all();
        $lp_rdt_result = lp_rdt_result::all();
        $lp_treatment_given = lp_treatment_given::all();
        $lp_act_code = lp_act_code::whereNotIn('act_code', [6,9])->get();
        $lp_micro_result = lp_micro_result::all();
        // $lp_in_out_cat = lp_in_out_cat::all();
        $lp_yesno = lp_yesno::all();
        $lp_occupation = lp_occupation::all();
        $lp_org = lp_org::all();
		$tbl_village = tbl_village::where("ts_pcode", "=", $request->input('select_lp_township_de'))->orderBy('village', 'asc')->get();
        $lp_form_cat = lp_form_cat::where('form_code', '=' , $request->input("select_lp_form_cat"))->get();

        $lp_form_cat = $request->input("select_lp_form_cat");
        // dd($lp_form_cat);
        $form_number = $request->input("form_number");
        $lp_state_region = $request->input("select_lp_state_region");
        $lp_township_de = $request->input("select_lp_township_de");
        $tbl_hfm_de = $request->input("select_tbl_hfm_de");
        $hfm_de = $request->input("select_hfm_de");
        $form_date = $request->input("form-date");
        list($form_month,$form_year) = explode('/', $form_date);

        $cf_link_code = $request->input("cf_link_code");
        // return $request;
        $cf_code = "0";
        /*CF_Code == " " means this form is new. No existing record inside tbl_core_facility*/
        // return session("region_code");

        if($cf_link_code == "" /*&& $lp_form_cat == "2"*/){
            $tbl_check = tbl_core_facility_temp::where('Form_No', '=', $form_number)
                                                ->where('Form_Code', '=', $lp_form_cat)
                                                // ->where('SC_Code', '=', $hfm_de)
                                                ->where('PMonth', '=', $form_month)
                                                ->where('PYear', '=', $form_year)
                                                ->where('user_id', '=', session('userid'))
                                                ->count();
            if(!($tbl_check > 0)){
                $tbl_core_facility_temp = new tbl_core_facility_temp();
                $tbl_core_facility_temp->Form_Code = $lp_form_cat;
                $tbl_core_facility_temp->Form_No = $form_number;
                $tbl_core_facility_temp->SC_Code = $hfm_de;
                $tbl_core_facility_temp->HF_Code = $tbl_hfm_de;
                $tbl_core_facility_temp->PMonth = $form_month;
                $tbl_core_facility_temp->PYear = $form_year;
                $tbl_core_facility_temp->user_id = session("userid");
                // $tbl_core_facility_temp->user_region_code = session("region_code");
                $tbl_core_facility_temp->DE_DateTime = date('Y/m/d H:i');
                $tbl_core_facility_temp->TS_Code = $lp_township_de;
                $tbl_core_facility_temp->save();

                // $cf_code = tbl_core_facility_temp::max('CF_Code'); /* get the latest inserted id (cf_code) */
                // return $cf_code;
                $cf_code = tbl_core_facility_temp::max('cf_code'); /* get the latest inserted id (cf_code) */
                $cf_link_code = $form_number . $form_month . substr($form_year, -2) . (session("userid") * date("ds")) . $cf_code;

                $tbl_core_facility_temp->cf_link_code = $cf_link_code;
                $tbl_core_facility_temp->save();
            }
        }
        else {
            $tbl_core_facility_temp = tbl_core_facility_temp::where('cf_link_code','=', $cf_link_code)->get();
            $tbl_individual_case_temp = tbl_individual_case_temp::where('cf_link_code','=', $cf_link_code)->get();
            // $tbl_org_vhv = tbl_org_vhv_temp::where('cf_link_code', '=', $cf_link_code)->get(); // only for vhv form page
            //$cf_link_code = $tbl_core_facility_temp->cf_link_code;
			// $tbl_total_patient_temp = tbl_total_patient_temp::where('cf_link_code', '=', $cf_link_code)->get();
        }


        $lp_state_region_name = lp_state_region::where('sr_code','=',$lp_state_region)->value('sr_name');
        $lp_township_name = lp_township::where('ts_code','=',$lp_township_de)->value('ts_name');
        $tbl_hfm_sc_name = tbl_hfm::where('SC_Code','=',$tbl_hfm_de)->value('SC_Name');
        $hfm_name = tbl_hfm::where('SC_Code','=',$hfm_de)->value('SC_Name');
        $lp_form_cat_name = lp_form_cat::where('form_code','=',$lp_form_cat)->value('form_name');
        $tbl_individual_case_temp = $tbl_individual_case_temp ?? [];
         $review_mode = session('role_id') == 4 ? true : false ;

        if( $lp_form_cat == "2" || $lp_form_cat == "3" ){
            $tbl_org_vhv = tbl_org_vhv_temp::where('cf_link_code', '=', $cf_link_code)->get();
            $lp_in_out_cat = lp_in_out_cat::whereIn('ioc_code', [2,4,7,9])->get();
            return view('nmcp-template/vhv-patient-register-form',
                        compact('lp_patient_location', 'lp_patient_sex',
                                'lp_rdt_result', 'lp_treatment_given',
                                'lp_act_code', 'lp_org',
                                'lp_form_cat','form_number','lp_township_de',
                                'tbl_hfm_de','hfm_de','form_year','form_month',
                                'lp_state_region','lp_state_region_name','lp_township_name',
                                'tbl_hfm_sc_name','hfm_name','lp_form_cat_name',
                                'cf_code','lp_in_out_cat', 'tbl_individual_case_temp',
                                'lp_yesno','lp_occupation', 'tbl_org_vhv','cf_link_code',
								'tbl_village','review_mode'));

        }else{
            $tbl_total_patient_temp = tbl_total_patient_temp::where('cf_link_code', '=', $cf_link_code)->get();
            $lp_in_out_cat = lp_in_out_cat::whereNotIn('ioc_code', [0,1])->get();
            //return $tbl_individual_case_temp;
            return view('nmcp-template/patient-register-form',
                        compact('lp_patient_location', 'lp_patient_sex',
                                'lp_rdt_result', 'lp_treatment_given',
                                'lp_act_code', 'lp_micro_result',
                                'lp_form_cat','form_number','lp_township_de',
                                'tbl_hfm_de','hfm_de','form_year','form_month',
                                'lp_state_region','lp_state_region_name','lp_township_name',
                                'tbl_hfm_sc_name','hfm_name','lp_form_cat_name',
                                'cf_code','tbl_individual_case_temp','lp_in_out_cat',
                                'lp_yesno','lp_occupation','cf_link_code', 'tbl_total_patient_temp',
								'tbl_village','review_mode'));
        }
    }

    public function get_patient_registerform_offline(Request $request){

        $lp_form_cat = lp_form_cat::orderBy('form_name')->get();    //->limit(2)
        //dd($lp_form_cat);
        $lp_state_region = lp_state_region::get();
        $lp_township = lp_township::get();
        return view('parent-register-template.index',compact('lp_form_cat','lp_state_region','lp_township'));
    }

    //start for entry_2blade get_patient_registerform_for_entry_2
    // public function get_patient_registerform_for_entry_2(Request $request){
    //     $lp_patient_location = lp_patient_location::all();
    //     $lp_patient_sex = lp_patient_sex::all();
    //     $lp_rdt_result = lp_rdt_result::all();
    //     $lp_treatment_given = lp_treatment_given::all();
    //     $lp_act_code = lp_act_code::whereNotIn('act_code', [6,9])->get();
    //     $lp_micro_result = lp_micro_result::all();
    //     // $lp_in_out_cat = lp_in_out_cat::all();
    //     $lp_yesno = lp_yesno::all();
    //     $lp_occupation = lp_occupation::all();
    //     $lp_org = lp_org::all();
	// 	$tbl_village = tbl_village::where("ts_pcode", "=", $request->input('select_lp_township_de'))->orderBy('village', 'asc')->get();
    //     // $lp_form_cat = lp_form_cat::where('form_code', '=' , $request->input("select_lp_form_cat"))->get();

    //     $lp_form_cat = $request->input("select_lp_form_cat");
    //     $form_number = $request->input("form_number");
    //     $lp_state_region = $request->input("select_lp_state_region");
    //     $lp_township_de = $request->input("select_lp_township_de");
    //     $tbl_hfm_de = $request->input("select_tbl_hfm_de");
    //     $hfm_de = $request->input("select_hfm_de");
    //     $form_date = $request->input("form-date");
    //     list($form_month,$form_year) = explode('/', $form_date);

    //     $cf_link_code = $request->input("cf_link_code");
    //     // return $request;
    //     $cf_code = "0";
    //     /*CF_Code == " " means this form is new. No existing record inside tbl_core_facility*/
    //     // return session("region_code");

    //     if($cf_link_code == "" /*&& $lp_form_cat == "2"*/){
    //         $tbl_check = tbl_core_facility_temp::where('Form_No', '=', $form_number)
    //                                             ->where('Form_Code', '=', $lp_form_cat)
    //                                             // ->where('SC_Code', '=', $hfm_de)
    //                                             ->where('PMonth', '=', $form_month)
    //                                             ->where('PYear', '=', $form_year)
    //                                             ->where('user_id', '=', session('userid'))
    //                                             ->count();
    //         if(!($tbl_check > 0)){
    //             $tbl_core_facility_temp = new tbl_core_facility_temp();
    //             $tbl_core_facility_temp->Form_Code = $lp_form_cat;
    //             $tbl_core_facility_temp->Form_No = $form_number;
    //             $tbl_core_facility_temp->SC_Code = $hfm_de;
    //             $tbl_core_facility_temp->HF_Code = $tbl_hfm_de;
    //             $tbl_core_facility_temp->PMonth = $form_month;
    //             $tbl_core_facility_temp->PYear = $form_year;
    //             $tbl_core_facility_temp->user_id = session("userid");
    //             // $tbl_core_facility_temp->user_region_code = session("region_code");
    //             $tbl_core_facility_temp->DE_DateTime = date('Y/m/d H:i');
    //             $tbl_core_facility_temp->TS_Code = $lp_township_de;
    //             $tbl_core_facility_temp->save();

    //             // $cf_code = tbl_core_facility_temp::max('CF_Code'); /* get the latest inserted id (cf_code) */
    //             // return $cf_code;
    //             $cf_code = tbl_core_facility_temp::max('cf_code'); /* get the latest inserted id (cf_code) */
    //             $cf_link_code = $form_number . $form_month . substr($form_year, -2) . (session("userid") * date("ds")) . $cf_code;

    //             $tbl_core_facility_temp->cf_link_code = $cf_link_code;
    //             $tbl_core_facility_temp->save();
    //         }
    //     }
    //     else {
    //         $tbl_core_facility_temp = tbl_core_facility_temp::where('cf_link_code','=', $cf_link_code)->get();
    //         $tbl_individual_case_temp = tbl_individual_case_temp::where('cf_link_code','=', $cf_link_code)->get();
    //         // $tbl_org_vhv = tbl_org_vhv_temp::where('cf_link_code', '=', $cf_link_code)->get(); // only for vhv form page
    //         //$cf_link_code = $tbl_core_facility_temp->cf_link_code;
	// 		// $tbl_total_patient_temp = tbl_total_patient_temp::where('cf_link_code', '=', $cf_link_code)->get();
    //     }


    //     $lp_state_region_name = lp_state_region::where('sr_code','=',$lp_state_region)->value('sr_name');
    //     $lp_township_name = lp_township::where('ts_code','=',$lp_township_de)->value('ts_name');
    //     $tbl_hfm_sc_name = tbl_hfm::where('SC_Code','=',$tbl_hfm_de)->value('SC_Name');
    //     $hfm_name = tbl_hfm::where('SC_Code','=',$hfm_de)->value('SC_Name');
    //     $lp_form_cat_name = lp_form_cat::where('form_code','=',$lp_form_cat)->value('form_name');
    //     $tbl_individual_case_temp = $tbl_individual_case_temp ?? [];
    //      $review_mode = session('role_id') == 4 ? true : false ;

    //     if( $lp_form_cat == "2" || $lp_form_cat == "3" ){
    //         $tbl_org_vhv = tbl_org_vhv_temp::where('cf_link_code', '=', $cf_link_code)->get();
    //         $lp_in_out_cat = lp_in_out_cat::whereIn('ioc_code', [2,4,7,9])->get();
    //         return view('nmcp-template/vhv-patient-register-form',
    //                     compact('lp_patient_location', 'lp_patient_sex',
    //                             'lp_rdt_result', 'lp_treatment_given',
    //                             'lp_act_code', 'lp_org',
    //                             'lp_form_cat','form_number','lp_township_de',
    //                             'tbl_hfm_de','hfm_de','form_year','form_month',
    //                             'lp_state_region','lp_state_region_name','lp_township_name',
    //                             'tbl_hfm_sc_name','hfm_name','lp_form_cat_name',
    //                             'cf_code','lp_in_out_cat', 'tbl_individual_case_temp',
    //                             'lp_yesno','lp_occupation', 'tbl_org_vhv','cf_link_code',
	// 							'tbl_village','review_mode'));

    //     }else{
    //         $tbl_total_patient_temp = tbl_total_patient_temp::where('cf_link_code', '=', $cf_link_code)->get();
    //         $lp_in_out_cat = lp_in_out_cat::whereNotIn('ioc_code', [0,1])->get();
    //         //return $tbl_individual_case_temp;
    //         return view('nmcp-template/patient-register-form',
    //                     compact('lp_patient_location', 'lp_patient_sex',
    //                             'lp_rdt_result', 'lp_treatment_given',
    //                             'lp_act_code', 'lp_micro_result',
    //                             'lp_form_cat','form_number','lp_township_de',
    //                             'tbl_hfm_de','hfm_de','form_year','form_month',
    //                             'lp_state_region','lp_state_region_name','lp_township_name',
    //                             'tbl_hfm_sc_name','hfm_name','lp_form_cat_name',
    //                             'cf_code','tbl_individual_case_temp','lp_in_out_cat',
    //                             'lp_yesno','lp_occupation','cf_link_code', 'tbl_total_patient_temp',
	// 							'tbl_village','review_mode'));
    //     }
    // }
    //end for entry_2blade

    public function get_existing_form_data($cf_link_code){
        return tbl_core_facility_temp::where('cf_link_code', $cf_link_code)->get();
    }

    public function save_tbl_individual_case(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
			if($data){
				tbl_individual_case::insert($data);
				return "1";
			}else{
			    return "Edited or Updated Data Successfully Save.";
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function save_tbl_individual_case_temp(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
			if($data){
				tbl_individual_case_temp::insert($data);
				return "1";
			}else{
			    return "Edited or Updated Data Successfully Save.";
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function save_tbl_total_patient(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            if($data){
			    tbl_total_patient::insert($data);
                return "1";
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function save_tbl_total_patient_temp(Request $request)

    {
        
        try {
            $data = json_decode($request->getContent(), true);
            if($data){
                // $tbl_total_patient_temp = tbl_total_patient_temp::where([
                //     ['Total_Outpatient', '=', $data['Total_Outpatient']],
                //     ['U5_Outpatient', '=', $data['U5_Outpatient']],
                //     ['Preg_Outpatient', '=', $data['Preg_Outpatient']],
                //     ['Total_Inpatient', '=', $data['Total_Inpatient']],
                //     ['U5_Inpatient', '=', $data['U5_Inpatient']],
                //     ['Preg_Inpatient', '=', $data['Preg_Inpatient']],
                //     ['Death_Facility', '=', $data['Death_Facility']],
                //     ['cf_link_code', '=', $data['cf_link_code']]
                // ])->first();
                $tbl_total_patient_temp = tbl_total_patient_temp::where('cf_link_code', '=', $data['cf_link_code'])->count();
                if(!$tbl_total_patient_temp > 0){
                    tbl_total_patient_temp::insert($data);
                    return "1";
                }else{
                    return "2" ;
                }
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

	public function update_tbl_total_patient_temp(Request $request)
    {
		try{
            $data = json_decode($request->getContent(), true);
            $tbl_total_patient = tbl_total_patient_temp::find($data['TP_Code']);
            $tbl_total_patient->cf_link_code = $data['cf_link_code'];
            $tbl_total_patient->Total_Outpatient = $data['Total_Outpatient'];
            $tbl_total_patient->U5_Outpatient = $data['U5_Outpatient'];
            $tbl_total_patient->Preg_Outpatient = $data['Preg_Outpatient'];
            $tbl_total_patient->Total_Inpatient = $data['Total_Inpatient'];
            $tbl_total_patient->U5_Inpatient = $data['U5_Inpatient'];
            $tbl_total_patient->Preg_Inpatient = $data['Preg_Inpatient'];
            $tbl_total_patient->Death_Facility = $data['Death_Facility'];
            $tbl_total_patient->save();
            return '1';
        }catch (\Exception $e){
            return $e->getMessage();
        }
	}

    public function update_tbl_individual_case(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            //return $data["P_Number"];
            if($data) {
                $tbl_individual_case = tbl_individual_case::find($data["P_Number"]);

                $tbl_individual_case->CF_Code = $data["CF_Code"];
                $tbl_individual_case->cf_link_code = $data["cf_link_code"];
                $tbl_individual_case->Row_No = $data["Row_No"];
                $tbl_individual_case->Screening_Date = $data["Screening_Date"];
                $tbl_individual_case->Pt_Name = $data["Pt_Name"];
                $tbl_individual_case->Age_Year = $data["Age_Year"];
                $tbl_individual_case->Pt_Location = $data["Pt_Location"];
                $tbl_individual_case->Pt_Address = $data["Pt_Address"];
                $tbl_individual_case->Sex_Code = $data["Sex_Code"];
                $tbl_individual_case->Preg_YN = $data["Preg_YN"];
                $tbl_individual_case->Micro_Code = $data["Micro_Code"];
                $tbl_individual_case->RDT_Code = $data["RDT_Code"];
                $tbl_individual_case->IOC_Code = $data["IOC_Code"];
                $tbl_individual_case->ACT_Code = $data["ACT_Code"];
                $tbl_individual_case->CQ_Code = $data["CQ_Code"];
                $tbl_individual_case->PQ_Code = $data["PQ_Code"];
//              $tbl_individual_case->cqpq = $data["cqpq"];
                $tbl_individual_case->Referral_Code = $data["Referral_Code"];
                $tbl_individual_case->Malaria_Death = $data["Malaria_Death"];
                $tbl_individual_case->TG_Code = $data["TG_Code"];
                $tbl_individual_case->travel_yn = $data["travel_yn"];
                $tbl_individual_case->occupation = $data["occupation"];
                $tbl_individual_case->Remark = $data["Remark"];

                $tbl_individual_case->save();
                return "1";
            }else{
                return "No Patient Data to Update Or Save!";
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_tbl_individual_case_temp(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            //return $data["P_Number"];
            if($data) {
                $tbl_individual_case_temp = tbl_individual_case_temp::find($data["P_Number"]);
                $tbl_individual_case_temp->CF_Code = $data["CF_Code"];
                $tbl_individual_case_temp->Row_No = $data["Row_No"];
                $tbl_individual_case_temp->Screening_Date = $data["Screening_Date"];
                $tbl_individual_case_temp->Pt_Name = $data["Pt_Name"];
                $tbl_individual_case_temp->Age_Year = $data["Age_Year"];
                $tbl_individual_case_temp->Pt_Location = $data["Pt_Location"];
                $tbl_individual_case_temp->Pt_Address = $data["Pt_Address"];
                $tbl_individual_case_temp->Sex_Code = $data["Sex_Code"];
                $tbl_individual_case_temp->Preg_YN = $data["Preg_YN"];
                $tbl_individual_case_temp->Micro_Code = $data["Micro_Code"];
                $tbl_individual_case_temp->RDT_Code = $data["RDT_Code"];
                $tbl_individual_case_temp->IOC_Code = $data["IOC_Code"];
                $tbl_individual_case_temp->ACT_Code = $data["ACT_Code"];
                $tbl_individual_case_temp->CQ_Code = $data["CQ_Code"];
                $tbl_individual_case_temp->PQ_Code = $data["PQ_Code"];
                // $tbl_individual_case_temp->cqpq = $data["cqpq"];
                $tbl_individual_case_temp->Referral_Code = $data["Referral_Code"];
                $tbl_individual_case_temp->Malaria_Death = $data["Malaria_Death"];
                $tbl_individual_case_temp->TG_Code = $data["TG_Code"];
                $tbl_individual_case_temp->travel_yn = $data["travel_yn"];
                $tbl_individual_case_temp->occupation = $data["occupation"];
                $tbl_individual_case_temp->Remark = $data["Remark"];

                $tbl_individual_case_temp->save();
                return "1";
            }else{
                return "Edited or Updated Data Successfully Save.";
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_tbl_individual_case($cf_link_code)
    {
        $tbl_individual_case = tbl_individual_case::where('cf_link_code','=', $cf_link_code)->get();

        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return response()->json($tbl_individual_case , 200, $header, JSON_UNESCAPED_UNICODE);
    }

    public function get_tbl_individual_case_temp($cf_link_code)
    {
        $tbl_individual_case_temp = tbl_individual_case_temp::where('cf_link_code','=', $cf_link_code)->get();

        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return response()->json($tbl_individual_case_temp , 200, $header, JSON_UNESCAPED_UNICODE);
    }

    public function get_grab_tbl_individual_case($cf_link_code)
    {
        $tbl_individual_case = grab_tbl_individual_case::where('cf_link_code','=', $cf_link_code)->get();
        //return strlen(json_encode($tbl_individual_case));
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return response()->json($tbl_individual_case , 200, $header, JSON_UNESCAPED_UNICODE);
    }

    public function get_grab_tbl_individual_case_temp($cf_link_code)
    {
        $tbl_individual_case_temp = grab_tbl_individual_case_temp::where('cf_link_code','=', $cf_link_code)->get();

        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return response()->json($tbl_individual_case_temp , 200, $header, JSON_UNESCAPED_UNICODE);
    }

    public function save_tbl_org_vhv(Request $request)
    {
        try{
            $data = json_decode($request->getContent(), true);
            $cf_code = $data['CF_Code'];
            $cf_link_code = $data['cf_link_code'];
            $org_id = $data['Org_id'];
            $vill_code = $data['Vill_Code'];
            $vhv_name = $data['VHV_Name'];
            $tbl_org_vhv = tbl_org_vhv_temp::where([
                ['CF_Code', '=', $cf_code],
                ['cf_link_code', '=', $cf_link_code],
                ['Org_id', '=', $org_id],
                ['Vill_Code', '=', $vill_code],
                ['VHV_Name', '=', $vhv_name]
                ])->first();
            if($tbl_org_vhv){
                return "2";
            }
            else{
                tbl_org_vhv_temp::insert($data);
                return "1";
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function get_tbl_org_vhv(){
        $data = tbl_org_vhv_temp::all();
        return $data;
    }
	public function update_tbl_org_vhv(Request $request){
        try{
            $data = json_decode($request->getContent(), true);
            $orgvhv_id = $data['OrgVHV_ID'];
            $tbl_org_vhv = tbl_org_vhv_temp::find($orgvhv_id);
            $tbl_org_vhv->CF_Code = $data['CF_Code'];
            $tbl_org_vhv->Org_ID = $data['Org_id'];
            $tbl_org_vhv->Vill_Code = $data['Vill_Code'];
            $tbl_org_vhv->VHV_Name = $data['VHV_Name'];
            $tbl_org_vhv->cf_link_code = $data['cf_link_code'];
            $tbl_org_vhv->save();
            return "1";
        }catch(\Exception $e){
                return $e->getMessage();
        }
    }

    public function show_charts()
    {
        // $ts_code = session('region_code');
        // $sr_code = substr($ts_code, 0, 6);
        // dd($sr_code);
        // $lp_state_region = lp_state_region::where('sr_code','=', 'MMR011')->orderBy('sr_name')->get();
        // // dd($lp_state_region);
        // $ts_code = session('region_code');
        //         $sr_code = substr($ts_code, 0, 6);
        //         $ts_code = lp_township::where('ts_code', '=', session('region_code'))->pluck('ts_code')->first();
        //         $lp_state_region = lp_state_region::where('sr_code','=', $sr_code)->orderBy('sr_name')->get();
		// 	    $lp_township = lp_township::where('ts_code','=', $ts_code)->get();
        //         dd($lp_township );

        if(Auth::check()){
            $name = strtoupper(Auth::user()->name);

            if(session('role_id') === "1"){ // admin level
                $lp_state_region = lp_state_region::all();
            }else if(session('role_id') === '2'){ // state level
                $sr_code = session('region_code');
                $lp_state_region = lp_state_region::where('sr_code', '=', $sr_code)->orderBy('sr_name')->get();
            }else if(session('role_id') == '3'){ // township level
                // dd(session('role_id'));
                $ts_code = session('region_code');
                $sr_code = substr($ts_code, 0, 6);
                $ts_code = lp_township::where('ts_code', '=', session('region_code'))->pluck('ts_code')->first();
                $lp_state_region = lp_state_region::where('sr_code','=', $sr_code)->orderBy('sr_name')->get();
			    $lp_township = lp_township::where('ts_code','=', $ts_code)->get();
            }
            /*$examined_and_positive_agegroup = DB::select("select * from chart_examined_and_positive_agegroup");
            $examined_and_positive_hf = DB::select("select * from chart_examined_and_positive_hf");
            $examined_and_positive_vhv = DB::select("select * from chart_examined_and_positive_vhv");
            $positive_by_species = DB::select("select * from chart_positive_by_species");
            $reporting_rates = DB::select("select * from chart_reporting_rates");*/
                // dd($lp_state_region);
            return view('nmcp-template.chart',compact('name', 'lp_state_region', 'lp_township'));
        }else{
            return redirect('login');
        }
    }

    public function show_lookup_page()
    {
        if(Auth::check()){
            //$tbl_hfm = tbl_hfm::paginate(10);
            $name = strtoupper(Auth::user()->name);

            $lp_hftype = lp_hftype::all();

            if(session('role_id') == "2")
            {
                //role_id 2 is State level
                $sr_code = session('region_code');
                $lp_state_region = lp_state_region::where('sr_code','=',$sr_code)->orderBy('sr_name')->get();
            }
            else if(session('role_id') == "3")
            {
                $ts_code = session('region_code');
                $sr_code = substr($ts_code, 0, 6);
                $ts_code = lp_township::where('ts_code','=', session('region_code'))->pluck('ts_code')->first();

                $lp_state_region = lp_state_region::where('sr_code','=', $sr_code)->orderBy('sr_name')->get();
                $lp_township = lp_township::where('ts_code','=', $ts_code)->get();
            }
            else if(session('role_id') == "1")
            {
                $ts_code = session('region_code');
                $lp_state_region = lp_state_region::orderBy('sr_name')->get();
                $lp_township = lp_township::all();
            }
            else
            {
                return redirect('/login');
            }

            return view('nmcp-template.health-facilities',compact(
                'name','lp_hftype','lp_state_region',
                'ts_code', 'lp_township'
            ));
        }else{
            return redirect('/login');
        }
    }

    public function show_login()
    {
        if(Auth::check()){
            return redirect('/chart');
        }else{
            return view('adminlte-template.login');
        }
    }

    public function auth(Request $request)
    {
        $email = $request->input("email");
        $password = $request->input("password");

        // check user table
        // if not exist data in user table fetch from server
        $count = User::where('email', '=', $email)->count();
        if($count > 0){
            // check email and pass is correct or not
            if (Auth::attempt(['email' => $email, 'password' => $password])){
                $user = Auth::user();
                if($user->role_id == "2"){

                }
                session([
                    'email'=>$email,
                    'userid'=>$user->id,
                    'region_code'=>$user->region_code,
                    'role_id'=>$user->role_id,
                    'api_code'=>$user->api_code
                ]);

                //return session('email');
                return redirect('/chart');
            }else{
                return redirect('/login')->withErrors(['error' => 'Email and Password not match.']);
            }
        }else{
            return redirect('pure-login')->with('info', 'သင့်အကောင့်နှင့်သက်ဆိုင်သော ဒေတာများမရှိသေးပါ။ Online Server မှာ downloadဆွဲယူရန် Email နှင့် Password ပြန်လည်ထည့်သွင်းပါ။');
        }

        // if (Auth::attempt(['email' => $email, 'password' => $password]))
        // {
        //     $user = Auth::user();
        //     if($user->role_id == "2"){
        //     }
        //     session([
        //         'email'=>$email,
        //         'userid'=>$user->id,
        //         'region_code'=>$user->region_code,
        //         'role_id'=>$user->role_id,
        //         'api_code'=>$user->api_code
        //     ]);
        //     //return session('email');
        //     return redirect('/');
        // }
        // else {
        //     // return redirect('/login');
        //     $user = User::where('email', '=', $email)->count();
        //     return $user ;
        // }
    }

    public function pure_login()
    {
        return view('adminlte-template.pure-login');
    }

    public function pure_login_auth(Request $req)
    {
        try{
            $email = $req->input("email");
            $password = $req->input("password");
            if(Auth::attempt(['email' => $email, 'password' => $password])){
                $user = Auth::user();
                session([
                    'email'=>$email,
                    'userid'=>$user->id,
                    'region_code'=>$user->region_code,
                    'role_id'=>$user->role_id,
                    'api_code'=>$user->api_code
                ]);
                return redirect('/chart');
            }else{
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', $this->API_URL . 'fetch_data',[
                    'form_params' => [
                        'email' => $email,
                        'password' => $password
                    ]
                ]);

                $res = $response->getBody()->getContents() ;
                // return $res ;
                if($res == '99'){
                    return redirect('pure-login')->with('info', 'သင့် Email နှင့် Password ကိုဆာဗာ၌ ရှာမတွေ့ပါ။ သေချာစစ်ဆေး၍ ပြန်လည်ထည့်သွင်းပါ။');
                }else if($res == '77'){
                    return redirect('pure-login')->with('err', 'Offline Application တွင် Township Level အကောင့်သာအသုံးပြုနိုင်သည်။');
                }else{
                    $json = json_decode($res, true);
                    // return ($json);
                    if(count($json) > 0){
                        if($json['user']){
                            $user = new User() ;
                            $user->id = $json['user']['id'];
                            $user->name = $json['user']['name'];
                            $user->email = $json['user']['email'];
                            $user->password = Hash::make($password);
                            // $user->username = $json['user']['username'];
                            $user->role_id = $json['user']['role_id'];
                            $user->region_code = $json['user']['region_code'];
                            $user->api_code = $json['user']['api_code'];
                            $user->_temp = $json['user']['_temp'];
                            $user->save();

                            tbl_hfm::truncate();
                        }
                    }
                    return redirect('/login')->with('success', 'Download data success. please login again');
                }
            }
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function signout()
    {
        if($user = Auth::user())
        {
            Auth::logout();
            return redirect('/login');
        }
        else {
            return redirect('/login');
        }
    }

    public function show_users()
    {
        if($user = Auth::user())
        {
            return session('api_token');

            $name = strtoupper(Auth::user()->name);

            $users = grab_users::all();
            $user_roles = user_role::all();

            // return $users;
            return view('nmcp-template.users',compact(
                'users','name','user_roles'
            ));

        }
        else {
            return redirect('login');
        }

    }

    public function edit_users(Request $request, $action)
    {
        if($user = Auth::user())
        {
            if($action === "save")
            {
                $user = new User();

                $user->name = $request->input("txt_name");
                $user->email = $request->input("txt_email");
                $user->password = Hash::make($request->input("txt_password"));
                $user->role_id = $request->input("select_user_role");
                $user->region_code = $request->input("select_region_code");
                $user->api_code = Crypt::encryptString(str_random(40));

                $user->save();
            }
            else if($action === "delete")
            {
                User::where('id', $request->input("id"))->delete();
            }
            else if($action === "update")
            {
                $user = user::find($request->input("hidden_id"));

                $user->name = $request->input("txt_name");
                $user->email = $request->input("txt_email");
                $user->role_id = $request->input("select_user_role");
                $user->region_code = $request->input("select_region_code");
                if($request->input("txt_password") != ""){
                    $user->password = Hash::make($request->input("txt_password"));
                }

                $user->save();
            }

            return redirect('users');

        }
        else {
            return redirect('login');
        }

    }

    public function generate_token(Request $request)
    {
        $api_code = User::where('id', $request->input("userid"))->pluck('api_code')->first();

        if($api_code != ""){
            $api_code = Crypt::decryptString($api_code);

            if($api_code == $request->input("api_code")){
                return "Passed";
            }

        }
        else{
            return "Authentication failed.";
        }

    }

    public function request_token()
    {
        $api_code = Crypt::decryptString(Auth::user()->api_code);


        //CURLOPT_URL => "http://127.0.0.1:8000/generate_token?userid=".Auth::user()->id."&api_code=".$api_code,

        $data = [
            'query' => [
                            'userid' => Auth::user()->id,
                            'api_code' => $api_code
                    ]
        ];

        $client = new \GuzzleHttp\Client();
        $res = $client->get('http://127.0.0.1:8000/generate_token', $data);
        echo $res->getStatusCode(); // 200
        echo $res->getBody(); // { "type": "User", ....
    }

    public function get_vhv_dataentry_row($ts_code)
    {
		$lp_patient_location = lp_patient_location::all();
		$lp_patient_sex = lp_patient_sex::where('Sex_Code', '0')->orWhere('Sex_Code', '1')->get();
		$lp_rdt_result = lp_rdt_result::whereNotIn('r_code', ['9'])->get();
		$lp_treatment_given = lp_treatment_given::whereIn('tg_code', ['1','2','77'])->get();
		$lp_act_code = lp_act_code::whereNotIn('act_code', ['6','9'])->get();
		$lp_org = lp_org::all();
		$lp_form_cat = lp_form_cat::all();
		$lp_in_out_cat = lp_in_out_cat::whereIn('ioc_code', [2,4,7,9])->get();
		$lp_yesno = lp_yesno::whereIn('YN_Code', ['0','1','7'])->get();
        $lp_occupation = lp_occupation::all();
        $tbl_village = tbl_village::where("ts_pcode","=", $ts_code)->orderBy('village', 'asc')->get();
		return view('nmcp-template/vhv_dataentry_row',
					compact('lp_patient_location', 'lp_patient_sex',
							'lp_rdt_result', 'lp_treatment_given',
							'lp_act_code', 'lp_org', 'lp_form_cat',
							'lp_in_out_cat', 'lp_yesno', 'lp_occupation', 'tbl_village'));
	}
    public function get_patient_dataentry_row2($ts_code)
    {

		$lp_patient_location = lp_patient_location::all();
		$lp_patient_sex = lp_patient_sex::where('Sex_Code', '0')->orWhere('Sex_Code', '1')->get();
		$lp_rdt_result = lp_rdt_result::whereNotIn('r_code', ['9'])->get();
		$lp_treatment_given = lp_treatment_given::whereIn('tg_code', ['1','2','77'])->get();
		$lp_act_code = lp_act_code::whereNotIn('act_code', ['6','9'])->get();
		$lp_org = lp_org::all();
		$lp_form_cat = lp_form_cat::all();
		$lp_in_out_cat =  lp_in_out_cat::whereNotIn('ioc_code', [0,1,9])->get();
		$lp_yesno = lp_yesno::whereIn('YN_Code', ['0','1','7'])->get();
		$lp_occupation = lp_occupation::all();
        $lp_micro_result = lp_micro_result::whereNotIn('mr_code', ['5','9'])->get();
        $tbl_village = tbl_village::where("ts_pcode","=", $ts_code)->orderBy('village', 'asc')->get();


		return view('nmcp-template/patient_register_form_row',
					compact('lp_patient_location', 'lp_patient_sex',
							'lp_rdt_result', 'lp_treatment_given',
							'lp_act_code', 'lp_org', 'lp_form_cat',
							'lp_in_out_cat', 'lp_yesno', 'lp_occupation', 'lp_micro_result','tbl_village'));
	}

    public function get_patient_dataentry_row($ts_code)
    {

        $ts_code = 'MMR011010';
		$lp_patient_location = lp_patient_location::all();
		$lp_patient_sex = lp_patient_sex::where('Sex_Code', '0')->orWhere('Sex_Code', '1')->get();
		$lp_rdt_result = lp_rdt_result::whereNotIn('r_code', ['9'])->get();
		$lp_treatment_given = lp_treatment_given::whereIn('tg_code', ['1','2','77'])->get();
		$lp_act_code = lp_act_code::whereNotIn('act_code', ['6','9'])->get();
		$lp_org = lp_org::all();
		$lp_form_cat = lp_form_cat::all();
		$lp_in_out_cat =  lp_in_out_cat::whereNotIn('ioc_code', [0,1,9])->get();
		$lp_yesno = lp_yesno::whereIn('YN_Code', ['0','1','7'])->get();
		$lp_occupation = lp_occupation::all();
        $lp_micro_result = lp_micro_result::whereNotIn('mr_code', ['5','9'])->get();
        $tbl_village = tbl_village::where("ts_pcode","=", $ts_code)->orderBy('village', 'asc')->get();


		return view('nmcp-template/patient_register_form_row',
					compact('lp_patient_location', 'lp_patient_sex',
							'lp_rdt_result', 'lp_treatment_given',
							'lp_act_code', 'lp_org', 'lp_form_cat',
							'lp_in_out_cat', 'lp_yesno', 'lp_occupation', 'lp_micro_result','tbl_village'));
	}
}
