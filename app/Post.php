<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model{
    protected $guarded = [];

    public function employess(){
    	return $this->hasMany('App\Employess');
    }
}
