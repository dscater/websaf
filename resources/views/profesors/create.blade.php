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
                <h1 class="m-0">Profesores</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right bg-white">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('profesors.index')}}">Profesores</a></li>
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
                        <h3 class="card-title">Nuevo Registro</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {{Form::open(['route'=>'profesors.store','method'=>'post','files'=>true])}}
                            @include('profesors.form.form')
                            <button class="btn btn-info"><i class="fa fa-save"></i> GUARDAR</button>
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
@php
    $script = '<script type="text/javascript">
                window.onload = function() {
                    document.getElementById("ci_exp").value = "'.old('ci_exp').'";
                    document.getElementById("role_id").value = "'.old('role_id').'";
                };
            </script>';
@endphp 
{!! $script !!}
@section('scripts')

@endsection

@endsection
