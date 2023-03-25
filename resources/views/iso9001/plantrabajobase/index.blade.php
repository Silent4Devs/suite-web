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

    {{-- {{ Breadcrumbs::render('admin.planTrabajoBase.index') }} --}}


    <div class="mt-5 mb-5">
        <div class="py-3 col-12 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Plan de Implementación ISO 9001</strong></h3>
        </div>
        <div id="bloqueado"></div>

        <div class="botones_vistas_gantt">
            <div class="row">
                <div class="col-4">
                    <h2 id="titlo-tab" class="text-capitalize">Diagrama Gantt</h2>
                </div>
                <div class="text-right col-8 caja_botones_menu">
                    <a href="#" id="tabla_remove" data-tabs="original_gantt"
                        onclick="loadGanttFromServer();cambiarTitulo('Gantt');" class="btn_gantt_vista boton_activo"><i
                            class="fas fa-stream"></i>Gantt</a>
                    <a href="#" id="tabla_gantt_click" data-tabs="tabla_gantt" onclick="initTable();cambiarTitulo('Tabla');"
                        class="btn_gantt_tabla_vista"><i class="fas fa-table"></i>Tabla</a>
                    <a href="#" data-tabs="calendario_gantt" onclick="initCalendar();cambiarTitulo('Calendario');"
                        class="btn_gantt_calendario_vista"><i class="fas fa-calendar-alt"></i>Calendario</a>
                    <a href="#" data-tabs="kanban_gantt" onclick="initKanban();cambiarTitulo('Kanban');"
                        class="btn_gantt_kanban_vista"><i class="fas fa-th-large"></i>Kanban</a>
                </div>
            </div>


        </div>
        <div id="plan_trabajo_workspace">
            <p><i class="mr-2 fas fa-calendar"></i>Última modificación: <span id="ultima_modificacion"></span></p>
            <div class="caja_caja_secciones">
                <div class="caja_secciones ">
                    <section id="original_gantt" class="caja_tab_reveldada">
                        @include('admin.planTrabajoBase.gantt')
                    </section>

                    <section id="tabla_gantt">
                        @include('admin.planTrabajoBase.tabla')
                    </section>

                    <section id="calendario_gantt">
                        @include('admin.planTrabajoBase.calendario')
                    </section>

                    <section id="kanban_gantt">
                        @include('admin.planTrabajoBase.kanban')
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

        window.onbeforeunload = function(event) {
            // checkChangesGantt();
            estaBloqueado(event);
        }
        let idleTime = 0;
        document.addEventListener('DOMContentLoaded', function() {
            if (@json($texto)) {
                console.log("asdasdasd");
                /*document.getElementById("tabla_remove").classList.remove("boton_activo");
                document.getElementById("tabla_gantt_click").classList.add("btn_activo", "boton_activo");*/
                console.log("vvvvv");
                initTable();
            }
            // let isBlocked = JSON.parse(Cookies.get('bloqueo'));
            // if (!isBlocked.bloqueado) {
            //     Cookies.set('bloqueo', '{"user":"Uriel", "bloqueado":true}');
            // }

            // console.log(isBlocked);
            let idleInterval = setInterval(timerIncrement, 60000); // 1 minute

            // Zero the idle timer on mouse movement.
            $(this).mousemove(function(e) {
                idleTime = 0;
            });
            $(this).keypress(function(e) {
                idleTime = 0;
            });
            // obtenerBloqueo();
        });

        function timerIncrement() {
            idleTime = idleTime + 1;
            if (idleTime > 19) { // 20 minutes
                window.location.reload();
            }
        }


        function obtenerBloqueo() {
            $.ajax({
                type: "POST",
                url: "{{ route('lockedPlan.getLockedToPlanTrabajo') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    "user_id": "{{ auth()->user()->id }}",
                },
                success: function(response) {
                    console.log(response);
                    document.getElementById('bloqueado').innerHTML = "";
                    let workspace = document.getElementById('plan_trabajo_workspace');
                    workspace.style.opacity = "1";
                    workspace.style.pointerEvents = "all";
                    if (response.success) {
                        ponerBloqueo();
                    } else if (response.error) {
                        document.getElementById('bloqueado').innerHTML = `
                     <div class="px-3 py-2 mb-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                        <div class="row w-100">
                            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                                <div class="w-100">
                                    <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                                </div>
                            </div>
                            <div class="col-11">
                                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Plan de trabajo bloqueado debido a que está siendo modificado por el siguiente usuario: <strong><i class="mr-1 fas fa-user-circle"></i>${response.locked_by.name}</strong></p>
                            </div>
                        </div>
                    </div>
                    `;
                        let workspace = document.getElementById('plan_trabajo_workspace');
                        workspace.style.opacity = "0.7";
                        workspace.style.pointerEvents = "none";
                    }
                }
            });
        }


        function ponerBloqueo() {
            $.ajax({
                type: "POST",
                url: "{{ route('lockedPlan.setLockedToPlanTrabajo') }}",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    //console.log(response);
                }
            });
        }

        function estaBloqueado(event) {
            $.ajax({
                type: "POST",
                url: "{{ route('lockedPlan.isLockedToPlanTrabajo') }}",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    //console.log(response);
                    if (response.blocked_by_self) {
                        removerBloqueo();
                        // let confirmacion = confirm("Está seguro de abandonar la página");
                        // if (confirmacion) {
                        //     removerBloqueo();
                        // } else {
                        //     event.preventDefault();
                        //     window.location = "{{ route('admin.planTrabajoBase.index') }}";
                        // }

                    } else if (response.blocked) {

                    } else {

                    }
                }
            });
        }

        function removerBloqueo() {
            $.ajax({
                type: "POST",
                url: "{{ route('lockedPlan.removeLockedToPlanTrabajo') }}",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    //console.log(response);
                }
            });
        }

        function cambiarTitulo(titulo) {
            setTimeout(() => {
                document.getElementById('titlo-tab').innerText = titulo;
            }, 500);
        }
    </script>
@endsection
