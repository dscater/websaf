<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfesorMateria extends Model
{
    protected $fillable = [
        'profesor_id', 'nivel', 'grado', 'paralelo_id',
        'turno', 'gestion', 'materia_id', 'fecha_registro',
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }

    public function paralelo()
    {
        return $this->belongsTo(Paralelo::class, 'paralelo_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}
