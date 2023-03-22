<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_hfm extends Model
{
    protected $table = 'tbl_hfm';
    protected $primaryKey = 'hfm_id';
    public $timestamps = false;
    protected $fillable = ['SC_Code'] ;
}
