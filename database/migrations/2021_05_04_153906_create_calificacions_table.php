<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificacions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inscripcion_id')->unsigned();
            $table->bigInteger('materia_id')->unsigned();
            $table->double('notal_final', 8, 2);
            $table->string('estado');
            $table->date('fecha_registro');
            $table->timestamps();

            $table->foreign('inscripcion_id')->references('id')->on('inscripcions')->ondelete('no action')->onupdate('cascade');
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
        Schema::dropIfExists('calificacions');
    }
}
