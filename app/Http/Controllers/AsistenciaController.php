<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\asistencia;
use App\Profesor;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        $asistencias = asistencia::where('estado', 1)->get();
        $profesors = Profesor::select('profesors.*')
            ->where('profesors.estado', 1)
            ->get();

        $array_profesors[''] = 'Seleccione...';
        foreach ($profesors as $value) {
            $array_profesors[$value->user->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }

        if ($request->ajax()) {
            $nom_profesor = $request->nom_profesor;
            $mes = $request->mes;
            $anio = $request->anio;
            $array_dias = ['D', 'L', 'M', 'M', 'J', 'V', "S"];
            $fecha = $anio . '-' . $mes . '-01';
            $dias = date('t', \strtotime($fecha));
            if ($nom_profesor != '') {
                $profesors = Profesor::select('profesors.*')
                    ->join('users', 'users.id', '=', 'profesors.user_id')
                    ->where('profesors.estado', 1)
                    ->where(DB::raw('CONCAT(profesors.nombre, profesors.paterno, profesors.materno)'), 'LIKE', "%$nom_profesor%")
                    ->get();
            }

            $header = '<th colspan="2">Profesor</th>';
            for ($i = 1; $i <= $dias; $i++) {
                $nro_dia = $i;
                if ($nro_dia < 10) {
                    $nro_dia = '0' . $nro_dia;
                }
                $fecha_dia = $anio . '-' . $mes . '-' . $nro_dia;
                $txt_dia = date('w', strtotime($fecha_dia));
                $header .= '<th>' . $i . '<br>' . $array_dias[$txt_dia] . '</th>';
            }

            $fila_html = '';
            foreach ($profesors as $profesor) {
                $fila_html .= '<tr>';
                $fila_html .= '<td><img alt="" class="img-table" src="' . asset('imgs/users/' . $profesor->user->foto) . '"></td>
                                <td>' . $profesor->nombre . ' ' . $profesor->paterno . ' ' . $profesor->materno . '
                                </td>';
                for ($i = 1; $i <= $dias; $i++) {
                    if ($i < 10) {
                        $fecha = $anio . '-' . $mes . '-0' . $i;
                    } else {
                        $fecha = $anio . '-' . $mes . '-' . $i;
                    }
                    $asistencia = Asistencia::where('user_id', $profesor->user->id)
                        ->where('fecha', $fecha)->get()->first();
                    if ($asistencia) {
                        $fila_html .= '<td><i class="fa fa-check text-success"></i></td>';
                    } else {
                        $fila_html .= '<td><i class="fa fa-times text-danger"></i></td>';
                    }
                }
                $fila_html .= '</tr>';
            }

            return response()->JSON([
                'sw' => true,
                'header' => $header,
                'filas' => $fila_html
            ]);
        }

        $gestion_min = Asistencia::min('fecha');
        $gestion_max = Asistencia::max('fecha');
        $gestion_min = date('Y', strtotime($gestion_min));
        $gestion_max = date('Y', strtotime($gestion_max));

        $array_gestiones = [];
        if ($gestion_min) {
            $array_gestiones[''] = 'Seleccione...';
            for ($i = (int)$gestion_min; $i <= (int)$gestion_max; $i++) {
                $array_gestiones[$i] = $i;
            }
        }

        return view('asistencias.index', compact('asistencias', 'array_profesors', 'array_gestiones'));
    }

    public function getAccion(Request $request)
    {
        $fecha = $request->fecha;
        $user_id = $request->user_id;

        $existe_asistencia = Asistencia::where('user_id', $user_id)
            ->where('fecha', $fecha)
            ->where('estado', 1)
            ->get()
            ->first();
        $accion = 'INGRESO';
        if ($existe_asistencia) {
            if ($existe_asistencia->hora_salida == null) {
                $accion = 'SALIDA';
            } else {
                $accion = 'REGISTRADO';
            }
        }

        return response()->JSON($accion);
    }

    public function create()
    {
        return view('asistencias.create');
    }

    public function store(Request $request)
    {
        $accion = $request->accion;
        if ($accion == 'INGRESO') {
            $request['hora_ingreso'] = $request->hora;
        }
        $request['estado'] = 1;

        if($accion != ''){
            if ($accion == 'SALIDA') {
                // buscar el registro
                $asistencia = Asistencia::where('user_id', $request->user_id)
                    ->where('fecha', $request->fecha)
                    ->get()->first();
                $asistencia->hora_salida = $request->hora;
                $asistencia->save();
            } else {
                $asistencia = asistencia::create(array_map('mb_strtoupper', $request->all()));
                $asistencia->hora_salida = NULL;
                $asistencia->save();
            }
        }

        return redirect()->route('asistencias.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(asistencia $asistencia)
    {
        return view('asistencias.edit', compact('asistencia'));
    }

    public function update(asistencia $asistencia, Request $request)
    {
        $asistencia->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('asistencias.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(asistencia $asistencia)
    {
        return 'mostrar cargo';
    }

    public function destroy(asistencia $asistencia)
    {
        $asistencia->estado = 0;
        $asistencia->save();
        return redirect()->route('asistencias.index')->with('bien', 'Registro eliminado correctamente');
    }
}
