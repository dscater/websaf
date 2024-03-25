<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label>Profesor</label>
            {{ Form::select('profesor_id', $array_profesors, null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Elegir color*</label>
            {{ Form::color('color', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>
