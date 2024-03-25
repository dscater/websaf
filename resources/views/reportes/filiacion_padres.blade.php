<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Filiacion de Padres</title>
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
        <h4 class="texto">FILIACIÓN DEL PADRE</h4>
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
                <th rowspan="2" width="4%">N°</th>
                <th rowspan="2">APELLIDOS Y NOMBRES DEL PADRE O MADRE DE FAMILIA</th>
                <th rowspan="2" width="4%">EDAD</th>
                <th rowspan="2" width="4%">SEXO</th>
                <th rowspan="2">OCUPACIÓN PADRE DE FAMILIA</th>
                <th colspan="2">DOMICILIO / REFERENCIA</th>
            </tr>
            <tr>
                <th>RESIDENCIA</th>
                <th width="8%">CELULAR</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
            @endphp
            @foreach ($inscripcions as $value)
                <tr>
                    <td>{{ $cont++ }}</td>
                    <td>{{ $value->estudiante->ap_padre_tutor }} {{ $value->estudiante->nom_padre_tutor }}</td>
                    <td>{{ $value->estudiante->fn_tutor && $value->estudiante->fn_tutor != '0000-00-00' ? App\Estudiante::getEdadFecha($value->estudiante->fn_tutor) : '' }}
                    </td>
                    <td>{{ $value->estudiante->s_tutor ? ($value->estudiante->s_tutor == 'MASCULINO' ? 'M' : 'F') : '' }}
                    </td>
                    <td>{{ $value->estudiante->ocupacion_padre_tutor }}</td>
                    <td>{{ $value->estudiante->d_tutor }}</td>
                    <td>{{ $value->estudiante->cel_tutor }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
