<div class="form-group col-md-12">
    {{-- <button type="button" class="btn-xs btn-outline-success rounded ml-2 pr-3 offset-4"><i class="pl-2 pr-3 fas fa-plus"></i> Agregar</button> --}}
    <button type="button" class="btn btn-primary offset-11" style="text-align:center;" wire:click.prevent="create">
        Agregar
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="mantenimientoModal" tabindex="-1" aria-labelledby="mantenimientoModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mantenimientoModal">
                        {{ $view == 'create' ? 'Agregar' : 'Actualizar' }} Libera/Aplica Mantenimientos </h5>

                    <input id="cuestionario_id" name="cuestionario_id" type="hidden" value=" {{ $cuestionario_id }}"
                        wire:model.defer="cuestionario_id">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    {{-- <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="nombre"> <i
                                class="fas fa-user-tag iconos-crear"></i>Interno / Externo:</label>
                        <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                           value="{{ old('nombe', '') }}"
                            wire:model.defer="nombre" placeholder="...">
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                    </div> --}}
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="interno_externo"><i
                                class="bi bi-signpost-split-fill iconos-crear"></i>Interno / Externo:</label>

                        <select class="form-control {{ $errors->has('interno_externo') ? 'is-invalid' : '' }}"
                            wire:model.defer="interno_externo">
                            <option selected>Seleccione</option>
                            <option value="1">Interno</option>
                            <option value="2">Externo</option>
                        </select>
                        @if ($errors->has('interno_externo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('interno_externo') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="nombre"> <i
                                class="fas fa-user-tag iconos-crear"></i>Nombre:</label>
                        <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                            value="{{ old('nombe', '') }}" wire:model.defer="nombre" placeholder="...">
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="puesto"> <i
                                class="fas fa-user-tag iconos-crear"></i>Puesto:</label>
                        <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text"
                            value="{{ old('puesto', '') }}" wire:model.defer="puesto" placeholder="...">
                        @if ($errors->has('puesto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('puesto') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="correo_electronico"> <i
                                class="fas fa-user-tag iconos-crear"></i>Correo
                            electrónico:</label>
                        <input class="form-control {{ $errors->has('correo_electronico') ? 'is-invalid' : '' }}"
                            type="text" value="{{ old('correo_electronico', '') }}"
                            wire:model.defer="correo_electronico" placeholder="...">
                        @if ($errors->has('correo_electronico'))
                            <div class="invalid-feedback">
                                {{ $errors->first('correo_electronico') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="extencion"> <i
                                class="fas fa-user-tag iconos-crear"></i>Extención:</label>
                        <input class="form-control {{ $errors->has('extencion') ? 'is-invalid' : '' }}" type="number"
                            value="{{ old('extencion', '') }}" wire:model.defer="extencion" placeholder="...">
                        @if ($errors->has('extencion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('extencion') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="ubicacion"> <i
                                class="fas fa-user-tag iconos-crear"></i>Ubicación:</label>
                        <input class="form-control {{ $errors->has('ubicacion') ? 'is-invalid' : '' }}" type="text"
                            value="{{ old('ubicacion', '') }}" wire:model.defer="ubicacion" placeholder="...">
                        @if ($errors->has('ubicacion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ubicacion') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary"
                        wire:click.prevent="{{ $view == 'create' ? 'save' : 'update' }}">{{ $view == 'create' ? 'Guardar' : 'Actualizar' }}</button>
                </div>
            </div>
        </div>
    </div>




</div>
