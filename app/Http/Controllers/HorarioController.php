<?php

namespace App\Http\Controllers;

use App\Hora;
use App\Horario;
use App\Inscripcion;
use App\Profesor;
use App\ProfesorColor;
use App\ProfesorMateria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::all();
        return view('horarios.index', compact('horarios'));
    }

    public function estudiante()
    {
        $gestion_min = Inscripcion::min('gestion');
        $gestion_max = Inscripcion::max('gestion');

        $array_gestiones = [];
        $actual = date("Y");

        if ($gestion_max < $actual) {
            $gestion_max = $actual;
        }
        if ($gestion_min) {
            $array_gestiones[''] = 'Seleccione...';
            for ($i = (int)$gestion_min; $i <= (int)$gestion_max; $i++) {
                $array_gestiones[$i] = $i;
            }
        }

        $profesor_colors = ProfesorColor::all();

        return view('horarios.estudiante', compact('array_gestiones', 'profesor_colors'));
    }

    public function estudiante_info(Request $request)
    {
        $gestion = $request->gestion;
        $turno = $request->turno;
        if (Auth::user()->estudiante) {
            $inscripcion = Inscripcion::where("estudiante_id", Auth::user()->estudiante->id)
                ->where("gestion", $gestion)
                ->where("turno", $turno)
                ->where("status", 1)
                ->get()->first();

            if ($inscripcion) {
                // obtener e iterar horas
                $horas = Hora::where("turno", $inscripcion->turno)
                    ->orderBy("hora_ini", "asc")
                    ->get();

                $dias = [
                    "1" => "LUNES",
                    "2" => "MARTES",
                    "3" => "MIERCOLES",
                    "4" => "JUEVES",
                    "5" => "VIERNES",
                ];

                $colspan_recreo = 0;

                $array_datos = [];
                foreach ($dias as $key => $d) {
                    $array_datos[$key] = [
                        "maximo" => 0,
                        "horarios" => [],
                    ];
                    foreach ($horas as $h) {
                        $horarios = Horario::where("hora_id", $h->id)
                            ->where("gestion", $gestion)
                            ->where("dia", $key)->get();
                        $total = count($horarios);
                        if ($array_datos[$key]["maximo"] < $total) {
                            $array_datos[$key]["maximo"] = $total;
                        }
                        $array_datos[$key]["horarios"][$h->id] = $horarios;
                    }
                    $colspan_recreo += (int)$array_datos[$key]["maximo"] > 0 ?  (int)$array_datos[$key]["maximo"] : 1;
                }
                $html = view("horarios.parcial.estudiante", compact("horas", "dias", "array_datos", "colspan_recreo"))->render();
                return response()->JSON([
                    "html" => $html
                ]);
            }
        }
        return response()->JSON([
            "html" => "No se encontrarón registros"
        ]);
    }

    public function profesor()
    {
        $gestion_min = Inscripcion::min('gestion');
        $gestion_max = Inscripcion::max('gestion');

        $array_gestiones = [];
        $actual = date("Y");

        if ($gestion_max < $actual) {
            $gestion_max = $actual;
        }
        if ($gestion_min) {
            $array_gestiones[''] = 'Seleccione...';
            for ($i = (int)$gestion_min; $i <= (int)$gestion_max; $i++) {
                $array_gestiones[$i] = $i;
            }
        }

        $profesor_colors = ProfesorColor::all();

        return view('horarios.profesor', compact('array_gestiones', 'profesor_colors'));
    }

    public function profesor_info(Request $request)
    {
        $gestion = $request->gestion;
        $turno = $request->turno;
        if (Auth::user()->profesor) {
            // obtener e iterar horas
            $horas = Hora::where("turno", $request->turno)
                ->orderBy("hora_ini", "asc")
                ->get();

            $dias = [
                "1" => "LUNES",
                "2" => "MARTES",
                "3" => "MIERCOLES",
                "4" => "JUEVES",
                "5" => "VIERNES",
            ];

            $colspan_recreo = 0;

            $array_datos = [];
            foreach ($dias as $key => $d) {
                $array_datos[$key] = [
                    "maximo" => 0,
                    "horarios" => [],
                ];
                foreach ($horas as $h) {
                    $horarios = Horario::where("hora_id", $h->id)
                        ->where("profesor_id", Auth::user()->profesor->id)
                        ->where("gestion", $gestion)
                        ->where("dia", $key)->get();
                    $total = count($horarios);
                    if ($array_datos[$key]["maximo"] < $total) {
                        $array_datos[$key]["maximo"] = $total;
                    }
                    $array_datos[$key]["horarios"][$h->id] = $horarios;
                }
                $colspan_recreo += (int)$array_datos[$key]["maximo"] > 0 ?  (int)$array_datos[$key]["maximo"] : 1;
            }
            $html = view("horarios.parcial.profesor", compact("horas", "dias", "array_datos", "colspan_recreo"))->render();
            return response()->JSON([
                "html" => $html
            ]);
        }
        return response()->JSON([
            "html" => "No se encontrarón registros"
        ]);
    }

    public function create()
    {
        $horas = Hora::where("recreo", null)->get();
        $array_horas[''] = 'Seleccione...';
        foreach ($horas as $value) {
            $array_horas[$value->id] = $value->hora_c;
        }

        $profesors = Profesor::select('profesors.*')
            ->where('profesors.estado', 1)
            ->get();
        $array_profesors[''] = '- Seleccione -';
        foreach ($profesors as $value) {
            $array_profesors[$value->id] = $value->paterno . ' ' . $value->materno . ' ' . $value->nombre;
        }

        $gestion = date("Y");

        return view('horarios.create', compact('array_horas', 'array_profesors', 'gestion'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request["fecha_registro"] = date("Y-m-d");
            $profesor_materia = ProfesorMateria::find($request->profesor_materia_id);
            $request["materia_id"] = $profesor_materia->materia_id;

            $profesor_color = ProfesorColor::where("profesor_id", $profesor_materia->profesor_id)->get()->first();
            if (!$profesor_color) {
                $profesor_color = ProfesorColor::create([
                    "profesor_id" => $profesor_materia->profesor_id,
                    "color" => "#007dcc"
                ]);
            }
            $request["color"] = $profesor_color->color;

            Horario::create(array_map('mb_strtoupper', $request->all()));
            DB::commit();
            return redirect()->route('horarios.index')->with('bien', 'Registro realizado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('horarios.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit(Horario $horario)
    {
        $horas = Hora::where("recreo", null)->get();
        $array_horas[''] = 'Seleccione...';
        foreach ($horas as $value) {
            $array_horas[$value->id] = $value->hora_c;
        }

        $profesors = Profesor::select('profesors.*')
            ->where('profesors.estado', 1)
            ->get();
        $array_profesors[''] = '- Seleccione -';
        foreach ($profesors as $value) {
            $array_profesors[$value->id] = $value->paterno . ' ' . $value->materno . ' ' . $value->nombre;
        }

        $profesor_materias = ProfesorMateria::where("profesor_id", $horario->profesor->id)
            ->where("gestion", $horario->gestion)
            ->get();

        $array_profesor_materias[] = "- Seleccione -";
        foreach ($profesor_materias as $pm) {
            $array_profesor_materias[$pm->id] = $pm->materia->nombre . '(' . $pm->turno . ')';
        }

        $gestion = date("Y");
        return view('horarios.edit', compact('horario', 'array_horas', 'array_profesors', 'array_profesor_materias', 'gestion'));
    }

    public function update(Horario $horario, Request $request)
    {
        $profesor_color = ProfesorColor::where("profesor_id", $horario->profesor_id)->get()->first();
        if (!$profesor_color) {
            $profesor_color = ProfesorColor::create([
                "profesor_id" => $horario->profesor_id,
                "color" => "#007dcc"
            ]);
        }
        $request["color"] = $profesor_color->color;

        $horario->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('horarios.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Horario $horario)
    {
        return 'mostrar cargo';
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->route('horarios.index')->with('bien', 'Registro eliminado correctamente');
    }
}
