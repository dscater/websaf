<?php

namespace App\Http\Controllers;

use App\Calificacion;
use App\Inscripcion;
use App\NotificacionEstudiante;

class AgenteInteligenteController extends Controller
{
    public function generarNotificaciones($inscripciones)
    {
        // Array para almacenar las notificaciones
        $notificaciones = array();

        // Generar notificaciones para cada estudiante inscrito
        foreach ($inscripciones as $item) {
            $calificaciones = $this->detectarEventos($item);

            if (!empty($calificaciones)) {
                foreach ($calificaciones as $calificacion) {
                    $notificacion = $this->generarNotificacion($calificacion, $item);
                    if ($notificacion) {
                        $notificaciones[] = $notificacion;
                    }
                }
            }
        }
        return $notificaciones;
    }

    // Obtener eventos/calificaciones
    private function detectarEventos(Inscripcion $inscripcion)
    {
        $calificaciones = Calificacion::where("inscripcion_id", $inscripcion)->where("gestion", date("Y"))->get();
        return $calificaciones;
    }

    // Generar una notificación para un evento dado
    private function generarNotificacion(Calificacion $calificacion, Inscripcion $inscripcion)
    {
        $notificacion = NotificacionEstudiante::create([
            "inscripcion_id" => $inscripcion->id,
            "materia_id" => $calificacion->materia_id,
            "estudiante_id" => $inscripcion->estudiante_id,
            "nota" => $calificacion->nota,
        ]);
        return $notificacion;
    }
}
