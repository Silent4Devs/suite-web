<div wire:ignore.self class="modal fade" id="tipoCompetenciaModal" tabindex="-1"
aria-labelledby="tipoCompetenciaModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="tipoCompetenciaModalLabel"><i class="fas fa-handshake iconos-crear"></i>Agregar Servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="form-group">
                        <label for="servicio">Nombre del servicio: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('servicio') ? 'is-invalid' : '' }}"
                            id="servicio" aria-describedby="servicio" wire:model="servicio"
                            value="{{ old('servicio') }}" autocomplete="off">
                        <small>Ingresa el nombre del servicio</small>
                        @if ($errors->has('servicio'))
                            <span class="invalid-feedback">{{ $errors->first('servicio') }}</span>
                        @endif
                        <span class="text-danger nombre_error error-ajax"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12">
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                            id="descripcion" wire:model="descripcion">{{ old('descripcion') }}</textarea>
                        <small>Ingresa la descripción del servicio</small>
                        @if ($errors->has('descripcion'))
                            <div class="invalid-feedback">{{ $errors->first('descripcion') }}</div>
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



<script>
    document.addEventListener('DOMContentLoaded', function(){
        Livewire.on('servicioStore',()=>{
        console.log('servicioStore');
        $('#tipoCompetenciaModal').modal('hide');
        document.querySelector('.modal-backdrop').style.display='none'
        document.getElementById('servicio').value=null
        document.getElementById('descripcion').value=null
         });
    })

</script>
