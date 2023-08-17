@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Estudiantes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('estudiantes.index')}}">Estudiantes</a></li>
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
                    {{ Form::model($usuario,['route'=>['estudiantes.update',$usuario->id],'method'=>'put','files'=>'true']) }}
                    <div class="card-body">
                        @include('estudiantes.form.form')
                        <div class="card-body">
                            <button class="btn btn-info"><i class="fa fa-edit"></i> ACTUALIZAR</button>
                        </div>
                    </div>
                    {{ Form::close() }}
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

@section('scripts')
<script>
    $(document).ready(function () {
        verificaSelects();
        $('#pueblo_nacion_otro_select').change(function(){
            let valor = $(this).val();
            if(valor == 'OTRO'){
                $('#pueblo_nacion_otro_input').attr('required',true);
            }else{
                $('#pueblo_nacion_otro_input').removeAttr('required');
            }
        });

        $('#select_discapacidad').change(function(){
            let valor = $(this).val();
            if(valor == 'OTRO'){
                $('#dis_otro_input').attr('required',true);
            }else{
                $('#dis_otro_input').removeAttr('required');
            }
        });

        $('#select_llega').change(function(){
            let valor = $(this).val();
            if(valor == 'OTRO MEDIO'){
                $('#llega_otro_input').attr('required',true);
            }else{
                $('#llega_otro_input').removeAttr('required');
            }
        });
    });
    
    function verificaSelects(){
        let valor = '';
        valor = $('#pueblo_nacion_otro_select').val();
        if(valor == 'OTRO'){
            $('#pueblo_nacion_otro_input').attr('required',true);
        }else{
            $('#pueblo_nacion_otro_input').removeAttr('required');
        }

        valor = $('#select_discapacidad').val();
        if(valor == 'OTRO'){
            $('#dis_otro_input').attr('required',true);
        }else{
            $('#dis_otro_input').removeAttr('required');
        }

        valor = $('#select_llega').val();
        if(valor == 'OTRO MEDIO'){
            $('#llega_otro_input').attr('required',true);
        }else{
            $('#llega_otro_input').removeAttr('required');
        }
    }
</script>
@endsection