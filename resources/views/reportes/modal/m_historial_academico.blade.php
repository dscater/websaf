<div class="modal fade" id="m_historial_academico">
    <div class="modal-dialog">
        <div class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Historial Académico</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'reportes.historial_academico', 'method' => 'get', 'target' => '_blank', 'id' =>
                'formhistorial_academico']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Estudiante:</label>
                            {{Form::select('estudiante',$array_estudiantes,null,['class'=>'form-control select2','id'=>'estudiante','required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nivel:</label>
                            {{Form::select('nivel',[
                                '' => 'Seleccione...',
                                'NIVEL INICIAL' => 'NIVEL INICIAL',
                                'PRIMARIA' => 'PRIMARIA',
                                'SECUNDARIA' => 'SECUNDARIA',
                            ],null,['class'=>'form-control','id'=>'nivel','required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Grado:</label>
                            {{Form::select('grado',[],null,['class'=>'form-control','id'=>'grado','required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Paralelo:</label>
                            {{Form::select('paralelo',$array_paralelos,null,['class'=>'form-control','id'=>'paralelo','required'])}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Turno:</label>
                            {{Form::select('turno',[
                                'MAÑANA' => 'MAÑANA',
                                'TARDE' => 'TARDE',
                                'NOCHE' => 'NOCHE'
                            ],null,['class'=>'form-control','id'=>'turno','required'])}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Gestión:</label>
                            {{Form::select('gestion',$array_gestiones_insc,null,['class'=>'form-control','id'=>'gestion','required'])}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info" id="btnhistorial_academico">Generar reporte</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
