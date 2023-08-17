<h5>1. DATOS DE LA O EL ESTUDIANTE</h5>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Apellido(s) y Nombre(s)*</label>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::text('paterno', null, ['class' => 'form-control', 'required','placeholder'=>'Apellido Paterno']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::text('materno', null, ['class' => 'form-control','placeholder'=>'Apellido Materno']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::text('nombre', null, ['class' => 'form-control', 'required','placeholder'=>'Nombre(s)*']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Cédula de Identidad*</label>
            <div class="row">
                <div class="col-md-6">
                    {{ Form::number('nro_doc', null, ['class' => 'form-control', 'required','placeholder'=>'Nro. Documento*']) }}
                    @if ($errors->has('nro_doc'))
                        <span class="invalid-feedback" style="color:red;display:block" role="alert">
                            <strong>{{ $errors->first('nro_doc') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-6">
                    {{ Form::select('ci_exp',[
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
                    null,['class' => 'form-control', 'required'],
                    ) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Fecha de Nacimiento*</label>
            {{ Form::date('fecha_nac', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>    
    <div class="col-md-3">
        <div class="form-group">
            <label>Sexo*</label>
            {{ Form::select('sexo',[
                '' => 'Seleccione...',
                'M' => 'MASCULINO',
                'F' => 'FEMENINO'
            ], null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Lugar de Nacimiento*</label>
            <div class="row">
                <div class="col-md-3">
                    {{ Form::text('pais_nac', null, ['class' => 'form-control', 'required','placeholder'=>'País']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::text('dpto_nac', null, ['class' => 'form-control', 'required','placeholder'=>'Departamento']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::text('provincia_nac', null, ['class' => 'form-control', 'required','placeholder'=>'Provincia']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::text('localidad_nac', null, ['class' => 'form-control', 'required','placeholder'=>'Localidad']) }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Certificado de Nacimiento*</label>
            <div class="row">
                <div class="col-md-3">
                    {{ Form::text('oficialia', null, ['class' => 'form-control', 'required','placeholder'=>'Oficialía Nº']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::text('libro', null, ['class' => 'form-control', 'required','placeholder'=>'Libro Nº']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::text('partida', null, ['class' => 'form-control', 'required','placeholder'=>'Partida Nº']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::text('folio', null, ['class' => 'form-control', 'required','placeholder'=>'Folio Nº']) }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Dirección actual*</label>
            <div class="row">
                <div class="col-md-3">
                    {{ Form::text('provincia_dir', null, ['class' => 'form-control', 'required','placeholder'=>'Provincia']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::text('municipio_dir', null, ['class' => 'form-control', 'required','placeholder'=>'Sección / Municipio']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::text('localidad_dir', null, ['class' => 'form-control', 'required','placeholder'=>'Localidad / Comunidad']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::text('zona_dir', null, ['class' => 'form-control', 'required','placeholder'=>'Zona / Villa']) }}
                </div>
            </div>
            <label></label>
            <div class="row">
                <div class="col-md-3">
                    {{ Form::text('avenida_dir', null, ['class' => 'form-control', 'required','placeholder'=>'Avenida / Calle']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::text('fono_dir', null, ['class' => 'form-control', 'required','placeholder'=>'Teléfono/Celular']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::text('nro_dir', null, ['class' => 'form-control', 'required','placeholder'=>'Número de vivienda']) }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            @if(isset($usuario))
            <label>Fotografía</label>
            <input type="file" name="foto" class="form-control">
            @else
            <label>Fotografía*</label>
            <input type="file" name="foto" class="form-control" required>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Unidad Educativa de Procedencia</label>
            <div class="row">
                <div class="col-md-4">
                    {{ Form::text('codigo_sie_ue', null, ['class' => 'form-control','placeholder'=>'Código SIE de la U.E.']) }}
                </div>
                <div class="col-md-8">
                    {{ Form::text('ue_procedencia', null, ['class' => 'form-control','placeholder'=>'Nombre de la Unidad Educativa']) }}
                </div>
            </div>
        </div>
    </div>
</div>

<h5>2. ASPECTOS SOCIALES</h5>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>¿Cuál es el idioma que aprendio a hablar en su niñez la o el estudiante?</label>
            {{Form::text('idioma_niniez',null,['class'=>'form-control','required'])}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>¿Qué idiomas habla frecuentemente la o el estudiante?</label>
            {{Form::text('idiomas_estudiante',null,['class'=>'form-control','required'])}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>¿Pertenece a alguna nación, pueblo indígena originario campesino o afroboliviano?</label>
            {{ Form::select('pueblo_nacion',[
                'NO PERTENECE' => 'No pertenece',
                'AFROBOLIVIANO' => 'Afroboliviano',
                'ARAONA' => 'Araona',
                'AYMARA' => 'Aymara',
                'BAURE' => 'Baure',
                'BÉSIRO' => 'Bésiro',
                'CANICHANA' => 'Canichana',
                'CAVINEÑO' => 'Cavineño',
                'CAYUBABA' => 'Cayubaba',
                'CHACOBO' => 'Chacobo',
                'CHIMAN' => 'Chiman',
                'ESEEJJA' => 'EseEjja',
                'GUARANÍ' => 'Guaraní',
                'GUARASUAWE' => 'Guarasuawe',
                'GUARAYO' => 'Guarayo',
                'ITONOMA' => 'Itonoma',
                'LECO' => 'Leco',
                'MACHAJUYAI-KALLAWAYA' => 'Machajuyai-Kallawaya',
                'MACHINERI' => 'Machineri',
                'MAROPA' => 'Maropa',
                'MOJEÑO-IGNACIANO' => 'Mojeño-Ignaciano',
                'MOJEÑO-TRINITARIO' => 'Mojeño-Trinitario',
                'MORÉ' => 'Moré',
                'MOSETÉN' => 'Mosetén',
                'MOVIMA' => 'Movima',
                'TACAWARA' => 'Tacawara',
                'PUQUINA' => 'Puquina',
                'QUECHUA' => 'Quechua',
                'SIRIONÓ' => 'Sirionó',
                'TACANA' => 'Tacana',
                'TAPIETE' => 'Tapiete',
                'TOROMONA' => 'Toromona',
                'URU-CHIPAYA' => 'Uru-Chipaya',
                'WEENHAYEK' => 'Weenhayek',
                'YAMINAWA' => 'Yaminawa',
                'YUKI' => 'Yuki',
                'YURACARÉ' => 'Yuracaré',
                'ZAMUCO' => 'Zamuco',
                'OTRO' => 'Otro',
            ],null,['class'=>'form-control','required','id'=>'pueblo_nacion_otro_select'])}}
            <br>
            {{ Form::text('pueblo_nacion_otro',null,['class'=>'form-control','id'=>'pueblo_nacion_otro_input','placeholder'=>'Otro especificar']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>¿Existe Centro de Salud / Posta / Hospital en su comunidad?</label>
            {{ Form::select('centro_salud',[
                '' => 'Seleccione...',
                'SI' => 'SI',
                'NO' => 'NO'
        ],null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>¿Cuantas veces fue la o el estudiante al centro de salud el año pasado?</label>
            {{ Form::select('veces_centro_salud',[
                '' => 'Seleccione...',
                '1 A 2 VECES' => '1 A 2 VECES',
                '3 A 5 VECES' => '3 A 5 VECES',
                '6 O MÁS VECES' => '6 O MÁS VECES',
                'NINGUNA' => 'NINGUNA',
        ],null,['class'=>'form-control','required']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Presenta la o el estudiante alguna discapacidad</label>
            {{ Form::select('discapacidad',[
                '' => 'Ninguno',
                'SENSORIAL Y DE LA COMUNICACIÓN' => 'Sensorial y de la comunicación',
                'MOTRIZ' => 'Motriz',
                'MENTAL' => 'Mental',
                'OTRO' => 'Otro',
            ],null,['class'=>'form-control','id'=>'select_discapacidad']) }}
            <br>
            {{Form::text('discapacidad_otro',null,['class'=>'form-control','id'=>'dis_otro_input','placeholder'=>'Otro especificar'])}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Su discapacidad es</label>
            {{ Form::select('desc_discapacidad',[
                '' => 'Ninguno',
                'DE NACIMIENTO' => 'De nacimiento',
                'ADQUIRIDA' => 'Adquirida',
                'HEREDITARIA' => 'Hereditaria',
            ],null,['class'=>'form-control']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>El agua de su casa proviene de</label>
            {{Form::select('agua',[
                '' => 'Seleccione...',
                'CAÑERÍA DE RED' => 'Cañería de red',
                'PILETA PÚBLICA' => 'Pileta pública',
                'CARRO REPARTIDOR (AGUATERO)' => 'Carro repartidor (aguatero)',
                'POZO (CON O SIN BOMBA)' => 'Pozo (con o sin bomba)',
                'RÍO, VERTIENTE, ACEQUÍA, LAGO, LAGUNA, CURICHE' => 'Río, vertiente, acequía, lago, laguna, curiche',
            ],null,['class'=>'form-control','required'])}}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>¿La o el estudiante tiene energía eléctrica en su vivienda</label>
            {{Form::select('energia_electrica',[
                ''=>'Seleccione...',
                'SI' => 'SI',
                'NO' => 'NO'
            ],null,['class'=>'form-control','required'])}}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>El baño, water o letrina de su casa tiene desague a</label>
            {{Form::select('banio',[
                ''=>'Seleccione...',
                'ALCANTARILLADO' => 'Alcantarillado',
                'CÁMARA SÉPTICA' => 'Cámara séptica',
                'POZO CIEGO' => 'Pozo ciego',
                'A LA CALLE' => 'A la calle',
                'A QUEBRADA, RÍO, LAGO, LAGUNA, CURICHE' => 'A quebrada, río, lago, laguna, curiche',
            ],null,['class'=>'form-control','required'])}}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>¿Realizó la o el estudiante en los últimos 3 meses alguna de las siguientes actividades?</label>
            {{Form::select('actividad',[
                ''=>'Seleccione...',
                'TRABAJÓ EN AGRICULTURA O AGROINDUSTRIA' => 'Trabajó en agricultura o agroindustria',
                'AYUDÓ A FAMILIARES EN AGRICULTURA O GANADERÍA' => 'Ayudó a familiares en agricultura o ganadería',
                'AYUDÓ EN EL HOGAR EN LABORES DOMÉSTICAS, COMERCIO O VENTAS' => 'Ayudó en el hogar en labores domésticas, comercio o ventas',
                'TRABAJÓ COMO TRABAJADORA DEL HOGAR O NIÑERA' => 'Trabajó como trabajadora del hogar o niñera',
                'TRABAJÓ EN MINERÍA' => 'Trabajó en minería',
                'TRABAJÓ EN CONSTRUCCIÓN' => 'Trabajó en construcción',
                'TRABAJÓ EN TRANSPORTE PÚBLICO' => 'Trabajó en transporte público',
                'OTRO TRABAJO' => 'Otro trabajo',
                'NO TRABAJÓ' => 'No trabajó',
            ],null,['class'=>'form-control','required'])}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <label>La semana pasada ¿Cuántos días trabajó o ayudó  a la familia la o el estudiante</label>
        {{ Form::number('dias_trabajo',null,['class'=>'form-control']) }}
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>¿Recibió algún pago por el trabajo realizado?</label>
            {{ Form::select('recibio_pago',[
                '' => '',
                'SI' => 'SI',
                'NO' => 'NO'
            ],null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>La o el estudiante accede a internet en</label>
            {{ Form::select('internet',[
                '' => 'Seleccione...',
                'SU DOMICILIO' => 'Su domicilio',
                'EN LA UNIDAD EDUCATIVA' => 'En la Unidad Educativa',
                'LUGARES PÚBLICOS' => 'Lugares públicos',
                'NO ACCEDE A INTERNET' => 'No accede a internet',
            ],null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>¿Con qué frecuencia la o el estudiante accede a internet</label>
            {{ Form::select('frecuencia_internet',[
                '' => 'Seleccione...',
                'DIARIAMENTE' => 'Diariamente',
                'MÁS DE UNA VEZ A LA SEMANA' => 'Más de una vez a la semana',
                'UNA VEZ AL MES O MENOS' => 'Una vez al mes o menos',
            ],null,['class'=>'form-control','required']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>¿Cómo llega la o el estudiante a la Unidad Educativa?</label>
            {{ Form::select('llega',[
                '' => 'Seleccione...',
                'A PIE' => 'A pie',
                'EN VEHÍCULO DE TRANSPORTE TERRESTRE' => 'En vehículo de transporte terrestre',
                'OTRO MEDIO' => 'Otro medio',
            ],null,['class'=>'form-control','required','id'=>'select_llega']) }}
            <br>
            {{ Form::text('llega_otro',null,['class'=>'form-control','id'=>'llega_otro_input','placeholder'=>'Otro especificar']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>En el medio de transporte señalado ¿Cuál es el tiempo máximo que demora en llegar de su casa a la Unidad Educativa o viceversa?</label>
            {{ Form::select('desc_llega',[
                '' => 'Seleccione...',
                'MENOS DE MEDIA HORA' => 'Menos de media hora',
                'ENTRE MEDIA HORA Y UNA HORA' => 'Entre media hora y una hora',
                'ENTRE UNA A DOS HORAS' => 'Entre una a dos horas',
                'DOS HORAS O MÁS' => 'Dos horas o más',
            ],null,['class'=>'form-control','required']) }}
        </div>
    </div>
</div>

<h5>3. DATOS DEL PADRE, MADRE O TUTOR(A) DE LA O EL ESTUDIANTE</h5>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Datos del padre o tutor(a)</label>
            <div class="row">
                <div class="col-md-3">
                    {{Form::text('ci_padre_tutor',null,['class'=>'form-control','placeholder'=>'Cédula de identidad','required'])}}
                </div>
                <div class="col-md-3">
                    {{Form::text('ap_padre_tutor',null,['class'=>'form-control','placeholder'=>'Apellidos','required'])}}
                </div>
                <div class="col-md-3">
                    {{Form::text('nom_padre_tutor',null,['class'=>'form-control','placeholder'=>'Nombre(s)','required'])}}
                </div>
                <div class="col-md-3">
                    {{Form::text('idioma_padre_tutor',null,['class'=>'form-control','placeholder'=>'Idioma que habla frecuentemente','required'])}}
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-3">
                    {{Form::text('ocupacion_padre_tutor',null,['class'=>'form-control','placeholder'=>'Ocupación laboral actual','required'])}}
                </div>
                <div class="col-md-3">
                    {{Form::text('grado_padre_tutor',null,['class'=>'form-control','placeholder'=>'Mayor grado de instrucción alcanzado','required'])}}
                </div>
                <div class="col-md-3">
                    {{Form::text('parentezco_padre_tutor',null,['class'=>'form-control','placeholder'=>'En caso de tutor(a) ¿Cuál es el parentesco?'])}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Datos de la madre</label>
            <div class="row">
                <div class="col-md-3">
                    {{Form::text('ci_madre',null,['class'=>'form-control','placeholder'=>'Cédula de identidad'])}}
                </div>
                <div class="col-md-3">
                    {{Form::text('ap_madre',null,['class'=>'form-control','placeholder'=>'Apellidos'])}}
                </div>
                <div class="col-md-3">
                    {{Form::text('nom_madre',null,['class'=>'form-control','placeholder'=>'Nombre(s)'])}}
                </div>
                <div class="col-md-3">
                    {{Form::text('idioma_madre',null,['class'=>'form-control','placeholder'=>'Idioma que habla frecuentemente'])}}
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-3">
                    {{Form::text('ocupacion_madre',null,['class'=>'form-control','placeholder'=>'Ocupación laboral actual'])}}
                </div>
                <div class="col-md-3">
                    {{Form::text('grado_madre',null,['class'=>'form-control','placeholder'=>'Mayor grado de instrucción alcanzado'])}}
                </div>
            </div>
        </div>
    </div>
</div>