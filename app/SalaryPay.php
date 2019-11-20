<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryPay extends Model
{
    protected $guarded=[];

    public function employe(){
        return $this->belongsTo('App\Employess','employesse_id','id');
    }
}
