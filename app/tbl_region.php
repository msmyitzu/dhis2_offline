<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_region extends Model
{
    protected $table = 'tbl_region';
    protected $primaryKey = 'region_id';
    protected $fillable = ['region_id','region_name_en'];

}
