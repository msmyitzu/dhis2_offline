<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_core_facility extends Model
{
    protected $table = 'tbl_core_facility';
    protected $primaryKey = 'CF_Code';
    public $timestamps = false;
}
