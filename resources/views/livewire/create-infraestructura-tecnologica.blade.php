<div class="form-group col-md-12">

    <button type="button" class="btn btn-primary offset-11" style="text-align:center;"
        wire:click.prevent="createInfraestructura">
        Agregar
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalInfraestructura" tabindex="-1" aria-labelledby="modalInfraestructura"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ $view == 'create' ? 'Agregar' : 'Actualizar' }} Infraestructura Tecnológica </h5>

                    <input id="cuestionario_id" name="cuestionario_id" type="hidden" value=" {{ $cuestionario_id }}"
                        wire:model="cuestionario_id">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="escenario"><i class="bi bi-signpost-split-fill iconos-crear"></i>Escenario:</label>
                        {{-- <input class="form-control {{ $errors->has('escenario') ? 'is-invalid' : '' }}" type="text"
                           value="{{ old('escenario', '') }}"
                            wire:model="nescenario" placeholder="..."> --}}
                        <select name="escenario" class="form-control {{ $errors->has('escenario') ? 'is-invalid' : '' }}"  wire:model="escenario" >
                            <option selected>Seleccione</option>
                            <option value="1">En Operación Normal</option>
                            <option value="2">En Contingencia</option>
                        </select>
                        @if ($errors->has('escenario'))
                            <div class="invalid-feedback">
                                {{ $errors->first('escenario') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="sistemas"> <i
                                class="fas fa-user-tag iconos-crear"></i>Sistemas:</label>
                        <input class="form-control {{ $errors->has('sistemas') ? 'is-invalid' : '' }}" type="text"
                            value="{{ old('sistemas', '') }}" wire:model="sistemas" placeholder="...">
                        @if ($errors->has('sistemas'))
                            <div class="invalid-feedback">
                                {{ $errors->first('sistemas') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="aplicativos"> <i
                                class="fas fa-user-tag iconos-crear"></i>Aplicativos / Utilerías:</label>
                        <input class="form-control {{ $errors->has('aplicativos') ? 'is-invalid' : '' }}"
                            type="text" value="{{ old('aplicativos', '') }}"
                            wire:model="aplicativos" placeholder="...">
                        @if ($errors->has('aplicativos'))
                            <div class="invalid-feedback">
                                {{ $errors->first('aplicativos') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="base_datos"> <i
                                class="fas fa-user-tag iconos-crear"></i>Bases de Datos:</label>
                        <input class="form-control {{ $errors->has('base_datos') ? 'is-invalid' : '' }}" type="text"
                            value="{{ old('base_datos', '') }}" wire:model="base_datos" placeholder="...">
                        @if ($errors->has('base_datos'))
                            <div class="invalid-feedback">
                                {{ $errors->first('base_datos') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <label class="required" for="otro"> <i
                                class="fas fa-user-tag iconos-crear"></i>Otro:</label>
                        <input class="form-control {{ $errors->has('otro') ? 'is-invalid' : '' }}" type="text"
                            value="{{ old('otro', '') }}" wire:model="otro" placeholder="...">
                        @if ($errors->has('otro'))
                            <div class="invalid-feedback">
                                {{ $errors->first('otro') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary"
                        wire:click.prevent="{{ $view == 'create' ? 'saveInfraestructura' : 'updateInfraestructura' }}">{{ $view == 'create' ? 'Guardar' : 'Actualizar' }}</button>
                </div>
            </div>
        </div>
    </div>

</div>
