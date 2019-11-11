<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    protected $guarded = [];

    public function products(){
        $this->hasMany('App/Product');
    }
}
