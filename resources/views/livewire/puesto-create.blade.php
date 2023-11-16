<div wire:ignore.self class="modal fade" id="PuestoModal" tabindex="-1" aria-labelledby="PuestoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #00a57e;color: white;">
                <h5 class="modal-title" id="PuestoModalLabel"><i class="mr-2 fas fa-plus-circle"></i>Agregar Puesto
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                            <label for="puesto">Puesto: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}"
                                id="puesto" aria-describedby="puesto" wire:model="puesto"
                                value="{{ old('puesto') }}" autocomplete="off">
                            <small>Ingresa el puesto del puesto</small>
                            @if ($errors->has('puesto'))
                                <span class="invalid-feedback">{{ $errors->first('puesto') }}</span>
                            @endif
                            <span class="text-danger puesto_error error-ajax"></span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                            <label for="descripcion">Descripción: </label>
                            <input type="text"
                                class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                id="descripcion" aria-describedby="descripcion" wire:model="descripcion"
                                value="{{ old('descripcion') }}" autocomplete="off">
                            <small>Ingresa el descripción del puesto</small>
                            @if ($errors->has('descripcion'))
                                <span class="invalid-feedback">{{ $errors->first('descripcion') }}</span>
                            @endif
                            <span class="text-danger descripcion_error error-ajax"></span>
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
