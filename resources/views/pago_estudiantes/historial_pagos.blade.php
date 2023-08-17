@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pagos Estudiantes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Pagos Estudiantes</li>
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
                        <h3 class="card-title">Historial de Pagos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['route' => 'reportes.pagos_estudiantes', 'method' => 'get', 'target' => '_blank', 'id' => 'formpagos_estudiantes']) !!}
                        <div class="row">
                            <input type="hidden" name="estudiante" value="{{$estudiante->id}}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Gestión:</label>
                                    {{Form::select('gestion',$array_gestiones_insc,null,['class'=>'form-control','id'=>'gestion','required'])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-primary">Generar</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
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

@include('modal.eliminar')

@section('scripts')
@endsection

@endsection
