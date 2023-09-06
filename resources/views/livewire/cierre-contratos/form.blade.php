<section id="form_cierre">
    <div>
        <!-- No Contrato Field -->
        <input wire:model="contrato_id" type="hidden" value="{{ $contrato_id }}">
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-12">
                <label for="" class="txt-tamaño"><i class="fas fa-clipboard-check iconos-crear"></i>Aspecto
                    validación de cierre<font class="asterisco">*</font></label>
                <input type="text" wire:model.debounce.800ms="aspectos" class="form-control" required>
                @error('aspectos')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-6">
                <label for="" class="txt-tamaño"><i class="fas fa-thumbs-down iconos-crear"></i>Cumple<font
                        class="asterisco">*</font></label>
                <br>
                <div class="switch">
                    <label>
                        <input type="checkbox" name="cumple" wire:model.debounce.800ms="cumple">
                        <span class="lever"></span>
                        Si
                    </label>
                </div>
            </div>
            <div class="distancia form-group col-md-6">
                <label for="" class="txt-tamaño"><i class="fas fa-search iconos-crear"></i>Observaciones<font
                        class="asterisco">*</font></label>
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
