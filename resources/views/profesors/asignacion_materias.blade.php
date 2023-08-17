@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/profesors/profesor_materias.css')}}">
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Profesores</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right bg-white">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
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
                    <div class="card-header">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="bg-dark">
                                    <td width="80px">Nombre: </td>
                                    <td>{{$profesor->nombre}} {{$profesor->paterno}} {{$profesor->materno}}</td>
                                    <td class="foto_profesor" with="80px" rowspan="2">
                                        <img src="{{asset('imgs/users/'.$profesor->foto)}}" alt="Foto">
                                    </td>
                                </tr>
                                <tr class="bg-dark">
                                    <td>C.I.:</td>
                                    <td>{{$profesor->ci}} {{$profesor->ci_exp}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mr-auto ml-auto">
                                <div class="form-group">
                                    <label>Seleccione Gestión*</label>
                                    {{Form::select('gestion',$array_gestiones,date('Y'),['class'=>'form-control','required','id'=>'select_gestion'])}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-blue">
                                            <th>Nº</th>
                                            <th>Nivel</th>
                                            <th>Materia</th>
                                            <th>Grado</th>
                                            <th>Paralelo</th>
                                            <th>Turno</th>
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

<input type="hidden" id="prof" value="{{$profesor->id}}">
<input type="hidden" id="urlMaterias" value="{{route('profesor_materias.getInfoMateriasAsignadas',$profesor->id)}}">
@endsection

@section('scripts')
<script src="{{asset('js/profesors/asignacion_materias.js')}}"></script>
@endsection
