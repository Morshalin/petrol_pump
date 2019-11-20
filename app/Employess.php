<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employess extends Model{
   protected $guarded = [];
   
   public function post(){
   	return $this->belongsTo('App\Post');
   }

     public function shift(){
    	return $this->belongsTo('App\Shifttime');
    }

       public function attendees(){
    	return $this->hasMany('App\Attendees');
    }

    public function salarysetup(){
       return $this->hasMany('App\SalarySetup');
    }

}
