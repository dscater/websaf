@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/materias/show.css')}}">
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Materias</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('materias.index')}}">Materias</a></li>
                    <li class="breadcrumb-item active">Ver Materias</li>
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
                        <h3 class="card-title">Malla Curricular</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="malla_curricular">
                            <div class="header">
                                <div class="campo">
                                    CAMPO
                                </div>
                                <div class="area">
                                    ÁREA
                                </div>
                                <div class="nivel">
                                    <div class="texto">
                                        INICIAL
                                    </div>
                                    <div class="contenedor_grados">
                                        <div class="grado">
                                            1º
                                        </div>
                                        <div class="grado">
                                            2º
                                        </div>
                                        <div class="total">
                                            TOTAL
                                        </div>
                                    </div>
                                </div>
                                <div class="nivel">
                                    <div class="texto">
                                        PRIMARIA
                                    </div>
                                    <div class="contenedor_grados">
                                        <div class="grado">
                                            1º
                                        </div>
                                        <div class="grado">
                                            2º
                                        </div>
                                        <div class="grado">
                                            3º
                                        </div>
                                        <div class="grado">
                                            4º
                                        </div>
                                        <div class="grado">
                                            5º
                                        </div>
                                        <div class="grado">
                                            6º
                                        </div>
                                        <div class="total">
                                            TOTAL
                                        </div>
                                    </div>
                                </div>
                                <div class="nivel">
                                    <div class="texto">
                                        SECUNDARIA
                                    </div>
                                    <div class="contenedor_grados">
                                        <div class="grado">
                                            1º
                                        </div>
                                        <div class="grado">
                                            2º
                                        </div>
                                        <div class="grado">
                                            3º
                                        </div>
                                        <div class="grado">
                                            4º
                                        </div>
                                        <div class="grado">
                                            5º
                                        </div>
                                        <div class="grado">
                                            6º
                                        </div>
                                        <div class="total">
                                            TOTAL
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="body">
                                <div class="contenedor_campos">
                                    {!! $html !!}
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

@endsection
