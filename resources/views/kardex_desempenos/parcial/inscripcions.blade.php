<h5 class="text-center font-weight-bold">{{ $profesor_materia->materia->nombre }}</h5>
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="5%">N°</th>
            <th>Estudiante</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @php
            $cont = 1;
        @endphp
        @foreach ($inscripcions as $value)
            <tr>
                <td>{{ $cont++ }}</td>
                <td>
                    <img src="{{ $value->estudiante->url_foto }}" alt="Foto" style="height: 50px;"
                        class="rounded-circle">
                    {{ $value->estudiante->full_name }}
                </td>
                <td class="btns-opciones">
                    <a href="{{ route('kardex_desempenos.show', [$profesor_materia->id, $value->id]) }}"
                        class="ir-evaluacion"><i class="fa fa-list-alt" data-toggle="tooltip" data-placement="left"
                            title="Kardex Desempeño"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
