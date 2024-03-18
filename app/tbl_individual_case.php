<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_individual_case extends Model
{
    protected $table = 'tbl_individual_case';
    protected $guarded = [];
    protected $primaryKey = 'ic_id';

    public function  scopeSearch($q,$search){
        return $q->when($q,function($q)use($search){
            $q->where('township_mmr','like','%'.$search.'%')
            ->orWhere('screenig_date','like','%'.$search.'%')
            ->orWhere('screenig_date','like','%'.$search.'%');
            // ->orWhere('department','like','%'.$search.'%');
        });
    }

    public function scopeTownshipSearch($q,$township){
        if($township){
            return $q->where('tbl_township.township_name_en','like','%'.$township.'%');
        }
    }


}
