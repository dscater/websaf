<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paralelo extends Model
{
    protected $fillable = [
        'paralelo', 'descripcion'
    ];

    public function inscripcions()
    {
        return $this->hasMany(Inscripcion::class, 'paralelo_id');
    }

    public function paralelo()
    {
        return $this->hasMany(Paralelo::class, 'paralelo_id');
    }

    public function materias()
    {
        return $this->hasMany(ProfesorMateria::class, 'paralelo_id');
    }
}
