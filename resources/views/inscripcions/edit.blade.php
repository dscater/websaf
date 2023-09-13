@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Inscrpciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inscripcions.index') }}">Inscrpciones</a></li>
                        <li class="breadcrumb-item active">Modificar</li>
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
                            <h3 class="card-title">Modificar Inscripción</h3>
                        </div>
                        <!-- /.card-header -->
                        {{ Form::model($inscripcion, ['route' => ['inscripcions.update', $inscripcion->id], 'method' => 'put']) }}
                        <div class="card-body">
                            @include('inscripcions.form.form')
                            <button class="btn btn-info" id="btnGuardar"><i class="fa fa-update"></i> ACTUALIZAR</button>
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


    @php
        $script = '<script type="text/javascript">
            window.onload = function() {
                let _select_grado = document.getElementById("select_grado");
                _select_grado.value = '.$inscripcion->grado.';
            };
        </script>';
    @endphp
@endsection
@section('scripts')
    <script src="{{ asset('js/inscripcions/create.js') }}"></script>
    {!! $script !!}
@endsection
