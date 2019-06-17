<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintedschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printedschedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('masterschedule_id')->unsigned();
            $table->date('dateschedule')->nullable();
            $table->string('timeschedule')->nullable();
            $table->string('subject')->nullable();
            $table->integer('jp')->unsigned()->nullable();
            $table->integer('sessionschedule')->unsigned()->nullable();
            $table->string('speaker')->nullable();
            $table->string('description')->nullable();
            $table->string('uniqueschedule')->nullable();
            $table->timestamps();

            $table->foreign('masterschedule_id')->references('id')->on('masterschedules')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printedschedules');
    }
}
