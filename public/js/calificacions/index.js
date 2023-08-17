let vacio = `<tr class="vacio">
<td colspan="30" class="text-center">No se encontrarón registros</td>
</tr>`;

let select_gestion = $('#select_gestion');
let select_materia = $('#select_materia');
let select_trimestre = $('#select_trimestre');

$(document).ready(function () {
    obtieneMaterias();
    obtieneEstudiantes();
    select_materia.change(obtieneEstudiantes);

    select_gestion.change(function () {
        obtieneMaterias();
        obtieneEstudiantes();
    });

    select_trimestre.change(function () {
        obtieneEstudiantes();
    });

    $('#contenedor_materias').on('keyup change', '.fila .calificacion', function (e) {
        let td = $(this);
        let fila = td.closest('.fila');
        let calificacion_id = fila.attr('data-calificacion');
        let data_area = td.attr('data-area');
        let data_actividad = td.attr('data-actividad');
        let nota = td.children('input').val();
        let promedio = fila.find('td.p' + data_area);
        console.log(fila.html());
        let pf = fila.find('td.pf');

        let suma_calificacion = 0;
        let calificacion = 0;
        for (let i = 1; i <= 6; i++) {
            calificacion = fila.find('.a' + data_area + i).children('input').val();
            suma_calificacion += parseFloat(calificacion);
        }

        suma_calificacion = suma_calificacion / 6;
        suma_calificacion = suma_calificacion.toFixed(0);
        promedio.text(suma_calificacion);

        let promedio_final = 0;
        let suma_promedios = 0;
        let valor_promedio = 0;
        for (let i = 1; i <= 4; i++) {
            valor_promedio = fila.find('td.p' + i).text();
            suma_promedios += parseFloat(valor_promedio);
        }
        promedio_final = suma_promedios / 4;
        promedio_final = promedio_final.toFixed(0);
        pf.text(promedio_final);

        $.ajax({
            headers: {
                'x-csrf-token': $('#token').val()
            },
            type: "POST",
            url: $('#urlStoreCalificacion').val(),
            data: {
                calificacion: calificacion_id,
                actividad: data_actividad,
                nota: nota,
                promedio: suma_calificacion,
                area: data_area,
                promedio_final: promedio_final,
                trimestre: select_trimestre.val()
            },
            dataType: "json",
            success: function (response) {
                fila.addClass('correcto');
                setTimeout(function () {
                    fila.removeClass('correcto');
                }, 700);
            }
        });
    });
});

function obtieneMaterias() {

    if (select_gestion.val() != '') {
        $.ajax({
            type: "GET",
            url: $('#urlMaterias').val(),
            data: {
                profesor: $('#prof').val(),
                gestion: select_gestion.val(),
            },
            dataType: "json",
            success: function (response) {
                select_materia.html(response);
            }
        });
    } else {
        select_materia.html('');
    }
}

function obtieneEstudiantes() {
    if (select_gestion.val() != '' && select_materia.val() != '' && select_trimestre.val() != '') {
        $.ajax({
            type: "GET",
            url: $('#urlEstudiantes').val(),
            data: {
                materia: select_materia.val(),
                gestion: select_gestion.val(),
                trimestre: select_trimestre.val()
            },
            dataType: "json",
            success: function (response) {
                $('#contenedor_materias').html(response.html);
            }
        });
    } else {
        $('#contenedor_materias').html(vacio);
    }
}
