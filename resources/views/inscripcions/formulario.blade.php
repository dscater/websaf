<html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="charset=utf-8" />
    <title>FormularioInscripcion</title>
    <style>
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 1cm;
            margin-bottom: 1cm;
            margin-left: 1cm;
            margin-right: 1.5cm;
            font-family: 'Times New Roman', Times, serif;
            font-size: 9pt;
        }

        .escudo img {
            top: -30px;
            left: -15px;
            width: 140px;
            height: 110px;
            position: absolute;
        }

        .titulo {
            width: 100%;
            text-align: center;
            font-weight: bold;
            font-family: 'Times New Roman', Times, serif;
            font-size: 10pt;
        }

        .titulo2 {
            width: 100%;
            text-align: center;
            font-weight: bold;
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
        }

        .titulo3 {
            width: 100%;
            text-align: center;
            font-weight: normal;
            font-size: 7pt;
        }

        .titulo4 {
            width: 60%;
            text-align: center;
            font-weight: bold;
            font-size: 7pt;
            margin: auto;
        }

        .nro {
            top: 20px;
            position: absolute;
            right: 70px;
            padding: 5px;
            border-collapse: separate;
            border-spacing: 1px;
        }

        table {
            border-collapse: collapse;
        }

        .nro td {
            padding: 5px;
            border-radius: 4px;
        }

        .borde {
            position: relative;
            border: solid 1px black;
            border-radius: 3px;
        }

        .codigo {
            top: 62px;
            position: absolute;
            right: 350px;
            padding: 5px;
            border-collapse: separate;
        }

        .codigo td {
            padding: 5px;
        }

        .subtitulo {
            position: relative;
            font-size: 9pt;
            font-weight: bold;
        }

        .bold {
            font-weight: bold;
        }

        .txt_center {
            text-align: center;
        }

        .txt_derecha {
            text-align: right;
        }

        .txt_izquierda {
            text-align: left;
        }

        .informacion {
            width: 100%;
            border-radius: 10px;
            border: solid 1px black;
            border-collapse: separate;
            border-spacing: 8px;
        }

        .informacion tr td {
            padding: 2px;
        }

        .simbolo {
            height: 15px;
            width: 15px;
            font-size: 14pt;
            font-family: "DejaVu Sans Mono", monospace;
        }

    </style>
</head>

<body>
    @php
        $empresa = App\RazonSocial::first();
    @endphp
    <div class="escudo"><img src="{{ asset('imgs/escudo.png') }}" alt=""></div>
    <div class="titulo">FORMULARIO DE INSCRIPCIÓN / ACTUALIZACIÓN</div>
    <div class="titulo2">REGISTRO ÚNICO DE ESTUDIANTES</div>
    <div class="titulo3">Resolución Ministerial Nº 311/2006</div>
    <div class="titulo4">LA INFORMACIÓN RECABADA POR EL RUDE SERÁ UTILIZADA ÚNICA Y EXCLUSIVAMENTE PARA FINES DE DISEÑO
        Y EJECUCIÓN DE POLÍTICAS PÚBLICAS EDUCATIVAS Y SOCIALES</div>
    <table class="nro">
        <tr>
            <td>Nº</td>
            <td class="borde" width="30px">{{ $inscripcion->id }}</td>
        </tr>
    </table>
    <table class="codigo">
        <tr>
            <td>CÓDIGO SIE DE LA UNIDAD EDUCATIVA</td>
            <td class="borde" width="92px">{{ $empresa->codigo_sie }}</td>
        </tr>
    </table>
    <br>
    <div class="subtitulo">I. DATOS DE LA UNIDAD EDUCATIVA</div>
    <table class="informacion">
        <tr>
            <td colspan="4"><span class="bold">1.1. DEPENDENCIA DE LA UNIDAD EDUCATIVA</span></td>
            <td width="300px">
                <span class="bold">1.2. NOMBRE DE LA UNIDAD EDUCATIVA</span>
            </td>
        </tr>
        <tr>
            @php
                $publica = '&#9675;'; //vacio
                $comunitaria = '&#9675;'; //vacio
                $de_convenio = '&#9675;'; //vacio
                $privada = '&#9675;'; //vacio
                $simbolo = '&#9679;'; //lleno
                switch ($empresa->tipo_ue) {
                    case 'PÚBLICA':
                        $publica = '&#9679;'; //vacio
                        $comunitaria = '&#9675;'; //vacio
                        $de_convenio = '&#9675;'; //vacio
                        $privada = '&#9675;'; //vacio
                        break;
                    case 'COMUNITARIA':
                        $publica = '&#9675;'; //vacio
                        $comunitaria = '&#9679;'; //vacio
                        $de_convenio = '&#9675;'; //vacio
                        $privada = '&#9675;'; //vacio
                        break;
                    case 'DE CONVENIO':
                        $publica = '&#9675;'; //vacio
                        $comunitaria = '&#9675;'; //vacio
                        $de_convenio = '&#9679;'; //vacio
                        $privada = '&#9675;'; //vacio
                        break;
                    case 'PRIVADA':
                        $publica = '&#9675;'; //vacio
                        $comunitaria = '&#9675;'; //vacio
                        $de_convenio = '&#9675;'; //vacio
                        $privada = '&#9679;'; //vacio
                        break;
                }
            @endphp
            <td>Pública <span class="simbolo">{!! $publica !!}</span></td>
            <td>Comunitaria <span class="simbolo">{!! $comunitaria !!}</span></td>
            <td>De Convenio <span class="simbolo">{!! $de_convenio !!}</span></td>
            <td>Privada <span class="simbolo">{!! $privada !!}</span></td>
            <td class="borde">{{ $empresa->nombre }}</td>
        </tr>
        <tr>
            <td colspan="2" class="txt_derecha"><span class="bold">1.3. DISTRITO EDUCATIVO</span></td>
            <td class="borde">{{ $empresa->nro_distrito }}</td>
            <td class="borde" colspan="2">{{ $empresa->desc_distrito }}</td>
        </tr>
    </table>
    <div class="subtitulo" style="margin-top:5px;">II. DATOS DE LA O EL ESTUDIANTE</div>
    <table class="informacion">
        <tr>
            <td colspan="2"><span class="bold">2.1. APELLIDO(S) Y NOMBRE(S)</span></td>
            <td width="350px" colspan="2">
                <span class="bold">2.3. CÓDIGO ESTUDIANTIL RUDE</span>
            </td>
        </tr>
        <tr>
            <td width="100px" class="txt_derecha">Apellido Paterno</td>
            <td class="borde">{{ $inscripcion->estudiante->paterno }}</td>
            @php
                $codigo = $inscripcion->grado . '-' . $inscripcion->id;
                if ($inscripcion->id < 10) {
                    $codigo = $inscripcion->grado . '-' . '00' . $inscripcion->id;
                } elseif ($inscripcion->id < 100) {
                    $codigo = $inscripcion->grado . '-' . '0' . $inscripcion->id;
                }
            @endphp
            <td class="borde" colspan="2">{{ $codigo }}</td>
        </tr>
        <tr>
            <td class="txt_derecha">Apellido Materno</td>
            <td class="borde">{{ $inscripcion->estudiante->materno }}</td>
            <td colspan="2"><span class="bold">2.4 DOCUMENTO DE IDENTIFICACIÓN</span>
                <span>C.I. <span class="simbolo">&#9679;</span></span> <span>Pasaporte <span
                        class="simbolo">&#9675;</span></span>
            </td>
        </tr>
        <tr>
            <td class="txt_derecha">Nombre(s)</td>
            <td class="borde">{{ $inscripcion->estudiante->nombre }}</td>
            <td>Número del documento de identificación</td>
            <td width="20px" class="borde">{{ $inscripcion->estudiante->nro_doc }}</td>
        </tr>
        <tr>
            <td colspan="2"><span class="bold">2.2. LUGAR DE NACIMIENTO</span></td>
            <td><span class="bold">2.5. FECHA DE NACIMIENTO</span></td>
            <td><span class="bold">2.6. SEXO</span></td>
        </tr>
        <tr>
            <td class="txt_derecha">País</td>
            <td class="borde">{{ $inscripcion->estudiante->pais_nac }}</td>
            <td class="borde txt_center">
                <span class="borde"
                    style="margin:5px; padding:5px;">{{ date('d', strtotime($inscripcion->estudiante->fecha_nac)) }}</span>
                <span class="borde"
                    style="margin:5px; padding:5px;">{{ date('m', strtotime($inscripcion->estudiante->fecha_nac)) }}</span>
                <span class="borde"
                    style="margin:5px; padding:5px;">{{ date('Y', strtotime($inscripcion->estudiante->fecha_nac)) }}</span>
                <br>
                <span class="bold" style="margin:5px;padding:5px;">Día</span>
                <span class="bold" style="margin:5px;padding:5px;">Mes</span>
                <span class="bold" style="margin:5px;padding:5px;">Año</span>
            </td>
            @php
                $m = '&#9675;'; //vacio
                $f = '&#9675;'; //vacio
                $simbolo = '&#9679;'; //lleno
                if ($inscripcion->estudiante->sexo == 'M') {
                    $m = '&#9679;'; //vacio
                    $f = '&#9675;'; //vacio
                } else {
                    $m = '&#9675;'; //vacio
                    $f = '&#9679;'; //vacio
                }
            @endphp
            <td class="txt_center">
                <span>Femenino <span class="simbolo">{!! $f !!}</span></span><br>
                <span>Masculino <span class="simbolo">{!! $m !!}</span></span>
            </td>
        </tr>
        <tr>
            <td class="txt_derecha">Departamento</td>
            <td class="borde">{{ $inscripcion->estudiante->dpto_nac }}</td>
            <td colspan="2"><span class="bold">2.7. CERTIFICADO DE NACIMIENTO</span></td>
        </tr>
        <tr>
            <td class="txt_derecha">Provincia</td>
            <td class="borde">{{ $inscripcion->estudiante->provincia_nac }}</td>
            <td class="txt_center borde" colspan="2">
                <span class="bold">Oficialía Nº </span> <span>{{$inscripcion->estudiante->oficialia}}</span>
                <span class="bold">Libro Nº </span> <span>{{$inscripcion->estudiante->libro}}</span>
                <span class="bold">Partida Nº </span> <span>{{$inscripcion->estudiante->partida}}</span>
                <span class="bold">Folio Nº </span> <span>{{$inscripcion->estudiante->folio}}</span>
            </td>
        </tr>
        <tr>
            <td class="txt_derecha">Localidad</td>
            <td class="borde">{{ $inscripcion->estudiante->localidad_nac }}</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="4"><span class="bold">2.8.UNIDAD EDUCATIVA DE PROCEDENCIA DE LA O EL ESTUDIANTE</span></td>
        </tr>
        <tr>
            <td  width="90px">
                Código SIE de la U.E.
            </td>
            <td class="borde">{{$inscripcion->estudiante->codigo_sie_ue	}}</td>
            <td>
                Nombre de la Unidad Educativa
            </td>
            <td class="borde">{{$inscripcion->estudiante->ue_procedencia}}</td>
        </tr>
    </table>
</body>
</html>
