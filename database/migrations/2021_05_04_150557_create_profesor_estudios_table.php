<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesorEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesor_estudios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('profesor_id')->unsigned();
            $table->string('nivel')->nullable();
            $table->string('institucion')->nullable();
            $table->string('anio_egreso')->nullable();
            $table->string('especialidad')->nullable();
            $table->string('nro_titulo')->nullable();

            $table->timestamps();
            $table->foreign('profesor_id')->references('id')->on('profesors')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesor_estudios');
    }
}
