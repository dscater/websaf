let selectMes = $("#selectMes");
let selectAnio = $("#selectAnio");
let contenedorAsistencias = $("#contenedorAsistencias");
let header_asistencias = $("#header_asistencias");
let select_materia = $("#select_materia");
let txt_gestion = $("#txt_gestion");
$(document).ready(function () {
    obtieneMaterias();
    obtieneAsistencias();
    select_materia.change(obtieneAsistencias);

    selectAnio.change(function () {
        txt_gestion.text(selectAnio.val());
        obtieneMaterias();
        obtieneAsistencias();
    });
});

function obtieneAsistencias() {
    // console.log(select_materia.val());
    txt_gestion.text(selectAnio.val());
    if (select_materia.val() && select_materia.val() != "") {
        $.ajax({
            type: "GET",
            url: $("#urlAsistencias").val(),
            data: {
                mes: selectMes.val(),
                anio: selectAnio.val(),
                materia: select_materia.val(),
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                header_asistencias.html(response.header);
                contenedorAsistencias.html(response.filas);
            },
        });
    } else {
        header_asistencias.html("");
        contenedorAsistencias.html("");
    }
}

function obtieneMaterias() {
    txt_gestion.text(selectAnio.val());
    if (selectAnio.val() != "") {
        $.ajax({
            type: "GET",
            url: $("#urlMaterias").val(),
            data: {
                profesor: $("#prof").val(),
                gestion: selectAnio.val(),
            },
            dataType: "json",
            success: function (response) {
                select_materia.html(response);
            },
        });
    } else {
        select_materia.html("");
    }
}
