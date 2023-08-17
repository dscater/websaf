<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RazonSocial extends Model
{
    protected $fillable = [
        'codigo', 'nombre', 'alias', 'nro_resolucion',
        'codigo_sie', 'tipo_ue', 'ciudad', 'nro_distrito',
        'desc_distrito', 'dir', 'nit', 'nro_aut', 'fono',
        'cel', 'casilla', 'correo', 'web', 'logo',
        'actividad_economica',
    ];
}
