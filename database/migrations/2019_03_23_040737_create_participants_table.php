<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('training_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('fullname')->nullable();
            $table->string('phone')->nullable();
            $table->string('participant_type')->default('PNS');
            $table->string('frontdegree')->nullable();//gelar depan
            $table->string('backdegree')->nullable();//gelar belakang
            $table->string('rank')->nullable();//pangkat
            $table->string('position')->nullable();//jabatan
            $table->string('institution')->nullable();//instansi asal
            $table->string('unit_institution')->nullable();//unit instansi
            $table->string('institution_address')->nullable();//alamat instansi
            $table->string('institution_phone')->nullable();//telepon instansi
            $table->string('requirements')->nullable(); //document requirements for registration
            $table->string('properplan')->default('belum ada data');//file rancangan
            $table->string('propername')->default('belum ada data');//judul proper
            $table->string('properdocs')->default('belum ada data');//file proper
            $table->string('properslug')->default('belum ada data');//slug proper
            $table->string('properabstract')->default('belum ada data');//file abstract proper
            $table->timestamps();

            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
