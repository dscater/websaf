<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlanPago;
use App\Estudiante;
use App\Inscripcion;

class PlanPagoController extends Controller
{
    public function index()
    {
        $plan_pagos = PlanPago::where('estado', 1)->get();
        return view('plan_pagos.index', compact('plan_pagos'));
    }

    public function create()
    {
        return view('plan_pagos.create');
    }

    public function store(Request $request)
    {
        $request['estado'] = 1;
        $request['fecha_registro'] = date('Y-m-d');
        PlanPago::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('plan_pagos.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(PlanPago $plan_pago)
    {
        return view('plan_pagos.edit', compact('plan_pago'));
    }

    public function update(PlanPago $plan_pago, Request $request)
    {
        $plan_pago->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('plan_pagos.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(PlanPago $plan_pago)
    {
        return 'mostrar cargo';
    }

    public function destroy(PlanPago $plan_pago)
    {
        $plan_pago->estado = 0;
        $plan_pago->save();
        return redirect()->route('plan_pagos.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function getMontoConcepto(Request $request)
    {
        $estudiante_id = $request->estudiante_id;
        $estudiante = Estudiante::find($estudiante_id);

        $gestion = $request->gestion;
        $concepto = $request->concepto;

        $inscripcion = Inscripcion::where('estudiante_id', $estudiante->id)
            ->where('gestion', $gestion)
            ->get()
            ->first();

        $nivel = $inscripcion->nivel;

        $plan_pago = PlanPago::where('nivel', $nivel)
            ->where('concepto', $concepto)
            ->where('gestion', $gestion)
            ->get()
            ->first();

        return response()->JSON([
            'sw' => true,
            'plan_pago' => $plan_pago
        ]);
    }
}
