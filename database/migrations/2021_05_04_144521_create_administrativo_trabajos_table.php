<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativoTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrativo_trabajos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('administrativo_id')->unsigned();
            $table->string('institucion')->nullable();
            $table->string('gestion')->nullable();
            $table->string('cargo')->nullable();

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
        Schema::dropIfExists('administrativo_trabajos');
    }
}
