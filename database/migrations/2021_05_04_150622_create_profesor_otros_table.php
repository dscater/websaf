<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesorOtrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesor_otros', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('profesor_id')->unsigned();
            $table->string('institucion')->nullable();
            $table->string('turno')->nullable();
            $table->string('zona')->nullable();
            $table->string('cargo')->nullable();
            $table->integer('total_horas')->nullable();
            
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
        Schema::dropIfExists('profesor_otros');
    }
}
