<div class="form-group col-md-12">

    <button type="button" class="btn btn-primary offset-11" style="text-align:center;" wire:click.prevent="createRecursos">
        Agregar
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalRecursos" tabindex="-1" aria-labelledby="modalRecursos"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ $view == 'create' ? 'Agregar' : 'Actualizar' }} Personas que Intervienen en el Proceso </h5>

                    <input id="cuestionario_id" name="cuestionario_id" type="hidden" value=" {{ $cuestionario_id }}"
                        wire:model.defer="cuestionario_id">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label class="required" for="escenario"><i class="bi bi-signpost-split-fill iconos-crear"></i>Escenario:</label>
                           
                            <select class="form-control {{ $errors->has('escenario') ? 'is-invalid' : '' }}"  wire:model.defer="escenario" >
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
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label class="required" for="empresa"><i class="bi bi-grid-1x2-fill iconos-crear"></i>Empresa / Área:</label>
                            <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text"
                                value="{{ old('empresa', '') }}" wire:model.defer="empresa" placeholder="...">
                            @if ($errors->has('empresa'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('empresa') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label class="required" for="puesto"><i class="bi bi-briefcase-fill iconos-crear"></i>Puesto:</label>
                            <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text"
                                value="{{ old('puesto', '') }}" wire:model.defer="puesto" placeholder="...">
                            @if ($errors->has('puesto'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('puesto') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label class="required" for="rol"><i class="bi bi-bookmarks-fill iconos-crear"></i>Rol:</label>
                            <input class="form-control {{ $errors->has('rol') ? 'is-invalid' : '' }}" type="text"
                                value="{{ old('rol', '') }}" wire:model.defer="rol" placeholder="...">
                            @if ($errors->has('rol'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rol') }}
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label class="required" for="nombre"> <i
                                    class="fas fa-user-tag iconos-crear"></i>Nombre(s):</label>
                            <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                                value="{{ old('nombe', '') }}" wire:model.defer="nombre" placeholder="...">
                            @if ($errors->has('nombre'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nombre') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label class="required" for="a_paterno"> <i
                                    class="fas fa-user-tag iconos-crear"></i>Apellido Paterno:</label>
                            <input class="form-control {{ $errors->has('a_paterno') ? 'is-invalid' : '' }}" type="text"
                                value="{{ old('nombe', '') }}" wire:model.defer="a_paterno" placeholder="...">
                            @if ($errors->has('a_paterno'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('a_paterno') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label class="required" for="a_materno"> <i
                                    class="fas fa-user-tag iconos-crear"></i>Apellido Materno:</label>
                            <input class="form-control {{ $errors->has('a_materno') ? 'is-invalid' : '' }}" type="text"
                                value="{{ old('a_materno', '') }}" wire:model.defer="a_materno" placeholder="...">
                            @if ($errors->has('a_materno'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('a_materno') }}
                                </div>
                            @endif
                        </div>
                    </div>

                   
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label class="required" for="correo"><i class="bi bi-envelope-fill iconos-crear"></i>Correo
                                electrónico:</label>
                            <input class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}"
                                type="text" value="{{ old('correo', '') }}"
                                wire:model.defer="correo" placeholder="...">
                            @if ($errors->has('correo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('correo') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label class="required" for="tel"><i class="bi bi-telephone-fill iconos-crear"></i>Telefono/Extención:</label>
                            <input class="form-control {{ $errors->has('tel') ? 'is-invalid' : '' }}" type="number"
                                value="{{ old('tel', '') }}" wire:model.defer="tel" placeholder="...">
                            @if ($errors->has('tel'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tel') }}
                                </div>
                            @endif
                        </div>
                    </div>
                   

                  

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary"
                        wire:click.prevent="{{ $view == 'create' ? 'saveRecursos' : 'updateRecursos' }}">{{ $view == 'create' ? 'Guardar' : 'Actualizar' }}</button>
                </div>
            </div>
        </div>
    </div>

</div>
