<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial Academico</title>
    <style type="text/css">
        *{
            font-family: sans-serif;
        }

        @page {
            margin-top: 1.5cm;
            margin-bottom: 1cm;
            margin-left: 1cm;
            margin-right:  1cm;
            border: 5px solid blue;
          }

        table{
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top:20px;
        }

        table thead tr th, tbody tr td{
            font-size: 0.63em;
        }
        .encabezado{
            width: 100%;
        }

        .dir_dptal{
            position: absolute;
            width: 380px;
            top:-20px;
            left:-20px;
            text-align: center;
            font-size:10pt;
        }

        h2.titulo{
            width: 100%;
            margin: auto;
            margin-top:15px; 
            margin-bottom:15px; 
            text-align: center;
            font-size:15pt;
            text-align: center;
        }

        table{
            width: 100%;
        }

        table thead{
            background:rgb(236, 236, 236)
        }

        table thead tr th{
            padding: 3px;
            font-size: 0.7em;
        }

        table tbody tr td{
            padding: 3px;
            font-size: 9pt;
        }

        table.info{
            position: relative;
            width: 80%;
            margin:auto;
        }

        .derecha{
            text-align: right;
        }

        .vertical{
            height: 185px;
            padding-right: 10px;
            background: rgb(200, 228, 255);
        }


        .vertical div{
            position: relative;
            margin-left: -60px;
            height: 50px;
            transform: rotate(270deg);
            width: 180px;
        }

        .nueva_pagina{
            page-break-after: always;
        }

        .centreado{
            text-align: center;
        }
    </style>
</head>
<body>
    @php
        $empresa = App\RazonSocial::first();
    @endphp

    <table class="info"> 
        <tbody>
            <tr>
                <td class="derecha" width="15%">ESTUDIANTE:</td>
                <td>{{$estudiante->paterno}} {{$estudiante->materno}} {{$estudiante->nombre}}</td>
                <td class="derecha" width="15%">GESTIÓN:</td>
                <td width="15%">{{$gestion}}</td>
            </tr>
            <tr>
                <td class="derecha">NIVEL:</td>
                <td>{{$nivel}}</td>
                <td class="derecha">PARALELO:</td>
                <td>{{$paralelo}}</td>
            </tr>
            <tr>
                <td class="derecha">FECHA:</td>
                <td>{{date('Y-m-d H:i:s')}}</td>
                <td class="derecha">TURNO:</td>
                <td>{{$turno}}</td>
            </tr>
        </tbody>
    </table>

    <table border="1">
        <thead>
            <tr>
                <th width="4%">Nº</th>
                <th>Materia</th>
                <th width="10%">Ser B.1</th>
                <th width="10%">Saber B.1</th>
                <th width="10%">Hacer B.1</th>
                <th width="10%">Decidir B.1</th>
                <th width="10%">PROMEDIO</th>
                <th width="13%">OBSERVACIÓN</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
            @endphp
            @foreach($calificacions as $calificacion)
            <tr>
                <td>{{$cont++}}</td>
                <td>{{$calificacion->materia->nombre}}</td>
                <td class="centreado">{{$info_calificaciones[$calificacion->id][1]}}</td>
                <td class="centreado">{{$info_calificaciones[$calificacion->id][2]}}</td>
                <td class="centreado">{{$info_calificaciones[$calificacion->id][3]}}</td>
                <td class="centreado">{{$info_calificaciones[$calificacion->id][4]}}</td>
                <td class="centreado">{{$info_calificaciones[$calificacion->id]['p']}}</td>
                <td class="centreado">{{$info_calificaciones[$calificacion->id]['o']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>