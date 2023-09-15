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

let select_nivel = $("#select_nivel");
let select_grado = $("#select_grado");
let select_paralelo = $("#select_paralelo");
let select_turno = $("#select_turno");
let gestion = $("#gestion");

$(document).ready(function () {
    obtiene_materias_profesor();
    select_nivel.change(function () {
        carga_grados();
        obtiene_materias();
    });

    select_grado.change(function () {
        obtiene_materias();
    });

    select_paralelo.change(function () {
        obtiene_materias();
    });

    select_turno.change(function () {
        obtiene_materias();
    });

    $("#contenedor_materias").on("click", ".materia.vacio", function (e) {
        let materia = $(this);
        let materia_id = $(this).find("input").val();
        // si esta vacio asignar la materia al profesor
        $.ajax({
            headers: {
                "x-csrf-token": $("#token").val(),
            },
            type: "POST",
            url: $("#urlStoreProfesorMateria").val(),
            data: {
                nivel: select_nivel.val(),
                grado: select_grado.val(),
                gestion: gestion.val(),
                paralelo_id: select_paralelo.val(),
                turno: select_turno.val(),
                materia_id: materia_id,
            },
            dataType: "json",
            success: function (response) {
                materia.removeClass("vacio");
                materia.addClass("correcto");
                obtiene_materias_profesor();
                setTimeout(function () {
                    materia.removeClass("correcto");
                    materia.addClass("asignado");
                }, 500);
            },
        });
    });

    $("#contenedor_materias").on("click", ".materia.asignado", function (e) {
        let materia = $(this);
        let materia_id = $(this).find("input").val();
        // si esta asignado quitar la materia del profesor
        $.ajax({
            headers: {
                "x-csrf-token": $("#token").val(),
            },
            type: "DELETE",
            url: $("#urlDeleteProfesorMateria").val(),
            data: {
                nivel: select_nivel.val(),
                grado: select_grado.val(),
                gestion: gestion.val(),
                paralelo: select_paralelo.val(),
                turno: select_turno.val(),
                materia_id: materia_id,
            },
            dataType: "json",
            success: function (response) {
                materia.removeClass("asignado");
                materia.addClass("correcto");
                obtiene_materias_profesor();
                setTimeout(function () {
                    materia.removeClass("correcto");
                    materia.addClass("vacio");
                }, 500);
            },
        });
    });
});

function carga_grados() {
    let valor = select_nivel.val();
    if (valor != "NIVEL INICIAL") {
        select_grado.html(grados);
    } else {
        select_grado.html(grados_inicial);
    }
}

function obtiene_materias() {
    $("#contenedor_materias").html("Cargando...");
    if (
        select_nivel.val() != "" &&
        select_grado.val() != "" &&
        select_paralelo.val() != "" &&
        select_turno.val() != ""
    ) {
        $.ajax({
            type: "GET",
            url: $("#urlMaterias").val(),
            data: {
                profesor_id: $("#prof").val(),
                nivel: select_nivel.val(),
                grado: select_grado.val(),
                gestion: gestion.val(),
                paralelo: select_paralelo.val(),
                turno: select_turno.val(),
            },
            dataType: "json",
            success: function (response) {
                $("#contenedor_materias").html(response.html);
            },
        });
    } else {
        $("#contenedor_materias").html("");
    }
}

function obtiene_materias_profesor() {
    $("#contenedor_materias_profesor").html("Cargando...");
    if ($("#gestion").val() != "") {
        $.ajax({
            type: "GET",
            url: $("#urlMateriaActuales").val(),
            data: {
                gestion: $("#gestion").val(),
            },
            dataType: "json",
            success: function (response) {
                $("#txt_gestion").text($("#gestion").val());
                $("#contenedor_materias_profesor").html(response.html);
            },
        });
    } else {
        $("#contenedor_materias").html(
            '<tr><td class="text-center" colspan="6">No se seleccionó una gestión</td></tr>'
        );
    }
}
