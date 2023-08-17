<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    protected $fillable = [
        'nombre', 'paterno', 'materno', 'ci',
        'ci_exp', 'lugar_nac', 'fecha_nac', 'edad',
        'sexo', 'estado_civil', 'zona', 'avenida',
        'nro', 'fono', 'cel', 'email',
        'nro_rda', 'afp', 'nua', 'item_fiscal',
        'nro_seguro_social', 'caja_seguro_social', 'titulado', 'gestiones_trabajo',
        'cargo', 'mes', 'observaciones', 'foto', 'fecha_registro',
        'user_id', 'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function estudios()
    {
        return $this->hasMany(AdministrativoEstudio::class, 'administrativo_id');
    }

    public function cursos()
    {
        return $this->hasMany(AdministrativoCurso::class, 'administrativo_id');
    }

    public function otros()
    {
        return $this->hasMany(AdministrativoOtro::class, 'administrativo_id');
    }

    public function trabajos()
    {
        return $this->hasMany(AdministrativoTrabajo::class, 'administrativo_id');
    }
}
