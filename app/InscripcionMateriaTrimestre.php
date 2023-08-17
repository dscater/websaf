<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscripcionMateriaTrimestre extends Model
{
    protected $fillable = [
        'im_id', 'trimestre',
    ];

    public function im()
    {
        return $this->belongsTo(InscripcionMateria::class, 'im_id');
    }

    public function actividads()
    {
        return $this->hasMany(TrimestreActividad::class, 'imt_id');
    }
}
