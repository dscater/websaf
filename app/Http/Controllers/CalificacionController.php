<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesor;
use App\Inscripcion;
use App\Paralelo;
use App\TrimestreActividad;
use App\Calificacion;
use App\CalificacionTrimestre;
use App\ProfesorMateria;
use App\Estudiante;

class CalificacionController extends Controller
{
    public function index(Profesor $profesor)
    {
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
        return view('calificacions.index', compact('profesor', 'array_gestiones', 'array_paralelos'));
    }

    public function store(Request $request)
    {
        $calificacion = $request->calificacion;
        $trimestre = $request->trimestre;
        $area = $request->area;
        $nro_actividad = $request->actividad;
        $nota = $request->nota;
        $promedio = $request->promedio;
        $promedio_final = $request->promedio_final;

        $calificacion_estudiante = Calificacion::find($calificacion);
        $trimestre = CalificacionTrimestre::where('calificacion_id', $calificacion_estudiante->id)
            ->where('trimestre', $trimestre)
            ->get()
            ->first();
        $actividad = TrimestreActividad::where('ct_id', $trimestre->id)
            ->where('area', $area)
            ->get()
            ->first();

        $actividad['a' . $nro_actividad] = $nota;
        $actividad->promedio = $promedio;
        $actividad->save();

        $trimestre->promedio_final = $promedio_final;
        $trimestre->save();

        // COMPROBAR EL ESTADO DE LA CALIFICACION
        $calificacion_trimestres = CalificacionTrimestre::where('calificacion_id', $calificacion_estudiante->id)->get();
        $suma_promedios = 0;
        foreach ($calificacion_trimestres as $trimestre) {
            $suma_promedios += (float)$trimestre->promedio_final;
        }

        $suma_promedios = $suma_promedios / 3;
        $promedio_trimestres = \number_format($suma_promedios, 0);
        $calificacion_estudiante->nota_final = $promedio_trimestres;
        if ($promedio_trimestres > 50) {
            $calificacion_estudiante->estado = 'APROBADO';
        } else {
            $calificacion_estudiante->estado = 'REPROBADO';
        }
        $calificacion_estudiante->save();

        return response()->JSON([
            'sw' => true
        ]);
    }

    public function getEstudiantesCalificacions(Request $request)
    {
        $materia = $request->materia;
        $gestion = $request->gestion;
        $trimestre = $request->trimestre;

        $profesor_materia = ProfesorMateria::find($materia);

        $calificacions = Calificacion::select('calificacions.*')
            ->join('inscripcions', 'inscripcions.id', '=', 'calificacions.inscripcion_id')
            ->where('calificacions.materia_id', $materia)
            ->where('inscripcions.nivel', $profesor_materia->nivel)
            ->where('inscripcions.grado', $profesor_materia->grado)
            ->where('inscripcions.paralelo_id', $profesor_materia->paralelo_id)
            ->where('inscripcions.turno', $profesor_materia->turno)
            ->where('inscripcions.gestion', $gestion)
            ->where('inscripcions.status', 1)
            ->get();

        $suma_promedio = 0;

        $html = '';
        if (count($calificacions) > 0) {
            foreach ($calificacions as $calificacion) {

                $html .= '<tr class="fila" data-calificacion="' . $calificacion->id . '">
                            <td>' . $calificacion->inscripcion->estudiante->paterno . ' ' . $calificacion->inscripcion->estudiante->materno . ' ' . $calificacion->inscripcion->estudiante->nombre . '</td>';

                for ($i = 1; $i <= 4; $i++) {
                    $c_trimestre = CalificacionTrimestre::where('calificacion_id', $calificacion->id)
                        ->where('trimestre', $trimestre)
                        ->get()
                        ->first();

                    $actividad = TrimestreActividad::where('ct_id', $c_trimestre->id)
                        ->where('area', $i)
                        ->get()
                        ->first();

                    $html .= '<td class="a' . $i . '1 calificacion" data-actividad="1" data-area="' . $i . '">
                                    <input type="number" min="0" value="' . $actividad->a1 . '">
                                </td>
                                <td class="a' . $i . '2 calificacion" data-actividad="2" data-area="' . $i . '">
                                    <input type="number" min="0" value="' . $actividad->a2 . '">
                                </td>
                                <td class="a' . $i . '3 calificacion" data-actividad="3" data-area="' . $i . '">
                                    <input type="number" min="0" value="' . $actividad->a3 . '">
                                </td>
                                <td class="a' . $i . '4 calificacion" data-actividad="4" data-area="' . $i . '">
                                    <input type="number" min="0" value="' . $actividad->a4 . '">
                                </td>
                                <td class="a' . $i . '5 calificacion" data-actividad="5" data-area="' . $i . '">
                                    <input type="number" min="0" value="' . $actividad->a5 . '">
                                </td>
                                <td class="a' . $i . '6 calificacion" data-actividad="6" data-area="' . $i . '">
                                    <input type="number" min="0" value="' . $actividad->a6 . '">
                                </td>
                                <td class="bg-lightblue p' . $i . ' promedio" data-area="' . $i . '">' . $actividad->promedio . '</td>';
                    $suma_promedio += (float)$actividad->promedio;
                }
                $html .= ' <td class="bg-orange pf promedio_final">' . $c_trimestre->promedio_final . '</td>';
                $html .= '</tr>';
            }
        } else {
            $html = '<tr class="vacio">
            <td colspan="30" class="text-center">No se encontrarón registros</td>
            </tr>';
        }

        return response()->JSON([
            'sw' => true,
            'html' => $html
        ]);
    }

    public function calificacion_estudiante(Estudiante $estudiante)
    {
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


        return view('calificacions.calificacion_estudiante', compact('estudiante', 'array_gestiones', 'array_paralelos'));
    }

    public function notas_estudiante(Estudiante $estudiante, Request $request)
    {
        $gestion = $request->gestion;

        $inscripcion = Inscripcion::where('estudiante_id', $estudiante->id)
            ->where('gestion', $gestion)
            ->get()
            ->first();

        $calificacions = [];
        if ($inscripcion) {
            $calificacions = Calificacion::where('inscripcion_id', $inscripcion->id)->get();
        }

        $html = '';
        $cont = 1;
        foreach ($calificacions as $calificacion) {
            $promedio = $calificacion->trimestres[0]->promedio_final + $calificacion->trimestres[1]->promedio_final + $calificacion->trimestres[2]->promedio_final;
            $promedio = $promedio / 3;
            $promedio = (int)$promedio;
            $obs = 'APROBADO';
            if ($promedio < 51) {
                $obs = 'REPROBADO';
            }
            $html .= '<tr>
                        <td>' . $cont++ . '</td>
                        <td>' . $calificacion->materia->nombre . '</td>
                        <td>' . $calificacion->trimestres[0]->promedio_final . '</td>
                        <td>' . $calificacion->trimestres[1]->promedio_final . '</td>
                        <td>' . $calificacion->trimestres[2]->promedio_final . '</td>
                        <td>' . $promedio . '</td>
                        <td>' . $obs . '</td>
                    </tr>';
        }

        return response()->JSON([
            'sw' => true,
            'html' => $html
        ]);
    }

    public function boleta_estudiante(Estudiante $estudiante)
    {
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

        return view('calificacions.boleta_estudiante', compact('estudiante', 'array_gestiones', 'array_paralelos'));
    }

    public function historial_academico(Estudiante $estudiante)
    {
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

        return view('calificacions.historial_academico', compact('estudiante', 'array_gestiones', 'array_paralelos'));
    }
}
