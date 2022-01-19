<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MaestroOfertas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maestro_ofertas', function (Blueprint $table) {
            $table->id();
            $table->string('cupo');
            $table->bigInteger('fkid_materia')->unsigned();
            $table->bigInteger('fkid_docente')->unsigned();
            $table->bigInteger('fkid_grupo')->unsigned();
            $table->bigInteger('fkid_horario')->unsigned();
            $table->bigInteger('fkid_modulo')->unsigned();
            $table->bigInteger('fkid_aula')->unsigned();
            $table->timestamps();
            $table->foreign('fkid_materia')->references('id')->on('materias');
            $table->foreign('fkid_docente')->references('id')->on('docentes');
            $table->foreign('fkid_grupo')->references('id')->on('grupos');
            $table->foreign('fkid_horario')->references('id')->on('horarios');
            $table->foreign('fkid_modulo')->references('id')->on('modulos');
            $table->foreign('fkid_aula')->references('id')->on('aulas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maestro_ofertas');
    }
}
