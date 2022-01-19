<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cuentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->string('nro_cuenta');
            $table->string('descripcion');
            $table->date('fecha_apertura');
            $table->float('saldo');
            $table->string('tipo_moneda');
            $table->string('observaciones');
            $table->bigInteger('fkid_cliente')->unsigned();
            $table->timestamps();
            $table->foreign('fkid_cliente')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas');
    }
}
