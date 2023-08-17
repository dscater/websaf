<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesorCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesor_cursos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('profesor_id')->unsigned();
            $table->string('nominacion')->nullable();
            $table->string('institucion')->nullable();
            $table->string('duracion')->nullable();
            $table->date('fecha')->nullable();
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
        Schema::dropIfExists('profesor_cursos');
    }
}
