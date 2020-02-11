<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionPurchaseLine extends Model
{
    protected $guarded = [];

    public function item(){
        return $this->belongsTo('App\ProductItem','product_item_id','id');
    }

    public function transaction(){
        return $this->belongsTo('App\Transaction');
    }


}