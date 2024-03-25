<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Seleccionar Docente*</label>
            {{ Form::select('profesor_id', $array_profesors, null, ['class' => 'form-control', 'required', 'id' => 'profesor_id']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Seleccionar Materia*</label>
            {{ Form::select('profesor_materia_id', isset($array_profesor_materias)?$array_profesor_materias: [], null, ['class' => 'form-control', 'id' => 'profesor_materia_id', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Seleccionar día*</label>
            {{ Form::select(
                'dia',
                [
                    '' => '- Seleccione -',
                    '1' => 'LUNES',
                    '2' => 'MARTES',
                    '3' => 'MIERCOLES',
                    '4' => 'JUEVES',
                    '5' => 'VIERNES',
                ],
                null,
                ['class' => 'form-control', 'id' => 'dia', 'required'],
            ) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Seleccionar hora*</label>
            {{ Form::select('hora_id', $array_horas, null, ['class' => 'form-control', 'id' => 'hora_id', 'required']) }}
        </div>
    </div>
    {{-- <div class="col-md-4">
        <div class="form-group">
            <label>Color*</label>
            <input type="hidden" id="selectedColor" value="{{ isset($horario)?$horario->color:'#ff0000' }}" name="color">
            <div id="colorOptions">
                @if (isset($horario))
                    <div class="color-option" style="background-color: #af0202ce; {{mb_strtolower($horario->color)=='#af0202ce'? 'border: 3px solid #000':''}}"
                        data-color="#af0202ce"></div>
                    <div class="color-option" style="background-color: #ff0000; {{mb_strtolower($horario->color)=='#ff0000'? 'border: 3px solid #000':''}}" data-color="#ff0000"></div>
                    <div class="color-option" style="background-color: #dd7979; {{mb_strtolower($horario->color)=='#dd7979'? 'border: 3px solid #000':''}}" data-color="#dd7979"></div>
                    <div class="color-option" style="background-color: #ffae00; {{mb_strtolower($horario->color)=='#ffae00'? 'border: 3px solid #000':''}}" data-color="#ffae00"></div>
                    <div class="color-option" style="background-color: #fffb00; {{mb_strtolower($horario->color)=='#fffb00'? 'border: 3px solid #000':''}}" data-color="#fffb00"></div>
                    <div class="color-option" style="background-color: #00ff00; {{mb_strtolower($horario->color)=='#00ff00'? 'border: 3px solid #000':''}}" data-color="#00ff00"></div>
                    <div class="color-option" style="background-color: #93efff; {{mb_strtolower($horario->color)=='#93efff'? 'border: 3px solid #000':''}}" data-color="#93efff"></div>
                    <div class="color-option" style="background-color: #ff93f6; {{mb_strtolower($horario->color)=='#ff93f6'? 'border: 3px solid #000':''}}" data-color="#ff93f6"></div>
                    <div class="color-option" style="background-color: #9b4cf5; {{mb_strtolower($horario->color)=='#9b4cf5'? 'border: 3px solid #000':''}}" data-color="#9b4cf5"></div>
                    <div class="color-option" style="background-color: #0000ff; {{mb_strtolower($horario->color)=='#0000ff'? 'border: 3px solid #000':''}}" data-color="#0000ff"></div>
                @else
                    <div class="color-option" style="background-color: #af0202ce;border: 3px solid #000"
                        data-color="#af0202ce"></div>
                    <div class="color-option" style="background-color: #ff0000" data-color="#ff0000"></div>
                    <div class="color-option" style="background-color: #dd7979" data-color="#dd7979"></div>
                    <div class="color-option" style="background-color: #ffae00" data-color="#ffae00"></div>
                    <div class="color-option" style="background-color: #fffb00" data-color="#fffb00"></div>
                    <div class="color-option" style="background-color: #00ff00" data-color="#00ff00"></div>
                    <div class="color-option" style="background-color: #93efff" data-color="#93efff"></div>
                    <div class="color-option" style="background-color: #ff93f6" data-color="#ff93f6"></div>
                    <div class="color-option" style="background-color: #9b4cf5" data-color="#9b4cf5"></div>
                    <div class="color-option" style="background-color: #0000ff" data-color="#0000ff"></div>
                @endif
            </div>
        </div>
    </div> --}}
    <div class="col-md-4">
        <div class="form-group">
            <label>Gestión*</label>
            {{ Form::text('gestion', isset($horario) ? $horario->gestion : $gestion, ['class' => 'form-control', 'id' => 'gestion', 'required', 'readonly']) }}
        </div>
    </div>
</div>
