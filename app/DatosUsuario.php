<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosUsuario extends Model
{
    protected $table = 'datos_usuarios';
    protected $fillable = [
        'nombre','paterno','materno','ci','ci_exp','genero','dir','email','fono','cel',
        'user_id','fecha_registro'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
