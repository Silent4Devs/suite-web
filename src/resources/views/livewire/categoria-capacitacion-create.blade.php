<div wire:ignore.self class="modal fade" id="tipoCategoriaCapacitacionModal" tabindex="-1"
    aria-labelledby="tipoCategoriaCapacitacionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tipoCategoriaCapacitacionModalLabel"><i
                        class="mr-2 fas fa-cogs"></i>Agregar Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                            <label for="nombre">Nombre: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                id="nombre_cat_cap" aria-describedby="nombre" wire:model.defer="nombre"
                                value="{{ old('nombre') }}" autocomplete="off">
                            <small>Ingresa el nombre de la categoría</small>
                            @if ($errors->has('nombre'))
                                <span class="invalid-feedback">{{ $errors->first('nombre') }}</span>
                            @endif
                            <span class="text-danger nombre_error error-ajax"></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn_cancelar" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" wire:click.prevent="save">Guardar</button>
            </div>
        </div>
    </div>
</div>
