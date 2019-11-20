<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('sales_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_number')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->double('oil_sale', 10,2)->nullable();
            $table->double('oil_price', 10,2)->nullable();
            $table->double('oil_total_price', 10,2)->nullable();
            $table->date('sale_date')->nullable();
            $table->text('cus_description')->nullable();
            $table->string('status')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('sales_customers');
    }
}
