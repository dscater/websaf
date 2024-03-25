<table class="table table-bordered">
    <thead>
        <tr>
            <th rowspan="2" width="20px">N°</th>
            <th rowspan="2" width="100px">HORAS</th>
            @foreach ($dias as $key => $d)
                <th class="text-center"
                    colspan="{{ $array_datos[$key]['maximo'] != 0 ? $array_datos[$key]['maximo'] : '1' }}">
                    {{ $d }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach ($dias as $key => $d)
                @if ($array_datos[$key]['maximo'] != 0)
                    @for ($i = 1; $i <= $array_datos[$key]['maximo']; $i++)
                        <th class="text-center">{{ $i }}</th>
                    @endfor
                @else
                    <th class="text-center">-</th>
                @endif
            @endforeach
        </tr>
    </thead>
    <tbody>
        @php
            $cont = 1;
        @endphp
        @foreach ($horas as $index => $h)
            @if ($h->recreo)
                <tr>
                    <td colspan="2">{{ $h->hora_c }}</td>
                    <td colspan="{{ $colspan_recreo }}" class="text-center">RECREO</td>
                </tr>
            @else
                <tr>
                    <td>{{ $cont++ }}</td>
                    <td>{{ $h->hora_c }}</td>
                    @foreach ($dias as $key => $d)
                        @if ($array_datos[$key]['maximo'] != 0)
                            @php
                                $restante = 0;
                                if (count($array_datos[$key]['horarios'][$h->id]) < $array_datos[$key]['maximo']) {
                                    $restante =
                                        (int) $array_datos[$key]['maximo'] -
                                        count($array_datos[$key]['horarios'][$h->id]);
                                }
                            @endphp
                            @foreach ($array_datos[$key]['horarios'][$h->id] as $item)
                                <td class="text-center" style="background:{{ $item->color }}">
                                    {{ $item->materia->codigo }}</td>
                            @endforeach
                            @for ($i = 1; $i <= $restante; $i++)
                                <td class="text-center">-</td>
                            @endfor
                        @else
                            <td class="text-center">-</td>
                        @endif
                    @endforeach
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
