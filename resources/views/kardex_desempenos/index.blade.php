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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Gestión:</label>
                                    {{ Form::select('gestion', $array_gestiones, null, ['class' => 'form-control', 'id' => 'gestion']) }}
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Materia:</label>
                                    {{ Form::select('profesor_materia_id', [], null, ['class' => 'form-control', 'id' => 'profesor_materia_id']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body texte-center" id="contenedor_inscripcions">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <input type="hidden" value="{{ route('profesor_materias.getProfesorMateriasGestion') }}" id="urlGetProfesorMaterias">
    <input type="hidden" value="{{ route('inscripcions.getInscripcionsByProfesorMateria') }}"
        id="urlInscripcionsProfesorMateria">
@endsection

@section('scripts')
    <script>
        let gestion = $("#gestion");
        let profesor_materia_id = $("#profesor_materia_id");
        let contenedor_inscripcions = $("#contenedor_inscripcions");
        $(document).ready(function() {
            getInscripcions();

            gestion.change(getProfesorMaterias);
            profesor_materia_id.change(getInscripcions);
        });

        function getProfesorMaterias() {
            if (gestion.val() != '') {
                $.ajax({
                    type: "GET",
                    url: $("#urlGetProfesorMaterias").val(),
                    data: {
                        gestion: gestion.val()
                    },
                    dataType: "json",
                    success: function(response) {
                        profesor_materia_id.html(response.options);
                    }
                });
            } else {
                profesor_materia_id.html("");
            }
        }

        function getInscripcions() {
            if (gestion.val() != '' && profesor_materia_id.val() != '') {
                $.ajax({
                    type: "get",
                    url: $("#urlInscripcionsProfesorMateria").val(),
                    data: {
                        profesor_materia_id: profesor_materia_id.val(),
                    },
                    dataType: "json",
                    success: function(response) {
                        contenedor_inscripcions.html(response.html)
                    }
                });
            } else {
                contenedor_inscripcions.html("SELECCIONE UNA GESTIÓN Y MATERIA")
            }
        }
    </script>
@endsection
