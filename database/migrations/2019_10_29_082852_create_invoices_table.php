<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->unsignedBigInteger('cutomer_id')->nullable();
             $table->double('amount_petrol',10,2)->nullable();
             $table->double('amount_disel',10,2)->nullable();
             $table->double('petrol_pay_bill',10,2)->nullable();
             $table->double('disel_pay_bill',10,2)->nullable();
             $table->double('total_pay_bill',10,2)->nullable();
             $table->foreign('cutomer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
