<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesors', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->string('ci');
            $table->string('ci_exp');
            $table->string('lugar_nac');
            $table->date('fecha_nac');
            $table->integer('edad');
            $table->string('sexo');
            $table->string('estado_civil');
            $table->string('zona');
            $table->string('avenida');
            $table->string('nro');
            $table->string('fono');
            $table->string('cel');
            $table->string('email')->nullable();
            $table->string('nro_rda');
            $table->string('afp');
            $table->string('nua');
            $table->string('item_fiscal');
            $table->string('nro_seguro_social');
            $table->string('caja_seguro_social');
            $table->string('titulado');

            $table->string('gestiones_trabajo');
            $table->string('cargo');
            $table->string('mes');
            $table->text('observaciones');
            $table->string('foto', 255);
            $table->date('fecha_registro');
            $table->bigInteger('user_id')->unsigned();
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesors');
    }
}
