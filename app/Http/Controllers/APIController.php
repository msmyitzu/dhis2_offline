<?php

namespace App\Http\Controllers;

use App\tbl_health_facility;
// use App\tbl_individual_case;
use App\tbl_region;
use App\tbl_sub_center;
use App\tbl_township;
use App\tbl_district;
use App\tbl_village;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class APIController extends Controller
{
    //
    //     public function dhis2getData(){
    //         // dd('helo');
    //         $curl = curl_init();

    //         curl_setopt_array($curl, array(
    //           CURLOPT_URL => 'https://mcbrs-dev2.myanmarvbdc.com//api/organisationUnits.json?filter=level%3Aeq%3A2&paging=false',
    //           CURLOPT_RETURNTRANSFER => true,
    //           CURLOPT_ENCODING => '',
    //           CURLOPT_MAXREDIRS => 10,
    //           CURLOPT_TIMEOUT => 0,
    //           CURLOPT_FOLLOWLOCATION => true,
    //           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //           CURLOPT_CUSTOMREQUEST => 'GET',
    //           CURLOPT_HTTPHEADER => array(
    //             // 'Authorization: Basic YWRtaW46RWZvbGlvc2UxMi0jQ2Fzc2l1czI4'
    //             'Authorization: Basic YWRtaW46ZGlzdHJpY3Q='

    //           ),
    //         ));

    //         $response = curl_exec($curl);
    //         $data=tbl_individual_case::all();
    //         curl_close($curl);
    //         $data=json_decode($response);
    //         //  try{
    //         foreach($data->organisationUnits as $organisationUnit){
    //           $tbl_region_data = [
    //             'region_id' => $organisationUnit-> id,
    //             'region_name_en' => $organisationUnit->displayName
    //             // 'region_id' => '2',
    //             // 'region_name_en' => 'test 2'
    //           ];
    //         //   dd($tbl_region_data);
    //           tbl_region::create($tbl_region_data);
    //         //   dd('hello');
    //         }
    //     //     $region=new tbl_region();
    //     //     $region->region_id='1';
    //     //     $region->region_name_en='jjjj';
    //     //     $region->region_mmr='hhhhj';
    //     //     $region->region_name_mm ='hjhjh';
    //     //     $region->status=1;
    //     //     $region->save();
    //     //     return $region;
    //     // }catch(\Exception $e){
    //     //  echo''. $e->getMessage();
    //     //  }
    // }

    // function combinedAPIFunction() {
    public function dhis2getDataRegion()
    {
        $curl = curl_init();
        ini_set('max_execution_time', 0);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mcbrs-dev2.myanmarvbdc.com//api/organisationUnits.json?filter=level:eq:2&paging=false&fields=name,id,code',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                //'Authorization: Basic YWRtaW46RWZvbGlvc2UxMi0jQ2Fzc2l1czI4'
                'Authorization: Basic YWRtaW46ZGlzdHJpY3Q='
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $apiData = json_decode($response);


        if ($apiData && isset($apiData->organisationUnits)) {
            // dd($apiData);
            try {
                foreach ($apiData->organisationUnits as $organisationUnit) {
                    $tbl_region_data = [
                        'region_dhis2_code' => $organisationUnit->id,
                        'region_name_en' => $organisationUnit->name,
                        'region_mmr' => $organisationUnit->code
                    ];

                    tbl_region::create($tbl_region_data);
                }

                // You can add logging or return a success message here
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo 'Invalid or missing data in the API response.';
        }
    }
    public function dhis2getDataTownship()
    {
        $curl = curl_init();
        ini_set('max_execution_time', 0);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mcbrs-dev2.myanmarvbdc.com/api/29/organisationUnits.json?filter=level:eq:4&paging=false&fields=name,id,code',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                //'Authorization: Basic YWRtaW46RWZvbGlvc2UxMi0jQ2Fzc2l1czI4'
                'Authorization: Basic YWRtaW46ZGlzdHJpY3Q='
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $apiData = json_decode($response);
        // dd($apiData);

        if ($apiData && isset($apiData->organisationUnits)) {
            //  dd($apiData);
            try {
                foreach ($apiData->organisationUnits as $organisationUnit) {
                    $tbl_township_data = [
                        'township_name_dhis2_code' => $organisationUnit->id,
                        'township_name_en' => $organisationUnit->name,
                        'township_mmr' => $organisationUnit->code
                    ];

                    tbl_township::create($tbl_township_data);
                }

                // You can add logging or return a success message here
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }else {
            echo 'Invalid or missing data in the API response.';
        }
    }

    public function dhis2getDataHealthFacility()
    {
        $curl = curl_init();
        ini_set('max_execution_time', 0);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mcbrs-dev2.myanmarvbdc.com/api/organisationUnits.json?filter=level:eq:5&paging=false&fields=name,code,id',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                //'Authorization: Basic YWRtaW46RWZvbGlvc2UxMi0jQ2Fzc2l1czI4'
                'Authorization: Basic YWRtaW46ZGlzdHJpY3Q='
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $apiData = json_decode($response);


        if ($apiData && isset($apiData->organisationUnits)) {
            //  dd($apiData);
            try {
                foreach ($apiData->organisationUnits as $organisationUnit) {
                    $tbl_health_facility_data = [
                        'health_facility_dhis2_code' => $organisationUnit->id,
                        'health_facility_name_en' => $organisationUnit->name,
                        'health_facility_mmr' => $organisationUnit->code
                    ];

                    tbl_health_facility::create($tbl_health_facility_data);
                }

                // You can add logging or return a success message here
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo 'Invalid or missing data in the API response.';
        }
    }

public function dhis2getDataSubCenter()
    {
        $curl = curl_init();
        ini_set('max_execution_time', 0);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mcbrs-dev2.myanmarvbdc.com/api/organisationUnits.json?filter=level:eq:6&paging=false&fields=id,code,name',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                //'Authorization: Basic YWRtaW46RWZvbGlvc2UxMi0jQ2Fzc2l1czI4'
                'Authorization: Basic YWRtaW46ZGlzdHJpY3Q='
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $apiData = json_decode($response);


        if ($apiData && isset($apiData->organisationUnits)) {
            //  dd($apiData);
            try {
                foreach ($apiData->organisationUnits as $organisationUnit) {
                    $tbl_sub_center_data = [
                        'sub_center_dhis2_code' => $organisationUnit->id,
                        'sub_center_name_en' => $organisationUnit->name,
                        'sub_center_mmr' => $organisationUnit->code
                    ];

                    tbl_sub_center::create($tbl_sub_center_data);
                }

                // You can add logging or return a success message here
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo 'Invalid or missing data in the API response.';
        }
    }

    public function dhis2getDataDistrict()
    {
        $curl = curl_init();
        ini_set('max_execution_time', 0);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mcbrs-dev2.myanmarvbdc.com//api/organisationUnits.json?filter=level:eq:3&paging=false&fields=id,name,code',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                //'Authorization: Basic YWRtaW46RWZvbGlvc2UxMi0jQ2Fzc2l1czI4'
                'Authorization: Basic YWRtaW46ZGlzdHJpY3Q='
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $apiData = json_decode($response);


        if ($apiData && isset($apiData->organisationUnits)) {
            // dd($apiData);
            try {
                foreach ($apiData->organisationUnits as $organisationUnit) {
                    $tbl_district_data = [
                        'district_name_dhis2_code' => $organisationUnit->id,
                        'district_name_en' => $organisationUnit->name,
                        'district_name_mmr' => $organisationUnit->code
                    ];

                    tbl_district::create($tbl_district_data);
                }

                // You can add logging or return a success message here
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo 'Invalid or missing data in the API response.';
        }
    }
    public function dhis2getDataVillage()
    {
        $curl = curl_init();
        ini_set('max_execution_time', 0);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mcbrs-dev2.myanmarvbdc.com//api/organisationUnits.json?filter=level:eq:7&paging=false&fields=id,name,code',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                //'Authorization: Basic YWRtaW46RWZvbGlvc2UxMi0jQ2Fzc2l1czI4'
                'Authorization: Basic YWRtaW46ZGlzdHJpY3Q='
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $apiData = json_decode($response);


        if ($apiData && isset($apiData->organisationUnits)) {
            // dd($apiData);
            try {
                foreach ($apiData->organisationUnits as $organisationUnit) {
                    $tbl_village_data = [
                        'village_dhis2_code' => $organisationUnit->id,
                        'village_name_en' => $organisationUnit->name,
                        'village_mmr' => $organisationUnit->code
                    ];

                    tbl_village::create($tbl_village_data);
                }

                // You can add logging or return a success message here
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo 'Invalid or missing data in the API response.';
        }
    }

    // public function dhis2postData()
    // {

    //     $baseUrl = 'https://mcbrs-dev2.myanmarvbdc.com/api/29/organisationUnits/S1sWiUMHf9g';

    //     $data = DB::table('tbl_individual_case')->get();
    //     $data2 = DB::table('tbl_nil')->get();
    //     // dd($data2);
    //     // dd($data);

    //     $headers = [
    //         'Authorization: Basic YWRtaW46ZGlzdHJpY3Q='
    //     ];

    //     $postData = [];
    //     if ($data) {
    //         foreach ($data as $row) {

    //             $postData = [
    //                 [
    //                     'id' => 'CJqZCPAg6Yv',
    //                     'reportingPeriod' => $row->screening_date
    //                 ],
    //                 [
    //                     'id' => 'C89brF2qFjY',
    //                     'pt_name' => $row->pt_Name
    //                 ],
    //                 [
    //                     'id' => 'ncDYKoYDCbi',
    //                     'age' => $row->pt_age
    //                 ],
    //                 [
    //                     'id' => 'ntzzGM9v0kJ',
    //                     'f_name' => $row->pt_father_name
    //                 ],
    //                 [
    //                     'id' => 'HqF8dFu79ex',
    //                     'case_outside_SubCenter_township' => $row->pt_address
    //                 ],
    //                 [
    //                     'id' => 'qCI5cGiVE3B',
    //                     'current_township' => $row->pt_current_township
    //                 ],
    //                 [
    //                     'id' => 'Qr3v7XAQC77',
    //                     'current_village' => $row->pt_current_village
    //                 ],
    //                 [
    //                     'id' => 'E0qWI5la2Zh',
    //                     'current_otherVillage' => $row->pt_current_ward
    //                 ],
    //                 [
    //                     'id' => 'hMK8hf12Yvi',
    //                     'parmenant_township' => $row->pt_permanent_township
    //                 ],
    //                 [
    //                     'id' => 'w9RT32cvgHf',
    //                     'parmenant_village' => $row->pt_permanent_village
    //                 ],
    //                 [
    //                     'id' => 'XZ3OP1jdCfo',
    //                     'parmenant_otherVillage' => $row->pt_permanent_ward
    //                 ],
    //                 [
    //                     'id' => 'NlmG4cwRzmJ',
    //                     'gender' => $row->Sex_Code
    //                 ],
    //                 [
    //                     'id' => 'YPmjEZvUjpg',
    //                     'pregnancy_tf' => $row->Preg_YN

    //                 ],
    //                 [
    //                     'id' => 'KdiR3PGFj3P',
    //                     'rdt_test' => $row->RDT_Code
    //                 ],
    //                 [
    //                     'id' => 'SWhiDdRgUwT',
    //                     'mcp_test' => $row->Micro_Code
    //                 ],
    //                 [
    //                     'id' => 'WJ1MqhmfPHz',
    //                     'act' => $row->ACT_Code
    //                 ],
    //                 [
    //                     'id' => 'jqCfD3BCumN',
    //                     'cq' => $row->CQ_Code
    //                 ],
    //                 [
    //                     'id' => 'QBBPxUuOulF',
    //                     'pq' => $row->PQ_Code
    //                 ],
    //                 [
    //                     'id' => 'UUWSRVYn7Pl',
    //                     'referral' => $row->Referral_Code
    //                 ],
    //                 [
    //                     'id' => 'aWLj1EJFbQV',
    //                     'm_death' => $row->Malaria_Death
    //                 ],
    //                 [
    //                     'id' => 'rBkCZXJFKXq',
    //                     'note' => $row->Remark
    //                 ],
    //                 [
    //                     'id' => 'Kxzh0PMCa2d',
    //                     'travel' => $row->travel_yn
    //                 ],
    //                 [
    //                     'id' => 'oIRHWGk2OCy',
    //                     'job' => $row->occupation
    //                 ]
    //             ];
    //         }
    //     }


    //     if ($data2) {
    //         foreach ($data2 as $d2) {

    //             $postData = [
    //                 [
    //                     'id' => 'BV3Uv6YBxnK',
    //                     'outerPatients' => $d2->total_outpatient
    //                 ],
    //                 [
    //                     'id' => 'PbreMPAmzFW',
    //                     'outerPatientsAge' => $d2->u5_outpatient
    //                 ],
    //                 [
    //                     'id' => 'wNq3zFtsiuq',
    //                     'outerPregnancyPatients' => $d2->preg_outpatient
    //                 ],
    //                 [
    //                     'id' => 'IvNLoKHaG6O',
    //                     'innerPatients' => $d2->total_inpatient
    //                 ],
    //                 [
    //                     'id' => 'heN9yJ9BsD6',
    //                     'innerPatientsAge' => $d2->u5_inpatient
    //                 ],
    //                 [
    //                     'id' => 'Jqc47QHqa2e',
    //                     'innerPregnancyPatients' => $d2->preg_inpatient
    //                 ],
    //                 [
    //                     'id' => 'qsxGdracapt',
    //                     'totalPatientsDead' => $d2->death_facility
    //                 ]
    //             ];
    //         }
    //     }
    //     try {
    //         $ch = curl_init();
    //         foreach ($postData as $dataSet) {
    //             $id = $dataSet['id'];
    //             $url = $baseUrl . $id . '.json';


    //             $dataToSend = array_filter($dataSet, function ($key) {
    //                 return $key !== 'id';
    //             }, ARRAY_FILTER_USE_KEY);




    //             curl_setopt($ch, CURLOPT_URL, $url);
    //             curl_setopt($ch, CURLOPT_POST, true);
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataToSend));
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    //             if (curl_errno($ch)) {
    //                 $error_message = 'cURL error: ' . curl_error($ch);
    //                 curl_close($ch);
    //                 throw new \Exception($error_message);
    //             }

    //             $response = curl_exec($ch);
    //             dd($response);

    //             if ($response !== false) {
    //                 $info = curl_getinfo($ch);
    //                 //dd($info);

    //             } else {
    //                 $error_message = 'cURL error: ' . curl_error($ch);
    //                 $info = curl_getinfo($ch);
    //                 // Handle the error or log it
    //                 throw new \Exception($error_message);
    //             }
    //         }

    //         curl_close($ch); // Close the cURL handle outside the loop
    //         dd($response);
    //         return response()->json(['message' => 'Data sent successfully.']);
    //     } catch (\Exception $e) {
    //         // Log the exception for debugging
    //         Log::error($e->getMessage());
    //         return response()->json(['error' => 'An error occurred during data transmission.']);
    //     }


    //     // if ($response !== false) {



    //     //     // $responseMessage = 'Response from server: ' . $id . $response;
    //     //     return response()->json(['message' => $id.$response]);

    //     // } else {
    //     //     var_dump($response);
    //     //     var_dump($info);
    //     //     return 'Failed to receive a response.';
    //     // }



    // }


    public function dhis2postData($pt_current_township){
        // dd($pt_current_township);
    try{
        $table = DB::table('tbl_individual_case')->where('pt_current_township',$pt_current_township)->get();
        $trackedEntityInstances = [];
        $cores = DB::table('tbl_core_facility')->get();
        $nils = DB::table('tbl_nil')->get();
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
            $Malaria_dh = $row ->Malaria_Death;
            $remark = $row ->Remark;
            $travel = $row ->travel_yn;
            $occupation = $row->occupation;


            // Create an array representing the trackedEntityInstance for each row
            $trackedEntityInstance = [
                "orgUnit" =>"S1sWiUMHf9g",
                "program"=>"ec31yGIJJzu",
                "trackedEntityType"=> "bwrCfr3nMhv",
                "type"=>"created",
                // Add other keys and values based on retrieved database data
                "attributes" => [
                    [
                        "attribute" => "C89brF2qFjY",
                        "value" => $patient_name
                    ],
                    [
                        "attribute"=> "ntzzGM9v0kJ",
                        "value"=> $pt_father_name	//no need in programstage
                    ],
                    [
                        "attribute"=> "NlmG4cwRzmJ",
                        "value"=> $sex	//no need in programstage
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
                                "programStage"=> "bgPjhWMVFDv",
                                "eventDate"=> "2023-11-15",
                                "type"=>"created",
                                "dataValues"=> [
                                    [
                                        "dataElement"=>"mPKo8fRmj2A",
                                        "value"=>"Survey"
                                    ],
                                    [
                                        "dataElement"=> "HqF8dFu79ex",
                                        "value"=> $pt_address
                                    ],
                                    [
                                        "dataElement"=> "ncDYKoYDCbi",
                                        "value"=> $pt_age
                                    ],

                                    [
                                        "dataElement"=> "YPmjEZvUjpg",
                                        "value"=> $preg
                                    ],
                                    [
                                        "dataElement"=> "Kxzh0PMCa2d",
                                        "value"=> $travel
                                    ],
                                    [
                                        "dataElement"=>"UWS9UZxBLDI",
                                        "value"=>"$scr_date"
                                    ],
                                    [
                                        "dataElement"=>"qCI5cGiVE3B",
                                        "value" =>$pt_crr_tsp
                                    ],
                                    [
                                        "dataElement"=>"Qr3v7XAQC77",
                                        "value" =>$pt_crr_vlg
                                    ],
                                    [
                                        "dataElement"=>"E0qWI5la2Zh",
                                        "value" =>$pt_crr_ward
                                    ],
                                    [
                                        "dataElement"=> "hMK8hf12Yvi",
                                         "value"=> $pt_pm_tsp
                                    ],
                                     [
                                         "dataElement"=> "w9RT32cvgHf",
                                         "value"=> $pt_pm_vlg
                                     ],
                                     [
                                         "dataElement"=> "XZ3OP1jdCfo",
                                         "value"=> $pt_pm_ward
                                     ],
                                        ["dataElement"=>"SWhiDdRgUwT",
                                        "value" =>$micro
                                        ],
                                     [
                                        "dataElement"=> "KdiR3PGFj3P",
                                        "value"=> $rdt
                                    ],
                                    [
                                        "dataElement"=>"qihIcNI1PdA",
                                        "value"=>$ioc
                                    ],
                                    [
                                        "dataElement"=>"GASizN790rz",
                                        "value"=>$tg
                                    ],
                                    [
                                        "dataElement"=> "WJ1MqhmfPHz",
                                        "value"=> $act
                                    ],
                                    [
                                        "dataElement"=> "jqCfD3BCumN",
                                        "value"=> $cq
                                    ],
                                    [
                                        "dataElement"=> "QBBPxUuOulF",
                                        "value"=> $pq
                                    ],
                                    [
                                        "dataElement"=> "UUWSRVYn7Pl",
                                        "value"=> $reffer
                                    ],
                                     [
                                        "dataElement"=> "aWLj1EJFbQV",
                                        "value"=> $Malaria_dh
                                    ],
                                     [
                                        "dataElement"=> "rBkCZXJFKXq",
                                        "value"=> $remark
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
            // Add other keys and values based on retrieved database data
            "attributes" => [
                [
                    "attribute" => "C89brF2qFjY",
                    "value" => $patient_name
                ],
                // Add other attribute values based on database fields
                // ...
            ],
            "enrollments" => [
                [
                    "program" => "ec31yGIJJzu",
                    "orgUnit" => "S1sWiUMHf9g",
                    "events" => [
                        [
                            "orgUnit" => "S1sWiUMHf9g",
                            "program" => "ec31yGIJJzu",
                            // Add event details based on database fields
                            // ...
                        ]
                    ]
                ]
            ]
        ];

        // Add the trackedEntityInstance to the trackedEntityInstances array
        $trackedEntityInstances[] = $trackedEntityInstance;
    }

    //for nil table

    foreach ($nils as $nil) {
        // Retrieve data from each row in the table
        $t_outpt = $nil->total_outpatient;
        $u5_outpt = $nil->u5_outpatient;
        $pre_outpt = $nil->preg_outpatient;
        $t_inpt = $nil->total_inpatient;
        $u5_inpt = $nil->total_inpatient;
        $pre_inpt = $nil->preg_inpatient;
        $t_df = $nil->death_facility;

        // Retrieve other fields similarly...

        // Create an array representing the trackedEntityInstance for each row
        $trackedEntityInstance = [
            "orgUnit" => "S1sWiUMHf9g",
            "program" => "ec31yGIJJzu",
            // Add other keys and values based on retrieved database data
            "attributes" => [
                [
                    "attribute" => "C89brF2qFjY",
                    "value" => $patient_name
                ],
                // Add other attribute values based on database fields
                // ...
            ],
            "enrollments" => [
                [
                    "program" => "ec31yGIJJzu",
                    "orgUnit" => "S1sWiUMHf9g",
                    "events" => [
                        [
                            "orgUnit" => "S1sWiUMHf9g",
                            "program" => "ec31yGIJJzu",
                            // Add event details based on database fields
                            // ...
                        ]
                    ]
                ]
            ]
        ];

        // Add the trackedEntityInstance to the trackedEntityInstances array
        $trackedEntityInstances[] = $trackedEntityInstance;
    }


$url = 'https://mcbrs-dev2.myanmarvbdc.com/api/40/trackedEntityInstances';
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Basic YWRtaW46ZGlzdHJpY3Q=',
    'charset=utf8'
]);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

        // Output the server response
        // dd('this is sent=>',$response);
      
        echo $response;

    } catch (\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    }

}
