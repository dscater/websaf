<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificacionEstudiante extends Model
{
    protected $fillable = [
        "estudiante_id",
        "inscripcion_id",
        "materia_id",
        "trimestre",
        "actividad_id",
        "txt_area",
        "no_area",
        "no_actividad",
        "nota",
        "descripcion",
        "visto"
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'inscripcion_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function actividad()
    {
        return $this->belongsTo(TrimestreActividad::class, 'actividad_id');
    }

    public function profesor_materia()
    {
        return $this->belongsTo(ProfesorMateria::class, 'profesor_materia_id');
    }
}
