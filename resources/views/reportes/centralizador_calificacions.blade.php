<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Centralizador Calificaciones</title>
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

    </style>
</head>
<body>
    @php
        $empresa = App\RazonSocial::first();
        $contador = 0;
    @endphp
    @foreach($filas_grados as $grado)
    <div class="encabezado">
        <div class="dir_dptal">
            DIRECCIÓN DEPARTAMENTAL DE EDUCACIÓN LA PAZ
            SUB DIRECCIÓN DE EDUCACIÓN SUPERIOR
        </div>
        <h2 class="titulo">CENTRALIZADOR DE CALIFICACIONES</h2>
    </div>
    <br>
    <br>
    <table class="info">
        <tbody>
            <tr>
                <td class="derecha">UNIDAD EDUCATIVA:</td>
                <td>{{$empresa->nombre}}</td>
                <td class="derecha">DISTRITO:</td>
                <td>{{$empresa->nro_distrito}}</td>
                <td class="derecha">PARALELO:</td>
                <td>{{$paralelo}}</td>
            </tr>
            <tr>
                <td class="derecha">PLAN:</td>
                <td>ANUAL</td>
                <td class="derecha">GESTIÓN:</td>
                <td>{{$gestion}}</td>
                <td class="derecha">TURNO:</td>
                <td>{{$turno}}</td>
            </tr>
        </tbody>
    </table>

    <table border="1">
        <thead>
            <tr>
                <th colspan="4">NIVEL: {{$nivel}}</th>
                <th class="vertical" rowspan="3" width="5%">
                    <div>ASIGNATURA</div>
                </th>
                @foreach($array_materias[$grado] as $materia)
                <th class="vertical" rowspan="3" width="5%">
                    <div>{{$materia->materia->nombre}}</div>
                </th>
                @endforeach
                <th rowspan="3" width="10%">OBSERVACIONES</th>
            </tr>
            <tr>
                <th colspan="4">AÑO DE ESCOLARIDAD: {{$array_grados[$grado]}}</th>
            </tr>
            <tr>
                <th width="3%">Nº</th>
                <th>NOMINA</th>
                <th width="10%">C.I.</th>
                <th width="3%">SEXO</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
            @endphp
            @if(count($inscripcions[$grado]) > 0)
            @foreach($inscripcions[$grado] as $inscripcion)
            <tr>
                <td>{{$cont++}}</td>
                <td>{{$inscripcion->estudiante->paterno}} {{$inscripcion->estudiante->materno}} {{$inscripcion->estudiante->nombre}}</td>
                <td>{{$inscripcion->estudiante->nro_doc}} {{$inscripcion->estudiante->ci_exp}}</td>
                <td>{{$inscripcion->estudiante->sexo}}</td>
                <td></td>
                @foreach($array_materias[$grado] as $materia)
                <td>{{$calificacions[$grado][$inscripcion->id][$materia->materia_id]['nota']}}</td>
                @endforeach
                <td>{{$observacions[$grado][$inscripcion->id]}}</td>
            </tr>
            @endforeach
            @else 
            <tr>
                NO SE ENCONTRARON ESTUDIANTES INSCRITOS
            </tr>
            @endif
        </tbody>
    </table>
    @php
        $contador++;
    @endphp
    @if($contador < count($filas_grados))
    <div class="nueva_pagina"></div>
    @endif
    @endforeach
</body>
</html>