<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{
    protected $fillable = [
        "hora_ini",
        "hora_fin",
        "recreo",
        "turno",
    ];

    protected $appends = ["hora_c"];

    public function getHoraCAttribute()
    {
        return date("H:i", strtotime($this->hora_ini)) . " A " . date("H:i", strtotime($this->hora_fin));
    }
}
