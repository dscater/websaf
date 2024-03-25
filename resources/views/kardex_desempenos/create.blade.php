@extends('layouts.app')

@section('css')
    <style>
        #texto_kardex_desempeno {
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kardex de desempeño académico > Nuevo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kardex_desempenos.index') }}">Kardex de desempeño
                                académico</a>
                        </li>
                        <li class="breadcrumb-item active">Nuevo</li>
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
                        <!-- /.card-header -->
                        {{ Form::open(['route' => ['kardex_desempenos.store', [$profesor_materia->id, $inscripcion->id]], 'method' => 'post']) }}
                        <div class="card-body">
                            @include('kardex_desempenos.form.form')

                            <button class="btn btn-info"><i class="fa fa-save"></i> GUARDAR</button>
                        </div>
                        {{ Form::close() }}
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
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
    </script>
@endsection
