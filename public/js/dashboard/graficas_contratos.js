$(document).ajaxSuccess(function (event, request, settings) {
    $(document).ready(function () {
        $("#contrato").formSelect();
    });

    let output = request.responseText;
    let jsonResponse = JSON.parse(output);
    //console.log(jsonResponse);

    // Respuestas
    let entregables = jsonResponse["dato"];
    let facturas = jsonResponse["facturacion"];
    let cierre = jsonResponse["cierre"];
    let niveles_servicio = jsonResponse["niveles_servicio"];

    // Facturacion
    let recibidas;
    let progreso;
    let pagadas;

    if (entregables) {
        let c_entregables = document.querySelector("#resultado_entregables");
        c_entregables.style.display = "grid";
        //c_entregables.style.padding = "15px 5px 0 5px";
        c_entregables.classList.add("card");
        let html = `
            <div style="width: 100%; padding: 15px 15px 0 15px"">
            <div style="padding:10px 15px">
            <h4 class="card-title graficas_titulos graficas_titulo1"
                style="display: flex; align-items: center; justify-content: center;">
               Entregables
            </h4>
            </div>
            </div>
            <div class="table-responsive">
            <table class="table datatable" id="table-entregables">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th style="width:20%;">Fecha Programada</th>
                        <th style="width:20%;">Fecha Real</th>
                        <th style="width:20%;">Fecha Desfase</th>
                    </tr>
                </thead>
                <tbody>`;
        html += entregables
            .map(entregable => {
                let entregaProgramada = moment(
                    entregable.plazo_entrega_termina
                );
                let entregaReal = moment(entregable.entrega_real);
                let desfase = entregaReal.diff(entregaProgramada, "days");
                if (isNaN(desfase)) {
                    desfase = "";
                }
                let txt_programada = "";
                if (entregable.plazo_entrega_termina != null) {
                    txt_programada = `<i class="fas fa-calendar-alt"></i> ${entregaProgramada.format(
                        "DD-MM-YYYY"
                    )}`;
                }

                let txt_real = "";
                if (entregable.entrega_real != null) {
                    txt_real = `<i class="fas fa-calendar-alt"></i> ${entregaReal.format(
                        "DD-MM-YYYY"
                    )}`;
                }

                let txt_desfase = "";
                if (desfase != undefined) {
                    if (desfase > 0) {
                        txt_desfase = `<i class="fas fa-calendar-times" style="color:#ff4e4b"></i> ${desfase} días`;
                    } else if (desfase === 0) {
                        txt_desfase = `<i class="fas fa-calendar-day" style="color:#17de8c"></i> Sin desfase`;
                    } else if (desfase < 0) {
                        txt_desfase = `<i class="fas fa-calendar-plus" style="color:#17de8c"></i> Sin desfase`;
                    }
                }

                return `
                    <tr>
                        <td style="padding: 0;" class="txt-table">
                            ${entregable.no_entrega}
                        </td>
                        <td style="padding: 5px;" class="texto-tabla">
                            ${entregable.nombre_entregable}
                        </td>
                        <td style="padding: 0;" class="texto-tabla">
                            ${txt_programada}
                        </td>
                        <td style="padding: 0;" class="texto-tabla">
                            ${txt_real}
                        </td>
                        <td style="padding: 0;" class="texto-tabla">
                            ${txt_desfase}
                        </td>
                    </tr>
                `;
            })
            .join("");
        html += `
                    </tbody>
                </tableid=>
            </div>`;

        c_entregables.innerHTML = html;
        render_entregables_table();
    }

    if (facturas) {
        recibidas = facturas.recibidas;
        progreso = facturas.progreso;
        pagadas = facturas.pagadas;
        let c_grafica_facturacion = document.querySelector(
            "#c_grafica_facturacion"
        );
        c_grafica_facturacion.style.display = "grid";
        c_grafica_facturacion.classList.add("card");
        let titulo_grafica_facturacion = document.querySelector(
            "#titulo_grafica_facturacion"
        );
        titulo_grafica_facturacion.innerHTML = `
        <div style="padding:10px 15px">
            <h4 class="card-title graficas_titulos graficas_titulo2"
                style="display: flex; align-items: center; justify-content: center;">
                Facturas
            </h4>
        </div>
        `;
        let tabla = document.querySelector("#tbl_facturas");
        let html = `
        <div class="table-responsive">
            <table class="table datatable" id="dtbl_facturas">
                <thead>
                    <tr>
                        <th>No. Factura</th>
                        <th>Cumple</th>
                        <th>Monto Total</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>`;
        html += facturas.facturas
            .map(factura => {
                let formato_numero = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' });
                let monto_factura = formato_numero.format(factura.monto_factura);
                return `<tr>
                            <td>${factura.no_factura}</td>
                            <td> <i class="fas fa-${factura.cumple == 1 ? "check" : "times"
                    }"
                                    style="color:${factura.cumple == 1 ? "green" : "red"
                    }"></i>
                            </td>
                            <td>${monto_factura}</td>
                            <td>${factura.estatus}</td>
                        </tr>`;
            })
            .join("");
        html += `
                </tbody>
            </table>
            </div>`;
        tabla.innerHTML = html;
        render_table_facturacion();

        Highcharts.chart("grafica_facturacion", {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: "pie"
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        userCallback: function(label, index, labels) {
                            // when the floored value is the same as the value we have a whole number
                            if (Math.floor(label) === label) {
                                return label;
                            }

                        },
                    }
                }],
            },
            title: {
                text: ""
            },
            tooltip: {
                pointFormat: "{series.name}: <b>{point.percentage:}</b>"
            },
            accessibility: {
                point: {
                    valueSuffix: ""
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: "pointer",
                    dataLabels: {
                        enabled: true,
                        format: "<b>{point.name}</b>: {point.y}"
                    }
                }
            },
            series: [
                {
                    name: "Facturas",
                    colorByPoint: true,
                    data: [
                        {
                            name: "Recibidas",
                            y: recibidas,
                            sliced: true,
                            selected: true
                        },
                        {
                            name: "En Proceso",
                            y: progreso,
                            sliced: true,
                            selected: true
                        },
                        {
                            name: "Pagadas",
                            y: pagadas,
                            sliced: true,
                            selected: true
                        }
                    ]
                }
            ]
        });
    }

    if (cierre) {
        let contador_pendiente = 0;
        let contador_cumple = 0;
        let contador_no_cumple = 0;
        // console.log(cierre);
        cierre.forEach(element => {
            if (element.cumple == 1){
                contador_cumple++;
            }if(element.cumple == null){
                contador_no_cumple++;
            }if(element.cumple == 2){
                contador_pendiente++;
            }
        });
        // Renderizamos tabla
        let titulo_cierre = document.querySelector("#titulo_cierre");
        titulo_cierre.innerHTML = `
            <div style="padding:10px 15px">
                <h4 class="card-title graficas_titulos graficas_titulo3"
                    style="display: flex; align-items: center; justify-content: center;">
                    Cierre del proyecto
                </h4>
            </div>
        `;
        let cierre_contrato = document.querySelector("#cierre");
        cierre_contrato.style.display = "grid";
        cierre_contrato.classList.add("card");
        let tabla = document.querySelector("#tabla_cierre");
        let html = `
        <div class="table-responsive">
            <table class="table datatable" id="d_tbl_cierre">
                <thead>
                    <tr>
                        <th>Aspectos para la validación de cierre</th>
                        <th>Cumple</th>
                    </tr>
                </thead>
                <tbody>`;
        html += cierre
            .map(element => {
                let txtCumple = "";
                if (element.cumple == 1) {
                    txtCumple = "Cumple";
                }if(element.cumple == null) {
                    txtCumple = "No cumple";
                }if(element.cumple == 2) {
                    txtCumple = "Pendiente";
                }

                return `<tr>
                            <td>${element.aspectos}</td>
                            <td style="text-align:center;"> <i class="fas fa-${
                                element.cumple  ? element.cumple == 1 ? "check" : "window-minimize": "times"
                            }"
                                    style="color:${
                                        element.cumple ? element.cumple == 1 ? "green" : "blue" : "red"
                                    }"></i>
                            </td>
                        </tr>`;
            })
            .join("");
        html += `
                </tbody>
            </table>
            </div>`;
        tabla.innerHTML = html;
        render_tabla_cierre();
        //Renderizamos gráfica

        let data_cierre = [];

        if(contador_pendiente != 0){
            data_cierre.push(
                ["Pendiente", contador_pendiente],
            );
        }
        if(contador_cumple != 0){
            data_cierre.push(
                ["Cumple", contador_cumple],
            );
        }
        if(contador_no_cumple != 0){
            data_cierre.push(
                ["No Cumple", contador_no_cumple]
            );
        }

        Highcharts.chart("grafica_cierre", {
            chart: {
                type: "pie",
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                }
            },
            title: {
                text: ""
            },
            accessibility: {
                point: {
                    valueSuffix: ""
                }
            },
            tooltip: {
                pointFormat: "{series.name}: <b>{point.percentage:}</b>"
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: "pointer",
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: "{point.name}: <b>{point.y}</b>"
                    }
                }
            },
            series: [
                {
                    type: "pie",
                    name: "Cantidad",
                    data: data_cierre,
                }
            ]
        });
    }

    if (niveles_servicio) {
        //niveles servicio
        let evaluaciones_servicio = document.querySelector(
            "#evaluaciones_servicio"
        );
        evaluaciones_servicio.style.display = "grid";
        evaluaciones_servicio.classList.add("card");

        let c_niveles_servicio = document.querySelector("#niveles_servicio");
        //c_niveles_servicio.classList.add("card");
        c_niveles_servicio.style.padding = "15px 10px";
        let html = `
            <div style="padding:10px 15px">
                <h4 class="card-title graficas_titulos graficas_titulo4"
                    style="display: flex; align-items: center; justify-content: center;">
                    Niveles de Servicio
                </h4>
            </div>
            <div class="table-responsive">
            <table id="tbl_niveles_servicio" class="table datatable" >
                <thead>
                    <tr>
                        <th style="display:none;">ID</th>
                        <th>Nombre</th>
                        <th>Periodo</th>
                        <th>Unidad</th>
                        <th>SLA Comprometido</th>
                        <th style="display:none;">Logro</th>
                        <th>SLA Alcanzado</th>
                    </tr>
                </thead>
                <tbody>`;
        html += niveles_servicio
            .map(nivel_servicio => {
                let sla = 0;
                let color_sla = "";
                let color_letra_sla = "";
                if (nivel_servicio.p_general != null) {
                    sla = Math.round(
                        (nivel_servicio.p_general / nivel_servicio.meta) * 100
                    );
                    if (sla > 60 && sla <= 100) {
                        color_sla = "#009999";
                        color_letra_sla = "white";
                    /*} else if (sla > 30 && sla <= 60) {
                        color_sla = "#FFC000";
                        color_letra_sla = "black";*/
                    } else {
                        color_sla = "#FF6565";
                        color_letra_sla = "white";
                    }
                } else {
                    color_sla = "#FF6565";
                    color_letra_sla = "white";
                }
                let nombre_servicio;
                console.log(Number(nivel_servicio.periodo_evaluacion));
                switch (Number(nivel_servicio.periodo_evaluacion)) {
                    case 1:
                        nombre_servicio = "Unica vez"
                        break;
                    case 2:
                       nombre_servicio = "Diario"
                        break;
                    case 3:
                        nombre_servicio = "Semanal"
                        break;
                    case 4:
                        nombre_servicio = "Quincenal"
                        break;
                    case 5:
                        nombre_servicio = "Mensual"
                        break;
                    case 6:
                        nombre_servicio = "Bimestral"
                        break;
                    case 7:
                        nombre_servicio = "Trimestral"
                        break;
                    case 8:
                        nombre_servicio = "Semestral"
                        break;
                    case 9:
                        nombre_servicio = "Anual"
                        break;
                    case 10:
                        nombre_servicio = "Multianual"
                        break;

                    default:
                        nombre_servicio = "No encontrado"
                        break;
                }
                return `
                <tr>
                    <td style="display:none;">${nivel_servicio.id}</td>
                    <td>${nivel_servicio.nombre}</td>
                    <td>${nombre_servicio}</td>
                    <td>${nivel_servicio.unidad}</td>
                    <td>${nivel_servicio.meta}</td>
                    <td style="display:none;">${nivel_servicio.p_general != null
                        ? nivel_servicio.p_general.toFixed(2)
                        : ""
                    }</td>
                    <td style="padding:0; text-align:center">
                        <strong style="padding:5px; border-radius:5px">
                            <span style="font-size:1em; color:${color_sla}"><i class="fas fa-tachometer-alt"></i>
                                <span style="color:black">${nivel_servicio.p_general != null
                                    ? nivel_servicio.p_general.toFixed(2)
                                    : ""
                                }</span>
                            </span>
                            <span style="font-size:0.8em;"></span>
                        </strong>
                    </td>
                </tr>
            `;
            })
            .join("");
        html += `
                </tbody>
            </table>`;
        c_niveles_servicio.innerHTML = html;

        render_table();
    }
});
function render_tabla_cierre() {

    let tbl_cierre = $("#d_tbl_cierre").DataTable({
        buttons: [],
    });

}
function render_table_facturacion() {

    let tbl_facturas = $("#dtbl_facturas").DataTable({
        buttons: [],
    });

}

function render_entregables_table() {

    let tbl_entregables = $("#table-entregables").DataTable({
        buttons: [],
    });

}

function render_table() {
    let tbl_niveles = $("#tbl_niveles_servicio").DataTable({
        buttons: [],
    });

    /*$("#tbl_niveles_servicio tbody").on("click", "tr", function () {
        let data = tbl_niveles.row(this).data();
        console.log(data);
        let slaComprometido = data[4];
        let servicio_id = data[0];
        let nombre_servicio = data[1];
        let unidad_servicio = data[3];
        let porcentaje = data[6].replace(/(<([^>]+)>)/gi, "").trim(); // En la posicion 6 del array está el promedio y se remueven los tag html
        let numero = porcentaje.replaceAll("%", "").trim();

        let titulo_graficas = document.querySelector(
            "#titulo_graficas_servicio"
        );
        titulo_graficas.innerHTML = `<div style="padding:10px 15px">
                <h4 class="card-title graficas_titulos graficas_titulo4"
                    style="display: flex; align-items: center; justify-content: center;">
                    <span style="color:white"><i class="fas fa-tachometer-alt" style="padding-right:5px"></i> Nivel de servicio: ${nombre_servicio}</span>
                </h4>
            </div>`;

        render_promedio(Number(numero), Number(slaComprometido));
        buscarhistorico(servicio_id, nombre_servicio, unidad_servicio);

        if (!$(this).hasClass("selected")) {
            tbl_niveles.$("tr.selected").removeClass("selected");
            $(this).addClass("selected");
        }
    });*/
    let tbl = document.querySelector("#tbl_niveles_servicio_wrapper");
    tbl.style.padding = "0 35px 0 12px";
}

function render_promedio(porcentaje, slaComprometido) {
    let chart = {
        type: "gauge"
    };
    let credits = {
        enabled: false
    };
    let title = {
        text: "Promedio"
    };

    console.log(porcentaje, slaComprometido);

    let pane = [
        {
            center: ["50%", "85%"],
            size: "140%",
            startAngle: -90,
            endAngle: 90,

            background: {
                backgroundColor:
                    (Highcharts.theme && Highcharts.theme.background2) ||
                    "#FFF",

                innerRadius: "0%",
                outerRadius: "0%"
                //shape: "arc"
            }
        }
    ];
    let tooltip = {
        enabled: true
    };
    let plotB = [];
    if (porcentaje >= slaComprometido) {

        plotB = [
            {
                from: slaComprometido + 10,
                to: slaComprometido,
                color:  "#009999",
                innerRadius: "100%",
                outerRadius: "70%"
            },
            {
                from: 0,
                to: slaComprometido,
                color:  "#FF6565",
                innerRadius: "100%",
                outerRadius: "70%"
            }
        ]
    } else {
        plotB = [
            {
                from: 0,
                to: slaComprometido,
                color:  "#FF6565",
                innerRadius: "100%",
                outerRadius: "70%"
            },
            {
                from: slaComprometido,
                to: slaComprometido + 10,
                color:  "#009999",
                innerRadius: "100%",
                outerRadius: "70%"
            }
        ]
    }

    // the value axis
    let yAxis = [
        {
            min: 0,
            max: slaComprometido + 10,
            minorTickPosition: "outside",
            tickPosition: "outside",
            labels: {
                rotation: "auto",
                distance: 25,
                style: {
                    "font-size": 18
                }
            },
            // plotBands: [
            //     {
            //         from: 0,
            //         to: 10,
            //         color: "#FF6565",
            //         innerRadius: "100%",
            //         outerRadius: "70%"
            //     },
            //     {
            //         from: 10,
            //         to: 20,
            //         color: "#FF6565",
            //         innerRadius: "100%",
            //         outerRadius: "70%"
            //     },
            //     {
            //         from: 20,
            //         to: 30,
            //         color: "#FF6565",
            //         innerRadius: "100%",
            //         outerRadius: "70%"
            //     },
            //     {
            //         from: 30,
            //         to: 40,
            //         color: "#FF6565",
            //         innerRadius: "100%",
            //         outerRadius: "70%"
            //     },
            //     {
            //         from: 40,
            //         to: 50,
            //         color: "#FFC000",
            //         innerRadius: "100%",
            //         outerRadius: "70%"
            //     },
            //     {
            //         from: 50,
            //         to: 60,
            //         color: "#FFC000",
            //         innerRadius: "100%",
            //         outerRadius: "70%"
            //     },
            //     {
            //         from: 60,
            //         to: 70,
            //         color: "#FFC000",
            //         innerRadius: "100%",
            //         outerRadius: "70%"
            //     },
            //     {
            //         from: 70,
            //         to: 80,
            //         color: "#009999",
            //         innerRadius: "100%",
            //         outerRadius: "70%"
            //     },
            //     {
            //         from: 80,
            //         to: 90,
            //         color: "#009999",
            //         innerRadius: "100%",
            //         outerRadius: "70%"
            //     },
            //     {
            //         from: 90,
            //         to: 100,
            //         color: "#009999",
            //         innerRadius: "100%",
            //         outerRadius: "70%"
            //     }
            // ],
            plotBands: plotB,
            pane: 0,
            title: {
                text: "",
                y: 40
            }
        }
    ];

    let series = [
        {
            name: "Promedio",
            data: [porcentaje],
            dataLabels: {
                formatter: function () {
                    let color_sla = "";
                    if (this.y >= slaComprometido) {
                        color_sla = "#009999";
                    /*} else if (this.y > 30 && this.y <= 60) {
                        color_sla = "#FFC000";*/
                    } else {
                        color_sla = "#FF6565";
                    }

                    let txt = `
                        <span style="font-size:52px;color:${color_sla}">${this.y}</span>
                        <span style="font-size:35px;color:${color_sla}"></span>
                    `;
                    return txt;
                },
                y: -50,
                borderWidth: 0
            },
            tooltip: {
                valueSuffix: ""
            }
        }
    ];

    let json = {};
    json.chart = chart;
    json.title = title;
    json.pane = pane;
    json.tooltip = tooltip;
    json.yAxis = yAxis;
    json.credits = credits;
    json.series = series;
    $("#grafica_promedio").highcharts(json);
}

function historico_chart(arrLabels, arrPromedios, nombre_servicio, unidad_servicio) {
    var chartTitle = `Nivel de servicio: ${nombre_servicio}`;
    var chartyTitle = `Unidad: ${unidad_servicio}`;
    var chart = {
        type: "column"
    };
    var title = {
        text: chartTitle
    };
    // var subtitle = {
    //     text: "Source: WorldClimate.com",
    // };
    var xAxis = {
        categories: arrLabels,
        crosshair: true
    };
    var yAxis = {
        min: 0,
        title: {
            text: chartyTitle
        }
    };

    var tooltip = {
        formatter: function () {
            let fecha = moment(
                this.point.more
            );
            let fecha_formateada = this.point.more != null ? fecha.format('DD-MM-YYYY') : "";

            let tooltip = `
                <!--<span style="font-size:14px">${this.point.category}: </span>-->
                <br />
                <br />
                <b>${this.point.y} ${unidad_servicio}</b> en cumplimiento<br/>
                <b>Fecha: ${fecha_formateada}</b>
            `;
            return tooltip;
        }
        // headerFormat: "<span>{point.key}: </span>",
        // pointFormat: "<b>{point.y}%</b> en total<br/>",
        // footerFormat: "<span><b>Fecha: </b>{point.more}</span>"
    };
    var plotOptions = {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    };
    var credits = {
        enabled: false
    };

    var series = [
        {
            name: chartTitle,
            data: arrPromedios
        }
    ];

    var json = {};
    json.chart = chart;
    json.title = title;
    json.tooltip = tooltip;
    json.xAxis = xAxis;
    json.yAxis = yAxis;
    json.series = series;
    json.plotOptions = plotOptions;
    json.credits = credits;
    $("#grafica_historico").highcharts(json);
    //g_cierre.setTitle(null, { text: nombre_servicio });
}
