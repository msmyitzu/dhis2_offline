<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\lp_township;
use App\tbl_hfm ;

class datamonitorController extends Controller
{
    //check_no_malaria_treatment_given
	public function check_no_malaria_treatment_given(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));
		//return $request->input("select_lp_township_dm").'/'.$request->input("select_lp_form_cat_dm");
		//MMR015017/4
		$data = DB::select(
			"select * from Clean_Negative_TreatGiven where (pyear=? and pmonth=? and ts_code=?)", [
				$year,
				$month,
				$request->input("select_lp_township_dm")
			]
		);

		$header_text = "No Malaria but Treatment Given";
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function check_malaria_pq_notgiven(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));
		//return $request->input("select_lp_township_dm").'/'.$request->input("select_lp_form_cat_dm");
		//MMR015017/4
		$data = DB::select(
			"select * from Clean_Positive_PQNotGiven where (pyear=? and pmonth=? and ts_code=?)", [
				$year,
				$month,
				$request->input("select_lp_township_dm")
			]
		);

		$header_text = "Malaria but PQ Not Given";
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function check_pf_or_mix_and_act_not_given(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select * from Clean_PFMix_NotACT where (pyear=? and pmonth=? and ts_code=?)", [
				$year,
				$month,
				$request->input("select_lp_township_dm")
			]
		);

		$header_text = "PF or Mix and ACT not Given or CQ Given";
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function check_pv_and_cq_not_given(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select * from Clean_PV_NotCQ where (pyear=? and pmonth=? and ts_code=?)", [
				$year,
				$month,
				$request->input("select_lp_township_dm")
			]
		);

		$header_text = "PV and CQ not Given or ACT Given";
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function check_persons_with_pregnant_and_pq_given(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select * from Clean_Preg_PQGiven where (pyear=? and pmonth=? and ts_code=?)", [
				$year,
				$month,
				$request->input("select_lp_township_dm")
			]
		);

		$header_text = "Pregnant Persons with PQ Given";
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function check_under_age_1_year_and_pq_given(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select * from Clean_UnderOne_PQGiven where (pyear=? and pmonth=? and ts_code=?)", [
				$year,
				$month,
				$request->input("select_lp_township_dm")
			]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

		$header_text = 'Under Age 1 year with PQ Given';

        //return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function health_facilities_reported_and_forms_returned(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));
		/*return $month."/".$year."/".$request->input("select_lp_township_dm")."/".$request->input("select_lp_form_cat_dm")
		."/".$request->input("select_lp_stateregion_dm");*/

		$no_data = 'false' ;

		$data = DB::select(
			"select ts_name, hf_name, sc_name, Number_Of_Forms from Grab_HFReported where (pyear=? and pmonth=? and ts_code=? and sr_code=?)", [
				$year,
				$month,
				$request->input("select_lp_township_dm"),
				$request->input("select_lp_stateregion_dm")
			]
		);

		$reported_hf_count = DB::select("select sum(Number_Of_Forms) as sum from Grab_HFReported where (pyear=? and pmonth=? and ts_code=? and sr_code=?)", [
				$year,
				$month,
				$request->input("select_lp_township_dm"),
				$request->input("select_lp_stateregion_dm")
			]
		);

		$total_hfm = tbl_hfm::count();

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

		$header_text = 'Health Facility Reported and Form Returned';

		if(count($data) == '0'){
			$no_data = "true" ;
		}

        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township', 'reported_hf_count', 'no_data', 'total_hfm'));
	}


	public function check_form_number_for_each_health_facility(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select ts_name, hf_name, sc_name, Form_No from Grab_FormNumber where (pyear=? and pmonth=? and ts_code=? and sr_code=?)", [
				$year,
				$month,
				$request->input("select_lp_township_dm"),
				$request->input("select_lp_stateregion_dm")
			]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

		$header_text = 'Form Number of each Health Facility';

        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function number_of_records_in_each_paper_form(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$no_data = 'false' ;

		$data = DB::select(
			"select ts_name, hf_name, sc_name, Form_No, Number_Of_Records from Grab_Records_Per_Form where (pyear=? and pmonth=? and ts_code=? and sr_code=?)", [
				$year,
				$month,
				$request->input("select_lp_township_dm"),
				$request->input("select_lp_stateregion_dm")
			]
		);

		$reported_hf_count = DB::select("select count(Number_Of_Forms) as sum from Grab_HFReported where (pyear=? and pmonth=? and ts_code=? and sr_code=?)", [
				$year,
				$month,
				$request->input("select_lp_township_dm"),
				$request->input("select_lp_stateregion_dm")
			]
		);

		$total_hfm = tbl_hfm::count();

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

		$header_text = 'Number of records in Each Paper Form';

		if (count($data) == '0') {
			$no_data = 'true' ;
		}

        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township', 'no_data', 'reported_hf_count', 'total_hfm'));
	}

	public function number_of_months_reporting_delayed(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select sr_name, ts_name, form_name, sc_name, Program_Date, Data_Entry_Date, Month_Delayed from Grab_ProgramvsDEMonth where (pyear=? and pmonth=? and ts_code=? and sr_code=?)", [
				$year,
				$month,
				$request->input("select_lp_township_dm"),
				$request->input("select_lp_stateregion_dm")
			]
		);


		//SQLite doesn't have date compare function. So, "Month_Delayed" must be calculated manually.
		foreach($data as $d)
		{
			$program_date = $d->Program_Date;
			$de_date = $d->Data_Entry_Date;
			$date = date_create(substr($de_date, 0, 10));
			$date = date_format($date, 'Y-m-d');

			$to = \Carbon\Carbon::createFromFormat('Y-m-d', $_date);
			$from = \Carbon\Carbon::createFromFormat('Y-m-d', $date);

			$diff_in_months = $to->diffInMonths($from);

			$d->Month_Delayed = $diff_in_months;
		}

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

		$header_text = 'Number of Months reporting Delayed';

        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function check_under_5_years_and_pq_given_by_vh(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select * from Clean_UnderFive_PQGiven_VHV where (PMonth=? and PYear=? and TS_Code=?)", [
				$month,
				$year,
				$request->input("select_lp_township_dm")
			]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

				$header_text = 'Under 5 years and PQ given by VH';

        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function check_village_and_vhv_names_onlyvhv(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select * from Grab_FormNumberVHV where (pmonth=? and pyear=? and ts_code=? and sr_code=?)", [
				$month,
				$year,
				$request->input("select_lp_township_dm"),
				$request->input("select_lp_stateregion_dm")
			]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

				$header_text = 'Check Village and VHV Names (ONLY VHV)';

        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function check_persons_with_pregnant_in_irrelevant_age(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select * from Clean_Age_Preg where (pmonth=? and pyear=? and ts_code=?)", [
				$month,
				$year,
				$request->input("select_lp_township_dm")
			]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

				$header_text = 'Persons with Pregnant in Irrelevant Age';

        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function check_sex_and_pregnancy(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select * from Clean_Sex_Preg where (pmonth=? and pyear=? and ts_code=?)", [
				$month,
				$year,
				$request->input("select_lp_township_dm")
			]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

				$header_text = 'Check Sex and Pregnancy';

        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function check_patient_screening_date(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select * from Clean_Screening_Date where (pmonth=? and pyear=? and ts_code=?)", [
				$month,
				$year,
				$request->input("select_lp_township_dm")
			]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

		$header_text = 'Check Patient Screening Date';

        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function check_patient_age_blank(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select * from clean_patient_age where (pmonth=? and pyear=? and ts_code=?)", [
				$month,
				$year,
				$request->input("select_lp_township_dm")
			]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

		$header_text = 'Check Patient Age Blank';

        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function check_not_exam_and_text_missing(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select * from Clean_NotExam_Missing where (pmonth=? and pyear=? and ts_code=?)", [
				$month,
				$year,
				$request->input("select_lp_township_dm")
			]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

				$header_text = "Check Not Exam and Text-missing";

        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function find_duplicate_cases(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$data = DB::select(
			"select TS_Name, Year, Month, Form_Type, SC_Name, Form_No, row_no, Screening_Date, Pt_Name, Age_Year, Pt_Location, Pt_Address,
			Sex, Microscopy, RDT, row_count, Form_Code from Find_DuplicatedCases_TS_NEW where (PMonth=? and PYear=?)", [
				$month,
				$year
			]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

		$header_text = 'Find Duplicate Cases';

        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township'));
	}

	public function validate_10percent_of_data_entered_for_a_month(Request $request)
	{
		list($month, $year) = explode('/', $request->input("dm-form-date"));

		$no_data = "false" ;

		$data = DB::select(
			"select form_name, sr_name, ts_name, hf_name, sc_name, Form_No, row_no, ok, de, form from Year_Month_Validation_TS_new
			where (pmonth=? and pyear=? and ts_code=? and sr_code=?)", [
				$month,
				$year,
				$request->input("select_lp_township_dm"),
				$request->input("select_lp_stateregion_dm")
			]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

		$header_text = 'Vlidate 10% of Data Entered for A Month';

		if(count($data) == '0'){
			$no_data = "true" ;
		}
        // return response()->json($data , 200, $header, JSON_UNESCAPED_UNICODE);
		$township_code = $request->input('select_lp_township_dm');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
		return view('report-template.datamonitor',compact('data','header_text', 'township', 'no_data'));
	}
}
