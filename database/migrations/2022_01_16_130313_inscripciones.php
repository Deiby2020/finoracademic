<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inscripciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fkid_gestion')->unsigned();
            $table->bigInteger('fkid_estudiante')->unsigned();
            $table->timestamps();
            $table->foreign('fkid_gestion')->references('id')->on('gestiones');
            $table->foreign('fkid_estudiante')->references('id')->on('estudiantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripciones');
    }
}
