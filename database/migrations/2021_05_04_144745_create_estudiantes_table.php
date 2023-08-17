<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->string('tipo_doc');
            $table->string('nro_doc');
            $table->string('ci_exp')->nullable();
            $table->string('pais_nac');
            $table->string('dpto_nac');
            $table->string('provincia_nac');
            $table->string('localidad_nac');
            $table->date('fecha_nac');
            $table->string('sexo');
            $table->string('oficialia');
            $table->string('libro');
            $table->string('partida');
            $table->string('folio');
            $table->string('ue_procedencia', 255);
            $table->string('codigo_sie_ue');

            $table->string('provincia_dir');
            $table->string('zona_dir');
            $table->string('municipio_dir');
            $table->string('avenida_dir');
            $table->string('localidad_dir');
            $table->string('fono_dir');
            $table->string('nro_dir');

            $table->string('idioma_niniez');
            $table->string('idiomas_estudiante');
            $table->string('pueblo_nacion');
            $table->string('pueblo_nacion_otro');
            $table->string('centro_salud');
            $table->string('veces_centro_salud');
            $table->string('discapacidad');
            $table->string('discapacidad_otro');
            $table->string('desc_discapacidad');

            $table->string('agua');
            $table->string('energia_electrica');
            $table->string('banio');
            $table->string('actividad');
            $table->string('dias_trabajo')->nullable();
            $table->string('recibio_pago')->nullable();
            $table->string('internet');
            $table->string('frecuencia_internet')->nullable();
            $table->string('llega');
            $table->string('llega_otro');
            $table->string('desc_llega');

            $table->string('ci_padre_tutor');
            $table->string('ap_padre_tutor');
            $table->string('nom_padre_tutor');
            $table->string('idioma_padre_tutor');
            $table->string('ocupacion_padre_tutor');
            $table->string('grado_padre_tutor');
            $table->string('parentezco_padre_tutor')->nullable();

            $table->string('ci_madre')->nullable();
            $table->string('ap_madre')->nullable();
            $table->string('nom_madre')->nullable();
            $table->string('idioma_madre')->nullable();
            $table->string('ocupacion_madre')->nullable();
            $table->string('grado_madre')->nullable();

            $table->string('lugar');
            $table->date('fecha_registro');
            $table->bigInteger('user_id')->unsigned();
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->ondelete('no action')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}
