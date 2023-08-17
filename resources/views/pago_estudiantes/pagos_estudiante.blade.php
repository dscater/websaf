@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pagos Estudiantes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Pagos Estudiantes</li>
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
                    <div class="card-header">
                        <h3 class="card-title">Lista de Pagos - {{$estudiante->paterno}} {{$estudiante->materno}} {{$estudiante->nombre}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table data-table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Gestión</th>
                                    <th>Concepto</th>
                                    <th>Monto Bs.</th>
                                    <th>Fecha Pago</th>
                                    <th>Factura A Nombre de</th>
                                    <th>NIT Factura</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pago_estudiantes as $pago_estudiante)
                                <tr>
                                    <td>{{$pago_estudiante->gestion}}</td>
                                    <td>{{$pago_estudiante->concepto}}</td>
                                    <td>{{$pago_estudiante->monto}}</td>
                                    <td>{{$pago_estudiante->fecha_pago}}</td>
                                    <td>{{$pago_estudiante->factura_nombre}}</td>
                                    <td>{{$pago_estudiante->factura_nit}}</td>
                                </tr>
                                @endforeach
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

@include('modal.eliminar')

@section('scripts')
<script>
    @if(session('url_factura'))
    window.open('{{session('url_factura')}}');
    @endif

    @if(session('bien'))
    mensajeNotificacion('{{session('bien')}}','success');
    @endif

    @if(session('info'))
    mensajeNotificacion('{{session('info')}}','info');
    @endif

    @if(session('error'))
    mensajeNotificacion('{{session('error')}}','error');
    @endif


     $('table.data-table').DataTable({
         order:[
             [0,'desc']
         ],
        columns : [
            {width:"5%"},
            null,
            null,
            null,
            null,
            {width:"15%"},
        ],
        scrollCollapse: true,
        language: lenguaje,
        pageLength:25
    });

 
    // ELIMINAR
    $(document).on('click','table tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let pago = $(this).parents('tr').children('td').eq(2).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el registro de <b>${pago}</b>?`);
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formEliminar').prop('action',url);
    });

    $('#btnEliminar').click(function(){
        $('#formEliminar').submit();
    });

</script>
@endsection

@endsection
