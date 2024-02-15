@extends('layouts.admin')
@section('content')
    <style>
        body {
            background-color: #fff !important;
        }

        .resEdit {
            padding: 15px;
        }

        .resLine {
            width: 95%;
            padding: 3px;
            margin: 5px;
            border: 1px solid #d0d0d0;
        }


        .ganttButtonBar h1 {
            color: #000000;
            font-weight: bold;
            font-size: 28px;
            margin-left: 10px;
        }

        #TWGanttArea {
            height: 550px !important;
        }

        #__popup__1 {
            background-color: rgba(0, 0, 0, 0.5) !important;
        }

        .bwinPopupd {
            position: absolute;
            width: 90%;
            max-width: 600px;
            top: 0px;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            margin-top: 100px !important;
            height: 400px;
        }




        .gdfTable.table.ganttFixHead thead tr .gdfColHeader.gdfied.unselectable {
            font-size: 12px !important;
        }

        .gdfTable.table.ganttFixHead {
            display: none !important;
        }



        .ganttFixHead {
            border-bottom: 1px solid #ccc !important;
        }

        .table thead th {
            border-bottom: none !important;
            border-top: none !important;
        }


        /*.taskBox.taskBoxSVG.taskStatusSVG.deSVGdrag.deSVG rect:nth-child(even){
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              fill: #fff !important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              height: 15px !important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             }*/


        #workSpace {
            border: none !important;
        }

        table.gdfTable thead>tr:nth-child(1n) {
            position: sticky;
            top: 0;
            background-color: #fff !important;
            z-index: 2;
        }


        .icons_propios_gantt {
            transform: scale(1.2);
            color: #34495e !important;
        }

        .icons_propios_gantt.guardar {
            transform: scale(1.5);
            color: #345183 !important;
        }


        .botones_vistas_gantt {
            width: 100%;
            position: relative;
            z-index: 2;
        }

        .botones_vistas_gantt a {
            width: 100px;
            display: inline-block;
            padding: 5px 10px;
            background-color: #fff;
            color: #345183;
            font-size: 9pt;
            cursor: pointer;
            border: 1px solid #345183;
            border-radius: 5px;
            text-align: center;
            vertical-align: middle;
        }

        .botones_vistas_gantt a:hover {
            border: 1px solid #345183;
            background-color: #345183;
            color: #fff;
        }

        .boton_activo {
            border: 1px solid #345183 !important;
            background-color: #345183 !important;
            color: #fff !important;
        }

        .botones_vistas_gantt a i {
            font-size: 11pt;
            margin-right: 5px;
        }





        select.formElements option {
            text-transform: capitalize !important;
        }

        .splitterContainer rect:nth-child(1) {
            rx: 10px;
            ry: 10px;
            width: calc(+ 20px);
        }

        .splitterContainer rect[height="3"] {
            height: 10px;
            fill: #505050 !important;
            rx: 11px;
            ry: 14px;
        }

        .splitterContainer rect[height="60%"] {
            transform: scaleX(0.9) translate(5%);
            rx: 5px;
            ry: 5px;
        }




        @media print {

            header,
            footer,
            .sistema_gantt p,
            .botones_vistas_gantt,
            body.font-lato {
                display: none !important;
            }

            * {
                transform: scale(1.001);
            }
        }

        .rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(18px at 50% 50%);
            height: 37px;
        }

        h3.mb-2 {
            position: relative;
            z-index: 2;
        }

        select {
            appearance: none;
            background-color: transparent;
            border: none;
            padding: 0 1em 0 0;
            margin: 0;
            width: 100%;
            min-width: 15ch;
            max-width: 30ch;
            font-family: inherit;
            font-size: inherit;
            cursor: inherit;
            line-height: inherit;
            outline: none;
            cursor: pointer;
        }

        select::-ms-expand {
            display: none;
        }

        .caja_botones_menu {

            display: inline-block !important;
        }
    </style>
    <h5 class="col-12 titulo_general_funcion">Plan de Acción - {{ $planImplementacion->parent }}</h5>
    <div class="mt-5 mb-5">
        <div id="bloqueado"></div>

        <div class="botones_vistas_gantt">
            <div class="row">
                <div class="col-4">
                    <h2 id="titlo-tab" class="text-capitalize">Diagrama Gantt</h2>
                </div>
                <div class="text-right col-8 caja_botones_menu">
                    <a href="#" data-tabs="original_gantt" onclick="cambiarTitulo('Gantt');"
                        class="btn_gantt_vista boton_activo"><i class="fas fa-stream"></i>Gantt</a>
                    <a href="#" data-tabs="tabla_gantt" onclick="cambiarTitulo('Tabla');"
                        class="btn_gantt_tabla_vista"><i class="fas fa-table"></i>Tabla</a>
                    <a href="#" data-tabs="calendario_gantt" onclick="cambiarTitulo('Calendario');"
                        class="btn_gantt_calendario_vista"><i class="fas fa-calendar-alt"></i>Calendario</a>
                    <a href="#" data-tabs="kanban_gantt" onclick="cambiarTitulo('Kanban');"
                        class="btn_gantt_kanban_vista"><i class="fas fa-th-large"></i>Kanban</a>
                </div>
            </div>


        </div>
        <div id="plan_trabajo_workspace">
            <p><i class="mr-2 fas fa-calendar"></i>Última modificación: <span id="ultima_modificacion"></span></p>
            <div class="caja_caja_secciones">
                <div class="caja_secciones">
                    <section id="original_gantt" class="caja_tab_reveldada">
                        @include('admin.planesDeAccion.diagramas-implementacion.gantt')
                    </section>

                    <section id="tabla_gantt">
                        @include('admin.planesDeAccion.diagramas-implementacion.tabla')
                    </section>

                    <section id="calendario_gantt">
                        @include('admin.planesDeAccion.diagramas-implementacion.calendario')
                    </section>

                    <section id="kanban_gantt">
                        @include('admin.planesDeAccion.diagramas-implementacion.kanban')
                    </section>
                </div>
            </div>
            <div id="modales"></div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script type="text/javascript">
        $(".botones_vistas_gantt a").click(function() {
            $(".botones_vistas_gantt a").removeClass("boton_activo");
            $(".botones_vistas_gantt a:hover").addClass("boton_activo");
        });

        function cambiarTitulo(titulo) {
            setTimeout(() => {
                document.getElementById('titlo-tab').innerText = titulo;
            }, 500);
        }
    </script>
    <script>
        $(document).ready(function() {
            initail();
        });
        var ge;

        function initail(taskId, callback) {

            //this is a simulation: load data from the local storage if you have already played with the demo or a textarea with starting demo data
            var ret = loadFromLocalStorage();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.planes-de-accion.loadProject', $planImplementacion) }}",
                success: function(response) {
                    ge.loadProject(response);
                    document.getElementById("ultima_modificacion").innerHTML = moment(response.updated_at)
                        .format("DD-MM-YYYY hh:mm:ss A")
                    ge.checkpoint(); //empty the undo stac
                    renderKanban(response);
                    renderTable(response);
                    renderCalendar(response);
                    $(".ganttButtonBar button.requireWrite").attr("disabled", "true");
                },
                error: function(response) {
                    toastr.error(response);
                    // setTimeout(() => {
                    //     toastr.info("Reiniciaremos el diagrama de gantt");
                    //     window.location.reload();
                    // }, 1000);
                }
            });
            return ret;
        }
    </script>
@endsection
