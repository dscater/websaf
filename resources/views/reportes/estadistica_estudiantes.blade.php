<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>estadistica estudiantes</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 0.5m;
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

        .profesor_color {
            margin: auto;
            margin-top: 0px;
            width: 30%;
        }

        .info {
            width: 80%;
            margin: auto;
            margin-top: 0px;
        }

        .diagonal-bar {
            position: relative;
            height: 60px;
        }

        .diagonal-bar span {
            position: absolute;
            top: 25px;
            left: 2px;
            transform: rotate(-45deg);
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="encabezado">
        <div class="logo">
            <img src="{{ asset('imgs/' . App\RazonSocial::first()->logo) }}">
        </div>
        <h2 class="titulo">
            {{ App\RazonSocial::first()->nombre }}
        </h2>
        <h4 class="texto">ESTADISTICA DE ESTUDIANTES</h4>
        <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
    </div>

    <table class="info">
        <tbody>
            <tr>
                <td class="bold" width="10%">Gestión:</td>
                <td>{{ $gestion }}</td>
                <td class="bold" width="10%">Curso:</td>
                <td>{{ $grado }}° {{ $paralelo->paralelo }}</td>
            </tr>
            <tr>
                <td class="bold">Turno:</td>
                <td>{{ $turno }}</td>
                <td class="bold">Nivel:</td>
                <td>{{ $nivel }}</td>
            </tr>
        </tbody>
    </table>

    <table border="1">
        <thead>
            <tr>
                <th colspan="4">INSCRITOS</th>
                <th colspan="4">NO INCORPORADOS</th>
                <th colspan="4">RETIRADOS</th>
                <th colspan="4">EFECTIVOS</th>
            </tr>
            <tr>
                <th>V</th>
                <th>M</th>
                <th>T</th>
                <th>%</th>
                <th>V</th>
                <th>M</th>
                <th>T</th>
                <th>%</th>
                <th>V</th>
                <th>M</th>
                <th>T</th>
                <th>%</th>
                <th>V</th>
                <th>M</th>
                <th>T</th>
                <th>%</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @php
                    $total = (int) $t_v + (int) $t_m;
                    $total_ni = (int) $t_v_ni + (int) $t_m_ni;
                    $total_re = (int) $t_v_re + (int) $t_m_re;
                @endphp
                <td class="centreado">{{ $t_v }}</td>
                <td class="centreado">{{ $t_m }}</td>
                <td class="centreado">{{ $total }}</td>
                <td class="centreado">{{ $total > 0 ? '100%' : '0%' }}</td>
                <td class="centreado">{{ $t_v_ni }}</td>
                <td class="centreado">{{ $t_m_ni }}</td>
                <td class="centreado">{{ (int) $t_v_ni + (int) $t_m_ni }}</td>
                @php
                    $p_ni = 0;
                    if ($total > 0) {
                        $p_ni = ($total_ni * 100) / $total;
                        $p_ni = round($p_ni, 2);
                    }
                @endphp
                <td class="centreado">{{ $p_ni }}%</td>
                <td class="centreado">{{ $t_v_re }}</td>
                <td class="centreado">{{ $t_m_re }}</td>
                <td class="centreado">{{ $total_re }}</td>
                @php
                    $p_re = 0;
                    if ($total > 0) {
                        $p_re = ($total_re * 100) / $total;
                        $p_re = round($p_re, 2);
                    }
                @endphp
                <td class="centreado">{{ $p_re }}%</td>
                <td class="centreado">{{ $t_v }}</td>
                <td class="centreado">{{ $t_m }}</td>
                <td class="centreado">{{ (int) $t_v + (int) $t_m }}</td>
                @php
                    $p_efectivo = 0;
                    if ($total > 0) {
                        $total_otros = $total_ni + $total_re;
                        $p_efectivo = ($total_otros * 100) / $total;
                        $p_efectivo = round($p_efectivo, 2);
                        $p_efectivo = 100 - $p_efectivo;
                    }
                @endphp
                <td class="centreado">{{ $p_efectivo }}%</td>
            </tr>
        </tbody>
    </table>

    <table border="1">
        <thead>
            <tr>
                <th>EDAD</th>
                @foreach ($edades as $value)
                    <th colspan="3" class="centreado">{{ $value }}</th>
                @endforeach
                <th rowspan="2">TOTAL GENERAL</th>
            </tr>
            <tr>
                <th width="10%">SEXO</th>

                @foreach ($edades as $value)
                    <th class="centreado">V</th>
                    <th class="centreado">M</th>
                    <th class="centreado">T</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>INICIO</td>
                @php
                    $total_general = 0;
                @endphp
                @foreach ($edades as $key => $value)
                    @php
                        $inscripcions_v = App\Inscripcion::select('inscripcions.id')
                            ->join('estudiantes', 'estudiantes.id', '=', 'inscripcions.estudiante_id')
                            ->where('estudiantes.sexo', 'M')
                            ->where('inscripcions.nivel', $nivel)
                            ->where('inscripcions.grado', $grado)
                            ->where('inscripcions.paralelo_id', $paralelo->id)
                            ->where('inscripcions.gestion', $gestion)
                            ->where('inscripcions.turno', $turno)
                            ->where('inscripcions.status', 1)
                            ->where('estudiantes.fecha_nac', 'LIKE', "$array_fechas[$key]-%")
                            ->get();

                        $total_v = count($inscripcions_v);

                        $inscripcions_m = App\Inscripcion::select('inscripcions.id')
                            ->join('estudiantes', 'estudiantes.id', '=', 'inscripcions.estudiante_id')
                            ->where('estudiantes.sexo', 'F')
                            ->where('inscripcions.nivel', $nivel)
                            ->where('inscripcions.grado', $grado)
                            ->where('inscripcions.paralelo_id', $paralelo->id)
                            ->where('inscripcions.gestion', $gestion)
                            ->where('inscripcions.turno', $turno)
                            ->where('inscripcions.status', 1)
                            ->where('estudiantes.fecha_nac', 'LIKE', "$array_fechas[$key]-%")
                            ->get();

                        $total_m = count($inscripcions_m);

                        $total = (int) $total_v + (int) $total_m;

                        $total_general = $total_general + $total;
                    @endphp
                    <td class="centreado">{{ $total_v }}</td>
                    <td class="centreado">{{ $total_m }}</td>
                    <td class="centreado">{{ $total }}</td>
                @endforeach
                <td class="centreado">{{ $total_general }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
