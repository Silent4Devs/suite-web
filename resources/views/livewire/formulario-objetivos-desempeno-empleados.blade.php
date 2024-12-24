<div>

    @if ($permiso_carga)
        <div class="card card-body">
            <div class="info-first-config">
                <div class="row">
                    <div class="col-11">
                        <h4 class="title-config">Nuevo Objetivo</h4>
                        <p>Define los Valores y Escalas con los que se medirán los objetivos.</p>
                    </div>
                    <div class="col-1">
                        <a wire:click.prevent="formularioMostraOcultar">
                            @if ($mostrar)
                                <i class="fa-solid fa-chevron-up fa-lg"></i>
                            @else
                                <i class="fa-solid fa-chevron-down fa-lg"></i>
                            @endif
                        </a>
                    </div>
                </div>
                <hr class="my-4">
            </div>
            @if ($mostrar)
                <div class="row">
                    <div class="col-12 form-group anima-focus">
                        <input wire:model.live="objetivo_estrategico" id="objetivo_estrategico" type="text"
                            class="form-control" placeholder="">
                        <label for="objetivo_estrategico" class="required">Objetivo Estratégico</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 form-group anima-focus">
                        <textarea wire:model.live="descripcion" name="descripcion" id="descripcion" cols="30" rows="10" placeholder=""
                            class="form-control"></textarea>
                        <label for="descripcion">Descripción</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 form-group anima-focus">
                        <select wire:model.live="select_categoria" id="categoria" type="text" class="form-control"
                            placeholder="">
                            <option value="">Seleccione Categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        <label for="categoria" class="required">Categoría</label>
                    </div>
                    <div class="col-md-3 form-group anima-focus">
                        <input wire:model.live="KPI" id="KPI" type="text" class="form-control" placeholder="">
                        <label for="KPI" class="required">KPI</label>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex" style="gap: 10px;">
                            <div class="form-group anima-focus w-100">
                                <select wire:model.live="select_unidad" id="unidad-medida" type="text"
                                    class="form-control" placeholder="">
                                    <option value="">Seleccione Unidad</option>
                                    @foreach ($unidades as $unidad)
                                        <option value={{ $unidad->id }}>{{ $unidad->definicion }}</option>
                                    @endforeach
                                </select>
                                <label for="unidad-medida" class="required">Unidad de medida</label>
                            </div>
                            <button class="btn btn-primary" style="height: 45px;" data-toggle="modal"
                                data-target="#modalCrearUnidad">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <button class="btn btn-primary" style="height: 45px;" data-toggle="modal"
                                data-target="#modalEditarUnidad" wire:click="editarUnidad">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <input type="checkbox" wire:model.live="ev360">
                        <label for="">Evaluación 360</label>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" wire:model.live="mensual">
                        <label for="">Mensual</label>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" wire:model.live="bimestral">
                        <label for="">Bimestral</label>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" wire:model.live="trimestral">
                        <label for="">Trimestral</label>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" wire:model.live="semestral">
                        <label for="">Semestral</label>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" wire:model.live="anualmente">
                        <label for="">Anualmente</label>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" wire:model.live="abierta">
                        <label for="">Abierta</label>
                    </div>
                </div>

                <div class="modal fade" id="modalCrearUnidad" tabindex="-1" role="dialog"
                    aria-labelledby="modalCrearUnidadLabel" aria-hidden="true" wire:ignore>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCrearUnidadLabel">Crear Unidad de Medición para
                                    Objetivos
                                    Estrategicos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Modal content goes here -->
                                {{-- This is the content of the modal. --}}
                                <div class="row">
                                    <div class="col-12 form-group anima-focus">
                                        <input wire:model.live="nombre_unidad" id="nombre_unidad" type="text"
                                            class="form-control" placeholder="">
                                        <label for="nombre_unidad">Unidad</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 form-group anima-focus">
                                        <input wire:model.live="minimo_unidad" id="minimo_unidad" type="number"
                                            class="form-control" placeholder="">
                                        <label for="minimo_unidad">Valor Minimo</label>
                                    </div>
                                    <div class="col-6 form-group anima-focus">
                                        <input wire:model.live="maximo_unidad" id="maximo_unidad" type="number"
                                            class="form-control" placeholder="">
                                        <label for="maximo_unidad">Valor Maximo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <a wire:click.prevent="crearUnidad" type="button" class="btn btn-primary"
                                    data-dismiss="modal">Crear Unidad</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalEditarUnidad" tabindex="-1" role="dialog"
                    aria-labelledby="modalEditarUnidadLabel" aria-hidden="true" wire:ignore>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditarUnidadLabel">Editar Unidad de Medición para
                                    Objetivos
                                    Estrategicos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Modal content goes here -->
                                {{-- This is the content of the modal. --}}
                                <div class="row">
                                    <div class="col-12 form-group anima-focus">
                                        <input wire:model.live="nombre_edit_unidad" id="nombre_edit_unidad"
                                            type="text" class="form-control" placeholder="">
                                        <label for="nombre_edit_unidad">Unidad</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 form-group anima-focus">
                                        <input wire:model.live="minimo_edit_unidad" id="minimo_edit_unidad"
                                            type="number" class="form-control" placeholder="">
                                        <label for="minimo_edit_unidad">Valor Minimo</label>
                                    </div>
                                    <div class="col-6 form-group anima-focus">
                                        <input wire:model.live="maximo_edit_unidad" id="maximo_edit_unidad"
                                            type="number" class="form-control" placeholder="">
                                        <label for="maximo_edit_unidad">Valor Maximo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <a wire:click.prevent="updateUnidad" type="button" class="btn btn-primary"
                                    data-dismiss="modal">Editar Unidad</a>
                            </div>
                        </div>
                    </div>
                </div>

                @if (!empty($evaluacion_activa))
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="p-3 rounded-lg" style="color: #818181; background-color: #FFFEE5;">
                                <i>
                                    *Esta sección estará activa hasta que establezcas los periodos de la evaluación en
                                    la
                                    <a href="" style="color: var(--color-tbj); text-decoration: underline;">
                                        Configuración de la Evaluación.
                                    </a>
                                    (Asigna un periodo para hacer estos ajustes en la calibración de objetivos)
                                </i>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4" style="width: 300px;">
                        <div class="form-group anima-focus">
                            <div class="form-control" style="height: auto !important;">
                                <div class="d-flex flex-column py-3" style="gap: 15px;">
                                    @foreach ($evaluacion_activa->periodos as $key_evaluacion => $periodo)
                                        <div>
                                            <input type="checkbox" name="" id="" checked>
                                            <label for="">{{ $periodo->nombre_evaluacion }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <label for="">Periodos</label>
                        </div>
                    </div>
                @endif

                <div class="info-first-config mt-5">
                    <h4 class="title-config">Escalas del objetivo</h4>
                    <p>Define las Escalas con los que se medirá este objetivo.</p>
                    <hr class="my-4">
                </div>

                {{-- <div class="d-flex align-items-center" style="gap: 20px;">
                    <input type="checkbox">
                    <span><strong>Variante</strong></span>
                    <span>Selecciona esta opción si deseas agregar una o más variantes a tus valores por periodo.</span>
                </div> --}}

                <div class="mt-5">
                    <div class="row">
                        @foreach ($escalas as $key => $e)
                            <div class="col-3">
                                <div class="form-row mb-3">
                                    {{ $e->parametro }}
                                </div>
                                <div class="form-row mt-3">
                                    <div class="d-flex align-tiems-center" style="gap: 20px;">
                                        <div class="form-group anima-focus" style="width: 60px;">
                                            <input wire:model.live="array_escalas_objetivos.{{ $key }}.color"
                                                type="color" name="" id="" class="form-control">
                                        </div>
                                        <div class="form-group anima-focus" style="min-width: 60px;">
                                            <select
                                                wire:model.live="array_escalas_objetivos.{{ $key }}.condicional"
                                                type="text" name="escala_{{ $key }}" id=""
                                                class="form-control">
                                                <option value="0" disabled selected>Seleccione una Condición
                                                </option>
                                                <option value="1">Menor que</option>
                                                <option value="2">Menor o igual que</option>
                                                <option value="3">Igual que</option>
                                                <option value="4">Mayor que</option>
                                                <option value="5">Mayor o igual que</option>
                                            </select>
                                            <label for="escala_{{ $key }}"
                                                class="required">Condicional</label>
                                        </div>
                                        <div class="form-group anima-focus" style="min-width: 60px;">
                                            <input wire:model.live="array_escalas_objetivos.{{ $key }}.valor"
                                                type="number" name="escalas_objetivos{{ $key }}valor"
                                                id="escalas_objetivos{{ $key }}valor" class="form-control"
                                                min="{{ $minimo_objetivo }}" max="{{ $maximo_objetivo }}">
                                            <label for="escalas_objetivos{{ $key }}valor"
                                                class="required">Valor</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-right">
                    <button type="button" wire:click="crearObjetivo" class="btn btn-outline-primary"
                        style="background-color: #ECFBFF; color: var(--color-tbj); border-radius: 100px !important;">
                        Agregar objetivo a la tabla <i class="fa-solid fa-arrow-down"></i>
                    </button>
                </div>
            @endif

        </div>
        @else
        <div class="px-1 py-2 mb-3 rounded shadow" style="background-color: #FFFBCE; border-top:solid 1px #FFFBCE;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="bi bi-info mr-3" style="color: #818181; font-size: 30px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="align-items-center d-flex" style="font-size: 16px; font-weight: bold; color: #818181">
                        No es posible cargar objetivos porque no hay un periodo activo para hacerlo.</p>
                    </p>
                </div>
            </div>
        </div>
        @endif

    <div class="card card-body">
        <div class="info-first-config">
            <div class="col-6">
                <h4 class="title-config">Objetivos Estrategicos del Colaborador</h4>
            </div>
            <div class="d-flex justify-content-end">
                @if ($cuentaObjPend > 0)
                    <button class="btn btn-primary me-2" wire:click.prevent="enviarCorreo">
                        Notificar Lider
                    </button>
                @endif
                <a class="btn btn-primary" href="{{ route('admin.rh.evaluaciones-desempeno.objetivos-papelera', $id_emp) }}">
                    Papelera
                </a>
            </div>
            <hr class="my-4">
        </div>

        <div class="datatable-rds">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Objetivos Estratégicos</th>
                        <th>KPI</th>
                        <th>Descripción</th>
                        <th>Estatus</th>
                        <th>Meta</th>
                        <th>Periodo</th>
                        @if ($permisoAprobacion)
                            <th>Revisión</th>
                        @endif
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($objetivos as $obj)
                        <tr>
                            <td>{{ $obj->objetivo->tipo->nombre }}</td>
                            <td>{{ $obj->objetivo->nombre }}</td>
                            <td>{{ $obj->objetivo->KPI }}</td>
                            <td>{{ $obj->objetivo->descripcion_meta }}</td>
                            <td>
                                @switch($obj->objetivo->esta_aprobado)
                                    @case("0")
                                        <span class="badge badge-warning">Pendiente</span>
                                    @break

                                    @case("1")
                                        <span class="badge badge-success">Aprobado</span>
                                    @break

                                    @case("2")
                                        <span class="badge badge-danger">Rechazado
                                            <i class="fas fa-comment ml-1"
                                                title="{{ $obj->objetivo->comentarios_aprobacion }}"></i>
                                        </span>
                                    @break

                                    @default
                                        <span class="badge badge-warning">Pendiente</span>
                                @endswitch
                            </td>
                            <td>{{ $obj->objetivo->meta }}</td>
                            <td>Periodo</td>
                            @if ($permisoAprobacion)
                                <td>
                                    @if ($obj->objetivo->esta_aprobado == 0)
                                    <a onclick="confirmarAprobacionObjetivo({{ $obj->objetivo->id }})"
                                    title="Aprobar">
                                    <span class="material-symbols-outlined icono-aprobar">
                                        thumb_up
                                    </span>
                                </a>
                                <a onclick="confirmarRechazoObjetivo({{ $obj->objetivo->id }})"
                                    title="Rechazar" >
                                    <span class="material-symbols-outlined icono-rechazar">
                                        thumb_down
                                    </span>
                                </a>
                                    @endif
                                </td>
                            @endif
                            <td>
                                <div class="dropdown btn-options-foda-card">
                                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            onclick="confirmarEnvioPapelera({{ $obj->id }})">Enviar a la
                                            Papelera</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-end">
        <a href="{{ route('admin.ev360-objetivos-periodo.config') }}" class="btn btn-outline-primary">Regresar</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.confirmarEnvioPapelera = function(objetivoId) {
                window.dispatchEvent(new CustomEvent('confirmarEnvioPapelera', {
                    detail: {
                        objetivoId
                    }
                }));
            };

            window.addEventListener('confirmarEnvioPapelera', event => {
                Swal.fire({
                    title: 'Enviar a Papelera',
                    text: "¿Esta seguro que desea enviar este objetivo a la papelera?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, enviar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('enviarPapelera', [event.detail.objetivoId]);
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.confirmarAprobacionObjetivo = function (objetivoId) {
                Swal.fire({
                    title: 'Aprobar Objetivo',
                    text: "¿Está seguro que desea aprobar este objetivo?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, aprobar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('aprobarObjetivo', { objetivoId });
                    }
                });
            };

            window.confirmarRechazoObjetivo = function (objetivoId) {
                Swal.fire({
                    title: 'Rechazar Objetivo',
                    text: "¿Está seguro que desea rechazar este objetivo?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, rechazar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('rechazarObjetivo', { objetivoId });
                    }
                });
            };
        });
    </script>


</div>
