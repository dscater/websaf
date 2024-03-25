@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kardex de desempeño académico</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Kardex de desempeño académico</li>
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
                            <h5>Materia : {{ $profesor_materia->materia->nombre }}</h5>
                            <h5>Estudiante: {{ $inscripcion->estudiante->full_name }}</h5>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('kardex_desempenos.create', [$profesor_materia->id, $inscripcion->id]) }}"
                                class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Agregar registro</a>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Fecha</td>
                                        <td>A</td>
                                        <td>B</td>
                                        <td>C</td>
                                        <td>D</td>
                                        <td>E</td>
                                        <td>F</td>
                                        <td>G</td>
                                        <td>H</td>
                                        <td>I</td>
                                        <td>J</td>
                                        <td>Observaciones</td>
                                        <td>Aspectos Positivos</td>
                                        <td>Acción</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kardex_desempenos as $value)
                                        <tr>
                                            <td>{{ $value->fecha_t }}</td>
                                            <td>{!! $value->i_a ? '<i class="fa fa-times"></i>' : '' !!}</td>
                                            <td>{!! $value->i_b ? '<i class="fa fa-times"></i>' : '' !!}</td>
                                            <td>{!! $value->i_c ? '<i class="fa fa-times"></i>' : '' !!}</td>
                                            <td>{!! $value->i_d ? '<i class="fa fa-times"></i>' : '' !!}</td>
                                            <td>{!! $value->i_e ? '<i class="fa fa-times"></i>' : '' !!}</td>
                                            <td>{!! $value->i_f ? '<i class="fa fa-times"></i>' : '' !!}</td>
                                            <td>{!! $value->i_g ? '<i class="fa fa-times"></i>' : '' !!}</td>
                                            <td>{!! $value->i_h ? '<i class="fa fa-times"></i>' : '' !!}</td>
                                            <td>{!! $value->i_i ? '<i class="fa fa-times"></i>' : '' !!}</td>
                                            <td>{!! $value->i_j ? '<i class="fa fa-times"></i>' : '' !!}</td>
                                            <td>{{ $value->observaciones }}</td>
                                            <td>{{ $value->aspectos_positivos }}</td>
                                            <td class="btns-opciones">
                                                <a href="{{ route('kardex_desempenos.edit', $value->id) }}"
                                                    class="modificar"><i class="fa fa-edit" data-toggle="tooltip"
                                                        data-placement="left" title="Modificar"></i></a>
                                                <a href="#" data-url="{{ route('kardex_desempenos.destroy', $value->id) }}"
                                                    data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i
                                                        class="fa fa-trash" data-toggle="tooltip" data-placement="left"
                                                        title="Eliminar"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12">SIN REGISTROS</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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

        // ELIMINAR
        $(document).on('click', 'table tbody tr td.btns-opciones a.eliminar', function(e) {
            e.preventDefault();
            let registro = $(this).parents('tr').children('td').eq(0).text();
            $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar al registro con fecha <b>${registro}</b>?`);
            let url = $(this).attr('data-url');
            console.log($(this).attr('data-url'));
            $('#formEliminar').prop('action', url);
        });

        $('#btnEliminar').click(function() {
            $('#formEliminar').submit();
        });
    </script>
@endsection
