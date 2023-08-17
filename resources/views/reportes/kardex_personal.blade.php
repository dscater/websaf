<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Kardex</title>
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

        .logo img{
            position: absolute;
            width: 200px;
            height: 90px;
            top:-20px;
            left:-20px;
        }
        .empresa{
            font-size: 1em;
            width: 250px;
            top:-40px;
            left:-20px;
        }
        h4.titulo{
            text-align: center;
            width: 450px;
            margin: auto;
            margin-top:-20px; 
            margin-bottom:15px; 
            text-align: center;
            font-size:12pt;
            color:red!important;
        }

        .texto{
            width: 250px;
            text-align: center;
            margin:auto;
            margin-top:15px; 
            font-weight: bold;
            font-size:1.1em;
        }

        .fecha{
            width: 600px;
            margin-top:-10px; 
            font-weight: normal;
            font-size:0.85em;
            color:green;
            text-align: left!important;
        }

        .total{
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
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
            font-size: 8pt;
        }

        table tbody tr td.franco{
            background:red;
            color:white;
        }

        .centreado{
            padding-left: 0px;
            text-align: center;
        }

        .datos{
            margin-left: 15px;
            border-top:solid 1px;
            border-collapse: collapse;
            width: 250px;
        }

        .txt{
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
        }

        .txt_center{
            text-align: center;
        }

        .cumplimiento{
            position: absolute;
            width: 150px;
            right: 0px;
            top:86px;
        }

        .p_cump{
            color:red;
            font-size: 1.2em;
        }

        .b_top{
            border-top:solid 1px black;
        }

        .gray{
            background: rgb(202, 202, 202);
        }

        .txt_rojo{
        }

        .img_celda{
            border: solid 1px black;
            text-align: center;
        }

        .img_celda img{
            height: 100px;
            width: 100px;
        }

        .seccion{
            color:blue;
            text-decoration: underline;
            font-weight: bold;
            font-size: 10pt;
            font-family: 'Times New Roman', Times, serif;
        }

        .subtitulo{
            position: relative;
            margin-bottom: -15px;
            text-decoration: underline;
            font-weight: bold;
            font-size: 9pt;
            font-family: 'Times New Roman', Times, serif;
        }


        td.caja > div{
            height: 15px;
            width: 100%;
            border:solid 1px black;
            font-size: 9pt;
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            vertical-align: middle;
            padding: 0px!important;
        }

        td.texto > div{
            font-weight: normal;
            font-size: 9pt;
            text-align: center;
            padding: 0px!important;
            margin-top: -20px;
        }

        td.borde{
            border:solid 1px black;
        }

        table.borde_separado{
            border-collapse: separate;
            border-spacing: 4px -1px 0px 0px; 
        }

        span.cuadrado{
            border:solid 1px black;
            padding: 10px; 
        }

        .nueva_pagina{
            page-break-after: always;
        }

        .lugar_fecha{
            font-size: 9pt;
        }

        .border_bot{
            border-bottom: solid 1px black;
        }

        table.firma{
            margin-top: 30px;
            width: 100%;
            position: relative;
            margin-left: 400px;
        }
    </style>
</head>
<body>
    @php
        $empresa = App\RazonSocial::first();
        $contador = 0;
    @endphp
    @if(count($administrativos) > 0)
    @foreach($administrativos as $administrativo)
    <div class="encabezado">
        <h2 class="empresa">
            {{ $empresa->nombre }}
        </h2>
        <h4 class="titulo" align="center">KARDEX PERSONAL GESTIÓN - {{date('Y')}}</h4>
        <h4 class="fecha">(El presente formulario se constituye en una declaración jurada)</h4>
    </div>

    <h2 class="seccion">1. DATOS REFERENCIALES</h2>
    <table style="position:relative;top:-80px;">
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td width="12%"></td>
                <td width="10%"></td>
                <td rowspan="4" class="img_celda">
                    <img src="{{asset('imgs/users/'.$administrativo->foto)}}" alt="Foto">
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="caja">
                    <div>{{$administrativo->paterno}}</div>
                </td>
                <td class="caja">
                    <div>{{$administrativo->materno}}</div>
                </td>
                <td class="caja">
                    <div>{{$administrativo->nombre}}</div>
                </td>
                <td class="caja">
                    <div>{{$administrativo->ci}}</div>
                </td>
                <td class="caja">
                    <div>{{$administrativo->ci_exp}}</div>
                </td>
            </tr>
            <tr>
                <td class="texto">
                    <div>Apellido Paterno</div>
                </td>
                <td class="texto">
                    <div>Apellido Materno</div>
                </td>
                <td class="texto">
                    <div>Apellido Nombres</div>
                </td>
                <td class="texto">
                    <div>C.I.</div>
                </td>
                <td class="texto">
                    <div>Exp.</div>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top:-77px;position: relative;">
        <tbody>
            <tr>
                <td width="24%">Lugar y Fecha de Nacimiento: </td>     
                <td class="borde">
                    {{$administrativo->lugar_nac}} {{$administrativo->fecha_nac}}
                </td>
                <td width="6%">Edad: </td>     
                <td width="5%" class="borde">
                    {{$administrativo->edad}}
                </td>
                <td width="5%">Sexo: </td>     
                <td width="4%" class="borde">
                    {{$administrativo->sexo}}
                </td>
                <td width="8%">E. Civil: </td>     
                <td width="10%" class="borde">
                    {{$administrativo->estado_civil}}
                </td>
            </tr>
        </tbody>
    </table>
    <table style="margin-top:5px;position: relative;" class="borde_separado">
        <tbody>
            <tr>
                <td width="14%">Domicilio Actual: </td>     
                <td class="borde">
                    {{$administrativo->zona}}
                </td>
                <td class="borde">{{$administrativo->avenida}}</td>     
                <td width="5%" class="borde">
                    {{$administrativo->nro}}
                </td>
            </tr>
            <tr>
                <td class="txt_center">
                </td>
                <td class="txt_center">
                    <div>Zona</div>
                </td>
                <td class="txt_center">
                    <div>Avenida / Calle</div>
                </td>
                <td class="txt_center">
                    <div>Nº</div>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="margin-top:5px;position: relative;" class="borde_separado">
        <tbody>
            <tr>
                <td width="22%">Medios de Comunicación: </td>     
                <td class="borde">
                    {{$administrativo->fono}}
                </td>
                <td class="borde">{{$administrativo->cel}}</td>     
                <td width="20%" class="borde">
                    {{$administrativo->email}}
                </td>
            </tr>
            <tr>
                <td class="txt_center">
                </td>
                <td class="txt_center">
                    <div>Teléfono Domicilio</div>
                </td>
                <td class="txt_center">
                    <div>Teléfono Celular</div>
                </td>
                <td class="txt_center">
                    <div>Correo Electrónico</div>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top:5px;position: relative;">
        <tbody>
            <tr>
                <td width="8%">Nº RDA: </td>     
                <td class="borde">
                    {{$administrativo->nro_rda}}
                </td>
                <td width="6%">A.F.P: </td>     
                <td width="18%" class="borde">
                    {{$administrativo->afp}}
                </td>
                <td width="5%">NUA: </td>     
                <td width="18%" class="borde">
                    {{$administrativo->nua}}
                </td>
                <td width="14%">ITEM FISCAL: </td>     
                <td width="15%" class="borde">
                    {{$administrativo->item_fiscal}}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top:5px;position: relative;">
        <tbody>
            <tr>
                <td width="18%">Nº de Seguro Social: </td>     
                <td width="15%" class="borde">
                    {{$administrativo->nro_seguro_social}}
                </td>
                
                <td width="22%">Caja de Seguro Social: </td>     
                <td class="borde">
                    {{$administrativo->caja_seguro_social}}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top:5px;position: relative;">
        <tbody>
            <tr>
                <td width="28%">TITULADO(A) DEL PROFOCOM: : </td>     
                <td width="15%">
                    1º Fase <span class="cuadrado">
                        @if($administrativo->titulado == '1RA FASE')
                        X
                        @endif
                    </span>
                </td>
                <td width="15%">
                    2º Fase <span class="cuadrado">
                        @if($administrativo->titulado == '2DA FASE')
                        X
                        @endif
                    </span>
                </td>
                <td width="15%">
                    3º Fase <span class="cuadrado">
                        @if($administrativo->titulado == '3RA FASE')
                        X
                        @endif
                    </span>
                </td>
                <td width="15%">
                    4º Fase <span class="cuadrado">
                        @if($administrativo->titulado == '4TA FASE')
                        X
                        @endif
                    </span>
                </td>
                <td width="15%">
                    Ninguno <span class="cuadrado">
                        @if($administrativo->titulado == 'NINGUNO')
                        X
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="6">(Marcar con X)</td>
            </tr>
        </tbody>
    </table>

    <h2 class="seccion">2. ESTUDIOS REALIZADOS - FORMACIÓN PROFESIONAL</h2>
    <table border="1">
        <tbody>
            <tr>
                <td>NIVEL</td>
                <td>INSTITUCIÓN</td>
                <td>AÑO EGRESO</td>
                <td>ESPECIALIDAD SEGUN TÍTULO</td>
                <td>Nº DE TÍTULO</td>
            </tr>
            @php
            $secundario = App\AdministrativoEstudio::where('administrativo_id',$administrativo->id)->where('nivel','SECUNDARIO')->get()->first();
            $normal = App\AdministrativoEstudio::where('administrativo_id',$administrativo->id)->where('nivel','NORMAL')->get()->first();
            $universitario = App\AdministrativoEstudio::where('administrativo_id',$administrativo->id)->where('nivel','UNIVERSITARIO')->get()->first();
            $postgrado = App\AdministrativoEstudio::where('administrativo_id',$administrativo->id)->where('nivel','POST GRADO')->get();
            @endphp
            <tr>
                <td>Secundario</td>
                <td>{{$secundario->institucion}}</td>
                <td>{{$secundario->anio_egreso}}</td>
                <td>{{$secundario->especialidad}}</td>
                <td>{{$secundario->nro_titulo}}</td>
            </tr>
            <tr>
                <td>Normal</td>
                <td>{{$normal->institucion}}</td>
                <td>{{$normal->anio_egreso}}</td>
                <td>{{$normal->especialidad}}</td>
                <td>{{$normal->nro_titulo}}</td>
            </tr>
            <tr>
                <td>Universitario</td>
                <td>{{$universitario->institucion}}</td>
                <td>{{$universitario->anio_egreso}}</td>
                <td>{{$universitario->especialidad}}</td>
                <td>{{$universitario->nro_titulo}}</td>
            </tr>
            <tr>
                <td>Post Grado</td>
                <td>{{$postgrado[0]->institucion}}</td>
                <td>{{$postgrado[0]->anio_egreso}}</td>
                <td>{{$postgrado[0]->especialidad}}</td>
                <td>{{$postgrado[0]->nro_titulo}}</td>
            </tr>
            <tr>
                <td>Post Grado</td>
                <td>{{$postgrado[1]->institucion}}</td>
                <td>{{$postgrado[1]->anio_egreso}}</td>
                <td>{{$postgrado[1]->especialidad}}</td>
                <td>{{$postgrado[1]->nro_titulo}}</td>
            </tr>
        </tbody>
    </table>
    <h2 class="subtitulo">Ultimos 3 Cursos de actualización. (Empezar por el último).</h2>
    <table border="1">
        <tbody>
            <tr>
                <td width="5%"></td>
                <td>NOMINACIÓN DEL CURSO</td>
                <td>INSTITUCIÓN</td>
                <td>DURACIÓN</td>
                <td>FECHA - PERIODO</td>
            </tr>
            @php
            $cursos = App\AdministrativoCurso::where('administrativo_id',$administrativo->id)->get();
            @endphp
            <tr>
                <td>1</td>
                <td>{{$cursos[0]->nominacion}}</td>
                <td>{{$cursos[0]->institucion}}</td>
                <td>{{$cursos[0]->duracion}}</td>
                <td>{{$cursos[0]->fecha}}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>{{$cursos[1]->nominacion}}</td>
                <td>{{$cursos[1]->institucion}}</td>
                <td>{{$cursos[1]->duracion}}</td>
                <td>{{$cursos[1]->fecha}}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>{{$cursos[2]->nominacion}}</td>
                <td>{{$cursos[2]->institucion}}</td>
                <td>{{$cursos[2]->duracion}}</td>
                <td>{{$cursos[2]->fecha}}</td>
            </tr>
        </tbody>
    </table>

    <h2 class="seccion">3. DATOS REFERENTES AL COLEGIO PARTICULAR AAA.</h2>
    <table style="margin-top:5px;position: relative;">
        <tbody>
            <tr>
                <td width="23%">Gestiones que trabajó: </td>     
                <td class="borde">
                    {{$administrativo->gestiones_trabajo}}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top:5px;position: relative;">
        <tbody>
            <tr>
                <td width="18%">Cargo que regenta: </td>     
                <td class="borde">
                    {{$administrativo->cargo}}
                </td>
                <td width="8%">mes: </td>     
                <td class="borde">
                    {{$administrativo->mes}}
                </td>
            </tr>
        </tbody>
    </table>
    <h2 class="seccion">4. OTROS DATOS.</h2>
    <h2 class="subtitulo">Otros Colegios o Instituciones donde trabaja actualmente (no incluir a la U.E.P. AAA):</h2>
    <table border="1">
        <tbody>
            <tr>
                <td width="5%">Nº</td>
                <td>NOMBRE DE LA INSTITUCIÓN</td>
                <td>TURNO</td>
                <td>ZONA</td>
                <td>CARGO</td>
                <td>TOTAL, HORAS</td>
            </tr>
            @php
            $otros = App\AdministrativoOtro::where('administrativo_id',$administrativo->id)->get();
            @endphp
            <tr>
                <td>1</td>
                <td>{{$otros[0]->institucion}}</td>
                <td>{{$otros[0]->turno}}</td>
                <td>{{$otros[0]->zona}}</td>
                <td>{{$otros[0]->cargo}}</td>
                <td>{{$otros[0]->total_horas}}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>{{$otros[1]->institucion}}</td>
                <td>{{$otros[1]->turno}}</td>
                <td>{{$otros[1]->zona}}</td>
                <td>{{$otros[1]->cargo}}</td>
                <td>{{$otros[1]->total_horas}}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>{{$otros[2]->institucion}}</td>
                <td>{{$otros[2]->turno}}</td>
                <td>{{$otros[2]->zona}}</td>
                <td>{{$otros[2]->cargo}}</td>
                <td>{{$otros[2]->total_horas}}</td>
            </tr>
        </tbody>
    </table>
    <h2 class="subtitulo">Colegios o Instituciones donde trabajó (empezar por el último):</h2>
    <table border="1">
        <tbody>
            <tr>
                <td width="5%">Nº</td>
                <td>NOMBRE DE LA INSTITUCIÓN</td>
                <td>GESTION(ES)</td>
                <td>CARGO</td>
            </tr>
            @php
            $trabajos = App\AdministrativoTrabajo::where('administrativo_id',$administrativo->id)->get();
            @endphp
            <tr>
                <td>1</td>
                <td>{{$trabajos[0]->institucion}}</td>
                <td>{{$trabajos[0]->gestion}}</td>
                <td>{{$trabajos[0]->cargo}}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>{{$trabajos[1]->institucion}}</td>
                <td>{{$trabajos[1]->gestion}}</td>
                <td>{{$trabajos[1]->cargo}}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>{{$trabajos[2]->institucion}}</td>
                <td>{{$trabajos[2]->gestion}}</td>
                <td>{{$trabajos[2]->cargo}}</td>
            </tr>
        </tbody>
    </table>

    <p class="lugar_fecha">LUGAR Y FECHA: {{ $empresa->ciudad}}, {{date('d')}} de {{$array_meses[date('m')]}} de {{date('Y')}}</p>

    <table class="firma">
        <tbody>
            <tr>
                <td class="border_bot"></td>
                <td></td>
            </tr>
            <tr>
                <td class="txt_center">Firma profesor(a)</td>
                <td class="txt_center">Vº Bº DIRECCIÓN</td>
            </tr>
        </tbody>
    </table>

    <table border="1">
        <tbody>
            <tr>
                <td class="txt_center" width="20%">
                    <span class="subrrayado bold">Observaciones</span><br>
                    (uso exclusivo de la Dirección):
                </td>
                <td>{{$administrativo->observaciones}}</td>
            </tr>
        </tbody>
    </table>

        @php
            $contador++;
        @endphp
        @if(count($profesors) > 0)
        <div class="nueva_pagina"></div>
        @else
            @if($contador < count($administrativos))
            <div class="nueva_pagina"></div>
            @endif
        @endif
    @endforeach
    @endif

    {{-- ******************************************
       SECCION PROFESORES - KARDEXPROFESOR
    ********************************************** --}}

    @php
        $contador = 0;
    @endphp
    @if(count($profesors) > 0)
    @foreach($profesors as $profesor)
    <div class="encabezado">
        <h2 class="empresa">
            {{ $empresa->nombre }}
        </h2>
        <h4 class="titulo" align="center">KARDEX PERSONAL GESTIÓN - {{date('Y')}}</h4>
        <h4 class="fecha">(El presente formulario se constituye en una declaración jurada)</h4>
    </div>

    <h2 class="seccion">1. DATOS REFERENCIALES</h2>
    <table style="position:relative;top:-80px;">
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td width="12%"></td>
                <td width="10%"></td>
                <td rowspan="4" class="img_celda">
                    <img src="{{asset('imgs/users/'.$profesor->foto)}}" alt="Foto">
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="caja">
                    <div>{{$profesor->paterno}}</div>
                </td>
                <td class="caja">
                    <div>{{$profesor->materno}}</div>
                </td>
                <td class="caja">
                    <div>{{$profesor->nombre}}</div>
                </td>
                <td class="caja">
                    <div>{{$profesor->ci}}</div>
                </td>
                <td class="caja">
                    <div>{{$profesor->ci_exp}}</div>
                </td>
            </tr>
            <tr>
                <td class="texto">
                    <div>Apellido Paterno</div>
                </td>
                <td class="texto">
                    <div>Apellido Materno</div>
                </td>
                <td class="texto">
                    <div>Apellido Nombres</div>
                </td>
                <td class="texto">
                    <div>C.I.</div>
                </td>
                <td class="texto">
                    <div>Exp.</div>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top:-77px;position: relative;">
        <tbody>
            <tr>
                <td width="24%">Lugar y Fecha de Nacimiento: </td>     
                <td class="borde">
                    {{$profesor->lugar_nac}} {{$profesor->fecha_nac}}
                </td>
                <td width="6%">Edad: </td>     
                <td width="5%" class="borde">
                    {{$profesor->edad}}
                </td>
                <td width="5%">Sexo: </td>     
                <td width="4%" class="borde">
                    {{$profesor->sexo}}
                </td>
                <td width="8%">E. Civil: </td>     
                <td width="10%" class="borde">
                    {{$profesor->estado_civil}}
                </td>
            </tr>
        </tbody>
    </table>
    <table style="margin-top:5px;position: relative;" class="borde_separado">
        <tbody>
            <tr>
                <td width="14%">Domicilio Actual: </td>     
                <td class="borde">
                    {{$profesor->zona}}
                </td>
                <td class="borde">{{$profesor->avenida}}</td>     
                <td width="5%" class="borde">
                    {{$profesor->nro}}
                </td>
            </tr>
            <tr>
                <td class="txt_center">
                </td>
                <td class="txt_center">
                    <div>Zona</div>
                </td>
                <td class="txt_center">
                    <div>Avenida / Calle</div>
                </td>
                <td class="txt_center">
                    <div>Nº</div>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="margin-top:5px;position: relative;" class="borde_separado">
        <tbody>
            <tr>
                <td width="22%">Medios de Comunicación: </td>     
                <td class="borde">
                    {{$profesor->fono}}
                </td>
                <td class="borde">{{$profesor->cel}}</td>     
                <td width="20%" class="borde">
                    {{$profesor->email}}
                </td>
            </tr>
            <tr>
                <td class="txt_center">
                </td>
                <td class="txt_center">
                    <div>Teléfono Domicilio</div>
                </td>
                <td class="txt_center">
                    <div>Teléfono Celular</div>
                </td>
                <td class="txt_center">
                    <div>Correo Electrónico</div>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top:5px;position: relative;">
        <tbody>
            <tr>
                <td width="8%">Nº RDA: </td>     
                <td class="borde">
                    {{$profesor->nro_rda}}
                </td>
                <td width="6%">A.F.P: </td>     
                <td width="18%" class="borde">
                    {{$profesor->afp}}
                </td>
                <td width="5%">NUA: </td>     
                <td width="18%" class="borde">
                    {{$profesor->nua}}
                </td>
                <td width="14%">ITEM FISCAL: </td>     
                <td width="15%" class="borde">
                    {{$profesor->item_fiscal}}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top:5px;position: relative;">
        <tbody>
            <tr>
                <td width="18%">Nº de Seguro Social: </td>     
                <td width="15%" class="borde">
                    {{$profesor->nro_seguro_social}}
                </td>
                
                <td width="22%">Caja de Seguro Social: </td>     
                <td class="borde">
                    {{$profesor->caja_seguro_social}}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top:5px;position: relative;">
        <tbody>
            <tr>
                <td width="28%">TITULADO(A) DEL PROFOCOM: : </td>     
                <td width="15%">
                    1º Fase <span class="cuadrado">
                        @if($profesor->titulado == '1RA FASE')
                        X
                        @endif
                    </span>
                </td>
                <td width="15%">
                    2º Fase <span class="cuadrado">
                        @if($profesor->titulado == '2DA FASE')
                        X
                        @endif
                    </span>
                </td>
                <td width="15%">
                    3º Fase <span class="cuadrado">
                        @if($profesor->titulado == '3RA FASE')
                        X
                        @endif
                    </span>
                </td>
                <td width="15%">
                    4º Fase <span class="cuadrado">
                        @if($profesor->titulado == '4TA FASE')
                        X
                        @endif
                    </span>
                </td>
                <td width="15%">
                    Ninguno <span class="cuadrado">
                        @if($profesor->titulado == 'NINGUNO')
                        X
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="6">(Marcar con X)</td>
            </tr>
        </tbody>
    </table>

    <h2 class="seccion">2. ESTUDIOS REALIZADOS - FORMACIÓN PROFESIONAL</h2>
    <table border="1">
        <tbody>
            <tr>
                <td>NIVEL</td>
                <td>INSTITUCIÓN</td>
                <td>AÑO EGRESO</td>
                <td>ESPECIALIDAD SEGUN TÍTULO</td>
                <td>Nº DE TÍTULO</td>
            </tr>
            @php
            $secundario = App\profesorEstudio::where('profesor_id',$profesor->id)->where('nivel','SECUNDARIO')->get()->first();
            $normal = App\profesorEstudio::where('profesor_id',$profesor->id)->where('nivel','NORMAL')->get()->first();
            $universitario = App\profesorEstudio::where('profesor_id',$profesor->id)->where('nivel','UNIVERSITARIO')->get()->first();
            $postgrado = App\profesorEstudio::where('profesor_id',$profesor->id)->where('nivel','POST GRADO')->get();
            @endphp
            <tr>
                <td>Secundario</td>
                <td>{{$secundario->institucion}}</td>
                <td>{{$secundario->anio_egreso}}</td>
                <td>{{$secundario->especialidad}}</td>
                <td>{{$secundario->nro_titulo}}</td>
            </tr>
            <tr>
                <td>Normal</td>
                <td>{{$normal->institucion}}</td>
                <td>{{$normal->anio_egreso}}</td>
                <td>{{$normal->especialidad}}</td>
                <td>{{$normal->nro_titulo}}</td>
            </tr>
            <tr>
                <td>Universitario</td>
                <td>{{$universitario->institucion}}</td>
                <td>{{$universitario->anio_egreso}}</td>
                <td>{{$universitario->especialidad}}</td>
                <td>{{$universitario->nro_titulo}}</td>
            </tr>
            <tr>
                <td>Post Grado</td>
                <td>{{$postgrado[0]->institucion}}</td>
                <td>{{$postgrado[0]->anio_egreso}}</td>
                <td>{{$postgrado[0]->especialidad}}</td>
                <td>{{$postgrado[0]->nro_titulo}}</td>
            </tr>
            <tr>
                <td>Post Grado</td>
                <td>{{$postgrado[1]->institucion}}</td>
                <td>{{$postgrado[1]->anio_egreso}}</td>
                <td>{{$postgrado[1]->especialidad}}</td>
                <td>{{$postgrado[1]->nro_titulo}}</td>
            </tr>
        </tbody>
    </table>
    <h2 class="subtitulo">Ultimos 3 Cursos de actualización. (Empezar por el último).</h2>
    <table border="1">
        <tbody>
            <tr>
                <td width="5%"></td>
                <td>NOMINACIÓN DEL CURSO</td>
                <td>INSTITUCIÓN</td>
                <td>DURACIÓN</td>
                <td>FECHA - PERIODO</td>
            </tr>
            @php
            $cursos = App\profesorCurso::where('profesor_id',$profesor->id)->get();
            @endphp
            <tr>
                <td>1</td>
                <td>{{$cursos[0]->nominacion}}</td>
                <td>{{$cursos[0]->institucion}}</td>
                <td>{{$cursos[0]->duracion}}</td>
                <td>{{$cursos[0]->fecha}}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>{{$cursos[1]->nominacion}}</td>
                <td>{{$cursos[1]->institucion}}</td>
                <td>{{$cursos[1]->duracion}}</td>
                <td>{{$cursos[1]->fecha}}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>{{$cursos[2]->nominacion}}</td>
                <td>{{$cursos[2]->institucion}}</td>
                <td>{{$cursos[2]->duracion}}</td>
                <td>{{$cursos[2]->fecha}}</td>
            </tr>
        </tbody>
    </table>

    <h2 class="seccion">3. DATOS REFERENTES AL COLEGIO PARTICULAR AAA.</h2>
    <table style="margin-top:5px;position: relative;">
        <tbody>
            <tr>
                <td width="23%">Gestiones que trabajó: </td>     
                <td class="borde">
                    {{$profesor->gestiones_trabajo}}
                </td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top:5px;position: relative;">
        <tbody>
            <tr>
                <td width="18%">Cargo que regenta: </td>     
                <td class="borde">
                    {{$profesor->cargo}}
                </td>
                <td width="8%">mes: </td>     
                <td class="borde">
                    {{$profesor->mes}}
                </td>
            </tr>
        </tbody>
    </table>
    <h2 class="seccion">4. OTROS DATOS.</h2>
    <h2 class="subtitulo">Otros Colegios o Instituciones donde trabaja actualmente (no incluir a la U.E.P. AAA):</h2>
    <table border="1">
        <tbody>
            <tr>
                <td width="5%">Nº</td>
                <td>NOMBRE DE LA INSTITUCIÓN</td>
                <td>TURNO</td>
                <td>ZONA</td>
                <td>CARGO</td>
                <td>TOTAL, HORAS</td>
            </tr>
            @php
            $otros = App\profesorOtro::where('profesor_id',$profesor->id)->get();
            @endphp
            <tr>
                <td>1</td>
                <td>{{$otros[0]->institucion}}</td>
                <td>{{$otros[0]->turno}}</td>
                <td>{{$otros[0]->zona}}</td>
                <td>{{$otros[0]->cargo}}</td>
                <td>{{$otros[0]->total_horas}}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>{{$otros[1]->institucion}}</td>
                <td>{{$otros[1]->turno}}</td>
                <td>{{$otros[1]->zona}}</td>
                <td>{{$otros[1]->cargo}}</td>
                <td>{{$otros[1]->total_horas}}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>{{$otros[2]->institucion}}</td>
                <td>{{$otros[2]->turno}}</td>
                <td>{{$otros[2]->zona}}</td>
                <td>{{$otros[2]->cargo}}</td>
                <td>{{$otros[2]->total_horas}}</td>
            </tr>
        </tbody>
    </table>
    <h2 class="subtitulo">Colegios o Instituciones donde trabajó (empezar por el último):</h2>
    <table border="1">
        <tbody>
            <tr>
                <td width="5%">Nº</td>
                <td>NOMBRE DE LA INSTITUCIÓN</td>
                <td>GESTION(ES)</td>
                <td>CARGO</td>
            </tr>
            @php
            $trabajos = App\profesorTrabajo::where('profesor_id',$profesor->id)->get();
            @endphp
            <tr>
                <td>1</td>
                <td>{{$trabajos[0]->institucion}}</td>
                <td>{{$trabajos[0]->gestion}}</td>
                <td>{{$trabajos[0]->cargo}}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>{{$trabajos[1]->institucion}}</td>
                <td>{{$trabajos[1]->gestion}}</td>
                <td>{{$trabajos[1]->cargo}}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>{{$trabajos[2]->institucion}}</td>
                <td>{{$trabajos[2]->gestion}}</td>
                <td>{{$trabajos[2]->cargo}}</td>
            </tr>
        </tbody>
    </table>

    <p class="lugar_fecha">LUGAR Y FECHA: {{ $empresa->ciudad}}, {{date('d')}} de {{$array_meses[date('m')]}} de {{date('Y')}}</p>

    <table class="firma">
        <tbody>
            <tr>
                <td class="border_bot"></td>
                <td></td>
            </tr>
            <tr>
                <td class="txt_center">Firma profesor(a)</td>
                <td class="txt_center">Vº Bº DIRECCIÓN</td>
            </tr>
        </tbody>
    </table>

    <table border="1">
        <tbody>
            <tr>
                <td class="txt_center" width="20%">
                    <span class="subrrayado bold">Observaciones</span><br>
                    (uso exclusivo de la Dirección):
                </td>
                <td>{{$profesor->observaciones}}</td>
            </tr>
        </tbody>
    </table>

        @php
            $contador++;
        @endphp
        @if($contador < count($profesors))
        <div class="nueva_pagina"></div>
        @endif
    @endforeach
    @endif
</body>
</html>