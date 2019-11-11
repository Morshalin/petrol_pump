<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model{

     protected $guarded = [];

     public function products(){
        $this->hasMany('App/Product');
    }
}