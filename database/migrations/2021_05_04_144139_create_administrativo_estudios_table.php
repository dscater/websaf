<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativoEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrativo_estudios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('administrativo_id')->unsigned();
            $table->string('nivel')->nullable();
            $table->string('institucion')->nullable();
            $table->string('anio_egreso')->nullable();
            $table->string('especialidad')->nullable();
            $table->string('nro_titulo')->nullable();

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
        Schema::dropIfExists('administrativo_estudios');
    }
}
