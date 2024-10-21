<div>
    <div class="card card-body">
        <div class="info-first-config">
            <h4 class="title-config">Habilitar periodo de carga de objetivos</h4>
            <hr class="my-4">
        </div>
        <div class="row">
            <div class="col-md-3 form-group">
                <label for="inicioCarga">Inicio de carga de objetivos</label>
                <input id="inicioCarga" wire:model.lazy="fecha_inicio" type="date" class="form-control"
                    @if ($periodo_habilitado) disabled @endif>
            </div>
            <div class="col-md-3 form-group">
                <label for="finCarga">Fin de carga objetivos</label>
                <input id="finCarga" wire:model.lazy="fecha_fin" type="date" class="form-control"
                    @if ($periodo_habilitado) disabled @endif>
            </div>
            <div class="col-md-3 form-group">
                <label for="habilitar">Habilitar</label>
                <div class="custom-control custom-switch custom-switch-lg">
                    <input type="checkbox" class="custom-control-input" id="habilitar" wire:model="periodo_habilitado"
                        wire:change="habilitarCargaObjetivos($event.target.checked)">
                    <label class="custom-control-label" for="habilitar"></label>
                </div>
            </div>
            <div class="col-md-3 form-group">
                <br>
                <a class="btn btn-primary" wire:click.prevent="notificarCarga">
                    Notificar carga de objetivos
                </a>
            </div>
        </div>
    </div>
    <div class="w-100 d-flex flex-wrap-wrap mb-4" style="gap: 15px;">
        <div class="item-cfg-num-emp" style="background-color: #5172BF;">
            <span>Total de colaboradores</span>
            <span>{{ $total_colaboradores }}</span>
        </div>
        <div class="item-cfg-num-emp" style="background-color: #78BB50;">
            <span>Colaboradores con objetivos asignados</span>
            <span>{{ $total_con_objetivos }}</span>
        </div>
        <div class="item-cfg-num-emp" style="background-color: #E89F32;">
            <span>Colaboradores pendientes de asignar objetivos</span>
            <span>{{ $total_sin_objetivos }}</span>
        </div>
        <div class="item-cfg-num-emp" style="background-color: #E86A32;">
            <span>Colaboradores con objetivos por aprobar</span>
            <span>{{ $total_obj_pend }}</span>
        </div>
    </div>
    <div class="card card-body">
        <div class="info-first-config">
            <h4 class="title-config">Colaboradores y Objetivos</h4>
            <p>
                Carga, importa o exporta los objetivos de tus colaboradores
            </p>
            <hr class="my-4">
        </div>
        <div class="row">
            <div class="col-md-3 form-group anima-focus">
                <select id="area" wire:model.live="select_area" class="form-control">
                    <option selected value="0">Todos</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                    @endforeach
                </select>
                <label for="area">Área</label>
            </div>
            <div class="col-md-3 form-group anima-focus">
                <select id="puesto" wire:model.live="select_puesto" class="form-control">
                    <option selected value="0">Todos</option>
                    @foreach ($puestos as $puesto)
                        <option value="{{ $puesto->id }}">{{ $puesto->puesto }}</option>
                    @endforeach
                </select>
                <label for="puesto">Puesto</label>
            </div>
            <div class="col-md-3 form-group anima-focus">
                <select id="perfil" wire:model.live="select_perfil" class="form-control">
                    <option selected value="0">Todos</option>
                    @foreach ($perfiles as $perfil)
                        <option value="{{ $perfil->id }}">{{ $perfil->nombre }}</option>
                    @endforeach
                </select>
                <label for="perfil">Perfil</label>
            </div>
            <div class="col-md-3 form-group anima-focus">
                <select id="colaborador" wire:model.live="select_colaborador" class="form-control">
                    <option selected value="0">Todos</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                    @endforeach
                </select>
                <label for="colaborador">Colaborador</label>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-9 form-group anima-focus">
                <input id="buscar" type="search" class="form-control" placeholder=""
                    style="border: none; border-bottom: 1px solid; border-radius: 0px !important;">
                <label for="buscar"><i class="material-symbols-outlined"
                        style="transform: translateY(50%);">search</i> Buscar</label>
            </div>
        </div> --}}
    </div>
    <div class="card card-body">
        <div class="datatable-fix">
            <table id="datatable-empleados-config-evaluaciones" class="table table-bordered w-100 datatable">
                <thead class="thead-dark">
                    <tr>
                        <th>No. Empleado</th>
                        <th>Nombre del Colaborador</th>
                        <th>Puesto</th>
                        <th>Área</th>
                        <th>Perfil</th>
                        <th>Objetivos Asignados</th>
                        <th>Carga de Objetivos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->n_empleado ?? 'Sin Asignar' }}</td>
                            <td>{{ $empleado->name }}</td>
                            <td>{{ $empleado->puestoRelacionado->puesto }}</td>
                            <td>{{ $empleado->area->area }}</td>
                            <td>{{ $empleado->perfil->nombre ?? 'Sin Definir' }}</td>
                            <td>{{ count($empleado->objetivos) . ' Objetivos Asignados' ?? 'Sin Objetivos Asignados' }}
                            <td>
                                <div class="d-flex">
                                    @can('objetivos_estrategicos_agregar')
                                        <a href="{{ route('admin.rh.evaluaciones-desempeno.carga-objetivos-empleado', $empleado->id) }}"
                                            title="Editar" class="btn btn-sm btn-primary">
                                            <i class="fas fa-user-tag"></i> Objetivos
                                        </a>
                                    @endcan
                                    {{-- @can('objetivos_estrategicos_copiar')
                                        <button
                                            onclick="CopiarObjetivos('/admin/recursos-humanos/evaluacion-360/objetivos/{{ $empleado->id }}/copiar', '{{ $empleado->name }}', '{{ $empleado->id }}')"
                                            title="Copiar Objetivos" class="ml-2 text-white btn btn-sm"
                                            style="background:#11bb55">
                                            <i class="fas fa-copy"></i>Copiar
                                        </button>
                                    @endcan
                                    @can('objetivos_estrategicos_ver')
                                        <a href="{{ url('/admin/recursos-humanos/evaluacion-360/' . $empleado->id . '/objetivos/lista') }}"
                                            title="Visualizar" class="ml-2 text-white btn btn-sm"
                                            style="background:#1da79f">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                    @endcan --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
