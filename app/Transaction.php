<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model{
   protected $guarded = [];

   public function saleLine(){
      return $this->hasMany('App\TransactionSaleLine');
   }

   public function purchase_line(){
      return $this->hasMany('App\TransactionPurchaseLine');
   }


   public function company(){
      return $this->belongsTo('App\CompanyInfo','company_info_id','id');
   }

   public function employess(){
      return $this->belongsTo('App\Employess');
   }

   public function  transaction_payment(){
      return $this->hasMany('App\TransactionPayment');
   }

   public function  customer(){
      return $this->belongsTo('App\Customer','customer_id','id');
   }


}
