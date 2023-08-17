<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfesorCurso extends Model
{
    protected $fillable = [
        'profesor_id', 'nominacion', 'institucion',
        'duracion', 'fecha'
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }
}
