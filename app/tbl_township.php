<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_township extends Model
{
    protected $table = 'tbl_township';
    protected $primaryKey = 'township_id';

    protected $fillable = ['township_id','district_code','township_name_dhis2_code','township_mmr','township_name_en','township_name_mm','status'];

}
