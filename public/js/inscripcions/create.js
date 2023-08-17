var grados = `<option value="">Seleccione...</option>
<option value="1">1º</option>
<option value="2">2º</option>
<option value="3">3º</option>
<option value="4">4º</option>
<option value="5">5º</option>
<option value="6">6º</option>`;

var grados_inicial = `<option value="">Seleccione...</option>
<option value="1">1º</option>
<option value="2">2º</option>`;

let select_nivel = $('#select_nivel');
let select_grado = $('#select_grado');
let paralelo = $('#paralelo');
let input_paralelo = $('#input_paralelo');
let grado_ = $('#grado_');

$(document).ready(function () {
    carga_grados();
    select_nivel.change(function () {
        carga_grados();
    });
});

function carga_grados() {
    let valor = select_nivel.val();
    if (valor != 'NIVEL INICIAL') {
        select_grado.html(grados);
    } else {
        select_grado.html(grados_inicial);
    }
    select_grado.val(grado_.val());
}