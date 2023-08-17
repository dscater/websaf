<div class="modal fade" id="m_pagos_estudiantes">
    <div class="modal-dialog">
        <div class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Pagos de Estudiantes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'reportes.pagos_estudiantes', 'method' => 'get', 'target' => '_blank', 'id' =>
                'formpagos_estudiantes']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Estudiante:</label>
                            {{Form::select('estudiante',$array_estudiantes,null,['class'=>'form-control select2','id'=>'estudiante','required'])}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Gestión:</label>
                            {{Form::select('gestion',$array_gestiones_insc,null,['class'=>'form-control','id'=>'gestion','required'])}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info" id="btnpagos_estudiantes">Generar reporte</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
