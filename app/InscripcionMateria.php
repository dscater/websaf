<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscripcionMateria extends Model
{
    protected $fillable = [
        'inscripcion_id', 'materia_id', 'notal_final',
        'estado',
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
        return $this->hasMany(InscripcionMateriaTrimestre::class, 'im_id');
    }
}
