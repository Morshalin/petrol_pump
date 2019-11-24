<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
     protected $guarded = [];

     public function productitem(){
   	return $this->belongsTo('App\ProductItem','product_item_id','id');
   }
}
