@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Estudiantes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Estudiantes</li>
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
                            <a href="{{ route('estudiantes.create') }}" class="btn btn-info"><i class="fa fa-plus"></i>
                                Nuevo</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table data-table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre Estudiante</th>
                                        <th>Usuario</th>
                                        <th>Foto</th>
                                        <th>Nro. Documento</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Padre/Tutor</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $estudiante)
                                        <tr>
                                            <td>{{ $estudiante->paterno }} {{ $estudiante->materno }}
                                                {{ $estudiante->nombre }}</td>
                                            <td>{{ $estudiante->user->name }}</td>
                                            <td><img src="{{ file_exists(public_path('imgs/users/' . $estudiante->foto)) ? asset('imgs/users/' . $estudiante->foto) : asset('imgs/users/user_default.png') }}"
                                                    alt="Foto del estudiante" class="img-table">
                                            </td>
                                            <td>{{ $estudiante->nro_doc }} {{ $estudiante->ci_exp }}</td>
                                            <td>{{ $estudiante->fono_dir }}</td>
                                            <td>{{ $estudiante->provincia }}, {{ $estudiante->zona_dir }}
                                                {{ $estudiante->municipio_dir }} {{ $estudiante->avenida_dir }}
                                                {{ $estudiante->localidad_dir }} {{ $estudiante->nro_dir }}</td>
                                            <td>{{ $estudiante->ap_padre_tutor }} {{ $estudiante->nom_padre_tutor }}</td>
                                            <td class="btns-opciones">
                                                <a href="{{ route('estudiantes.asistencias', $estudiante->id) }}"
                                                    class="ir-evaluacion"><i class="far fa-list-alt" data-toggle="tooltip"
                                                        data-placement="left" title="Asistencias"></i></a>
                                                @if (Auth::user()->tipo == 'ADMINISTRADOR')
                                                    <a href="{{ route('estudiantes.edit', $estudiante->id) }}"
                                                        class="modificar"><i class="fa fa-edit" data-toggle="tooltip"
                                                            data-placement="left" title="Modificar"></i></a>

                                                    <a href="#"
                                                        data-url="{{ route('estudiantes.destroy', $estudiante->id) }}"
                                                        data-toggle="modal" data-target="#modal-eliminar"
                                                        class="eliminar"><i class="fa fa-trash" data-toggle="tooltip"
                                                            data-placement="left" title="Eliminar"></i></a>
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
            columns: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {
                    width: "8%"
                },
            ],
            scrollCollapse: true,
            language: lenguaje,
            pageLength: 25
        });


        // ELIMINAR
        $(document).on('click', 'table tbody tr td.btns-opciones a.eliminar', function(e) {
            e.preventDefault();
            let estudiante = $(this).parents('tr').children('td').eq(0).text();
            $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el registro <b>${estudiante}</b>?`);
            let url = $(this).attr('data-url');
            console.log($(this).attr('data-url'));
            $('#formEliminar').prop('action', url);
        });

        $('#btnEliminar').click(function() {
            $('#formEliminar').submit();
        });
    </script>
@endsection
@endsection
