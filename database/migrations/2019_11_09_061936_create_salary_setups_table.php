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
            $table->unsignedBigInteger('employesse_id')->nullable();
            $table->string('employe_id_no')->nullable();
            $table->string('post_name')->nullable();
            $table->double('employe_sallary',10,2)->nullable();
            $table->string('status')->nullable();
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
