<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterschedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterschedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('training_id')->unsigned();
            $table->string('type');
            $table->string('nameschedulemaster');
            $table->timestamps();

            $table->foreign('training_id')->references('id')->on('trainings')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masterschedules');
    }
}
