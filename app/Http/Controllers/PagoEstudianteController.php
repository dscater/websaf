<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;
use App\PagoEstudiante;
use App\PlanPago;
use App\Inscripcion;
use Barryvdh\DomPDF\Facade as PDF;
use App\RazonSocial;
use App\library\numero_a_letras\src\NumeroALetras;

class PagoEstudianteController extends Controller
{
    public function index()
    {
        $pago_estudiantes = PagoEstudiante::where('estado', 1)->get();
        return view('pago_estudiantes.index', compact('pago_estudiantes'));
    }

    public function pagos_estudiante(Estudiante $estudiante)
    {
        $pago_estudiantes = PagoEstudiante::where('estudiante_id', $estudiante->id)->where('estado', 1)->get();
        return view('pago_estudiantes.pagos_estudiante', compact('pago_estudiantes', 'estudiante'));
    }

    public function historial_pagos(Estudiante $estudiante)
    {
        $pago_estudiantes = PagoEstudiante::where('estudiante_id', $estudiante->id)->where('estado', 1)->get();
        $gestion_min = Inscripcion::min('gestion');
        $gestion_max = Inscripcion::max('gestion');

        $array_gestiones_insc = [];
        if ($gestion_min) {
            $array_gestiones_insc[''] = 'Seleccione...';
            for ($i = (int)$gestion_min; $i <= (int)$gestion_max; $i++) {
                $array_gestiones_insc[$i] = $i;
            }
        }
        return view('pago_estudiantes.historial_pagos', compact('pago_estudiantes', 'estudiante', 'array_gestiones_insc'));
    }

    public function create()
    {
        $gestion_min = Inscripcion::min('gestion');
        $gestion_max = Inscripcion::max('gestion');

        $array_gestiones = [];
        if ($gestion_min) {
            $array_gestiones[''] = 'Seleccione...';
            for ($i = (int)$gestion_min; $i <= (int)$gestion_max; $i++) {
                $array_gestiones[$i] = $i;
            }
        }
        $estudiantes = Estudiante::select('estudiantes.*')
            ->where('estudiantes.estado', 1)
            ->get();
        $array_estudiantes[''] = 'Seleccione...';
        foreach ($estudiantes as $value) {
            $array_estudiantes[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }
        return view('pago_estudiantes.create', compact('array_estudiantes', 'array_gestiones'));
    }

    public function store(Request $request)
    {
        $estudiante = Estudiante::find($request->estudiante_id);
        $inscripcion = Inscripcion::where('estudiante_id', $estudiante->id)
            ->where('gestion', $request->gestion)
            ->get()
            ->first();
        $request['inscripcion_id'] = $inscripcion->id;
        $request['fecha_registro'] = date('Y-m-d');
        $request['estado'] = 1;

        // CREAR UN CÓDIGO DE CONTROL
        // crear un array
        $array_codigo = [];
        for ($i = 1; $i <= 9; $i++) {
            $array_codigo[] = $i; //agregar los números del 1 al 9
        }
        array_push($array_codigo, 'A', 'B', 'C', 'D', 'E', 'F'); //agregar las letras para poder generar un # hexadecimal
        //generar el código
        $codigo = '';
        for ($i = 1; $i <= 10; $i++) {
            $indice = mt_rand(0, 14);
            $codigo .= $array_codigo[$indice];
            if ($i % 2 == 0) {
                $codigo .= '-';
            }
        }

        $request['cod_control'] = $codigo;
        $request['fecha_limite'] = date('Y-m-d', strtotime(date('Y-m-d') . "+ 6 month"));

        if (!extension_loaded('imagick')) {
            return redirect()->route('pago_estudiantes.index')->with('error', 'El servidor no tiene instalado imagick');
        }

        $pago_estudiante = PagoEstudiante::create(array_map('mb_strtoupper', $request->all()));

        $nom_qr = time() . '_' . $pago_estudiante->id . '.png';
        $codigo_qr = date('Y-m-d H:i:s') . '|' . $estudiante->id . '|' . $pago_estudiante->monto . ' Bs.|' . $pago_estudiante->concepto . '|' . $pago_estudiante->descripcion;
        $pago_estudiante->qr = $nom_qr;
        $pago_estudiante->save();
        /* GENERAR CÓDIGO QR */
        $base_64 = base64_encode(\QrCode::format('png')->size(400)->generate($codigo_qr));
        $imagen_codigo_qr = base64_decode($base_64);
        file_put_contents(public_path() . '/imgs/qr/' . $nom_qr, $imagen_codigo_qr);

        $url_factura = route('pago_estudiantes.factura', $pago_estudiante->id);

        return redirect()->route('pago_estudiantes.index')->with('bien', 'Registro realizado con éxito')
            ->with('url_factura', $url_factura);
    }

    public function edit(PagoEstudiante $pago_estudiante)
    {
        $estudiantes = Estudiante::select('estudiantes.*')
            ->where('estudiantes.estado', 1)
            ->get();
        $array_estudiantes[''] = 'Seleccione...';
        foreach ($estudiantes as $value) {
            $array_estudiantes[$value->id] = $value->nombre . ' ' . $value->paterno . ' ' . $value->materno;
        }
        return view('pago_estudiantes.edit', compact('pago_estudiante', 'array_estudiantes'));
    }

    public function update(PagoEstudiante $pago_estudiante, Request $request)
    {
        $pago_estudiante->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('pago_estudiantes.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(PagoEstudiante $pago_estudiante)
    {
        return 'mostrar cargo';
    }

    public function destroy(PagoEstudiante $pago_estudiante)
    {
        $pago_estudiante->estado = 0;
        $pago_estudiante->save();
        return redirect()->route('pago_estudiantes.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function factura(PagoEstudiante $pago_estudiante)
    {
        $empresa = RazonSocial::first();
        $convertir = new NumeroALetras();
        $array_monto = explode('.', $pago_estudiante->monto);
        $literal = $convertir->convertir($array_monto[0]);
        $literal .= " " . $array_monto[1] . "/100." . " BOLIVIANOS";

        $inscripcion = Inscripcion::find($pago_estudiante->inscripcion_id);

        $nivel = $inscripcion->nivel;

        $plan_pago = PlanPago::where('nivel', $nivel)
            ->where('concepto', $pago_estudiante->concepto)
            ->where('gestion', $pago_estudiante->gestion)
            ->get()
            ->first();

        $numero_factura = $pago_estudiante->id;
        if ($numero_factura < 10) {
            $numero_factura = '0000' . $numero_factura;
        } elseif ($numero_factura < 100) {
            $numero_factura = '000' . $numero_factura;
        } elseif ($numero_factura < 1000) {
            $numero_factura = '00' . $numero_factura;
        } elseif ($numero_factura < 1000) {
            $numero_factura = '01' . $numero_factura;
        }


        $pdf = PDF::loadView('pago_estudiantes.factura', compact('pago_estudiante', 'literal', 'empresa', 'plan_pago', 'numero_factura'))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Factura.pdf');
    }

    public function ingresos_economicos(Request $request)
    {
        $filtro = $request->filtro;
        $concepto = $request->concepto;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;


        $conceptos = [
            'INSCRIPCIÓN' => 'INSCRIPCIÓN',
            'MENSUALIDAD' => 'MENSUALIDAD',
            'PAGO GLOBAL AL CONTADO' => 'PAGO GLOBAL AL CONTADO',
            'OTRO PAGO' => 'OTRO PAGO'
        ];

        if ($filtro == 'concepto' && $concepto != 'todos') {
            $conceptos = [$concepto];
        }

        $data = [];
        $total = 0;
        foreach ($conceptos as $concepto) {
            if ($filtro != 'todos' && $filtro == 'fecha') {
                $pagos = PagoEstudiante::whereBetween('fecha_registro', [$fecha_ini, $fecha_fin])
                    ->where('concepto', $concepto)
                    ->where('estado', 1)
                    ->orderBy('fecha_registro', 'desc')
                    ->get()->sum('monto');
            } else {
                $pagos = PagoEstudiante::where('estado', 1)
                    ->where('concepto', $concepto)
                    ->orderBy('fecha_registro', 'desc')
                    ->get()->sum('monto');
            }
            $data[] = [$concepto, (float)$pagos];
            $total += (float)$pagos;
        }

        return response()->JSON([
            'sw' => true,
            'data' => $data,
            'total' => $total
        ]);
    }
}
