<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employe_id_no')->nullable();
            $table->string('employe_name')->nullable();
            $table->string('employe_number')->nullable();
            $table->string('alter_number')->nullable();
            $table->string('employe_email')->nullable();
            $table->string('employe_age')->nullable();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->string('employe_gender')->nullable();
            $table->string('employe_join_date')->nullable();
            $table->integer('shift_id')->nullable();
            $table->double('employe_sallary',10,2)->nullable();
            $table->string('image')->nullable();
            $table->string('employe_address')->nullable();
            $table->string('status')->nullable();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
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
        Schema::dropIfExists('employesses');
    }
}
