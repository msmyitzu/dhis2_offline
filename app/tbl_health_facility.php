<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_health_facility extends Model
{
    protected $table = 'tbl_health_facility';
    protected $primaryKey = 'health_facility_id';

    protected $fillable = ['health_facility_id','township_code','health_facility_dhis2_code','health_facility_mmr','health_facility_name_en','health_facility_name_mm','status'];


}
