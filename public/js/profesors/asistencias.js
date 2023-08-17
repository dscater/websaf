let selectMes = $('#selectMes');
let selectAnio = $('#selectAnio');
let contenedorAsistencias = $('#contenedorAsistencias');
let header_asistencias = $('#header_asistencias');

$(document).ready(function () {
    obtieneAsistencias();

    selectMes.change(obtieneAsistencias);
    selectAnio.change(obtieneAsistencias);
});

function obtieneAsistencias() {
    $.ajax({
        type: "GET",
        url: $('#urlAsistencias').val(),
        data: {
            mes : selectMes.val(),
            anio : selectAnio.val()
        },
        dataType: "json",
        success: function (response) {
            header_asistencias.html(response.header);
            contenedorAsistencias.html(response.dias);
        }
    });
}
