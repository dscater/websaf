@extends('layouts.app')

@section('css')
    <style>
        .boton_reporte {
            width: 100% !important;
            margin-left: auto;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .boton_reporte a {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reportes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Reportes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content" id="contenedorReportes">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Reportes</h3>
                        <div class="row">
                            @if (Auth::user()->tipo == 'ADMINISTRADOR')
                                @include('includes.reporte.reporte_admin')
                            @endif
                            @if (Auth::user()->tipo == 'PROFESOR')
                                @include('includes.reporte.reporte_profesor')
                            @endif
                            @if (Auth::user()->tipo == 'ESTUDIANTE')
                                @include('includes.reporte.reporte_estudiante')
                            @endif
                            @if (Auth::user()->tipo == 'SECRETARIA ACADÉMICA')
                                @include('includes.reporte.reporte_secretaria')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('reportes.modal.m_usuarios')
    @include('reportes.modal.m_personal')
    @include('reportes.modal.m_kardex_personal')
    @include('reportes.modal.m_boleta_calificaciones')
    @include('reportes.modal.m_centralizador_calificacions')
    @include('reportes.modal.m_historial_academico')
    @include('reportes.modal.m_asignacion_materias')
@endsection

@section('scripts')
    <script src="{{ asset('js/reportes/filtro.js') }}"></script>
@endsection
