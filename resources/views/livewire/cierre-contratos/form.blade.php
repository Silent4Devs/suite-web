<section id="form_cierre">
    <div>
        <!-- No Contrato Field -->
        <input wire:model="contrato_id" type="hidden" value="{{ $contrato_id }}">
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-8">
                <label for="" class="txt-tamaño">Aspecto validación de cierre<font class="asterisco">*</font>
                </label>
                <input type="text" maxlength="250" wire:model.debounce.800ms="aspectos" class="form-control"
                    required>
                @error('aspectos')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="distancia form-group col-md-4">
                <label for="" class="txt-tamaño">Cumple<font class="asterisco">*</font></label>
                <br>
                <div class="custom-control custom-switch">
                    <input type="checkbox" wire:model.lazy="cumple" class="custom-control-input" id="cumple"
                        name="cumple">
                    <label class="custom-control-label" for="cumple">No/Sí</label>
                </div>
                {{-- <div class="switch">
                    <label>
                        <input type="checkbox" name="cumple" wire:model.debounce.800ms="cumple">
                        <span class="lever"></span>
                        Si
                    </label>
                </div> --}}
            </div>
        </div>
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-12">
                <label for="" class="txt-tamaño">Observaciones<font class="asterisco">*</font></label>
                <textarea style="padding:15px;" type="text" wire:model.debounce.800ms="observaciones" class="form-control"></textarea>
                @error('observaciones')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
        </div>
</section>
<script>
    window.addEventListener('contentChanged', event => {

    });
</script>
