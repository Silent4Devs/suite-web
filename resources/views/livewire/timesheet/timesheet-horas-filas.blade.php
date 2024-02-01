<div>
    <form id="form_timesheet" action="{{ route('admin.timesheet.store') }}" method="POST">
        <div class="d-flex align-items-center justify-content-between card-mobile caja-calendar-semana" wire:ignore
            style="position: relative">
            <div class="form-group anima-focus">

                <input type="date" id="fecha_dia" name="fecha_dia" class="form-control" placeholder="">
                <label>
                    <i class="fa-regular fa-calendar"></i>
                    Semana laboral
                </label>
                <small class="fecha_dia errores text-danger" style="margin-left: 15px;"></small>
            </div>

            <div class="semanas-tras-time-text">
                <small>
                    <i class="fa-solid fa-circle mr-2" style="color: #D2FDB8;"></i>
                    Tiene permitido registrar
                    <strong>{{ auth()->user()->empleado->semanas_min_timesheet }} </strong>
                    semanas atras
                </small>
            </div>
        </div>
        <div class="card card-body not-card-mobile time-responsivo">
            <x-loading-indicator />
            @csrf

            <div class="datatable-fix scroll_estilos" style="margin-top: 0px;">
                <table id="datatable_timesheet_create"
                    class="table table-responsive dataTables_scrollBody tabla-llenar-horas">
                    <thead class="d-mobile-none">
                        <tr>
                            <th style="min-width:150px;"><span>Proyecto</span> </th>
                            <th style="min-width:150px;"><span>Tarea</span></th>
                            <th><span><i class="fa-solid fa-dollar-sign"></i></span></th>
                            <th style="min-width:40px;"><span>L</span></th>
                            <th style="min-width:40px;"><span>M</span></th>
                            <th style="min-width:40px;"><span>M</span></th>
                            <th style="min-width:40px;"><span>J</span></th>
                            <th style="min-width:40px;"><span>V</span></th>
                            <th style="min-width:40px;"><span>S</span></th>
                            <th style="min-width:40px;"><span>D</span></th>
                            <th style="min-width:150px;"><span>Descripción</span></th>
                            <th style=""><span><i class="fa-regular fa-trash-can"></i></span></th>
                            <th style="min-width:70px;"><span>Total</span></th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- {{ $contador }} --}}
                        @for ($i = 1; $i <= $contador; $i++)
                            <tr id="tr_time_{{ $i }}" wire:ignore
                                class="card-mobile tr-time-actividad-mobile" data-title="Actividad {{ $i }}">
                                <td wire:ignore>
                                    <div class="area-click-acordeon-time-mobile"
                                        style="position:absolute; top:0; width: 100%; height:50px; z-index: 1; margin-left: -14px;">
                                    </div>
                                    <font class="d-mobile" style="font-weight: bold;">Proyecto: </font>
                                    <select id="select_proyectos{{ $i }}" data-contador="{{ $i }}"
                                        data-type="parent" name="timesheet[{{ $i }}][proyecto]" class="select2">
                                        <option selected disabled>Seleccione proyecto</option>
                                        @foreach ($proyectos as $proyecto)
                                            <option value="{{ $proyecto['id'] }}">{{ $proyecto['identificador'] }} -
                                                {{ $proyecto['proyecto'] }}</option>
                                        @endforeach
                                    </select>
                                    <small class="timesheet_{{ $i }}_proyecto errores text-danger"></small>
                                </td>
                                <td>
                                    <font class="d-mobile mt-1" style="font-weight: bold;">Tarea: </font>
                                    <select id="select_tareas{{ $i }}" data-contador="{{ $i }}"
                                        name="timesheet[{{ $i }}][tarea]" class="select_tareas" class="select2"
                                        disabled>
                                        <option selected disabled>Seleccione tarea</option>
                                    </select>
                                    <small class="timesheet_{{ $i }}_tarea errores text-danger"></small>
                                </td>
                                <td class="td-facturable-time">
                                    <font class="d-mobile mt-1" style="font-weight: bold;">Facturable: </font>
                                    <input type="checkbox" checked name="timesheet[{{ $i }}][facturable]"
                                        style="min-width: 50px;">

                                    <font class="d-mobile mt-1"
                                        style="position: absolute; left:4px; bottom:0; margin-bottom:-35px; font-weight: bold;">
                                        Horas por actividad: </font>
                                </td>
                                <td class="td-date-time">
                                    <small class="d-mobile">Lunes </small>
                                    <input type="number" name="timesheet[{{ $i }}][lunes]" data-dia="lunes"
                                        data-i="{{ $i }}" id="ingresar_hora_lunes_{{ $i }}"
                                        class="ingresar_horas  form-control" min="0" max="24">
                                    <small class="timesheet_{{ $i }}_horas errores text-danger"
                                        style="position:absolute; margin-top:3px;"></small>
                                </td>
                                <td class="td-date-time">
                                    <small class="d-mobile">Martes </small>
                                    <input type="number" name="timesheet[{{ $i }}][martes]"
                                        data-dia="martes" data-i="{{ $i }}"
                                        id="ingresar_hora_martes_{{ $i }}"
                                        class="ingresar_horas  form-control" min="0" max="24">
                                </td>
                                <td class="td-date-time">
                                    <small class="d-mobile">Miercoles </small>
                                    <input type="number" name="timesheet[{{ $i }}][miercoles]"
                                        data-dia="miercoles" data-i="{{ $i }}"
                                        id="ingresar_hora_miercoles_{{ $i }}"
                                        class="ingresar_horas  form-control" min="0" max="24">
                                </td>
                                <td class="td-date-time">
                                    <small class="d-mobile">Jueves </small>
                                    <input type="number" name="timesheet[{{ $i }}][jueves]"
                                        data-dia="jueves" data-i="{{ $i }}"
                                        id="ingresar_hora_jueves_{{ $i }}"
                                        class="ingresar_horas  form-control" min="0" max="24">
                                </td>
                                <td class="td-date-time">
                                    <small class="d-mobile">Viernes </small>
                                    <input type="number" name="timesheet[{{ $i }}][viernes]"
                                        data-dia="viernes" data-i="{{ $i }}"
                                        id="ingresar_hora_viernes_{{ $i }}"
                                        class="ingresar_horas  form-control" min="0" max="24">
                                </td>
                                <td class="td-date-time">
                                    <small class="d-mobile">Sabado </small>
                                    <input type="number" name="timesheet[{{ $i }}][sabado]"
                                        data-dia="sabado" data-i="{{ $i }}"
                                        id="ingresar_hora_sabado_{{ $i }}"
                                        class="ingresar_horas  form-control" min="0" max="24">
                                </td>
                                <td class="td-date-time">
                                    <small class="d-mobile">Domingo </small>
                                    <input type="number" name="timesheet[{{ $i }}][domingo]"
                                        data-dia="domingo" data-i="{{ $i }}"
                                        id="ingresar_hora_domingo_{{ $i }}"
                                        class="ingresar_horas  form-control" min="0" max="24">
                                </td>
                                <td>
                                    <font class="d-mobile mt-1" style="font-weight: bold;">Descripción: </font>
                                    <textarea name="timesheet[{{ $i }}][descripcion]" class="form-control"
                                        style="min-height:40px !important;"></textarea>
                                </td>
                                <td class="td_opciones">
                                    @if ($i == 1)
                                        {{--  <div class="btn btn_clear_tr" data-tr="tr_time_{{ $i }}" style="color:red; font-size:20px;" title="Eliminar fila"><i class="fa-solid fa-trash-can"></i> <small class="text-eliminar-actividad-mobile" style="margin-left: 10px;">Eliminar actividad</small></div> --}}
                                    @endif
                                    @if ($i > 1)
                                        <div class="btn btn_destroy_tr" data-tr="tr_time_{{ $i }}" wire:click="removerFila"
                                            style="color:#006DDB; font-size:20px;" title="Eliminar fila">
                                            <i class="fa-regular fa-trash-can"></i> <small
                                                class="text-eliminar-actividad-mobile"
                                                style="margin-left: 10px;">Eliminar
                                                actividad</small>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="form-control caja-suma-horas-filas-time d-mobile-none">
                                        <font class="d-mobile-initial" style="font-weight:bold;">Horas Totales:
                                        </font>
                                        <label id="suma_horas_fila_{{ $i }}" class="total_filas"></label>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                        <tr wire:ignore.self class="tr-sumas-facturables-horas">
                            <td colspan="3">Toral horas facturables</td>
                            <td><label id="suma_dia_lunes"></label></td>
                            <td><label id="suma_dia_martes"></label></td>
                            <td><label id="suma_dia_miercoles"></label></td>
                            <td><label id="suma_dia_jueves"></label></td>
                            <td><label id="suma_dia_viernes"></label></td>
                            <td><label id="suma_dia_sabado"></label></td>
                            <td><label id="suma_dia_domingo"></label></td>
                            <td><label id="total_h_facts"></label></td>
                            <td></td>
                            <td><label id="total_horas_filas"></label></td>
                        </tr>
                        <tr wire:ignore.self class="tr-sumas-facturables-horas">
                            <td colspan="3">Toral horas no facturables</td>
                            <td><label id="suma_dia_lunes_no_fact"></label></td>
                            <td><label id="suma_dia_martes_no_fact"></label></td>
                            <td><label id="suma_dia_miercoles_no_fact"></label></td>
                            <td><label id="suma_dia_jueves_no_fact"></label></td>
                            <td><label id="suma_dia_viernes_no_fact"></label></td>
                            <td><label id="suma_dia_sabado_no_fact"></label></td>
                            <td><label id="suma_dia_domingo_no_fact"></label></td>
                            <td><label id="total_h_no_facts"></label></td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>

            </div>



            <div class="mt-4 caja-botones-time-acciones" style="display:flex; justify-content:space-between;">
                <button class="btn btn-secundario-mas btn-time-mas-fila"
                    wire:click.prevent="$set('contador', {{ $contador + 1 }})">
                    <font class="d-mobile-none">
                        <div class="d-flex align-items-center">
                            Agregar fila
                            <i class="material-symbols-outlined ml-1">add_circle</i>
                        </div>
                    </font>
                    <font class="d-mobile"><i class="fa-solid fa-plus mr-2"></i> Agregar actividad</font>
                </button>
                <div class="caja-botones-time-forms">
                    <button class="btn btn_cancelar btn_enviar_formulario btn-borrador-time"
                        style="position:relative;">
                        <input id="estatus_papelera" type="radio" name="estatus" value="papelera"
                            style="opacity:0; position: absolute;">
                        <label data-type="borrador" for="estatus_papelera"
                            style="width:100%; height: 100%; position:absolute; display:flex; justify-content: center; align-items: center; top:0; left:0;">
                            Guardar borrador
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </button>

                    <div class="btn btn-success btn-regisrtar-time" style="position: relative;" data-toggle="modal"
                        data-target="#modal_aprobar_">
                        <input id="estatus_pendiente" type="radio" name="estatus" value="pendiente"
                            style="opacity:0; position: absolute;">
                        <label for="estatus_pendiente"
                            style="width:100%; height: 100%; position:absolute; display:flex; justify-content: center; align-items: center; top:0; left:0;">
                            Registrar
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_aprobar_" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="delete">
                                <div class="text-center">
                                    <i class="fa-solid fa-calendar-plus" style="color: #2F96EB; font-size:60pt;"></i>
                                    <h1 class="my-4" style="font-size:14pt;">Registrar Jornada Laboral</h1>
                                    <p class="parrafo">¿Está seguro que desea enviar a aprobación este registro?
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <div class="col-12 text-center">
                                        <div title="Rechazar" class="btn btn_cancelar" data-dismiss="modal">
                                            Cancelar
                                        </div>
                                        <button data-dismiss="modal" onclick="event.preventDefault();"
                                            id="enviar_aprobacion_time" class="btn_enviar_formulario btn btn-info"
                                            style="border:none; background-color:#2F96EB;">
                                            Enviar a Aprobación
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            window.initSelect2 = () => {

                $('.select2').select2({
                    'theme': 'bootstrap4'
                });

            }

            initSelect2();

            Livewire.on('select2', () => {

                initSelect2();

            });

            $('#select_proyectos1').on('select2:select', function(e) {
                var data = e.params.data;
            });

            $('#datatable_timesheet_create').on('change', (e) => {
                if (e.target.getAttribute('data-type') == 'parent') {
                    let contador = e.target.getAttribute('data-contador');
                    let proyecto_id = e.target.value;
                    document.getElementById('loaderComponent').style.display = 'block';
                    $.ajax({
                        type: "post",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('admin.timesheet-obtener-tareas') }}",
                        data: {
                            proyecto_id
                        },
                        dataType: "json",
                        beforeSend: function() {

                        },
                        success: function(response) {
                            let select = document.getElementById(`select_tareas${contador}`);
                            select.removeAttribute('disabled');
                            let html = '<option selected disabled>Seleccione tarea</option>';
                            response.tareas.forEach(tarea => {
                                html += `
                                        <option value="${tarea.id }">${tarea.tarea}</option>
                                    `;
                            });
                            select.innerHTML = html;
                            document.getElementById('loaderComponent').style.display = 'none';
                        },
                        error: function(error) {
                            document.getElementById('loaderComponent').style.display = 'none';
                        }
                    });
                }
            });

            function procesarInformacionTimesheet(e) {
                e.preventDefault();
                limpiarErrores();
                let formulario = document.getElementById('form_timesheet');
                let formData = new FormData(formulario);
                if (e.target.getAttribute('data-type') == 'borrador') {
                    formData.append('estatus', 'papelera');
                }
                document.getElementById('loaderComponent').style.display = 'block';
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.timesheet.store') }}",
                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        document.getElementById('loaderComponent').style.display = 'none';
                        console.log(response.status);
                        if (response.status == 200) {
                            Swal.fire(
                                'Buen trabajo',
                                'Timesheet Registrado',
                                'success'
                            ).then(() => {
                                window.location.href = '{{ route('admin.timesheet-inicio') }}';
                            });
                        } else {
                            if (response.status == 520) {
                                Swal.fire(
                                    'Ha habido un error al enviar la notificacion al lider',
                                    'Timesheet Registrado',
                                    'success'
                                ).then(() => {
                                    window.location.href =
                                        '{{ route('admin.timesheet-inicio') }}';
                                });
                            } else {
                                toastr.error('!Error al enviar valide  que la semana  laboral no este vacia y/o que al menos una fila este llena!');
                            }
                        }
                    },
                    error: function(request, status, error) {
                        document.getElementById('loaderComponent').style.display = 'none';
                        $('#modal_aprobar_').modal('hide');
                        $('.modal-backdrop').hide();
                        $.each(request.responseJSON.errors, function(indexInArray, valueOfElement) {

                            let index_error = indexInArray.replaceAll('.', '_');
                            $(`small.${index_error}`).html(
                                '<i class="fas fa-exclamation-circle mr-2"></i> ' +
                                valueOfElement[0]);
                        });
                    }
                });
            }
            document.querySelector('.btn_enviar_formulario').addEventListener('click',
                procesarInformacionTimesheet);
            document.querySelector('#enviar_aprobacion_time').addEventListener('click',
                procesarInformacionTimesheet);

            function limpiarErrores() {
                document.querySelectorAll('.errores').forEach(item => {
                    item.innerHTML = '';
                });
            }
        });
    </script>
</div>
