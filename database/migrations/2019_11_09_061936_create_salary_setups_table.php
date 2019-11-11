<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalarySetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employe_id_no')->nullable();
            $table->string('employesse_id')->nullable();
            $table->string('post_name')->nullable();
            $table->string('employe_sallary')->nullable();
            $table->foreign('employesse_id')->references('id')->on('employesses')->onDelete('cascade');
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
        Schema::dropIfExists('salary_setups');
    }
}
