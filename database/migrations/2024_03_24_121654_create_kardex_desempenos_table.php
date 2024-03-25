<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexDesempenosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex_desempenos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("estudiante_id");
            $table->unsignedBigInteger("inscripcion_id");
            $table->unsignedBigInteger("materia_id");
            $table->unsignedBigInteger("profesor_materia_id");
            $table->string("i_a")->nullable();
            $table->string("i_b")->nullable();
            $table->string("i_c")->nullable();
            $table->string("i_d")->nullable();
            $table->string("i_e")->nullable();
            $table->string("i_f")->nullable();
            $table->string("i_g")->nullable();
            $table->string("i_h")->nullable();
            $table->string("i_i")->nullable();
            $table->string("i_j")->nullable();
            $table->date("fecha");
            $table->string("observaciones", 500);
            $table->string("aspectos_positivos", 500);
            $table->timestamps();

            $table->foreign("estudiante_id")->on("estudiantes")->references("id");
            $table->foreign("inscripcion_id")->on("inscripcions")->references("id");

            $table->foreign("materia_id")->on("materias")->references("id");
            $table->foreign("profesor_materia_id")->on("profesor_materias")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kardex_desempenos');
    }
}
