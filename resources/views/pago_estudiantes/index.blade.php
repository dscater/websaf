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
                        {{-- <h3 class="card-title"></h3> --}}
                        <a href="{{route('pago_estudiantes.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> Nuevo</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table data-table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Gestión</th>
                                    <th>Estudiante</th>
                                    <th>Concepto</th>
                                    <th>Monto Bs.</th>
                                    <th>Fecha Pago</th>
                                    <th>Factura A Nombre de</th>
                                    <th>NIT Factura</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pago_estudiantes as $pago_estudiante)
                                <tr>
                                    <td>{{$pago_estudiante->gestion}}</td>
                                    <td>{{$pago_estudiante->estudiante->nombre}} {{$pago_estudiante->estudiante->paterno}} {{$pago_estudiante->estudiante->materno}}</td>
                                    <td>{{$pago_estudiante->concepto}}</td>
                                    <td>{{$pago_estudiante->monto}}</td>
                                    <td>{{$pago_estudiante->fecha_pago}}</td>
                                    <td>{{$pago_estudiante->factura_nombre}}</td>
                                    <td>{{$pago_estudiante->factura_nit}}</td>
                                    <td class="btns-opciones">
                                        @if(Auth::user()->tipo == 'ADMINISTRADOR')
                                        <a href="{{route('pago_estudiantes.factura',$pago_estudiante->id)}}" class="ir-evaluacion" target="blank"><i class="fa fa-file-pdf" data-toggle="tooltip" data-placement="left" title="Imprimir"></i></a>

                                        {{-- <a href="{{route('pago_estudiantes.edit',$pago_estudiante->id)}}" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>
    
                                        <a href="#" data-url="{{route('pago_estudiantes.destroy',$pago_estudiante->id)}}" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a> --}}
                                        @endif
                                    </td>
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
