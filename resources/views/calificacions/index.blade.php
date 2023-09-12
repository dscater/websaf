@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/calificacions/index.css') }}">
@endsection

@section('sidebar-collapse')
    sidebar-collapse
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Administrar Calificaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Administrar Calificaciones</li>
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
                            <div class="row">
                                <div class="col-md-3 col-sm-6 ml-auto">
                                    <div class="form-group">
                                        <label>Seleccione Gestión*</label>
                                        {{ Form::select('gestion', $array_gestiones, date('Y'), ['class' => 'form-control', 'required', 'id' => 'select_gestion']) }}
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mr-auto">
                                    <div class="form-group">
                                        <label>Seleccione Trimestre*</label>
                                        {{ Form::select(
                                            'trimestre',
                                            [
                                                '' => 'Seleccione...',
                                                '1' => '1er Trimestre',
                                                '2' => '2do Trimestre',
                                                '3' => '3er Trimestre',
                                            ],
                                            date('Y'),
                                            ['class' => 'form-control', 'required', 'id' => 'select_trimestre'],
                                        ) }}
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Seleccione Materia*</label>
                                        {{ Form::select('materia', [], date('Y'), ['class' => 'form-control', 'required', 'id' => 'select_materia']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered tabla_calificacions">
                                        <thead>
                                            <tr class="bg-blue">
                                                <th>DATOS DEL ESTUDIANTE</th>
                                                <th colspan="7">ÁREA 1</th>
                                                <th colspan="7">ÁREA 2</th>
                                                <th colspan="7">ÁREA 3</th>
                                                <th colspan="7">ÁREA 4</th>
                                                <th rowspan="2" class="bg-orange vertical">
                                                    <div>PROMEDIO FINAL</div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    APELLIDO(S) Y NOMBRE(S)
                                                </th>
                                                <th>A1</th>
                                                <th>A2</th>
                                                <th>A3</th>
                                                <th>A4</th>
                                                <th>A5</th>
                                                <th>A6</th>
                                                <th class="bg-lightblue vertical">
                                                    <div>PROMEDIO</div>
                                                </th>
                                                <th>A1</th>
                                                <th>A2</th>
                                                <th>A3</th>
                                                <th>A4</th>
                                                <th>A5</th>
                                                <th>A6</th>
                                                <th class="bg-lightblue vertical">
                                                    <div>PROMEDIO</div>
                                                </th>
                                                <th>A1</th>
                                                <th>A2</th>
                                                <th>A3</th>
                                                <th>A4</th>
                                                <th>A5</th>
                                                <th>A6</th>
                                                <th class="bg-lightblue vertical">
                                                    <div>PROMEDIO</div>
                                                </th>
                                                <th>A1</th>
                                                <th>A2</th>
                                                <th>A3</th>
                                                <th>A4</th>
                                                <th>A5</th>
                                                <th>A6</th>
                                                <th class="bg-lightblue vertical">
                                                    <div>PROMEDIO</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="contenedor_materias">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

    <input type="hidden" id="prof" value="{{ $profesor->id }}">
    <input type="hidden" id="urlMaterias" value="{{ route('materias.materiasCalificacions') }}">
    <input type="hidden" id="urlEstudiantes" value="{{ route('calificacions.getEstudiantesCalificacions') }}">
    <input type="hidden" id="urlStoreCalificacion" value="{{ route('calificacions.store') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/calificacions/index.js') }}"></script>
@endsection
