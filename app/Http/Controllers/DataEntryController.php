<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataEntryController extends Controller
{
    //for index

    public function getDistrictData($data)
    {
        $data = DB::table("tbl_district")
        ->where('district_name_mmr', 'like', $data.'%')
        ->get();
        return response()->json($data);
    }

    public function getTownshipData($data)
    {
        $data = DB::table("tbl_township")
        ->where('township_mmr', 'like', $data . '%')
        ->get();
        return response()->json($data);
    }

    public function getHealthFacilityData($data)
    {
        $data = DB::table("tbl_health_facility")
        ->where('health_facility_mmr', 'like', $data . '%')
        ->get();
        return response()->json($data);
    }

    public function getSubCenterData($data)
    {
        $data = DB::table("tbl_sub_center")
        ->where('sub_center_mmr', 'like', $data . '%')
        ->get();
        return response()->json($data);
    }

    public function getvhvData($data)
    {
        $data = DB::table("tbl_village")
        ->where('village_mmr', 'like', $data . '%')
        ->get();
        return response()->json($data);
    }


    //for Upload Data

    public function DistrictData($data)
    {
        $data = DB::table("tbl_district")
        ->where('district_name_mmr', 'like', $data.'%')
        ->get();
        return response()->json($data);
    }

    public function TownshipData($data)
    {
        $data = DB::table("tbl_township")
        ->where('township_mmr', 'like', $data . '%')
        ->get();
        return response()->json($data);
    }

    public function HealthFacilityData($data)
    {
        $data = DB::table("tbl_health_facility")
        ->where('health_facility_mmr', 'like', $data.'%')
        ->get();
        return response()->json($data);
    }



    public function SubCenterData($data)
    {
        $data = DB::table("tbl_sub_center")
        ->where('sub_center_mmr', 'like', $data . '%')
        ->get();
        return response()->json($data);
    }

    public function vhvData($data)
    {
        $data = DB::table("tbl_village")
        ->where('village_mmr', 'like', $data . '%')
        ->get();
        return response()->json($data);
    }

//For patient_register_form_row
public function outsideTownshipData($data)
    {
         $data = DB::table("tbl_township")
        // ->where('township_mmr', 'like', $data . '%')
         ->get();
         return response()->json($data);
    }

    public function outsideHealthFacilityData($data)
    {
        $data = DB::table("tbl_health_facility")
        ->where('health_facility_mmr', 'like', $data . '%')
        ->get();
        return response()->json($data);
    }

    public function currentTownshipData($data)
    {
         $data = DB::table("tbl_township")
        // ->where('township_mmr', 'like', $data . '%')
         ->get();
         return response()->json($data);
    }

    public function currentHealthFacilityData($data)
    {
        $data = DB::table("tbl_health_facility")
        ->where('health_facility_mmr', 'like', $data . '%')
        ->get();
        return response()->json($data);
    }



}




