<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Administrativo;
use App\Profesor;
use App\User;
use App\Paralelo;
use App\Estudiante;
use App\Inscripcion;
use App\Calificacion;
use App\CalificacionTrimestre;
use App\Campo;
use App\Area;
use App\Materia;
use App\MateriaGrado;
use App\TrimestreActividad;
use App\ProfesorMateria;
use App\PagoEstudiante;
use App\Asistencia;
use App\InscripcionMateria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReporteController extends Controller
{
    public function index()
    {
        $usuarios = Administrativo::select('administrativos.*')
            ->join('users', 'users.id', '=', 'administrativos.user_id')
            ->where('users.estado', 1)
            ->get();

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

        $administrativos = Administrativo::select('administrativos.*')
            ->where('administrativos.user_id', NULL)
            ->where('administrativos.estado', 1)
            ->get();

        $profesors = Profesor::select('profesors.*')
            ->where('profesors.estado', 1)
            ->get();

        $array_personal = [];
        foreach ($administrativos as $value) {
            $array_personal[$value->id . '-a'] = $value->paterno . ' ' . $value->materno . ' ' . $value->nombre;
        }

        foreach ($profesors as $value) {
            $array_personal[$value->id . '-p'] = $value->paterno . ' ' . $value->materno . ' ' . $value->nombre;
        }

        $array_profesors['todos'] = 'Todos';
        foreach ($profesors as $value) {
            $array_profesors[$value->id] = $value->paterno . ' ' . $value->materno . ' ' . $value->nombre;
        }

        $paralelos = paralelo::all();
        $array_paralelos[''] = 'Seleccione...';
        foreach ($paralelos as $value) {
            $array_paralelos[$value->id] = $value->paralelo;
        }

        $estudiantes = Estudiante::select('estudiantes.*')
            ->where('estudiantes.estado', 1)
            ->get();

        $array_estudiantes[''] = 'Seleccione...';
        foreach ($estudiantes as $value) {
            $array_estudiantes[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }
        $array_estudiantes2[''] = 'Seleccione...';
        foreach ($estudiantes as $value) {
            $array_estudiantes2[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno . ' | ' . $value->nro_doc;
        }

        $gestion_min = Inscripcion::min('gestion');
        $gestion_max = Inscripcion::max('gestion');

        $array_gestiones_insc = [];
        if ($gestion_min) {
            $array_gestiones_insc[''] = 'Seleccione...';
            for ($i = (int)$gestion_min; $i <= (int)$gestion_max; $i++) {
                $array_gestiones_insc[$i] = $i;
            }
        }

        return view('reportes.index', compact('usuarios', 'array_gestiones', 'array_gestiones_insc', 'array_personal', 'array_paralelos', 'array_estudiantes', 'array_estudiantes2', 'array_profesors'));
    }

    public function usuarios(Request $request)
    {
        $filtro = $request->filtro;
        $tipo = $request->tipo;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $usuarios = Administrativo::select('administrativos.*', 'users.id as user_id', 'users.name as usuario', 'users.foto', 'users.tipo')
            ->join('users', 'users.id', '=', 'administrativos.user_id')
            ->where('users.estado', 1)
            ->whereIn('users.tipo', ['ADMINISTRADOR', 'SECRETARIA ACADÉMICA'])
            ->orderBy('administrativos.nombre', 'ASC')
            ->get();

        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'tipo':
                    if ($tipo != 'todos') {
                        $usuarios = Administrativo::select('administrativos.*', 'users.id as user_id', 'users.name as usuario', 'users.foto', 'users.tipo')
                            ->join('users', 'users.id', '=', 'administrativos.user_id')
                            ->where('users.estado', 1)
                            ->where('users.tipo', $tipo)
                            ->orderBy('administrativos.nombre', 'ASC')
                            ->get();
                    }
                    break;
            }
        }

        $pdf = PDF::loadView('reportes.usuarios', compact('usuarios'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Usuarios.pdf');
    }

    public function personal(Request $request)
    {
        $filtro = $request->filtro;
        $gestion = $request->gestion;

        $administrativos = Administrativo::select('administrativos.*')
            ->where('administrativos.estado', 1)
            ->where('administrativos.user_id', NULL)
            ->orderBy('administrativos.nombre', 'ASC')
            ->get();

        $profesors = Profesor::select('profesors.*', 'users.id as user_id', 'users.name as usuario', 'users.foto', 'users.tipo')
            ->join('users', 'users.id', '=', 'profesors.user_id')
            ->where('users.estado', 1)
            ->orderBy('profesors.nombre', 'ASC')
            ->get();
        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'administrativos':
                    $profesors = [];
                    break;
                case 'profesores':
                    $administrativos = [];
                    break;
                case 'gestion':
                    $administrativos = Administrativo::select('administrativos.*')
                        ->where('administrativos.estado', 1)
                        ->where('administrativos.user_id', NULL)
                        ->where('administrativos.fecha_registro', 'LIKE', "%$gestion%")
                        ->orderBy('administrativos.nombre', 'ASC')
                        ->get();

                    $profesors = Profesor::select('profesors.*', 'users.id as user_id', 'users.name as usuario', 'users.foto', 'users.tipo')
                        ->join('users', 'users.id', '=', 'profesors.user_id')
                        ->where('users.estado', 1)
                        ->where('profesors.fecha_registro', 'LIKE', "$gestion%")
                        ->orderBy('profesors.nombre', 'ASC')
                        ->get();
                    break;
            }
        }

        $pdf = PDF::loadView('reportes.personal', compact('administrativos', 'profesors', 'filtro', 'gestion'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Personal.pdf');
    }

    public function kardex_personal(Request $request)
    {
        $filtro = $request->filtro;
        $gestion = $request->gestion;
        $personal = $request->personal;

        $administrativos = Administrativo::select('administrativos.*')
            ->where('administrativos.estado', 1)
            ->where('administrativos.user_id', NULL)
            ->orderBy('administrativos.nombre', 'ASC')
            ->get();

        $profesors = Profesor::select('profesors.*', 'users.id as user_id', 'users.name as usuario', 'users.foto', 'users.tipo')
            ->join('users', 'users.id', '=', 'profesors.user_id')
            ->where('profesors.estado', 1)
            ->orderBy('profesors.nombre', 'ASC')
            ->get();
        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'administrativos':
                    $profesors = [];
                    break;
                case 'profesores':
                    $administrativos = [];
                    break;
                case 'individual':
                    $a_p = \explode('-', $personal);
                    if ($a_p[1] == 'a') {
                        $administrativos = Administrativo::select('administrativos.*')
                            ->where('administrativos.id', $a_p[0])
                            ->where('administrativos.estado', 1)
                            ->where('administrativos.user_id', NULL)
                            ->orderBy('administrativos.nombre', 'ASC')
                            ->get();
                        $profesors = [];
                    } else {
                        $profesors = Profesor::select('profesors.*', 'users.id as user_id', 'users.name as usuario', 'users.foto', 'users.tipo')
                            ->join('users', 'users.id', '=', 'profesors.user_id')
                            ->where('profesors.id', $a_p[0])
                            ->where('profesors.estado', 1)
                            ->orderBy('profesors.nombre', 'ASC')
                            ->get();
                        $administrativos = [];
                    }
                    break;
            }
        }

        $array_meses = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];

        $pdf = PDF::loadView('reportes.kardex_personal', compact('administrativos', 'profesors', 'filtro', 'array_meses'))->setPaper('legal', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('kardex_persoanl.pdf');
    }

    public function boleta_calificaciones(Request $request)
    {
        $filtro = $request->filtro;
        $estudiante = $request->estudiante;
        $nivel = $request->nivel;
        $grado = $request->grado;
        $paralelo = $request->paralelo;
        $turno = $request->turno;
        $gestion = $request->gestion;
        $trimestre = $request->trimestre;

        $inscripcions = Inscripcion::where('nivel', $nivel)
            ->where('grado', $grado)
            ->where('paralelo_id', $paralelo)
            ->where('turno', $turno)
            ->where('gestion', $gestion)
            ->where('status', 1)
            ->get();

        if ($filtro != 'todos') {
            $inscripcions = Inscripcion::where('nivel', $nivel)
                ->where('grado', $grado)
                ->where('paralelo_id', $paralelo)
                ->where('turno', $turno)
                ->where('gestion', $gestion)
                ->where('estudiante_id', $estudiante)
                ->where('status', 1)
                ->get();
        }


        // BUSCAR LOS CAMPOS/AREAS CON LAS MATERIAS CORRESPODIENTES
        $campos = DB::select("SELECT DISTINCT c.id as id FROM campos c JOIN areas a ON a.campo_id = c.id
            JOIN materias m ON m.area_id = a.id
            JOIN materia_grados mg ON mg.materia_id=m.id
            WHERE m.nivel = '$nivel'
            AND mg.grado = $grado");
        $array_campos = [];
        foreach ($campos as $value) {
            $array_campos[] = $value->id;
        }

        $campos = Campo::whereIn('id', $array_campos)->get();

        $html = '';
        $array_html = [];
        foreach ($inscripcions as $inscripcion) {
            $contador_notas = 0;
            $suma_total = 0;
            $html = '';
            $sw_bg = 1;
            foreach ($campos as $campo) {
                $html .= '<div class="campo">';
                $html .= '<div class="titulo">' . $campo->nombre . '</div>';
                $html .= '<div class="contenedor_areas">';

                $areas = DB::select("SELECT DISTINCT a.id FROM areas a 
                JOIN materias m ON m.area_id = a.id
                JOIN materia_grados mg ON mg.materia_id=m.id
                WHERE m.nivel = '$nivel'
                AND mg.grado = $grado");
                $array_areas = [];
                foreach ($areas as $value) {
                    $array_areas[] = $value->id;
                }
                $areas = Area::whereIn('id', $array_areas)
                    ->where('campo_id', $campo->id)
                    ->get();

                foreach ($areas as $area) {
                    $materias = Materia::select('materias.*')
                        ->join('materia_grados', 'materia_grados.materia_id', '=', 'materias.id')
                        ->join('areas', 'areas.id', '=', 'materias.area_id')
                        ->where('areas.tipo', 'HUMANÍSTICA')
                        ->where('materias.area_id', $area->id)
                        ->where('materias.nivel', $nivel)
                        ->where('materia_grados.grado', $grado)
                        ->get();

                    $heigth = '';
                    if (count($materias) <= 1) {
                        $heigth = '';
                    }

                    foreach ($materias as $materia) {

                        if ($trimestre != 'a') {
                            $sw = 't';
                        } else {
                            $sw = 'a';
                        }

                        $html .= '<div class="area color' . $sw_bg . '">
                                    <div class="titulo">' . $materia->nombre . '</div>
                                    <div class="contenedor_notas">';

                        if ($sw == 'a') {
                            // OBTENER LAS NOTA FINAL DE LA MATERIA
                            $calificacion = Calificacion::where('inscripcion_id', $inscripcion->id)
                                ->where('materia_id', $materia->id)
                                ->get()->first();

                            if (!$calificacion) {
                                // registrar la materia en la inscripción
                                $calificacion = Calificacion::create([
                                    'inscripcion_id' => $inscripcion->id,
                                    'materia_id' => $materia->id,
                                    'nota_final' => 0,
                                    'estado' => "REPROBADO",
                                    "fecha_registro" => date("Y-m-d")
                                ]);

                                //Registrar los Trimestres Por Materia
                                for ($i = 1; $i <= 3; $i++) {
                                    $calificacion_trimestre = CalificacionTrimestre::create([
                                        'calificacion_id' => $calificacion->id,
                                        'trimestre' => $i,
                                        "promedio_final" => 0,
                                    ]);

                                    // Registrar las Areas(5) y sus 6 actividades
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

                            $html .= '<div class="nota">' . $calificacion->nota_final . '</div>';
                            $html .= '</div>'; //fin contenedor_notas
                            $html .= '<div class="contenedor_notas">';
                            $html .= '<div class="nota">' . $calificacion->estado . '</div>';
                            $html .= '</div>'; //fin contenedor_notas';
                        } else {
                            // OBTENER LAS NOTAS DE UN TRIMESTRE
                            $calificacion = CalificacionTrimestre::select('calificacion_trimestres.*')
                                ->join('calificacions', 'calificacions.id', '=', 'calificacion_trimestres.calificacion_id')
                                ->where('calificacions.inscripcion_id', $inscripcion->id)
                                ->where('calificacions.materia_id', $materia->id)
                                ->where('calificacion_trimestres.trimestre', $trimestre)
                                ->get()->first();

                            // Log::debug("inscripcion: " . $inscripcion->id);
                            // Log::debug("materia: " . $materia->nombre);
                            // Log::debug("materia: " . $materia->id);
                            // Log::debug("trimestre: " . $trimestre);
                            // Log::debug((string)$calificacion);
                            if (!$calificacion) {
                                // registrar la materia en la inscripción
                                $nueva_calificacion = Calificacion::create([
                                    'inscripcion_id' => $inscripcion->id,
                                    'materia_id' => $materia->id,
                                    'nota_final' => 0,
                                    'estado' => "REPROBADO",
                                    "fecha_registro" => date("Y-m-d")
                                ]);

                                //Registrar los Trimestres Por Materia
                                $calificacion = CalificacionTrimestre::create([
                                    'calificacion_id' => $nueva_calificacion->id,
                                    'trimestre' => $trimestre,
                                    "promedio_final" => 0,
                                ]);

                                // Registrar las Areas(5) y sus 6 actividades
                                for ($j = 1; $j <= 5; $j++) {
                                    TrimestreActividad::create([
                                        'ct_id' => $calificacion->id,
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
                            $html .= '<div class="nota">' . $calificacion->promedio_final . '</div>';
                            $suma_total += (int)$calificacion->promedio_final;
                            $html .= '</div>'; //fin contenedor_notas
                            $html .= '<div class="contenedor_notas">';
                            if ($calificacion->promedio_final < 51) {
                                $html .= '<div class="nota">REPROBADO</div>';
                            } else {
                                $html .= '<div class="nota">APROBADO</div>';
                            }

                            $html .= '</div>'; //fin contenedor_notas';
                        }

                        $html .= '</div>'; //fin area
                        $contador_notas++;
                    }
                }
                $html .= '</div>'; // fin contenedor areas
                if ($sw_bg == 1) {
                    $sw_bg = 2;
                } else {
                    $sw_bg = 1;
                }
                $html .= '</div>'; // fin campo
            }
            $suma_total = $suma_total / $contador_notas;
            $suma_total = (int)$suma_total;

            $observacion_promedio = 'APROBADO';
            if ($suma_total < 51) {
                $observacion_promedio = 'REPROBADO';
            }
            $html .= '<div class="campo">
                            <div class="titulo"></div><div class="contenedor_areas"><div class="area" >
            <div class="titulo">PROMEDIO</div>
            <div class="contenedor_notas"><div class="nota">' . $suma_total . '</div></div><div class="contenedor_notas"><div class="nota">' . $observacion_promedio . '</div></div></div></div></div>';

            $html .= '</div>';

            $array_html[$inscripcion->id] = $html;
        }

        $array_trimestre = [
            '1' => '1er Trimestre',
            '2' => '2do Trimestre',
            '3' => '3er Trimestre',
            'a' => 'Anual'
        ];

        $titulo = 'Boletín de Nota ' . $array_trimestre[$trimestre];

        return View('reportes.boleta_calificaciones', compact('inscripcions', 'array_trimestre', 'trimestre', 'html', 'titulo', 'gestion', 'array_html'));
    }

    public function centralizador_calificacions(Request $request)
    {
        $nivel = $request->nivel;
        $grado = $request->grado;
        $paralelo = $request->paralelo;
        $turno = $request->turno;
        $gestion = $request->gestion;

        $array_grados = [
            '1' => 'PRIMERO',
            '2' => 'SEGUNDO',
            '3' => 'TERCERO',
            '4' => 'CUARTO',
            '5' => 'QUINTO',
            '6' => 'SEXTO',
        ];

        $filas_grados = [];
        $filas_grados = [1, 2, 3, 4, 5, 6];
        if ($grado != 'todos') {
            $filas_grados = [$grado];
        }

        // BUSCAR LOS ESTUDIANTES
        $inscripcions = [];
        $calificacions = [];
        $observacions = [];
        $array_materias = [];

        foreach ($filas_grados as $fg) {

            $materias = MateriaGrado::select('materia_grados.*')
                ->join('materias', 'materias.id', '=', 'materia_grados.materia_id')
                ->where('materias.nivel', $nivel)
                ->where('materia_grados.grado', $fg)
                ->get();

            $array_materias[$fg] = $materias;
            $inscripcions[$fg] = Inscripcion::where('nivel', $nivel)
                ->where('grado', $fg)
                ->where('paralelo_id', $paralelo)
                ->where('turno', $turno)
                ->where('gestion', $gestion)
                ->get();

            foreach ($inscripcions[$fg] as $inscripcion) {
                $suma_notas = 0;
                $cont = 0;
                foreach ($materias as $materia) {
                    $calificacion = Calificacion::where('inscripcion_id', $inscripcion->id)
                        ->where('materia_id', $materia->materia_id)
                        ->get()
                        ->first();

                    if (!$calificacion) {
                        // registrar la materia en la inscripción
                        $calificacion = Calificacion::create([
                            'inscripcion_id' => $inscripcion->id,
                            'materia_id' => $materia->materia_id,
                            'nota_final' => 0,
                            'estado' => "REPROBADO",
                            "fecha_registro" => date("Y-m-d")
                        ]);

                        //Registrar los Trimestres Por Materia
                        for ($i = 1; $i <= 3; $i++) {
                            $calificacion_trimestre = CalificacionTrimestre::create([
                                'calificacion_id' => $calificacion->id,
                                'trimestre' => $i,
                                "promedio_final" => 0,
                            ]);

                            // Registrar las Areas(5) y sus 6 actividades
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
                    $suma_notas += (int)$calificacion->nota_final;
                    $calificacions[$fg][$inscripcion->id][$materia->materia_id] = [
                        'nota' => $calificacion->nota_final,
                    ];
                    $cont++;
                }
                if ($cont > 0) {
                    $suma_notas = $suma_notas / $cont;
                    $suma_notas = (int)$suma_notas;
                }
                $observacions[$fg][$inscripcion->id] = 'APROBADO';
                if ($suma_notas < 51) {
                    $observacions[$fg][$inscripcion->id] = 'REPROBADO';
                }
            }
        }
        $paralelo = Paralelo::find($paralelo)->paralelo;
        $pdf = PDF::loadView('reportes.centralizador_calificacions', compact('filas_grados', 'nivel', 'paralelo', 'turno', 'gestion', 'array_grados', 'calificacions', 'inscripcions', 'observacions', 'array_materias'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('CentralizadorCalificacions.pdf');
    }

    public function historial_academico(Request $request)
    {
        $estudiante = $request->estudiante;
        $nivel = $request->nivel;
        $grado = $request->grado;
        $paralelo = $request->paralelo;
        $turno = $request->turno;
        $gestion = $request->gestion;

        $estudiante = Estudiante::find($estudiante);

        $inscripcion = Inscripcion::where('estudiante_id', $estudiante->id)
            ->where('nivel', $nivel)
            ->where('grado', $grado)
            ->where('paralelo_id', $paralelo)
            ->where('turno', $turno)
            ->where('gestion', $gestion)
            ->where('status', 1)
            ->get()
            ->first();

        $calificacions = [];
        if ($inscripcion) {
            $calificacions = Calificacion::where('inscripcion_id', $inscripcion->id)->get();
        }

        $trimestres = [1, 2, 3];
        $areas = [1, 2, 3, 4, 5];

        $info_calificaciones = [];

        foreach ($calificacions as $calificacion) {
            $suma_area = 0;
            $info_calificaciones[$calificacion->id] = [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                'p' => 0,
                'o' => 'REPROBADO'
            ];
            // Log::debug((string)$calificacion);
            foreach ($trimestres as $trimestre) {
                $calificacion_trimestre = CalificacionTrimestre::where('calificacion_id', $calificacion->id)
                    ->where('trimestre', $trimestre)
                    ->get()
                    ->first();

                if (!$calificacion_trimestre) {
                    //Registrar los Trimestres Por Materia
                    $calificacion_trimestre = CalificacionTrimestre::create([
                        'calificacion_id' => $calificacion->id,
                        'trimestre' => $trimestre
                    ]);

                    // Registrar las Areas(5) y sus 6 actividades
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
                $suma_promedio_area = 0;
                foreach ($areas as $area) {
                    $actividad = TrimestreActividad::where('ct_id', $calificacion_trimestre->id)
                        ->where('area', $area)->get()->first();

                    if (!$actividad) {
                        $actividad = TrimestreActividad::create([
                            'ct_id' => $calificacion_trimestre->id,
                            'area' => $area,
                            'a1' => 0,
                            'a2' => 0,
                            'a3' => 0,
                            'a4' => 0,
                            'a5' => 0,
                            'a6' => 0,
                            'promedio' => 0
                        ]);
                    }
                    $info_calificaciones[$calificacion->id][$area] += $actividad->promedio;
                }
            }
            // establecer promedios
            foreach ($areas as $area) {
                $info_calificaciones[$calificacion->id][$area] = (int)((int)$info_calificaciones[$calificacion->id][$area] / 3);
            }
            $suma_inicial = (int)(((int)$info_calificaciones[$calificacion->id][1] + (int)$info_calificaciones[$calificacion->id][2] + (int)$info_calificaciones[$calificacion->id][3] + (int)$info_calificaciones[$calificacion->id][4]) + (int)$info_calificaciones[$calificacion->id][5]);

            if ($suma_inicial < (int)$calificacion->nota_final) {
                $diff = (int)$calificacion->nota_final - $suma_inicial;
                if ((int)$info_calificaciones[$calificacion->id][5] + $diff <= 10) {
                    (int)$info_calificaciones[$calificacion->id][5] = (int)$info_calificaciones[$calificacion->id][5] + $diff;
                } elseif ((int)$info_calificaciones[$calificacion->id][4] + $diff <= 10) {
                    (int)$info_calificaciones[$calificacion->id][4] = (int)$info_calificaciones[$calificacion->id][4] + $diff;
                } elseif ((int)$info_calificaciones[$calificacion->id][3] + $diff <= 35) {
                    (int)$info_calificaciones[$calificacion->id][3] = (int)$info_calificaciones[$calificacion->id][3] + $diff;
                } elseif ((int)$info_calificaciones[$calificacion->id][2] + $diff <= 35) {
                    (int)$info_calificaciones[$calificacion->id][2] = (int)$info_calificaciones[$calificacion->id][2] + $diff;
                } elseif ((int)$info_calificaciones[$calificacion->id][1] + $diff <= 10) {
                    (int)$info_calificaciones[$calificacion->id][1] = (int)$info_calificaciones[$calificacion->id][1] + $diff;
                }
            }

            $info_calificaciones[$calificacion->id]['p'] = (int)$calificacion->nota_final;

            $info_calificaciones[$calificacion->id]['o'] = 'APROBADO';
            if ((int)$info_calificaciones[$calificacion->id]['p'] < 51) {
                $info_calificaciones[$calificacion->id]['o'] = 'REPROBADO';
            }
        }

        $paralelo = Paralelo::find($paralelo)->paralelo;
        $pdf = PDF::loadView('reportes.historial_academico', compact('estudiante', 'inscripcion', 'calificacions', 'nivel', 'grado', 'paralelo', 'turno', 'gestion', 'info_calificaciones'))->setPaper('A4', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('HistorialAcademico.pdf');
    }

    public function asignacion_materias(Request $request)
    {
        $profesor = $request->profesor;
        $gestion = $request->gestion;

        $asignacions = [];

        $profesors = Profesor::select('profesors.*')
            ->where('profesors.estado', 1)
            ->get();
        if ($profesor != 'todos') {
            $profesors = Profesor::select('profesors.*')
                ->where('profesors.id', $profesor)
                ->where('profesors.estado', 1)
                ->get();
        }

        foreach ($profesors as $p) {
            $asignacions[$p->id] = ProfesorMateria::where('profesor_id', $p->id)
                ->where('gestion', $gestion)
                ->get();
        }

        $pdf = PDF::loadView('reportes.asignacion_materias', compact('profesors', 'asignacions'))->setPaper('A4', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('AsignacionMaterias.pdf');
    }

    public function pagos_estudiantes(Request $request)
    {
        $estudiante = $request->estudiante;
        $gestion = $request->gestion;

        $estudiante = Estudiante::find($estudiante);
        $pagos = PagoEstudiante::where('estudiante_id', $estudiante->id)
            ->where('gestion', $gestion)
            ->where('estado', 1)
            ->orderBy('fecha_registro', 'desc')
            ->get();

        $pdf = PDF::loadView('reportes.pagos_estudiantes', compact('estudiante', 'gestion', 'pagos'))->setPaper('A4', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('PagosEstudiantes.pdf');
    }

    public function ingresos_economicos(Request $request)
    {
        $filtro = $request->filtro;
        $concepto = $request->concepto;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $pagos = PagoEstudiante::where('estado', 1)
            ->orderBy('fecha_registro', 'desc')
            ->get();
        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'concepto':
                    if ($concepto != 'todos') {
                        $pagos = PagoEstudiante::where('concepto', $concepto)
                            ->where('estado', 1)
                            ->orderBy('fecha_registro', 'desc')
                            ->get();
                    }
                    break;
                case 'fecha':
                    $pagos = PagoEstudiante::whereBetween('fecha_registro', [$fecha_ini, $fecha_fin])
                        ->where('estado', 1)
                        ->orderBy('fecha_registro', 'desc')
                        ->get();
                    break;
            }
        }

        $pdf = PDF::loadView('reportes.ingresos_economicos', compact('pagos'))->setPaper('A4', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('ingresos_economicos.pdf');
    }

    public function asistencias(Request $request)
    {
        $mes = $request->mes;
        $anio = $request->anio;
        $array_dias = ['D', 'L', 'M', 'M', 'J', 'V', "S"];
        $fecha = $anio . '-' . $mes . '-01';
        $dias = date('t', \strtotime($fecha));

        $estudiantes = Estudiante::select('estudiantes.*')
            ->where('estudiantes.estado', 1)
            ->get();

        $header = '<th>Estudiante</th>';
        for ($i = 1; $i <= $dias; $i++) {
            $nro_dia = $i;
            if ($nro_dia < 10) {
                $nro_dia = '0' . $nro_dia;
            }
            $fecha_dia = $anio . '-' . $mes . '-' . $nro_dia;
            $txt_dia = date('w', strtotime($fecha_dia));
            $header .= '<th width="2.5%">' . $i . '<br>' . $array_dias[$txt_dia] . '</th>';
        }

        $fila_html = '';
        foreach ($estudiantes as $estudiante) {
            $fila_html .= '<tr>';
            $fila_html .= '<td>' . $estudiante->nombre . ' ' . $estudiante->paterno . ' ' . $estudiante->materno . '
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
                    $fila_html .= '<td class="txt_center"><span class="verde">A</span></td>';
                } else {
                    $fila_html .= '<td class="txt_center"><span class="rojo">F</span></td>';
                }
            }
            $fila_html .= '</tr>';
        }

        $array_meses = [
            '01' => 'ENERO',
            '02' => 'FEBRERO',
            '03' => 'MARZO',
            '04' => 'ABRIL',
            '05' => 'MAYO',
            '06' => 'JUNIO',
            '07' => 'JULIO',
            '08' => 'AGOSTO',
            '09' => 'SETPTIMEBRE',
            '10' => 'OCTUBRE',
            '11' => 'NOVIEMBRE',
            '12' => 'DICIEMBRE',
        ];

        $pdf = PDF::loadView('reportes.asistencias', compact('header', 'fila_html', 'mes', 'anio', 'array_meses'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('asistencias.pdf');
    }

    public function historial_asistencia(Request $request)
    {
        $anio = $request->anio;
        $estudiante = $request->estudiante;
        $estudiantes = Estudiante::select('estudiantes.*')
            ->where('estudiantes.id', $estudiante)
            ->where('estudiantes.estado', 1)
            ->get();

        $historial_estudiante = [];
        foreach ($estudiantes as $e) {
            $asistencias = Asistencia::where("user_id", $e->user_id)
                ->where("fecha", "LIKE", "$anio%")->orderBy("created_at", "asc")->get();
            $historial_estudiante[$e->id] = $asistencias;
        }

        $pdf = PDF::loadView('reportes.historial_asistencia', compact('estudiantes', 'historial_estudiante', 'anio'))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('historial_asistencias.pdf');
    }
}
