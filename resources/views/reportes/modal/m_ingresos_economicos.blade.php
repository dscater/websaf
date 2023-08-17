<div class="modal fade" id="m_ingresos_economicos">
    <div class="modal-dialog">
        <div class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Ingresos Económicos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'reportes.ingresos_economicos', 'method' => 'get', 'target' => '_blank', 'id' =>
                'formingresos_economicos']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Filtro:</label>
                            <select class="form-control" name="filtro" id="filtro">
                                <option value="todos">Todos</option>
                                <option value="concepto">Concepto de Pago</option>
                                <option value="fecha">Fecha</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Concepto de Pago:</label>
                            {{ Form::select('concepto',[
                                'todos' => 'Todos',
                                'INSCRIPCIÓN' => 'INSCRIPCIÓN',
                                'MENSUALIDAD' => 'MENSUALIDAD',
                                'PAGO GLOBAL AL CONTADO' => 'PAGO GLOBAL AL CONTADO',
                                'OTRO PAGO' => 'OTRO PAGO',
                            ],null,['class'=>'form-control','id'=>'concepto']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha inicio:</label>
                            <input type="date" name="fecha_ini" id="fecha_ini" value="{{ date('Y-m-d') }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha fin:</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" value="{{ date('Y-m-d') }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info" id="btningresos_economicos">Generar reporte</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
