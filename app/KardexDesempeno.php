<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KardexDesempeno extends Model
{
    protected $fillable = [
        "estudiante_id",
        "inscripcion_id",
        "materia_id",
        "profesor_materia_id",
        "i_a",
        "i_b",
        "i_c",
        "i_d",
        "i_e",
        "i_f",
        "i_g",
        "i_h",
        "i_i",
        "i_j",
        "fecha",
        "observaciones",
        "aspectos_positivos",
    ];

    protected $appends = ["fecha_t"];

    public function getFechaTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha));
    }

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
    public function profesor_materia()
    {
        return $this->belongsTo(ProfesorMateria::class, 'profesor_materia_id');
    }
}
