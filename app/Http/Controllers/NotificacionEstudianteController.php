<?php

namespace App\Http\Controllers;

use App\NotificacionEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionEstudianteController extends Controller
{
    public function index(Request $request)
    {
        $notificacion_estudiantes = [];

        if (Auth::user()->tipo == 'ESTUDIANTE' && Auth::user()->estudiante) {
            $notificacion_estudiantes = NotificacionEstudiante::where("estudiante_id", Auth::user()->estudiante->id)->get();
        }

        return view("notificacion_estudiantes.index", compact("notificacion_estudiantes"));
    }

    public function byEstudiante(Request $request)
    {
        $notificacion_estudiantes = [];
        $last_id = $request->last_id;
        if (Auth::user()->tipo == 'ESTUDIANTE' && Auth::user()->estudiante) {
            $notificacion_estudiantes = NotificacionEstudiante::where("estudiante_id", Auth::user()->estudiante->id)
                ->where("id", ">", $last_id)
                ->where("visto", 0)
                ->orderBy("created_at", "desc")
                ->get();
            if (count($notificacion_estudiantes) > 0) {
                $last_id = $notificacion_estudiantes[count($notificacion_estudiantes) - 1]->id;
            }

            $notificacion_ultimo = NotificacionEstudiante::where("estudiante_id", Auth::user()->estudiante->id)
                ->where("visto", 0)
                ->orderBy("created_at", "desc")
                ->get()->first();
            $last_id = 0;
            if ($notificacion_ultimo) {
                $last_id = $notificacion_ultimo->id;
            }
        }

        $html = "";
        if (count($notificacion_estudiantes) > 0) {
            $html = view("parcial.notificaciones", compact("notificacion_estudiantes"))->render();
        }

        $notificacion_estudiantes_sinver = NotificacionEstudiante::where("estudiante_id", Auth::user()->estudiante->id)
            ->where("visto", 0)
            ->get();
        $sin_ver = count($notificacion_estudiantes_sinver);
        return response()->JSON([
            "sin_ver" => $sin_ver,
            "notificacion_estudiantes" => $notificacion_estudiantes,
            "html" => $html,
            "last_id" => $last_id
        ]);
    }

    public function show(NotificacionEstudiante $notificacion_estudiante)
    {
        $notificacion_estudiante->visto = 1;
        $notificacion_estudiante->save();

        return view("notificacion_estudiantes.show", compact("notificacion_estudiante"));
    }
}
