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
                    <li class="breadcrumb-item"><a href="{{route('pago_estudiantes.index')}}">Pagos Estudiantes</a></li>
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
                        <h3 class="card-title">Registrar Pago</h3>
                    </div>
                    <!-- /.card-header -->
                    {{ Form::open(['route'=>'pago_estudiantes.store','method'=>'post']) }}
                        <div class="card-body">
                            @include('pago_estudiantes.form.form')
                            <button class="btn btn-info"><i class="fa fa-save"></i> GUARDAR</button>
                        </div>
                    {{Form::close()}}
                    <!-- /.card-body -->
                </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>

<input type="hidden" id="urlMontoConcepto" value="{{route('plan_pagos.getMontoConcepto')}}">
<input type="hidden" id="urlInfoPadreTutor" value="{{route('estudiantes.getInfoPadreTutor')}}">

@endsection

@section('scripts')
<script src="{{asset('js/pago_estudiantes/create.js')}}"></script>
@endsection
