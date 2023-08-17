let est = $('#est');
let select_gestion = $('#select_gestion');
let contenedor_notas = $('#contenedor_notas')
$(document).ready(function () {
    cargaNotas();
    select_gestion.change(cargaNotas);
});

function cargaNotas() {
    contenedor_notas.html('Cargando...');
    if (select_gestion.val() != '') {
        $.ajax({
            type: "GET",
            url: $('#urlNotas').val(),
            data: {
                gestion: select_gestion.val(),
            },
            dataType: "json",
            success: function (response) {
                contenedor_notas.html(response.html);
            }
        });
    } else {
        contenedor_notas.html('');
    }
}
