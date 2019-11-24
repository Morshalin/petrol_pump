<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function ProductStocks(){
        return $this->hasMany('App\Product');
    }

    public function Salarypayments(){
         return $this->hasMany('App\Salarypayment');
    }
}
