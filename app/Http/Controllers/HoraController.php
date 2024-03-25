<?php

namespace App\Http\Controllers;

use App\Hora;
use App\Horario;
use App\Profesor;
use Illuminate\Http\Request;

class HoraController extends Controller
{
    public function index()
    {
        $horas = Hora::all();
        return view('horas.index', compact('horas'));
    }

    public function create()
    {
        $profesors = Profesor::select('profesors.*')
            ->where('profesors.estado', 1)
            ->get();
        $array_profesors[''] = '- Seleccione -';
        foreach ($profesors as $value) {
            $array_profesors[$value->id] = $value->paterno . ' ' . $value->materno . ' ' . $value->nombre;
        }
        return view('horas.create', compact('array_profesors'));
    }

    public function store(Request $request)
    {
        Hora::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('horas.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Hora $hora)
    {
        $profesors = Profesor::select('profesors.*')
            ->where('profesors.estado', 1)
            ->get();
        $array_profesors[''] = '- Seleccione -';
        foreach ($profesors as $value) {
            $array_profesors[$value->id] = $value->paterno . ' ' . $value->materno . ' ' . $value->nombre;
        }
        return view('horas.edit', compact('hora', 'array_profesors'));
    }

    public function update(Hora $hora, Request $request)
    {
        $hora->update(array_map('mb_strtoupper', $request->all()));
        $hora["recreo"] = isset($request->recreo) ? $request["recreo"] : null;
        $hora->save();
        return redirect()->route('horas.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Hora $hora)
    {
        return 'mostrar cargo';
    }

    public function destroy(Hora $hora)
    {
        $comprueba = Horario::where('hora_id', $hora->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('horas.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $hora->delete();
            return redirect()->route('horas.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
