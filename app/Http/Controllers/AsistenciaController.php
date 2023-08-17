<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\asistencia;
use App\Estudiante;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        $asistencias = asistencia::where('estado', 1)->get();
        $estudiantes = Estudiante::select('estudiantes.*')
            ->where('estudiantes.estado', 1)
            ->get();

        $array_estudiantes[''] = 'Seleccione...';
        foreach ($estudiantes as $value) {
            $array_estudiantes[$value->user->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }

        if ($request->ajax()) {
            $nom_estudiante = $request->nom_estudiante;
            $mes = $request->mes;
            $anio = $request->anio;
            $array_dias = ['D', 'L', 'M', 'M', 'J', 'V', "S"];
            $fecha = $anio . '-' . $mes . '-01';
            $dias = date('t', \strtotime($fecha));
            if ($nom_estudiante != '') {
                $estudiantes = Estudiante::select('estudiantes.*')
                    ->join('users', 'users.id', '=', 'estudiantes.user_id')
                    ->where('estudiantes.estado', 1)
                    ->where(DB::raw('CONCAT(estudiantes.nombre, estudiantes.paterno, estudiantes.materno)'), 'LIKE', "%$nom_estudiante%")
                    ->get();
            }

            $header = '<th colspan="2">Estudiante</th>';
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
            foreach ($estudiantes as $estudiante) {
                $fila_html .= '<tr>';
                $fila_html .= '<td><img alt="" class="img-table" src="' . asset('imgs/users/' . $estudiante->user->foto) . '"></td>
                                <td>' . $estudiante->nombre . ' ' . $estudiante->paterno . ' ' . $estudiante->materno . '
                                </td>';
                for ($i = 1; $i <= $dias; $i++) {
                    if ($i < 10) {
                        $fecha = $anio . '-' . $mes . '-0' . $i;
                    } else {
                        $fecha = $anio . '-' . $mes . '-' . $i;
                    }
                    $asistencia = Asistencia::where('user_id', $estudiante->user->id)
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
        if ($gestion_max < date("Y")) {
            $gestion_max = date("Y");
        }
        $array_gestiones = [];
        if ($gestion_min) {
            $array_gestiones[''] = 'Seleccione...';
            for ($i = (int)$gestion_min; $i <= (int)$gestion_max; $i++) {
                $array_gestiones[$i] = $i;
            }
        }

        return view('asistencias.index', compact('asistencias', 'array_estudiantes', 'array_gestiones'));
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

        if ($accion != '') {
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
