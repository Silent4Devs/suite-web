<div wire:ignore.self class="modal fade" id="origenCambioModal" tabindex="-1" aria-labelledby="origenCambioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="origenCambioModalLabel"><i class="fas fa-handshake iconos-crear"></i>Agregar
                   Control de Origen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                            <label>Origen del cambio <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                id="nombre" aria-describedby="nombre" wire:model.defer="nombre"
                                value="{{ old('nombre') }}" autocomplete="off">
                            @error('nombre')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" 
                                wire:model.defer="descripcion">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('OrigenCambioStore', () => {
            console.log('OrigenCambioStore');
            $('#origenCambioModal').modal('hide');
            document.querySelector('.modal-backdrop').style.display = 'none'
            document.getElementById('nombre').value = null
            document.getElementById('descripcion').value = null
        });
    })
</script>
