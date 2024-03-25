@extends('layouts.app')

@section('css')
    <style>
        .color-option {
            width: 30px;
            height: 30px;
            border: 1px solid #ccc;
            display: inline-block;
            margin-right: 10px;
            cursor: pointer;
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
                        <li class="breadcrumb-item"><a href="{{ route('horarios.index') }}">Horarios</a></li>
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
                            <h3 class="card-title">Nueva Área</h3>
                        </div>
                        <!-- /.card-header -->
                        {{ Form::open(['route' => 'horarios.store', 'method' => 'post']) }}
                        <div class="card-body">
                            @include('horarios.form.form')

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

    <input type="hidden" value="{{ route('profesor_materias.getProfesorMateriasGestion') }}"
        id="urlProfesorMateriasGestion">
@endsection
@section('scripts')
    <script>
        let profesor_id = $("#profesor_id");
        let gestion = $("#gestion");

        var colorOptions = document.querySelectorAll('.color-option');
        colorOptions.forEach(function(option) {
            option.addEventListener('click', function() {
                var selectedColor = this.getAttribute('data-color');
                document.getElementById('selectedColor').value = selectedColor;
                colorOptions.forEach(function(opt) {
                    opt.style.border = '1px solid #ccc'; // Reset border
                });
                this.style.border = '3px solid #000'; // Highlight selected color
            });
        });

        $(document).ready(function() {
            profesor_id.change(getMateriasProfesorGestion);
        });

        function getMateriasProfesorGestion() {
            $("#profesor_materia_id").html("");
            if (profesor_id.val() != '') {
                $.ajax({
                    type: "GET",
                    url: $("#urlProfesorMateriasGestion").val(),
                    data: {
                        profesor_id: profesor_id.val(),
                        gestion: gestion.val()
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#profesor_materia_id").html(response.options);
                    }
                });
            }
        }
    </script>
@endsection
