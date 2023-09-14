<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inscripcion;
use App\Estudiante;
use App\Paralelo;
use App\Materia;
use App\Calificacion;
use App\CalificacionTrimestre;
use App\TrimestreActividad;
use Barryvdh\DomPDF\Facade as PDF;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripcions = inscripcion::where('status', 1)->get();
        return view('inscripcions.index', compact('inscripcions'));
    }

    public function create()
    {
        $estudiantes = Estudiante::select('estudiantes.*')
            ->where('estudiantes.estado', 1)
            ->get();
        $paralelos = paralelo::all();

        $array_estudiantes[''] = 'Seleccione...';
        $array_paralelos[''] = 'Seleccione...';

        foreach ($estudiantes as $value) {
            $array_estudiantes[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }
        foreach ($paralelos as $value) {
            $array_paralelos[$value->id] = $value->paralelo;
        }
        return view('inscripcions.create', compact('array_estudiantes', 'array_paralelos'));
    }

    public function store(Request $request)
    {

        $existe_inscripcion = Inscripcion::where("estudiante_id", $request->estudiante_id)
            ->where("gestion", $request->gestion)
            ->where("status", 1)
            ->get()->first();

        if (!$existe_inscripcion) {
            $request['fecha_registro'] = date('Y-m-d');
            $request['estado'] = 'REPROBADO';
            $request['status'] = 1;
            $nueva_inscripcion = new inscripcion(array_map('mb_strtoupper', $request->all()));

            // REGISTRAR LAS MATERIAS ASIGNADAS AL GRADO Y NIVEL
            // Materia
            // MateriaGrado
            $materia_grados = Materia::select('materias.*')
                ->join('materia_grados', 'materia_grados.materia_id', '=', 'materias.id')
                ->where('materias.nivel', $nueva_inscripcion->nivel)
                ->where('grado', $nueva_inscripcion->grado)
                ->get();

            if (count($materia_grados) == 0) {
                return redirect()->route('inscripcions.index')->with('error', 'Error. No hay materias asignadas al NIVEL y GRADO que seleccionó. Comuniquese con un Administrador/Secretaria');
            }

            $nueva_inscripcion->save();
            foreach ($materia_grados as $materia) {
                //Registrar Materia En la inscripcion
                $nueva_calificacion = Calificacion::create([
                    'inscripcion_id' => $nueva_inscripcion->id,
                    'materia_id' => $materia->id,
                    'notal_final' => 0,
                    'estado' => 'REPROBADO',
                    'fecha_registro' => date('Y-m-d')
                ]);

                for ($i = 1; $i <= 3; $i++) {
                    //Registrar los Trimestres Por Materia
                    $calificacion_trimestre = CalificacionTrimestre::create([
                        'calificacion_id' => $nueva_calificacion->id,
                        'trimestre' => $i
                    ]);

                    // Registrar las Areas(4) y sus 6 actividades
                    for ($j = 1; $j <= 5; $j++) {
                        TrimestreActividad::create([
                            'ct_id' => $calificacion_trimestre->id,
                            'area' => $j,
                            'a1' => 0,
                            'a2' => 0,
                            'a3' => 0,
                            'a4' => 0,
                            'a5' => 0,
                            'a6' => 0,
                            'promedio' => 0
                        ]);
                    }
                }
            }

            return redirect()->route('inscripcions.index')->with('bien', 'Registro realizado con éxito');
        }
        $estudiante = Estudiante::find($request->estudiante_id);
        return redirect()->route('inscripcions.index')->with('error', 'El/La estudiante ' . $estudiante->full_name . " ya tiene una inscripción en la gestión " . $request->gestion);
    }

    public function edit(inscripcion $inscripcion)
    {
        $estudiantes = Estudiante::select('estudiantes.*')
            ->where('estudiantes.estado', 1)
            ->get();
        $paralelos = paralelo::all();

        $array_estudiantes[''] = 'Seleccione...';
        $array_paralelos[''] = 'Seleccione...';

        foreach ($estudiantes as $value) {
            $array_estudiantes[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }
        foreach ($paralelos as $value) {
            $array_paralelos[$value->id] = $value->paralelo;
        }

        return view('inscripcions.edit', compact('inscripcion', 'array_estudiantes', 'array_paralelos'));
    }

    public function update(inscripcion $inscripcion, Request $request)
    {
        $inscripcion->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('inscripcions.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(inscripcion $inscripcion)
    {
        return 'mostrar cargo';
    }

    public function destroy(inscripcion $inscripcion)
    {
        $inscripcion->status = 0;
        $inscripcion->save();
        return redirect()->route('inscripcions.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function cantidad_estudiantes(Request $request)
    {
        $filtro = $request->filtro;
        $gestion = $request->gestion;
        $nivel = $request->nivel;
        $grado = $request->grado;
        $paralelo = $request->paralelo;
        $turno = $request->turno;

        $inscripcions = inscripcion::where('status', 1)->get();

        $paralelo = Paralelo::find($paralelo);
        $titulo = 'Total Estudiantes: ' . count($inscripcions);
        if ($filtro != 'todos') {
            if ($gestion != '' && $nivel != '' && $grado != '' && $paralelo != '' && $turno != '') {
                $titulo = 'Total Estudiantes gestión ' . $gestion . ' - ' . $grado . 'º ' . $paralelo->paralelo . ' de ' . $nivel . ' Turno ' . $turno;
                $inscripcions = inscripcion::where('gestion', $gestion)
                    ->where('nivel', $nivel)
                    ->where('grado', $grado)
                    ->where('paralelo_id', $paralelo->id)
                    ->where('turno', $turno)
                    ->where('status', 1)
                    ->get();
            }
        }

        $data = [
            ['ESTUDIANTES', count($inscripcions)]
        ];
        return response()->JSON([
            'sw' => true,
            'data' => $data,
            'titulo' => $titulo
        ]);
    }

    public function formulario(Inscripcion $inscripcion)
    {
        $pdf = PDF::loadView('inscripcions.formulario', compact('inscripcion'))->setPaper('legal', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Formulario.pdf');
    }
}
