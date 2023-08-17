<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Paralelo*</label>
            {{ Form::text('paralelo',null,['class'=>'form-control','required','placeholder'=>'A,B,C,etc..','id'=>'paralelo']) }}
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label>Descripción</label>
            {{ Form::text('descripcion',null,['class'=>'form-control']) }}
        </div>
    </div>
</div>