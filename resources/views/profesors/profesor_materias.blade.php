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
                    <li class="breadcrumb-item"><a href="{{route('profesors.index')}}">Profesores</a></li>
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
                        <div class="col-md-12 alert alert-success">
                            <button class="close" data-dismiss="alert">&times;</button>
                            Seleccione para ver las materias asignadas y disponibles
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nivel*</label>
                                    {{Form::select('nivel',[
                                        '' => 'Seleccione...',
                                        'NIVEL INICIAL' => 'NIVEL INICIAL',
                                        'PRIMARIA' => 'PRIMARIA',
                                        'SECUNDARIA' => 'SECUNDARIA',
                                    ],null,['class'=>'form-control','required','id'=>'select_nivel'])}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Grado*</label>
                                    {{ Form::select('grado',[],null,['class'=>'form-control','required','id'=>'select_grado']) }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Paralelo*</label>
                                    {{Form::select('paralelo_id',$array_paralelos,null,['class'=>'form-control','required','id'=>'select_paralelo'])}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Turno*</label>
                                    {{Form::select('turno',[
                                        '' => 'Seleccione...',
                                        'MAÑANA' => 'MAÑANA',
                                        'TARDE' => 'TARDE',
                                        'NOCHE' => 'NOCHE'
                                    ],null,['class'=>'form-control','required','id'=>'select_turno'])}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Gestión*</label>
                                    {{Form::text('gestion',date('Y'),['class'=>'form-control','required','readonly','id'=>'gestion'])}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div id="contenedor_materias" class="row">
                                    
                                </div>
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
<input type="hidden" id="urlMaterias" value="{{route('profesor_materias.getMateriasDisponibles')}}">
<input type="hidden" id="urlStoreProfesorMateria" value="{{route('profesor_materias.store',$profesor->id)}}">

<input type="hidden" id="urlDeleteProfesorMateria" value="{{route('profesor_materias.destroy',$profesor->id)}}">
@include('modal.eliminar')
@endsection

@section('scripts')
<script src="{{asset('js/profesors/profesor_materias.js')}}"></script>
@endsection
