<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MCBRSController extends Controller
{
    //for index

    public function getUserView()
    {
        $userinfo = DB::table("users")->first();
        $regoininfo = DB::table("tbl_region")->count();
        $region_created_at = DB::table('tbl_region')->value('created_at');

        $districtinfo = DB::table("tbl_district")->count();
        $district_created_at = DB::table('tbl_district')->value('created_at');

        $townshipinfo = DB::table("tbl_township")->count();
        $township_created_at = DB::table('tbl_township')->value('created_at');

        $healthfacilityinfo = DB::table("tbl_health_facility")->count();
        $healthfacility_created_at = DB::table('tbl_health_facility')->value('created_at');

        $subcenterinfo = DB::table("tbl_sub_center")->count();
        $subcenter_created_at = DB::table('tbl_sub_center')->value('created_at');

        $villageinfo = DB::table("tbl_village")->count();
        $village_created_at = DB::table('tbl_sub_center')->value('created_at');

        $countinfo = array(
            array(
                'count' => $regoininfo,
                'level' => '1',
                'lable' => 'region',
                'date' => $region_created_at,
            ),
            array(
                'count' => $districtinfo,
                'level' => '1',
                'lable' => 'district',
                'date' => $district_created_at,
            ),
            array(
                'count' => $townshipinfo,
                'level' => '1',
                'lable' => 'township',
                'date' => $township_created_at,
            ),
            array(
                'count' => $healthfacilityinfo,
                'level' => '1',
                'lable' => 'health facility',
                'date' => $healthfacility_created_at,
            ),
            array(
                'count' => $subcenterinfo,
                'level' => '1',
                'lable' => 'subcenter',
                'date' => $subcenter_created_at,
            ),
            array(
                'count' => $villageinfo,
                'level' => '1',
                'lable' => 'village',
                'date' => $village_created_at,
            ),
        );

        return view('user-template.userview',compact('userinfo','countinfo'));

    }
}




