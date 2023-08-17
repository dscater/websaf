<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministrativoCurso extends Model
{
    protected $fillable = [
        'administrativo_id', 'nominacion', 'institucion',
        'duracion', 'fecha'
    ];

    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class, 'administrativo_id');
    }
}
