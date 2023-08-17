<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministrativoEstudio extends Model
{
    protected $fillable = [
        'administrativo_id', 'nivel', 'institucion',
        'anio_egreso', 'especialidad', 'nro_titulo'
    ];

    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class, 'administrativo_id');
    }
}
