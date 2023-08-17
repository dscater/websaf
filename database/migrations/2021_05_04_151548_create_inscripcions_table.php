<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('estudiante_id')->unsigned();
            $table->varchar('nivel');
            $table->varchar('grado');
            $table->bigInteger('paralelo_id')->unsigned();
            $table->string('turno');
            $table->integer('gestion');
            $table->string('estado');
            $table->integer('status');
            $table->date('fecha_registro');
            $table->timestamps();

            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->ondelete('no action')->onupdate('cascade');
            $table->foreign('nivel_id')->references('id')->on('nivels')->ondelete('no action')->onupdate('cascade');
            $table->foreign('grado_id')->references('id')->on('grados')->ondelete('no action')->onupdate('cascade');
            $table->foreign('paralelo_id')->references('id')->on('paralelos')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripcions');
    }
}
