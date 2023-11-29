<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_district extends Model
{
    protected $table = 'tbl_district';
    protected $primaryKey = 'cf_id';
    protected $fillable = ['district_id','region_code','district_name_dhis2_code','district_mmr','district_name_en','district_name_mm','district_name_mmr','status'];

}
