<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_sub_center extends Model
{
    protected $table = 'tbl_sub_center';
    protected $primaryKey = 'sub_center_id';

    protected $fillable = ['sub_center_id','health_facility_code','sub_center_dhis2_code','sub_center_mmr','sub_center_name_en','sub_center_name_mm','status'];

}
