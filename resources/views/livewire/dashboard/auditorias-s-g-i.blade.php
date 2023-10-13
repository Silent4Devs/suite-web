<div>
<link rel="stylesheet" type="text/css" href="https://uicdn.toast.comt/ui.time-picker/latest/tui-time-picker.css">
<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css">

<link rel="stylesheet" type="text/css" href="{{ asset('../css/calendar_tui/tui-calendar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('../css/calendar_tui/default.css') }}">
<style type="text/css">
    .caja{
        width: 100%;
        height:740px;
        padding: 0;
        position: relative;
        top: 0px;
        right: -35px;
        bottom: 0;
        left: 35px;
    }
    .tamaño-calendario{
        position: absolute;
        top: 49px;
        right: 80px;
        bottom: 0;
        left: 180px;
    }
    .menu{
        padding: 0px 16px !important;
        text-align: right !important;
        position: relative;
    }
    #lnb{
        background: rgba(0,0,0,0) !important;
        border: none !important;
    }
    #lnb div{
        border: none !important;
    }
    #calendarList{
        border: none !important;
    }
    #calendar{
        width: 100%;
        overflow: hidden;
        /*overflow-y: auto;*/
        border: none !important;
    }
    #calendarList span{
        margin-left: 0px;
        font-size: 8pt;
        float: left;
        width: 100px;
    }
     #calendarList span:nth-child(even){
        width: 20px;
     }
    span strong{
        font-size: 15pt !important;
    }
    span:not(.lever)::before{
        left: -30px !important;
        top: -5px !important;
        transform: scale(0.7);
        display: none;
    }
    .tui-full-calendar-month-dayname{
        border: none !important;
    }
    .tui-full-calendar-popup-section div{
        border: none !important;
        margin-top: 20px !important;
    }
    .tui-full-calendar-popup-section input{
        border-bottom: 1px solid #eee !important;
    }


    .btn.btn-default.btn-sm.move-day{
        width: 30px;
        height: 30px;
        position: relative;
    }
    a:hover{
        text-decoration: none !important;
    }

    .tui-full-calendar-popup .tui-full-calendar-popup-container{
        display: none;
    }

    .tui-full-calendar-popup.tui-full-calendar-popup-detail .tui-full-calendar-popup-container{
        display: block;
    }


    .tui-full-calendar-weekday-grid-more-schedules{
        position: relative !important;
   }
   .dropdown-menu.show{
        width: 250px ;
   }
   .i_calendar{
        font-size: 11pt;
        width: 20px;
        text-align: center;
   }
   .i_calendar_cuadro{
        margin: 0px 8px;
   }
    .Tarjetap {
        /* CSS proporcionado */
        /* Layout Properties */
        top: 140px;
        left: 286px;
        width: 985px;
        height: 57px;
        display: flex;
        align-items: center;
        padding: 32px;
        /* UI Properties */
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 16px;
        opacity: 1;
    }

    .Tarjetap2 {
        top: 287px;
        left: 285px;
        width: 985px;
        height: 57px;
        display: flex;
        align-items: center;
        padding: 32px;
        margin: 0px 0px 16px 20px;
        /* UI Properties */
        background: #FCF8C4 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 8px;
        opacity: 1;
        border-left: none;
        /* Quitar el borde del lado izquierdo */
    }

    .ojo-botones-o {
        top: 212px;
        left: 287px;
        width: 61px;
        height: 58px;
        margin: 16px 0px 0px 0px;
        background: var(--unnamed-color-306ba9) 0% 0% no-repeat padding-box;
        background: #4BB3E8 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 8px 0px 0px 8px;
        opacity: 1;
        display: flex;
        justify-content: center;
    }

    .ojo-botones-a {
        top: 212px;
        left: 287px;
        width: 61px;
        height: 58px;
        margin: 16px 0px 0px 0px;
        background: var(--unnamed-color-306ba9) 0% 0% no-repeat padding-box;
        background: #306BA9 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 8px 0px 0px 8px;
        opacity: 1;
        display: flex;
        justify-content: center;
    }

    .letra-tarjeta {
        /* Layout Properties */
        top: 393px;
        left: 366px;
        width: 143px;
        height: 39px;
        display: flex;
        align-items: center;
        padding: 32px;
        /* UI Properties */
        font: var(--unnamed-font-style-normal) normal medium 16px/var(--unnamed-line-spacing-20) var(--unnamed-font-family-roboto);
        letter-spacing: var(--unnamed-character-spacing-0);
        color: var(--unnamed-color-464646);
        text-align: left;
        font: normal normal medium 16px/20px Roboto;
        letter-spacing: 0px;
        color: #464646;
        font-weight: bold;
        opacity: 1;
    }

    .letra-tarjeta2 {
        /* Layout Properties */
        top: 393px;
        left: 366px;
        width: 143px;
        height: 39px;
        display: flex;
        align-items: center;
        margin: 28px 0px 24px 12px;
        /* UI Properties */
        font: var(--unnamed-font-style-normal) normal medium 16px/var(--unnamed-line-spacing-20) var(--unnamed-font-family-roboto);
        letter-spacing: var(--unnamed-character-spacing-0);
        color: var(--unnamed-color-464646);
        text-align: left;
        font: normal normal medium 16px/20px Roboto;
        letter-spacing: 0px;
        color: #464646;
        font-weight: bold;
        opacity: 1;
    }

    .tarjetas-container {
        display: flex;
    }

    .botones {
        top: 212px;
        left: 287px;
        width: 160px;
        height: 58px;
        margin: 16px 0px 0px 0px;
        /* UI Properties */
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 0px 8px 8px 0px;
        opacity: 1;
    }

    .botones2 {
        top: 367px;
        left: 285px;
        width: 165px;
        height: 90px;
        /* UI Properties */
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 0px 16px 16px 0px;
        opacity: 1;
    }

    .datosconformidades {
        display: flex;
        justify-content: center;
        top: 367px;
        left: 285px;
        width: 61px;
        height: 90px;
        background: var(--unnamed-color-306ba9) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 4px #0000000F;
        border-radius: 8px 0px 0px 8px;
        border-right: 0.5px solid #606060;
        /* border-right: 0.5px solid #606060;
        border-right-style: solid;
        border-right-width: medium; */
        opacity: 1;
    }

    .fondo-grafica {
        /* Layout Properties */
        top: 474px;
        left: 285px;
        width: 990px;
        height: 524px;
        margin: 0px 15px 50px 0px;
        /* UI Properties */
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 2px 4px #0000001F;
        border-radius: 16px;
        opacity: 1;
    }
    .fondo-calendario {
        /* Layout Properties */
        top: 474px;
        left: 285px;
        width: 990px;
        height: 900px;
        margin: 25px 15px 50px 0px;
        /* UI Properties */
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 2px 4px #0000001F;
        border-radius: 16px;
        opacity: 1;
    }
    .titulo-graficas {
        top: 515px;
        left: 313px;
        height: 24px;
        display: flex;
        padding: 32px 32px 25px 32px;
        /* UI Properties */
        text-align: left;
        font: normal normal normal 20px/24px Roboto;
        letter-spacing: 0px;
        color: #5A5A5A;
        opacity: 1;
    }

    .subtitulo {
        /* Layout Properties */
        margin: 6px 12px 20px 20px;
        top: 303px;
        left: 286px;
        height: 22px;
        /* UI Properties */
        font: var(--unnamed-font-style-normal) normal medium 18px/22px var(--unnamed-font-family-roboto);
        letter-spacing: var(--unnamed-character-spacing-0);
        text-align: left;
        font: 18px Roboto;
        letter-spacing: 0px;
        color: #2567AE;
        opacity: 1;
        font-weight: bold;
    }

    .tarjetas {
        margin: 6px 15px 0px 0px;
        top: 344px;
        left: 287px;
        width: 235px;
        height: 80px;
        opacity: 1;
        border-radius: 8px
    }

    .letra-tarjeta-MYA {
        margin-top: 15px;
        margin-left: 20px;
        text-align: left;
        font: 14px Roboto;
        letter-spacing: 0px;
        color: #FFFFFF;
        opacity: 1;
        display: flex;
        align-items: center;
    }

    .datos-letra-tarjeta-MYA {
        margin-left: 20px;
        text-align: left;
        font: 24px Roboto;
        letter-spacing: 0px;
        color: #FFFFFF;
        font-weight: bolder;
        opacity: 1;
        display: flex;
        align-items: center;
    }

    .display-grafica {
        top: 438px;
        left: 287px;
        width: 485px;
        height: 477px;
        margin: 20px 0px 40px 0px;
        background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 2px 4px #0000001F;
        border-radius: 16px;
        opacity: 1;
    }
    .filtro{
        /* Layout Properties */
        margin: 24px 0px 0px 700px;
        top: 152px;
        left: 500px;
        width: 200px;
        height: 34px;
        /* UI Properties */
        border: 1px solid var(--unnamed-color-d5d5d5);
        background: #F8FAFC 0% 0% no-repeat padding-box;
        border: 1px solid #D5D5D5;
        border-radius: 4px;
        opacity: 1;
    }
    .letra-filtro{
        margin-top: 8px;
        margin-left: 15px;
        top: 152px;
        left: 500px;
        width: 157px;
        height: 34px;
        text-align: left;
        font: 14px Roboto;
        letter-spacing: 0px;
        color: #606060;
        opacity: 1;
    }
    .titulo-dashboard{
        margin: 6px 12px 24px 8px;
        top: 303px;
        left: 286px;
        height: 22px;
        /* UI Properties */
        font: var(--unnamed-font-style-normal) normal medium 18px/22px var(--unnamed-font-family-roboto);
        letter-spacing: var(--unnamed-character-spacing-0);
        text-align: left;
        font: 24px Roboto;
        letter-spacing: 0px;
        color: #2567AE;
        opacity: 1;
        font-weight: bold;
    }
    .datos-letra-tarjeta-A {
        margin:16px;
        text-align: left;
        font: 24px Roboto;
        letter-spacing: 0px;
        color: #464646;
        font-weight: bolder;
        opacity: 1;
        display: flex;
        align-items: center;
    }
        /* Estilo para el primer tipo de línea de cuadrícula */
    .yaxislayer-above:first-child {
        top: 627px;
        left: 329px;
        width: 949px;
        height: 24px;
        transform: matrix(0, -1, 1, 0, 0, 0);
        background: #F3F3F3; /* Color de fondo para el primer tipo de línea de cuadrícula */
        opacity: 1;
    }
    /* Estilo para el segundo tipo de línea de cuadrícula */
    .yaxislayer-above:last-child {
        top: 651px;
        left: 329px;
        width: 949px;
        height: 24px;
        transform: matrix(0, -1, 1, 0, 0, 0);
        background: #FCFCFC; /* Color de fondo para el segundo tipo de línea de cuadrícula */
        opacity: 1;
    }
    /* Estilo común para ambas líneas de cuadrícula */
    .yaxislayer-above .gridlayer-y .grid-line-x {
        height: 1px; /* Grosor de las líneas de cuadrícula */
    }
    .yaxislayer-above .gridlayer-y .grid-line-x:not(.zero-line) {
        background: transparent; /* Color de las líneas de cuadrícula */
    }
</style>
{{-- HTML DASHBOARD --}}
<div class="container">
    <h1 class="titulo-dashboard">Dashboard</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="Tarjetap">
                Selecciona la Norma que desees monitorear
                <select class="form-control filtro" style="margin-left: 420px; margin-bottom: 24px;">
                    <option>ISO 27001</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="row" style="margin-left: 0px;">
        {{-- MI PLAN ISO --}}
        <div class="col-md-3">
            <ul class="nav nav-tabs d-flex inline">
                <li class="active ojo-botones-o">
                    <i class="fa-regular fa-eye fa-xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                </li>
                <a class="botones" href="#mi-plan-iso" data-toggle="tab" data-target="#mi-plan-iso" wire:click='updateData(1)'> <!-- Agrega data-target -->
                    <h3 class="letra-tarjeta">Mi plan ISO</h3>
                </a>
            </ul>
        </div>
        {{-- RIESGOS --}}
        <div class="col-md-3" style="padding-left:0px">
            <ul class="nav nav-tabs d-flex inline">
                <li class="ojo-botones-o">
                    <i class="fa-regular fa-eye fa-xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                </li>
                <a class="botones" href="#riesgos" data-toggle="tab" wire:click='updateData(2)'>
                    <h3 class="letra-tarjeta">Riesgos</h3>
                </a>
            </ul>
        </div>
        {{-- Auditorias --}}
        <div class="col-md-3" style="padding-left:0px">
            <ul class="nav nav-tabs d-flex inline">
                <li class="ojo-botones-o">
                    <i class="fa-regular fa-eye fa-xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                </li>
                <a class="botones" href="#auditorias" data-toggle="tab" wire:click='updateData(3)'>
                    <h3 class="letra-tarjeta">Auditorias</h3>
                </a>
            </ul>
        </div>
        {{-- Mejoras y Acciones --}}
        <div class="col-md-3" style="padding-left:0px">
            <ul class="nav nav-tabs d-flex inline">
                <li class="ojo-botones-o">
                    <i class="fa-regular fa-eye fa-xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                </li>
                <a class="botones" href="#mejorasyacciones" data-toggle="tab" wire:click='updateData(4)'>
                    <h3 class="letra-tarjeta">Mejoras y Acciones</h3>
                </a>
            </ul>
        </div>
    </div>
</div>
@switch($tabOption)
    @case(1)
    @include('admin.AuditoriasSGI.miplaniso')

        @break
    @case(2)
    @include('admin.AuditoriasSGI.riesgos')

        @break
    @case(3
    @dd($clashallazgosaudit);
    @include('admin.AuditoriasSGI.auditorias')

        @break
    @case(4)
    @include('admin.AuditoriasSGI.mejorasyacciones')

        @break

    @default
    @include('admin.AuditoriasSGI.miplaniso')

@endswitch



    @section('scripts')
        @parent
        <script src="https://cdn.plot.ly/plotly-2.26.0.min.js" charset="utf-8"></script>

        <!-- Agrega la referencia a la librería Select2 CSS y JS -->

        <script>
            $(document).ready(function() {
                // Activa la pestaña "Mi plan ISO" al cargar la página
                $('#mi-plan-iso').tab('show');

                // Asigna un evento click a los enlaces de los tabs
                $('.botones').click(function(e) {
                    e.preventDefault(); // Evita el comportamiento predeterminado del enlace

                    // Restaura la clase ojo-botones-o en todos los botones
                    $('.botones li').removeClass('ojo-botones-a').addClass('ojo-botones-o');

                    // Cambia la clase del botón actual a ojo-botones-a
                    $(this).find('li').removeClass('ojo-botones-o').addClass('ojo-botones-a');

                    // Oculta todos los tab-pane excepto el que se va a mostrar
                    $('.tab-pane').removeClass('active');

                    // Activa el tab correspondiente
                    $($(this).attr('href')).addClass('active');
                });
            });
        </script>



        {{-- DASHBOARD DE AUDITORIAS --}}

                                {{-- GRAFICA DE BARRAS AUDITORIAS--}}


        <script>
            // Define los datos iniciales para la gráfica
            let datosGrafica = {
                x: ['Contexto', 'Liderazgo', 'Planificación', 'Soporte', 'Operación', 'Evaluación', 'Mejora'],
                y: [{{$contexto}}, {{$liderazgo}}, {{$planificacion}}, {{$soporte}}, {{$operacion}}, {{$evaluacion}}, {{$mejora}}],
                type: 'bar',
                marker: {
                    color: ['#CEB475', '#65CDEE', '#EE6581', '#8965EE', '#C665EE', '#36C8D2', '#28C2A3'],
                },
                textfont: {
                    color: 'white',
                    size: 16
                },
                text: [{{$contexto}}, {{$liderazgo}}, {{$planificacion}}, {{$soporte}}, {{$operacion}}, {{$evaluacion}}, {{$mejora}}],
                textposition: 'auto'
            };

            // Define el diseño de la gráfica
            let layoutsssss = {
                height: 390,
                width: 1070,
                bargap: 0.35,
                xaxis: {
                    showgrid: false
                },
                yaxis: {
                    showgrid: true,
                    gridwidth: 27,
                    gridshape: 'linear',
                    gridpattern: 'alternate',
                    gridcolor: ['#F3F3F3', '#FCFCFC'],
                }
            };

            // Función para actualizar el gráfico cuando cambie la selección
            function actualizarGrafico() {
                let selectedValue = document.getElementById("filtroAudit").value;

                // Realiza una petición AJAX para obtener el clausula_id correspondiente
                fetch(`/obtener-clausula-id/${selectedValue}`)
                    .then(response => response.json())
                    .then(data => {
                        // Copia los datos actuales
                        let newData = { ...datosGrafica };

                        // Actualiza newData.y según el clausula_id obtenido
                        // Esto es solo un ejemplo, debes definir los valores correspondientes según tu lógica
                        switch (data.clausula_id) {
                            case 1:
                                newData.y = [{{$contexto}}, 0, 0, 0, 0, 0, 0];
                                break;
                            case 2:
                                newData.y = [0, {{$liderazgo}}, 0, 0, 0, 0, 0];
                                break;
                            case 3:
                                newData.y = [0, 0, {{$planificacion}}, 0, 0, 0, 0];
                                break;
                            // Agrega más casos según tus clausulas...
                            default:
                                newData.y = [0, 0, 0, 0, 0, 0, 0]; // Valores predeterminados si no hay coincidencia
                        }

                        // Actualiza el gráfico
                        Plotly.newPlot("A", [newData], layoutsssss);
                    })
                    .catch(error => {
                        console.error('Error al obtener el clausula_id:', error);
                    });
            }

            // Inicializa el gráfico con los datos iniciales
            Plotly.newPlot("A", [datosGrafica], layoutsssss);
        </script>

                        {{-- DASHBOARD DE MEJORAS Y ACCIONES --}}


                        {{-- GRAFICA DE BARRAS TOTAL DE MEJORAS --}}

        <script>
            let data = [{
                x: ['En curso', 'En espera', 'Cerrados', 'Sin atender'],
                y: [{{$encursoCount}}, {{$enesperaCount}}, {{$cerradoCount}}, {{$sinatenderCount}}],
                type: 'bar',
                marker: {
                color: ['#28C2A3', '#FF9B65', '#6C6C6C', '#E66060']
            },
            textfont: {
                color: 'white',
                size: 12
            },
            text: [{{$encursoCount}}, {{$enesperaCount}}, {{$cerradoCount}}, {{$sinatenderCount}}], // Aquí se especifica el texto
            textposition: 'auto' // Establece la posición del texto (en este caso, se coloca automáticamente)
        }];
            let layout = {
                height: 400,
                width: 480,
                bargap: 0.05, // Ajusta este valor para controlar el espacio entre las barras
                xaxis: {
                    showgrid: false // Desactiva las líneas de la cuadrícula vertical
                },
                 yaxis: {
                    showgrid: true, // Activa las líneas de la cuadrícula horizontal
                    gridcolor: 'rgba(128,128,128,0.5)' // Establece el color de las líneas de la cuadrícula
                }
            };
            Plotly.newPlot('TM', data, layout);
            </script>


                    {{-- GRAFICA DE PASTEL PORCENTAJE DE MEJORA --}}

        <script>
            let datass = [{
                values: [{{$encursoCount}}, {{$enesperaCount}}, {{$cerradoCount}}, {{$sinatenderCount}}],
                labels: ['En curso', 'En espera', 'Cerrados', 'Sin atender'],
                hole: .45,
                type: 'pie',
                marker: {
                    colors: ['#28C2A3', '#FF9B65', '#6C6C6C', '#E66060'],
                },
                textfont: {
                    color: 'white',
                    size: 12
                }
            }];

            let layoutss = {
                height: 400,
                width: 470,
            };

            Plotly.newPlot('PM', datass, layoutss);
        </script>

                    {{-- GRAFICA DE BARRA TOTAL DE LAS ACCIONES CORRECTIVAS --}}

        <script>
            let datasss = [{
                x: ['En curso', 'En espera', 'Cerrados', 'Sin atender'],
                y: [{{$encursoCountAC}}, {{$enesperaCountAC}}, {{$cerradoCountAC}}, {{$sinatenderCountAC}}],
                type: 'bar',
                marker: {
                    color: ['#28C2A3', '#FF9B65', '#6C6C6C', '#E66060']
                },
                textfont: {
                    color: 'white',
                    size: 12
                },
                text: [{{$encursoCountAC}}, {{$enesperaCountAC}}, {{$cerradoCountAC}}, {{$sinatenderCountAC}}], // Aquí se especifica el texto
                textposition: 'auto' // Establece la posición del texto (en este caso, se coloca automáticamente)
            }];

            let layoutsss = {
                height: 400,
                width: 480,
                bargap: 0.05, // Ajusta este valor para controlar el espacio entre las barras
                xaxis: {
                    showgrid: false // Desactiva las líneas de la cuadrícula vertical
                },
                yaxis: {
                    showgrid: true, // Activa las líneas de la cuadrícula horizontal
                    gridcolor: 'rgba(128,128,128,0.5)' // Establece el color de las líneas de la cuadrícula
                }
            };

            Plotly.newPlot('TAC', datasss, layoutsss);
        </script>

                    {{-- GRAFICA DE PASTEL PORCENTAJE DE ACCIONES CORRECTIVAS --}}

        <script>
            let datas = [{
                values: [{{$encursoCountAC}}, {{$enesperaCountAC}}, {{$cerradoCountAC}}, {{$sinatenderCountAC}}],
                labels: ['En curso', 'En espera', 'Cerrados', 'Sin atender'],
                hole: .45,
                type: 'pie',
                marker: {
                    colors: ['#28C2A3', '#FF9B65', '#6C6C6C', '#E66060']
                },
                textfont: {
                    color: 'white',
                    size: 12
                }
            }];

            let layouts = {
                height: 400,
                width: 470
                // width: 480px;
                // height: 477px;
            };

            Plotly.newPlot('PAC', datas, layouts);
        </script>

    @endsection
</div>
