<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesCustomer extends Model
{
    protected $guarded=[];

    public function productitem(){
   	return $this->belongsTo('App\ProductItem','product_id','id');
   }

   public function customers(){
       return $this->belongsTo('App\Customer','customer_id','id');
   }

   public function user(){
       return $this->belongsTo('App\User');
   }
}
