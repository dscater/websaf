<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $fillable = [
        'nombre', 'paterno', 'materno', 'tipo_doc', 'nro_doc', 'ci_exp',
        'pais_nac', 'dpto_nac', 'provincia_nac', 'localidad_nac', 'fecha_nac',
        'sexo', 'oficialia', 'libro', 'partida', 'folio', 'ue_procedencia',
        'codigo_sie_ue', 'provincia_dir', 'zona_dir', 'municipio_dir',
        'avenida_dir', 'localidad_dir', 'fono_dir', 'nro_dir', 'idioma_niniez',
        'idiomas_estudiante', 'pueblo_nacion', 'pueblo_nacion_otro',
        'centro_salud', 'veces_centro_salud', 'discapacidad', 'discapacidad_otro',
        'desc_discapacidad', 'agua', 'energia_electrica',
        'banio', 'actividad', 'dias_trabajo', 'recibio_pago', 'internet',
        'frecuencia_internet', 'llega', 'llega_otro', 'desc_llega', 'ci_padre_tutor', 'ap_padre_tutor', 'nom_padre_tutor', 'idioma_padre_tutor', 'ocupacion_padre_tutor', 'grado_padre_tutor', 'parentezco_padre_tutor', 'ci_madre', 'ap_madre', 'nom_madre',
        'idioma_madre', 'ocupacion_madre', 'grado_madre', 'lugar', 'foto',
        'fecha_registro', 'user_id', 'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function inscripcions()
    {
        return $this->hasMany(Inscripcion::class, 'estudiante_id');
    }

    public function pagos()
    {
        return $this->hasMany(PagoEstudiante::class, 'estudiante_id');
    }
}
