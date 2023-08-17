<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrimestreActividad extends Model
{
    protected $fillable = [
        'ct_id', 'area', 'a1', 'a2',
        'a3', 'a4', 'a5', 'a6', 'promedio',
    ];

    public function imt()
    {
        return $this->belongsTo(CalificacionTrimestre::class, 'ct_id');
    }
}
