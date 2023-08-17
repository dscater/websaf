@extends('layouts.app')

@section('background-image')
{{-- style="background-image:url({{asset('imgs/fondo.jpg')}})" --}}
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Inicio</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right bg-white">
                    <li class="breadcrumb-item active">Inicio</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if(Auth::user()->tipo == 'ADMINISTRADOR')
        @include('includes.home.home_admin')
        @endif
        @if(Auth::user()->tipo == 'PROFESOR')
        @include('includes.home.home_profesor')
        @endif
        @if(Auth::user()->tipo == 'ESTUDIANTE')
        @include('includes.home.home_estudiante')
        @endif
        @if(Auth::user()->tipo == 'SECRETARIA ACADÉMICA')
        @include('includes.home.home_secretaria')
        @endif
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->

@endsection

@section('scripts')
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


    $('table.data-table1').DataTable({
        order:[0,'desc'],
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
        pageLength:10
    });

    // ELIMINAR
    $(document).on('click','table.data-table1 tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let solicitud = $(this).parents('tr').children('td').eq(2).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar la solicitud del lector <b>${solicitud}</b>?<h4>Estación no se podra deshacer después</h4>`);
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formEliminar').prop('action',url);
    });

    $('table.data-table2').DataTable({
        order:[0,'desc'],
        columns : [
            {width:"5%"},
            null,
            null,
            null,
            null,
            {width:"16%"},
        ],
        scrollCollapse: true,
        language: lenguaje,
        pageLength:10
    });
    // ELIMINAR
    $(document).on('click','table.data-table2 tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let prestamo = $(this).parents('tr').children('td').eq(1).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el prestamo <b>${prestamo}</b>?`);
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formEliminar').prop('action',url);
    });

    // DEVOLUCIÓN PRESTAMO
    $(document).on('click','table.data-table2 tbody tr td.btns-opciones a.ir-evaluacion',function(e){
        e.preventDefault();
        let url = $(this).attr('data-url');
        let id = $(this).attr('data-id');

        $.ajax({
            type: "GET",
            url: $('#urlInfoPrestamo').val(),
            data: {
                id : id
            },
            dataType: "json",
            success: function (response) {
                $('#mensaje_devolucion').html(`
                    <b>Fecha préstamo:</b> ${response.prestamo.fecha_registro}<br>
                    <hr>
                    <b>Título:</b> ${response.libro.titulo}<br>
                    <b>Tipo:</b> ${response.libro.tipo}<br>
                    <b>Autor:</b> ${response.autor.nombre}<br>
                    <b>Editorial:</b> ${response.editorial.nombre}<br>
                    <b>Volumen:</b> ${response.volumen.nombre}
                    <hr>
                    <b>Nombre Lector:</b> ${response.lector.nombre} ${response.lector.apellidos}<br>
                    <b>C.I.:</b> ${response.lector.ci} ${response.lector.ci_exp}<br>
                    <b>Celular:</b> ${response.lector.cel}<br>
                    `);
                    $('#modal-devolucion').modal('show');
            }
        });

        $('#formRegistraDevolucion').attr('action',url);

    });

    $('#btnRegistraDevolucion').click(function(){
        $('#formRegistraDevolucion').submit();
    });

    $('#btnEliminar').click(function(){
        $('#formEliminar').submit();
    });

</script>
<script src="{{asset('js/home.js')}}"></script>
<script src="{{asset('js/reloj.js')}}"></script>
@endsection


