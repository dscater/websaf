<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Administrativo;
use App\Profesor;
use App\Estudiante;
use App\Inscripcion;
use App\paralelo;
use App\ProfesorMateria;
use App\Asistencia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $administrativos = count(Administrativo::select('administrativos.*')
            ->where('administrativos.estado', 1)
            ->get());

        $profesors = count(Profesor::select('profesors.*')
            ->where('profesors.estado', 1)
            ->get());

        $estudiantes = count(Estudiante::select('estudiantes.*')
            ->where('estudiantes.estado', 1)
            ->get());

        $gestion_min = Inscripcion::min('gestion');
        $gestion_max = Inscripcion::max('gestion');

        $array_gestiones = [];
        if ($gestion_min) {
            $array_gestiones[''] = 'Seleccione...';
            for ($i = (int)$gestion_min; $i <= (int)$gestion_max; $i++) {
                $array_gestiones[$i] = $i;
            }
        }

        $paralelos = paralelo::all();
        $array_paralelos[''] = 'Seleccione...';
        foreach ($paralelos as $value) {
            $array_paralelos[$value->id] = $value->paralelo;
        }

        $materias = 0;
        $asistencias = 0;
        if (Auth::user()->tipo == 'PROFESOR' && Auth::user()->profesor) {
            $materias = count(ProfesorMateria::where('profesor_id', Auth::user()->profesor->id)
                ->where('gestion', date('Y'))
                ->get());

            $fecha_gestion = date('Y');
            $asistencias = count(Asistencia::where('user_id', Auth::user()->id)
                ->where('fecha', 'LIKE', "$fecha_gestion%")
                ->get());
        }

        return view('home', compact('administrativos', 'profesors', 'estudiantes', 'array_gestiones', 'array_paralelos', 'materias', 'asistencias'));
    }
}
