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
            $table->string("i_a");
            $table->string("i_b");
            $table->string("i_c");
            $table->string("i_d");
            $table->string("i_e");
            $table->string("i_f");
            $table->string("i_g");
            $table->string("i_h");
            $table->string("i_i");
            $table->string("i_j");
            $table->date("fecha");
            $table->string("observaciones", 500);
            $table->string("aspectos_positivos", 500);
            $table->timestamps();

            $table->foreign("estudiante_id")->on("estudiantes")->references("id");
            $table->foreign("inscripcion_id")->on("inscripcions")->references("id");
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
