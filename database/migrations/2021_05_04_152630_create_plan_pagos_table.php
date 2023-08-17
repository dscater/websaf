<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_pagos', function (Blueprint $table) {
            $table->id();
            $table->string('nivel');
            $table->string('concepto');
            $table->decimal('monto', 24, 2);
            $table->integer('gestion');
            $table->integer('meses');
            $table->string('descripcion');
            $table->date('fecha_registro');
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('nivel_id')->references('id')->on('nivels')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_pagos');
    }
}
