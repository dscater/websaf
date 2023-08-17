<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Campo*</label>
            {{Form::select('campo_id',$array_campos,null,['class'=>'form-control','required'])}}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Nombre*</label>
            {{ Form::text('nombre',null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Descripción</label>
            {{ Form::text('descripcion',null,['class'=>'form-control']) }}
        </div>
    </div>
</div>
