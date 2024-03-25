<?php

namespace App\Http\Controllers;

use App\Inscripcion;
use App\KardexDesempeno;
use App\ProfesorMateria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KardexDesempenoController extends Controller
{
    public function index(Request $request)
    {
        $gestion_min = ProfesorMateria::min('gestion');
        $gestion_max = ProfesorMateria::max('gestion');

        $array_gestiones = [];
        if ($gestion_min) {
            $array_gestiones[''] = 'Seleccione...';
            for ($i = (int)$gestion_min; $i <= (int)$gestion_max; $i++) {
                $array_gestiones[$i] = $i;
            }
        }

        return view('kardex_desempenos.index', compact('array_gestiones'));
    }

    public function getInscripcionsKardex()
    {
        $kardex_desempenos = [];
        if (Auth::user()->tipo == 'PROFESOR' && Auth::user()->profesor) {
            $kardex_desempenos = KardexDesempeno::all();
        }

        $html = view();

        return response()->JSON([]);
    }

    public function create(ProfesorMateria $profesor_materia, Inscripcion $inscripcion)
    {
        return view('kardex_desempenos.create', compact("profesor_materia", "inscripcion"));
    }

    public function store(Request $request, ProfesorMateria $profesor_materia, Inscripcion $inscripcion)
    {
        $request["estudiante_id"] = $inscripcion->estudiante_id;
        $request["inscripcion_id"] = $inscripcion->id;
        $request["materia_id"] = $profesor_materia->materia_id;
        $request["profesor_materia_id"] = $profesor_materia->id;
        $request["fecha_registro"] = date("Y-m-d");

        KardexDesempeno::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('kardex_desempenos.show', [$profesor_materia->id, $inscripcion->id])->with('bien', 'Registro realizado con éxito');
    }

    public function edit(KardexDesempeno $kardex_desempeno)
    {
        return view('kardex_desempenos.edit', compact('kardex_desempeno'));
    }

    public function update(KardexDesempeno $kardex_desempeno, Request $request)
    {
        $kardex_desempeno->update(array_map('mb_strtoupper', $request->all()));
        $kardex_desempeno["i_a"] = isset($request->i_a) ? $request["i_a"] : null;
        $kardex_desempeno["i_b"] = isset($request->i_b) ? $request["i_b"] : null;
        $kardex_desempeno["i_c"] = isset($request->i_c) ? $request["i_c"] : null;
        $kardex_desempeno["i_d"] = isset($request->i_d) ? $request["i_d"] : null;
        $kardex_desempeno["i_e"] = isset($request->i_e) ? $request["i_e"] : null;
        $kardex_desempeno["i_f"] = isset($request->i_f) ? $request["i_f"] : null;
        $kardex_desempeno["i_g"] = isset($request->i_g) ? $request["i_g"] : null;
        $kardex_desempeno["i_h"] = isset($request->i_h) ? $request["i_h"] : null;
        $kardex_desempeno["i_i"] = isset($request->i_i) ? $request["i_i"] : null;
        $kardex_desempeno["i_j"] = isset($request->i_j) ? $request["i_j"] : null;

        $kardex_desempeno->save();

        return redirect()->route('kardex_desempenos.show', [$kardex_desempeno->profesor_materia->id, $kardex_desempeno->inscripcion->id])->with('bien', 'Registro realizado con éxito');
    }

    public function show(ProfesorMateria $profesor_materia, Inscripcion $inscripcion)
    {
        $kardex_desempenos = KardexDesempeno::where("inscripcion_id", $inscripcion->id)
            ->orderBy("fecha", "desc")->get();

        return view("kardex_desempenos.show", compact("profesor_materia", "inscripcion", "kardex_desempenos"));
    }

    public function destroy(KardexDesempeno $kardex_desempeno)
    {
        $profesor_materia = $kardex_desempeno->profesor_materia;
        $inscripcion = $kardex_desempeno->inscripcion;
        $kardex_desempeno->delete();
        return redirect()->route('kardex_desempenos.show', [$profesor_materia->id, $inscripcion->id])->with('bien', 'Registro realizado con éxito');
    }
}
