<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [
        'user_id', 'hora_ingreso', 'hora_salida', 'fecha',
        'observacion', 'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
