<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_individual_case_temp;
use App\tbl_core_facility_temp;
use App\tbl_individual_case;
use App\tbl_core_facility;
use App\tbl_hfm;
use App\tbl_total_patient;
use App\tbl_org_vhv;
use App\tbl_org_vhv_temp;
use App\tbl_total_patient_temp;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;

class syncController extends Controller
{
    // protected $API_URL = "https://www.myanmarvbdc.com/" ;   //login

    protected $API_URL = "https://mcbrs-dev2.myanmarvbdc.com/api/29/me/authorities/ALL" ;

    //Upload data page
    public function show_sync_page()
    {
        if($user = Auth::user())
        {
            $api_code = Crypt::decryptString(Auth::user()->api_code);
// return $api_code;
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', $this->API_URL . 'generate_token', [
                'form_params' => [
                    'userid' => Auth::user()->id,
                    'api_code' => $api_code,
                    'user_region_code' => Auth::user()->region_code
                ]
            ]);
// dd($response);
            if($response->getStatusCode() == "200")
            {
                Session::put('api_token', (string)$response->getBody());
            }

            if($response->getBody() == "Authentication failed."){
                return "Authentication failed.";
            }

            $name = strtoupper(Auth::user()->name);
            // $tbl_core_facility_count = tbl_core_facility_temp::where('sync','=','0')->count();
            // $tbl_individual_case_count = tbl_individual_case_temp::where('sync','=','0')->count();

            // $tbl_core_facility = tbl_core_facility_temp::where('sync','=','0')->get();
            // $tbl_individual_case = tbl_individual_case_temp::where('sync','=','0')->get();

            $tbl_core_facility_count = tbl_core_facility_temp::where([['sync','=','0'],['user_region_code', '=', Auth::user()->region_code]])->count();
            $tbl_individual_case_count = tbl_individual_case_temp::where('sync', '=', '0')->count();
            $tbl_individual_case = DB::table('tbl_individual_case_temp')
                                    ->join('tbl_core_facility_temp', 'tbl_core_facility_temp.cf_link_code', '=','tbl_individual_case_temp.cf_link_code')
                                    ->where('tbl_core_facility_temp.user_region_code', '=', Auth::user()->region_code)
                                    ->where('tbl_core_facility_temp.sync', '=', '0')
                                    ->get();

            if($tbl_core_facility_count + $tbl_individual_case_count > 0){
                $size = (int)mb_strlen($tbl_core_facility_count) + (int)mb_strlen($tbl_individual_case_count);
            } else {
                $size = 0 ;
            }

            return view('nmcp-template.sync_upload',compact(
                'name','tbl_core_facility_count','tbl_individual_case_count', 'size'
            ));
        }
        else
        {
            return redirect('/login');
        }
    }

    //Download data page
    public function show_syncd_page()
    {
        if($user = Auth::user())
        {
            $api_code = Crypt::decryptString(Auth::user()->api_code);

            // $client_hfm = tbl_hfm::where("TS_Code", Auth::user()->region_code)->get(["hfm_id", "SC_Code", "HF_Code", "TS_Code", "Date_Updated", "status"]);

            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', $this->API_URL . 'generate_download_token', [
                'form_params' => [
                    'user_id' => Auth::user()->id,
                    'api_code' => $api_code,
                    'user_region_code' => Auth::user()->region_code,
                    'client_hfm' => json_encode($this->getClientHfm(Auth::user()->region_code))
                ]
            ]);
            // return $response ;
            if($response->getStatusCode() == "200" && $response->getBody() != "Authentication failed.")
            {
                // return $response->getBody();
                $json = json_decode((string)$response->getBody());
                $tbl_core_facility_count = $json->tbl_core_facility_count;
                $tbl_individual_case_count = $json->tbl_individual_case_count;
                $tbl_hfm_count = $json->tbl_hfm_count;
                $hf_count = $json->hf_count;
                $icmv_count = $json->icmv_count;
                $size = $json->size;
                $hfm_size = $json->hfm_size;
                $haveUpdateHfm = $json->have_update_hfm ?: '0' ;
                Session::put('api_token', $json->api_token);
                $name = strtoupper(Auth::user()->name);

                if($tbl_core_facility_count === 0){
                    $size = 0;
                }

                $client_core_count = tbl_core_facility::count();
                $client_individual_count = tbl_individual_case::count();
                $client_hf_count = count($this->getClientHfm(Auth::user()->region_code));

                return view('nmcp-template.sync_download',compact(
                    'name','tbl_core_facility_count','tbl_individual_case_count','size',
                    'tbl_hfm_count','hfm_size', 'haveUpdateHfm', 'hf_count', 'icmv_count', 'client_hf_count'
                ));
            }
            else{
                return $response;
            }

        }
        else
        {
            return redirect('/login');
        }
    }

    public function sync_upload()
    {
        if($user = Auth::user())
        {
            if(Session::get('api_token') != ""){
                $tbl_core_facility_temp = tbl_core_facility_temp::
                            select('Form_Code','Form_No','SC_Code', 'HF_Code','PMonth','PYear','DE_DateTime','sync',
                            'user_id','user_region_code','cf_link_code','TS_Code')
                            ->where('sync','=','0')->get();

                $tbl_individual_case_temp = tbl_individual_case_temp::
                            select(
                                'P_Number','CF_Code','Row_No','Screening_Date','Pt_Name','Age_Year','Pt_Location','Pt_Address',
                                'MS_Code','Sex_Code','Preg_YN','Micro_Code','RDT_Code','IOC_Code','ACT_Code','CQ_Code',
                                'PQ_Code','cqpq','TG_Code','Referral_Code','Malaria_Death','Remark','travel_yn','occupation',
                                'cf_link_code'
                            )->where('sync','=','0')->get()->chunk(100);

                $tbl_total_patient_temp = tbl_total_patient_temp::
                            select('CF_Code','Total_Outpatient','U5_Outpatient','Preg_Outpatient','Total_Inpatient','U5_Inpatient',
                            'Preg_Inpatient','Death_Facility','cf_link_code')->where('sync', '=', '0')->get();

                $tbl_org_vhv = tbl_org_vhv_temp::select('CF_Code','Org_id','Vill_Code','VHV_Name','cf_link_code')->where('sync', '=', '0')->get();

                $tbl_individual_case_temp_temp_count = tbl_individual_case_temp::where('sync', '0')->count();

                file_put_contents('sync_indiv_status.txt', $tbl_individual_case_temp_temp_count);

                if($tbl_individual_case_temp_temp_count > 0){
                    foreach($tbl_individual_case_temp as $val){
                        $data = [
                            "tbl_core_facility" => $tbl_core_facility_temp,
                            "tbl_individual_case" => $val,
                            "tbl_total_patient" => $tbl_total_patient_temp,
                            "tbl_org_vhv" => $tbl_org_vhv
                        ];

                        $client = new \GuzzleHttp\Client();
                        $response = $client->request('POST', $this->API_URL . 'sync/receive_data', [
                            'form_params' => [
                                'api_token' => session('api_token'),
                                'data' => json_encode($data)
                            ]
                        ]);

                        if($response->getStatusCode() == "200")
                        {
                            $res = (string)$response->getBody();
                            $server_return = json_decode($res, true, 512, JSON_BIGINT_AS_STRING);

                            if(count($server_return) > 0){
                                if(count($server_return['tbl_individual_case']) > 0){
                                    foreach($server_return['tbl_individual_case'] as $ic){
                                        DB::table('tbl_individual_case_temp')->where('P_Number', $ic['P_Number'])->where('cf_link_code', $ic['cf_link_code'])
                                        ->update(['sync' => 1]);
                                    }
                                }

                                if(count($server_return['tbl_total_patient']) > 0){
                                    foreach($server_return['tbl_total_patient'] as $tp){
                                        DB::table('tbl_total_patient_temp')->where('cf_link_code', $tp['cf_link_code'])->update(['sync' => 1]);
                                    }
                                }

                                if(count($server_return['tbl_core_facility']) > 0){
                                    foreach($server_return['tbl_core_facility'] as $cf){
                                        DB::table('tbl_core_facility_temp')->where('cf_link_code', $cf['cf_link_code'])->update(['sync' => 1]);
                                    }
                                }

                                if(count($server_return['tbl_org_vhv']) > 0){
                                    foreach($server_return['tbl_org_vhv'] as $ov){
                                        DB::table('tbl_org_vhv_temp')->where('cf_link_code', $ov['cf_link_code'])->update(['sync' => 1]);
                                    }
                                }
                            }
                                //tbl_core_facility_temp::whereIn('cf_link_code', $cf_link_codes)->update(['sync' => 1]);
                                //tbl_individual_case_temp::whereIn('cf_link_code', $cf_link_codes)->update(['sync' => 1]);
                                //tbl_core_facility_temp::update(['sync' => 1]);
                                //tbl_individual_case_temp::update(['sync' => 1]);
                                // DB::table('tbl_core_facility_temp')->update(array('sync' => 1)); // commented at 4/10/2019
                                // DB::table('tbl_individual_case_temp')->update(array('sync' => 1)); // commented at 4/10/2019
                                // DB::table('tbl_total_patient_temp')->update(array(['sync' => 1])); // commented at 4/10/2019
                                //return $cf_link_codes;

                                // return (string)$response->getBody();
                        }
                    }
                    Session::flash('success', 'Upload Data Success.');
                    return response((string)$response->getBody(), 200)->header('Content-Length', strlen((string)$response->getBody()));
                }else{          // if individual_case is null, it's nail report
                    $data = [
                        "tbl_core_facility" => $tbl_core_facility_temp,
                        "tbl_individual_case" => $tbl_individual_case_temp,
                        "tbl_total_patient" => $tbl_total_patient_temp,
                        "tbl_org_vhv" => $tbl_org_vhv
                    ];
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('POST', $this->API_URL . 'sync/receive_data', [
                        'form_params' => [
                            'api_token' => session('api_token'),
                            'data' => json_encode($data)
                        ]
                    ]);

                    if($response->getStatusCode() == "200")
                    {
                        $res = (string)$response->getBody();
                        $server_return = json_decode($res, true, 512, JSON_BIGINT_AS_STRING);

                        if(count($server_return) > 0){
                            if(count($server_return['tbl_individual_case']) > 0){
                                foreach($server_return['tbl_individual_case'] as $ic){
                                    DB::table('tbl_individual_case_temp')->where('P_Number', $ic['P_Number'])->where('cf_link_code', $ic['cf_link_code'])
                                    ->update(['sync' => 1]);
                                }
                            }

                            if(count($server_return['tbl_total_patient']) > 0){
                                foreach($server_return['tbl_total_patient'] as $tp){
                                    DB::table('tbl_total_patient_temp')->where('cf_link_code', $tp['cf_link_code'])->update(['sync' => 1]);
                                }
                            }

                            if(count($server_return['tbl_core_facility']) > 0){
                                foreach($server_return['tbl_core_facility'] as $cf){
                                    DB::table('tbl_core_facility_temp')->where('cf_link_code', $cf['cf_link_code'])->update(['sync' => 1]);
                                }
                            }

                            if(count($server_return['tbl_org_vhv']) > 0){
                                foreach($server_return['tbl_org_vhv'] as $ov){
                                    DB::table('tbl_org_vhv_temp')->where('cf_link_code', $ov['cf_link_code'])->update(['sync' => 1]);
                                }
                            }
                        }
                    }
                    Session::flash('success', 'Upload Data Success.');

                    return response((string)$response->getBody(), 200)->header('Content-Length', strlen((string)$response->getBody()));
                }
            }
            else {
                return "No Token";
            }
        }
        else
        {
            return redirect('/login');
        }
    }

    public function sync_download()
    {
        if($user = Auth::user())
        {

            if(Session::get('api_token') != ""){

                $client = new \GuzzleHttp\Client();

                $response = $client->request('POST', $this->API_URL . 'sync/return_data', [
                    'form_params' => [
                        'user_id' => Auth::user()->id,
                        'api_token' => session('api_token'),
                        'user_region_code' => Auth::user()->region_code
                    ]
                ]);

                if($response->getStatusCode() == "200")
                {
                    $res = $response->getBody()->getContents();
                    $json = json_decode($res, true, 512, JSON_BIGINT_AS_STRING);
                    // return $res ;
                    //return $json["tbl_core_facility"];
                    //return count($json["tbl_individual_case"]);

                    if(count($json) > 0){
                        tbl_core_facility::truncate();
                        tbl_individual_case::truncate();
                        tbl_total_patient::truncate();
                        tbl_org_vhv::truncate();

                        //tbl_core_facility::insert($json["tbl_core_facility"]);
                        //tbl_individual_case::insert($json["tbl_individual_case"]);
                        //Cannot use mass insert because of sql variable limit in sqlite
                        //SQLSTATE[HY000]: General error: 1 too many SQL variables...
                        //return $json["tbl_core_facility"];

                        foreach($json["tbl_core_facility"] as $data){
                            $tbl_core_facility = new tbl_core_facility();
                            $tbl_core_facility->CF_Code = $data["CF_Code"];
                            $tbl_core_facility->Form_Code = $data["Form_Code"];
                            $tbl_core_facility->Form_No = $data["Form_No"];
                            $tbl_core_facility->SC_Code = $data["SC_Code"];
                            $tbl_core_facility->HF_Code = $data['HF_Code'];
                            $tbl_core_facility->PMonth = $data["PMonth"];
                            $tbl_core_facility->PYear = $data["PYear"];
                            $tbl_core_facility->DE_DateTime = $data["DE_DateTime"];
                            $tbl_core_facility->sync = $data["sync"];
                            $tbl_core_facility->user_id = $data["user_id"];
                            $tbl_core_facility->user_region_code = $data["user_region_code"];
                            $tbl_core_facility->TS_Code = $data['TS_Code'];
                            $tbl_core_facility->cf_link_code = $data["cf_link_code"];
                            //$tbl_core_facility->TS_Code = $data["TS_Code"];
                            $tbl_core_facility->save();
                        }


                        foreach($json["tbl_individual_case"] as $data){
                            $tbl_individual_case = new tbl_individual_case();
                            $tbl_individual_case->P_Number = $data["P_Number"];
                            $tbl_individual_case->CF_Code = $data["CF_Code"];
                            $tbl_individual_case->Row_No = $data["Row_No"];
                            $tbl_individual_case->Screening_Date = $data["Screening_Date"];
                            $tbl_individual_case->Pt_Name = $data["Pt_Name"];
                            $tbl_individual_case->Age_Year = $data["Age_Year"];
                            $tbl_individual_case->Pt_Location = $data["Pt_Location"];
                            $tbl_individual_case->Pt_Address = $data["Pt_Address"];
                            $tbl_individual_case->MS_Code = $data["MS_Code"];
                            $tbl_individual_case->Sex_Code = $data["Sex_Code"];
                            $tbl_individual_case->Preg_YN = $data["Preg_YN"];
                            $tbl_individual_case->Micro_Code = $data["Micro_Code"];
                            $tbl_individual_case->RDT_Code = $data["RDT_Code"];
                            $tbl_individual_case->IOC_Code = $data["IOC_Code"];
                            $tbl_individual_case->ACT_Code = $data["ACT_Code"];
                            $tbl_individual_case->CQ_Code = $data["CQ_Code"];
                            $tbl_individual_case->PQ_Code = $data["PQ_Code"];
                            $tbl_individual_case->cqpq = $data["cqpq"];
                            $tbl_individual_case->TG_Code = $data["TG_Code"];
                            $tbl_individual_case->Referral_Code = $data["Referral_Code"];
                            $tbl_individual_case->Malaria_Death = $data["Malaria_Death"];
                            $tbl_individual_case->Remark = $data["Remark"];
                            $tbl_individual_case->travel_yn = $data["travel_yn"];
                            $tbl_individual_case->occupation = $data["occupation"];
                            $tbl_individual_case->cf_link_code = $data["cf_link_code"];
                            $tbl_individual_case->created_date = $data["created_date"];
                            $tbl_individual_case->save();
                        }

                        foreach($json["tbl_total_patient"] as $data){
                            $tbl_total_patient = new tbl_total_patient();
                            $tbl_total_patient->TP_Code = $data['TP_Code'];
                            $tbl_total_patient->CF_Code = $data['CF_Code'];
                            $tbl_total_patient->Total_Outpatient = $data['Total_Outpatient'];
                            $tbl_total_patient->U5_Outpatient = $data['U5_Outpatient'];
                            $tbl_total_patient->Preg_Outpatient = $data['Preg_Outpatient'];
                            $tbl_total_patient->Total_Inpatient = $data['Total_Inpatient'];
                            $tbl_total_patient->U5_Inpatient = $data['U5_Inpatient'];
                            $tbl_total_patient->Preg_Inpatient = $data['Preg_Inpatient'];
                            $tbl_total_patient->Death_Facility = $data['Death_Facility'];
                            $tbl_total_patient->cf_link_code = $data['cf_link_code'];
                            $tbl_total_patient->save();
                        }

                        foreach($json["tbl_org_vhv"] as $data){
                            $tbl_org_vhv = new tbl_org_vhv();
                            $tbl_org_vhv->OrgVHV_ID = $data['OrgVHV_ID'];
                            $tbl_org_vhv->CF_Code = $data['CF_Code'];
                            $tbl_org_vhv->Org_ID = $data['Org_ID'];
                            $tbl_org_vhv->Vill_Code = $data['Vill_Code'];
                            $tbl_org_vhv->VHV_Name = $data['VHV_Name'];
                            $tbl_org_vhv->cf_link_code = $data['cf_link_code'];

                            $tbl_org_vhv->save();
                        }
                    }


                    return response((string)$response->getBody(), 200)
                        ->header('Content-Length', strlen((string)$response->getBody()));
                    //return (string)$response->getBody();
                }
            }
            else {
                return "No Token";
            }
        }
        else
        {
            return redirect('/login');
        }
    }

    public function sync_tbl_hfm(Request $request)
    {
        if($user = Auth::user())
        {
            if(Session::get('api_token') != ""){

                $client_hfm = [] ;
                if($request->input('updateHfm') == '1'){
                    // $client_hfm = tbl_hfm::get(['hfm_id', 'Date_Updated', 'status']);
                }

                $client = new \GuzzleHttp\Client();

                $response = $client->request('POST', $this->API_URL . 'sync/return_tbl_hfm', [
                    'form_params' => [
                        'user_id' => Auth::user()->id,
                        'api_token' => session('api_token'),
                        'user_region_code' => Auth::user()->region_code,
                        'client_hfm' => json_encode($this->getClientHfm(Auth::user()->region_code))
                    ]
                ]);

                if($response->getStatusCode() == "200")
                {
                    $res = $response->getBody()->getContents();
                    // return $res; /// <----
                    $json = json_decode($res, true);

                    if(count($json) > 0){
                        if(count($client_hfm) > 0){
                            foreach($json as $update_hfm){

                                $tbl_hfm = tbl_hfm::find($update_hfm['hfm_id']) == null ? new tbl_hfm() : tbl_hfm::find($update_hfm['hfm_id']);
                                $tbl_hfm->Date_Updated= $update_hfm["Date_Updated"];
                                $tbl_hfm->End= $update_hfm["End"];
                                $tbl_hfm->FocalPerson= $update_hfm["FocalPerson"];
                                $tbl_hfm->HFTypeID= $update_hfm["HFTypeID"];
                                $tbl_hfm->HF_Code= $update_hfm["HF_Code"];
                                $tbl_hfm->HF_CodeReport= $update_hfm["HF_CodeReport"];
                                $tbl_hfm->HF_CodeReportingUnit= $update_hfm["HF_CodeReportingUnit"];
                                $tbl_hfm->Latitude= $update_hfm["Latitude"];
                                $tbl_hfm->Longitude= $update_hfm["Longitude"];
                                $tbl_hfm->MIMU_Code= $update_hfm["MIMU_Code"];
                                $tbl_hfm->Org= $update_hfm["Org"];
                                $tbl_hfm->SC_Code= $update_hfm["SC_Code"];
                                $tbl_hfm->SC_Name= $update_hfm["SC_Name"];
                                $tbl_hfm->SC_Name_MM= $update_hfm["SC_Name_MM"];
                                $tbl_hfm->Start= $update_hfm["Start"];
                                $tbl_hfm->TS_Code= $update_hfm["TS_Code"];
                                $tbl_hfm->status= $update_hfm["status"];
                                $tbl_hfm->hfm_id= $update_hfm["hfm_id"];
                                $tbl_hfm->save();
                            }
                        }else{
                            tbl_hfm::truncate();
                            $i = 0;
                            file_put_contents("status.txt", "0");
                            foreach($json as $data){
                                $tbl_hfm = new tbl_hfm();
                                $tbl_hfm->Date_Updated= $data["Date_Updated"];
                                $tbl_hfm->End= $data["End"];
                                $tbl_hfm->FocalPerson= $data["FocalPerson"];
                                $tbl_hfm->HFTypeID= $data["HFTypeID"];
                                $tbl_hfm->HF_Code= $data["HF_Code"];
                                $tbl_hfm->HF_CodeReport= $data["HF_CodeReport"];
                                $tbl_hfm->HF_CodeReportingUnit= $data["HF_CodeReportingUnit"];
                                $tbl_hfm->Latitude= $data["Latitude"];
                                $tbl_hfm->Longitude= $data["Longitude"];
                                $tbl_hfm->MIMU_Code= $data["MIMU_Code"];
                                $tbl_hfm->Org= $data["Org"];
                                $tbl_hfm->SC_Code= $data["SC_Code"];
                                $tbl_hfm->SC_Name= $data["SC_Name"];
                                $tbl_hfm->SC_Name_MM= $data["SC_Name_MM"];
                                $tbl_hfm->Start= $data["Start"];
                                $tbl_hfm->TS_Code= $data["TS_Code"];
                                $tbl_hfm->status= $data["status"];
                                $tbl_hfm->hfm_id= $data["hfm_id"];
                                $tbl_hfm->save();
                                $i = $i + 1;

                                file_put_contents("status.txt", $i);
                            }
                        }
                    }
                    return "1";
                }
            }
            else
            {
                return "Missing Token";
            }
        }
        else
        {
            return "User is not logged in";
        }
    }

    public function send_delete_request(Request $request)
    {
        if(Auth::check())
        {
            $api_code = Crypt::decryptString(Auth::user()->api_code);

            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', $this->API_URL . 'get_delete_request', [
                'form_params' => [
                    'user_id' => Auth::user()->id,
                    'api_code' => $api_code,
                    'cf_link_code' => $request->input("cf_link_code"),
                    'item_id' => $request->input("item_id"),
                    'remark' => $request->input("remark"),
                    'item_type' => $request->input("item_type")
                ]
            ]);

            if($response->getStatusCode() == "200")
            {
                //return "1";
                if($response->getBody() == "1"){
                    switch($request->input("item_type")){
                        case "0":
                            $tbl_core_facility = tbl_core_facility::find($request->input("item_id"));
                            $tbl_core_facility->delete_requested = 1;
                            $tbl_core_facility->save();

                            tbl_individual_case_temp::where("cf_link_code", $request->input('cf_link_code'))->delete();
                            tbl_total_patient_temp::where("cf_link_code", $request->input('cf_link_code'))->delete();
                            tbl_org_vhv_temp::where("cf_link_code", $request->input('cf_link_code'))->delete();
                            tbl_core_facility_temp::where("cf_link_code", $request->input('cf_link_code'))->delete();

                        break;

                        case "1":
                            $tbl_individual_case = tbl_individual_case::find($request->input("item_id"));
                            $tbl_individual_case->delete_requested = 1;
                            $tbl_individual_case->save();

                            tbl_individual_case_temp::find($request->input("item_id"))->delete() ;
                        break;
                    }
                }
                return $response->getBody();
            }
            else{
                return $response ;
                return $response->getBody();
            }

        }
        else
        {
            return '99';
        }
    }

    public function fetch_data(){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $this->API_URL . 'fetch_data');
        return $response ;
    }

    public function write_status_check(){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $this->API_URL . 'write_status');
        return $response ;
    }

    public function check_server_hfm(){

        try {
            $client_hfm = $this->getClientHfm(Auth::user()->region_code) ;
            if(count($client_hfm) > 0){
                $guzzleClient = new \GuzzleHttp\Client();
                $guzzleResponse = $guzzleClient->request("POST", $this->API_URL . "/check_server_hfm", [
                    "form_params" => [
                        "user_id" => Auth::user()->id,
                        "api_code" => Crypt::decryptString(Auth::user()->api_code),
                        "user_region_code" => Auth::user()->region_code,
                        "client_hfm" => json_encode($this->getClientHfm(Auth::user()->region_code))
                    ]
                ]);

                if($guzzleResponse->getStatusCode() == "200" && $guzzleResponse->getBody() != "99"){
                    return $guzzleResponse->getBody() ;
                }else if($guzzleResponse->getBody() == '99'){
                    return $guzzleResponse->getBody() ;
                }else {
                    return $guzzleResponse->getStatusCode() ;
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function getClientHfm($ts_code){
        return tbl_hfm::where('TS_Code', '=', $ts_code)->get(["hfm_id", "SC_Code", "HF_Code", "TS_Code", "Date_Updated", "status"]) ;
    }

    // public function delete_all_hfm(){
    //     tbl_hfm::truncate() ;
    //     return redirect('/');
    // }
}
