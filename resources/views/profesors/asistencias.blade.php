@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profesors/profesor_materias.css') }}">
    <style>
        table.asistencias>tbody tr td {
            vertical-align: middle !important;
        }
    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Adminsitrar asistencias</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Profesores Materias</li>
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
                                <div class="col-md-3 col-sm-6 ml-auto">
                                    <div class="form-group">
                                        <label>Seleccione Gestión*</label>
                                        {{ Form::select('gestion', $array_gestiones, date('Y'), ['class' => 'form-control', 'required', 'id' => 'selectAnio']) }}
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mr-auto">
                                    <label>Seleccione Mes*</label>
                                    {{ Form::select(
                                        'selectMes',
                                        [
                                            '01' => 'Enero',
                                            '02' => 'Febrero',
                                            '03' => 'Marzo',
                                            '04' => 'Abril',
                                            '05' => 'Mayo',
                                            '06' => 'Junio',
                                            '07' => 'Julio',
                                            '08' => 'Agosto',
                                            '09' => 'Septiembre',
                                            '10' => 'Octubre',
                                            '11' => 'Noviembre',
                                            '12' => 'Diciembre',
                                        ],
                                        date('m'),
                                        ['class' => 'form-control', 'id' => 'selectMes'],
                                    ) }}
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Seleccione Materia*</label>
                                        {{ Form::select('materia', [], date('Y'), ['class' => 'form-control', 'required', 'id' => 'select_materia']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="asistencias table table-bordered custom-table table-nowrap mb-0">
                                <thead>
                                    <tr id="header_asistencias">

                                    </tr>
                                </thead>
                                <tbody id="contenedorAsistencias">
                                    <tr>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td>
                                            <div class="half-day">
                                                <span class="first-off"><a href="javascript:void(0);" data-toggle="modal"
                                                        data-target="#attendance_info"><i
                                                            class="fa fa-check text-success"></i></a></span>
                                                <span class="first-off"><i class="fa fa-close text-danger"></i></span>
                                            </div>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i class="fa fa-check text-success"></i></a>
                                        </td>
                                        <td>
                                            <div class="half-day">
                                                <span class="first-off"><i class="fa fa-close text-danger"></i></span>
                                                <span class="first-off"><a href="javascript:void(0);" data-toggle="modal"
                                                        data-target="#attendance_info"><i
                                                            class="fa fa-check text-success"></i></a></span>
                                            </div>
                                        </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i
                                                    class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i
                                                    class="fa fa-check text-success"></i></a></td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i
                                                    class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i
                                                    class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i
                                                    class="fa fa-check text-success"></i></a></td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i
                                                    class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i
                                                    class="fa fa-check text-success"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    <input type="hidden" id="urlAsistencias" value="{{ route('profesors.asistencias', $profesor->id) }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/profesors/asistencias.js') }}"></script>
@endsection
