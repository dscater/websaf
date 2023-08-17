<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bolea de Calificaciones</title>
    <style type="text/css">
        *{
            font-family: sans-serif;
        }

        @page {
            margin-top: 1cm;
            margin-bottom: 1cm;
            margin-left: 1.5cm;
            margin-right:  1cm;
            border: 5px solid blue;
        }

        table{
            margin:auto;
            border-collapse: collapse;
        }

        table tr td{
            font-size: 9pt;
            padding: 8px;
        }

        .foto img{
            height: 80px;
            width: 80px;
        }

        .logo img{
            height: 90px;
            width: 120px;
        }

        .nueva_pagina{
            page-break-after: always;
        }

        .titulo{
            font-size: 14pt;
            font-weight: bold;
        }

        body{
            writing-mode: rl;
        }
          
    </style>
    <link rel="stylesheet" href="{{asset('css/reportes/boleta_calificaciones.css')}}">
</head>
<body>
    @php
        $empresa = App\RazonSocial::first();
    @endphp
    
    @foreach($inscripcions as $inscripcion)
    <table>
        <tr>
            <td class="foto" rowspan="4"><img src="{{asset('imgs/users/'.$inscripcion->estudiante->foto)}}" alt=""></td>
            <td class="titulo">{{$titulo}}</td>
            <td>Gestión: {{$gestion}}</td>
            <td class="logo" rowspan="4"><img src="{{ asset('imgs/'.$empresa->logo) }}" alt="Logo"></td>
        </tr>
        <tr>
            @php
                $codigo = $inscripcion->grado.'-'.$inscripcion->id;
                if($inscripcion->id < 10){
                $codigo = $inscripcion->grado.'-'.'00'.$inscripcion->id;
                }elseif($inscripcion->id < 100){
                $codigo = $inscripcion->grado.'-'.'0'.$inscripcion->id;
                }
            @endphp
            <td>Código de Estudiante: {{$codigo}}</td>
            <td>Curso: {{$inscripcion->grado}}º de {{$inscripcion->nivel}}</td>
        </tr>
        <tr>
            <td colspan="2">Paralelo: {{$inscripcion->paralelo->paralelo}}</td>
        </tr>
        <tr>
            <td colspan="2">Apellidos y Nombres: {{$inscripcion->estudiante->paterno}} {{$inscripcion->estudiante->materno}} {{$inscripcion->estudiante->nombre}}</td>
        </tr>
    </table>
<br><br>
    <div id="malla_curricular">
        <div class="header">
            <div class="campo">
                CAMPOS DE SABERES Y CONOCIMIENTOS
            </div>
            <div class="area">
                ÁREAS CURRICULARES
            </div>
            <div class="valoracion">
                VALORACIÓN CUANTITATIVA
            </div>
            <div class="valoracion_cualitativa">
                VALORACIÓN CUALITATIVA
            </div>
        </div>
        <div class="body">
            <div class="contenedor_campos">
                {!! $array_html[$inscripcion->id] !!}
            </div>
        </div>
    </div>
    <div class="nueva_pagina"></div>
    @endforeach

    <script>
     var mywindow = this;
     mywindow.print();
    </script>
</body>
</html>