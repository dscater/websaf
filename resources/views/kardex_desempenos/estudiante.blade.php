@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kardex de desempeño académico</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Kardex de desempeño académico</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            {{ Form::open(['route' => 'kardex_desempenos.desempeno_pdf', 'method' => 'get', 'target' => '_blank']) }}
                            <input type="hidden" name="estudiante_id" value="{{ Auth::user()->estudiante->id }}">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>Gestión:</label>
                                    {{ Form::select('gestion', $array_gestiones, null, ['class' => 'form-control', 'id' => 'gestion','required']) }}
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary btn-block">Generar</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
