<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionSaleLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_sale_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->unsignedBigInteger('product_item_id')->nullable();
            $table->foreign('product_item_id')->references('id')->on('product_items')->onDelete('cascade');
            $table->string('vehicle_name')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->double('quantity', 8, 2)->nullable();
            $table->double('unit_price', 8, 2)->nullable();
            $table->double('total', 8, 2)->nullable();
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
        Schema::dropIfExists('transaction_sale_lines');
    }
}
