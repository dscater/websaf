<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> --}}
    <title>HistorialAsistencia</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 2cm;
            margin-bottom: 1cm;
            margin-left: 1.5cm;
            margin-right: 1cm;
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
            width: 350px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .fecha {
            width: 350px;
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
            font-size: 0.7em;
        }

        table tbody tr td.franco {
            background: red;
            color: white;
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

        .txt_rojo {}

        .img_celda img {
            width: 45px;
        }

        table.info {
            position: relative;
            width: 80%;
            margin: auto;
        }

        .txt_derecha {
            text-align: right;
        }

        .break_page {
            page-break-after: always;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    @php
        $contador = 0;
    @endphp
    @foreach ($estudiantes as $e)
        <div class="encabezado">
            <div class="logo">
                <img src="{{ asset('imgs/' . App\RazonSocial::first()->logo) }}">
            </div>
            <h2 class="titulo">
                {{ App\RazonSocial::first()->nombre }}
            </h2>
            <h4 class="texto">HISTORIAL DE ASISTENCIA</h4>
            <h4 class="texto">GESTIÓN {{ $anio }}</h4>
            <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
        </div>

        <table>
            <tbody>
                <tr>
                    <td class="bold txt_derecha" width="45%">Estudiante:</td>
                    <td>{{ $e->full_name }}</td>
                </tr>
                <tr>
                    <td class="bold txt_derecha">Nro. doc.:</td>
                    <td>{{ $e->nro_doc }}</td>
                </tr>
                <tr>
                    <td class="bold txt_derecha">Teléfono:</td>
                    <td>{{ $e->fono_dir }}</td>
                </tr>
                <tr>
                    <td class="bold txt_derecha">Padre/Tutor:</td>
                    <td>{{ $e->ap_padre_tutor }} {{ $e->nom_padre_tutor }}</td>
                </tr>
            </tbody>
        </table>

        <h4 style="margin-bottom:0px; text-align:center;">Asistencias</h4>
        <table border="1" style="margin-top: 2px">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora de ingreso</th>
                    <th>Hora de salida</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($historial_estudiante[$e->id] as $ha)
                    <tr>
                        <td class="centreado">{{ $ha->fecha }}</td>
                        <td class="centreado">{{ $ha->hora_ingreso }}</td>
                        <td class="centreado">{{ $ha->hora_salida }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @php
            $contador++;
        @endphp
        @if ($contador < count($estudiantes))
            <div class="break_page"></div>
        @endif
    @endforeach
</body>

</html>
