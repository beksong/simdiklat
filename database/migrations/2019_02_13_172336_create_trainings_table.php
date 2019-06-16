<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->string('slug');
            $table->date('start_date');
            $table->integer('period')->unsigned();
            $table->date('end_date');
            $table->integer('pic_id')->unsigned();
            $table->longText('description')->nullable();
            $table->string('training_type')->default('latsar');
            $table->string('status')->default('active');//status apakah diklat masih aktif atau telah selesai
            $table->timestamps();

            $table->foreign('pic_id')->references('id')->on('pics')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
}
