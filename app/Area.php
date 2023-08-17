<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'campo_id', 'nombre', 'tipo', 'descripcion',
    ];

    public function campo()
    {
        return $this->belongsTo(Campo::class, 'campo_id');
    }

    public function materias()
    {
        return $this->hasMany(Materia::class, 'area_id');
    }
}
