<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Hora inicio*</label>
            {{ Form::time('hora_ini', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Hora fin*</label>
            {{ Form::time('hora_fin', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Recreo*</label>
            <input type="checkbox" class="form-control" name="recreo" value="SI"
                {{ isset($hora) && $hora->recreo != '' && $hora->recreo != null ? 'checked' : '' }}
                style="height: 30px; width:30px;">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Turno*</label>
            {{ Form::select('turno', ['' => 'Seleccione...', 'MAÑANA' => 'MAÑANA', 'TARDE' => 'TARDE', 'NOCHE' => 'NOCHE'], null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>
