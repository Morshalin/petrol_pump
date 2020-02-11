<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_item_id')->nullable();
            $table->foreign('product_item_id')->references('id')->on('product_items')->onDelete('cascade');
            $table->unsignedBigInteger('transaction_purchase_line_id')->nullable();
            $table->foreign('transaction_purchase_line_id')->references('id')->on('transaction_purchase_lines')->onDelete('cascade');
            $table->unsignedBigInteger('transaction_sale_line_id')->nullable();
            $table->foreign('transaction_sale_line_id')->references('id')->on('transaction_sale_lines')->onDelete('cascade');
            $table->enum('stock_type', ['sell', 'purchase','opening']);
            $table->double('quantity', 8, 2)->nullable();
            $table->double('price', 8, 2)->nullable();
            $table->double('total', 8, 2)->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('stocks');
    }
}
