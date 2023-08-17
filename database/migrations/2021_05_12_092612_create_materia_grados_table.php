<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaGradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_grados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('materia_id')->unsigned();
            $table->string('nivel');
            $table->string('grado');
            $table->integer('horas')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('materia_grados');
    }
}
