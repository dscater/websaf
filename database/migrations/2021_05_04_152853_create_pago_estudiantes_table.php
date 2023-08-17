<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('estudiante_id')->unsigned();
            $table->bigInteger('inscripcion_id')->unsigned();
            $table->string('concepto');
            $table->decimal('monto', 24, 2);
            $table->date('fecha_pago');
            $table->string('tipo_factura');
            $table->string('factura_nombre');
            $table->string('factura_nit');
            $table->date('fecha_registro');
            $table->integer('gestion');
            $table->string('descripcion', 255)->nullable();
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->ondelete('no action')->onupdate('cascade');
            $table->foreign('inscripcion_id')->references('id')->on('inscripcions')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago_estudiantes');
    }
}
