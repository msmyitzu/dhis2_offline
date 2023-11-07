<?php

namespace App\Http\Controllers;

use App\tbl_individual_case;
use App\tbl_region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

public function dhis2getData() {
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
    dd($apiData);
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

public function dhis2postData(Request $request) {
    // /{$updateURL}
    $url = "https://mcbrs-dev2.myanmarvbdc.com/api/29/dataElements";
    https://mcbrs-dev2.myanmarvbdc.com/api/29/dataElements/E0qWI5la2Zh.json
$data =DB::table('tbl_individual_case')->get();
$data2 = DB::table('tbl_nil')->get();
// dd($data2);
    // dd($data);
     $postData = [];
     $postData2 = [];
if ($data) {
    foreach ($data as $row) {

        $postData[] = [
            'enrollmentDate' => $row->screening_date,
            'pt_name' => $row->pt_Name,
            'age' => $row->pt_age,
            'f_name' => $row->pt_father_name,
            'case_outside_SubCenter_township' => $row->pt_address,
            'current_township' => $row->pt_current_township,
            'current_village' => $row-> pt_current_village,
            'current_otherVillage' => $row->pt_current_ward,
            'parmenant_township' => $row-> pt_permanent_township,
            'parmenant_village' =>$row->pt_permanent_village,
            'parmenant_otherVillage'=>$row->pt_permanent_ward,
            'gender' => $row->Sex_Code,
            'pregnancy_tf' => $row->Preg_YN,
            'rdt_test' => $row ->RDT_Code,
            'mcp_test' =>$row -> Micro_Code,
            'act'=> $row->ACT_Code,
            'cq'=>$row->CQ_Code,
            'pq'=>$row->PQ_Code,
            'referral'=>$row->Referral_Code,
            'm_death'=>$row->Malaria_Death,
            'note'=>$row->Remark,
            'travel'=>$row->travel_yn,
            'job'=>$row->occupation
        ];
    }
}

if($data2){
    foreach ($data2 as $d) {

        $postData[] = [
            'outerPatients'=>$d->total_outpatient,
            'outerPatientsAge'=>$d->u5_outpatient,
            'outerPregnancyPatients'=>$d->preg_outpatient,
            'innerPatients'=>$d->total_inpatient,
            'innerPatientsAge'=>$d->u5_inpatient,
            'innerPregnancyPatients'=>$d->preg_inpatient,
            'totalPatientsDead'=>$d->death_facility
        ];
        }
}

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    
    if (curl_errno($ch)) {
        return 'cURL error: ' . curl_error($ch);
    }

    curl_close($ch);

    if ($response !== false) {
        // dd('response form server :'. $response);
        return 'Response from server: ' . $response;
    } else {
        return 'Failed to receive a response.';
    }
}

}
