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
             $table->string('amount_petrol')->nullable();
             $table->string('amount_disel')->nullable();
             $table->string('petrol_pay_bill')->nullable();
             $table->string('disel_pay_bill')->nullable();
             $table->string('total_pay_bill')->nullable();
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
