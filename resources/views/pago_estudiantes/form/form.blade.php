<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Estudiante*</label>
            {{ Form::select('estudiante_id',$array_estudiantes,null,['class'=>'form-control','required','id'=>'select_estudiante']) }}
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
                'OTRO PAGO' => 'OTRO PAGO',
            ],null,['class'=>'form-control','required','id'=>'select_concepto']) }}
        </div>
    </div>
    <div class="col-md-4 oculto" id="especifica_concepto">
        <div class="form-group">
            <label>Especificar Concepto*</label>
            {{ Form::text('descripcion',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Gestión*</label>
            {{ Form::select('gestion',$array_gestiones,isset($pago_estudiante)? $pago_estudiante->gestion:date('Y'),['class'=>'form-control','required','id'=>'select_gestion']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Monto Bs.*</label>
            {{ Form::number('monto',null,['class'=>'form-control','required','step'=>'0.01','min'=>'0','id'=>'monto_pago','readonly','required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Fecha de Pago*</label>
            {{ Form::date('fecha_pago',isset($pago_estudiante)? $pago_estudiante->fecha_pago:date('Y-m-d'),['class'=>'form-control','required','readonly']) }}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Factura A Nombre de*</label>
            {{Form::select('tipo_factura',[
                '' => 'Seleccione...',
                'PADRE/TUTOR' => 'PADRE/TUTOR',
                'MADRE' => 'MADRE',
                'ESTUDIANTE' => 'ESTUDIANTE',
                'OTRO' => 'OTRO'
            ],null,['class'=>'form-control','required','id'=>'select_tipo_factura'])}}
        </div>
    </div>
    <div class="col-md-4" id="especifica_nombre_factura">
        <div class="form-group">
            <label>Especificar A Nombre de*</label>
            {{Form::text('factura_nombre',null,['class'=>'form-control','readonly'])}}
        </div>
    </div>
    
    <div class="col-md-4" id="especifica_nit_factura">
        <div class="form-group">
            <label>Especificar NIT de Factura*</label>
            {{Form::text('factura_nit',null,['class'=>'form-control','readonly'])}}
        </div>
    </div>
</div>
