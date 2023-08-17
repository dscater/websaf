<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfesorOtro extends Model
{
    protected $fillable = [
        'profesor_id', 'institucion', 'turno',
        'zona', 'cargo', 'total_horas'
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }
}
