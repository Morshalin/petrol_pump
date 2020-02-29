<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountTransaction extends Model
{
    protected $guarded = [];

    public function bankAccount(){
        return $this->belongsTo('App\BankAccount');
    }
}
