<style type="text/css">
    .caja_tabla {
        overflow: auto;
    }

    /* width */
    .caja_tabla::-webkit-scrollbar {
        height: 5px;
    }

    /* Track */
    .caja_tabla::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0);
    }

    /* Handle */
    .caja_tabla::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.2);
        border-radius: 50px;
    }

    /* Handle on hover */
    .caja_tabla::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.5);
    }

    .vista_tabla_gantt {
        border-collapse: collapse;
    }


    .STATUS_ACTIVE,
    .STATUS_ACTIVE:hover {
        background-color: rgb(253, 171, 61) !important;
        fill: rgb(253, 171, 61) !important;
    }

    .STATUS_DONE,
    .STATUS_DONE:hover {
        background-color: rgb(0, 200, 117) !important;
        fill: rgb(0, 200, 117) !important;
    }

    .STATUS_FAILED,
    .STATUS_FAILED:hover {
        background-color: rgb(226, 68, 92) !important;
        fill: rgb(226, 68, 92) !important;
    }

    .STATUS_SUSPENDED,
    .STATUS_SUSPENDED:hover {
        background-color: #aaaaaa !important;
        fill: #aaaaaa !important;
    }

    .STATUS_UNDEFINED,
    .STATUS_UNDEFINED:hover {
        background-color: #00b1e1 !important;
        fill: #00b1e1 !important;
    }







    .tabla_gantt_fase:nth-child(1n+1) th {
        color: #000ff1;
    }

    .tabla_gantt_fase:nth-child(2n+1) th {
        color: #f10075;
    }

    .tabla_gantt_fase:nth-child(3n+1) th {
        color: #02d68f;
    }


    .tabla_gantt_fase:nth-child(1n+1) tbody tr:before {
        background-color: #000ff1;
    }

    .tabla_gantt_fase:nth-child(2n+1) tbody tr:before {
        background-color: #f10075;
    }

    .tabla_gantt_fase:nth-child(3n+1) tbody tr:before {
        background-color: #02d68f;
    }








    .tabla_gantt_fase {
        width: 100%;
        margin-top: 20px;
    }

    .tabla_gantt_fase th {
        background-color: rgba(0, 0, 0, 0);
        border-bottom: 1px solid #e3e3e3;
        padding: 10px;
        cursor: pointer;
    }

    .th_activo {
        background-color: #f0eff5 !important;
    }

    .tabla_gantt_fase tr {
        position: relative;
    }

    .tabla_gantt_fase tr:before {
        content: "";
        position: absolute;
        width: 7px;
        height: 90%;
        top: 5%;
        left: 0;
    }

    .tabla_gantt_fase td {
        padding: 10px;
        border: 2px solid #fff;
        background-color: #eeeeee;
        position: relative;
    }

    .tabla_gantt_fase tbody i {
        color: #888;
    }

    .estatus_td {
        color: #fff;
        position: relative;
        padding: 0px !important;
    }

    .tr_secundario,
    .td_secundario,
    .estatus_td {
        text-align: center;
    }

    .tabla_gantt_fase img {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        margin: auto;
        background-color: white;
    }

    .tabla_gantt_fase img:nth-child(2) {
        margin-left: 50%;
        transform: scale(0.8);
    }

    .tabla_gantt_fase .btn_empleados {
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        margin: auto;
        margin-left: 50%;
        position: absolute;
        width: 35px;
        height: 35px;
        border-radius: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #666;
        color: #fff;
        z-index: 1;
        cursor: pointer;
        font-size: 1.5vw;
        transform: scale(0.8);
    }

    .td_resources:hover .btn_empleados {
        background-color: #fff;
        color: #000;
    }

    .lista_empleados {
        text-align: left;
        list-style: none;
        padding: 0;
    }

    .lista_empleados li {
        text-align: left !important;
        margin-top: 7px;
    }

    .tabla_gantt_fase input {
        border: none;
        background-color: rgba(255, 255, 255, 0);
    }

    .tabla_gantt_fase input:focus,
    .tabla_gantt_fase input:focus-visible {
        background-color: rgba(255, 255, 255, 1);
        outline: none;
        font-weight: bold;
    }

    .estatus_select {
        /* position: absolute; */
        top: 0;
        left: 0;
        width: 100%;
        height: 42px;
        background-color: rgba(0, 0, 0, 0) !important;
        outline: none !important;
        border: none !important;
        color: #fff;
        text-align-last: center;
        -ms-text-align-last: center;
        -moz-text-align-last: center;
    }

    .estatus_select span {
        width: 100%;
        text-align: center;
    }

    .selected_resource_task {
        background-color: #b3f0f3;
    }

    .td_resources {
        cursor: pointer;
        transition: 0.5s;
    }

    .td_resources:hover {
        background-color: #969696;
    }

    .input_fecha_inicio {
        width: 100px;
    }

    .input_fecha_fin {
        width: 100px;
    }

    .input_duracion {
        width: 35px;
        text-align: right
    }

    .texto-dias {
        padding: 0;
        text-align: left;
        margin-left: 3px;
        margin-top: 1px;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .icon-calendar {
        position: absolute;
        top: 10px;
        right: 7px;
    }

    .icon-calendar i {
        color: #000 !important;
    }

    .status-note-wrapper {
        position: absolute;
        right: -1px;
        top: 0;
        width: 12px;
        z-index: 1;
    }

    .status-print-color {
        -webkit-print-color-adjust: exact !important;
    }

    .estatus_td:hover .status-note,
    .estatus_td:hover .add-status-note,
    .estatus_td.add-status-note-open .status-note,
    .estatus_td.add-status-note-open .add-status-note {
        transition: border-width .3s ease;
        border-width: 0 18px 18px 0;
    }

    .estatus_td .add-status-note {
        transition: border-width .3s .2s ease;
        position: absolute;
        top: 0;
        right: 1px;
        border-style: solid;
        border-color: rgba(0, 0, 0, .2) #fff;
        border-color: rgba(0, 0, 0, .2) #f0eff5;
        border-width: 0;
    }

    .estatus_td:hover .fa-plus,
    .estatus_td.add-status-note-open .fa-plus {
        display: block;
    }

    .estatus_td .fa-plus {
        display: none;
        position: absolute;
        top: 2px;
        right: 0;
        font-size: 8px;
    }

    .seleccionado {
        background-color: rgb(0, 195, 255) !important;
        animation: pulse 2s infinite;
    }

    .code {
        background-color: white;
        color: rgb(0, 183, 255);
        border-style: groove none groove groove;
        width: 36px;
        animation: pulse 2s infinite;
    }

    @-webkit-keyframes pulse {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(0, 26, 255, 0.4);
        }

        70% {
            -webkit-box-shadow: 0 0 0 20px rgba(255, 0, 0, 0);
        }

        100% {
            -webkit-box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
        }
    }

</style>

<div class="card" style="box-shadow: none; !important">
    <div class="card-body caja_tabla" style="height: 600px;">
        <div class="vista_tabla_gantt">
            <div id="cuerpo_tabla"></div>
        </div>
    </div>
</div>


@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {
            initTable();

        });

        function pintarId() {
            let textobuscar = @json($texto).replace(/\s+/g, '').toLowerCase();
            document.getElementById(textobuscar).focus();
            document.getElementById(textobuscar).classList.add('seleccionado');
            document.getElementById(textobuscar + 'code').classList.add('code');
        }

        function initTable() {
            // let url = '{{ asset('storage/gantt/') }}/{{ $name_file_gantt }}';
            // $.ajax({
            // 	type: "get",
            // 	url: url,
            // 	success: function (response) {
            // 		renderTable(response);
            // 	}
            // });
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.planTrabajoBase.loadProyect') }}",
                success: function(response) {
                    renderTable(response);
                }
            });
        }


        function saveOnServer(response) {
            $.ajax({
                type: "post",
                url: "{{ route('admin.planTrabajoBase.saveProyect') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    prj: JSON.stringify(response),
                },
                dataType: "JSON",
                success: function(response) {
                    $('#workSpace').trigger('refreshTasks.gantt');
                    console.log(response)
                    document.getElementById('ultima_modificacion').innerHTML = response.ultima_modificacion;
                    // toastr.success('Tarea actualizada con éxito');
                }
            });
        }


        function renderTable(response, id_tbody = null) {
            let resources = response.resources;

            // console.log(resources);
            let html = '';
            let contador = 0;
            let contador_registros = 1;
            response.tasks.forEach((task, idx) => {
                let estatus = '';
                switch (task.status) {
                    case 'STATUS_ACTIVE':
                        estatus = 'En proceso';
                        break;
                    case 'STATUS_DONE':
                        estatus = 'Completada';
                        break;
                    case 'STATUS_FAILED':
                        estatus = 'Con retraso';
                        break;
                    case 'STATUS_SUSPENDED':
                        estatus = 'Suspendida';
                        break;
                    case 'STATUS_UNDEFINED':
                        estatus = 'Sin iniciar';
                        break;
                    default:
                        estatus = 'Sin iniciar';
                        break;
                }
                if (Number(task.level) == 0) {
                    html += `
					<h3 id="level_zero" data-id="${task.id}">Proyecto Base: ${task.name} (${Math.ceil(task.progress)} %)</h3>
					`;
                }

                if (Number(task.level) == 1) {
                    contador++;
                    html += `
					</table>
					<table class="tabla_gantt_fase">
						<thead class="${id_tbody != null ? id_tbody == contador + '_contenedor' ? 'th_activo' : '' : contador == 1 ? 'th_activo' : ''}">
							<tr data-id=${task.id} data-level=${task.level}>
								<th style="width:10px;"><span><i class="fas ${id_tbody != null ? id_tbody == contador + '_contenedor' ? 'fa-minus-circle' : 'fa-plus-circle' : contador == 1 ? 'fa-minus-circle' : 'fa-plus-circle'}"></i></span></th>
								<th>${task.name} (${Math.ceil(task.progress)} %)</th>
								<th class="tr_secundario ${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}">Responsable</th>
								<th class="tr_secundario ${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}">Estatus</th>
								<th class="tr_secundario ${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}" style="width:10%;">Progreso</th>
								<th class="tr_secundario ${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}" style="width:10%;">Fecha Inicio</th>
								<th class="tr_secundario ${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}" style="width:10%;">Fecha Fin</th>
								<th class="tr_secundario ${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}" style="width:10%;">Duración</th>
								<th class="tr_secundario ${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}">Dependencia</th>
							</tr>
						</thead>
						</tbody>
						<tbody id="${contador}_contenedor" class="${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}">
					`;

                } else if (Number(task.level) > 1) {
                    let idname = task.name.replace(/\s+/g, '').toLowerCase();

                    html += `

						<tr id="${task.id}" data-level=${task.level} numero-registro="${contador_registros}">
							<td class="" id="${idname}">${contador_registros}</td>
							<td class="" style="padding-left: ${task.level * 15}px;">
								<div class="d-flex" style="width: calc(400px - ${task.level * 15}px);">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-up" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M4.854 1.146a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L4 2.707V12.5A2.5 2.5 0 0 0 6.5 15h8a.5.5 0 0 0 0-1h-8A1.5 1.5 0 0 1 5 12.5V2.707l3.146 3.147a.5.5 0 1 0 .708-.708l-4-4z"/>
									</svg>
									<input class="name_input" id="${idname}code" value="${task.name}" style="width: 100%">
								</div>
							</td>`;
                    let assigs = [];
                    if (task.assigs != null) {
                        assigs = task.assigs.map(asignado => {
                            return (resources.find(r => r.id === Number(asignado.resourceId)));
                        });
                    }
                    assigs = assigs.filter(r => r);
                    let imagenes = '';
                    if (assigs.length > 0) {
                        if (assigs.length < 3) {
                            for (var i = 0; i < assigs.length; i++) {
                                let foto = 'man.png';
                                if (assigs[i] != undefined) {
                                    if (assigs[i].foto == null) {
                                        if (assigs[i].genero == 'M') {
                                            foto = 'woman.png';
                                        } else {
                                            foto = 'usuario_no_cargado.png';
                                        }
                                    } else {
                                        foto = assigs[i].foto;
                                    }
                                    imagenes +=
                                        `<img class="rounded-circle" src="{{ asset('storage/empleados/imagenes') }}/${foto}"></img>`;
                                }
                            }
                        } else {

                            let foto = 'man.png';
                            if (assigs[0] != undefined) {
                                if (assigs[0].foto == null) {
                                    if (assigs[0].genero == 'M') {
                                        foto = 'woman.png';
                                    } else {
                                        foto = 'usuario_no_cargado.png';
                                    }
                                } else {
                                    foto = assigs[0].foto;
                                }
                            }


                            imagenes +=
                                `<img class="rounded-circle" src="{{ asset('storage/empleados/imagenes') }}/${foto}"></img><span class="btn_empleados" onmouseover="renderCard(this, '${encodeURIComponent(JSON.stringify(assigs))}')">+${assigs.length - 1}</span>`;
                        }
                    }


                    html += `
							<td class="td_secundario td_resources" width="15%">${imagenes}</td>

							<td class="${task.status} estatus_td" width="15%">
								<div class="status-note-wrapper"><div class="status-print-color" style="/* background-color: rgb(226, 68, 92); *//* border-bottom-color: rgb(206, 48, 72); */"><div class="add-status-note"></div><i class="fa fa-plus menu-dog-ear-color" style="color: rgb(226, 68, 92);"></i></div></div>
								<select class="estatus_select">

									<option class="STATUS_ACTIVE" value="STATUS_ACTIVE"
										${task.status == 'STATUS_ACTIVE' ? 'selected':''}><span>En proceso</span></option>
									<option class="STATUS_DONE" value="STATUS_DONE"
										${task.status == 'STATUS_DONE' ? 'selected':''}><span>Completado</span></option>
									<option class="STATUS_FAILED" value="STATUS_FAILED"
										${task.status == 'STATUS_FAILED' ? 'selected':''}><span>Retraso</span></option>
									<option class="STATUS_SUSPENDED" value="STATUS_SUSPENDED"
										${task.status == 'STATUS_SUSPENDED' ? 'selected':''}><span>Suspendida</span></option>
									<option class="STATUS_UNDEFINED" value="STATUS_UNDEFINED"
										${task.status == 'STATUS_UNDEFINED' ? 'selected':''}><span>Sin iniciar</span></option>

								</select>
							</td>
							<td class="td_secundario td_progress" style="position:relative;">
								<input class="progress_task" type="number" min="0" max="100" value="${Math.ceil(task.progress)}" ${isParent(task,response.tasks) ? 'readonly':''} />
								<span style="position:absolute;top:11px;right:2px;">%</span>
							</td>
							<td class="td_secundario td_fecha_inicio" style="width:10%; position:relative">
								<input class="input_fecha_inicio" type="text" value="${moment.unix((task.start)/1000).format("YYYY-MM-DD")}" ${task.depends != "" ? 'disabled': ''} />
								<span class="icon-calendar"><i class="fas fa-calendar-day"></i></span>
							</td>
							<td class="td_secundario td_fecha_fin" style="width:10%;">
								<input class="input_fecha_fin" type="text" value="${moment.unix((task.end)/1000).format("YYYY-MM-DD")}" />
								<span class="icon-calendar"><i class="fas fa-calendar-day"></i></span>
							</td>
							<td class="td_secundario td_duracion" style="width:10%;">
								<div class="d-flex" style="width:70px">
									<input class="input_duracion" type="number" value="${task.duration}" />
									<div class="col-sm-12 col-lg-6 texto-dias">
										<span>Días</span>
									</div>
								</div>
							</td>
							<td class="td_secundario" style="width:10%;">${/*task.depends != "" ? response.tasks[Number(task.depends)-1].name.substr(0,20)+'...':''*/ task.depends != undefined ? task.depends : ''}</td>
						</tr>
					`;
                }
                contador_registros++;
            });

            let c_tabla = document.querySelector('#cuerpo_tabla');
            c_tabla.innerHTML = html;
            $(".input_fecha_inicio").datepicker({
                beforeShowDay: $.datepicker.noWeekends,
                dateFormat: 'yy-mm-dd',
                changeYear: true,
                onSelect: function(dateText) {
                    // console.log(this.closest('tbody').getAttribute('id'));
                    // let id_row = Number(this.closest('tr').getAttribute('id'));
                    let id_row = this.closest('tr').getAttribute('id');
                    let numero_registro = Number(this.closest('tr').getAttribute('numero-registro'));
                    let valor_nuevo = moment(this.value).valueOf();
                    let tarea_correspondiente = response.tasks.find(t => t.id == id_row);
                    if (tarea_correspondiente.depends != "") {
                        let padre = document.querySelector(
                            `tr[numero-registro="${tarea_correspondiente.depends}"]`);
                        let id_padre = Number(padre.getAttribute('id'));
                        let tarea_correspondiente_padre = response.tasks.find(t => t.id == id_padre);
                        let fecha_inicio_padre = moment.unix((tarea_correspondiente_padre.start) / 1000).format(
                            "YYYY-MM-DD")
                        if (moment(this.value) != 0) {
                            alert('No se puede cambiar la fecha ya que esta tarea depende de otra');
                            this.value = moment.unix((tarea_correspondiente_padre.start) / 1000).format(
                                "YYYY-MM-DD");
                        }
                    } else {
                        //establecer duracion
                        let new_fecha_fin = moment(moment(this.value, 'YYYY-MM-DD').businessAdd(
                            tarea_correspondiente.duration)._d).format('YYYY-MM-DD')
                        let nueva_fecha_fin_menos_un_dia = moment(moment(new_fecha_fin, 'YYYY-MM-DD')
                            .businessSubtract(1)._d).format('YYYY-MM-DD');
                        let dependencias = response.tasks.filter(t => t.depends == numero_registro);
                        tarea_correspondiente.start = valor_nuevo;
                        tarea_correspondiente.end = moment(nueva_fecha_fin_menos_un_dia).valueOf();

                        dependencias.forEach(dependencia => {
                            let nueva_fecha_inicio = moment(moment(nueva_fecha_fin_menos_un_dia,
                                'YYYY-MM-DD').businessAdd(1)._d).format('YYYY-MM-DD');
                            let nueva_fecha_fin = moment(moment(nueva_fecha_inicio, 'YYYY-MM-DD')
                                .businessAdd(dependencia.duration)._d).format('YYYY-MM-DD');

                            dependencia.start = moment(nueva_fecha_inicio).valueOf();
                            dependencia.end = moment(nueva_fecha_fin).valueOf();
                        });
                        calculateAverageOnNodes(response.tasks);
                        calculateStatus(response.tasks);
                        let id_tbody = this.closest('tbody').getAttribute('id');
                        saveOnServer(response);
                        renderTable(response, id_tbody);
                    }
                }
            });

            $(".input_fecha_fin").datepicker({
                beforeShowDay: $.datepicker.noWeekends,
                dateFormat: 'yy-mm-dd',
                changeYear: true,
                onSelect: function(dateText) {
                    // console.log(this.closest('tbody').getAttribute('id'));
                    // let id_row = Number(this.closest('tr').getAttribute('id'));
                    let id_row = this.closest('tr').getAttribute('id');
                    let numero_registro = Number(this.closest('tr').getAttribute('numero-registro'));
                    let valor_nuevo = moment(this.value).valueOf();
                    let tarea_correspondiente = response.tasks.find(t => t.id == id_row);
                    let fecha_inicio = moment.unix((tarea_correspondiente.start) / 1000).format("YYYY-MM-DD");
                    let duracion = moment(this.value, 'YYYY-MM-DD').businessDiff(moment(fecha_inicio,
                        'YYYY-MM-DD'));
                    let dependencias = response.tasks.filter(t => t.depends == numero_registro);
                    let fecha_fin_actual = moment.unix(valor_nuevo / 1000).format("YYYY-MM-DD");
                    // console.log(fecha_inicio);
                    // console.log(fecha_fin_actual);
                    tarea_correspondiente.duration = duracion + 1;
                    tarea_correspondiente.end = valor_nuevo;

                    // Dependencias actualizadas
                    if (dependencias.length > 0) {
                        dependencias.forEach(dependencia => {
                            let nueva_fecha_inicio = moment(moment(fecha_fin_actual, 'YYYY-MM-DD')
                                .businessAdd(1)._d).format('YYYY-MM-DD');
                            let nueva_fecha_fin = moment(moment(nueva_fecha_inicio, 'YYYY-MM-DD')
                                .businessAdd(dependencia.duration)._d).format('YYYY-MM-DD');

                            dependencia.start = moment(nueva_fecha_inicio).valueOf();
                            dependencia.end = moment(nueva_fecha_fin).valueOf();
                        });
                    }
                    calculateAverageOnNodes(response.tasks);
                    calculateStatus(response.tasks);
                    let id_tbody = this.closest('tbody').getAttribute('id');
                    saveOnServer(response);
                    renderTable(response, id_tbody);
                }
            });
            let name_input = document.querySelectorAll('.name_input');
            name_input.forEach(i_nombre => {
                i_nombre.addEventListener('change', function() {
                    // let id_row = Number(this.parentElement.parentElement.getAttribute('id'));
                    let id_row = this.closest('tr').getAttribute('id');
                    // console.log( this.closest('tr'));
                    // console.log(id_row);
                    let valor_nuevo = this.value;
                    let tarea_correspondiente = response.tasks?.find(t => t.id == id_row);
                    // console.log(tarea_correspondiente);
                    tarea_correspondiente.name = valor_nuevo;
                    saveOnServer(response);
                });
            });

            // Se añade evento change a select para estatus
            let estatus_select = document.querySelectorAll('.estatus_select');
            estatus_select.forEach(s_status => {
                s_status.addEventListener('change', function() {
                    let id_row = this.parentElement.parentElement.getAttribute('id');
                    let tarea_correspondiente = response.tasks.find(t => t.id == id_row);
                    let valor_nuevo = this.value;
                    let id_tbody = s_status.closest('tbody').getAttribute('id');
                    if (!isParent(tarea_correspondiente, response.tasks)) {
                        if (valor_nuevo == 'STATUS_DONE') {
                            if (tarea_correspondiente.isSuspended) {
                                tarea_correspondiente.isSuspended = false;
                            } else {
                                tarea_correspondiente['isSuspended'] = false;

                            }
                            if (tarea_correspondiente.isFailed) {
                                tarea_correspondiente.isFailed = false;
                            } else {
                                tarea_correspondiente['isFailed'] = false;
                            }
                            tarea_correspondiente.status = valor_nuevo;
                            tarea_correspondiente.progress = 100; // set progress in 100
                            calculateAverageOnNodes(response.tasks);
                            calculateStatus(response.tasks);
                            saveOnServer(response);
                            renderTable(response, id_tbody);

                        } else if (valor_nuevo == 'STATUS_UNDEFINED') {
                            Swal.fire({
                                title: '¿Estás seguro de reinicializar la actividad?',
                                text: "No podrás revertir esto!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Sí',
                                cancelButtonText: 'No'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    if (tarea_correspondiente.isSuspended) {
                                        tarea_correspondiente.isSuspended = false;
                                    } else {
                                        tarea_correspondiente['isSuspended'] = false;

                                    }
                                    if (tarea_correspondiente.isFailed) {
                                        tarea_correspondiente.isFailed = false;
                                    } else {
                                        tarea_correspondiente['isFailed'] = false;
                                    }
                                    tarea_correspondiente.status = valor_nuevo;
                                    tarea_correspondiente.progress = 0; // set progress in 0
                                    calculateAverageOnNodes(response.tasks);
                                    calculateStatus(response.tasks);
                                    saveOnServer(response);
                                }
                                renderTable(response, id_tbody);
                            })

                        } else if (valor_nuevo == 'STATUS_SUSPENDED') {
                            if (tarea_correspondiente.isSuspended) {
                                tarea_correspondiente.isSuspended = true;
                            } else {
                                tarea_correspondiente['isSuspended'] = true;

                            }
                            if (tarea_correspondiente.isFailed) {
                                tarea_correspondiente.isFailed = false;
                            } else {
                                tarea_correspondiente['isFailed'] = false;
                            }
                            calculateAverageOnNodes(response.tasks);
                            calculateStatus(response.tasks);
                            saveOnServer(response);
                            renderTable(response, id_tbody);
                        } else if (valor_nuevo == 'STATUS_FAILED') {
                            if (tarea_correspondiente.end - Date.now() >= 0) {
                                toastr.info('Esta actividad no puede ser puesta en retraso');
                                s_status.value = tarea_correspondiente.status;
                            } else {
                                if (tarea_correspondiente.isSuspended) {
                                    tarea_correspondiente.isSuspended = false;
                                } else {
                                    tarea_correspondiente['isSuspended'] = false;

                                }
                                if (tarea_correspondiente.isFailed) {
                                    tarea_correspondiente.isFailed = true;
                                } else {
                                    tarea_correspondiente['isFailed'] = true;
                                }
                                tarea_correspondiente.status = valor_nuevo;
                                calculateAverageOnNodes(response.tasks);
                                calculateStatus(response.tasks);
                                saveOnServer(response);
                                renderTable(response, id_tbody);
                            }
                        } else { // Si la tarea cambia a otro estatus se pregunta el progreso
                            Swal.fire({
                                title: 'Ingresa el progreso, en un rango de 1-99',
                                input: 'number',
                                icon: 'question',
                                inputAttributes: {
                                    autocapitalize: 'off'
                                },
                                showCancelButton: true,
                                confirmButtonText: 'Cambiar Estatus',
                                cancelButtonText: 'Cancelar',
                                showLoaderOnConfirm: true,
                                inputValidator: (progress) => {
                                    if (Number(progress) >= 1 && Number(progress) <= 99) {
                                        return null;
                                    } else {
                                        return 'Debes de ingresar un número en el rango de 1 a 99';
                                    }
                                },
                                preConfirm: (progress) => {
                                    if (Number(progress) >= 1 && Number(progress) <= 99) {
                                        if (tarea_correspondiente.isSuspended) {
                                            tarea_correspondiente.isSuspended = false;
                                        } else {
                                            tarea_correspondiente['isSuspended'] = false;

                                        }
                                        if (tarea_correspondiente.isFailed) {
                                            tarea_correspondiente.isFailed = false;
                                        } else {
                                            tarea_correspondiente['isFailed'] = false;
                                        }
                                        tarea_correspondiente.status = valor_nuevo;
                                        tarea_correspondiente.progress = Number(progress);
                                        calculateAverageOnNodes(response.tasks);
                                        calculateStatus(response.tasks);
                                        saveOnServer(response);
                                        renderTable(response, id_tbody);
                                    } else {
                                        s_status.value = tarea_correspondiente.status;
                                    }
                                },
                                allowOutsideClick: () => !Swal.isLoading()
                            }).then((result) => {

                                if (result.isDismissed) {
                                    s_status.value = tarea_correspondiente.status;
                                    calculateAverageOnNodes(response.tasks);
                                    calculateStatus(response.tasks);
                                    saveOnServer(response);
                                    renderTable(response, id_tbody);
                                }

                            })
                        }
                    } else {
                        s_status.value = tarea_correspondiente.status;
                        toastr.info('No puedes editar una actividad padre');
                    }
                });
            });

            //Evento Fecha Inicio
            let duracion_inputs = document.querySelectorAll('.input_duracion');
            duracion_inputs.forEach(duracion_input => {
                duracion_input.addEventListener('change', function() {
                    // let id_row = Number(this.closest('tr').getAttribute('id'));
                    let id_row = this.closest('tr').getAttribute('id');
                    if (Number(this.value) > 0) {
                        let valor_nuevo = Number(this.value);
                        let numero_registro = Number(this.closest('tr').getAttribute('numero-registro'));
                        let tarea_correspondiente = response.tasks.find(t => t.id == id_row);
                        let fecha_inicio = moment.unix((tarea_correspondiente.start) / 1000).format(
                            "YYYY-MM-DD");
                        let new_fecha_fin = moment(moment(fecha_inicio, 'YYYY-MM-DD').businessAdd(
                            valor_nuevo - 1)._d).format('YYYY-MM-DD')
                        tarea_correspondiente.duration = valor_nuevo;
                        tarea_correspondiente.end = moment(new_fecha_fin).valueOf();

                        let dependencias = response.tasks.filter(t => t.depends == numero_registro);
                        let fecha_fin_actual = moment.unix(moment(new_fecha_fin).valueOf() / 1000).format(
                            "YYYY-MM-DD");
                        if (dependencias.length > 0) {
                            dependencias.forEach(dependencia => {
                                let nueva_fecha_inicio = moment(moment(fecha_fin_actual,
                                    'YYYY-MM-DD').businessAdd(1)._d).format('YYYY-MM-DD');
                                let nueva_fecha_fin = moment(moment(nueva_fecha_inicio,
                                    'YYYY-MM-DD').businessAdd(dependencia.duration)._d).format(
                                    'YYYY-MM-DD');

                                dependencia.start = moment(nueva_fecha_inicio).valueOf();
                                dependencia.end = moment(nueva_fecha_fin).valueOf();
                            });
                        }
                        calculateAverageOnNodes(response.tasks);
                        calculateStatus(response.tasks);
                        let id_tbody = duracion_input.closest('tbody').getAttribute('id');
                        saveOnServer(response);
                        renderTable(response, id_tbody);
                    } else {
                        alert('Debes elegir una duración de máximo 1 día');
                    }
                });
            });

            // Evento Progreso Propagar a Childs or Parent
            let progress_task = document.querySelectorAll('.progress_task');
            progress_task.forEach(element => {
                element.addEventListener('change', function() {
                    let current_task_id = this.closest('tr').getAttribute('id');
                    let current_task = response.tasks.find(t => t.id == current_task_id);
                    if (!isParent(current_task, response.tasks)) {
                        if (Number(this.value) >= 0 && Number(this.value) <= 100) {
                            current_task.progress = Number(this.value);
                            if (Number(this.value) == 100) {
                                current_task.status = "STATUS_DONE";
                            } else {
                                current_task.status = "STATUS_ACTIVE";
                            }
                            calculateAverageOnNodes(response.tasks);
                            calculateStatus(response.tasks);
                            let id_tbody = element.closest('tbody').getAttribute('id');
                            saveOnServer(response);
                            renderTable(response, id_tbody);
                        } else {
                            Swal.fire(
                                '¡Información!',
                                `El progreso de la tarea debe estár en un rango de 0 a 100`,
                                'info'
                            )
                            this.value = current_task.progress;
                        }
                    } else {
                        element.value = current_task.progress;
                        toastr.info('No puedes editar una actividad padre');
                    }
                });
            });

            //Evento click para td resources
            let td_resources = document.querySelectorAll('.td_resources');
            td_resources.forEach(element => {
                element.addEventListener('click', function() {
                    // let id_row = Number(this.parentElement.getAttribute('id'));
                    let id_row = this.parentElement.getAttribute('id');
                    let valor_nuevo = this.value;
                    let id_tbody = element.closest('tbody').getAttribute('id');
                    let contenedor = document.getElementById('modales');

                    let tarea_correspondiente = response.tasks.find(t => t.id == id_row);

                    contenedor.innerHTML = `
						<div class="modal fade" tbody-contenedor="${id_tbody}"  id="${id_row}-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="${id_row}-modalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header" style="background-color: #00A8AF !important; color:#fff">
									<h5 class="modal-title" id="${id_row}-modalLabel">Recursos</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="mb-3 input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
										</div>
										<input type="text" class="form-control search_resources" placeholder="Nombre empleado" aria-label="Username" aria-describedby="basic-addon1">
									</div>
									<ul class="list-group">
										<div class="contenedor_lista">
											${renderResources(response,tarea_correspondiente)}
										</div>
									</ul>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								</div>
								</div>
							</div>
						</div>
					`;
                    document.querySelector('.search_resources').addEventListener('keyup', function() {
                        let contenedor_lista = document.querySelector('.contenedor_lista');
                        contenedor_lista.innerHTML = "";
                        contenedor_lista.innerHTML = renderResources(response,
                            tarea_correspondiente, this.value);
                        renderListEvent(response, tarea_correspondiente, id_row, renderTable);
                    });
                    $(`#${id_row}-modal`).modal('show');
                    renderListEvent(response, tarea_correspondiente, id_row, renderTable);
                });
            });

            window.renderCard = function(e, assigs) {
                let obj = JSON.parse(decodeURIComponent(assigs));

                const instance = tippy(document.querySelector('.btn_empleados:hover'));
                instance.setProps({
                    arrow: true,
                    animation: 'scale',
                    allowHTML: true,
                });
                instance.show();

                let info_card = `
					<ul class="lista_empleados">`
                obj.forEach(asigando => {
                    let foto = 'man.png';
                    if (asigando.foto == null) {
                        if (asigando.genero == 'M') {
                            foto = 'woman.png';
                        } else {
                            foto = 'usuario_no_cargado.png';
                        }
                    } else {
                        foto = asigando.foto;
                    }
                    info_card +=
                        `<li><img class="rounded-circle" src="{{ asset('storage/empleados/imagenes') }}/${foto}" style="height: 20px !important; background-color: #fff;"></img> ${asigando.name}</li>`;
                })

                info_card += '</ul>';

                instance.setContent(info_card);
                $(".btn_empleados").mouseleave(function() {
                    instance.destroy();
                });

            }

            $(".tabla_gantt_fase th").click(function(e) {
                $(".tabla_gantt_fase tbody:not(.tabla_gantt_fase:hover tbody)").addClass('d-none');
                $(".tabla_gantt_fase:hover tbody").toggleClass('d-none');

                $(".tabla_gantt_fase .tr_secundario:not(.tabla_gantt_fase:hover .tr_secundario)").addClass(
                    'd-none');
                $(".tabla_gantt_fase:hover .tr_secundario").toggleClass('d-none');

                if ($(".tabla_gantt_fase:hover tbody").hasClass('d-none')) {
                    $(".tabla_gantt_fase:hover span i.fa-minus-circle").addClass('fa-plus-circle').removeClass(
                        'fa-minus-circle');
                } else {
                    $(".tabla_gantt_fase:hover span i.fa-plus-circle").addClass('fa-minus-circle').removeClass(
                        'fa-plus-circle');
                }

                if ($(".tabla_gantt_fase tbody:not(.tabla_gantt_fase:hover tbody)").hasClass('d-none')) {
                    $(".tabla_gantt_fase span i:not(.tabla_gantt_fase:hover span i)").addClass('fa-plus-circle')
                        .removeClass('fa-minus-circle');
                }

            });

            $(".tabla_gantt_fase thead").click(function(e) {
                $(".tabla_gantt_fase thead:not(.tabla_gantt_fase:hover thead)").removeClass('th_activo');

                $(".tabla_gantt_fase:hover thead").toggleClass('th_activo');
            });

            if (@json($texto)) {
                pintarId();
            }
        }

        function recalculateProgress(task, tasks) {
            let parents_task = getParents(task, tasks);
            parents_task.forEach(parent_task => {
                let children_tasks = getChildren(parent_task, tasks);
                let average = 0;
                children_tasks.forEach(child_task => {
                    average += child_task.progress;
                });
                let total_average = average / children_tasks.length;
                parent_task.progress = total_average;
                if (Number(parent_task.progress) == 100) {
                    parent_task.status = "STATUS_DONE";
                } else {
                    parent_task.status = "STATUS_ACTIVE";
                }
            });
        }

        function calculateAverageOnNodes(tasks) {
            let rootAverage = [];
            let root = tasks.find(t => Number(t.level) === 0);
            let tasksWitOutRoot = tasks.filter(t => Number(t.level) !== 0);
            console.log(tasksWitOutRoot);
            tasksWitOutRoot.forEach(task => {
                if (isParent(task, tasks)) {
                    let average = getAVG(task, tasks);
                    task.progress = average;
                    rootAverage.push(average);
                } else {
                    rootAverage.push(task.progress);
                }
            });

            let rootTotal = rootAverage.reduce(function(acomulador, value) {
                return acomulador + value;
            }) / rootAverage.length;
            root.progress = rootTotal;
        }

        function getAVG(task, tasks) {
            let childs = getChildren(task, tasks);
            let average = 0;
            childs.forEach(child => {
                average += child.progress;
            });
            let total = average / childs.length;
            return total;
        }

        function calculateStatus(tasks) {
            var root = tasks.find(t => Number(t.level) === 0);
            let tasksWitOutRoot = tasks.filter(t => Number(t.level) !== 0);
            tasksWitOutRoot.forEach(task => {
                if (isParent(task, tasks)) {
                    calculateStatusOnChildrens(task, tasks);
                } else {
                    changeStatusByProgress(task);
                }
            });
            changeStatusByProgress(root);
        }


        function calculateStatusOnChildrens(node, tasks) {
            getChildren(node, tasks).forEach(task => {
                changeStatusByProgress(task);
            });

            changeStatusByProgress(node);
        }

        function changeStatusByProgress(task) {
            if (Number(task.progress) == 100 && !task.isFailed && !task.isSuspended) {
                task.status = "STATUS_DONE";
            } else if (Number(task.progress) >= 1 && Number(task.progress) <= 99 && !task.isFailed && !task.isSuspended) {
                task.status = "STATUS_ACTIVE";
            } else if (Number(task.progress) == 0 && !task.isFailed && !task.isSuspended) {
                task.status = "STATUS_UNDEFINED";
            } else if (task.isFailed) {
                task.status = "STATUS_FAILED";
            } else if (task.isSuspended) {
                task.status = "STATUS_SUSPENDED";
            }
        }

        function getRow(task, tasks) {
            let ret = -1; // default level 0
            ret = tasks.indexOf(task);
            return ret;
        }

        function getParents(task, tasks) {
            var ret;
            var topLevel = task.level;
            var pos = getRow(task, tasks);
            ret = [];
            for (var i = pos; i >= 0; i--) {
                var par = tasks[i];
                if (topLevel > par.level) {
                    topLevel = par.level;
                    ret.push(par);
                }
            }
            return ret;
        };

        function getParent(task, tasks) {
            var ret;
            for (var i = getRow(task, tasks); i >= 0; i--) {
                var par = tasks[i];
                if (task.level > par.level) {
                    ret = par;
                    break;
                }
            }
            return ret;
        }

        function isParent(task, tasks) {
            var ret = false;
            var pos = getRow(task, tasks);
            if (pos < tasks.length - 1)
                ret = tasks[pos + 1].level > task.level;
            return ret;
        };

        function getChildren(task, tasks) {
            var ret = [];
            var pos = getRow(task, tasks);
            for (var i = pos + 1; i < tasks.length; i++) {
                var ch = tasks[i];
                if (ch.level == task.level + 1)
                    ret.push(ch);
                else if (ch.level <= task.level) // exit loop if parent or brother
                    break;
            }
            return ret;
        };

        function renderResources(response, tarea_correspondiente, nombre = null) {
            let recursos = null;
            if (nombre == null || nombre == '') {
                recursos = response.resources;
            } else {
                recursos = response.resources.filter(r => r.name.toLowerCase().includes(nombre.toLowerCase()));
            }
            // console.log(recursos);
            let res = recursos.map(resource => {
                let foto = 'man.png';
                if (resource.foto == null) {
                    if (resource.genero == 'M') {
                        foto = 'woman.png';
                    } else {
                        foto = 'usuario_no_cargado.png';
                    }
                } else {
                    foto = resource.foto;
                }

                return `<li class="list-group-item ${tarea_correspondiente.assigs?.some(assig => Number(assig.resourceId) == Number(resource.id)) ? 'selected_resource_task':''}" resource-id="${resource.id}">
						<div class="row">
							<div class="col-11">
								<img class="rounded-circle" src="{{ asset('storage/empleados/imagenes') }}/${foto}" title="${resource.name}" />
								<span class="m-0 ml-2">${resource.name}</span>
							</div>
							<div class="text-center col-1">
								${tarea_correspondiente.assigs?.some(assig => Number(assig.resourceId) == Number(resource.id)) ? '<i class="fas fa-trash-alt resources-modal-remove text-danger" style="vertical-align:middle;margin-top:7px; font-size:15pt; cursor:pointer;"></i>':'<i class="fa fa-plus-circle resources-modal text-success" style="vertical-align:middle;margin-top:7px; font-size:15pt; cursor:pointer;"></i>'}
							</div>
						</div>
						</li>`;

            }).join('');
            return res;
        }

        function renderListEvent(response, tarea_correspondiente, id_row, funRenderCallback) {
            addResource(response, tarea_correspondiente, id_row, funRenderCallback);
            removeResource(response, tarea_correspondiente, id_row, funRenderCallback);
        }

        function addResource(response, tarea_correspondiente, id_row, funRenderCallback) {
            let resources_modal = document.querySelectorAll('.resources-modal');
            resources_modal.forEach(resource_modal => {
                resource_modal.addEventListener('click', function() {
                    let id = Number(this.parentElement.parentElement.parentElement.getAttribute(
                        'resource-id'));
                    let resource = response.resources.find(r => r.id == id);
                    let new_assig = {
                        "id": `tmp_162439120526${resource.id}_${resource.id}`,
                        "resourceId": resource.id,
                        "roleId": "tmp_1",
                        "effort": 0
                    };
                    let isResponsableTask = tarea_correspondiente.assigs?.find(a => Number(a.resourceId) ==
                        id);
                    if (isResponsableTask == undefined) {
                        if (tarea_correspondiente.assigs) {
                            tarea_correspondiente.assigs.push(new_assig);
                        } else {
                            tarea_correspondiente.assigs = [];
                            tarea_correspondiente.assigs.push(new_assig);
                        }
                        let id_tbody = this.closest('.modal').getAttribute('tbody-contenedor');
                        saveOnServer(response);
                        funRenderCallback(response, id_tbody);
                        $(`#${id_row}-modal`).modal('hide');
                    } else {
                        $(`#${id_row}-modal`).modal('hide');
                    }
                });
            });
        }

        function removeResource(response, tarea_correspondiente, id_row, funRenderCallback) {
            let resources_modal_remove = document.querySelectorAll('.resources-modal-remove');
            resources_modal_remove.forEach(resource_modal => {
                resource_modal.addEventListener('click', function() {
                    let id = Number(this.parentElement.parentElement.parentElement.getAttribute(
                        'resource-id'));
                    let resource = response.resources.find(r => r.id == id);
                    let idx_resource = tarea_correspondiente.assigs.findIndex(a => Number(a.resourceId) ==
                        id);
                    if (idx_resource != undefined || idx_resource != null) {
                        if (idx_resource > -1) {
                            tarea_correspondiente.assigs.splice(idx_resource, 1);
                        }
                        let id_tbody = this.closest('.modal').getAttribute('tbody-contenedor');
                        saveOnServer(response);
                        funRenderCallback(response, id_tbody);
                        $(`#${id_row}-modal`).modal('hide');
                    } else {
                        $(`#${id_row}-modal`).modal('hide');
                    }
                });
            });
        }
    </script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>



@endsection
