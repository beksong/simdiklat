<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailschedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('masterschedule_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->date('dateschedule');
            $table->string('timeschedule');
            $table->integer('sessionschedule')->unsigned();
            $table->integer('jp')->unsigned();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('masterschedule_id')->references('id')->on('masterschedules')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailschedules');
    }
}
