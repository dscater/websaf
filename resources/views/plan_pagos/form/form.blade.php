<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Nivel*</label>
            {{ Form::select('nivel',[
                '' => 'Seleccione...',
                'NIVEL INICIAL' => 'NIVEL INICIAL',
                'PRIMARIA' => 'PRIMARIA',
                'SECUNDARIA' => 'SECUNDARIA',
            ],null,['class'=>'form-control','required','id'=>'select_nivel']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Concepto de pago*</label>
            {{ Form::select('concepto',[
                '' => 'Seleccione...',
                'INSCRIPCIÓN' => 'INSCRIPCIÓN',
                'MENSUALIDAD' => 'MENSUALIDAD',
                'PAGO GLOBAL AL CONTADO' => 'PAGO GLOBAL AL CONTADO',
            ],null,['class'=>'form-control','required','id'=>'select_nivel']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Monto Bs.*</label>
            {{ Form::number('monto',null,['class'=>'form-control','required','step'=>'0.01','min'=>'0']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Gestión*</label>
            {{Form::text('gestion',isset($plan_pago)? $plan_pago->gestion:date('Y'),['class'=>'form-control','required','readonly'])}}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Número de Meses*</label>
            {{Form::number('meses',isset($plan_pago)? $plan_pago->meses:'10',['class'=>'form-control','required','min'=>'1','readonly'])}}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Descripción*</label>
            {{Form::textarea('descripcion',null,['class'=>'form-control','required','rows'=>'2'])}}
        </div>
    </div>
</div>