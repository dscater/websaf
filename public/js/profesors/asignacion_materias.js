let select_gestion = $('#select_gestion');

$(document).ready(function () {
    obtiene_materias();
    select_gestion.change(function () {
        obtiene_materias();
    });

});

function obtiene_materias() {
    $('#contenedor_materias').html('Cargando...');
    if (select_gestion.val() != '') {
        $.ajax({
            type: "GET",
            url: $('#urlMaterias').val(),
            data: {
                gestion: select_gestion.val(),
            },
            dataType: "json",
            success: function (response) {
                $('#contenedor_materias').html(response.html);
            }
        });
    } else {
        $('#contenedor_materias').html('<tr><td class="text-center" colspan="6">No se seleccionó una gestión</td></tr>');
    }
}
