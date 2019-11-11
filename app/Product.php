<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{

     protected $guarded = [];
   
   public function productitem(){
   	return $this->belongsTo('App\ProductItem','product_item_id','id');
   }

   public function companyinfo(){
   	return $this->belongsTo('App\CompanyInfo', 'company_id','id');
   }
}
