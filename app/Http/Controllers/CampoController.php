<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\campo;
use App\Area;

class CampoController extends Controller
{
    public function index()
    {
        $campos = campo::all();
        return view('campos.index', compact('campos'));
    }

    public function create()
    {
        return view('campos.create');
    }

    public function store(Request $request)
    {
        campo::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('campos.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(campo $campo)
    {
        return view('campos.edit', compact('campo'));
    }

    public function update(campo $campo, Request $request)
    {
        $campo->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('campos.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(campo $campo)
    {
        return 'mostrar cargo';
    }

    public function destroy(campo $campo)
    {
        $comprueba = Area::where('campo_id', $campo->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('campos.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $campo->delete();
            return redirect()->route('campos.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
