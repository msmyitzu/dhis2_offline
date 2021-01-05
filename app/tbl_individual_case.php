<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_individual_case extends Model
{
    protected $table = 'tbl_individual_case';
    protected $primaryKey = 'P_Number';
    public $timestamps = false;
}
