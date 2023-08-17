<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfesorTrabajo extends Model
{
    protected $fillable = [
        'profesor_id', 'institucion',
        'gestion', 'cargo'
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }
}
