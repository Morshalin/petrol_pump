<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
     protected $guarded = [];

     public function investowners(){
         return $this->belongsTo('App\Investowner','investowner_id','id');
     }
}