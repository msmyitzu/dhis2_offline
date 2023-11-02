<?php

namespace App\Http\Controllers;

use App\tbl_individual_case;
use App\tbl_region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    //
    public function dhis2getData(){
        // dd('helo');
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://mcbrs-dev2.myanmarvbdc.com//api/organisationUnits.json?filter=level%3Aeq%3A2&paging=false',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            // 'Authorization: Basic YWRtaW46RWZvbGlvc2UxMi0jQ2Fzc2l1czI4'
            'Authorization: Basic YWRtaW46ZGlzdHJpY3Q='

          ),
        ));

        $response = curl_exec($curl);
        $data=tbl_individual_case::all();
        curl_close($curl);
        $data=json_decode($response);
        //  try{
        foreach($data->organisationUnits as $organisationUnit){
          $tbl_region_data = [
            'region_id' => $organisationUnit-> id,
            'region_name_en' => $organisationUnit->displayName
            // 'region_id' => '2',
            // 'region_name_en' => 'test 2'
          ];
        //   dd($tbl_region_data);
          tbl_region::create($tbl_region_data);
        //   dd('hello');
        }
    //     $region=new tbl_region();
    //     $region->region_id='1';
    //     $region->region_name_en='jjjj';
    //     $region->region_mmr='hhhhj';
    //     $region->region_name_mm ='hjhjh';
    //     $region->status=1;
    //     $region->save();
    //     return $region;
    // }catch(\Exception $e){
    //  echo''. $e->getMessage();
    //  }
}
}
