<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfesorEstudio extends Model
{
    protected $fillable = [
        'profesor_id', 'nivel', 'institucion',
        'anio_egreso', 'especialidad', 'nro_titulo'
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }
}
