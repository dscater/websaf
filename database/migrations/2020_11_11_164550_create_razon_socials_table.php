<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRazonSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razon_socials', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->string('alias')->nullable();
            $table->string('nro_resolucion');
            $table->string('codigo_sie');
            $table->string('tipo_ue');
            $table->string('ciudad');
            $table->string('nro_distrito');
            $table->string('desc_distrito');
            $table->string('dir');
            $table->string('nit');
            $table->string('nro_aut');
            $table->string('fono');
            $table->string('cel');
            $table->string('casilla')->nullable();
            $table->string('correo')->nullable();
            $table->string('web',255);
            $table->string('logo');
            $table->string('actividad_economica');
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
        Schema::dropIfExists('razon_socials');
    }
}
