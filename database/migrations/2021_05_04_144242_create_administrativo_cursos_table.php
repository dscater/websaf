<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativoCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrativo_cursos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('administrativo_id')->unsigned();
            $table->string('nominacion')->nullable();
            $table->string('institucion')->nullable();
            $table->string('duracion')->nullable();
            $table->date('fecha')->nullable();
            $table->timestamps();
            
            $table->foreign('administrativo_id')->references('id')->on('administrativos')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrativo_cursos');
    }
}
