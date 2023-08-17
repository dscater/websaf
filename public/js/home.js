/* GRAFICO 1 */
let filtro1 = $('#filtro1');
let concepto = $('#concepto');
let select_concepto = $('#select_concepto');
let fecha_ini = $('#fecha_ini');
let txt_fecha_ini = $('#txt_fecha_ini');
let fecha_fin = $('#fecha_fin');
let txt_fecha_fin = $('#txt_fecha_fin');

/* GRAFICO 2 */
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

let filtro2 = $('#filtro2');
let gestion = $('#gestion');
let select_gestion = $('#select_gestion');
let nivel = $('#nivel');
let select_nivel = $('#select_nivel');
let grado = $('#grado');
let select_grado = $('#select_grado');
let paralelo = $('#paralelo');
let select_paralelo = $('#select_paralelo');
let turno = $('#turno');
let select_turno = $('#select_turno');

$(document).ready(function () {
    /* GRAFICO 1 */
    filtroIngresosEconomicos();
    graficoIngresosEconomicos();
    filtro1.change(function () {
        filtroIngresosEconomicos();
        graficoIngresosEconomicos();
    });
    select_concepto.change(graficoIngresosEconomicos);
    txt_fecha_ini.change(graficoIngresosEconomicos);
    txt_fecha_fin.change(graficoIngresosEconomicos);

    /* GRAFICO 2 */
    filtroCantidadEstudiantes();
    graficoCantidadEstudiantes();
    filtro2.change(function () {
        filtroCantidadEstudiantes();
    });

    select_gestion.change(graficoCantidadEstudiantes),

        select_nivel.change(function () {
            carga_grados();
            graficoCantidadEstudiantes();
        });
    select_grado.change(graficoCantidadEstudiantes);
    select_paralelo.change(graficoCantidadEstudiantes);
    select_turno.change(graficoCantidadEstudiantes);
});

function filtroIngresosEconomicos() {
    concepto.hide();
    fecha_ini.hide();
    fecha_fin.hide();

    switch (filtro1.val()) {
        case 'todos':
            concepto.hide();
            fecha_ini.hide();
            fecha_fin.hide();
            break;
        case 'concepto':
            concepto.show();
            fecha_ini.hide();
            fecha_fin.hide();
            break;
        case 'fecha':
            concepto.hide();
            fecha_ini.show();
            fecha_fin.show();
            break;
    }
}

function carga_grados() {
    let valor = select_nivel.val();
    if (valor != 'NIVEL INICIAL') {
        select_grado.html(grados);
    } else {
        select_grado.html(grados_inicial);
    }
}

function filtroCantidadEstudiantes() {
    let filtro = filtro2.val();
    gestion.hide();
    nivel.hide();
    grado.hide();
    paralelo.hide();
    turno.hide();
    if (filtro == 'todos') {
        gestion.hide();
        nivel.hide();
        grado.hide();
        paralelo.hide();
        turno.hide();
    } else {
        gestion.show();
        nivel.show();
        grado.show();
        paralelo.show();
        turno.show();
    }
}

function graficoIngresosEconomicos() {
    $.ajax({
        type: "GET",
        url: $('#urlInfoIngresosEconomicos').val(),
        data: {
            filtro: filtro1.val(),
            concepto: select_concepto.val(),
            fecha_ini: txt_fecha_ini.val(),
            fecha_fin: txt_fecha_fin.val(),
        },
        dataType: "json",
        success: function (response) {
            Highcharts.chart('contenedor_grafico', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'INGRESOS ECONÓMICOS'
                },
                subtitle: {
                    text: 'TOTAL: ' + response.total + 'Bs.'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Cantidad'
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'Monto: <b>{point.y:.2f} Bs.</b>'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Monto',
                    // data: [
                    //     ['A',10],
                    //     ['B',20],
                    //     ['C',30]
                    // ],
                    data: response.data,
                    colorByPoint: true,
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.0f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    },
                    // color:'#00a65a',
                }],
                lang: {
                    downloadCSV: 'Descargar CSV',
                    downloadJPEG: 'Descargar imagen JPEG',
                    downloadPDF: 'Descargar Documento PDF',
                    downloadPNG: 'Descargar imagen PNG',
                    downloadSVG: 'Descargar vector de imagen SVG ',
                    downloadXLS: 'Descargar XLS',
                    viewFullscreen: 'Ver pantalla completa',
                    printChart: 'Imprimir',
                    exitFullscreen: 'Salir de pantalla completa'
                }
            });
        }
    });
}

function graficoCantidadEstudiantes() {
    $.ajax({
        type: "GET",
        url: $('#urlInfoCantidadEstudiantes').val(),
        data: {
            filtro: filtro2.val(),
            gestion: select_gestion.val(),
            nivel: select_nivel.val(),
            grado: select_grado.val(),
            paralelo: select_paralelo.val(),
            turno: select_turno.val(),
        },
        dataType: "json",
        success: function (response) {
            Highcharts.chart('contenedor_grafico2', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'CANTIDAD DE ESTUDIANTES'
                },
                subtitle: {
                    text: response.titulo
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Cantidad'
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: '<b>{point.y:.0f} Estudiantes</b>'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Estudiantes',
                    // data: [
                    //     ['A',10],
                    //     ['B',20],
                    //     ['C',30]
                    // ],
                    data: response.data,
                    colorByPoint: true,
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.0f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    },
                    // color:'#00a65a',
                }],
                lang: {
                    downloadCSV: 'Descargar CSV',
                    downloadJPEG: 'Descargar imagen JPEG',
                    downloadPDF: 'Descargar Documento PDF',
                    downloadPNG: 'Descargar imagen PNG',
                    downloadSVG: 'Descargar vector de imagen SVG ',
                    downloadXLS: 'Descargar XLS',
                    viewFullscreen: 'Ver pantalla completa',
                    printChart: 'Imprimir',
                    exitFullscreen: 'Salir de pantalla completa'
                }
            });
        }
    });
}
