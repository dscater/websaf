<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 0.5cm;
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
            width: 320px;
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

        .subtitulo {
            font-size: 0.9em;
        }

        .txtinfo {
            font-weight: bold;
        }

        .border-bot {
            border-bottom: solid 0.7px black;
        }

        .table-info {
            margin-top: 4px;
            border-collapse: separate;
            border-spacing: 15px 0px;
        }

        .bold {
            font-weight: bold;
        }

        .txt-md {
            font-size: 0.8em;
        }

        .foto {
            width: 14%;
            padding: 0px;
        }

        .foto img {
            width: 100%;
        }

        .bordeado {
            border: solid 0.7px black;
            height: 14px;
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
        <h4 class="texto">FORMULARIO DE REGISTRO ESTUDIANTE</h4>
        <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
    </div>

    <h2 class="subtitulo">1. DATOS DE LA O EL ESTUDIANTE</h2>
    <table class="table-info">
        <tbody>
            <tr>
                <td class="centreado border-bot">{{ $usuario->paterno }}</td>
                <td class="centreado border-bot">{{ $usuario->materno }}</td>
                <td class="centreado border-bot">{{ $usuario->nombre }}</td>
                <td rowspan="4" class="foto">
                    <img src="{{ $usuario->url_foto }}" alt="">
                </td>
            </tr>
            <tr>
                <td class="centreado txtinfo">Ap. Paterno</td>
                <td class="centreado txtinfo">Ap. Materno</td>
                <td class="centreado txtinfo">Nombres</td>
            </tr>
            <tr>
                <td class="centreado border-bot">{{ $usuario->nro_doc }}</td>
                <td class="centreado border-bot">{{ $usuario->fecha_nac }}</td>
                <td class="centreado border-bot">{{ $usuario->sexo }}</td>
            </tr>
            <tr>
                <td class="centreado txtinfo">Cédula de Identidad</td>
                <td class="centreado txtinfo">Fecha de Nacimiento</td>
                <td class="centreado txtinfo">Sexo</td>
            </tr>
        </tbody>
    </table>
    <table class="table-info">
        <tbody>
            <tr>
                <td colspan="4" class="bold centreado txt-md">Lugar de Nacimiento</td>
            </tr>
            <tr>
                <td class="centreado border-bot">{{ $usuario->pais_nac }}</td>
                <td class="centreado border-bot">{{ $usuario->dpto_nac }}</td>
                <td class="centreado border-bot">{{ $usuario->provincia_nac }}</td>
                <td class="centreado border-bot">{{ $usuario->localidad_nac }}</td>
            </tr>
            <tr>
                <td class="centreado txtinfo">País</td>
                <td class="centreado txtinfo">Departamento</td>
                <td class="centreado txtinfo">Provincia</td>
                <td class="centreado txtinfo">Localidad</td>
            </tr>
        </tbody>
    </table>
    <table class="table-info">
        <tbody>
            <tr>
                <td colspan="4" class="bold centreado txt-md">Certificado de Nacimiento</td>
            </tr>
            <tr>
                <td class="centreado border-bot">{{ $usuario->oficialia }}</td>
                <td class="centreado border-bot">{{ $usuario->libro }}</td>
                <td class="centreado border-bot">{{ $usuario->partida }}</td>
                <td class="centreado border-bot">{{ $usuario->folio }}</td>
            </tr>
            <tr>
                <td class="centreado txtinfo">Oficialía</td>
                <td class="centreado txtinfo">Libro N°</td>
                <td class="centreado txtinfo">Partida N°</td>
                <td class="centreado txtinfo">Folio N°</td>
            </tr>
        </tbody>
    </table>
    <table class="table-info">
        <tbody>
            <tr>
                <td colspan="4" class="bold centreado txt-md">Dirección actual</td>
            </tr>
            <tr>
                <td class="centreado border-bot">{{ $usuario->provincia_dir }}</td>
                <td class="centreado border-bot">{{ $usuario->municipio_dir }}</td>
                <td class="centreado border-bot">{{ $usuario->localidad_dir }}</td>
                <td class="centreado border-bot">{{ $usuario->zona_dir }}</td>
            </tr>
            <tr>
                <td class="centreado txtinfo">Provincia</td>
                <td class="centreado txtinfo">Sección/Municipio</td>
                <td class="centreado txtinfo">Localidad/Comunidad</td>
                <td class="centreado txtinfo">Zona/Villa</td>
            </tr>
            <tr>
                <td class="centreado border-bot">{{ $usuario->avenida_dir }}</td>
                <td class="centreado border-bot">{{ $usuario->fono_dir }}</td>
                <td class="centreado border-bot">{{ $usuario->nro_dir }}</td>
                <td class="centreado"></td>
            </tr>
            <tr>
                <td class="centreado txtinfo">Avenida/Calle</td>
                <td class="centreado txtinfo">Teléfono/Celular</td>
                <td class="centreado txtinfo">Número de vivienda</td>
                <td class="centreado txtinfo"></td>
            </tr>
        </tbody>
    </table>
    <table class="table-info">
        <tbody>
            <tr>
                <td colspan="2" class="bold centreado txt-md">Unidad Educativa de Procedencia</td>
            </tr>
            <tr>
                <td class="centreado border-bot" width="30%">{{ $usuario->codigo_sie_ue }}</td>
                <td class="centreado border-bot">{{ $usuario->ue_procedencia }}</td>
            </tr>
            <tr>
                <td class="centreado txtinfo">Código SIE de la U.E.</td>
                <td class="centreado txtinfo">Nombre de la Unidad Educativa</td>
            </tr>
        </tbody>
    </table>
    <h2 class="subtitulo">2. ASPECTOS SOCIALES</h2>
    <table class="table-info">
        <tbody>
            <tr>
                <td class="txtinfo">¿Cuál es el idioma que aprendio a hablar en su niñez la o el estudiante?</td>
                <td class="txtinfo">¿Qué idiomas habla frecuentemente la o el estudiante?</td>
            </tr>
            <tr>
                <td class="bordeado">{{ $usuario->idioma_niniez }}</td>
                <td class="bordeado">{{ $usuario->idiomas_estudiante }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table-info">
        <tbody>
            <tr>
                <td class="txtinfo">¿Pertenece a alguna nación, pueblo indígena originario campesino o afroboliviano?
                </td>
                <td class="txtinfo">¿Existe Centro de Salud / Posta / Hospital en su comunidad?</td>
                <td class="txtinfo">¿Cuantas veces fue la o el estudiante al centro de salud el año pasado?</td>
            </tr>
            <tr>
                <td class="bordeado">
                    {{ $usuario->pueblo_nacion == 'OTRO' ? $usuario->pueblo_nacion_otro : $usuario->pueblo_nacion }}
                </td>
                <td class="bordeado">{{ $usuario->centro_salud }}</td>
                <td class="bordeado">{{ $usuario->veces_centro_salud }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table-info">
        <tbody>
            <tr>
                <td class="txtinfo">Presenta la o el estudiante alguna discapacidad</td>
                <td class="txtinfo">Su discapacidad es</td>
            </tr>
            <tr>
                <td class="bordeado">
                    {{ $usuario->discapacidad == 'OTRO' ? $usuario->discapacidad_otro : $usuario->discapacidad }}</td>
                <td class="bordeado">{{ $usuario->desc_discapacidad }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table-info">
        <tbody>
            <tr>
                <td class="txtinfo">El agua de su casa proviene de</td>
                <td class="txtinfo">¿La o el estudiante tiene energía eléctrica en su vivienda</td>
                <td class="txtinfo">El baño, water o letrina de su casa tiene desague a</td>
                <td class="txtinfo">¿Realizó la o el estudiante en los últimos 3 meses alguna de las siguientes
                    actividades?</td>
            </tr>
            <tr>
                <td class="bordeado">{{ $usuario->agua }}</td>
                <td class="bordeado">{{ $usuario->energia_electrica }}</td>
                <td class="bordeado">{{ $usuario->banio }}</td>
                <td class="bordeado">{{ $usuario->actividad }}</td>
            </tr>
            <tr>
                <td class="txtinfo">La semana pasada ¿Cuántos días trabajó o ayudó a la familia la o el estudiante</td>
                <td class="txtinfo">¿Recibió algún pago por el trabajo realizado?</td>
                <td class="txtinfo">La o el estudiante accede a internet en</td>
                <td class="txtinfo">¿Con qué frecuencia la o el estudiante accede a internet</td>
            </tr>
            <tr>
                <td class="bordeado">{{ $usuario->dias_trabajo }}</td>
                <td class="bordeado">{{ $usuario->recibio_pago }}</td>
                <td class="bordeado">{{ $usuario->internet }}</td>
                <td class="bordeado">{{ $usuario->frecuencia_internet }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table-info">
        <tbody>
            <tr>
                <td class="txtinfo">¿Cómo llega la o el estudiante a la Unidad Educativa?</td>
                <td class="txtinfo">En el medio de transporte señalado ¿Cuál es el tiempo máximo que demora en llegar
                    de su casa a la Unidad Educativa o viceversa?</td>
            </tr>
            <tr>
                <td class="bordeado">{{ $usuario->llega == 'OTRO MEDIO' ? $usuario->llega_otro : $usuario->llega }}
                </td>
                <td class="bordeado">{{ $usuario->desc_llega }}</td>
            </tr>
        </tbody>
    </table>
    <h2 class="subtitulo">3. DATOS DEL PADRE, MADRE O TUTOR(A) DE LA O EL ESTUDIANTE</h2>
    <table class="table-info">
        <tbody>
            <tr>
                <td colspan="4" class="bold centreado txt-md">Datos del padre tutor(a)</td>
            </tr>
            <tr>
                <td class="txtinfo">Cédula de identidad</td>
                <td class="txtinfo">Apellidos</td>
                <td class="txtinfo">Nombre(s)</td>
                <td class="txtinfo">Idioma que habla frecuente</td>
            </tr>
            <tr>
                <td class="bordeado">{{ $usuario->ci_padre_tutor }}</td>
                <td class="bordeado">{{ $usuario->ap_padre_tutor }}</td>
                <td class="bordeado">{{ $usuario->nom_padre_tutor }}</td>
                <td class="bordeado">{{ $usuario->idioma_padre_tutor }}</td>
            </tr>
            <tr>
                <td class="txtinfo">Ocupación laboral actual</td>
                <td class="txtinfo">Mayor grado de instrucción</td>
                <td class="txtinfo">En caso de tutor(a) ¿Cuál es el parentezco?</td>
                <td class="txtinfo">Fecha de nacimiento</td>
            </tr>
            <tr>
                <td class="bordeado">{{ $usuario->ocupacion_padre_tutor }}</td>
                <td class="bordeado">{{ $usuario->grado_padre_tutor }}</td>
                <td class="bordeado">{{ $usuario->parentezco_padre_tutor }}</td>
                <td class="bordeado">{{ $usuario->fn_tutor }}</td>
            </tr>
            <tr>
                <td class="txtinfo">Sexo</td>
                <td class="txtinfo">Domicilio</td>
                <td class="txtinfo">Celular</td>
                <td class="txtinfo"></td>
            </tr>
            <tr>
                <td class="bordeado">{{ $usuario->s_tutor }}</td>
                <td class="bordeado">{{ $usuario->d_tutor }}</td>
                <td class="bordeado">{{ $usuario->cel_tutor }}</td>
                <td class=""></td>
            </tr>
        </tbody>
    </table>

    <table class="table-info">
        <tbody>
            <tr>
                <td colspan="4" class="bold centreado txt-md">Datos de la madre</td>
            </tr>
            <tr>
                <td class="txtinfo">Cédula de identidad</td>
                <td class="txtinfo">Apellidos</td>
                <td class="txtinfo">Nombre(s)</td>
                <td class="txtinfo">Idioma que habla frecuente</td>
            </tr>
            <tr>
                <td class="bordeado">{{ $usuario->ci_madre }}</td>
                <td class="bordeado">{{ $usuario->ap_madre }}</td>
                <td class="bordeado">{{ $usuario->nom_madre }}</td>
                <td class="bordeado">{{ $usuario->idioma_madre }}</td>
            </tr>
            <tr>
                <td class="txtinfo">Ocupación laboral actual</td>
                <td class="txtinfo">Mayor grado de instrucción</td>
                <td class="txtinfo">En caso de tutor(a) ¿Cuál es el parentezco?</td>
                <td class="txtinfo">Fecha de nacimiento</td>
            </tr>
            <tr>
                <td class="bordeado">{{ $usuario->ocupacion_madre }}</td>
                <td class="bordeado">{{ $usuario->grado_madre }}</td>
                <td class="bordeado">{{ $usuario->parentezco_madre }}</td>
                <td class="bordeado">{{ $usuario->fn_madre && $usuario->fn_madre!='0000-00-00' ? $usuario->fn_madre : '' }}</td>
            </tr>
            <tr>
                <td class="txtinfo">Sexo</td>
                <td class="txtinfo">Domicilio</td>
                <td class="txtinfo">Celular</td>
                <td class="txtinfo"></td>
            </tr>
            <tr>
                <td class="bordeado">{{ $usuario->s_madre }}</td>
                <td class="bordeado">{{ $usuario->d_madre }}</td>
                <td class="bordeado">{{ $usuario->cel_madre }}</td>
                <td class=""></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
