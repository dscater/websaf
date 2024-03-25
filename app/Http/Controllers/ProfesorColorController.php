<?php

namespace App\Http\Controllers;

use App\Horario;
use App\Profesor;
use App\ProfesorColor;
use Illuminate\Http\Request;

class ProfesorColorController extends Controller
{
    public function index()
    {
        $profesor_colors = ProfesorColor::all();
        return view('profesor_colors.index', compact('profesor_colors'));
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
        return view('profesor_colors.create', compact('array_profesors'));
    }

    public function store(Request $request)
    {
        $existe = ProfesorColor::where("profesor_id", $request->profesor_id)->get()->first();
        if ($existe) {
            $existe->update(array_map('mb_strtoupper', $request->all()));
        } else {
            ProfesorColor::create(array_map('mb_strtoupper', $request->all()));
        }
        return redirect()->route('profesor_colors.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(ProfesorColor $profesor_color)
    {
        $profesors = Profesor::select('profesors.*')
            ->where('profesors.estado', 1)
            ->get();
        $array_profesors[''] = '- Seleccione -';
        foreach ($profesors as $value) {
            $array_profesors[$value->id] = $value->paterno . ' ' . $value->materno . ' ' . $value->nombre;
        }
        return view('profesor_colors.edit', compact('profesor_color', 'array_profesors'));
    }

    public function update(ProfesorColor $profesor_color, Request $request)
    {
        $profesor_color->update(array_map('mb_strtoupper', $request->all()));

        if (count($profesor_color->profesor->horarios) > 0) {
            $profesor_color->profesor->horarios()->update([
                "color" => $profesor_color->color
            ]);
        }

        return redirect()->route('profesor_colors.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(ProfesorColor $profesor_color)
    {
        return 'mostrar cargo';
    }

    public function destroy(ProfesorColor $profesor_color)
    {
        $profesor_color->delete();
        return redirect()->route('profesor_colors.index')->with('bien', 'Registro eliminado correctamente');
    }
}
