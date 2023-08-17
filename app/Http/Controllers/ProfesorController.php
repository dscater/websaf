<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesor;
use App\Http\Controllers\UserController;
use App\Http\Requests\ProfesorStoreRequest;
use App\Http\Requests\ProfesorUpdateRequest;

use Illuminate\Support\Facades\Hash;
use App\ProfesorEstudio;
use App\ProfesorCurso;
use App\ProfesorOtro;
use App\ProfesorTrabajo;
use App\User;
use App\Asistencia;

class ProfesorController extends Controller
{
    public function index()
    {
        $usuarios = Profesor::select('profesors.*')
            ->where('profesors.estado', 1)
            ->get();
        return view('profesors.index', compact('usuarios'));
    }

    public function asistencias(Profesor $profesor, Request $request)
    {

        if ($request->ajax()) {
            $mes = $request->mes;
            $anio = $request->anio;
            $fecha = $anio . '-' . $mes . '-01';
            $array_dias = ['D', 'L', 'M', 'M', 'J', 'V', "S"];

            $dias = date('t', \strtotime($fecha));

            $header = '';
            $dias_html = '<tr>';
            for ($i = 1; $i <= $dias; $i++) {
                $nro_dia = $i;
                if ($nro_dia < 10) {
                    $nro_dia = '0' . $nro_dia;
                }
                $fecha_dia = $anio . '-' . $mes . '-' . $nro_dia;
                $txt_dia = date('w', strtotime($fecha_dia));

                $header .= '<th>' . $i . '<br>' . $array_dias[$txt_dia] . '</th>';
                if ($i < 10) {
                    $fecha = $anio . '-' . $mes . '-0' . $i;
                } else {
                    $fecha = $anio . '-' . $mes . '-' . $i;
                }

                $asistencia = Asistencia::where('user_id', $profesor->user->id)
                    ->where('fecha', $fecha)->get()->first();
                if ($asistencia) {
                    $dias_html .= '<td><i class="fa fa-check text-success"></i></td>';
                } else {
                    $dias_html .= '<td><i class="fa fa-times text-danger"></i></td>';
                }
            }
            $dias_html .= '</tr>';

            return response()->JSON([
                'sw' => true,
                'header' => $header,
                'dias' => $dias_html,
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

        return view('profesors.asistencias', compact('profesor', 'array_gestiones'));
    }

    public function create()
    {
        return view('profesors.create');
    }

    public function store(ProfesorStoreRequest $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $profesor = new Profesor(array_map('mb_strtoupper', $request->except('foto', 'estudio_nivel', 'estudio_institucion', 'estudio_anio', 'estudio_especialidad', 'estudio_nro_titulo', 'curso_nominacion', 'curso_institucion', 'curso_duracion', 'curso_fecha', 'otros_institucion', 'otros_turno', 'otros_zona', 'otros_cargo', 'otros_horas', 'trabajo_institucion', 'trabajo_gestion', 'trabajo_cargo')));
        $profesor->fecha_registro = date('Y-m-d');
        $profesor->foto = 'user_default.png';
        $profesor->estado = 1;
        $nombre_profesor = UserController::nombreUsuario($request->nombre, $request->paterno, $request->materno);

        // obtener el código incremental
        $ultimo_profesor = Profesor::select('profesors.*')
            ->join('users', 'users.id', '=', 'profesors.user_id')
            ->where('profesors.estado', 1)
            ->orderBy('users.id', 'ASC')
            ->get()->last();

        $nro_codigo = 200001;
        if ($ultimo_profesor) {
            $nro_codigo = (int)$ultimo_profesor->user->codigo +  1;
        }

        $nombre_profesor = $nombre_profesor . '' . $nro_codigo;

        $nuevo_usuario = new User();
        $nuevo_usuario->name = $nombre_profesor;
        $nuevo_usuario->password = Hash::make($request->ci);
        $nuevo_usuario->tipo = 'PROFESOR';
        $nuevo_usuario->foto = 'user_default.png';
        $nuevo_usuario->codigo = $nro_codigo;
        $nuevo_usuario->estado = 1;
        if ($request->hasFile('foto')) {
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $profesor->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/users/", $nom_foto);
            $nuevo_usuario->foto = $nom_foto;
            $profesor->foto = $nom_foto;
        }

        $nuevo_usuario->save();
        $profesor->user_id = $nuevo_usuario->id;
        $profesor->save();

        //registrar estudios, cursos, otros, trabajos
        $estudio_nivel = $request->estudio_nivel;
        $estudio_institucion = $request->estudio_institucion;
        $estudio_anio = $request->estudio_anio;
        $estudio_especialidad = $request->estudio_especialidad;
        $estudio_nro_titulo = $request->estudio_nro_titulo;
        for ($i = 0; $i < count($estudio_nivel); $i++) {
            $profesor_estudio = new ProfesorEstudio([
                'nivel' => $estudio_nivel[$i],
                'institucion' => mb_strtoupper($estudio_institucion[$i]),
                'anio_egreso' => mb_strtoupper($estudio_anio[$i]),
                'especialidad' => mb_strtoupper($estudio_especialidad[$i]),
                'nro_titulo' => mb_strtoupper($estudio_nro_titulo[$i]),
            ]);
            $profesor->estudios()->save($profesor_estudio);
        }

        $curso_nominacion = $request->curso_nominacion;
        $curso_institucion = $request->curso_institucion;
        $curso_duracion = $request->curso_duracion;
        $curso_fecha = $request->curso_fecha;
        for ($i = 0; $i < count($curso_nominacion); $i++) {
            $profesor_curso = new ProfesorCurso([
                'nominacion' => mb_strtoupper($curso_nominacion[$i]),
                'institucion' => mb_strtoupper($curso_institucion[$i]),
                'duracion' => mb_strtoupper($curso_duracion[$i]),
                'fecha' => mb_strtoupper($curso_fecha[$i]),
            ]);
            $profesor->cursos()->save($profesor_curso);
        }

        $otros_institucion = $request->otros_institucion;
        $otros_turno = $request->otros_turno;
        $otros_zona = $request->otros_zona;
        $otros_cargo = $request->otros_cargo;
        $otros_horas = $request->otros_horas;
        for ($i = 0; $i < count($otros_institucion); $i++) {
            $profesor_otros = new ProfesorOtro([
                'institucion' => mb_strtoupper($otros_institucion[$i]),
                'turno' => mb_strtoupper($otros_turno[$i]),
                'zona' => mb_strtoupper($otros_zona[$i]),
                'cargo' => mb_strtoupper($otros_cargo[$i]),
                'total_horas' => mb_strtoupper($otros_horas[$i]),
            ]);
            $profesor->otros()->save($profesor_otros);
        }

        $trabajo_institucion = $request->trabajo_institucion;
        $trabajo_gestion = $request->trabajo_gestion;
        $trabajo_cargo = $request->trabajo_cargo;
        for ($i = 0; $i < count($trabajo_institucion); $i++) {
            $profesor_trabajo = new ProfesorTrabajo([
                'institucion' => mb_strtoupper($trabajo_institucion[$i]),
                'gestion' => mb_strtoupper($trabajo_gestion[$i]),
                'cargo' => mb_strtoupper($trabajo_cargo[$i]),
            ]);
            $profesor->trabajos()->save($profesor_trabajo);
        }

        return redirect()->route('profesors.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Profesor $usuario)
    {
        return view('profesors.edit', compact('usuario'));
    }

    public function update(Profesor $usuario, ProfesorUpdateRequest $request)
    {
        $usuario->update(array_map('mb_strtoupper', $request->except('foto', 'estudio_nivel', 'estudio_institucion', 'estudio_anio', 'estudio_especialidad', 'estudio_nro_titulo', 'curso_nominacion', 'curso_institucion', 'curso_duracion', 'curso_fecha', 'otros_institucion', 'otros_turno', 'otros_zona', 'otros_cargo', 'otros_horas', 'trabajo_institucion', 'trabajo_gestion', 'trabajo_cargo')));

        if ($request->hasFile('foto')) {
            // antiguo
            $antiguo = $usuario->foto;
            if ($antiguo != 'user_default.png') {
                \File::delete(public_path() . '/imgs/users/' . $antiguo);
            }
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $usuario->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/users/", $nom_foto);
            $usuario->user->foto = $usuario->foto;
            $usuario->foto = $nom_foto;
        }

        $usuario->user->save();
        $usuario->save();

        //registrar estudios, cursos, otros, trabajos
        $estudio_nivel = $request->estudio_nivel;
        $estudio_institucion = $request->estudio_institucion;
        $estudio_anio = $request->estudio_anio;
        $estudio_especialidad = $request->estudio_especialidad;
        $estudio_nro_titulo = $request->estudio_nro_titulo;

        for ($i = 0; $i < count($estudio_nivel); $i++) {
            $usuario->estudios[$i]->nivel =  mb_strtoupper($estudio_nivel[$i]);
            $usuario->estudios[$i]->institucion = mb_strtoupper($estudio_institucion[$i]);
            $usuario->estudios[$i]->anio_egreso = mb_strtoupper($estudio_anio[$i]);
            $usuario->estudios[$i]->especialidad = mb_strtoupper($estudio_especialidad[$i]);
            $usuario->estudios[$i]->nro_titulo = mb_strtoupper($estudio_nro_titulo[$i]);
            $usuario->estudios[$i]->save();
        }

        $curso_nominacion = $request->curso_nominacion;
        $curso_institucion = $request->curso_institucion;
        $curso_duracion = $request->curso_duracion;
        $curso_fecha = $request->curso_fecha;
        for ($i = 0; $i < count($curso_nominacion); $i++) {
            $usuario->cursos[$i]->nominacion = mb_strtoupper($curso_nominacion[$i]);
            $usuario->cursos[$i]->institucion = mb_strtoupper($curso_institucion[$i]);
            $usuario->cursos[$i]->duracion = mb_strtoupper($curso_duracion[$i]);
            $usuario->cursos[$i]->fecha = mb_strtoupper($curso_fecha[$i]);
            $usuario->cursos[$i]->save();
        }

        $otros_institucion = $request->otros_institucion;
        $otros_turno = $request->otros_turno;
        $otros_zona = $request->otros_zona;
        $otros_cargo = $request->otros_cargo;
        $otros_horas = $request->otros_horas;
        for ($i = 0; $i < count($otros_institucion); $i++) {
            $usuario->otros[$i]->institucion = mb_strtoupper($otros_institucion[$i]);
            $usuario->otros[$i]->turno = mb_strtoupper($otros_turno[$i]);
            $usuario->otros[$i]->zona = mb_strtoupper($otros_zona[$i]);
            $usuario->otros[$i]->cargo = mb_strtoupper($otros_cargo[$i]);
            $usuario->otros[$i]->total_horas = mb_strtoupper($otros_horas[$i]);
            $usuario->otros[$i]->save();
        }

        $trabajo_institucion = $request->trabajo_institucion;
        $trabajo_gestion = $request->trabajo_gestion;
        $trabajo_cargo = $request->trabajo_cargo;
        for ($i = 0; $i < count($trabajo_institucion); $i++) {
            $usuario->trabajos[$i]->institucion = mb_strtoupper($trabajo_institucion[$i]);
            $usuario->trabajos[$i]->gestion = mb_strtoupper($trabajo_gestion[$i]);
            $usuario->trabajos[$i]->cargo = mb_strtoupper($trabajo_cargo[$i]);
            $usuario->trabajos[$i]->save();
        }
        return redirect()->route('profesors.index')->with('bien', 'Usuario modificado con éxito');
    }

    public function show(Profesor $usuario)
    {
        return 'mostrar usuario';
    }

    public function destroy(Profesor $usuario)
    {
        $usuario->estado = 0;
        $usuario->save();
        return redirect()->route('profesors.index')->with('bien', 'Registro eliminado correctamente');
    }
}
