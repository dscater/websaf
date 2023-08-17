<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $fillable = [
        'inscripcion_id', 'materia_id', 'nota_final',
        'estado', 'fecha_registro',
    ];

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'inscripcion_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function trimestres()
    {
        return $this->hasMany(CalificacionTrimestre::class, 'calificacion_id');
    }
}
