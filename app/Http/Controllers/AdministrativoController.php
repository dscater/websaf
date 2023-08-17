<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Administrativo;
use App\Http\Controllers\UserController;
use App\Http\Requests\AdministrativoStoreRequest;
use App\Http\Requests\AdministrativoUpdateRequest;

use Illuminate\Support\Facades\Hash;
use App\AdministrativoEstudio;
use App\AdministrativoCurso;
use App\AdministrativoOtro;
use App\AdministrativoTrabajo;
use App\User;

class AdministrativoController extends Controller
{
    public function index()
    {
        $usuarios = Administrativo::select('administrativos.*')
            ->where('administrativos.estado', 1)
            ->get();
        return view('administrativos.index', compact('usuarios'));
    }

    public function create()
    {
        return view('administrativos.create');
    }

    public function store(AdministrativoStoreRequest $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $administrativo = new Administrativo(array_map('mb_strtoupper', $request->except('foto', 'estudio_nivel', 'estudio_institucion', 'estudio_anio', 'estudio_especialidad', 'estudio_nro_titulo', 'curso_nominacion', 'curso_institucion', 'curso_duracion', 'curso_fecha', 'otros_institucion', 'otros_turno', 'otros_zona', 'otros_cargo', 'otros_horas', 'trabajo_institucion', 'trabajo_gestion', 'trabajo_cargo')));
        $administrativo->fecha_registro = date('Y-m-d');
        $administrativo->foto = 'user_default.png';
        $administrativo->estado = 1;
        $nombre_administrativo = UserController::nombreUsuario($request->nombre, $request->paterno, $request->materno);

        // obtener el código incremental
        $ultimo_administrativo = Administrativo::select('administrativos.*')
            ->join('users', 'users.id', '=', 'administrativos.user_id')
            ->where('administrativos.estado', 1)
            ->orderBy('users.id', 'ASC')
            ->get()->last();

        $nro_codigo = 100001;
        if ($ultimo_administrativo) {
            $nro_codigo = (int)$ultimo_administrativo->user->codigo +  1;
        }

        $nombre_administrativo = $nombre_administrativo . '' . $nro_codigo;

        $nuevo_usuario = new User();
        $nuevo_usuario->name = $nombre_administrativo;
        $nuevo_usuario->password = Hash::make($request->ci);
        $nuevo_usuario->tipo = $request->tipo;
        $nuevo_usuario->foto = 'user_default.png';
        $nuevo_usuario->codigo = $nro_codigo;
        $nuevo_usuario->estado = 1;
        if ($request->hasFile('foto')) {
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $administrativo->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/users/", $nom_foto);
            $nuevo_usuario->foto = $nom_foto;
            $administrativo->foto = $nom_foto;
        }
        if ($request->tipo != 'NINGUNO') {
            $nuevo_usuario->save();
            $administrativo->user_id = $nuevo_usuario->id;
            $administrativo->save();
        } else {
            $administrativo->save();
        }

        //registrar estudios, cursos, otros, trabajos
        $estudio_nivel = $request->estudio_nivel;
        $estudio_institucion = $request->estudio_institucion;
        $estudio_anio = $request->estudio_anio;
        $estudio_especialidad = $request->estudio_especialidad;
        $estudio_nro_titulo = $request->estudio_nro_titulo;
        for ($i = 0; $i < count($estudio_nivel); $i++) {
            $administrativo_estudio = new AdministrativoEstudio([
                'nivel' => $estudio_nivel[$i],
                'institucion' => mb_strtoupper($estudio_institucion[$i]),
                'anio_egreso' => mb_strtoupper($estudio_anio[$i]),
                'especialidad' => mb_strtoupper($estudio_especialidad[$i]),
                'nro_titulo' => mb_strtoupper($estudio_nro_titulo[$i]),
            ]);
            $administrativo->estudios()->save($administrativo_estudio);
        }

        $curso_nominacion = $request->curso_nominacion;
        $curso_institucion = $request->curso_institucion;
        $curso_duracion = $request->curso_duracion;
        $curso_fecha = $request->curso_fecha;
        for ($i = 0; $i < count($curso_nominacion); $i++) {
            $administrativo_curso = new AdministrativoCurso([
                'nominacion' => mb_strtoupper($curso_nominacion[$i]),
                'institucion' => mb_strtoupper($curso_institucion[$i]),
                'duracion' => mb_strtoupper($curso_duracion[$i]),
                'fecha' => mb_strtoupper($curso_fecha[$i]),
            ]);
            $administrativo->cursos()->save($administrativo_curso);
        }

        $otros_institucion = $request->otros_institucion;
        $otros_turno = $request->otros_turno;
        $otros_zona = $request->otros_zona;
        $otros_cargo = $request->otros_cargo;
        $otros_horas = $request->otros_horas;
        for ($i = 0; $i < count($otros_institucion); $i++) {
            $administrativo_otros = new AdministrativoOtro([
                'institucion' => mb_strtoupper($otros_institucion[$i]),
                'turno' => mb_strtoupper($otros_turno[$i]),
                'zona' => mb_strtoupper($otros_zona[$i]),
                'cargo' => mb_strtoupper($otros_cargo[$i]),
                'total_horas' => mb_strtoupper($otros_horas[$i]),
            ]);
            $administrativo->otros()->save($administrativo_otros);
        }

        $trabajo_institucion = $request->trabajo_institucion;
        $trabajo_gestion = $request->trabajo_gestion;
        $trabajo_cargo = $request->trabajo_cargo;
        for ($i = 0; $i < count($trabajo_institucion); $i++) {
            $administrativo_trabajo = new AdministrativoTrabajo([
                'institucion' => mb_strtoupper($trabajo_institucion[$i]),
                'gestion' => mb_strtoupper($trabajo_gestion[$i]),
                'cargo' => mb_strtoupper($trabajo_cargo[$i]),
            ]);
            $administrativo->trabajos()->save($administrativo_trabajo);
        }

        return redirect()->route('administrativos.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Administrativo $usuario)
    {
        return view('administrativos.edit', compact('usuario'));
    }

    public function update(Administrativo $usuario, AdministrativoUpdateRequest $request)
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
            $usuario->foto = $nom_foto;
        }

        if ($request->tipo != 'NINGUNO') {
            if ($usuario->user) {
                $usuario->user->tipo = $request->tipo;
                $usuario->user->save();
            } else {
                // si se le asigna un usuario y no tiene crear uno  nuevo
                $nombre_administrativo = UserController::nombreUsuario($request->nombre, $request->paterno, $request->materno);
                // obtener el código incremental
                $ultimo_administrativo = Administrativo::select('administrativos.*')
                    ->join('users', 'users.id', '=', 'administrativos.user_id')
                    ->where('administrativos.estado', 1)
                    ->orderBy('users.id', 'ASC')
                    ->get()->last();

                $nro_codigo = 100001;
                if ($ultimo_administrativo) {
                    $nro_codigo = (int)$ultimo_administrativo->user->codigo +  1;
                }

                $nombre_administrativo = $nombre_administrativo . '' . $nro_codigo;
                $nuevo_usuario = new User();
                $nuevo_usuario->name = $nombre_administrativo;
                $nuevo_usuario->password = Hash::make($request->ci);
                $nuevo_usuario->tipo = $request->tipo;
                $nuevo_usuario->foto = $usuario->foto;
                $nuevo_usuario->codigo = $nro_codigo;
                $nuevo_usuario->estado = 1;
                $nuevo_usuario->save();
                $usuario->user_id = $nuevo_usuario->id;
                $usuario->save();
            }
        } else {
            if ($usuario->user) {
                // si tiene un usuario, pero se le puso NINGUNO eliminarlo
                $usuario->user_id = null;
                $usuario->save();
                $usuario->user->delete();
            }
            $usuario->save();
        }

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
        return redirect()->route('administrativos.index')->with('bien', 'Usuario modificado con éxito');
    }

    public function show(Administrativo $usuario)
    {
        return 'mostrar usuario';
    }

    public function destroy(Administrativo $usuario)
    {
        $usuario->estado = 0;
        $usuario->save();
        return redirect()->route('administrativos.index')->with('bien', 'Registro eliminado correctamente');
    }
}
