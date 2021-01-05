<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\lp_township;

class reportController extends Controller
{
    public function township_summary_by_period(Request $request)
    {
        $header_text = "Township Summary By Period";
        $data = DB::select(
			"select * from Year_Month_TSReport_SRPeriod(?,?,?)", [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_township")]
        );
        $township_code = $request->input('rpt_lp_township');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
        return view('report-template.report',compact('data','header','township'));
    }
    public function summary_by_age_group_form_type(Request $request)
    {
        $header_text = "Summary by Age Group Form Type";
        $data = DB::select(
			"select Township,form_name,AgeGroup,examined,any_positive,pf_any,pv_any,mix_any,other_by_micro,Malariadeath
			 from Year_Month_TSReport_AGProviders where sdate between ? and ? and ts_code = ?", [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_township")]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

		// $data = DB::select('select * from Year_Month_TSReport_AGProviders where sdate = "2019-08-01"') ;
		// return response()->json($data, 200, $header, JSON_UNESCAPED_UNICODE);
        
		$township_code = $request->input('rpt_lp_township');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');

		return view('report-template.report',compact('data','header_text', 'township'));
    }
    public function hf_reported_by_period(Request $request)
    {
        $header_text = "HF Reported By Period (".$request->input("rpt_sdate")." to ". $request->input("rpt_edate") .")";
		$data = DB::select(
			"select ts_name,SC_Name_MM as 'SC_Name',jan,feb,mar,apr,may,jun,jul,aug,sep,oct,nov,dec
			 from TS_HF_MonthlyReport where sdate between ? and ? and ts_code = ?", [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_township")]
		);

		$township_code = $request->input('rpt_lp_township');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');

		return view('report-template.report',compact('data','header_text', 'township'));
    }
    public function list_of_hf_no_reports(Request $request)
    {
        $data = DB::select(
			"select * from TS_HF_NoReport(?)", [
				$request->input("rpt_lp_township")
			]
		);
		$header_text = "List of HF, No Reports";

		$township_code = $request->input('rpt_lp_township');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');

		return view('report-template.report',compact('data','header_text', 'township'));
    }
    public function age_group_bse_result_sc(Request $request)
    {
		list($month, $year) = explode('-', $request->input('rpt_sdate'));
		$rpt_type = $request->input('rpt_type');
		switch($rpt_type){
			case 'reportby_sc':
				$data = DB::select(
					"select [SR_Name],[TS_Name],[PMonth],[PYear],[HF_Name],[SC_Name],[EXAMINED_Under1_M],[EXAMINED_Under1_F],
					[Positive_Under1_M],[Positive_Under1_F],[PF_Under1_M],[PF_Under1_F],[PV_Under1_M],[PV_Under1_F],
					[MIX_Under1_M],[MIX_Under1_F],[EXAMINED_1-4_M],[EXAMINED_1-4_F],[Positive_1-4_M],[Positive_1-4_F],
					[PF_1-4_M],[PF_1-4_F],[PV_1-4_M],[PV_1-4_F],[MIX_1-4_M],[MIX_1-4_F],[EXAMINED_5-9_M],[EXAMINED_5-9_F],
					[Positive_5-9_M],[Positive_5-9_F],[PF_5-9_M],[PF_5-9_F],[PV_5-9_M],[PV_5-9_F],[MIX_5-9_M],[MIX_5-9_F],
					[EXAMINED_10-14_M],[EXAMINED_10-14_F],[Positive_10-14_M],[Positive_10-14_F],[PF_10-14_M],[PF_10-14_F],
					[PV_10-14_M],[PV_10-14_F],[MIX_10-14_M],[MIX_10-14_F],[EXAMINED_15Above_M],[EXAMINED_15Above_F],
					[Positive_15Above_M],[Positive_15Above_F],[PF_15Above_M],[PF_15Above_F],[PV_15Above_M],[PV_15Above_F],
					[MIX_15Above_M],[MIX_15Above_F],[EXAMINED_Total_M],[EXAMINED_Total_F],[Positive_Total_M],[Positive_Total_F],
					[PF_Total_M],[PF_Total_F],[PV_Total_M],[PV_Total_F],[MIX_Total_M],[MIX_Total_F],[Confirmed_%_M],[Confirmed_%_F]
					from Year_Month_AgeGroup_Micro_SC where sdate between ? and ? and ts_code=? and sr_code=?", [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
				$header_text = "Age Group BSE Result SC";
				$township_code = $request->input('rpt_lp_township');
				$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
				return view('report-template.report',compact('data','header_text', 'township'));
			break;
			case 'reportby_rhc':
			$data = DB::select(
				"select [SR_Name],[TS_Name],[PMonth],[PYear],[HF_Name],SUM([EXAMINED_Under1_M]) as EXAMINED_Under1_M,SUM([EXAMINED_Under1_F]) as EXAMINED_Under1_F,
				SUM([Positive_Under1_M]) AS Positive_Under1_M,SUM([Positive_Under1_F]) AS Positive_Under1_F,SUM([PF_Under1_M]) AS PF_Under1_M,SUM([PF_Under1_F]) AS PF_Under1_F,
                SUM([PV_Under1_M]) AS PV_Under1_M,SUM([PV_Under1_F]) AS PV_Under1_F,
				SUM([MIX_Under1_M]) AS MIX_Under1_M,SUM([MIX_Under1_F]) AS MIX_Under1_F,SUM([EXAMINED_1-4_M]),SUM([EXAMINED_1-4_F]),
                SUM([Positive_1-4_M]) AS [Positive_1-4_M],SUM([Positive_1-4_F]) AS [Positive_1-4_F],
				SUM([PF_1-4_M]) AS [PF_1-4_M],SUM([PF_1-4_F]) AS [PF_1-4_F], SUM([PV_1-4_M]) AS [PV_1-4_M],SUM([PV_1-4_F]) AS [PV_1-4_F],SUM([MIX_1-4_M]) AS [MIX_1-4_M],
                SUM([MIX_1-4_F]) AS [MIX_1-4_F],SUM([EXAMINED_5-9_M]) AS [EXAMINED_5-9_M],SUM([EXAMINED_5-9_F]) AS [EXAMINED_5-9_F],
				SUM([Positive_5-9_M]) AS [Positive_5-9_M],SUM([Positive_5-9_F]) AS [Positive_5-9_F],SUM([PF_5-9_M]) AS [PF_5-9_M],SUM([PF_5-9_F]) AS [PF_5-9_F],
                SUM([PV_5-9_M]) AS [PV_5-9_M],SUM([PV_5-9_F]) AS [PV_5-9_F],SUM([MIX_5-9_M]) AS [MIX_5-9_M],SUM([MIX_5-9_F]) AS [MIX_5-9_F],
				SUM([EXAMINED_10-14_M]) AS [EXAMINED_10-14_M],SUM([EXAMINED_10-14_F]) AS [EXAMINED_10-14_F],SUM([Positive_10-14_M]) AS [Positive_10-14_M],
                SUM([Positive_10-14_F]) AS [Positive_10-14_F],SUM([PF_10-14_M]) AS [PF_10-14_M],SUM([PF_10-14_F]) AS [PF_10-14_F],
				SUM([PV_10-14_M]) AS [PV_10-14_M],SUM([PV_10-14_F]) AS [PV_10-14_F],SUM([MIX_10-14_M]) AS [MIX_10-14_M],SUM([MIX_10-14_F]) AS [MIX_10-14_F],
                SUM([EXAMINED_15Above_M]) AS [EXAMINED_15Above_M],SUM([EXAMINED_15Above_F]) AS [EXAMINED_15Above_F],
				SUM([Positive_15Above_M]) AS [Positive_15Above_M],SUM([Positive_15Above_F]) AS [Positive_15Above_F],SUM([PF_15Above_M]) AS [PF_15Above_M],
                SUM([PF_15Above_F]) AS [PF_15Above_F],SUM([PV_15Above_M]) AS [PV_15Above_M],SUM([PV_15Above_F]) AS [PV_15Above_F],
				SUM([MIX_15Above_M]) AS [MIX_15Above_M],SUM([MIX_15Above_F]) AS [MIX_15Above_F],SUM([EXAMINED_Total_M]) AS [EXAMINED_Total_M],
                SUM([EXAMINED_Total_F]) AS [EXAMINED_Total_F],SUM([Positive_Total_M]) AS [Positive_Total_M],SUM([Positive_Total_F]) AS [Positive_Total_F],
				SUM([PF_Total_M]) AS [PF_Total_M],SUM([PF_Total_F]) AS [PF_Total_F],SUM([PV_Total_M]) AS [PV_Total_M],SUM([PV_Total_F]) AS [PV_Total_F],
                SUM([MIX_Total_M]) AS [MIX_Total_M],SUM([MIX_Total_F]) AS [MIX_Total_F],SUM([Confirmed_%_M])||'%' AS [Confirmed_%_M],SUM([Confirmed_%_F])||'%' AS [Confirmed_%_F]
				from Year_Month_AgeGroup_Micro_SC where sdate between ? and ? and ts_code=? and sr_code=? 
				group by [SR_Name],[TS_Name],[PMonth],[PYear],[HF_Name]", [
					$request->input('rpt_sdate'),
					$request->input('rpt_edate'),
					$request->input("rpt_lp_township"),
					$request->input("rpt_lp_stateregion")
				]
			);
			$header_text = "Age Group BSE Result RHC";
			$township_code = $request->input('rpt_lp_township');
			$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
			return view('report-template.report',compact('data','header_text', 'township'));
			break;
		}
    }
    public function age_group_rdt_result_sc(Request $request)
    {
		list($month, $year) = explode('-', $request->input('rpt_sdate'));
		$rpt_type = $request->input('rpt_type');
		switch($rpt_type){
			case 'reportby_sc':
				$data = DB::select(
					"select [SR_Name],[TS_Name],[PMonth],[PYear],[HF_Name],[SC_Name],[EXAMINED_Under1_M],[EXAMINED_Under1_F],[Positive_Under1_M],[Positive_Under1_F],
					[PF_Under1_M],[PF_Under1_F],[PV_Under1_M],[PV_Under1_F],[MIX_Under1_M],[MIX_Under1_F],[EXAMINED_1-4_M],[EXAMINED_1-4_F],[Positive_1-4_M],
					[Positive_1-4_F],[PF_1-4_M],[PF_1-4_F],[PV_1-4_M],[PV_1-4_F],[MIX_1-4_M],[MIX_1-4_F],[EXAMINED_5-9_M],[EXAMINED_5-9_F],[Positive_5-9_M],
					[Positive_5-9_F],[PF_5-9_M],[PF_5-9_F],[PV_5-9_M],[PV_5-9_F],[MIX_5-9_M],[MIX_5-9_F],[EXAMINED_10-14_M],[EXAMINED_10-14_F],[Positive_10-14_M],
					[Positive_10-14_F],[PF_10-14_M],[PF_10-14_F],[PV_10-14_M],[PV_10-14_F],[MIX_10-14_M],[MIX_10-14_F],[EXAMINED_15Above_M],[EXAMINED_15Above_F],
					[Positive_15Above_M],[Positive_15Above_F],[PF_15Above_M],[PF_15Above_F],[PV_15Above_M],[PV_15Above_F],[MIX_15Above_M],[MIX_15Above_F],
					[EXAMINED_Total_M],[EXAMINED_Total_F],[Positive_Total_M],[Positive_Total_F],[PF_Total_M],[PF_Total_F],[PV_Total_M],[PV_Total_F],[MIX_Total_M],
					[MIX_Total_F],[Confirmed_%_M],[Confirmed_%_F]
					from Year_Month_AgeGroup_RDT_SC where sdate between ? and ? and ts_code=? and sr_code=?", [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
				$header_text = "Age Group RDT Result SC";
				$township_code = $request->input('rpt_lp_township');
				$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
				return view('report-template.report',compact('data','header_text', 'township'));
			break;
			case 'reportby_rhc':
				$data = DB::select(
					"select [SR_Name], [TS_Name], [PMonth], [PYear], [HF_Name], [EXAMINED_Under1_M],
					SUM([EXAMINED_Under1_F]) AS [EXAMINED_Under1_F],SUM([Positive_Under1_M]) AS [Positive_Under1_M],SUM([Positive_Under1_F]) AS [Positive_Under1_F],
					SUM([PF_Under1_M]) AS [PF_Under1_M],SUM([PF_Under1_F]) AS [PF_Under1_F],SUM([PV_Under1_M]) AS [PV_Under1_M],SUM([PV_Under1_F]) AS [PV_Under1_F],
					SUM([MIX_Under1_M]) AS [MIX_Under1_M],SUM([MIX_Under1_F]) AS [MIX_Under1_F],SUM([EXAMINED_1-4_M]) AS [EXAMINED_1-4_M],SUM([EXAMINED_1-4_F]) AS [EXAMINED_1-4_F],
					SUM([Positive_1-4_M]) AS [Positive_1-4_M],SUM([Positive_1-4_F]) AS [Positive_1-4_F],SUM([PF_1-4_M]) AS [PF_1-4_M],SUM([PF_1-4_F]) AS [PF_1-4_F],
					SUM([PV_1-4_M]) AS [PV_1-4_M],SUM([PV_1-4_F]) AS [PV_1-4_F],SUM([MIX_1-4_M]) AS [MIX_1-4_M],SUM([MIX_1-4_F]) AS [MIX_1-4_F],SUM([EXAMINED_5-9_M]) AS [EXAMINED_5-9_M],SUM([EXAMINED_5-9_F]) AS [EXAMINED_5-9_F],
					SUM([Positive_5-9_M]) AS [Positive_5-9_M],SUM([Positive_5-9_F]) AS [Positive_5-9_F],SUM([PF_5-9_M]) AS [PF_5-9_M],SUM([PF_5-9_F]) AS [PF_5-9_F],SUM([PV_5-9_M]) AS [PV_5-9_M],SUM([PV_5-9_F]) AS [PV_5-9_F],SUM([MIX_5-9_M]) AS [MIX_5-9_M],SUM([MIX_5-9_F]) AS [MIX_5-9_F],SUM([EXAMINED_10-14_M]) AS [EXAMINED_10-14_M],SUM([EXAMINED_10-14_F]) AS [EXAMINED_10-14_F],SUM([Positive_10-14_M]) AS [Positive_10-14_M],SUM([Positive_10-14_F]) AS [Positive_10-14_F],SUM([PF_10-14_M]) AS [PF_10-14_M],SUM([PF_10-14_F]) AS [PF_10-14_F],SUM([PV_10-14_M]) AS [PV_10-14_M],
					SUM([PV_10-14_F]) AS [PV_10-14_F],SUM([MIX_10-14_M]) AS [MIX_10-14_M],SUM([MIX_10-14_F]) AS [MIX_10-14_F],SUM([EXAMINED_15Above_M]) AS [EXAMINED_15Above_M],SUM([EXAMINED_15Above_F]) AS [EXAMINED_15Above_F],SUM([Positive_15Above_M]) AS [Positive_15Above_M],SUM([Positive_15Above_F]) AS [Positive_15Above_F],SUM([PF_15Above_M]) AS [PF_15Above_M],SUM([PF_15Above_F]) AS [PF_15Above_F],SUM([PV_15Above_M]) AS [PV_15Above_M],SUM([PV_15Above_F]) AS [PV_15Above_F],SUM([MIX_15Above_M]) AS [MIX_15Above_M],SUM([MIX_15Above_F]) AS [MIX_15Above_F],
					SUM([EXAMINED_Total_M]) AS [EXAMINED_Total_M],SUM([EXAMINED_Total_F]) AS [EXAMINED_Total_F],SUM([Positive_Total_M]) AS [Positive_Total_M],SUM([Positive_Total_F]) AS [Positive_Total_F],SUM([PF_Total_M]) AS [PF_Total_M],SUM([PF_Total_F]) AS [PF_Total_F],SUM([PV_Total_M]) AS [PV_Total_M],SUM([PV_Total_F]) AS [PV_Total_F],SUM([MIX_Total_M]) AS [MIX_Total_M],
					SUM([MIX_Total_F]) AS [MIX_Total_F],SUM([Confirmed_%_M])||'%' AS [Confirmed_%_M],SUM([Confirmed_%_F])||'%' AS [Confirmed_%_F]
				from Year_Month_AgeGroup_RDT_SC
				where sdate between ? and ? and ts_code=? and sr_code=?
				group by [SR_Name],[TS_Name],[PMonth],[PYear],[HF_Name]", [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
				$header_text = "Age Group RDT Result RHC";
				$township_code = $request->input('rpt_lp_township');
				$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
				return view('report-template.report',compact('data','header_text', 'township'));
			break;
		}
    }
    public function malaria_mortality_and_morbidity_sr(Request $request)
    {
		list($month, $year) = explode('-', $request->input('rpt_sdate'));
		$rpt_type = $request->input('rpt_type');
		switch($rpt_type){
			case 'reportby_sc':
				$sc_opd_tpa = DB::select(
					'select "PYear", "PMonth", "SR_Name", "TS_Name", "HF_Name", "SC_Name", "OPD_TPA" from SC_OPD_TPA
					where to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') >= ?
					and to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
		
				$sc_opd_mmm = DB::select(
					'select "PYear", "PMonth", "SR_Name", "TS_Name", "HF_Name", "SC_Name", "OPD_TPA", "OPD_Confirmed", "OPD_Confirmed_Percent" from SC_OPD_MMM
					where to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') >= ?
					and to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
		
				$sc_ipd_tpa = DB::select(
					'select "PYear", "PMonth", sr_name, ts_name, hf_name, "SC_Name", ipd_tpa, ipd_death from SC_IPD_TPA
					where to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') >= ?
					and to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
		
				$sc_ipd_confirmed = DB::select(
					'select "PYear", "PMonth", "sr_name", "ts_name", "hf_name", "SC_Name", "ipd_confirmed", "ipd_cm", "ipd_scm", 
					"ipd_mal_death" from SC_IPD_Confirmed
					where to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') >= ?
					and to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
		
				$sc_ipd_mmm = DB::select(
					'select "PYear", "PMonth", "sr_name", "hf_name", "SC_Name", "ipd_tpa", "ipd_confirmed", "ipd_confirmed_percent", 
					"ipd_cm", "ipd_scm", "ipd_death", "ipd_mal_death", "cfr" from SC_IPD_MMM
					where to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') >= ?
					and to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
		
				
				$data = array();
				$data["sc_opd_tpa"] = $sc_opd_tpa;
				$data["sc_opd_mmm"] = $sc_opd_mmm;
				$data["sc_ipd_tpa"] = $sc_ipd_tpa;
				$data["sc_ipd_confirmed"] = $sc_ipd_confirmed;
				$data["sc_ipd_mmm"] = $sc_ipd_mmm;
				
				$header_text = "malaria_mortality_and_morbidity_sc";
				return view('report-template.rptExport', compact('data','header_text'));
			break ;
			case 'reportby_rhc':
				$sc_opd_tpa = DB::select(
					'select "PYear", "PMonth", "sr_name", "ts_name", "hf_name", "opd_tpa" from SC_OPD_TPA
					where to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') >= ?
					and to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') <= ?
					and ts_code=? and sr_code=? group by "PYear", "PMonth", "sr_name", "ts_name", "hf_name"', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
		
				$sc_opd_mmm = DB::select(
					'select "PYear", "PMonth", "sr_name", "ts_name", "hf_name", "opd_tpa", "OPD_Confirmed", "opd_confirmed_percent" from SC_OPD_MMM
					where to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') >= ?
					and to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') <= ?
					and ts_code=? and sr_code=? group by "PYear", "PMonth", "sr_name", "ts_name", "hf_name"', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
		
				$sc_ipd_tpa = DB::select(
					'select "PYear", "PMonth", sr_name, ts_name, hf_name, ipd_tpa, ipd_death from SC_IPD_TPA
					where to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') >= ?
					and to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') <= ?
					and ts_code=? and sr_code=? group by "PYear", "PMonth", "sr_name", "ts_name", "hf_name"', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
		
				$sc_ipd_confirmed = DB::select(
					'select "PYear", "PMonth", "sr_name", "ts_name", "hf_name", "ipd_confirmed", "ipd_cm", "ipd_scm", 
					"ipd_mal_death" from SC_IPD_Confirmed
					where to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') >= ?
					and to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') <= ?
					and ts_code=? and sr_code=? group by "PYear", "PMonth", "sr_name", "ts_name", "hf_name"', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
		
				$sc_ipd_mmm = DB::select(
					'select "PYear", "PMonth", "sr_name", "hf_name", "ipd_tpa", "ipd_confirmed", "ipd_confirmed_percent", 
					"ipd_cm", "ipd_scm", "ipd_death", "ipd_mal_death", "cfr" from SC_IPD_MMM
					where to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') >= ?
					and to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') <= ?
					and ts_code=? and sr_code=? group by "PYear", "PMonth", "sr_name", "ts_name", "hf_name"', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
		
				
				$data = array();
				$data["sc_opd_tpa"] = $sc_opd_tpa;
				$data["sc_opd_mmm"] = $sc_opd_mmm;
				$data["sc_ipd_tpa"] = $sc_ipd_tpa;
				$data["sc_ipd_confirmed"] = $sc_ipd_confirmed;
				$data["sc_ipd_mmm"] = $sc_ipd_mmm;
				
				$header_text = "malaria_mortality_and_morbidity_sc";
				return view('report-template.rptExport', compact('data','header_text'));
			break;
		}
	}
	
	public function malaria_mortality_and_morbidity_sc(Request $request)	// added header only if no data (22-11-2019)
	{
		list($month, $year) = explode('-', $request->input('rpt_sdate'));
		$rpt_type = $request->input('rpt_type');
		switch($rpt_type){
			case 'reportby_sc':
				$sc_opd_tpa = DB::select(
					'select PYear, PMonth, SR_Name, TS_Name, HF_Name, SC_Name, OPD_TPA from SC_OPD_TPA
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);

				$sc_opd_mmm = DB::select(
					'select PYear, PMonth, SR_Name, TS_Name, HF_Name, SC_Name, OPD_TPA, OPD_Confirmed, OPD_Confirmed_Percent||"%" AS OPD_Confirmed_Percent from SC_OPD_MMM
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);

				$sc_ipd_tpa = DB::select(
					'select PYear, PMonth, SR_Name, TS_Name, HF_Name, SC_Name, IPD_TPA, IPD_Death from SC_IPD_TPA
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);

				$sc_ipd_confirmed = DB::select(
					'select PYear, PMonth, SR_Name, TS_Name, HF_Name, SC_Name, IPD_Confirmed, IPD_CM, IPD_SCM, 
					IPD_Mal_Death from SC_IPD_Confirmed
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);

				$sc_ipd_mmm = DB::select(
					'select PYear, PMonth, SR_Name, HF_Name, SC_Name, IPD_TPA, IPD_Confirmed, IPD_Confirmed_Percent||"%" AS IPD_Confirmed_Percent, 
					IPD_CM, IPD_SCM, IPD_Death, IPD_Mal_Death, CFR||"%" AS CFR from SC_IPD_MMM
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);

				$data = array();				
				$data["SC_OPD_TPA"] = $sc_opd_tpa ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "SC_Name" => 0, "OPD_TPA" => 0]];
				$data["SC_OPD_MMM"] = $sc_opd_mmm ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "SC_Name" => 0, "OPD_TPA" => 0, "OPD_Confirmed" => 0, "OPD_Confirmed_Percent%" => 0]];
				$data["SC_IPD_TPA"] = $sc_ipd_tpa ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "SC_Name" => 0, "IPD_TPA" => 0, "IPD_Death" => 0]];
				$data["SC_IPD_Confirmed"] = $sc_ipd_confirmed ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "SC_Name" => 0, "IPD_Confirmed" => 0, "IPD_CM" => 0, "IPD_SCM" => 0,"IPD_Mal_Death" => 0]];
				$data["SC_IPD_MMM"] = $sc_ipd_mmm ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "HF_Name" => 0, "SC_Name" => 0, "IPD_TPA" => 0, "IPD_Confirmed" => 0, "IPD_Confirmed_Percent%" => 0, "IPD_CM" => 0, "IPD_SCM" => 0, "IPD_Death" => 0, "IPD_Mal_Death" => 0, "CFR%" => 0]];
				
				$header_text = "Year_Month_Malaria_Mortality_And_Morbidity_SC";
				return view('report-template.rptExport', compact('data','header_text'));
				break ;
			case 'reportby_rhc':
				$sc_opd_tpa = DB::select(
					'select PYear, PMonth, sr_name as SR_Name, ts_name as TS_Name, hf_name as HF_Name, sum(opd_tpa) as OPD_TPA from SC_OPD_TPA
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=? group by "PYear", "PMonth", "sr_name", "ts_name", "hf_name"', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);

				$sc_opd_mmm = DB::select(
					'select PYear, PMonth, sr_name as SR_Name, ts_name as TS_Name, hf_name as HF_Name, sum(opd_tpa) as OPD_TPA, sum(OPD_Confirmed) as OPD_Confirmed, sum(opd_confirmed_percent)||"%" as OPD_Confirmed_Percent from SC_OPD_MMM
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=? group by "PYear", "PMonth", "sr_name", "ts_name", "hf_name"', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);

				$sc_ipd_tpa = DB::select(
					'select PYear, PMonth, sr_name as SR_Name, ts_name as TS_Name, hf_name as HF_Name, sum(ipd_tpa) as IPD_TPA, sum(ipd_death) as IPD_Death from SC_IPD_TPA
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=? group by "PYear", "PMonth", "sr_name", "ts_name", "hf_name"', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);

				$sc_ipd_confirmed = DB::select(
					'select PYear, PMonth, sr_name as SR_Name, ts_name as TS_Name, hf_name as HF_Name, sum(ipd_confirmed) as IPD_Confirmed, sum(ipd_cm) as IPD_CM, sum(ipd_scm) as IPD_SCM, 
					sum(ipd_mal_death) as IPD_Mal_Death from SC_IPD_Confirmed
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=? group by "PYear", "PMonth", "sr_name", "ts_name", "hf_name"', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);

				$sc_ipd_mmm = DB::select(
					'select PYear, PMonth, sr_name as SR_Name, hf_name as HF_Name, sum(ipd_tpa) as IPD_TPA, sum(ipd_confirmed) as IPD_Confirmed, sum(ipd_confirmed_percent)||"%" as IPD_Confirmed_Percent, 
					sum(ipd_cm) as IPD_CM, sum(ipd_scm) as IPD_SCM, sum(ipd_death) as IPD_Death, sum(ipd_mal_death) as IPD_Mal_Death, sum(cfr)||"%" as CFR from SC_IPD_MMM
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=? group by "PYear", "PMonth", "sr_name", "ts_name", "hf_name"', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);

				$data = array();
				$data["RHC_OPD_TPA"] = $sc_opd_tpa ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "OPD_TPA" => 0]];
				$data["RHC_OPD_MMM"] = $sc_opd_mmm ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "OPD_TPA" => 0, "OPD_Confirmed" => 0, "OPD_Confirmed_Percent%" => 0]];
				$data["RHC_IPD_TPA"] = $sc_ipd_tpa ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "IPD_TPA" => 0, "IPD_Death" => 0]];
				$data["RHC_IPD_Confirmed"] = $sc_ipd_confirmed ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "IPD_Confirmed" => 0, "IPD_CM" => 0, "IPD_SCM" => 0,"IPD_Mal_Death" => 0]];
				$data["RHC_IPD_MMM"] = $sc_ipd_mmm ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "HF_Name" => 0, "IPD_TPA" => 0, "IPD_Confirmed" => 0, "IPD_Confirmed_Percent%" => 0, "IPD_CM" => 0, "IPD_SCM" => 0, "IPD_Death" => 0, "IPD_Mal_Death" => 0, "CFR%" => 0]];
				$header_text = "Year_Month_Malaria_Mortality_And_Morbidity_RHC";
				return view('report-template.rptExport', compact('data','header_text'));
			break ;
		}
	}

    public function antenatal_mmm_sc(Request $request)			// added header only if no data (22-11-2019)
    {
		list($month, $year) = explode('-', $request->input('rpt_sdate'));
		$rpt_type = $request->input('rpt_type');
		switch($rpt_type){
			case 'reportby_sc':
				$sc_anc_opd_tpa = DB::select(
					'select PYear, PMonth, SR_Name, TS_Name, HF_Name, SC_Name, ANC_OPD_TPA from SC_ANC_OPD_TPA 
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);

				$sc_anc_opd_mmm = DB::select(
					'select PYear,PMonth,SR_Name,TS_Name,HF_Name,SC_Name,ANC_OPD_TPA,ANC_OPD_Confirmed,ANC_OPD_Confirmed_Percent||"%" AS ANC_OPD_Confirmed_Percent from SC_ANC_OPD_MMM 
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);

				$sc_anc_ipd_tpa = DB::select(
					'select PYear, PMonth, SR_Name, TS_Name, HF_Name, SC_Name, ANC_IPD_TPA, IPD_Death from SC_ANC_IPD_TPA where 
					PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);

				$sc_anc_ipd_confirmed = DB::select(
					'select PYear,PMonth,SR_Name,TS_Name,HF_Name,SC_Name,ANC_IPD_Confirmed,ANC_IPD_CM,ANC_IPD_SCM,ANC_IPD_Mal_Death from SC_ANC_IPD_Confirmed 
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);

				$sc_anc_ipd_mmm = DB::select(
					'select PYear,PMonth,SR_Name,TS_Name,HF_Name,SC_Name,ANC_IPD_TPA,ANC_IPD_Confirmed,[ANC_IPD_Confirmed_%]||"%" AS [ANC_IPD_Confirmed_%],
					ANC_IPD_CM, ANC_IPD_SCM, ANC_IPD_Mal_Death,cfr||"%" AS CFR from SC_ANC_IPD_MMM
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
				
				$data = array();
				$data["SC_ANC_OPD_TPA"] = $sc_anc_opd_tpa ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "SC_Name" => 0, "ANC_OPD_TPA" => 0]];;
				$data["SC_ANC_OPD_MMM"] = $sc_anc_opd_mmm ?: [["PYear" => 0,"PMonth" => 0,"SR_Name" => 0,"TS_Name" => 0,"HF_Name" => 0,"SC_Name" => 0,"ANC_OPD_TPA" => 0,"ANC_OPD_Confirmed" => 0,"ANC_OPD_Confirmed_Percent" => 0]];
				$data["SC_ANC_IPD_TPA"] = $sc_anc_ipd_tpa ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "SC_Name" => 0, "ANC_IPD_TPA" => 0, "IPD_Death" => 0]];
				$data["SC_ANC_IPD_Confirmed"] = $sc_anc_ipd_confirmed ?: [["PYear" => 0,"PMonth" => 0,"SR_Name" => 0,"TS_Name" => 0,"HF_Name" => 0,"SC_Name" => 0,"ANC_IPD_Confirmed" => 0,"ANC_IPD_CM" => 0,"ANC_IPD_SCM" => 0,"ANC_IPD_Mal_Death" => 0]];
				$data["SC_ANC_IPD_MMM"] = $sc_anc_ipd_mmm ?: [["PYear" => 0,"PMonth" => 0,"SR_Name" => 0,"TS_Name" => 0,"HF_Name" => 0,"SC_Name" => 0,"ANC_IPD_TPA" => 0,"ANC_IPD_Confirmed" => 0,"ANC_IPD_Confirmed_%" => 0,"ANC_IPD_CM" => 0, "ANC_IPD_SCM" => 0, "ANC_IPD_Mal_Death" => 0, "CFR" => 0]];
		
				$header_text = "Year_Month_Antenatal_MMM_SC";
				return view('report-template.rptExport', compact('data','header_text'));
			break;
			case 'reportby_rhc':
				$sc_anc_opd_tpa = DB::select(
					'select PYear, PMonth, sr_name as "SR_Name", ts_name as "TS_Name", hf_name as "HF_Name", sum(anc_opd_tpa)AS ANC_OPD_TPA from SC_ANC_OPD_TPA 
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=? group by PYear, PMonth, SR_Name, TS_Name, HF_Name', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$sc_anc_opd_mmm = DB::select(
					'select PYear,PMonth, sr_name as SR_Name, ts_name as TS_NAme, hf_name as HF_Name,
					sum(anc_opd_tpa) as ANC_OPD_TPA, sum(anc_opd_confirmed) as ANC_OPD_Confirmed, sum(anc_opd_confirmed_percent)||"%" as ANC_OPD_Confirmed_Percent from SC_ANC_OPD_MMM
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=? group by PYear, PMonth, SR_Name, TS_Name, HF_Name', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$sc_anc_ipd_tpa = DB::select(
					'select PYear, PMonth, sr_name as SR_Name, ts_name as TS_Name, hf_name as HF_Name, sum(anc_ipd_tpa) as ANC_IPD_TPA, sum(ipd_death) as IPD_Death from SC_ANC_IPD_TPA where 
					PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=? group by PYear, PMonth, SR_Name, TS_Name, HF_Name', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$sc_anc_ipd_confirmed = DB::select(
					'select PYear,PMonth,sr_name as SR_Name, ts_name as TS_Name, hf_name as HF_Name,
					sum(anc_ipd_confirmed) as ANC_IPD_Confirmed,
					sum(anc_ipd_cm) as ANC_IPD_CM,
					sum(anc_ipd_scm) as ANC_IPD_SCM,
					sum(anc_ipd_mal_death) as ANC_IPD_Mal_Death
					from SC_ANC_IPD_Confirmed 
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=? group by PYear, PMonth, SR_Name, TS_Name, HF_Name', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$sc_anc_ipd_mmm = DB::select(
					'select PYear,PMonth, sr_name as SR_Name, ts_name as TS_Name, hf_name as HF_Name,
					sum(anc_ipd_tpa) as ANC_IPD_TPA,
					sum(anc_ipd_confirmed) as ANC_IPD_Confirmed,
					sum([ANC_IPD_Confirmed_%])||"%" as [ANC_IPD_Confirmed_%],
					sum(anc_ipd_cm) as ANC_IPD_CM,
					sum(anc_ipd_scm) as ANC_IPD_SCM,
					sum(anc_ipd_mal_death) as ANC_IPD_Mal_Death,
					sum(cfr)||"%" as CFR 
					from SC_ANC_IPD_MMM
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=? group by PYear, PMonth, SR_Name, TS_Name, HF_Name', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$data = array();
				$data["RHC_ANC_OPD_TPA"] = $sc_anc_opd_tpa ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "ANC_OPD_TPA" => 0]];
				$data["RHC_ANC_OPD_MMM"] = $sc_anc_opd_mmm ?: [["PYear" => 0,"PMonth" => 0, "SR_Name" => 0, "TS_NAme" => 0, "HF_Name" => 0, "ANC_OPD_TPA" => 0, "ANC_OPD_Confirmed" => 0, "ANC_OPD_Confirmed_Percent" => 0]];
				$data["RHC_ANC_IPD_TPA"] = $sc_anc_ipd_tpa ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "ANC_IPD_TPA" => 0, "IPD_Death" => 0]];
				$data["RHC_ANC_IPD_Confirmed"] = $sc_anc_ipd_confirmed ?: [["PYear" => 0,"PMonth" => 0,"SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "ANC_IPD_Confirmed" => 0, "ANC_IPD_CM" => 0, "ANC_IPD_SCM" => 0, "ANC_IPD_Mal_Death" => 0]];
				$data["RHC_ANC_IPD_MMM"] = $sc_anc_ipd_mmm ?: [["PYear" => 0, "PMonth" => 0,  "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "ANC_IPD_TPA" => 0, "ANC_IPD_Confirmed" => 0, "ANC_IPD_Confirmed_%" => 0, "ANC_IPD_CM" => 0, "ANC_IPD_SCM" => 0, "ANC_IPD_Mal_Death" => 0, "CFR" => 0]];
		
				$header_text = "Year_Month_Antenatal_MMM_RHC";
				return view('report-template.rptExport', compact('data','header_text'));
			break;
		}
	}
	
    public function under5_mmm_sc(Request $request)				// added header only if no data (22-11-2019)
    {
		list($month, $year) = explode('-', $request->input('rpt_sdate'));
		$rpt_type = $request->input('rpt_type');
		switch($rpt_type){
			case 'reportby_sc':
				$SC_UFive_OPD_TPA = DB::select(
					'select PYear, PMonth, SR_Name, TS_Name, HF_Name, SC_Name, U5_OPD_TPA from SC_UFive_OPD_TPA
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$SC_UFive_OPD_MMM = DB::select(
					'select PYear,PMonth,SR_Name,TS_Name,HF_Name,SC_Name,U5_OPD_TPA,U5_OPD_Confirmed,U5_OPD_Confirmed_Percent||"%" AS U5_OPD_Confirmed_Percent from SC_UFive_OPD_MMM
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$SC_UFive_IPD_TPA = DB::select(
					'select PYear, PMonth, SR_Name, TS_Name, HF_Name, SC_Name, U5_IPD_TPA, IPD_Death from SC_UFive_IPD_TPA
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);

				$SC_UFive_IPD_Confirmed = DB::select(
					'select PYear, PMonth, SR_Name, TS_Name, HF_Name, SC_Name, U5_IPD_Confirmed, U5_IPD_CM, U5_IPD_CM, U5_IPD_Mal_Death from SC_UFive_IPD_Confirmed
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);

				$SC_UFive_IPD_MMM = DB::select(
					'select PYear,PMonth,SR_Name,TS_Name,HF_Name,SC_Name,U5_IPD_TPA, U5_IPD_Confirmed, U5_IPD_Confirmed_Percent||"%" AS U5_IPD_Confirmed_Percent ,
					U5_IPD_CM,U5_IPD_SCM,ipd_Death,U5_IPD_Mal_Death, CFR||"%" AS CFR from SC_UFive_IPD_MMM
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$data = array();
				$data["SC_UFive_OPD_TPA"] = $SC_UFive_OPD_TPA ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "SC_Name" => 0, "U5_OPD_TPA" => 0 ]];
				$data["SC_UFive_OPD_MMM"] = $SC_UFive_OPD_MMM ?: [["PYear" => 0,"PMonth" => 0,"SR_Name" => 0,"TS_Name" => 0,"HF_Name" => 0,"SC_Name" => 0,"U5_OPD_TPA" => 0,"U5_OPD_Confirmed" => 0,"U5_OPD_Confirmed_Percent" => 0 ]];
				$data["SC_UFive_IPD_TPA"] = $SC_UFive_IPD_TPA ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "SC_Name" => 0, "U5_IPD_TPA" => 0, "IPD_Death" => 0 ]];
				$data["SC_UFive_IPD_Confirmed"] = $SC_UFive_IPD_Confirmed ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0, "SC_Name" => 0, "U5_IPD_Confirmed" => 0, "U5_IPD_CM" => 0, "U5_IPD_CM" => 0, "U5_IPD_Mal_Death" => 0 ]];
				$data["SC_UFive_IPD_MMM"] = $SC_UFive_IPD_MMM ?: [["PYear" => 0,"PMonth" => 0,"SR_Name" => 0,"TS_Name" => 0,"HF_Name" => 0,"SC_Name" => 0,"U5_IPD_TPA" => 0, "U5_IPD_Confirmed" => 0,"U5_IPD_Confirmed_Percent" => 0,"U5_IPD_CM" => 0,"U5_IPD_SCM" => 0,"IPD_Death" => 0,"U5_IPD_Mal_Death" => 0, "CFR" => 0 ]];

				$header_text = "Year_Monthly_U5_MMM_SC";
				return view('report-template.rptExport', compact('data','header_text'));
			break;
			case 'reportby_rhc':
				$SC_UFive_OPD_TPA = DB::select(
					'select PYear, PMonth, sr_name as SR_Name, ts_name as TS_Name, hf_name as HF_Name, sum(u5_opd_tpa) as U5_OPD_TPA from SC_UFive_OPD_TPA
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=? group by PYear, PMonth, sr_name, ts_name, hf_name', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$SC_UFive_OPD_MMM = DB::select(
					'select PYear,PMonth,sr_name as SR_Name, ts_name as TS_Name, hf_name as HF_Name,
					sum(u5_opd_tpa) as U5_OPD_TPA,
					sum(u5_opd_confirmed) as U5_OPD_Confirmed,
					sum(u5_opd_confirmed_percent)||"%" as U5_OPD_Confirmed_Percent 
					from SC_UFive_OPD_MMM
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=? group by PYear, PMonth, sr_name, ts_name, hf_name', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$SC_UFive_IPD_TPA = DB::select(
					'select PYear, PMonth, sr_name as SR_Name, ts_name as TS_Name, hf_name as HF_Name, sum(u5_ipd_tpa) as U5_IPD_TPA, sum(ipd_death) as IPD_Death from SC_UFive_IPD_TPA
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?  group by PYear, PMonth, sr_name, ts_name, hf_name', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$SC_UFive_IPD_Confirmed = DB::select(
					'select PYear, PMonth, sr_name as SR_Name, ts_name as TS_Name, hf_name as HF_Name, 
					sum(u5_ipd_confirmed) as U5_IPD_Confirmed,
					sum(u5_ipd_cm) as U5_IPD_CM,
					sum(u5_ipd_scm) as U5_IPD_SCM,
					sum(u5_ipd_mal_death) as U5_IPD_Mal_Death
					from SC_UFive_IPD_Confirmed
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?  group by PYear, PMonth, sr_name, ts_name, hf_name', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$SC_UFive_IPD_MMM = DB::select(
					'select PYear,PMonth,sr_name as SR_Name, ts_name as TS_Name, hf_name as HF_Name,
					sum(u5_ipd_tpa) as U5_IPD_TPA,
					sum(u5_ipd_confirmed) as U5_IPD_Confirmed,
					sum(u5_ipd_confirmed_percent)||"%" as U5_IPD_Confirmed_Percent,
					sum(u5_ipd_cm) as U5_IPD_CM,
					sum(u5_ipd_scm) as U5_IPD_SCM,
					sum(ipd_death) as IPD_Death,
					sum(u5_ipd_mal_death) as U5_IPD_Mal_Death,
					sum(cfr)||"%" as CFR
					from SC_UFive_IPD_MMM
					where PYear || \'-0\' || PMonth || \'-\' || \'01\' >= ?
					and PYear || \'-0\' || PMonth || \'-\' || \'01\' <= ?
					and ts_code=? and sr_code=?  group by PYear, PMonth, sr_name, ts_name, hf_name', [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input('rpt_lp_township'),
						$request->input('rpt_lp_stateregion')
					]
				);
		
				$data = array();
				$data["RHC_UFive_OPD_TPA"] = $SC_UFive_OPD_TPA ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0,"U5_OPD_TPA" => 0 ]];;
				$data["RHC_UFive_OPD_MMM"] = $SC_UFive_OPD_MMM ?: [["PYear" => 0,"PMonth" => 0,"SR_Name" => 0,"TS_Name" => 0,"HF_Name" => 0,"U5_OPD_TPA" => 0,"U5_OPD_Confirmed" => 0,"U5_OPD_Confirmed_Percent" => 0 ]];;
				$data["RHC_UFive_IPD_TPA"] = $SC_UFive_IPD_TPA ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0, "HF_Name" => 0,"U5_IPD_TPA" => 0, "IPD_Death" => 0 ]];;
				$data["RHC_UFive_IPD_Confirmed"] = $SC_UFive_IPD_Confirmed ?: [["PYear" => 0, "PMonth" => 0, "SR_Name" => 0, "TS_Name" => 0,"HF_Name" => 0,  "U5_IPD_Confirmed" => 0, "U5_IPD_CM" => 0, "U5_IPD_CM" => 0, "U5_IPD_Mal_Death" => 0 ]];;
				$data["RHC_UFive_IPD_MMM"] = $SC_UFive_IPD_MMM ?: [["PYear" => 0,"PMonth" => 0,"SR_Name" => 0,"TS_Name" => 0,"HF_Name" => 0,"U5_IPD_TPA" => 0, "U5_IPD_Confirmed" => 0,"U5_IPD_Confirmed_Percent" => 0,"U5_IPD_CM" => 0,"U5_IPD_SCM" => 0,"IPD_Death" => 0,"U5_IPD_Mal_Death" => 0, "CFR" => 0 ]];;
				$header_text = "Year_Monthly_Under5_MMM_RHC";

				return view('report-template.rptExport', compact('data','header_text'));
			break;
		}
    }

	public function species_wise_examination_result_sc(Request $request) // fixed in sqlite (22-11-2019)
    {
		list($month, $year) = explode('-', $request->input('rpt_sdate'));
		$rpt_type = $request->input('rpt_type');
		switch($rpt_type){
			case 'reportby_sc':
				$data = DB::select(
					"select SR_Name,TS_Name,HF_Name,SC_Name,PYear,PMonth,RECORD, EXAMINED_by_Micro,Any_Micro_Positive,PF_by_Micro,PV_by_Micro,
					MIX_by_Micro,PMPO_by_Micro,OTH_by_Micro,SPR_Percent||'%',EXAMINED_by_RDT,Any_RDT_Positive,PF_by_RDT,PV_by_RDT,MIX_by_RDT,
					RDT_PR_Percent||'%',[Total_Confirmed_Cases_(Micro_RDT)],Total_Positive
					from Year_Month_Species_Examination_SC where sdate between ? and ? and ts_code=? and sr_code=?", [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
				$header_text = "Species Wise Examination Result SC";
				$township_code = $request->input('rpt_lp_township');
				$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
				return view('report-template.report',compact('data','header_text', 'township'));
			break;
			case 'reportby_rhc':
				$data = DB::select(
					"select SR_Name,TS_Name,HF_Name,PYear,PMonth, sum(RECORD) as RECORD, sum(EXAMINED_by_Micro) as Examined_by_Micro,sum(Any_Micro_Positive) as Any_Micro_Positive, sum(PF_by_Micro) as PF_by_Micro, sum(PV_by_Micro) as PV_by_Micro,
					sum(MIX_by_Micro) as MIX_by_Micro, sum(PMPO_by_Micro) as PMPO_by_Micro, sum(OTH_by_Micro) as OTH_by_Micro, (Round(SPR_Percent,1)) || '%' as SPR_Percent, sum(EXAMINED_by_RDT) as EXAMINED_by_RDT, sum(Any_RDT_Positive) as Any_RDT_Positive, sum(PF_by_RDT) as PF_by_RDT,
					sum(PV_by_RDT) as PV_by_RDT, sum(MIX_by_RDT) as MIX_by_RDT,
					(round(RDT_PR_Percent,1)) || '%' as RDT_PR_Percent, sum([Total_Confirmed_Cases_(Micro_RDT)]) as [Total_Confirmed_Cases_(Micro_RDT)], sum(round(Total_Positive)) as Total_Positive
					from Year_Month_Species_Examination_SC  where sdate between ? and ? and ts_code=? and sr_code=? group by SR_Name,TS_Name,HF_Name,PYear,PMonth", [
						$request->input('rpt_sdate'),
						$request->input('rpt_edate'),
						$request->input("rpt_lp_township"),
						$request->input("rpt_lp_stateregion")
					]
				);
				$header_text = "Species Wise Examination Result RHC";
				$township_code = $request->input('rpt_lp_township');
				$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');
				return view('report-template.report',compact('data','header_text', 'township'));
			break;
		}
	}
	
    public function summary_report_sc(Request $request)
    {
        $data = DB::select(
			"select * from Year_Month_Summary_Report_SC(?,?,?,?)", [
				$request->input('rpt_sdate'),
				$request->input('rpt_edate'),
				$request->input("rpt_lp_township"),
				$request->input("rpt_lp_stateregion")
			]
		);

		$header_text = "Summary Report SC";

		$township_code = $request->input('rpt_lp_township');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');

		return view('report-template.report',compact('data','header_text', 'township'));
	}
	
    public function data_in_text_sr(Request $request)
    {
        list($month, $year) = explode('-', $request->input('rpt_sdate'));
		$data = DB::select(
			'select * from Grab_RecordinText where
            to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') >= ?
            and to_date("PYear"::text || \'-\' || "PMonth"::text || \'-\' || \'1\', \'YYYY-MM-DD\') <= ? 
            and ts_code= ?
            and sr_code= ?', [
				$request->input('rpt_sdate'),
				$request->input('rpt_edate'),
				$request->input("rpt_lp_township"),
				$request->input("rpt_lp_stateregion")
			]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        $header_text = "Data In Text SR";
		
		$sr_code = $request->input('rpt_lp_stateregion');
		$township = lp_state_region::where('sr_code', '=', $sr_code)->value('sr_name_mmr');

		return view('report-template.report',compact('data','header_text', 'township'));
	}
	
    public function summary_report_rhc(Request $request)
    {
        list($month, $year) = explode('-', $request->input('rpt_sdate'));
		$data = DB::select(
			"select * from Year_Month_Summary_Report_TS(?,?,?,?)", [
				$request->input('rpt_sdate'),
				$request->input('rpt_edate'),
				$request->input("rpt_lp_township"),
				$request->input("rpt_lp_stateregion")
			]
		);

		$header_text = "Summary Report RHC";
		
		$township_code = $request->input('rpt_lp_township');
		$township = lp_township::where('ts_code', '=', $township_code)->value('ts_name_mmr');

		return view('report-template.report',compact('data','header_text', 'township'));
	}
	
    public function townships_reported_by_period(Request $request)
    {
        $data = DB::select(
			"select * from SR_MonthlyReport_Township(?,?,?)", [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_stateregion")]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        $header_text = "Townships Reported By Period";
		
		$sr_code = $request->input('rpt_lp_stateregion');
		$township = lp_state_region::where('sr_code', '=', $sr_code)->value('sr_name_mmr');

		return view('report-template.report',compact('data','header_text', 'township'));
	}
	
    public function summary_examined_report_period(Request $request)
    {
        $data = DB::select(
			"select * from SR_MonthlyReport_Township(?,?,?)", [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_stateregion")]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        $header_text = "Summary Examined Report Period";
		
		$sr_code = $request->input('rpt_lp_stateregion');
		$township = lp_state_region::where('sr_code', '=', $sr_code)->value('sr_name_mmr');

		return view('report-template.report',compact('data','header_text', 'township'));
	}
	
    public function summary_case_report_period(Request $request)
    {
        $data = DB::select(
			"select * from Year_Month_Cases_SRPeriod(?,?,?)", [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_stateregion")]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        $header_text = "Summary Case Report Period";
		
		$sr_code = $request->input('rpt_lp_stateregion');
		$township = lp_state_region::where('sr_code', '=', $sr_code)->value('sr_name_mmr');

		return view('report-template.report',compact('data','header_text', 'township'));
	}
	
    public function summary_report_of_hf_sr(Request $request)
    {
        $data = DB::select(
			"select * from SR_HF_Reported(?,?,?)", [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_stateregion")]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        $header_text = "Summary Case Report Period";
		
		$sr_code = $request->input('rpt_lp_stateregion');
		$township = lp_state_region::where('sr_code', '=', $sr_code)->value('sr_name_mmr');

		return view('report-template.report',compact('data','header_text', 'township'));
	}
	
    public function township_hf_reported_percent(Request $request)
    {
        $data = DB::select(
			"select * from SR_TS_HF_Percent(?,?,?)", [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_stateregion")]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        $header_text = "Township HF Reported Percent";
		
		$sr_code = $request->input('rpt_lp_stateregion');
		$township = lp_state_region::where('sr_code', '=', $sr_code)->value('sr_name_mmr');

		return view('report-template.report',compact('data','header_text', 'township'));
	}
	
    public function generate_pudr_form_b(Request $request)
    {
        $data = DB::select(
			"select * from SR_PUDR_Form_B(?,?,?)", [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_stateregion")]
		);

		$header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        $header_text = "PUDR Form B";
		
		$sr_code = $request->input('rpt_lp_stateregion');
		$township = lp_state_region::where('sr_code', '=', $sr_code)->value('sr_name_mmr');

		return view('report-template.report',compact('data','header_text', 'township'));
    }
    public function generate_pudr_annex_e(Request $request)
    {
        $SR_AnnexE_Test = DB::select(
			'select * from SR_AnnexE_Test(?,?,?)', [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_stateregion")
			]
		);

		$SR_AnnexE_Treatment = DB::select(
			'select * from SR_AnnexE_Treatment(?,?,?)', [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_stateregion")
			]
		);

		$SR_AnnexE_Treatment_BHSUOne = DB::select(
			'select * from SR_AnnexE_Treatment_BHSUOne(?,?,?)', [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_stateregion")
			]
		);

		$SR_AnnexE_Treatment_VHVUFive = DB::select(
			'select * from SR_AnnexE_Treatment_VHVUFive(?,?,?)', [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_stateregion")
			]
		);

		$SR_AnnexE_Treatment_AN = DB::select(
			'select * from SR_AnnexE_Treatment_AN(?,?,?)', [
				$request->input("rpt_sdate"),
				$request->input("rpt_edate"),
				$request->input("rpt_lp_stateregion")
			]
		);


		$data = array();
		$data["SR_AnnexE_Test"] = $SR_AnnexE_Test;
		$data["SR_AnnexE_Treatment"] = $SR_AnnexE_Treatment;
		$data["SR_AnnexE_Treatment_BHSUOne"] = $SR_AnnexE_Treatment_BHSUOne;
		$data["SR_AnnexE_Treatment_VHVUFive"] = $SR_AnnexE_Treatment_VHVUFive;
		$data["SR_AnnexE_Treatment_AN"] = $SR_AnnexE_Treatment_AN;

		$header_text = "generate_pudr_annex_e";
		return view('report-template.rptExport', compact('data','header_text'));
	}
	
	public function chart_exam_and_positive_all(Request $request)
	{
		//return "true";
		$examined = array();
		$positive = array();
		$all = array();
		list($day,$month,$year) = explode("-", $request->input("sdate"));

		$data_e = DB::select(
			'select * from chart_exam_and_positive_all where ts_code=? and pyear=?', [
				$request->input("ts_code"),
				$year
			]
		);

		foreach ($data_e as $value) {			
			array_push($examined, $value->jan);
			array_push($examined, $value->feb);
			array_push($examined, $value->mar);
			array_push($examined, $value->apr);
			array_push($examined, $value->may);
			array_push($examined, $value->jun);
			array_push($examined, $value->jul);
			array_push($examined, $value->aug);
			array_push($examined, $value->sep);
			array_push($examined, $value->oct);
			array_push($examined, $value->nov);
			array_push($examined, $value->dec);
		}

		$all["examined"] = $examined;

		$data_p = DB::select(
			'select * from chart_ts_positive_all where ts_code=? and pyear=?', [
				$request->input("ts_code"),
				$year
			]
		);

		foreach ($data_p as $value) {			
			array_push($positive, $value->jan);
			array_push($positive, $value->feb);
			array_push($positive, $value->mar);
			array_push($positive, $value->apr);
			array_push($positive, $value->may);
			array_push($positive, $value->jun);
			array_push($positive, $value->jul);
			array_push($positive, $value->aug);
			array_push($positive, $value->sep);
			array_push($positive, $value->oct);
			array_push($positive, $value->nov);
			array_push($positive, $value->dec);
		}

		$all["positive"] = $positive;

		//chart_ts_positive_all
		
		return $all;
	}

	public function chart_rhc_exam_and_positive(Request $request)
	{
		$rhc_names = array();
		$examined = array();
		$positive = array();
		$all = array();

		list($sday,$smonth,$syear) = explode("-", $request->input("sdate"));
		list($eday,$emonth,$eyear) = explode("-", $request->input("edate"));
		$sdate = $syear."-".$smonth."-".$sday;
		$edate = $eyear."-".$emonth."-".$eday;

		$data_e = DB::select(
			'select * from chart_rhc_exam_and_positive 
				where sdate between ? and ? and ts_code = ?', [
				$sdate,
				$edate,
				$request->input("ts_code")
			]
		);		
		//return $data_e;
		foreach ($data_e as $value) {			
			array_push($rhc_names, $value->SC_Name);
			array_push($examined, $value->examined);
			array_push($positive, $value->any_positive);
		}

		$all["rhc_names"] = $rhc_names;
		$all["examined"] = $examined;
		$all["positive"] = $positive;		
		
		return $all;
	}

	public function chart_exam_and_positve_micrordt(Request $request)
	{
		$rhc_names = array();
		$exam_micro = array();
		$exam_rdt = array();
		$positive_micro = array();
		$positive_rdt = array();
		$all = array();

		list($sday,$smonth,$syear) = explode("-", $request->input("sdate"));
		list($eday,$emonth,$eyear) = explode("-", $request->input("edate"));
		$sdate = $syear."-".$smonth."-".$sday;
		$edate = $eyear."-".$emonth."-".$eday;

		$data_e = DB::select(
			'select * from chart_exam_and_positve_micrordt 
				where sdate between ? and ? and ts_code = ?', [
				$sdate,
				$edate,
				$request->input("ts_code")
			]
		);		
		//return $data_e;
		foreach ($data_e as $value) {			
			array_push($rhc_names, $value->SC_Name);
			array_push($exam_micro, $value->examined_micro);
			array_push($exam_rdt, $value->examined_rdt);
			array_push($positive_micro, $value->positive_micro);
			array_push($positive_rdt, $value->positive_rdt);
		}

		$all["rhc_names"] = $rhc_names;
		$all["examined_micro"] = $exam_micro;
		$all["examined_rdt"] = $exam_rdt;
		$all["positive_micro"] = $positive_micro;		
		$all["positive_rdt"] = $positive_rdt;		
		
		return $all;
	}

	public function chart_reported_percentages(Request $request)
	{
		$all = array();
		$percentages = array();
		$hftypes = array();
        $total_hs = $total_rhc = $total_sc = $total_vhv = 0;
        $reported_hs = $reported_rhc = $reported_sc = $reported_vhv = 0;
        list($sday,$smonth,$syear) = explode("-", $request->input("sdate"));
		list($eday,$emonth,$eyear) = explode("-", $request->input("edate"));
		
		// $sdate = $syear."-".$smonth."-".$sday;
		// $edate = $eyear."-".$emonth."-".$eday;

		$sdate = date_create($request->input('sdate'));
		$sdate = date_format($sdate, 'Y-m-d');

		$edate = date_create($request->input('edate'));
		$edate = date_format($edate, 'Y-m-d');

        $hf_totals = DB::select('select * from chart_total_hf');
		
        foreach($hf_totals as $v){
            $total_hs = $v->total_hs;
            $total_rhc = $v->total_rhc;
            $total_sc = $v->total_sc;
            $total_vhv = $v->total_vhv;
        }
        

		// return DB::select("select a.SC_Code
		// 				from tbl_core_facility a,tbl_hfm b
		// 				where a.SC_Code = b.SC_Code
		// 				and b.HFTypeID = 'HS'
		// 				and b.ts_code = ? ", [$request->input('ts_code')]
		// 			);
		

		$reported_hs = count(
            DB::select("select a.SC_Code
                       from tbl_core_facility a,tbl_hfm b
                       where a.SC_Code = b.SC_Code
					   and b.HFTypeID = 'HS'
					   and date(a.PYear||'-'|| case when length(a.PMonth)=1 then '0'||a.PMonth else PMonth end||'-01') >= ?
					   and date(a.PYear||'-'|| case when length(a.PMonth)=1 then '0'||a.PMonth else PMonth end||'-01') <= ?
                       and b.ts_code = ?
                       group by a.SC_Code",[$sdate, $edate, $request->input("ts_code")]
					)
        );
        $reported_rhc = count(
            DB::select("select a.SC_Code
                       from tbl_core_facility a,tbl_hfm b
                       where a.SC_Code = b.SC_Code
                       and b.HFTypeID = 'RH'
                       and date(a.PYear||'-'|| case when length(PMonth)=1 then '0'||PMonth else PMonth end||'-01') >= ?
					   and date(a.PYear||'-'|| case when length(PMonth)=1 then '0'||PMonth else PMonth end||'-01') <= ?
                       and b.ts_code = ?
                       group by a.SC_Code",[$sdate, $edate, $request->input("ts_code")]
					)
        );
        $reported_sc = count(
            DB::select("select a.SC_Code
                       from tbl_core_facility a,tbl_hfm b
                       where a.SC_Code = b.SC_Code
                       and b.HFTypeID = 'SC'
                       and date(a.PYear||'-'|| case when length(PMonth)=1 then '0'||PMonth else PMonth end||'-01') >= ?
					   and date(a.PYear||'-'|| case when length(PMonth)=1 then '0'||PMonth else PMonth end||'-01') <= ?
                       and b.ts_code = ?
                       group by a.SC_Code",[$sdate, $edate, $request->input("ts_code")]
					)
        );
        $reported_vhv = count(
            DB::select("select a.SC_Code
                       from tbl_core_facility a,tbl_hfm b
                       where a.SC_Code = b.SC_Code
                       and b.HFTypeID = 'VH'
                       and date(a.PYear||'-'|| case when length(PMonth)=1 then '0'||PMonth else PMonth end||'-01') >= ?
					   and date(a.PYear||'-'|| case when length(PMonth)=1 then '0'||PMonth else PMonth end||'-01') <= ?
                       and b.ts_code = ?
                       group by a.SC_Code",[$sdate, $edate, $request->input("ts_code")]
					)
        );

        array_push($hftypes, 'HS','RHC','SC','VHV');

        
        $percentage_hs = ($total_hs==0) ? 0:($reported_hs/$total_hs) * 100;
        $percentage_rhc = ($total_rhc==0) ? 0:($reported_rhc/$total_rhc) * 100;
        $percentage_sc = ($total_sc==0) ? 0:($reported_sc/$total_sc) * 100;
        $percentage_vhv = ($total_vhv==0) ? 0:($reported_vhv/$total_vhv) * 100;
        // return round($percentage_rhc);

        array_push($percentages, round($percentage_hs));
		array_push($percentages, round($percentage_rhc));
		array_push($percentages, round($percentage_sc));
		array_push($percentages, round($percentage_vhv));

        $all["percentages"] = $percentages;		
		$all["hftypes"] = $hftypes;		

		return $all;

		// $all = array();
		// $percentages = array();
		// $hftypes = array();

		// list($sday,$smonth,$syear) = explode("-", $request->input("sdate"));
		// list($eday,$emonth,$eyear) = explode("-", $request->input("edate"));
		// $sdate = $syear."-".$smonth."-".$sday;
		// $edate = $eyear."-".$emonth."-".$eday;

		// $data_e = DB::select(
		// 	'select * from chart_reported_percentages
		// 		where pmonth between ? and ? and pyear=? and ts_code = ?', [
		// 		$smonth,
		// 		$emonth,
		// 		$eyear,
		// 		$request->input("ts_code")
		// 	]
		// );		
		// // return $data_e;	
		// array_push($hftypes, 'HS','RHC','SC','VHV');

		// foreach ($data_e as $value) {			
		// 	array_push($percentages, $value->hs);
		// 	array_push($percentages, $value->RHC);
		// 	array_push($percentages, $value->SC);
		// 	array_push($percentages, $value->VHV);
		// }

		// $all["percentages"] = $percentages;		
		// $all["hftypes"] = $hftypes;		

		// return $all;
	}
}
