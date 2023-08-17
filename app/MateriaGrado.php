<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriaGrado extends Model
{
    protected $fillable = [
        'materia_id', 'grado', 'horas'
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}
