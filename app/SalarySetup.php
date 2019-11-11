<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalarySetup extends Model{
   protected $guarded=[];
    public function employes(){
        return $this->hasMany('App\Employess');
    }
}
