let especifica_concepto = $('#especifica_concepto');
let especifica_nombre_factura = $('#especifica_nombre_factura');
let especifica_nit_factura = $('#especifica_nit_factura');

let select_estudiante = $('#select_estudiante');
let select_concepto = $('#select_concepto');
let select_tipo_factura = $('#select_tipo_factura');
let select_gestion = $('#select_gestion');
let monto_pago = $('#monto_pago');
$(document).ready(function () {

    select_gestion.change(obtieneMontoConcepto);
    select_estudiante.change(function () {
        obtieneMontoConcepto();
        getInfoPadreTutor();
    });

    select_concepto.change(function () {
        let valor = $(this).val();
        if (valor == 'OTRO PAGO') {
            monto_pago.removeAttr('readonly');
            especifica_concepto.removeClass('oculto');
            especifica_concepto.find('input').prop('required', 'required');
        } else {
            especifica_concepto.addClass('oculto');
            especifica_concepto.find('input').removeAttr('required', 'required');
            monto_pago.prop('readonly', 'readonly');
            obtieneMontoConcepto();
        }
    });

    select_tipo_factura.change(function () {
        let valor = $(this).val();
        if (valor == 'OTRO') {
            especifica_nombre_factura.find('input').removeAttr('readonly');
            especifica_nombre_factura.find('input').prop('required', 'required');

            especifica_nit_factura.find('input').removeAttr('readonly');
            especifica_nit_factura.find('input').prop('required', 'required');
        } else {
            especifica_nombre_factura.find('input').attr('readonly', 'readonly');
            especifica_nombre_factura.find('input').removeAttr('required');

            especifica_nit_factura.find('input').attr('readonly', 'readonly');
            especifica_nit_factura.find('input').removeAttr('required');

            if (select_estudiante.val() != '') {
                getInfoPadreTutor();
            }
        }
    });
});

function obtieneMontoConcepto() {
    if (select_estudiante.val() != '' && select_concepto.val() != '' && select_gestion.val() != '') {
        if (select_concepto.val() != 'OTRO PAGO') {
            $.ajax({
                type: "GET",
                url: $('#urlMontoConcepto').val(),
                data: {
                    gestion: select_gestion.val(),
                    estudiante_id: select_estudiante.val(),
                    concepto: select_concepto.val()
                },
                dataType: "json",
                success: function (response) {
                    monto_pago.val(response.plan_pago.monto);
                }
            });
        }
    } else {
        monto_pago.val('');
    }
}

function getInfoPadreTutor() {
    $.ajax({
        type: "GET",
        url: $('#urlInfoPadreTutor').val(),
        data: {
            estudiante_id: select_estudiante.val(),
            tipo_factura: select_tipo_factura.val(),
        },
        dataType: "json",
        success: function (response) {
            especifica_nombre_factura.find('input').val(response.nombre);
            especifica_nit_factura.find('input').val(response.nit);
        }
    });
}
