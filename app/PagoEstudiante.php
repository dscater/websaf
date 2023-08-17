<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoEstudiante extends Model
{
    protected $fillable = [
        'estudiante_id', 'inscripcion_id', 'concepto', 'monto', 'fecha_pago',
        'tipo_factura', 'factura_nombre', 'factura_nit', 'fecha_registro',
        'gestion', 'descripcion','qr','cod_control','fecha_limite', 'estado',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'inscripcion_id');
    }
}
