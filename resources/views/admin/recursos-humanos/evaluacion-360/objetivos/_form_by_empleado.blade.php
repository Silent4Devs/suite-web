<style>
    .select2-selection--multiple {
        overflow: hidden !important;
        height: auto !important;
        padding: 0 5px 5px 5px !important;
    }

    .select2-container {
        margin-top: 10px !important;
    }
</style>

<div class="card card-body">

    <div class="row">
        <div class="col-12">
            <div class="info-first-config">
                <h4 class="title-config">Nuevo Objetivo</h4>
                <p>
                    Define los Valores y Escalas con los que se medirán los objetivos.
                </p>
                <hr class="my-4">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group anima-focus">
                <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                    id="nombre" aria-describedby="nombreHelp" name="nombre"
                    value="{{ old('nombre', $objetivo->nombre) }}" placeholder="">
                <label for="nombre">
                    Objetivo Estratégico
                </label>
                <small id="nombreHelp" class="form-text text-muted">Ingresa el nombre del objetivo estratégico</small>
                @if ($errors->has('nombre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
                <span class="errors nombre_error{{ $editar ? '_edit' : '' }} text-danger"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group anima-focus">
            <textarea class="form-control {{ $errors->has('descripcion_meta') ? 'is-invalid' : '' }}" name="descripcion_meta"
                id="" cols="30" rows="1" placeholder="">{{ old('descripcion_meta', $objetivo->descripcion_meta) }}</textarea>
            <label for="descripcion_meta">
                Descripción
            </label>
            {{-- <input class="form-control {{ $errors->has('descripcion_meta') ? 'is-invalid' : '' }}" type="text"
                name="descripcion_meta" value="{{ old('descripcion_meta', $objetivo->descripcion_meta) }}"> --}}
            <small id="descripcion_metaHelp" class="form-text text-muted">Ingresa una breve descripción del objetivo
                estratégico</small>
            @if ($errors->has('descripcion_meta'))
                <div class="invalid-feedback">
                    {{ $errors->first('descripcion_meta') }}
                </div>
            @endif
            <span class="errors descripcion_meta_error{{ $editar ? '_edit' : '' }} text-danger"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 form-group">
            <label for="tipo_id">
                Perspectiva <span class="text-danger">*</span>
            </label>
            {{-- Modulo para tipo de objetivo --}}
            <div class="row align-items-center">
                <div class="col-10" style="margin-top:-9px">
                    @livewire('tipo-objetivos-select', ['tipo_seleccionado' => $tipo_seleccionado])
                </div>
                @if (!$editar)
                    <div class="p-0 col" style="margin-top: -26px;height: 28px;margin-left: -10px;">
                        <button id="btnAgregarTipo" class="text-white btn btn-sm"
                            style="background:#3eb2ad;height: 32px;" data-toggle="modal"
                            data-target="#tipoObjetivoModal" title="Agregar Tipo"><i class="fas fa-plus"></i></button>
                        {{-- <button type="button" class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;"><i class="fas fa-edit"></i></button> --}}
                        {{-- <a href="{{ route('admin.glosarios.edit',$perspectiva->id )}}"><i class="fas fa-edit"></i></a> --}}
                        <a href="{{ route('admin.Perspectiva.index') }}" class="text-white btn btn-sm"
                            style="background:#3eb2ad;height: 32px;"><i class="fas fa-edit"></i></a>
                    </div>
                @endif
            </div>

            @livewire('tipo-objetivos-create')
            {{-- Fin Modulo para tipo de competencia --}}

        </div>
        <div class="col-md-3 form-group">
            <label for="KPI">
                KPIs
            </label>
            <input class="form-control {{ $errors->has('KPI') ? 'is-invalid' : '' }}" type="text" name="KPI"
                value="{{ old('KPI', $objetivo->KPI) }}" placeholder="">
            <small id="KPIHelp" class="form-text text-muted">Ingresa el KPI del objetivo estratégico </small>
            @if ($errors->has('KPI'))
                <div class="invalid-feedback">
                    {{ $errors->first('KPI') }}
                </div>
            @endif
            <span class="errors KPI_error{{ $editar ? '_edit' : '' }} text-danger"></span>
        </div>
        <div class="col-md-3 form-group">
            <label for="meta">
                Meta a alcanzar
            </label>
            <input type="number" class="form-control {{ $errors->has('meta') ? 'is-invalid' : '' }}" id="meta"
                aria-describedby="metaHelp" name="meta" value="{{ old('meta', $objetivo->meta) }}" placeholder="">
            <small id="metaHelp" class="form-text text-muted">Ingresa la Meta del objetivo estratégico </small>
            @if ($errors->has('meta'))
                <div class="invalid-feedback">
                    {{ $errors->first('meta') }}
                </div>
            @endif
            <span class="errors meta_error{{ $editar ? '_edit' : '' }} text-danger"></span>
        </div>
        <div class="form-group col-md-3">
            <label for="metrica_id">
                Unidad de medida <span class="text-danger">*</span>
            </label>
            {{-- Modulo para metrica de objetivo --}}
            <div class="row align-items-center">
                <div class="col-10" style="margin-top:-11px">
                    @livewire('metrica-objetivo-select', ['metrica_seleccionada' => $metrica_seleccionada])
                </div>
                @if (!$editar)
                    <div class="p-1 col" style="margin-top:-28px;height: 38px;margin-left: -12px;">
                        <button id="btnAgregarMetrica" class="text-white btn btn-sm"
                            style="background:#3eb2ad;height: 32px;" data-toggle="modal"
                            data-target="#metricaObjetivoModal" title="Agregar unidad"><i
                                class="fas fa-plus"></i></button>
                        <a href="{{ route('admin.Metrica.index') }}" class="text-white btn btn-sm"
                            style="background:#3eb2ad;height: 32px;"><i class="fas fa-edit"></i></a>
                    </div>
                @endif
            </div>
            @livewire('metrica-objetivo-create')
            {{-- Fin Modulo para tipo de competencia --}}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button id="BtnAgregarObjetivo" class="btn" style="float: right" title="Agregar objetivo">
                Agregar objetivo a la tabla<i class="material-symbols-outlined">south</i>
            </button>
        </div>
    </div>
</div>

<div class="card card-body">
    @if (!$editar)
        <div class="card-body datatable-fix">
            <div class="row">
                <div class="col-12">
                    <h4 class="title-card-evaluaciones">Objetivos Estratégicos Asignados</h4>
                </div>
            </div>
            <div style="text-align: right">
                <button class="btn btn-primary" id="copiarObjetivos"><i class="fas fa-copy mr-2"></i>Importar
                    Objetivos</button>
            </div>
            <table class="table table-bordered w-100 tblObjetivos">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">
                            Perspectiva
                        </th>
                        <th style="vertical-align: top">
                            Objetivos Estratégicos
                        </th>
                        <th style="vertical-align: top">
                            KPI
                        </th>
                        <th style="vertical-align: top">
                            Estatus
                        </th>
                        <th style="vertical-align: top">
                            Descripción
                        </th>
                        <th style="vertical-align: top">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($objetivos as $objetivo)
                        <tr>
                            <td>{{ $objetivo->objetivo->tipo->nombre ?? '' }}</td>
                            <td>{{ $objetivo->objetivo->nombre }}</td>
                            <td>{{ $objetivo->objetivo->KPI }}</td>
                            <td>
                                @if ($objetivo->objetivo->esta_aprobado == 1)
                                    <span class="badge badge-success">Aprobado</span>
                                @elseif ($objetivo->objetivo->esta_aprobado  == 2)
                                    <span class="badge badge-danger">
                                        No Aprobado
                                        @if ($objetivo->objetivo->comentarios_aprobacion)
                                            <i class="fas fa-comment ml-1" title="{{ $objetivo->objetivo->comentarios_aprobacion }}"></i>
                                        @endif
                                    </span>
                                @else
                                    <span class="badge badge-warning">Pendiente</span>
                                @endif
                            </td>
                            <td>{{ $objetivo->objetivo->descripcion_meta }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-sm btn-editar" title="Editar"
                                            onclick="Editar('/admin/recursos-humanos/evaluacion-360/{{ $objetivo->empleado_id }}/objetivos/{{ $objetivo->objetivo_id }}/editByEmpleado', '/admin/recursos-humanos/evaluacion-360/objetivos/{{ $objetivo->objetivo_id }}/empleado')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-eliminar text-danger" title="Eliminar"
                                                onclick="Eliminar('{{ route('admin.ev360-objetivos-empleado.destroyByEmpleado', ['objetivo' => $objetivo->objetivo->id]) }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                    @if (Auth::id() == $empleado->supervisor->id || $permiso === true)
                                        <div class="col-12">
                                            <button onclick="aprobarObjetivoEstrategico({{ $objetivo->objetivo->id }}, {{ $objetivo->empleado_id }}, true);" class="btn btn-small text-success">
                                                <i class="fa-solid fa-thumbs-up"></i>
                                            </button>
                                            <button onclick="aprobarObjetivoEstrategico({{ $objetivo->objetivo->id }}, {{ $objetivo->empleado_id }}, false);" class="btn btn-small text-danger">
                                                <i class="fa-solid fa-thumbs-down"></i>
                                            </button>
                                        </div>
                                     @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="modal fade" id="modalCopiarObjetivos" data-backdrop="static" data-keyboard="false"
                tabindex="-1" aria-labelledby="modalCopiarObjetivosLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background: var(--color-tbj)color: white;">
                            <h5 class="modal-title" id="modalCopiarObjetivosLabel"><i
                                    class="mr-2 fas fa-copy"></i>Copiar
                                Objetivos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="contenidoModal"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary"
                                data-dismiss="modal">Cerrar</button>
                            <button type="button" id="btnGuardarCopiaObjs" class="btn btn-primary">Guardar</button>
                        </div>
                        @include('layouts.loader')
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>



<script>

    document.getElementById('BtnAgregarObjetivo').addEventListener('click', function (event) {
        Swal.fire({
            title: 'Registro exitoso',
            text: "El objetivo ha sido registrado correctamente",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnAgregarTipo').addEventListener('click', function(e) {
            e.preventDefault();
        });
        document.getElementById('btnAgregarMetrica').addEventListener('click', function(e) {
            e.preventDefault();
        });
    })
</script>
