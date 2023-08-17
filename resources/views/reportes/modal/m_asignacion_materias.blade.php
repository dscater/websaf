<div class="modal fade" id="m_asignacion_materias">
    <div class="modal-dialog">
        <div class="modal-content  bg-sucess">
            <div class="modal-header">
                <h4 class="modal-title">Asignación de Materias</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'reportes.asignacion_materias', 'method' => 'get', 'target' => '_blank', 'id' =>
                'formasignacion_materias']) !!}
                <div class="row">
                    @if(Auth::user()->tipo == 'PROFESOR')
                    <input type="hidden" name="profesor" value="{{Auth::user()->profesor->id}}">
                    @else
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Profesor:</label>
                            {{Form::select('profesor',$array_profesors,null,['class'=>'form-control select2','id'=>'profesor','required'])}}
                        </div>
                    </div>
                    @endif
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
                <button type="submit" class="btn btn-info" id="btnasignacion_materias">Generar reporte</button>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
