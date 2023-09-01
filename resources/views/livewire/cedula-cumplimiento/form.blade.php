<section id="form_cedula">
    <div>
        <input wire:model.debounce.800ms="contrato_id" type="hidden" value="{{ $contrato_id }}">
        <div class="row" style="margin: 0; padding-top: 10px">
            <span style="padding-left: 5px; font-size: 16px">
                <p class="grey-text" style="font-size:17px;font-weight:bold;">Periodo de ampliación del contrato</p>
            </span>
        </div>
            <!-- Administrador Field -->

        <div class="col s12 m6 distancia">
            <label for="" class="txt-tamaño"><i class="fas fa-user iconos-crear"></i>Elaboró el análisis<font class="asterisco">*</font></label>
            <input type="text" wire:model.debounce.800ms="elaboro" class="form-control">

            @error('elaboro') <span class="red-text" style="margin-left: 5px">{{ $message }}</span>
            @enderror
        </div>

        <div class="col s12 m6 distancia">
            <label for="" class="txt-tamaño"><i class="fas fa-user iconos-crear"></i>Revisó los resultados<font class="asterisco">*</font></label>
            <input type="text" wire:model.debounce.800ms="reviso" class="form-control">
            @error('reviso') <span class="red-text" style="margin-left: 5px">{{ $message }}</span>
            @enderror
        </div>

        <div class="col s12 m6 distancia">
            <label for="" class="txt-tamaño"><i class="fas fa-user iconos-crear"></i>Autorizó la cédula<font class="asterisco">*</font></label>
            <input type="text" wire:model.debounce.800ms="autorizo" class="form-control">
            @error('autorizo') <span class="red-text" style="margin-left: 5px">{{ $message }}</span>
            @enderror
        </div>


        <div class="col s12 m6 distancia">
            <label for="" class="txt-tamaño"><i class="fas fa-user iconos-crear"></i>Cumple<font class="asterisco">*</font></label>
            <div class="switch">
                <label>
                    No
                    <input type="checkbox" name="cumple" wire:model.debounce.800ms="cumple">
                    <span class="lever"></span>
                    Si
                </label>
            </div>
        </div>
    </div>
</section>

<script>
    // $('#cumple').on('change', function(
    //     e) { // mantienen el valor del input al enviar con livewire
    //     @this.set('cumple', e.target.value);
    // });
    $(document).ready(function() {
        // $('#cumple').on('change', function(
        //     e) { // mantienen el valor del input al enviar con livewire
        //     @this.set('cumple', e.target.value);
        // });

        window.addEventListener('cedulaEventChanged', event => {
            //Datepicker
            //console.log("Evento");
            $('.collapsible').collapsible();
            //$('.modal').modal();
            // $('.select-dropdown').formSelect();
        });

    });

</script>
