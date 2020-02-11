<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_info_id')->nullable();
            $table->foreign('company_info_id')->references('id')->on('company_infos')->onDelete('cascade');
            $table->unsignedBigInteger('employess_id')->nullable();
            $table->foreign('employess_id')->references('id')->on('employesses')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('transaction_status', ['purchase', 'sale']);
            $table->string('transactions_date')->nullable();
            $table->enum('pay_type', ['paid', 'due']);
            $table->string('invoice_no')->nullable();
            $table->double('sub_total', 8, 2)->nullable();
            $table->string('discount_type')->nullable();
            $table->double('discount_amount', 8, 2)->nullable();
            $table->double('discount', 8, 2)->nullable();
            $table->double('net_total', 8, 2)->nullable();
            $table->string('pay_method')->nullable();
            $table->double('paid', 8, 2)->nullable();
            $table->double('due', 8, 2)->nullable();
            $table->text('additional_notes')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
