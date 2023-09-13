<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Personal</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 2cm;
            margin-bottom: 1cm;
            margin-left: 0.3cm;
            margin-right: 0.3cm;
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
            word-break: break-all;
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
        <h4 class="texto">LISTA DEL PERSONAL</h4>
        <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
        @if ($filtro == 'gestion')
            <h4 class="fecha">Gestión: {{ $gestion }}</h4>
        @endif
    </div>
    @if (count($administrativos) > 0)
        <table border="1">
            <thead>
                <tr>
                    <th colspan="13" class="txt_center">ADMINISTRATIVOS</th>
                </tr>
                <tr>
                    <th width="3%">Nº</th>
                    <th>Apellido(s) y Nombre(s)</th>
                    <th width="5%">Foto</th>
                    <th width="5%">C.I.</th>
                    <th width="5%">Celular</th>
                    <th width="5%">E-mail</th>
                    <th>Lugar Nacimiento</th>
                    <th>Fecha Nacimiento</th>
                    <th width="5%">Edad</th>
                    <th width="5%">Sexo</th>
                    <th>Estado Civil</th>
                    <th>Dirección</th>
                    <th width="5%">Fecha Registro</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cont = 1;
                @endphp
                @foreach ($administrativos as $administrativo)
                    <tr>
                        <td>{{ $cont++ }}</td>
                        <td>{{ $administrativo->paterno }} {{ $administrativo->materno }} {{ $administrativo->nombre }}
                        </td>
                        <td class="img_celda"><img
                                src="{{ file_exists(public_path('imgs/users/' . $administrativo->foto)) ? asset('imgs/users/' . $administrativo->foto) : asset('imgs/users/user_default.png') }}"
                                alt="Foto"></td>
                        <td>{{ $administrativo->ci }} {{ $administrativo->ci_exp }}</td>
                        <td>{{ $administrativo->cel }} / {{ $administrativo->fono }}</td>
                        <td>{{ $administrativo->email }}</td>
                        <td>{{ $administrativo->lugar_nac }}</td>
                        <td>{{ $administrativo->fecha_nac }}</td>
                        <td>{{ $administrativo->edad }}</td>
                        <td>{{ $administrativo->sexo }}</td>
                        <td>{{ $administrativo->estado_civil }}</td>
                        <td>{{ $administrativo->zona }} {{ $administrativo->avenida }} {{ $administrativo->nro }}
                        </td>
                        <td>{{ $administrativo->fecha_registro }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if (count($profesors) > 0)
        <table border="1">
            <thead>
                <tr>
                    <th colspan="14" class="txt_center">PROFESORES</th>
                </tr>
                <tr>
                    <th width="3%">Nº</th>
                    <th>Apellido(s) y Nombre(s)</th>
                    <th width="5%">Foto</th>
                    <th width="5%">Usuario</th>
                    <th width="5%">C.I.</th>
                    <th width="5%">Celular</th>
                    <th width="10%">E-mail</th>
                    <th width="7%">Lugar Nacimiento</th>
                    <th width="5%">Fecha Nacimiento</th>
                    <th width="3%">Edad</th>
                    <th width="3%">Sexo</th>
                    <th width="5%">Estado Civil</th>
                    <th width="20%">Dirección</th>
                    <th width="5%">Fecha Registro</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cont = 1;
                @endphp
                @foreach ($profesors as $profesor)
                    <tr>
                        <td>{{ $cont++ }}</td>
                        <td>{{ $profesor->paterno }} {{ $profesor->materno }} {{ $profesor->nombre }}</td>
                        <td class="img_celda"><img src="{{ asset('imgs/users/' . $profesor->foto) }}" alt="Foto">
                        </td>
                        <td>{{ $profesor->usuario }}</td>
                        <td>{{ $profesor->ci }} {{ $profesor->ci_exp }}</td>
                        <td>{{ $profesor->cel }} / {{ $profesor->fono }}</td>
                        <td>{{ $profesor->email }}</td>
                        <td>{{ $profesor->lugar_nac }}</td>
                        <td>{{ $profesor->fecha_nac }}</td>
                        <td>{{ $profesor->edad }}</td>
                        <td>{{ $profesor->sexo }}</td>
                        <td>{{ $profesor->estado_civil }}</td>
                        <td>{{ $profesor->zona }} {{ $profesor->avenida }} {{ $profesor->nro }}</td>
                        <td>{{ $profesor->fecha_registro }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>
