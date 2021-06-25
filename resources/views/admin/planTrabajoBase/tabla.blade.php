<style type="text/css">

	.caja_tabla{
    	overflow: scroll;
    }

    .vista_tabla_gantt{
    	border-collapse: collapse;
    }

	
	.STATUS_ACTIVE, .STATUS_ACTIVE:hover{
        background-color: #ecde00 !important;
       	fill: #ecde00 !important;
    }
    .STATUS_DONE, .STATUS_DONE:hover{
        background-color: #17d300 !important;
       	fill: #17d300 !important;
    }
    .STATUS_FAILED, .STATUS_FAILED:hover{
        background-color: #e10000 !important;
       	fill: #e10000 !important;
    }
    .STATUS_SUSPENDED, .STATUS_SUSPENDED:hover{
        background-color: #e7e7e7 !important;
       	fill: #e7e7e7 !important;
        color: #222222 !important;
    }
    .STATUS_UNDEFINED, .STATUS_UNDEFINED:hover{
        background-color: #00b1e1 !important;
       	fill: #00b1e1 !important;
    }






    
    .tabla_gantt_fase:nth-child(1n+1) th{
    	color: #000ff1;
    }
    .tabla_gantt_fase:nth-child(2n+1) th{
    	color: #f10075;
    }
    .tabla_gantt_fase:nth-child(3n+1) th{
    	color: #02d68f;
    }


	.tabla_gantt_fase:nth-child(1n+1) tbody tr:before{
		background-color: #000ff1;
	}
	.tabla_gantt_fase:nth-child(2n+1) tbody tr:before{
		background-color: #f10075;
	}
	.tabla_gantt_fase:nth-child(3n+1) tbody tr:before{
		background-color: #02d68f;
	}






    

    .tabla_gantt_fase{
    	width: 100%;
    	margin-top: 20px;
    }
    .tabla_gantt_fase th{
    	background-color: rgba(0, 0, 0, 0);
    	border-bottom: 1px solid #e3e3e3;
    	padding: 10px;
		cursor: pointer;
    }

	.th_activo{
		background-color: #f0eff5 !important;
	}

    .tabla_gantt_fase tr{
    	position: relative;
    }
    .tabla_gantt_fase tr:before{
    	content: "";
    	position: absolute;
    	width: 7px;
    	height: 90%;
    	top: 5%;
    	left: 0;
    }
    .tabla_gantt_fase td{
    	padding: 10px;
    	border: 2px solid #fff;
    	background-color: #eeeeee;
    	position: relative;
    }
    .tabla_gantt_fase tbody i{
    	color: #888;
    }
    .estatus_td{
		color: #fff;
		position: relative;
	}
    .tr_secundario, .td_secundario, .estatus_td{
    	text-align: center;
    }
    .tabla_gantt_fase img{
    	position: absolute;
    	left: 0;
    	top: 0;
    	bottom: 0;
    	right: 0;
    	margin: auto;
		background-color: white;
    }
	.tabla_gantt_fase img:nth-child(2){
		margin-left: 50%;
		transform: scale(0.8);
	}
    .tabla_gantt_fase .btn_empleados{
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
    .lista_empleados{
    	text-align: left;
    	list-style: none;
    	padding: 0;
    }
    .lista_empleados li{
    	text-align: left !important;
    	margin-top: 7px;
    }

    .tabla_gantt_fase input{
    	border: none;
    	background-color: rgba(255, 255, 255, 0);
    }
    .tabla_gantt_fase input:focus, .tabla_gantt_fase input:focus-visible{
    	background-color: rgba(255,255,255,1);
    	outline: none;
    	font-weight: bold;
    }

    .estatus_select{
    	/* position: absolute; */
    	top: 0;
    	left: 0;
    	width: 100%;
    	height: 100%;
    	background-color: rgba(0, 0, 0, 0) !important;
    	outline: none !important;
    	border: none !important;
    	color: #fff;
		text-align-last: center;
		-ms-text-align-last: center;
		-moz-text-align-last: center;
    }

	.estatus_select span{
		width: 100%;
		text-align: center;		
	}

	.selected_resource_task{
		background-color: #b3f0f3;
	}

	.td_resources{
		cursor: pointer;
		transition: 0.5s;
	}

	.td_resources:hover{
		background-color: #969696;
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
		$(document).ready(function(){
			initTable();
		});

		function initTable() {
			let url = '{{ asset('storage/gantt/')}}/{{$name_file_gantt}}';
			$.ajax({
				type: "get",
				url: url,
				success: function (response) {			
					renderTable(response);
				}
		    });
		}
			

		function saveOnServer(response){
			$.ajax({
			    type: "post",
			    url: "{{ route('admin.planTrabajoBase.saveCurrentProyect') }}",
			    data: { 
			    	_token:"{{ csrf_token() }}",
			    	gantt:JSON.stringify(response),
			    },
			    dataType: "JSON",
			    success: function (response) {
			        console.log(response);
			    }
			});
		}


		function renderTable(response, id_tbody = null){
			let resources = response.resources;
					

			let html = '';
			let contador = 0;
			let contador_registros = 1;
			response.tasks.forEach((task, idx) => {
				let estatus = '';
				switch(task.status){
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
				
				
				if (Number(task.level) == 0){
					contador ++;
					html += `
					</table>
					<table class="tabla_gantt_fase">
						<thead class="${id_tbody != null ? id_tbody == contador + '_contenedor' ? 'th_activo' : '' : contador == 1 ? 'th_activo' : ''}">
							<tr>
								<th> <span><i class="fas ${id_tbody != null ? id_tbody == contador + '_contenedor' ? 'fa-minus-circle' : 'fa-plus-circle' : contador == 1 ? 'fa-minus-circle' : 'fa-plus-circle'}"></i></span> ${task.name}</th>
								<th class="tr_secundario ${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}">Responsable</th>
								<th class="tr_secundario ${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}">Estatus</th>
								<th class="tr_secundario ${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}">Fecha Inicio</th>
								<th class="tr_secundario ${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}">Fecha Fin</th>
							</tr>
						</thead>
						</tbody>
						<tbody id="${contador}_contenedor" class="${id_tbody != null ? id_tbody == contador + '_contenedor' ? '' : 'd-none' : contador == 1 ? '' : 'd-none'}">
					`;
					
				}else{
					html += `
					
						<tr id="${task.id}" numero-registro="${contador_registros}">
							<td style="padding-left: ${task.level * 15}px;">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-up" viewBox="0 0 16 16">
								  	<path fill-rule="evenodd" d="M4.854 1.146a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L4 2.707V12.5A2.5 2.5 0 0 0 6.5 15h8a.5.5 0 0 0 0-1h-8A1.5 1.5 0 0 1 5 12.5V2.707l3.146 3.147a.5.5 0 1 0 .708-.708l-4-4z"/>
								</svg>
								<input class="name_input" value="${task.name}" style="width: calc(100% - ${task.level * 15}px - 16px + ${task.level * 10}px);">
							</td>`;
								
								let assigs = task.assigs.map(asignado => {
									return(resources.find(r => r.id === Number(asignado.resourceId)));
								});

								let imagenes = '';
								if (assigs.length > 0) {
									if (assigs.length < 3) {
										for (var i = 0; i < assigs.length; i++) {
											let foto = 'man.png';
											if(assigs[i].foto == null){ 
												if (assigs[i].genero == 'M') {
													foto = 'woman.png'; 
												}else{
													foto = 'usuario_no_cargado.png'; 
												}
											}else{
												foto = assigs[i].foto;
											}
											imagenes += `<img class="rounded-circle" src="{{ asset('storage/empleados/imagenes') }}/${foto}"></img>`;
										}		
									}else{

										let foto = 'man.png';
										if(assigs[0].foto == null){ 
											if (assigs[0].genero == 'M') {
												foto = 'woman.png'; 
											}else{
												foto = 'usuario_no_cargado.png'; 
											}
										}else{
											foto = assigs[0].foto;
										}

										imagenes += `<img class="rounded-circle" src="{{ asset('storage/empleados/imagenes') }}/${foto}"></img><span class="btn_empleados" onmouseover="renderCard(this, '${encodeURIComponent(JSON.stringify(assigs))}')">+${assigs.length - 1}</span>`;
									}
								}

								
							html += `
							<td class="td_secundario td_resources" width="15%">${imagenes}</td>

							<td class="${task.status} estatus_td" width="15%">
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
							<td class="td_secundario td_fecha_inicio" width="15%">
								<input class="input_fecha_inicio" type="date" value="${moment.unix((task.start)/1000).format("YYYY-MM-DD")}" ${task.depends != "" ? 'disabled': ''} />
							</td>
							<td class="td_secundario td_fecha_fin" width="15%">
								<input class="input_fecha_fin" type="date" value="${moment.unix((task.end)/1000).format("YYYY-MM-DD")}" />
							</td>
							<td class="td_secundario" width="15%">${task.depends != "" ? response.tasks[task.depends].name:''}</td>
						</tr>
					`;
				}
				contador_registros++;
			});

			let c_tabla = document.querySelector('#cuerpo_tabla');
			c_tabla.innerHTML = html;

			let name_input = document.querySelectorAll('.name_input');
			name_input.forEach(i_nombre =>{
				i_nombre.addEventListener('change', function(){
					let id_row = Number(this.parentElement.parentElement.getAttribute('id'));
					let valor_nuevo = this.value;
					let tarea_correspondiente = response.tasks.find(t => t.id == id_row);
					tarea_correspondiente.name = valor_nuevo;
					saveOnServer(response);
				});
			});

			// Se añade evento change a select para estatus
			let estatus_select = document.querySelectorAll('.estatus_select');
			estatus_select.forEach(s_status => {
				s_status.addEventListener('change', function(){
					let id_row = Number(this.parentElement.parentElement.getAttribute('id'));
					let valor_nuevo = this.value;
					let tarea_correspondiente = response.tasks.find(t => t.id == id_row);
					tarea_correspondiente.status = valor_nuevo;
					
					let id_tbody = s_status.closest('tbody').getAttribute('id');
					saveOnServer(response);
					renderTable(response,id_tbody);
					
				});
			});

			//Evento Fecha Inicio
			let fecha_inicio_inputs = document.querySelectorAll('.input_fecha_inicio');
			fecha_inicio_inputs.forEach(fecha_inicio_input => {
				fecha_inicio_input.addEventListener('change',function(){
					let id_row = Number(this.closest('tr').getAttribute('id'));
					let valor_nuevo = moment(this.value).valueOf();
					let tarea_correspondiente = response.tasks.find(t => t.id == id_row);
					if (tarea_correspondiente.depends != "") {
						let padre = document.querySelector(`tr[numero-registro="${tarea_correspondiente.depends}"]`);
						let id_padre = Number(padre.getAttribute('id'));
						let tarea_correspondiente_padre = response.tasks.find(t => t.id == id_padre);
						let fecha_inicio_padre = moment.unix((tarea_correspondiente_padre.start)/1000).format("YYYY-MM-DD")
						if (moment(this.value) != 0) {
							alert('No se puede cambiar la fecha ya que esta tarea depende de otra');
							this.value = moment.unix((tarea_correspondiente_padre.start)/1000).format("YYYY-MM-DD");
						}
					}else{
						tarea_correspondiente.start = valor_nuevo;
						saveOnServer(response);
					}
				});
			});

			//Evento Fecha Inicio
			let fecha_fin_inputs = document.querySelectorAll('.input_fecha_fin');
			fecha_fin_inputs.forEach(fecha_fin_input => {
				fecha_fin_input.addEventListener('change',function(){
					let id_row = Number(this.closest('tr').getAttribute('id'));
					let valor_nuevo = moment(this.value).valueOf();
					let tarea_correspondiente = response.tasks.find(t => t.id == id_row);
					tarea_correspondiente.end = valor_nuevo;
					console.log(valor_nuevo);
					saveOnServer(response);
				});
			});


			//Evento click para td resources
			let td_resources = document.querySelectorAll('.td_resources');
			td_resources.forEach(element => {
				element.addEventListener('click',function(){
					let id_row = Number(this.parentElement.getAttribute('id'));
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
									<div class="input-group mb-3">
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
					document.querySelector('.search_resources').addEventListener('keyup',function(){
						let contenedor_lista = document.querySelector('.contenedor_lista');
						contenedor_lista.innerHTML = "";
						contenedor_lista.innerHTML = renderResources(response,tarea_correspondiente,this.value);
						renderListEvent(response, tarea_correspondiente, id_row, renderTable);
					});
					$(`#${id_row}-modal`).modal('show');
					renderListEvent(response, tarea_correspondiente, id_row, renderTable);
				});
			});

			window.renderCard = function(e, assigs) {
				let obj = JSON.parse(decodeURIComponent(assigs));
	
				const instance = tippy(document.querySelector('.btn_empleados:hover'));
				instance.setProps({ arrow: true, animation: 'scale', allowHTML: true,});
				instance.show();

				let info_card = `
					<ul class="lista_empleados">`
						obj.forEach(asigando => {
							let foto = 'man.png';
							if(asigando.foto == null){ 
								if (asigando.genero == 'M') {
									foto = 'woman.png'; 
								}else{
									foto = 'usuario_no_cargado.png'; 
								}
							}else{
								foto = asigando.foto;
							}
							info_card +=
								`<li><img class="rounded-circle" src="{{ asset('storage/empleados/imagenes') }}/${foto}" style="height: 20px !important; background-color: #fff;"></img> ${asigando.name}</li>`;
						})
						
					info_card += '</ul>';
				
				instance.setContent(info_card);
				$(".btn_empleados").mouseleave(function(){
					instance.destroy();
				});

			}

			$(".tabla_gantt_fase th").click(function(e){
				$(".tabla_gantt_fase tbody:not(.tabla_gantt_fase:hover tbody)").addClass('d-none');
				$(".tabla_gantt_fase:hover tbody").toggleClass('d-none');

				$(".tabla_gantt_fase .tr_secundario:not(.tabla_gantt_fase:hover .tr_secundario)").addClass('d-none');
				$(".tabla_gantt_fase:hover .tr_secundario").toggleClass('d-none');

				if ($(".tabla_gantt_fase:hover tbody").hasClass('d-none')) {
					$(".tabla_gantt_fase:hover span i").addClass('fa-plus-circle').removeClass('fa-minus-circle');	
				}else{
					$(".tabla_gantt_fase:hover span i").addClass('fa-minus-circle').removeClass('fa-plus-circle');
				}

				if ($(".tabla_gantt_fase tbody:not(.tabla_gantt_fase:hover tbody)").hasClass('d-none')) {
					$(".tabla_gantt_fase span i:not(.tabla_gantt_fase:hover span i)").addClass('fa-plus-circle').removeClass('fa-minus-circle');	
				}

			});

			$(".tabla_gantt_fase thead").click(function(e){
				$(".tabla_gantt_fase thead:not(.tabla_gantt_fase:hover thead)").removeClass('th_activo');

				$(".tabla_gantt_fase:hover thead").toggleClass('th_activo');	
			});

		}
		function renderResources(response,tarea_correspondiente, nombre = null){
			console.log(nombre);
			let recursos = null;
			if (nombre == null || nombre == '') {
				recursos = response.resources;
			}else{
				recursos = response.resources.filter(r => r.name.toLowerCase().includes(nombre.toLowerCase()));
			}
			let res = recursos.map(resource => {
				let foto = 'man.png';
				if(resource.foto == null){ 
					if (resource.genero == 'M') {
						foto = 'woman.png'; 
					}else{
						foto = 'usuario_no_cargado.png'; 
					}
				}else{
					foto = resource.foto;
				}

				return `<li class="list-group-item ${tarea_correspondiente.assigs.some(assig => Number(assig.resourceId) == Number(resource.id)) ? 'selected_resource_task':''}" resource-id="${resource.id}">
						<div class="row">
							<div class="col-11">
								<img class="rounded-circle" src="{{ asset('storage/empleados/imagenes') }}/${foto}" title="${resource.name}" />
								<span class="m-0 ml-2">${resource.name}</span>
							</div>
							<div class="col-1 text-center">
								${tarea_correspondiente.assigs.some(assig => Number(assig.resourceId) == Number(resource.id)) ? '<i class="fas fa-trash-alt resources-modal-remove text-danger" style="vertical-align:middle;margin-top:7px; font-size:15pt; cursor:pointer;"></i>':'<i class="fa fa-plus-circle resources-modal text-success" style="vertical-align:middle;margin-top:7px; font-size:15pt; cursor:pointer;"></i>'}
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

		function addResource(response,tarea_correspondiente, id_row, funRenderCallback) {
			let resources_modal = document.querySelectorAll('.resources-modal');
			resources_modal.forEach(resource_modal =>{
				resource_modal.addEventListener('click',function(){
					let id = Number(this.parentElement.parentElement.parentElement.getAttribute('resource-id'));
					let resource = response.resources.find(r => r.id == id);
					let new_assig = {
						"id": `tmp_162439120526${resource.id}_${resource.id}`,
						"resourceId": resource.id,
						"roleId": "tmp_1",
						"effort": 0
					};
					let isResponsableTask = tarea_correspondiente.assigs.find(a => Number(a.resourceId) == id);
					if (isResponsableTask == undefined) {
						tarea_correspondiente.assigs.push(new_assig);

						let id_tbody = this.closest('.modal').getAttribute('tbody-contenedor');
						saveOnServer(response);						
						funRenderCallback(response,id_tbody);
						$(`#${id_row}-modal`).modal('hide');
					}else{
						$(`#${id_row}-modal`).modal('hide');
					}
				});
			});
		}

		function removeResource(response,tarea_correspondiente, id_row, funRenderCallback) {
			let resources_modal_remove = document.querySelectorAll('.resources-modal-remove');
			resources_modal_remove.forEach(resource_modal =>{
				resource_modal.addEventListener('click',function(){
					let id = Number(this.parentElement.parentElement.parentElement.getAttribute('resource-id'));
					let resource = response.resources.find(r => r.id == id);
					let idx_resource = tarea_correspondiente.assigs.findIndex(a => Number(a.resourceId) == id);
					if (idx_resource != undefined || idx_resource != null) {
						if (idx_resource > -1) {
							tarea_correspondiente.assigs.splice(idx_resource, 1);
						}
						let id_tbody = this.closest('.modal').getAttribute('tbody-contenedor');
						saveOnServer(response);						
						funRenderCallback(response,id_tbody);
						$(`#${id_row}-modal`).modal('hide');
					}else{
						$(`#${id_row}-modal`).modal('hide');
					}
				});
			});
		}
	</script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://unpkg.com/tippy.js@6"></script>



@endsection