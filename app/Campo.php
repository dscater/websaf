<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    protected $fillable = [
        'nombre', 'descripcion'
    ];

    public function areas()
    {
        return $this->hasMany(Area::class, 'campo_id');
    }
}
