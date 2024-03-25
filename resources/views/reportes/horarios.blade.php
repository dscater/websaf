<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>horarios</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 1.5m;
            margin-bottom: 0.5cm;
            margin-left: 0.5cm;
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
        <h4 class="texto">HORARIOS</h4>
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
                <th rowspan="2" width="2%">N°</th>
                <th rowspan="2" width="8%">HORAS</th>
                @foreach ($dias as $key => $d)
                    <th class="centreado"
                        colspan="{{ $array_datos[$key]['maximo'] != 0 ? $array_datos[$key]['maximo'] : '1' }}">
                        {{ $d }}</th>
                @endforeach
            </tr>
            <tr>
                @foreach ($dias as $key => $d)
                    @if ($array_datos[$key]['maximo'] != 0)
                        @for ($i = 1; $i <= $array_datos[$key]['maximo']; $i++)
                            <th class="centreado">{{ $i }}</th>
                        @endfor
                    @else
                        <th class="centreado">-</th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
            @endphp
            @foreach ($horas as $index => $h)
                @if ($h->recreo)
                    <tr>
                        <td colspan="2" class="centreado">{{ $h->hora_c }}</td>
                        <td colspan="{{ $colspan_recreo }}" class="centreado">RECREO</td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $cont++ }}</td>
                        <td>{{ $h->hora_c }}</td>
                        @foreach ($dias as $key => $d)
                            @if ($array_datos[$key]['maximo'] != 0)
                                @php
                                    $restante = 0;
                                    if (count($array_datos[$key]['horarios'][$h->id]) < $array_datos[$key]['maximo']) {
                                        $restante =
                                            (int) $array_datos[$key]['maximo'] -
                                            count($array_datos[$key]['horarios'][$h->id]);
                                    }
                                @endphp
                                @foreach ($array_datos[$key]['horarios'][$h->id] as $item)
                                    <td class="centreado" style="background:{{ $item->color }}">
                                        {{ $item->materia->codigo }}</td>
                                @endforeach
                                @for ($i = 1; $i <= $restante; $i++)
                                    <td class="centreado">-</td>
                                @endfor
                            @else
                                <td class="centreado">-</td>
                            @endif
                        @endforeach
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <h5 style="text-align:center;">PLANTEL DOCENTE</h5>
    <table border="1" class="profesor_color">
        <tbody>
            @foreach ($profesor_colors as $key => $item)
                <tr>
                    <td>
                        {{ $item->profesor->full_name }}
                    </td>
                    <td style="background: {{ $item->color }}">

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
