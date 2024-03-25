<div class="row">
    <div class="col-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">A</th>
                    <th class="text-center">B</th>
                    <th class="text-center">C</th>
                    <th class="text-center">D</th>
                    <th class="text-center">E</th>
                    <th class="text-center">F</th>
                    <th class="text-center">G</th>
                    <th class="text-center">H</th>
                    <th class="text-center">I</th>
                    <th class="text-center">J</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="pt-1 pb-1 text-center">
                        <input type="checkbox" name="i_a" value="SI"
                            {{ isset($kardex_desempeno) && $kardex_desempeno->i_a != '' && $kardex_desempeno->i_a != null ? 'checked' : '' }}
                            style="height: 30px; width:30px;">
                    </td>
                    <td class="pt-1 pb-1 text-center">
                        <input type="checkbox" name="i_b" value="SI"
                            {{ isset($kardex_desempeno) && $kardex_desempeno->i_b != '' && $kardex_desempeno->i_b != null ? 'checked' : '' }}
                            style="height: 30px; width:30px;">
                    </td>
                    <td class="pt-1 pb-1 text-center">
                        <input type="checkbox" name="i_c" value="SI"
                            {{ isset($kardex_desempeno) && $kardex_desempeno->i_c != '' && $kardex_desempeno->i_c != null ? 'checked' : '' }}
                            style="height: 30px; width:30px;">
                    </td>
                    <td class="pt-1 pb-1 text-center">
                        <input type="checkbox" name="i_d" value="SI"
                            {{ isset($kardex_desempeno) && $kardex_desempeno->i_d != '' && $kardex_desempeno->i_d != null ? 'checked' : '' }}
                            style="height: 30px; width:30px;">
                    </td>
                    <td class="pt-1 pb-1 text-center">
                        <input type="checkbox" name="i_e" value="SI"
                            {{ isset($kardex_desempeno) && $kardex_desempeno->i_e != '' && $kardex_desempeno->i_e != null ? 'checked' : '' }}
                            style="height: 30px; width:30px;">
                    </td>
                    <td class="pt-1 pb-1 text-center">
                        <input type="checkbox" name="i_f" value="SI"
                            {{ isset($kardex_desempeno) && $kardex_desempeno->i_f != '' && $kardex_desempeno->i_f != null ? 'checked' : '' }}
                            style="height: 30px; width:30px;">
                    </td>
                    <td class="pt-1 pb-1 text-center">
                        <input type="checkbox" name="i_g" value="SI"
                            {{ isset($kardex_desempeno) && $kardex_desempeno->i_g != '' && $kardex_desempeno->i_g != null ? 'checked' : '' }}
                            style="height: 30px; width:30px;">
                    </td>
                    <td class="pt-1 pb-1 text-center">
                        <input type="checkbox" name="i_h" value="SI"
                            {{ isset($kardex_desempeno) && $kardex_desempeno->i_h != '' && $kardex_desempeno->i_h != null ? 'checked' : '' }}
                            style="height: 30px; width:30px;">
                    </td>
                    <td class="pt-1 pb-1 text-center">
                        <input type="checkbox" name="i_i" value="SI"
                            {{ isset($kardex_desempeno) && $kardex_desempeno->i_i != '' && $kardex_desempeno->i_i != null ? 'checked' : '' }}
                            style="height: 30px; width:30px;">
                    </td>
                    <td class="pt-1 pb-1 text-center">
                        <input type="checkbox" name="i_j" value="SI"
                            {{ isset($kardex_desempeno) && $kardex_desempeno->i_j != '' && $kardex_desempeno->i_j != null ? 'checked' : '' }}
                            style="height: 30px; width:30px;">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6 form-group">
        <label>Fecha*</label>
        <input type="date" name="fecha"
            value="{{ isset($kardex_desempeno) ? $kardex_desempeno->fecha : date('Y-m-d') }}" class="form-control"
            required>
    </div>
    <div class="col-md-6 form-group">
        <label>Observaciones</label>
        <textarea name="observaciones" rows="1" class="form-control">{{ isset($kardex_desempeno) ? $kardex_desempeno->observaciones : '' }}</textarea>
    </div>

    <div class="col-12 form-group">
        <label>Aspectos positivos</label>
        <textarea name="aspectos_positivos" rows="1" class="form-control">{{ isset($kardex_desempeno) ? $kardex_desempeno->aspectos_positivos : '' }}</textarea>
    </div>

    <div class="col-12">
        <p>INDICADORES:</p>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>A</td>
                    <td>Se atrasó al ingresar a clases</td>
                    <td>F</td>
                    <td>Se distrae con su celular y otros</td>
                </tr>
                <tr>
                    <td>B</td>
                    <td>No asistió a clases</td>
                    <td>G</td>
                    <td>No promueve valores humanos (indisciplina)</td>
                </tr>
                <tr>
                    <td>C</td>
                    <td>No presento sus prácticas - actividades</td>
                    <td>H</td>
                    <td>No cumple con el reglamento (uniforme)</td>
                </tr>
                <tr>
                    <td>D</td>
                    <td>No se presentó a la actividad evaluativa</td>
                    <td>I</td>
                    <td>Apoyo y seguimiento del Padre de Familia</td>
                </tr>
                <tr>
                    <td>E</td>
                    <td>Abandono las clases</td>
                    <td>J</td>
                    <td>Otros.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
