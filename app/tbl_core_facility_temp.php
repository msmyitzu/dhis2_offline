<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_core_facility_temp extends Model
{
    protected $table = 'tbl_core_facility_temp';
    protected $primaryKey = 'CF_Code';
    public $timestamps = false;
}
