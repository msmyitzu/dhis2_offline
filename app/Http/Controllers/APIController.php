<?php

namespace App\Http\Controllers;

use App\User;
// use App\tbl_individual_case;
use App\tbl_region;
use App\tbl_village;
use App\tbl_district;
use App\tbl_township;
use App\tbl_sub_center;
use App\tbl_health_facility;

use App\tbl_individual_case;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

class APIController extends Controller
{
    public function downloadDataFromOnline(){
        $user = User::first();
        $email = $user->email;
        $password = $user->password;
        $national_code = $user->national_code;
        $region_code = $user->region_code;
        $district_code = $user->district_code;
        $township_code = $user->township_code;
        $health_facility_code =$user->health_facility_code;
        $sub_center_code = $user->sub_center_code;
        $village_code = $user->village_code;

        $decrpytPws = Crypt::decryptString($password);
        // dd($decrpytPws);
        $encodedPassword = base64_encode($email . ':' . $decrpytPws);
        // dd($password,$email);
        // --------------------------------------
        // call api form DHIS2 api version 29
        // --------------------------------------
        // $this->getOnlineData($encodedPassword,1,$national_code); // National not use verion 1
        $this->getOnlineData($encodedPassword,2,'lQ1gMwNMwXh'); // Region $region_code
        // $this->getOnlineData($encodedPassword,3,$region_code); // District not use verion 1
        $this->getOnlineData($encodedPassword,4,$district_code); // Township
        $this->getOnlineData($encodedPassword,5,$township_code); // Health Facility
        $this->getOnlineData($encodedPassword,6,$health_facility_code); // Sub Center
        $this->getOnlineData($encodedPassword,7,$sub_center_code); // Village

        return response()->json('success');
    }


    public function getOnlineData($encodedPassword,$level,$OrgID)
    {
        $curl = curl_init();
        ini_set('max_execution_time', 0);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mcbrs-dev2.myanmarvbdc.com/api/29/organisationUnits.json?filter=parent.id:eq:' . $OrgID . '&paging=false&fields=name,id,code',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                //'Authorization: Basic YWRtaW46RWZvbGlvc2UxMi0jQ2Fzc2l1czI4'
                // 'Authorization: Basic YWRtaW46ZGlzdHJpY3Q='
                'Authorization:Basic ' .  $encodedPassword,
                'Cookie: JSESSIONID=029C6E911EBA2838D633698F56BD2071'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $apiData = json_decode($response);
        //dd($apiData);

        if ($apiData && isset($apiData->organisationUnits)) {
            //  dd($apiData);
            try {
                if($level == 1){

                }

                if($level == 2){
                    // Region
                    foreach ($apiData->organisationUnits as $organisationUnit) {
                        $tbl_region_data = [
                            'region_dhis2_code' => $organisationUnit->id,
                            'region_name_en' => $organisationUnit->name,
                            'region_mmr' => property_exists($organisationUnit, 'code') ? $organisationUnit->code : "unknown_region"
                        ];

                        tbl_region::create($tbl_region_data);
                    }
                }

                if($level == 3){
                    // District
                }

                if($level == 4){
                    // Township
                    foreach ($apiData->organisationUnits as $organisationUnit) {
                        $tbl_township_data = [
                            'township_name_dhis2_code' => $organisationUnit->id,
                            'township_name_en' => $organisationUnit->name,
                            'township_mmr' => property_exists($organisationUnit, 'code') ? $organisationUnit->code : "unknown_township"
                        ];

                        tbl_township::create($tbl_township_data);
                    }
                }


                if($level == 5){
                    // Health Facility
                    foreach ($apiData->organisationUnits as $organisationUnit) {
                        $tbl_health_facility_data = [
                            'health_facility_dhis2_code' => $organisationUnit->id,
                            'health_facility_name_en' => $organisationUnit->name,
                            'health_facility_mmr' => property_exists($organisationUnit, 'code') ? $organisationUnit->code : "unknown_health_facility"
                        ];

                        tbl_health_facility::create($tbl_health_facility_data);
                    }
                }

                if($level == 6){
                    // Sub Center
                    foreach ($apiData->organisationUnits as $organisationUnit) {
                        $tbl_sub_center_data = [
                            'sub_center_dhis2_code' => $organisationUnit->id,
                            'sub_center_name_en' => $organisationUnit->name,
                            'sub_center_mmr' => property_exists($organisationUnit, 'code') ? $organisationUnit->code : "unknown_sub_center"
                        ];

                        tbl_sub_center::create($tbl_sub_center_data);
                    }
                }


                if($level == 7){
                    // Village
                    foreach ($apiData->organisationUnits as $organisationUnit) {
                        $tbl_village_data = [
                            'village_dhis2_code' => $organisationUnit->id,
                            'village_name_en' => $organisationUnit->name,
                            'village_mmr' => property_exists($organisationUnit, 'code') ? $organisationUnit->code : "unknown_village"
                        ];

                        tbl_village::create($tbl_village_data);
                    }
                }


                // You can add logging or return a success message here
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            return response()->json('Invalid or missing data in the API response.');
            //echo 'Invalid or missing data in the API response.';
        }
    }


    public function dhis2NilReportUpload($pt_current_township){
        $result_nils = DB::table('tbl_nil')
            ->Join('tbl_core_facility', 'tbl_core_facility.core_id', '=', 'tbl_nil.cf_id')
            ->where('tbl_core_facility.township_mmr', $pt_current_township)
            ->select('tbl_nil.*','tbl_core_facility.report_month as report_month','tbl_core_facility.blood_test_result as blood_test')
            ->get();

        //dd($result_nils);
        // get Nil data for nil report
        foreach ($result_nils as $data_nils) {
            $peroid_date = str_replace("-", "", $data_nils->report_month);
            if($data_nils->blood_test == "yes"){
                $nail_blood_test = "true";
            }else{
                $nail_blood_test = "";
            }
            //$peroid_date = "202403";


            $t_outpt = $data_nils->total_outpatient;
            $u5_outpt = $data_nils->u5_outpatient;
            $pre_outpt = $data_nils->preg_outpatient;
            $t_inpt = $data_nils->total_inpatient;
            $u5_inpt = $data_nils->total_inpatient;
            $pre_inpt = $data_nils->preg_inpatient;
            $t_df = $data_nils->death_facility;

            for($i = 1 ; $i<=9 ;$i++){
                if($i == 1){
                    $de_value = "BV3Uv6YBxnK";
                    $inpatient = $t_outpt;
                }else if($i == 2){
                    $de_value = "PbreMPAmzFW";
                    $inpatient = $u5_outpt;
                }else if($i == 3){
                    $de_value = "wNq3zFtsiuq";
                    $inpatient = $pre_outpt;
                }else if($i == 4){
                    $de_value = "qsxGdracapt";
                    $inpatient = $t_inpt;
                }else if($i == 5){
                    $de_value = "IvNLoKHaG6O";
                    $inpatient = $u5_inpt;
                }else if($i == 6){
                    $de_value = "heN9yJ9BsD6";
                    $inpatient = $pre_inpt;
                }else if($i == 7){
                    $de_value = "Jqc47QHqa2e";
                    $inpatient = $t_df;
                }else if($i == 8){
                    $de_value = "EzkQVfdFb2t";
                    $inpatient = $nail_blood_test;
                }

                $data = array(
                    'de' => $de_value,
                    'co' => 'HllvX50cXC0',
                    'ds' => 'lkJgSqsxSqy',
                    'ou' => 'S1sWiUMHf9g',
                    'pe' => $peroid_date,
                    'value' => $inpatient
                );

                $user = User::first();
                $email = $user->email;
                $password = $user->password;
                $decrpytPws = Crypt::decryptString($password);
                //dd($decrpytPws);

                $encodedPassword = base64_encode($email . ':' . $decrpytPws);
                $url = 'https://mcbrs-dev2.myanmarvbdc.com/api/dataValues';

                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic '.$encodedPassword,
                    'Cookie: JSESSIONID=ECE1859135EF2F282CF0DE86E84355C8'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                return response()->json('success');

            }
        }
    }
    public function dhis2postData($pt_current_township)
    {
        
        $this->dhis2NilReportUpload($pt_current_township);
        //exit();
        // dd($pt_current_township);
        try {
            $table = DB::table('tbl_individual_case')->where('pt_current_township', $pt_current_township)->where('sync', '=', 0)->get();
            $trackedEntityInstances = [];
            $cores = DB::table('tbl_core_facility')->get();
            //dd('cores =>',$cores);
            // dd('hi', $table->toArray());
            foreach ($table as $row) {
                // Retrieve data from each row in the table
                $scr_date = $row->screening_date;
                $patient_name = $row->pt_Name;
                $pt_age = $row->pt_age;
                $pt_father_name = $row->pt_father_name;
                $pt_address = $row->pt_address;
                $pt_crr_tsp = $row->pt_current_township;
                $pt_crr_vlg = $row->pt_current_village;
                $pt_crr_ward = $row->pt_current_ward;
                $pt_pm_tsp = $row->pt_permanent_township;
                $pt_pm_vlg = $row->pt_permanent_village;
                $pt_pm_ward = $row->pt_permanent_ward;
                $sex = $row->Sex_Code;
                $preg = $row->Preg_YN;
                $micro = $row->Micro_Code;
                $rdt = $row->RDT_Code;
                $ioc = $row->IOC_Code;
                $act = $row->ACT_Code;
                $cq = $row->CQ_Code;
                $pq = $row->PQ_Code;
                $tg = $row->TG_Code;
                $reffer = $row->Referral_Code;
                $Malaria_dh = $row->Malaria_Death;
                $remark = $row->Remark;
                $travel = $row->travel_yn;
                $occupation = $row->occupation;

                // Create an array representing the trackedEntityInstance for each row
                $trackedEntityInstance = [
                    "orgUnit" => "S1sWiUMHf9g",
                    "program" => "ec31yGIJJzu",
                    "trackedEntityType" => "bwrCfr3nMhv",
                    "type" => "created",
                    // Add other keys and values based on retrieved database data
                    "attributes" => [
                        [
                            "attribute" => "C89brF2qFjY",
                            "value" => $patient_name
                        ],
                        [
                            "attribute" => "ntzzGM9v0kJ",
                            "value" => $pt_father_name    //no need in programstage
                        ],
                        [
                            "attribute" => "NlmG4cwRzmJ",
                            "value" => $sex    //no need in programstage
                        ]
                    ],
                    "enrollments" => [
                        [
                            "program" => "ec31yGIJJzu",
                            "orgUnit" => "S1sWiUMHf9g",
                            "events" => [
                                [
                                    "orgUnit" => "S1sWiUMHf9g",
                                    "program" => "ec31yGIJJzu",
                                    "programStage" => "bgPjhWMVFDv",
                                    "eventDate" => "2023-11-15",
                                    "type" => "created",
                                    "dataValues" => [
                                        // [
                                        //     "dataElement"=>"mPKo8fRmj2A",
                                        //     "value"=>"Survey"
                                        // ],
                                        [
                                            "dataElement" => "HqF8dFu79ex",
                                            "value" => $pt_address
                                        ],
                                        [
                                            "dataElement" => "ncDYKoYDCbi",
                                            "value" => $pt_age
                                        ],

                                        [
                                            "dataElement" => "YPmjEZvUjpg",
                                            "value" => $preg
                                        ],
                                        [
                                            "dataElement" => "Kxzh0PMCa2d",
                                            "value" => $travel
                                        ],
                                        [
                                            "dataElement" => "UWS9UZxBLDI",
                                            "value" => "$scr_date"
                                        ],
                                        [
                                            "dataElement" => "qCI5cGiVE3B",
                                            "value" => $pt_crr_tsp
                                        ],
                                        [
                                            "dataElement" => "Qr3v7XAQC77",
                                            "value" => $pt_crr_vlg
                                        ],
                                        [
                                            "dataElement" => "E0qWI5la2Zh",
                                            "value" => $pt_crr_ward
                                        ],
                                        [
                                            "dataElement" => "hMK8hf12Yvi",
                                            "value" => $pt_pm_tsp
                                        ],
                                        [
                                            "dataElement" => "w9RT32cvgHf",
                                            "value" => $pt_pm_vlg
                                        ],
                                        [
                                            "dataElement" => "XZ3OP1jdCfo",
                                            "value" => $pt_pm_ward
                                        ],
                                        [
                                            "dataElement" => "SWhiDdRgUwT",
                                            "value" => $micro
                                        ],
                                        [
                                            "dataElement" => "KdiR3PGFj3P",
                                            "value" => $rdt
                                        ],
                                        [
                                            "dataElement" => "qihIcNI1PdA",
                                            "value" => $ioc
                                        ],
                                        [
                                            "dataElement" => "GASizN790rz",
                                            "value" => $tg
                                        ],
                                        [
                                            "dataElement" => "WJ1MqhmfPHz",
                                            "value" => $act
                                        ],
                                        [
                                            "dataElement" => "jqCfD3BCumN",
                                            "value" => $cq
                                        ],
                                        [
                                            "dataElement" => "QBBPxUuOulF",
                                            "value" => $pq
                                        ],
                                        [
                                            "dataElement" => "UUWSRVYn7Pl",
                                            "value" => $reffer
                                        ],
                                        [
                                            "dataElement" => "aWLj1EJFbQV",
                                            "value" => $Malaria_dh
                                        ],
                                        [
                                            "dataElement" => "rBkCZXJFKXq",
                                            "value" => $remark
                                        ]

                                    ]

                                ]
                            ]
                        ]
                    ]
                ];

                // Add the trackedEntityInstance to the trackedEntityInstances array
                $trackedEntityInstances[] = $trackedEntityInstance;
            }

            $data = [
                "trackedEntityInstances" => $trackedEntityInstances
            ];

            //for cores table
            foreach ($cores as $core) {
                // Retrieve data from each row in the table
                $hf = $core->health_facility;
                $activity = $core->condition;
                // Retrieve other fields similarly...
                // Create an array representing the trackedEntityInstance for each row
                $trackedEntityInstance = [
                    "orgUnit" => "S1sWiUMHf9g",
                    "program" => "ec31yGIJJzu",
                    "trackedEntityType" => "bwrCfr3nMhv",
                    "type" => "created",
                    "attributes" => [
                        [
                            // "attributes"=>"tjnIJKZrBcS",
                            // "value"=> $hf
                            // "value" => "TT - Service Provider"

                        ]
                    ],
                    "enrollments" => [
                        [
                            "program" => "ec31yGIJJzu",
                            "orgUnit" => "S1sWiUMHf9g",
                            "events" => [
                                [
                                    "orgUnit" => "S1sWiUMHf9g",
                                    "program" => "ec31yGIJJzu",
                                    "programStage" => "bgPjhWMVFDv",
                                    "eventDate" => "2023-11-15",
                                    "type" => "created",
                                    "dataValues" => [
                                        [
                                            "dataElement" => "mPKo8fRmj2A",
                                            "value" => $activity
                                        ],
                                        [
                                            "dataElement" => "tjnIJKZrBcS",
                                            "value" => "TT - Service Provider"
                                        ]

                                    ]
                                ]
                            ]
                        ]
                    ]
                ];

                // Add the trackedEntityInstance to the trackedEntityInstances array
                $trackedEntityInstances[] = $trackedEntityInstance;
            }

            $user = User::first();
            $email = $user->email;
            $password = $user->password;
            $decrpytPws = Crypt::decryptString($password);
            // dd($decrpytPws);

            $encodedPassword = base64_encode($email . ':' . $decrpytPws);

            // dd($encodedPassword);
            $url = 'https://mcbrs-dev2.myanmarvbdc.com/api/40/trackedEntityInstances';
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                // 'Authorization: Basic YWRtaW46ZGlzdHJpY3Q=',
                // 'Authorization:Basic cEBzc3cwckQ=',
                'Authorization: Basic ' . $encodedPassword,
                'Cookie: JSESSIONID=029C6E911EBA2838D633698F56BD2071',

                'charset=utf8'
            ]);

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // Output the server response
            // dd('this is sent=>',$response);
            if ($httpcode == 200) {
                foreach ($table as $row) {
                    $upload_data = tbl_individual_case::find($row->ic_id);
                    $upload_data->sync = 1;
                    $upload_data->save();
                }
            }
            return response()->json('success');
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
