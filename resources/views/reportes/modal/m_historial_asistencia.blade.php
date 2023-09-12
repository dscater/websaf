<div class="modal fade" id="m_historial_asistencia">
    <div class="modal-dialog">
        <div class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Historial de asistencia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open([
                    'route' => 'reportes.historial_asistencia',
                    'method' => 'get',
                    'target' => '_blank',
                    'id' => 'formhistorial_asistencia',
                ]) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Seleccione Gestión:</label>
                            {{ Form::select('anio', $array_gestiones, date('Y'), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info" id="btnhistorial_asistencia">Generar reporte</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
