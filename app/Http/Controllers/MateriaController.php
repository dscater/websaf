<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use App\MateriaGrado;
use App\ProfesorMateria;
use App\Campo;
use App\Area;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        return view('materias.index', compact('materias'));
    }

    public function create()
    {
        $areas = area::all();

        $array_areas[''] = 'Seleccione...';

        foreach ($areas as $value) {
            $array_areas[$value->id] = $value->nombre . ' (' . $value->tipo . ')';;
        }

        return view('materias.create', compact('array_areas'));
    }

    public function store(Request $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $materia = Materia::create(array_map('mb_strtoupper', $request->except('grado', 'horas')));

        // registrar grados
        $grado = $request->grado;
        $horas = $request->horas;
        for ($i = 0; $i < count($grado); $i++) {
            MateriaGrado::create([
                'materia_id' => $materia->id,
                'grado' => $grado[$i],
                'horas' => $horas[$i]
            ]);
        }

        return redirect()->route('materias.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Materia $materia)
    {
        $areas = area::all();

        $array_areas[''] = 'Seleccione...';

        foreach ($areas as $value) {
            $array_areas[$value->id] = $value->nombre;
        }

        $nivel = $materia->nivel;
        $grados = [
            'NIVEL INICIAL' => [1, 2],
            'PRIMARIA' => [1, 2, 3, 4, 5, 6],
            'SECUNDARIA' => [1, 2, 3, 4, 5, 6],
        ];
        $array_grados = $grados[$nivel];
        $html = '';
        for ($i = 0; $i < count($array_grados); $i++) {
            $materia_grado = MateriaGrado::where('materia_id', $materia->id)
                ->where('grado', $array_grados[$i])
                ->get()->first();
            $html .= '<tr>
                        <td>' . $array_grados[$i] . 'º <input type="hidden" name="grado[]"value="' . $array_grados[$i] . '"/></td><td><input type="number" name="horas[]" value="' . $materia_grado->horas . '" min="1" class="form-control" placeholder="Horas"/></td>
                    </tr>';
        }

        return view('materias.edit', compact('materia', 'array_areas', 'html'));
    }

    public function update(Materia $materia, Request $request)
    {
        $materia->update(array_map('mb_strtoupper', $request->except('grado', 'horas')));
        // actualizar grados
        $grado = $request->grado;
        $horas = $request->horas;
        for ($i = 0; $i < count($grado); $i++) {
            $materia_grado = MateriaGrado::where('materia_id', $materia->id)
                ->where('grado', $grado[$i])
                ->get()
                ->first();
            $materia_grado->horas = $horas[$i];
            $materia_grado->save();
        }

        return redirect()->route('materias.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show()
    {
        $campos = Campo::all();

        $niveles = [
            'NIVEL INICIAL',
            'PRIMARIA',
            'SECUNDARIA',
        ];

        $grados = [
            'NIVEL INICIAL' => [1, 2],
            'PRIMARIA' => [1, 2, 3, 4, 5, 6],
            'SECUNDARIA' => [1, 2, 3, 4, 5, 6],
        ];

        $html = '';
        $sub_total_h = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $sub_total_t = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($campos as $campo) {
            $html .= '<div class="campo">';
            $html .= '<div class="titulo">' . $campo->nombre . '</div>';
            $areas = Area::where('campo_id', $campo->id)->get();
            $html .= '<div class="contenedor_areas">';
            foreach ($areas as $area) {
                $materias_h = Materia::select('materias.*')
                    ->join('areas', 'areas.id', '=', 'materias.area_id')
                    ->where('areas.tipo', 'HUMANÍSTICA')
                    ->where('area_id', $area->id)
                    ->get();

                $materias_t = Materia::select('materias.*')
                    ->join('areas', 'areas.id', '=', 'materias.area_id')
                    ->where('areas.tipo', 'TÉCNICA TECNOLÓGICA')
                    ->where('area_id', $area->id)
                    ->get();

                $html .= '<div class="area">
                            <div class="titulo">' . $area->nombre . '</div>';

                $html .= '<div class="contenedor_materias">';
                if (count($materias_h) > 0) {
                    foreach ($materias_h as $materia) {
                        $html .= '<div class="materia">
                                    <div class="titulo">' . $materia->nombre . '</div>';
                        $contador_subtotal = 0;
                        for ($i = 0; $i < count($niveles); $i++) {
                            $array_grados = $grados[$niveles[$i]];
                            $total_horas_grados = 0;
                            $html .= '<div class="nivel">';
                            for ($j = 0; $j < count($array_grados); $j++) {
                                $materia_grado = MateriaGrado::where('materia_id', $materia->id)
                                    ->where('grado', $array_grados[$j])
                                    ->get()->first();
                                if ($materia_grado) {
                                    $horas = $materia_grado->horas;
                                    $total_horas_grados += (int)$horas;
                                    $html .= '<div class="horas_grado">' . $horas . '</div>';
                                } else {
                                    $html .= '<div class="horas_grado vacio"></div>';
                                }
                                $sub_total_h[$contador_subtotal] = $sub_total_h[$contador_subtotal] + (int)$horas;
                                $contador_subtotal++;
                            }
                            $html .= '<div class="total">' . $total_horas_grados . '</div>
                                    </div>'; //fin nivel
                            $sub_total_h[$contador_subtotal] = $sub_total_h[$contador_subtotal] + $total_horas_grados;
                            $contador_subtotal++;
                        }

                        $html .= '</div>'; //fin materia
                    }
                } else {
                    $html .= '<div class="materia">
                                    <div class="titulo"><span class="sin_materia">Aún no se registraron materias para esta área</span></div>';

                    for ($i = 0; $i < count($niveles); $i++) {
                        $array_grados = $grados[$niveles[$i]];
                        $total_horas_grados = 0;
                        $html .= '<div class="nivel">';
                        for ($j = 0; $j < count($array_grados); $j++) {
                            $html .= '<div class="horas_grado vacio"></div>';
                        }
                        $html .= '<div class="total"></div>
                                    </div>'; //fin nivel
                    }

                    $html .= '</div>'; //fin materia
                }

                if (count($materias_t) > 0) {

                    // SUBTOTAL HUMANISTICA
                    $html .= '<div class="materia subtotal_h">
                                <div class="titulo">SUB TOTAL ÁREA HUMANÍSTICA</div>';
                    $contador_subtotal = 0;
                    for ($i = 0; $i < count($niveles); $i++) {
                        $array_grados = $grados[$niveles[$i]];
                        $html .= '<div class="nivel">';
                        for ($j = 0; $j < count($array_grados); $j++) {
                            $html .= '<div class="horas_grado">' . $sub_total_h[$contador_subtotal] . '</div>';
                            $contador_subtotal++;
                        }
                        $html .= '<div class="total">' . $sub_total_h[$contador_subtotal] . '</div>
                                    </div>'; //fin nivel
                        $contador_subtotal++;
                    }
                    $html .= '</div>'; //fin materia
                    foreach ($materias_t as $materia) {
                        $html .= '<div class="materia">
                                    <div class="titulo">' . $materia->nombre . '</div>';

                        $contador_subtotal = 0;
                        for ($i = 0; $i < count($niveles); $i++) {
                            $array_grados = $grados[$niveles[$i]];
                            $total_horas_grados = 0;
                            $html .= '<div class="nivel">';
                            for ($j = 0; $j < count($array_grados); $j++) {
                                $materia_grado = MateriaGrado::where('materia_id', $materia->id)
                                    ->where('grado', $array_grados[$j])
                                    ->get()->first();
                                if ($materia_grado) {
                                    $horas = $materia_grado->horas;
                                    $total_horas_grados += (int)$horas;
                                    $html .= '<div class="horas_grado">' . $horas . '</div>';
                                } else {
                                    $html .= '<div class="horas_grado vacio"></div>';
                                }
                                $sub_total_t[$contador_subtotal] += (int)$horas;
                                $contador_subtotal++;
                            }
                            $html .= '<div class="total">' . $total_horas_grados . '</div>
                                    </div>'; //fin nivel
                            $sub_total_t[$contador_subtotal] += $total_horas_grados;
                            $contador_subtotal++;
                        }

                        $html .= '</div>'; //fin materia
                    }
                } else {
                    $html .= '<div class="materia">
                                    <div class="titulo"><span class="sin_materia">Aún no se registraron materias para esta área</span></div>';

                    for ($i = 0; $i < count($niveles); $i++) {
                        $array_grados = $grados[$niveles[$i]];
                        $total_horas_grados = 0;
                        $html .= '<div class="nivel">';
                        for ($j = 0; $j < count($array_grados); $j++) {
                            $html .= '<div class="horas_grado vacio"></div>';
                        }
                        $html .= '<div class="total"></div>
                                    </div>'; //fin nivel
                    }

                    $html .= '</div>'; //fin materia
                }

                $html .= '</div>'; //fin contenedor materias
                $html .= '</div>'; //fin area
            }
            $html .= '</div>'; // fin contenedor areas
            $html .= '</div>'; // fin campo
        }
        // SUBTOTAL TECNOLOGIA
        $html .= '<div class="campo sub_total">
                <div class="titulo">SUB TOTAL ÁREA TÉCNICA TECNOLÓGICA</div>';
        $contador_subtotal = 0;
        for ($i = 0; $i < count($niveles); $i++) {
            $array_grados = $grados[$niveles[$i]];
            $html .= '<div class="nivel">';
            for ($j = 0; $j < count($array_grados); $j++) {
                $html .= '<div class="horas_grado">' . $sub_total_t[$contador_subtotal] . '</div>';
                $contador_subtotal++;
            }
            $html .= '<div class="total">' . $sub_total_t[$contador_subtotal] . '</div>
            </div>'; //fin nivel
            $contador_subtotal++;
        }

        $html .= '</div>';


        // TOTALES
        $html .= '<div class="campo sub_total total">
                <div class="titulo">TOTAL HORAS</div>';
        $contador_subtotal = 0;
        for ($i = 0; $i < count($niveles); $i++) {
            $array_grados = $grados[$niveles[$i]];
            $html .= '<div class="nivel">';
            for ($j = 0; $j < count($array_grados); $j++) {
                $html .= '<div class="horas_grado">' . ($sub_total_h[$contador_subtotal] + $sub_total_t[$contador_subtotal]) . '</div>';
                $contador_subtotal++;
            }
            $html .= '<div class="total">' . ($sub_total_h[$contador_subtotal] + $sub_total_t[$contador_subtotal]) . '</div>
            </div>'; //fin nivel
            $contador_subtotal++;
        }

        $html .= '</div>';

        return view('materias.show', compact('html'));
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('materias.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function materiasCalificacions(Request $request)
    {
        $profesor = $request->profesor;
        $gestion = $request->gestion;
        $materias = ProfesorMateria::where('profesor_id', $profesor)
            ->where('gestion', $gestion)
            ->get();

        if (count($materias) > 0) {
            $html = '<option value="">Seleccione...</option>';
            foreach ($materias as $materia) {
                $html .= '<option value="' . $materia->id . '">' . $materia->materia->nombre . ' | ' . $materia->nivel . ' - ' . $materia->grado . 'º ' . $materia->paralelo->paralelo . ' | ' . $materia->turno . '</option>';
            }
        } else {
            $html = '<option value="">- No tiene materias asignadas en la gestión seleccionada -</option>';
        }


        return response()->JSON($html);
    }
}
