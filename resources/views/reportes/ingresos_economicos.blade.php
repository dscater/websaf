<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>IngresosEconómicos</title>
    <style type="text/css">
        *{
            font-family: sans-serif;
        }

        @page {
            margin-top: 2cm;
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
        h2.titulo{
            width: 450px;
            margin: auto;
            margin-top:15px; 
            margin-bottom:15px; 
            text-align: center;
            font-size:14pt;
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
            width: 250px;
            text-align: center;
            margin:auto;
            margin-top:15px; 
            font-weight: normal;
            font-size:0.85em;
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
            font-size: 0.7em;
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
            font-weight: bold;
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

        .img_celda img{
            width: 45px;
        }

        table.info{
            position: relative;
            width: 80%;
            margin:auto;
        }

        .txt_derecha{
            text-align: right;
        }

    </style>
</head>
<body>
    <div class="encabezado">
        <div class="logo">
            <img src="{{ asset('imgs/'.App\RazonSocial::first()->logo) }}">
        </div>
        <h2 class="titulo">
            {{ App\RazonSocial::first()->nombre }}
        </h2>
        <h4 class="texto">INGRESOS ECONÓMICOS</h4>
        <h4 class="fecha">Expedido: {{date('Y-m-d')}}</h4>
        <br>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th width="12%">Fecha Pago</th>
                <th>Concepto</th>
                <th>Factura a Nombre</th>
                <th>Factura NIT</th>
                <th width="10%">Monto Bs.</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
                $suma_total = 0;
            @endphp
            @foreach($pagos as $pago)
            @php
                $suma_total += (double)$pago->monto;
            @endphp
            <tr>
                <td class="txt_center">{{$pago->fecha_registro}}</td>
                <td>{{$pago->concepto}}</td>
                <td>{{$pago->factura_nombre}}</td>
                <td>{{$pago->factura_nit}}</td>
                <td class="txt_center">{{number_formaT($pago->monto,2,'.','')}}</td>
            </tr>
            @endforeach
            @php
                $suma_total = number_format($suma_total,2,'.','');
            @endphp
            <tr>
                <td colspan="4" class="txt_derecha total">TOTAL</td>
                <td class="total txt_center">{{$suma_total}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>