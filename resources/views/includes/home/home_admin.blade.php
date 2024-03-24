 <!-- Info boxes -->
 <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Administrativos</span>
                <span class="info-box-number">{{$administrativos}}</span>
            </div>
        <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Profesores</span>
                <span class="info-box-number">{{$profesors}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Estudiantes</span>
                <span class="info-box-number">{{$estudiantes}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    {{-- <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="title-header">KPI Ingresos Económicos</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Filtro:</label>
                            <select name="filtro" id="filtro1" class="form-control">
                                <option value="todos">Todos</option>
                                <option value="concepto">Concepto de Pago</option>
                                <option value="fecha">Fecha</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" id="concepto">
                        <div class="form-group">
                            <label>Seleccione Concepto:</label>
                            {{ Form::select('concepto',[
                                'todos' => 'Todos',
                                'INSCRIPCIÓN' => 'INSCRIPCIÓN',
                                'MENSUALIDAD' => 'MENSUALIDAD',
                                'PAGO GLOBAL AL CONTADO' => 'PAGO GLOBAL AL CONTADO',
                                'OTRO PAGO' => 'OTRO PAGO',
                            ],null,['class'=>'form-control','required','id'=>'select_concepto']) }}
                        </div>
                    </div>
                    <div class="col-md-4" id="fecha_ini">
                        <div class="form-group">
                            <label>Fecha inicio:</label>
                            <input type="date" name="fecha_ini" id="txt_fecha_ini" value="{{ date('Y-m-d') }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4" id="fecha_fin">
                        <div class="form-group">
                            <label>Fecha fin:</label>
                            <input type="date" name="fecha_fin" id="txt_fecha_fin" value="{{ date('Y-m-d') }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="contenedor_grafico"></div>
            </div>
        </div>
    </div> --}}

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="title-header">KPI Cantidad de Estudiantes</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Filtro:</label>
                            <select name="filtro2" id="filtro2" class="form-control">
                                <option value="todos">Todos</option>
                                <option value="filtro">Filtrar</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" id="gestion">
                        <div class="form-group">
                            <label>Seleccione Gestión:</label>
                            {{ Form::select('gestion',$array_gestiones,null,['class'=>'form-control','required','id'=>'select_gestion']) }}
                        </div>
                    </div>
                    <div class="col-md-4" id="nivel">
                        <div class="form-group">
                            <label>Seleccione Nivel:</label>
                            {{ Form::select('nivel',[
                                    '' => 'Seleccione...',
                                    'NIVEL INICIAL' => 'NIVEL INICIAL',
                                    'PRIMARIA' => 'PRIMARIA',
                                    'SECUNDARIA' => 'SECUNDARIA',
                            ],null,['class'=>'form-control','required','id'=>'select_nivel']) }}
                        </div>
                    </div>
                    <div class="col-md-4" id="grado">
                        <div class="form-group">
                            <label>Seleccione Grado:</label>
                            {{ Form::select('grado',[],null,['class'=>'form-control','required','id'=>'select_grado']) }}
                        </div>
                    </div>
                    <div class="col-md-4" id="paralelo">
                        <div class="form-group">
                            <label>Seleccione Paralelo:</label>
                            {{ Form::select('paralelo',$array_paralelos,null,['class'=>'form-control','required','id'=>'select_paralelo']) }}
                        </div>
                    </div>
                    <div class="col-md-4" id="turno">
                        <div class="form-group">
                            <label>Seleccione Turno:</label>
                            {{ Form::select('turno',[
                                '' => 'Seleccione...',
                                'MAÑANA' => 'MAÑANA',
                                'TARDE' => 'TARDE',
                                'NOCHE' => 'NOCHE'
                            ],null,['class'=>'form-control','required','id'=>'select_turno']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="contenedor_grafico2"></div>
            </div>
        </div>
    </div>
 </div>

 <input type="hidden" id="urlInfoCantidadEstudiantes" value="{{route('inscripcions.cantidad_estudiantes')}}">
