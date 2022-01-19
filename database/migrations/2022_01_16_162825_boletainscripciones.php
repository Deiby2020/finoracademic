<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Boletainscripciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletainscripciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fkid_inscripcion')->unsigned();
            $table->bigInteger('fkid_maestro_oferta')->unsigned();
            $table->timestamps();
            $table->foreign('fkid_inscripcion')->references('id')->on('inscripciones');
            $table->foreign('fkid_maestro_oferta')->references('id')->on('maestro_ofertas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boletainscripciones');
    }
}
