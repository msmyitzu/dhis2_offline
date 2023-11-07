<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_total_patient extends Model
{
    protected $table = 'tbl_total_patient';
    protected $primaryKey = 'TP_Code';
    public $timestamps = false;
}
