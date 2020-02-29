<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $guarded=[];

    public function transaction(){
        return $this->hasMany('App\AccountTransaction');
    }
}
