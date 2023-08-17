<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\area;
use App\Campo;
use App\Materia;

class AreaController extends Controller
{
    public function index()
    {
        $areas = area::all();
        return view('areas.index', compact('areas'));
    }

    public function create()
    {
        $campos = campo::all();
        $array_campos[''] = 'Seleccione...';
        foreach ($campos as $value) {
            $array_campos[$value->id] = $value->nombre;
        }

        return view('areas.create', compact('array_campos'));
    }

    public function store(Request $request)
    {
        area::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('areas.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(area $area)
    {
        $campos = campo::all();
        $array_campos[''] = 'Seleccione...';
        foreach ($campos as $value) {
            $array_campos[$value->id] = $value->nombre;
        }
        return view('areas.edit', compact('area', 'array_campos'));
    }

    public function update(area $area, Request $request)
    {
        $area->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('areas.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(area $area)
    {
        return 'mostrar cargo';
    }

    public function destroy(area $area)
    {
        $comprueba = Materia::where('area_id', $area->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('areas.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $area->delete();
            return redirect()->route('areas.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
