@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/estudiantes/asistencias.css') }}">
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
                    <h1 class="m-0">Estudiantes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('estudiantes.index') }}">Estudiantes</a></li>
                        <li class="breadcrumb-item active">Asistencias</li>
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
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="bg-dark">
                                        <td width="80px">Nombre: </td>
                                        <td>{{ $estudiante->nombre }} {{ $estudiante->paterno }} {{ $estudiante->materno }}
                                        </td>
                                        <td class="foto_estudiante" with="80px" rowspan="2">
                                            <img src="{{ asset('imgs/users/' . $estudiante->foto) }}" alt="Foto">
                                        </td>
                                    </tr>
                                    <tr class="bg-dark">
                                        <td>C.I.:</td>
                                        <td>{{ $estudiante->ci }} {{ $estudiante->ci_exp }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title font-weight-bold">Asistencias</div><br>
                            <div class="row">
                                <div class="col-md-4 ml-auto">
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
                                <div class="col-md-4 mr-auto">
                                    {{ Form::select('selectAnio', $array_gestiones, date('Y'), ['class' => 'form-control', 'id' => 'selectAnio']) }}
                                </div>
                            </div>
                        </div>
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
                                                data-target="#attendance_info"><i
                                                    class="fa fa-check text-success"></i></a></td>
                                        <td><a href="javascript:void(0);" data-toggle="modal"
                                                data-target="#attendance_info"><i
                                                    class="fa fa-check text-success"></i></a></td>
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

    <input type="hidden" id="prof" value="{{ $estudiante->id }}">
    <input type="hidden" id="urlAsistencias" value="{{ route('estudiantes.asistencias', $estudiante->id) }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/estudiantes/asistencias.js') }}"></script>
@endsection
