<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendees extends Model{
   protected $guarded = [];

 public function employee(){
   	return $this->belongsTo('App\Employess','employe_id','id');
   }
}