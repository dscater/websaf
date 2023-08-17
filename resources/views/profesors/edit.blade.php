@extends('layouts.app')

@section('css')
<style>
    table tbody tr td{
        vertical-align: middle!important;
        padding: 0px !important;
    }

    table tbody tr td:nth-child(1){
        padding-left: 5px!important;
        font-weight: 700; 
    }
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-white">Profesores</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right bg-white">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('profesors.index')}}">Profesores</a></li>
                    <li class="breadcrumb-item active">Modificar</li>
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
                        <h3 class="card-title">Modificar Registro</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {{Form::model($usuario, ['route'=>['profesors.update',$usuario->id],'method'=>'put','files'=>true])}}
                            @include('profesors.form.form')
                            <button class="btn btn-info"><i class="fa fa-edit"></i> ACTUALIZAR</button>
                        {{Form::close()}}
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


@section('scripts')

@endsection

@endsection
