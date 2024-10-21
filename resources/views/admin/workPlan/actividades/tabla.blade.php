{{-- <style>
    .table tr th:nth-child(8) {
        min-width: 800px !important;
        text-align: justify !important;
    }
</style> --}}




<div class="card card-body">
    <div class="card-header">
        <h5>Acuerdos y Compromisos</h5>
    </div>

    <div class="">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="form-group anima-focus">
                    <input type="text" class="form-control" id="actividad" name="actividad" placeholder="">
                    <label for="actividad"> Actividad <span class="text-danger">*</span></label>
                    {{-- <div class="pr-0 col-1">
                        <button id="btnVincularNombre" class="btn btn-outline-primary btn-sm"
                            title="Vincular con nombre"></button>
                    </div> --}}
                </div>
                {{-- <small id="actividadHelp" class="form-text text-muted">Nombre de la actividad</small> --}}
                <small class="p-0 m-0 text-xs error_actividad errores text-danger"></small>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-6 col-6">
                <div class="form-group anima-focus">
                    <input type="date" min="1945-01-01" class="form-control" id="inicio" name="inicio">
                    <label for="inicio"> Inicio <span class="text-danger">*</span></label>
                    {{-- <small id="inicioHelp" class="form-text text-muted">Fecha de inicio de la actividad</small> --}}
                    <small class="p-0 m-0 text-xs error_inicio errores text-danger"></small>

                </div>
            </div>
            <div class="col-sm-12 col-lg-6 col-6">
                <div class="form-group anima-focus">
                    <input type="date" min="1945-01-01" class="form-control" id="finalizacion" name="finalizacion">
                    <label for="finalizacion"> Finalización <span class="text-danger">*</span></label>
                    {{-- <small id="finalizacionHelp" class="form-text text-muted">Fecha de finalización de la
                            actividad</small> --}}
                    <small class="p-0 m-0 text-xs error_finalizacion errores text-danger"></small>
                </div>
            </div>
        </div>
        {{-- <div class="col-sm-12 col-lg-4 col-4">
            <div class="form-group anima-focus">
                <label for="progreso"> Progreso <span
                        class="text-danger">*</span></label>
                <input type="number" class="form-control" id="progreso" name="progreso" min="0" max="100">
                <small id="progresoHelp" class="form-text text-muted">Progreso de la actividad, rango de 0 -
                    100</small>
                <small class="p-0 m-0 text-xs error_progreso errores text-danger"></small>
            </div>
        </div> --}}
        <div class="mb-3 row">
            <div class="form-group anima-focus col-sm-12 col-lg-12 col-md-12">
                <select class="responsables_actividad form-control" id="responsables_actividad" multiple placeholder="">
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}" avatar="{{ $empleado->avatar }}">
                            {{ $empleado->name }}</option>
                    @endforeach
                </select>
                <label for="responsables_actividad"> Responsables <span class="text-danger">*</span></label>
                {{-- <i
                    class="fas fa-info-circle" style="font-size:12pt; float: right;"
                    title="Responsables de la actividad"></i> --}}
                {{-- <small id="responsables_actividadHelp" class="form-text text-muted">Responsables de la actividad</small> --}}
                <small class="p-0 m-0 text-xs error_participantes errores text-danger"></small>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="form-group anima-focus">
                    <textarea class="form-control w-100" id="comentarios" name="comentarios" placeholder=""></textarea>
                    <label for="comentarios"> Comentarios <span class="text-danger">*</span></label>
                    {{-- <small id="comentariosHelp" class="form-text text-muted">Comentarios de la actividad</small> --}}
                    <small class="p-0 m-0 text-xs error_comentarios errores text-danger"></small>
                </div>
            </div>
        </div>
        <input type="hidden" id="actividades" name="actividades">
        <div class="col-12">
            <button id="btnAgregar" class="mt-3 mb-2 btn btn-sm btn-link" style="float:left;">Agregar
                Actividad +
            </button>
        </div>
        @if ($errors->has('actividades'))
            <span class="text-danger">
                {{ $errors->first('actividades') }}
            </span>
        @endif
        <div class="mt-5 datatable-rds w-100">
            <table id="tblActividades" class=" w-100">
                <thead>
                    <tr>
                        {{-- <th scope="col">ID</th> --}}
                        {{-- <th scope="col">Estatus</th> --}}
                        <th scope="col">Actividad</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Finalización</th>
                        {{-- <th scope="col">Duración</th> --}}
                        <th scope="col">Responsable(s)</th>
                        {{-- <th scope="col">Responsable(s)_id</th> --}}
                        <th scope="col">Comentarios</th>
                        {{-- <th scope="col">Opciones</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @if (isset($actividades))
                        @foreach ($actividades as $actividad)
                            {{-- @php
                                $estatus = 'Completado';
                                $color = 'rgb(0,200,117)';
                                $textColor = 'white';
                                switch ($actividad->status) {
                                    case 'STATUS_ACTIVE':
                                        $estatus = 'En Progreso';
                                        $color = 'rgb(253, 171, 61)';
                                        break;
                                    case 'STATUS_DONE':
                                        $color = 'rgb(0, 200, 117)';
                                        $estatus = 'Completado';
                                        break;
                                    case 'STATUS_FAILED':
                                        $estatus = 'Con Retraso';
                                        $color = 'rgb(226, 68, 92)';
                                        break;
                                    case 'STATUS_SUSPENDED':
                                        $estatus = 'Suspendido';
                                        $color = '#aaaaaa';
                                        break;
                                    case 'STATUS_WAITING':
                                        $estatus = 'En Espera';
                                        $color = '#F79136';

                                        break;
                                    case 'STATUS_UNDEFINED':
                                        $estatus = 'Indefinido';
                                        $color = '#00b1e1';
                                        break;
                                    default:
                                        $estatus = 'Indefinido';
                                        break;
                                }
                            @endphp --}}
                            <tr>
                                <td>{{ $actividad->name }}</td>
                                <td>{{ \Carbon\Carbon::parse(\Carbon\Carbon::createFromTimestamp(intval($actividad->start) / 1000)->toDateTimeString())->format('Y-m-d') }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse(\Carbon\Carbon::createFromTimestamp(intval($actividad->end) / 1000)->toDateTimeString())->format('Y-m-d') }}
                                </td>
                                <td>
                                    @foreach ($actividad->assigs as $assig)
                                        @php
                                            $empleado = App\Models\Empleado::getAll()->find(intval($assig->resourceId));
                                        @endphp
                                        <img src="{{ $empleado->avatar }}" id="res_{{ $empleado->id }}"
                                            alt="{{ $empleado->name }}" title="{{ $empleado->name }}"
                                            style="clip-path: circle(15px at 50% 50%);width: 45px;" />
                                    @endforeach
                                </td>
                                <td>{{ $actividad->description }}</td>
                            </tr>
                            {{-- <tr>
                                <td>{{ $actividad->id }}</td>
                                <td style="background: {{ $color }}; color:{{ $textColor }}">
                                    {{ $estatus }}
                                </td>
                                <td>{{ $actividad->name }}</td>
                                <td>{{ \Carbon\Carbon::parse(\Carbon\Carbon::createFromTimestamp(intval($actividad->start) / 1000)->toDateTimeString())->format('Y-m-d') }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse(\Carbon\Carbon::createFromTimestamp(intval($actividad->end) / 1000)->toDateTimeString())->format('Y-m-d') }}
                                </td>
                                <td>{{ $actividad->duration }}</td>
                                <td>
                                    @foreach ($actividad->assigs as $assig)
                                        @php
                                            $empleado = App\Models\Empleado::getAll()->find(intval($assig->resourceId));
                                        @endphp
                                        <img src="{{ $empleado->avatar_ruta }}" id="res_{{ $empleado->id }}"
                                            alt="{{ $empleado->name }}" title="{{ $empleado->name }}"
                                            style="clip-path: circle(15px at 50% 50%);width: 45px;" />
                                    @endforeach
                                </td>
                                <td>
                                    @php
                                        $asignados = [];
                                        foreach ($actividad->assigs as $assig) {
                                            $empleado = App\Models\Empleado::getAll()->find(intval($assig->resourceId));
                                            array_push($asignados, $empleado->id);
                                        }
                                    @endphp
                                    {{ str_replace('"', '', str_replace('[', '', str_replace(']', '', json_encode($asignados)))) }}
                                </td>
                                <td>{{ $actividad->description }}</td>
                                <td>
                                    <button class="btn btn-sm text-danger" title="Eliminar actividad"
                                        onclick="event.preventDefault(); EliminarFila(this)"><i
                                            class="fa fa-trash-alt"></i></button>
                                </td>
                            </tr> --}}
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(document).ready(function() {
            window.tblActividades = $('#tblActividades').DataTable({
                buttons: []
            });
        });
        $('.responsables_actividad').select2({
            theme: 'bootstrap4',
        });
        document.getElementById('btnAgregar').addEventListener('click', function(e) {
            e.preventDefault();
            limpiarErrores();
            agregarActividad();
        })

        // document.getElementById('btnVincularNombre').addEventListener('click', function(e) {
        //     e.preventDefault();
        //     let elementNombre = document.querySelector('[data-vincular-nombre="true"]').value;
        //     if (elementNombre != "") {
        //         if (document.getElementById('actividad').value == "") {
        //             document.getElementById('actividad').value = elementNombre;
        //         } else {
        //             if (elementNombre == document.getElementById('actividad').value) {
        //                 Swal.fire('El nombre ya ha sido vinculado', '', 'info');
        //             } else {
        //                 Swal.fire({
        //                     title: 'Atención',
        //                     text: "El campo de actividad actualmente contiene texto, ¿Desea sobreescribirlo?",
        //                     icon: 'warning',
        //                     showCancelButton: true,
        //                     confirmButtonColor: '#3085d6',
        //                     cancelButtonColor: '#d33',
        //                     confirmButtonText: 'Si',
        //                     cancelButtonText: 'No',
        //                 }).then((result) => {
        //                     if (result.isConfirmed) {
        //                         document.getElementById('actividad').value = elementNombre;
        //                     }
        //                 })
        //             }
        //         }
        //     } else {
        //         Swal.fire('No se ha descrito el nombre, no se puede vincular', '', 'info');
        //     }
        // })
    });

    function limpiarErrores() {
        document.querySelectorAll('.errores').forEach(element => {
            element.innerHTML = "";
        });
    }

    function limpiarCampos() {
        document.getElementById('actividad').value = '';
        document.getElementById('inicio').value = '';
        document.getElementById('finalizacion').value = '';
        document.getElementById('comentarios').value = '';
        $('.responsables_actividad').val(null).trigger('change');
    }

    function limpiarCampoPorId(id) {
        document.getElementById(id).value = '';
    }

    function agregarActividad() {
        let actividad = document.getElementById('actividad').value;
        let inicio = document.getElementById('inicio').value;
        let finalizacion = document.getElementById('finalizacion').value;
        let selectedValues = $('.responsables_actividad').select2('data');
        let comentarios = document.getElementById('comentarios').value;
        // let progreso = document.getElementById('progreso').value;
        let esFechaAnterior = Math.round((new Date(finalizacion).getTime() - new Date(inicio).getTime()) / (1000 *
            60 * 60 * 24)) < 0;
        if (actividad == '') {
            document.querySelector('.error_actividad').innerHTML = "El nombre de la actividad es requerido";
            limpiarCampoPorId('actividad');
        }
        if (inicio == '') {
            document.querySelector('.error_inicio').innerHTML = "El inicio de la actividad es requerido";
            limpiarCampoPorId('inicio');
        }
        if (finalizacion == '') {
            document.querySelector('.error_finalizacion').innerHTML = "La finalización de la actividad es requerido";
            limpiarCampoPorId('finalizacion');
        } else if (esFechaAnterior) {
            document.querySelector('.error_finalizacion').innerHTML =
                "La finalización de la actividad no puede ser días antes del día de inicio";
            limpiarCampoPorId('finalizacion');
        }
        if (selectedValues.length === 0) {
            document.querySelector('.error_participantes').innerHTML =
                "La actividad debe de tener al menos un participante";
            limpiarCampoPorId('responsables_actividad');
        }

        if (comentarios == '') {
            document.querySelector('.error_comentarios').innerHTML =
                "El los comentarios de la actividad son requeridos";
            limpiarCampoPorId('comentarios');
        }
        // if (progreso == '' || progreso < 0 || progreso > 100) {
        //     document.querySelector('.error_progreso').innerHTML =
        //         "El progreso de la actividad es requerido y debe estár en un rango de 0-100";
        //     limpiarCampoPorId('progreso');
        // }
        // && progreso != '' && progreso >= 0 && progreso <= 100 // Validaciones de progreso
        if (actividad != '' && inicio != '' && finalizacion != '' && !esFechaAnterior && comentarios != '' &&
            selectedValues.length > 0) {
            limpiarCampos();

            let actividades = tblActividades.rows().data().toArray();
            let arrActividades = [];
            actividades.forEach(actividad => {
                arrActividades.push(actividad[1]);
            });
            let name = actividad;
            // let start = new Date(inicio).getTime();
            // let end = new Date(finalizacion).getTime();
            let start = inicio;
            let end = finalizacion;
            let id = `tmp_${new Date().getTime()}_1`;
            let resta = new Date(end).getTime() - new Date(start).getTime();
            let duration = Math.round(resta / (1000 * 60 * 60 * 24));
            let images = "";
            let participantes_id = [];
            selectedValues.forEach(selected => {
                console.log(selected);
                images += `
                    <img class="rounded-circle" title="${selected.text.trim()}" src="{{ asset('storage/empleados/imagenes') }}/${selected.element.attributes.avatar.nodeValue}" id="res_${selected.id}" style="clip-path: circle(15px at 50% 50%);width: 45px;"/>
                `;
                participantes_id.push(selected.id);
            });

            // let progress = progreso;

            if (!arrActividades.includes(actividad)) {
                // ...

                let currentIndex;
                if (tblActividades.data().length > 0) {
                    currentIndex = tblActividades.data().length;
                } else {
                    currentIndex = 0;
                }

                let rowData = [
                    name,
                    start,
                    end,
                    images,
                    comentarios,
                    // `<button class="btn btn-sm text-danger" title="Eliminar actividad" onclick="event.preventDefault(); EliminarFila(this)"></button>`,
                ];

                tblActividades.row.add(rowData).draw();

                // Get the current index and push additional data to that row
                let currentRowData = tblActividades.row(currentIndex).data();
                currentRowData[currentRowData.length] = { // Update the last element of the row
                    id: id,
                    status: 'STATUS_ACTIVE',
                    duration: duration,
                    participantes_id: participantes_id,
                    // button: `<button class="btn btn-sm text-danger" title="Eliminar actividad" onclick="event.preventDefault(); EliminarFila(this)"></button>`,
                };
            } else {
                Swal.fire('Esta actividad ya ha sido agregada', '', 'info');
                limpiarCampos();
            }
        }
    }
    window.EliminarFila = function(element) {
        tblActividades
            .row($(element).parents('tr'))
            .remove()
            .draw();
    }
    // window.enviarActividades = function() {
    //     let actividades = tblActividades.rows().data().toArray();
    //     document.getElementById('actividades').value = JSON.stringify(actividades);
    // }
    window.enviarActividades = function() {
        let actividades = tblActividades.rows().data().toArray();

        // Filter out null or empty string values from each row
        let filteredActividades = actividades.map(row =>
            row.filter(value => value !== null && value !== '')
        );

        document.getElementById('actividades').value = JSON.stringify(filteredActividades);
    }
</script>
