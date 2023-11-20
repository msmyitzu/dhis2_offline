<?php

namespace App\Http\Controllers;

use App\tbl_individual_case;
use App\tbl_region;
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

    public function dhis2getData()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mcbrs-dev2.myanmarvbdc.com/api/organisationUnits?fields=level:eq:4,id,displayName,code',
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
                        'region_mmr' => $organisationUnit->id,
                        'region_name_en' => $organisationUnit->displayName
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

    //public function postDHIS()
    public function dhis2postData(){


        $table = DB::table('tbl_individual_case')->get();


        $trackedEntityInstances = [];

        foreach ($table as $row) {
            $patient_name = $row->patient_name;
            $data = '{
                "trackedEntityInstances": [
                    {
                    "orgUnit": "S1sWiUMHf9g",
                    "program": "ec31yGIJJzu",
                    "trackedEntityType": "bwrCfr3nMhv",
                    "type":"created",
                     "attributes":[
                         {
                        "attribute": "C89brF2qFjY",
                        "value": "$patient_name"	//no need on programstages
                        },
                        {
                            "attribute": "ntzzGM9v0kJ",
                            "value": "U Toe Toe"	//no need in programstage
                        },
                        {
                            "attribute": "NlmG4cwRzmJ",
                            "value": "TT-Female"	//no need in programstage
                        }
                     ],
                    "enrollments": [

                        {
                        "program": "ec31yGIJJzu",
                        "orgUnit": "S1sWiUMHf9g",
                        "events":[
                            {
                                "orgUnit": "S1sWiUMHf9g",
                            "program": "ec31yGIJJzu",
                        "programStage": "bgPjhWMVFDv",
                        "eventDate": "2023-11-15",
                        "type":"created",
                        "dataValues": [
                        {
                            "dataElement":"mPKo8fRmj2A",
                            "value":"Survey"
                        },
                        {
                            "dataElement": "HqF8dFu79ex",
                            "value": "No (within Township)"
                        },
                        {
                            "dataElement": "ncDYKoYDCbi",
                            "value": "23"
                        },
                        {
                            "dataElement": "oIRHWGk2OCy",
                            "value": "Gardening"
                        },
                        {
                            "dataElement": "YPmjEZvUjpg",
                            "value": "No"
                        },
                        {
                            "dataElement": "Kxzh0PMCa2d",
                            "value": "Yes"
                        },
                        // {
                        //     "dataElement":"UWS9UZxBLDI",
                        //     "value":"2023-11-01"
                        // },
                        {
                            "dataElement":"qCI5cGiVE3B",
                            "value" :"ctownship"
                        },
                        {
                            "dataElement":"Qr3v7XAQC77",
                            "value" :"cvillage"
                        },
                        {
                            "dataElement":"E0qWI5la2Zh",
                            "value" :"cward"
                        },
                        {
                            "dataElement": "hMK8hf12Yvi",
                             "value": "Test Ptown"
                        },
                         {
                             "dataElement": "w9RT32cvgHf",
                             "value": "Test Pvillage"
                         },
                         {
                             "dataElement": "XZ3OP1jdCfo",
                             "value": "Test Pward"
                         },
                        {"dataElement":"SWhiDdRgUwT",
                        "value" :""
                        },
                         {
                            "dataElement": "KdiR3PGFj3P",
                            "value": ""
                        },
                        {
                            "dataElement":"qihIcNI1PdA",
                            "value":"Uncomplicated (OP)"
                        },
                        {
                            "dataElement":"GASizN790rz",
                            "value":"> 24hr"
                        },
                        {
                            "dataElement": "WJ1MqhmfPHz",
                            "value": "N/A"
                        },
                        {
                            "dataElement": "jqCfD3BCumN",
                            "value": "N/A"
                        },
                        {
                            "dataElement": "QBBPxUuOulF",
                            "value": "N/A"
                        },
                        {
                            "dataElement": "UUWSRVYn7Pl",
                            "value": "No"
                        },
                         {
                            "dataElement": "aWLj1EJFbQV",
                            "value": "No"
                        },
                         {
                            "dataElement": "rBkCZXJFKXq",
                            "value": "test remark"
                        }

                    ]
                    }
                    ]
                }

            ]

        }
    ]

    }';

        $trackedEntityInstances[] = $trackedEntityInstance;

}
        $url = 'https://mcbrs-dev2.myanmarvbdc.com/api/40/trackedEntityInstances';
        // $username = 'admin';
        // $password = 'district';
        $ch = curl_init($url);

        // Set the content type to JSON
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Basic YWRtaW46ZGlzdHJpY3Q=',
            'charset=utf8'
        ));

        // Set the request method to POST
        curl_setopt($ch, CURLOPT_POST, 1);

        // Attach the JSON data to the request
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Receive server response...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);
        dd('this is sent=>',$response);
        // Close cURL session handle
        curl_close($ch);

        // Output the server response

        echo $response;
    }

}
