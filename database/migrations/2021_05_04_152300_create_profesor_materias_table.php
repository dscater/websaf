<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesorMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesor_materias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('profesor_id')->unsigned();
            $table->string('nivel', 155);
            $table->string('grado', 155);
            $table->bigInteger('paralelo_id')->unsigned();
            $table->string('turno');
            $table->integer('gestion');
            $table->bigInteger('materia_id')->unsigned();
            $table->date('fecha_registro');
            $table->timestamps();

            $table->foreign('profesor_id')->references('id')->on('profesors')->ondelete('no action')->onupdate('cascade');
            $table->foreign('nivel_id')->references('id')->on('nivels')->ondelete('no action')->onupdate('cascade');
            $table->foreign('grado_id')->references('id')->on('grados')->ondelete('no action')->onupdate('cascade');
            $table->foreign('paralelo_id')->references('id')->on('paralelos')->ondelete('no action')->onupdate('cascade');
            $table->foreign('materia_id')->references('id')->on('materias')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesor_materias');
    }
}
