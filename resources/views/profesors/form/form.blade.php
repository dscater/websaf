<h5>1. DATOS REFERENCIALES</h5>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Nombre*</label>
            {{ Form::text('nombre', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Paterno*</label>
            {{ Form::text('paterno', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Materno</label>
            {{ Form::text('materno', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>C.I.*</label>
            {{ Form::number('ci', null, ['class' => 'form-control', 'required']) }}
            @if ($errors->has('ci'))
                <span class="invalid-feedback" style="color:red;display:block" role="alert">
                    <strong>{{ $errors->first('ci') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Expedido*</label>
            {{ Form::select(
                'ci_exp',
                [
                    '' => 'Seleccione...',
                    'LP' => 'LA PAZ',
                    'CB' => 'COCHABAMBA',
                    'SC' => 'SANTA CRUZ',
                    'PT' => 'POTOSI',
                    'OR' => 'ORURO',
                    'CH' => 'CHUQUISACA',
                    'TJ' => 'TARIJA',
                    'BN' => 'BENI',
                    'PD' => 'PANDO',
                ],
                null,
                ['class' => 'form-control', 'required'],
            ) }}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Fecha de Nacimiento*</label>
            {{ Form::date('fecha_nac', null, ['class' => 'form-control', 'required', 'id' => 'fecha_nac']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Lugar de Nacimiento*</label>
            {{ Form::text('lugar_nac', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Edad*</label>
            {{ Form::text('edad', null, ['class' => 'form-control', 'required', 'id' => 'edad', 'readonly']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Sexo*</label>
            {{ Form::select(
                'sexo',
                [
                    '' => 'Seleccione...',
                    'M' => 'MASCULINO',
                    'F' => 'FEMENINO',
                ],
                null,
                ['class' => 'form-control', 'required'],
            ) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Zona*</label>
            {{ Form::text('zona', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Avenida*</label>
            {{ Form::text('avenida', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Nro*</label>
            {{ Form::text('nro', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Teléfono</label>
            {{ Form::text('fono', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Celular*</label>
            {{ Form::text('cel', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Correo</label>
            {{ Form::email('email', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Nº RDA*</label>
            {{ Form::text('nro_rda', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>E. Civil*</label>
            {{ Form::text('estado_civil', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>A.F.P.*</label>
            {{ Form::text('afp', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>NUA*</label>
            {{ Form::text('nua', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>ITEM FISCAL*</label>
            {{ Form::text('item_fiscal', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Nº de Seguro Social*</label>
            {{ Form::text('nro_seguro_social', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Caja de Seguro Social*</label>
            {{ Form::text('caja_seguro_social', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>TITULADO(A) DEL PROFOCOM*</label>
            {{ Form::select(
                'titulado',
                [
                    '' => 'Seleccione...',
                    '1RA FASE' => '1RA FASE',
                    '2DA FASE' => '2DA FASE',
                    '3RA FASE' => '3RA FASE',
                    '4TA FASE' => '4TA FASE',
                    'NINGUNO' => 'NINGUNO',
                ],
                null,
                ['class' => 'form-control', 'required'],
            ) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>
    </div>
</div>

<hr>
<h5>2. ESTUDIOS REALIZADOS - FORMACIÓN PROFESIONAL</h5>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>NIVEL</th>
            <th>INSTITUCIÓN</th>
            <th>AÑO EGRESO</th>
            <th>ESPECIALIDAD SEGÚN TÍTULO</th>
            <th>Nº DE TÍTULO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Secundario <input type="hidden" name="estudio_nivel[]" value="Secundario"></td>
            <td><input type="text" name="estudio_institucion[]"
                    value="{{ isset($usuario) ? $usuario->estudios[0]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_anio[]"
                    value="{{ isset($usuario) ? $usuario->estudios[0]->anio_egreso : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_especialidad[]"
                    value="{{ isset($usuario) ? $usuario->estudios[0]->especialidad : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_nro_titulo[]"
                    value="{{ isset($usuario) ? $usuario->estudios[0]->nro_titulo : '' }}" class="form-control"></td>
        </tr>
        <tr>
            <td>Normal <input type="hidden" name="estudio_nivel[]" value="Normal"></td>
            <td><input type="text" name="estudio_institucion[]"
                    value="{{ isset($usuario) ? $usuario->estudios[1]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_anio[]"
                    value="{{ isset($usuario) ? $usuario->estudios[1]->anio_egreso : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_especialidad[]"
                    value="{{ isset($usuario) ? $usuario->estudios[1]->especialidad : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_nro_titulo[]"
                    value="{{ isset($usuario) ? $usuario->estudios[1]->nro_titulo : '' }}" class="form-control"></td>
        </tr>
        <tr>
            <td>Universitario <input type="hidden" name="estudio_nivel[]" value="Universitario"></td>
            <td><input type="text" name="estudio_institucion[]"
                    value="{{ isset($usuario) ? $usuario->estudios[2]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_anio[]"
                    value="{{ isset($usuario) ? $usuario->estudios[2]->anio_egreso : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_especialidad[]"
                    value="{{ isset($usuario) ? $usuario->estudios[2]->especialidad : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_nro_titulo[]"
                    value="{{ isset($usuario) ? $usuario->estudios[2]->nro_titulo : '' }}" class="form-control"></td>
        </tr>
        <tr>
            <td>Post Grado <input type="hidden" name="estudio_nivel[]" value="Post Grado"></td>
            <td><input type="text" name="estudio_institucion[]"
                    value="{{ isset($usuario) ? $usuario->estudios[3]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_anio[]"
                    value="{{ isset($usuario) ? $usuario->estudios[3]->anio_egreso : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_especialidad[]"
                    value="{{ isset($usuario) ? $usuario->estudios[3]->especialidad : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_nro_titulo[]"
                    value="{{ isset($usuario) ? $usuario->estudios[3]->nro_titulo : '' }}" class="form-control"></td>
        </tr>
        <tr>
            <td>Post Grado <input type="hidden" name="estudio_nivel[]" value="Post Grado"></td>
            <td><input type="text" name="estudio_institucion[]"
                    value="{{ isset($usuario) ? $usuario->estudios[4]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_anio[]"
                    value="{{ isset($usuario) ? $usuario->estudios[4]->anio_egreso : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_especialidad[]"
                    value="{{ isset($usuario) ? $usuario->estudios[4]->especialidad : '' }}" class="form-control"></td>
            <td><input type="text" name="estudio_nro_titulo[]"
                    value="{{ isset($usuario) ? $usuario->estudios[4]->nro_titulo : '' }}" class="form-control"></td>
        </tr>
    </tbody>
</table>

<p style="text-decoration: underline; font-weight:bold;">Ultimos 3 Cursos de actualización. (Empezar por el último)</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>NOMINACIÓN DEL CURSO</th>
            <th>INSTITUCIÓN</th>
            <th>DURACIÓN</th>
            <th>FECHA-PERIODO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td><input type="text" name="curso_nominacion[]"
                    value="{{ isset($usuario) ? $usuario->cursos[0]->nominacion : '' }}" class="form-control"></td>
            <td><input type="text" name="curso_institucion[]"
                    value="{{ isset($usuario) ? $usuario->cursos[0]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="curso_duracion[]"
                    value="{{ isset($usuario) ? $usuario->cursos[0]->duracion : '' }}" class="form-control"></td>
            <td><input type="date" name="curso_fecha[]"
                    value="{{ isset($usuario) ? $usuario->cursos[0]->fecha : '' }}" class="form-control"></td>
        </tr>
        <tr>
            <td>2</td>
            <td><input type="text" name="curso_nominacion[]"
                    value="{{ isset($usuario) ? $usuario->cursos[1]->nominacion : '' }}" class="form-control"></td>
            <td><input type="text" name="curso_institucion[]"
                    value="{{ isset($usuario) ? $usuario->cursos[1]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="curso_duracion[]"
                    value="{{ isset($usuario) ? $usuario->cursos[1]->duracion : '' }}" class="form-control"></td>
            <td><input type="date" name="curso_fecha[]"
                    value="{{ isset($usuario) ? $usuario->cursos[1]->fecha : '' }}" class="form-control"></td>
        </tr>
        <tr>
            <td>3</td>
            <td><input type="text" name="curso_nominacion[]"
                    value="{{ isset($usuario) ? $usuario->cursos[2]->nominacion : '' }}" class="form-control"></td>
            <td><input type="text" name="curso_institucion[]"
                    value="{{ isset($usuario) ? $usuario->cursos[2]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="curso_duracion[]"
                    value="{{ isset($usuario) ? $usuario->cursos[2]->duracion : '' }}" class="form-control"></td>
            <td><input type="date" name="curso_fecha[]"
                    value="{{ isset($usuario) ? $usuario->cursos[2]->fecha : '' }}" class="form-control"></td>
        </tr>
    </tbody>
</table>

<hr>
<h5>3. DATOS REFERENTES AL COLEGIO PARTICILAR AAA</h5>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Gestiones que trabajó</label>
            {{ Form::text('gestiones_trabajo', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Cargo que regenta</label>
            {{ Form::text('cargo', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Mes</label>
            {{ Form::text('mes', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>

<hr>
<h5>4. OTROS DATOS</h5>
<p style="text-decoration: underline; font-weight:bold;">Otros Colegios o Instituciones donde trabaja actualmente (no
    incluir a la U.E.P. AAA)</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nº</th>
            <th>NOMBRE DE LA INSTITUCIÓN</th>
            <th>TURNO</th>
            <th>ZONA</th>
            <th>CARGO</th>
            <th>TOTAL HORAS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td><input type="text" name="otros_institucion[]"
                    value="{{ isset($usuario) ? $usuario->otros[0]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="otros_turno[]"
                    value="{{ isset($usuario) ? $usuario->otros[0]->turno : '' }}" class="form-control"></td>
            <td><input type="text" name="otros_zona[]" value="{{ isset($usuario) ? $usuario->otros[0]->zona : '' }}"
                    class="form-control"></td>
            <td><input type="text" name="otros_cargo[]"
                    value="{{ isset($usuario) ? $usuario->otros[0]->cargo : '' }}" class="form-control"></td>
            <td><input type="text" name="otros_horas[]"
                    value="{{ isset($usuario) ? $usuario->otros[0]->total_horas : '' }}" class="form-control"></td>
        </tr>
        <tr>
            <td>2</td>
            <td><input type="text" name="otros_institucion[]"
                    value="{{ isset($usuario) ? $usuario->otros[1]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="otros_turno[]"
                    value="{{ isset($usuario) ? $usuario->otros[1]->turno : '' }}" class="form-control"></td>
            <td><input type="text" name="otros_zona[]" value="{{ isset($usuario) ? $usuario->otros[1]->zona : '' }}"
                    class="form-control"></td>
            <td><input type="text" name="otros_cargo[]"
                    value="{{ isset($usuario) ? $usuario->otros[1]->cargo : '' }}" class="form-control"></td>
            <td><input type="text" name="otros_horas[]"
                    value="{{ isset($usuario) ? $usuario->otros[1]->total_horas : '' }}" class="form-control"></td>
        </tr>
        <tr>
            <td>3</td>
            <td><input type="text" name="otros_institucion[]"
                    value="{{ isset($usuario) ? $usuario->otros[2]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="otros_turno[]"
                    value="{{ isset($usuario) ? $usuario->otros[2]->turno : '' }}" class="form-control"></td>
            <td><input type="text" name="otros_zona[]" value="{{ isset($usuario) ? $usuario->otros[2]->zona : '' }}"
                    class="form-control"></td>
            <td><input type="text" name="otros_cargo[]"
                    value="{{ isset($usuario) ? $usuario->otros[2]->cargo : '' }}" class="form-control"></td>
            <td><input type="text" name="otros_horas[]"
                    value="{{ isset($usuario) ? $usuario->otros[2]->total_horas : '' }}" class="form-control"></td>
        </tr>
    </tbody>
</table>
<p style="text-decoration: underline; font-weight:bold;">Colegios o Instituciones donde trabajó (empezar por el último)
</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nº</th>
            <th>NOMBRE DE LA INSTITUCIÓN</th>
            <th>GESTIÓN(ES)</th>
            <th>CARGO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td><input type="text" name="trabajo_institucion[]"
                    value="{{ isset($usuario) ? $usuario->trabajos[0]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="trabajo_gestion[]"
                    value="{{ isset($usuario) ? $usuario->trabajos[0]->gestion : '' }}" class="form-control"></td>
            <td><input type="text" name="trabajo_cargo[]"
                    value="{{ isset($usuario) ? $usuario->trabajos[0]->cargo : '' }}" class="form-control"></td>
        </tr>
        <tr>
            <td>2</td>
            <td><input type="text" name="trabajo_institucion[]"
                    value="{{ isset($usuario) ? $usuario->trabajos[1]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="trabajo_gestion[]"
                    value="{{ isset($usuario) ? $usuario->trabajos[1]->gestion : '' }}" class="form-control"></td>
            <td><input type="text" name="trabajo_cargo[]"
                    value="{{ isset($usuario) ? $usuario->trabajos[1]->cargo : '' }}" class="form-control"></td>
        </tr>
        <tr>
            <td>3</td>
            <td><input type="text" name="trabajo_institucion[]"
                    value="{{ isset($usuario) ? $usuario->trabajos[2]->institucion : '' }}" class="form-control"></td>
            <td><input type="text" name="trabajo_gestion[]"
                    value="{{ isset($usuario) ? $usuario->trabajos[2]->gestion : '' }}" class="form-control"></td>
            <td><input type="text" name="trabajo_cargo[]"
                    value="{{ isset($usuario) ? $usuario->trabajos[2]->cargo : '' }}" class="form-control"></td>
        </tr>
    </tbody>
</table>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Fecha*</label>
            {{ Form::date('fecha_registro', isset($profesor) ? $profesor->fecha_registro : date('Y-m-d'), ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label>Observaciones</label>
            {{ Form::textarea('observaciones', null, ['class' => 'form-control', 'rows' => '3']) }}
        </div>
    </div>
</div>
