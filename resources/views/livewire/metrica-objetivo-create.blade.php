<div wire:ignore.self class="modal fade" id="metricaObjetivoModal" tabindex="-1"
    aria-labelledby="metricaObjetivoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="metricaObjetivoModalLabel"><i class="mr-2 fas fa-cogs"></i>Agregar métrica
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                            <label for="definicion">Definición: <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control {{ $errors->has('definicion') ? 'is-invalid' : '' }}"
                                id="definicion" aria-describedby="definicion" wire:model="definicion"
                                value="{{ old('definicion') }}" autocomplete="off">
                            <small>Ingresa la definición de la metrica del objetivo</small>
                            @if ($errors->has('definicion'))
                                <span class="invalid-feedback">{{ $errors->first('definicion') }}</span>
                            @endif
                            <span class="text-danger definicion_error error-ajax"></span>
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
