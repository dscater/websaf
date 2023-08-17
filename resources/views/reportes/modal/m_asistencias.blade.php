<div class="modal fade" id="m_asistencias">
    <div class="modal-dialog">
        <div class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Asistencia de Profesores</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'reportes.asistencias', 'method' => 'get', 'target' => '_blank', 'id' =>
                'formasistencias']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Seleccione Mes:</label>
                        {{Form::select('mes',[
                            '01' => 'Enero',
                            '02' => 'Febrero',
                            '03' => 'Marzo',
                            '04' => 'Abril',
                            '05' => 'Mayo',
                            '06' => 'Junio',
                            '07' => 'Julio',
                            '08' => 'Agosto',
                            '09' => 'Septiembre',
                            '10' => 'Octubre',
                            '11' => 'Noviembre',
                            '12' => 'Diciembre',
                        ],date('m'),['class'=>'form-control','id'=>'selectMes'])}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Seleccione Gestión:</label>
                            {{Form::select('anio',$array_gestiones,date('Y'),['class'=>'form-control','id'=>'anio'])}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info" id="btnasistencias">Generar reporte</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
