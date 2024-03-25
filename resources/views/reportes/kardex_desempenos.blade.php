<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>KardexDesempeño</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 0.6cm;
            margin-bottom: 0.5cm;
            margin-left: 1.5cm;
            margin-right: 0.5cm;
            border: 5px solid blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
        }

        table thead tr th,
        tbody tr td {
            font-size: 0.63em;
            word-wrap: break-word;
        }

        .encabezado {
            width: 100%;
        }

        .logo img {
            position: absolute;
            width: 200px;
            height: 90px;
            top: -20px;
            left: -20px;
        }

        h2.titulo {
            width: 450px;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14pt;
        }

        .texto {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .fecha {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: normal;
            font-size: 0.85em;
        }

        .total {
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        table thead {
            background: rgb(236, 236, 236)
        }

        table thead tr th {
            padding: 3px;
            font-size: 0.7em;
        }

        table tbody tr td {
            padding: 3px;
            font-size: 0.55em;
            word-wrap: break-word;
        }

        table tbody tr td {
            vertical-align: middle;
            height: 30px;
        }

        .centreado {
            padding-left: 0px;
            text-align: center;
        }

        .datos {
            margin-left: 15px;
            border-top: solid 1px;
            border-collapse: collapse;
            width: 250px;
        }

        .txt {
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
        }

        .txt_center {
            font-weight: bold;
            text-align: center;
        }

        .cumplimiento {
            position: absolute;
            width: 150px;
            right: 0px;
            top: 86px;
        }

        .p_cump {
            color: red;
            font-size: 1.2em;
        }

        .b_top {
            border-top: solid 1px black;
        }

        .gray {
            background: rgb(202, 202, 202);
        }

        .img_celda img {
            width: 45px;
        }

        .table-info {
            margin-top: 0px;
        }

        .bordeado {
            border: 0.7px solid black;
        }

        .bold {
            font-weight: bold;
        }

        .txt_desc {
            font-size: 0.85em;
        }

        .p-0 {
            padding: 0px;
        }

        .nueva_pagina {
            page-break-before: always;
        }
    </style>
</head>

<body>
    @php
        $contador = 0;
    @endphp
    @foreach ($inscripcions as $inscripcion)
        <div class="encabezado">
            <div class="logo">
                <img src="{{ asset('imgs/' . App\RazonSocial::first()->logo) }}">
            </div>
            <h2 class="titulo">
                {{ App\RazonSocial::first()->nombre }}
            </h2>
            <h4 class="texto">KARDEX DE DESEMPEÑO ACADÉMICO</h4>
            <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
        </div>

        <table>
            <tbody>
                <tr>
                    <td class="centreado bordeado">{{ $inscripcion->estudiante->paterno }}</td>
                    <td class="centreado bordeado">{{ $inscripcion->estudiante->materno }}</td>
                    <td class="centreado bordeado">{{ $inscripcion->estudiante->nombre }}</td>
                </tr>
                <tr>
                    <td class="centreado bold p-0" style="height: 5px;">APPELIDO PATERNO</td>
                    <td class="centreado bold p-0" style="height: 5px;">APELLIDO MATERNO</td>
                    <td class="centreado bold p-0" style="height: 5px;">NOMBRES</td>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody>
                <tr>
                    <td class="centreado bordeado">{{ $inscripcion->nivel }}</td>
                    <td class="centreado bordeado">{{ $inscripcion->grado }}° {{ $inscripcion->paralelo->paralelo }}
                    </td>
                    <td class="centreado bordeado">{{ $inscripcion->estudiante->avenida_dir }}</td>
                    <td class="centreado bordeado">{{ $inscripcion->estudiante->cel_tutor }}</td>
                </tr>
                <tr>
                    <td class="centreado bold p-0" style="height: 5px;">NIVEL</td>
                    <td class="centreado bold p-0" style="height: 5px;">CURSO</td>
                    <td class="centreado bold p-0" style="height: 5px;">DIRECCIÓN</td>
                    <td class="centreado bold p-0" style="height: 5px;">No. DE CELULAR</td>
                </tr>
            </tbody>
        </table>

        <table border="1">
            <thead>
                <tr>
                    <th width="3%">No.</th>
                    <th width="8%">FECHA</th>
                    <th>AREAS</th>
                    <th width="2%">A</th>
                    <th width="2%">B</th>
                    <th width="2%">C</th>
                    <th width="2%">D</th>
                    <th width="2%">E</th>
                    <th width="2%">F</th>
                    <th width="2%">G</th>
                    <th width="2%">H</th>
                    <th width="2%">I</th>
                    <th width="2%">J</th>
                    <th>FIRMA DEL PROFESOR</th>
                    <th>OBS.</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cont = 1;

                    $kardex_desempenos = App\KardexDesempeno::where('inscripcion_id', $inscripcion->id)
                        ->orderBy('fecha', 'asc')
                        ->get();
                @endphp
                @foreach ($kardex_desempenos as $value)
                    <tr>
                        <td>{{ $cont++ }}</td>
                        <td>{{ $value->fecha_t }}</td>
                        <td>{{ $value->materia->nombre }}</td>
                        <td class="centreado bold txt_desc">{{ $value->i_a ? 'X' : '' }}</td>
                        <td class="centreado bold txt_desc">{{ $value->i_b ? 'X' : '' }}</td>
                        <td class="centreado bold txt_desc">{{ $value->i_c ? 'X' : '' }}</td>
                        <td class="centreado bold txt_desc">{{ $value->i_d ? 'X' : '' }}</td>
                        <td class="centreado bold txt_desc">{{ $value->i_e ? 'X' : '' }}</td>
                        <td class="centreado bold txt_desc">{{ $value->i_f ? 'X' : '' }}</td>
                        <td class="centreado bold txt_desc">{{ $value->i_g ? 'X' : '' }}</td>
                        <td class="centreado bold txt_desc">{{ $value->i_h ? 'X' : '' }}</td>
                        <td class="centreado bold txt_desc">{{ $value->i_i ? 'X' : '' }}</td>
                        <td class="centreado bold txt_desc">{{ $value->i_j ? 'X' : '' }}</td>
                        <td></td>
                        <td>{{ $value->observaciones }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table>
            <tbody>
                <tr>
                    <td colspan="4" class="bold txt_desc">INDICADORES:</td>
                    <td class="bold txt_desc">ASPECTOS POSITIVOS</td>
                </tr>
                <tr>
                    <td class="bold txt_desc bordeado" width="3%">A</td>
                    <td class="bordeado">Se atrasó al ingresar a clases</td>
                    <td class="bold txt_desc bordeado" width="3%">F</td>
                    <td class="bordeado">Se distrae con su celular y otros</td>
                    <td rowspan="5" class="bordeado">
                        <ul>
                            @foreach ($kardex_desempenos as $item)
                                @if ($item->aspectos_positivos)
                                    <li>{{ $item->aspectos_positivos }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td class="bold txt_desc bordeado">B</td>
                    <td class="bordeado">No asistió a clases</td>
                    <td class="bold txt_desc bordeado">G</td>
                    <td class="bordeado">No promueve valores humanos (indisciplina)</td>
                </tr>
                <tr>
                    <td class="bold txt_desc bordeado">C</td>
                    <td class="bordeado">No presento sus prácticas - actividades</td>
                    <td class="bold txt_desc bordeado">H</td>
                    <td class="bordeado">No cumple con el reglamento (uniforme)</td>
                </tr>
                <tr>
                    <td class="bold txt_desc bordeado">D</td>
                    <td class="bordeado">No se presentó a la actividad evaluativa</td>
                    <td class="bold txt_desc bordeado">I</td>
                    <td class="bordeado">Apoyo y seguimiento del Padre de Familia</td>
                </tr>
                <tr>
                    <td class="bold txt_desc bordeado">E</td>
                    <td class="bordeado">Abandono las clases</td>
                    <td class="bold txt_desc bordeado">J</td>
                    <td class="bordeado">Otros.</td>
                </tr>
            </tbody>
        </table>
        @php
            $contador++;
        @endphp
        @if ($contador < count($inscripcions))
            <div class="nueva_pagina"></div>
        @endif
    @endforeach
</body>

</html>
