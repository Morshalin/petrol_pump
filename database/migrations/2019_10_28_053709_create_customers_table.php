<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_name')->nullable();
            $table->string('customer_number')->nullable();
            $table->string('alter_number')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('image')->nullable();
            $table->text('customer_address')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
