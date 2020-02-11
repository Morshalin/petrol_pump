<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shifttime extends Model{
	protected $guarded = [];

	public function employess(){
    	return $this->hasMany('App\Employess','shift_id','id');
    }

}
