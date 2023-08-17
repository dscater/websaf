@extends('layouts.app')

@section('css')
<style>
    table tbody tr td{
        vertical-align: middle!important;
    }
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Asistencias</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Asistencias</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{Form::open(['route'=>'asistencias.store','method'=>'post'])}}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Seleccionar profesor</label>
                                    {{Form::select('user_id',$array_profesors,null,['class'=>'form-control','id'=>'select_profesor'])}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Acción</label>
                                    {{Form::text('accion',null,['class'=>'form-control','readonly','id'=>'accion'])}}
                                </div>
                            </div>
                            <input type="hidden" id="fecha" name="fecha" value="{{date('Y-m-d')}}">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Hora</label>
                                    {{Form::time('hora',date('H:i:s'),['class'=>'form-control','readonly','id'=>'hora'])}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" id="btnRegistraAsistencia" class="btn btn-primary">Registrar asistencia</button>
                                </div>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">Asistencias</h3><br>
                        <div class="row">
                            <div class="col-md-4">
                                {{Form::text('txtNomProfesor',null,['class'=>'form-control','id'=>'txtNomProfesor','placeholder'=>'Nombre Profesor'])}}
                            </div>
                            <div class="col-md-4">
                                {{Form::select('selectMes',[
                                    '01' => 'Enero',
                                    '02' => 'Febrero',
                                    '03' => 'Marzo',
                                    '04' => 'Abril',
                                    '05' => 'Mayo',
                                    '06' => 'Junio',
                                    '07' => 'Julio',
                                    '08' => 'Agosto',
                                    '09' => 'Septiembre',
                                    '10' => 'Octubre',
                                    '11' => 'Noviembre',
                                    '12' => 'Diciembre',
                                ],date('m'),['class'=>'form-control','id'=>'selectMes'])}}
                            </div>
                            <div class="col-md-4">
                                {{Form::select('selectAnio',$array_gestiones,date('Y'),['class'=>'form-control','id'=>'selectAnio'])}}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered custom-table table-nowrap mb-0">
                            <thead>
                                <tr id="header_asistencias" class="bg-dark">
                                    
                                </tr>
                            </thead>
                            <tbody id="contenedorAsistencias">
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>

<input type="hidden" id="urlAsistencias" value="{{route('asistencias.index')}}">
<input type="hidden" id="urlGetAccion" value="{{route('asistencias.getAccion')}}">
<input type="hidden" id="urlStoreAsistencia" value="{{route('asistencias.store')}}">
@endsection

@section('scripts')
<script src="{{asset('js/asistencias/index.js')}}"></script>
<script>
    @if(session('bien'))
    mensajeNotificacion('{{session('bien')}}','success');
    @endif

    @if(session('info'))
    mensajeNotificacion('{{session('info')}}','info');
    @endif

    @if(session('error'))
    mensajeNotificacion('{{session('error')}}','error');
    @endif

    reloj();
    setInterval(reloj,1000);
    $('#select_profesor').change(function(){
        if($(this).val() != ''){
            $('#accion').val('...');
            $.ajax({
                type: "GET",
                url: $('#urlGetAccion').val(),
                data: {
                    fecha : $('#fecha').val(),
                    user_id : $('#select_profesor').val()
                },
                dataType: "json",
                success: function (response) {
                    if(response != 'REGISTRADO'){
                        $('#accion').val(response);
                    }else{
                        $('#accion').val('');
                        mensajeNotificacion('El profesor que seleccionó ya tiene su Ingreso y Salida registrados.','info');
                    }
                }
            });
        }else{
            $('#accion').val('');
        }
    });

    function reloj() {
        let fecha = new Date();
        let dia_semana = fecha.getDay()
        let dia = fecha.getDate()
        let mes = fecha.getMonth()
        let anio = fecha.getFullYear()
        let hora = fecha.getHours()
        let minuto = fecha.getMinutes()
        let segundo = fecha.getSeconds()
        let fecha_texto = null;
        let hora_texto = null;

        let array_meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        let array_dias_semana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        fecha_texto = `${array_dias_semana[dia_semana]} ${dia} de ${array_meses[mes]} del ${anio}`;

        if (hora < 10) {
            hora = '0' + hora;
        }

        if (minuto < 10) {
            minuto = '0' + minuto;
        }

        if (segundo < 10) {
            segundo = '0' + segundo;
        }


        hora_texto = `${hora}:${minuto}:${segundo}`;

        if (dia < 10) {
            dia = '0' + dia;
        }

        mes++;

        if (mes < 10) {
            mes = '0' + mes;
        }

        fecha_bd = `${anio}-${mes}-${dia}`;

        // txtFecha.text(fecha_texto);
        $('#hora').val(hora_texto);
    }

</script>
@endsection
