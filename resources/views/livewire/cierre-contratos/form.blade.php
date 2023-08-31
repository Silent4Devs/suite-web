<section id="form_cierre">
<div>
    <!-- No Contrato Field -->
    <input wire:model="contrato_id" type="hidden" value="{{$contrato_id}}">
    <div class="col s12 m12 distancia">
        <label for="" class="txt-tamaño"><i class="fas fa-clipboard-check iconos-crear"></i>Aspecto validación de cierre<font class="asterisco">*</font></label>
        <input type="text" wire:model.debounce.800ms="aspectos" class="form-control" required>
        @error('aspectos') <span class="red-text">{{ $message }}</span> @enderror
    </div>
    <div class="col s12 m12 distancia">
        <label for="" class="txt-tamaño"><i class="fas fa-thumbs-down iconos-crear"></i>Cumple<font class="asterisco">*</font></label>
        <br>
        <div class="switch">
            <label>
                No
                <input type="checkbox" name="cumple" wire:model.debounce.800ms="cumple">
                <span class="lever"></span>
                Si
            </label>
        </div>
    </div>
    <div class="col s12 m12 distancia">
        <label for="" class="txt-tamaño"><i class="fas fa-search iconos-crear"></i>Observaciones<font class="asterisco">*</font></label>
        <textarea style="padding:15px;" type="text" wire:model.debounce.800ms="observaciones" class="text_area"></textarea>
        @error('observaciones') <span class="red-text">{{ $message }}</span> @enderror
    </div>
</div>
</section>
<script>
    window.addEventListener('contentChanged', event => {

    });
</script>
