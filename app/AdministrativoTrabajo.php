<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministrativoTrabajo extends Model
{
    protected $fillable = [
        'administrativo_id', 'institucion',
        'gestion', 'cargo'
    ];

    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class, 'administrativo_id');
    }
}
