<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_village extends Model
{
    protected $table = "tbl_village";

    protected $fillable = ['village_id','sub_center_code','village_dhis2_code','village_mmr','village_name_en','svillage_name_mm','status'];

}
