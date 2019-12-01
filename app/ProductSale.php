<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model{
    protected $guarded = [];

     public function productitem(){
   	return $this->belongsTo('App\ProductItem','product_id','id');
   }
}
