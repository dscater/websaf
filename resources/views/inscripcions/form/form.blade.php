<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Estudiante*</label>
            {{ Form::select('estudiante_id', $array_estudiantes, null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Nivel*</label>
            {{ Form::select(
                'nivel',
                [
                    '' => 'Seleccione...',
                    'NIVEL INICIAL' => 'NIVEL INICIAL',
                    'PRIMARIA' => 'PRIMARIA',
                    'SECUNDARIA' => 'SECUNDARIA',
                ],
                null,
                ['class' => 'form-control', 'required', 'id' => 'select_nivel'],
            ) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Grado*</label>
            {{ Form::select('grado', [], null, ['class' => 'form-control', 'required', 'id' => 'select_grado']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Paralelo*</label>
            {{ Form::select('paralelo_id', $array_paralelos, null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Turno*</label>
            {{ Form::select(
                'turno',
                [
                    '' => 'Seleccione...',
                    'MAÑANA' => 'MAÑANA',
                    'TARDE' => 'TARDE',
                    'NOCHE' => 'NOCHE',
                ],
                null,
                ['class' => 'form-control', 'required'],
            ) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Gestión*</label>
            {{ Form::text('gestion', isset($inscripcion) ? $inscripcion->gestion : date('Y'), ['class' => 'form-control', 'required', 'readonly']) }}
        </div>
    </div>
    @if (isset($inscripcion))
        <div class="col-md-4">
            <div class="form-group">
                <label>Turno*</label>
                {{ Form::select(
                    'estado_inscripcion',
                    [
                        'ACTIVO' => 'ACTIVO',
                        'NO INCORPORADO' => 'NO INCORPORADO',
                        'RETIRADO' => 'RETIRADO',
                    ],
                    null,
                    ['class' => 'form-control', 'required'],
                ) }}
            </div>
        </div>
    @endif

</div>
