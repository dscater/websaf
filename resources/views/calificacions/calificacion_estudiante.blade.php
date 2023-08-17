@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/calificacions/index.css')}}">
@endsection

@section('sidebar-collapse')
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
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
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
                            <div class="col-md-4 col-sm-4 ml-auto mr-auto">
                                <div class="form-group">
                                    <label>Seleccione Gestión*</label>
                                    {{Form::select('gestion',$array_gestiones,date('Y'),['class'=>'form-control','required','id'=>'select_gestion'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Nº</th>
                                        <th>Materia</th>
                                        <th>1er trimestre</th>
                                        <th>2do trimestre</th>
                                        <th>3r trimestre</th>
                                        <th>Promedio Final</th>
                                        <th>Observación</th>
                                    </thead>
                                    <tbody id="contenedor_notas">
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

<input type="hidden" id="est" value="{{$estudiante->id}}">
<input type="hidden" id="urlNotas" value="{{route('calificacions.notas_estudiante',$estudiante->id)}}">

@endsection

@section('scripts')
<script src="{{asset('js/calificacions/calificacion_estudiante.js')}}"></script>
@endsection
