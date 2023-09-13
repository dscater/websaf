@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Administrativos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Administrativos</li>
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
                            <a href="{{ route('administrativos.create') }}" class="btn btn-info"><i class="fa fa-plus"></i>
                                Nuevo</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table data-table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Usuario</th>
                                        <th>Nombre</th>
                                        <th>C.I.</th>
                                        <th>Teléfono/Celular</th>
                                        <th>Correo</th>
                                        <th>Foto</th>
                                        <th>Tipo</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $cont++ }}</td>
                                            <td>{{ $usuario->user ? $usuario->user->name : 'NINGUNO' }}</td>
                                            <td>{{ $usuario->nombre }} {{ $usuario->paterno }} {{ $usuario->materno }}</td>
                                            <td>{{ $usuario->ci }} {{ $usuario->ci_exp }}</td>
                                            <td>{{ $usuario->fono }} / {{ $usuario->cel }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td><img src="{{ file_exists(public_path('imgs/users/' . $usuario->foto)) ? asset('imgs/users/' . $usuario->foto) : asset('imgs/users/user_default.png') }}"
                                                    alt="Foto" class="img-table"></td>
                                            <td>{{ $usuario->user ? $usuario->user->tipo : '' }}</td>
                                            <td class="btns-opciones">
                                                @if (!$usuario->user)
                                                    <a href="{{ route('reportes.kardex_personal') }}?filtro=individual&personal={{ $usuario->id }}-a"
                                                        class="evaluar" target="_blank"><i class="far fa-list-alt"
                                                            data-toggle="tooltip" data-placement="left"
                                                            title="Kardex"></i></a>
                                                @endif

                                                <a href="{{ route('administrativos.edit', $usuario->id) }}"
                                                    class="modificar"><i class="fa fa-edit" data-toggle="tooltip"
                                                        data-placement="left" title="Modificar"></i></a>

                                                <a href="#"
                                                    data-url="{{ route('administrativos.destroy', $usuario->id) }}"
                                                    data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i
                                                        class="fa fa-trash" data-toggle="tooltip" data-placement="left"
                                                        title="Eliminar"></i></a>
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
@endsection

@section('scripts')
    <script>
        @if (session('bien'))
            mensajeNotificacion('{{ session('bien') }}', 'success');
        @endif

        @if (session('info'))
            mensajeNotificacion('{{ session('info') }}', 'info');
        @endif

        @if (session('error'))
            mensajeNotificacion('{{ session('error') }}', 'error');
        @endif

        $('table.data-table').DataTable({
            columns: [{
                    width: "5%"
                },
                {
                    width: "10%"
                },
                null,
                null,
                null,
                {
                    width: "10%"
                },
                {
                    width: "14%"
                },
                {
                    width: "15%"
                },
                {
                    width: "10%"
                },
            ],
            scrollCollapse: true,
            language: lenguaje,
            pageLength: 25
        });


        // ELIMINAR
        $(document).on('click', 'table tbody tr td.btns-opciones a.eliminar', function(e) {
            e.preventDefault();
            let usuario = $(this).parents('tr').children('td').eq(2).text();
            $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el registro <b>${usuario}</b>?`);
            let url = $(this).attr('data-url');
            console.log($(this).attr('data-url'));
            $('#formEliminar').prop('action', url);
        });

        $('#btnEliminar').click(function() {
            $('#formEliminar').submit();
        });
    </script>
@endsection
