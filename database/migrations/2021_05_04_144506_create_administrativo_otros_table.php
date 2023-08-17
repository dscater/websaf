<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativoOtrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrativo_otros', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('administrativo_id')->unsigned();
            $table->string('institucion')->nullable();
            $table->string('turno')->nullable();
            $table->string('zona')->nullable();
            $table->string('cargo')->nullable();
            $table->integer('total_horas')->nullable();
            
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
        Schema::dropIfExists('administrativo_otros');
    }
}
