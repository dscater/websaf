<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministrativoOtro extends Model
{
    protected $fillable = [
        'administrativo_id', 'institucion', 'turno',
        'zona', 'cargo', 'total_horas'
    ];

    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class, 'administrativo_id');
    }
}
