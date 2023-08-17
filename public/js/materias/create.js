var grados = `<tr><td>1º <input type="hidden" name="grado[]"value="1"/></td><td><input type="number" name="horas[]" min="1" class="form-control" placeholder="Horas"/></td></tr>
<tr><td>2º <input type="hidden" name="grado[]"value="2"/></td><td><input type="number" name="horas[]" min="1" class="form-control" placeholder="Horas"/></td></tr>
<tr><td>3º <input type="hidden" name="grado[]"value="3"/></td><td><input type="number" name="horas[]" min="1" class="form-control" placeholder="Horas"/></td></tr>
<tr><td>4º <input type="hidden" name="grado[]"value="4"/></td><td><input type="number" name="horas[]" min="1" class="form-control" placeholder="Horas"/></td></tr>
<tr><td>5º <input type="hidden" name="grado[]"value="5"/></td><td><input type="number" name="horas[]" min="1" class="form-control" placeholder="Horas"/></td></tr>
<tr><td>6º <input type="hidden" name="grado[]"value="6"/></td><td><input type="number" name="horas[]" min="1" class="form-control" placeholder="Horas"/></td></tr>`;

var grados_inicial = `<tr><td>1º <input type="hidden" name="grado[]"value="1"/></td><td><input type="number" name="horas[]" min="1" class="form-control" placeholder="Horas"/></td></tr>
<tr><td>2º <input type="hidden" name="grado[]"value="2"/></td><td><input type="number" name="horas[]" min="1" class="form-control" placeholder="Horas"/></td></tr>`;

let select_nivel = $('#select_nivel');
let contenedor_grados = $('#contenedor_grados');

$(document).ready(function () {
    cargaGrados();
    select_nivel.change(function () {
        cargaGrados();
    });
});

function cargaGrados() {
    let valor = select_nivel.val();
    if(valor!=''){
        if (valor != 'NIVEL INICIAL') {
            contenedor_grados.html(grados);
        } else {
            contenedor_grados.html(grados_inicial);
        }
    }else{
        contenedor_grados.html('');
    }
}
