<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalificacionTrimestre extends Model
{
    protected $fillable = [
        'calificacion_id', 'trimestre', 'promedio_final'
    ];

    public function calificacion()
    {
        return $this->belongsTo(Calificacion::class, 'calificacion_id');
    }

    public function actividads()
    {
        return $this->hasMany(TrimestreActividad::class, 'ct_id');
    }
}
