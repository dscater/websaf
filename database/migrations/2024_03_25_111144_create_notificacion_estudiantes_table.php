<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacion_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("estudiante_id");
            $table->unsignedBigInteger("inscripcion_id");
            $table->unsignedBigInteger("materia_id");
            $table->integer("trimestre");
            $table->unsignedBigInteger("actividad_id");
            $table->string("txt_area");
            $table->integer("no_area");
            $table->integer("no_actividad");
            $table->double("nota");
            $table->string("descripcion", 500);
            $table->integer("visto");
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
        Schema::dropIfExists('notificacion_estudiantes');
    }
}
