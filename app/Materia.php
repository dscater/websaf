<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = [
        'area_id', 'codigo', 'nivel', 'nombre',
        'fecha_registro',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function grados()
    {
        return $this->hasMany(MateriaGrado::class, 'materia_id');
    }

    public function materias()
    {
        return $this->belongsTo(ProfesorMateria::class, 'materia_id');
    }

    public function inscripcions()
    {
        return $this->hasMany(InscripcionMateria::class, 'materia_id');
    }
}
