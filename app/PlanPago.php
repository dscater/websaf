<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanPago extends Model
{
    protected $fillable = [
        'nivel', 'concepto', 'monto', 'gestion',
        'meses', 'descripcion', 'fecha_registro', 'estado',
    ];
}
