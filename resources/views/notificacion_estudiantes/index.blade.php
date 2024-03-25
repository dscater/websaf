@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Notificaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Notificaciones</li>
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
                            <table id="example2" class="table data-table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Fecha Registro</th>
                                        <th>Materia</th>
                                        <th>Trimestre</th>
                                        <th>Area</th>
                                        <th>Nro. Actividad</th>
                                        <th>Nota</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notificacion_estudiantes as $notificacion_estudiante)
                                        <tr>
                                            <td>{{ date('d/m/Y', strtotime($notificacion_estudiante->created_at)) }}</td>
                                            <td>{{ $notificacion_estudiante->materia->nombre }}</td>
                                            <td>{{ $notificacion_estudiante->trimestre }}</td>
                                            <td>{{ $notificacion_estudiante->txt_area }}</td>
                                            <td>{{ $notificacion_estudiante->no_actividad }}</td>
                                            <td>{{ $notificacion_estudiante->nota }}</td>
                                            <td class="btns-opciones">
                                                <a href="{{ route('notificacion_estudiantes.show', $notificacion_estudiante->id) }}"
                                                    class="evaluar"><i class="far fa-eye"
                                                        data-toggle="tooltip" data-placement="left"
                                                        title="Notificacion"></i></a>

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
            ],
            scrollCollapse: true,
            language: lenguaje,
            pageLength: 25
        });


        // ELIMINAR
        $(document).on('click', 'table tbody tr td.btns-opciones a.eliminar', function(e) {
            e.preventDefault();
            let notificacion_estudiante = $(this).parents('tr').children('td').eq(1).text();
            $('#mensajeEliminar').html(
                `¿Está seguro(a) de eliminar el registro <b>${notificacion_estudiante}</b>?`);
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
