<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class searchController extends Controller
{
    //search data,date

        public function search(Request $request, $type)
    {
        // dd($request->all());
		try{

            $message = [
                'sr_search.required' => 'တိုင်းနှင့်ပြည်နယ်ရွေးပါ',
                'ts_search.required' => 'မြို့နယ်ရွေးပါ',
                'sdate_search.required' => 'စတင်သည့် လရွေးပါ',
                'edate_search.required' => 'ပြီးဆုံးသည့် လရွေးပါ'
            ];

            $validator = Validator::make($request->all(), [
                'sr_search' => 'required',
                'ts_search' => 'required',
                'sdate_search' => 'required',
                'edate_search' => 'required'
            ], $message);

            if ($validator->fails()) {
                \Session::flash('errors', $validator->messages());
                // dd(session('errors')->all());
                return redirect()->back();
            }

			if(Auth::check()){
				// $name = Auth::user()->name ;
				// $state_region = session('role_id') == '1' ? \App\tbl_region::all() : \App\tbl_region::where('sr_code', session('region_code'))->get();
				switch($type){
					case "sr_search":
						$sr_code = $request->input('sr_search');
						if($sr_code){
							$tbl_core_facility = \App\tbl_core_facility::where("region_mmr", "=", $sr_code)->get();
						}
					break;
					case "ts_search":
						$ts_code = $request->input('ts_search');
						if($ts_code){
							$tbl_core_facility = \App\tbl_core_facility::where("township_mmr", "=", $ts_code)->get();
						}
					break;
					case "sdate_search":
						$sr_code = $request->input('sr_search');
						$ts_code = $request->input('ts_search');
						list($month, $year) = explode('/', $request->input('sdate_search'));
						if($month && $year){
							$tbl_core_facility =  DB::select('select * from tbl_core_facility
								where to_date("PYear" || \'-\' || "PMonth", \'YYYY-MM-DD\') >= ?
								and "ts_code" = ?
								and "sr_code" = ? order by "DE_DateTime" desc ',[
								$year . '-' . $month . '-01', $ts_code, $sr_code ]);
							}
					break;
					case "edate_search":
						$sr_code = $request->input('sr_search');
						$ts_code = $request->input('ts_search');
						list($smonth, $syear) = explode('/', $request->input('sdate_search'));
						list($emonth, $eyear) = explode('/', $request->input('edate_search'));
						if($smonth && $syear && $emonth && $eyear){
							$core_facility=  DB::select('select * from tbl_core_facility
								where to_date("PYear" || \'-\' || "PMonth", \'YYYY-MM-DD\') >= ?
								and to_date("PYear" || \'-\' || "PMonth", \'YYYY-MM-DD\') <= ?
								and "ts_code" = ?
								and "sr_code" = ? order by "DE_DateTime" desc ',[
								$syear . '-' . $smonth . '-01',
								$eyear . '-' . $emonth . '-01', $ts_code, $sr_code ]);
							}
					break;
				}
				return view('nmcp-template/form_table_section', compact('tbl_core_facility', 'state_region', 'name')) ;
			}else{
				return redirect('login');
			}
		}catch(\Exception $e){
			return $e->getMessage();
		}
	}
}
