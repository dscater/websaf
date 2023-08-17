<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Área*</label>
            {{ Form::select('area_id',$array_areas,null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Código Materia*</label>
            {{ Form::text('codigo',null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Nombre*</label>
            {{ Form::text('nombre',null,['class'=>'form-control','required']) }}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Nivel*</label>
            @if(isset($materia))
            {{ Form::select('nivel',[
                $materia->nivel => $materia->nivel
            ],null,['class'=>'form-control','required','id'=>"select_nivel"]) }}
            @else
            {{ Form::select('nivel',[
                '' =>  'Seleccione...',
                'NIVEL INICIAL' => 'NIVEL INICIAL',
                'PRIMARIA' => 'PRIMARIA',
                'SECUNDARIA' => 'SECUNDARIA',
            ],null,['class'=>'form-control','required','id'=>"select_nivel"]) }}
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <table class="table table-bordered">
            <thead>
                <tr class="bg-blue">
                    <th>Grado</th>
                    <th>Horas</th>
                </tr>
            </thead>
            <tbody id="contenedor_grados">
                @if(isset($materia))
                    {!! $html !!}
                @endif
            </tbody>
        </table>
    </div>
</div>

