<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\paralelo;
use App\Inscripcion;

class ParaleloController extends Controller
{
    public function index()
    {
        $paralelos = paralelo::all();
        return view('paralelos.index', compact('paralelos'));
    }

    public function create()
    {
        return view('paralelos.create');
    }

    public function store(Request $request)
    {
        paralelo::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('paralelos.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(paralelo $paralelo)
    {
        return view('paralelos.edit', compact('paralelo'));
    }

    public function update(paralelo $paralelo, Request $request)
    {
        $paralelo->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('paralelos.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(paralelo $paralelo)
    {
        return 'mostrar cargo';
    }

    public function destroy(paralelo $paralelo)
    {
        $comprueba = Inscripcion::where('paralelo_id', $paralelo->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('paralelos.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $paralelo->delete();
            return redirect()->route('paralelos.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
