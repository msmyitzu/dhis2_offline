<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_total_patient_temp extends Model
{
    protected $table = 'tbl_total_patient_temp';
    protected $primaryKey = 'TP_Code';
    public $timestamps = false;
}
