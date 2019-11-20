<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function invoices(){
    	return $this->hasMany('App\Invoice');
    }

     public function SalesCustomer(){
    	return $this->hasMany('App\SalesCustomer');
    }
}
