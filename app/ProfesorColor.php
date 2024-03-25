<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfesorColor extends Model
{
    protected $fillable = [
        "profesor_id",
        "color"
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }
}
