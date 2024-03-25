<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
        "profesor_id",
        "materia_id",
        "profesor_materia_id",
        "hora_id",
        "dia",
        "color",
        "gestion",
        "fecha_registro",
    ];

    protected $appends = ["dia_t"];

    public function getDiaTAttribute()
    {
        $dias = [
            "1" => "LUNES",
            "2" => "MARTES",
            "3" => "MIERCOLES",
            "4" => "JUEVES",
            "5" => "VIERNES",
        ];

        return $dias[$this->dia];
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function profesor_materia()
    {
        return $this->belongsTo(ProfesorMateria::class, 'profesor_materia_id');
    }

    public function hora()
    {
        return $this->belongsTo(Hora::class, 'hora_id');
    }
}
