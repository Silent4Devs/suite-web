<div class="form-group col-md-12">

    <button type="button" class="btn btn-primary offset-11" style="text-align:center;" wire:click.prevent="createMateriales">
        Agregar
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalMateriales" tabindex="-1" aria-labelledby="modalMateriales"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ $view == 'create' ? 'Agregar' : 'Actualizar' }} Recurso Material  </h5>

                    <input id="cuestionario_id" name="cuestionario_id" type="hidden" value=" {{ $cuestionario_id }}"
                        wire:model.defer="cuestionario_id">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
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
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label class="required" for="equipos"><i class="bi bi-pc-display iconos-crear"></i>Número de Equipos de Cómputo:</label>
                            <input class="form-control {{ $errors->has('equipos') ? 'is-invalid' : '' }}" type="number"
                                value="{{ old('equipos', '') }}" wire:model.defer="equipos" placeholder="...">
                            @if ($errors->has('equipos'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('equipos') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label class="required" for="impresoras"><i class="bi bi-printer-fill iconos-crear"></i>Número de Impresoras / Fax:</label>
                            <input class="form-control {{ $errors->has('impresoras') ? 'is-invalid' : '' }}" type="number"
                                value="{{ old('impresoras', '') }}" wire:model.defer="impresoras" placeholder="...">
                            @if ($errors->has('impresoras'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('impresoras') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label class="required" for="telefono"><i class="bi bi-phone-fill iconos-crear"></i>Número de Teléfonos:</label>
                            <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" type="number"
                                value="{{ old('telefono', '') }}" wire:model.defer="telefono" placeholder="...">
                            @if ($errors->has('telefono'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('telefono') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label class="required" for="otro_numero"><i class="bi bi-ui-checks-grid iconos-crear"></i>Otro (Cantidad):</label>
                            <input class="form-control {{ $errors->has('otro_numero') ? 'is-invalid' : '' }}" type="number"
                                value="{{ old('otro_numero', '') }}" wire:model.defer="otro_numero" placeholder="...">
                            @if ($errors->has('otro_numero'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('otro_numero') }}
                                </div>
                            @endif
                        </div>  
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label class="required" for="otro"><i class="bi bi-ui-checks-grid iconos-crear"></i>Otro (Descripción):</label>
                            <input class="form-control {{ $errors->has('otro') ? 'is-invalid' : '' }}" type="text"
                                value="{{ old('otro', '') }}" wire:model.defer="otro" placeholder="...">
                            @if ($errors->has('otro'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('otro') }}
                                </div>
                            @endif
                        </div>            
                    </div>
           
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary"
                        wire:click.prevent="{{ $view == 'create' ? 'saveMateriales' : 'updateMateriales' }}">{{ $view == 'create' ? 'Guardar' : 'Actualizar' }}</button>
                </div>
            </div>
        </div>
    </div>

</div>
