<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesor;
use App\ProfesorMateria;
use App\Paralelo;
use App\Materia;
use App\Inscripcion;

class ProfesorMateriaController extends Controller
{
    public function index(Profesor $profesor)
    {
        $paralelos = paralelo::all();
        $array_paralelos[''] = 'Seleccione...';
        foreach ($paralelos as $value) {
            $array_paralelos[$value->id] = $value->paralelo;
        }
        return view('profesors.profesor_materias', compact('profesor', 'array_paralelos'));
    }

    public function materias_asignadas(Profesor $profesor)
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
        return view('profesors.asignacion_materias', compact('profesor', 'array_gestiones'));
    }

    public function getInfoMateriasAsignadas(Profesor $profesor, Request $request)
    {
        $gestion = $request->gestion;
        $materias = ProfesorMateria::where('profesor_id', $profesor->id)
            ->where('gestion', $gestion)
            ->get();
        $html = '';
        $cont = 1;
        foreach ($materias as $materia) {
            $html .= '<tr>
            <td>' . $cont++ . '</td>
            <td>' . $materia->nivel . '</td>
            <td>' . $materia->materia->nombre . '</td>
            <td>' . $materia->grado . '</td>
            <td>' . $materia->paralelo->paralelo . '</td>
            <td>' . $materia->turno . '</td>
        </tr>';
        }
        return response()->JSON([
            'sw' => true,
            'html' => $html
        ]);
    }

    public function create(Profesor $profesor)
    {
        return view('profesors.profesor_materias', compact('profesor'));
    }

    public function store(Profesor $profesor, Request $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $request['profesor_id'] = $profesor->id;
        ProfesorMateria::create(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => false,
            'msg' => 'Registro éxitoso'
        ]);
    }

    public function getMateriasDisponibles(Request $request)
    {
        $profesor_id = $request->profesor_id;
        $profesor = Profesor::find($profesor_id);
        $nivel = $request->nivel;
        $grado = $request->grado;

        $gestion = $request->gestion;
        $turno = $request->turno;
        $paralelo = $request->paralelo;

        $materias = Materia::select('materias.id', 'materias.area_id', 'materias.codigo', 'materias.nivel', 'materias.nombre')
            ->join('materia_grados', 'materia_grados.materia_id', '=', 'materias.id')
            ->where('materia_grados.grado', $grado)
            ->where('materias.nivel', $nivel)
            ->where('materia_grados.grado', $grado)
            ->where('materia_grados.horas', '!=', null)
            ->where('materia_grados.horas', '>', 0)
            ->get();

        if (count($materias) > 0) {
            // filtrar materias que ya no estan disponibles
            // para la gestion, turno, paralelo que se selecciono
            $html = '';
            foreach ($materias as $materia) {
                $existe = ProfesorMateria::where('nivel', $nivel)
                    ->where('grado', $grado)
                    ->where('paralelo_id', $paralelo)
                    ->where('turno', $turno)
                    ->where('gestion', $gestion)
                    ->where('materia_id', $materia->id)
                    ->get()->first();

                if ($existe) {
                    // comprobar si es del mismo profesor
                    if ($existe->profesor_id == $profesor->id) {
                        $html .= '<div class="col-md-3 materia asignado">
                                <label>
                                    <span class="nombre">' . $materia->nombre . '</span> <input type="hidden" name="mat" value="' . $materia->id . '" checked>
                                </label>
                            </div>';
                    } else {
                        $html .= '<div class="col-md-3 materia no_disponible">
                                <label>
                                    <span class="nombre">' . $materia->nombre . '</span> <input type="hidden" name="mat" value="' . $materia->id . '" checked disabled>
                                </label>
                            </div>';
                    }
                } else {
                    $html .= '<div class="col-md-3 materia vacio">
                                <label>
                                    <span class="nombre">' . $materia->nombre . '</span> <input type="hidden" name="materia[]" value="' . $materia->id . '">
                                </label>
                            </div>';
                }
            }
            return response()->JSON([
                'sw' => false,
                'html' => $html,
            ]);
        }
        return response()->JSON([
            'sw' => false,
            'html' => 'Nose encontraron materias'
        ]);
    }

    public function destroy(Profesor $profesor, Request $request)
    {
        $nivel = $request->nivel;
        $grado = $request->grado;
        $gestion = $request->gestion;
        $turno = $request->turno;
        $paralelo = $request->paralelo;
        $materia_id = $request->materia_id;
        $profesor_materia = ProfesorMateria::where('profesor_id', $profesor->id)
            ->where('nivel', $nivel)
            ->where('grado', $grado)
            ->where('paralelo_id', $paralelo)
            ->where('turno', $turno)
            ->where('gestion', $gestion)
            ->where('materia_id', $materia_id)
            ->get()
            ->first();

        $profesor_materia->delete();
        return response()->JSON([
            'sw' => false,
            'msg' => 'Eliminación éxitosa'
        ]);
    }
}
