<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $fillable = [
        'estudiante_id', 'nivel', 'grado', 'paralelo_id',
        'turno', 'gestion', 'estado', 'status', 'fecha_registro',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function paralelo()
    {
        return $this->belongsTo(Paralelo::class, 'paralelo_id');
    }

    public function pagos()
    {
        return $this->hasMany(PagoEstudiante::class, 'inscripcion_id');
    }

    public function materias()
    {
        return $this->hasMany(InscripcionMateria::class, 'inscripcion_id');
    }
}
