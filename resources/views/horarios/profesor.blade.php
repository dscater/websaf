@extends('layouts.app')

@section('css')
    <style>
        .color-option {
            width: 30px;
            height: 30px;
            border: 1px solid #ccc;
            display: inline-block;
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Horarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Horarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label>Seleccionar gestión</label>
                                    {{ Form::select('gestion', $array_gestiones, null, ['class' => 'form-control', 'id' => 'gestion']) }}
                                </div>
                                <div class="col-12 form-group">
                                    <label>Seleccionar Turno</label>
                                    {{ Form::select('turno', ['MAÑANA' => 'MAÑANA', 'TARDE' => 'TARDE', 'NOCHE' => 'NOCHE'], null, ['class' => 'form-control', 'id' => 'turno']) }}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" id="contenedor_horarios"></div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <input type="hidden" value="{{ route('horarios.profesor_info') }}" id="urlHorarioProfesor">
@endsection
@section('scripts')
    <script>
        let gestion = $("#gestion");
        let turno = $("#turno");
        let contenedor_horarios = $("#contenedor_horarios");
        $(document).ready(function() {
            getHorario();
            gestion.change(getHorario);
            turno.change(getHorario);
        });

        function getHorario() {
            if (gestion.val() != '') {
                $.ajax({
                    type: "GET",
                    url: $("#urlHorarioProfesor").val(),
                    data: {
                        gestion: gestion.val(),
                        turno: turno.val(),
                    },
                    dataType: "json",
                    success: function(response) {
                        contenedor_horarios.html(response.html);
                    }
                });
            } else {
                contenedor_horarios.html("Debes seleccionar una gestión");
            }
        }
    </script>
@endsection
