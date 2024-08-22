    <div class="row" style="margin: 0; padding-top: 10px">
        <span style="padding-left: 5px; font-size: 16px">
            <p class="grey-text" style="font-size:17px;font-weight:bold;">Periodo de ampliación del contrato</p>
        </span>
        <div>
            <input wire:model.live.debounce.800ms="contrato_id" type="hidden" value="{{ $contrato_id }}">
            <!-- Administrador Field -->
        </div>
    </div>
    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="distancia form-group col-md-6">
            <label for="" class="txt-tamaño">Elaboró el análisis
                <font class="asterisco">*</font>
            </label>
            <input type="text" maxlength="200" wire:model.live.debounce.800ms="elaboro" class="form-control">

            @error('elaboro')
                <span class="red-text" style="margin-left: 5px">{{ $message }}</span>
            @enderror
        </div>

        <div class="distancia form-group col-md-6">
            <label for="" class="txt-tamaño">Revisó los resultados
                <font class="asterisco">*</font>
            </label>
            <input type="text" maxlength="200" wire:model.live.debounce.800ms="reviso" class="form-control">
            @error('reviso')
                <span class="red-text" style="margin-left: 5px">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="distancia form-group col-md-6">
            <label for="" class="txt-tamaño">Autorizó la cédula<font class="asterisco">*</font></label>
            <input type="text" maxlength="200" wire:model.live.debounce.800ms="autorizo" class="form-control">
            @error('autorizo')
                <span class="red-text" style="margin-left: 5px">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <div class="distancia form-group col-md-6">
                <label for="" class="txt-tamaño">Cumple<font class="asterisco">*</font></label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" wire:model.live="cumple_cedula" class="custom-control-input" id="cumple_cedula"
                        name="cumple_cedula">
                    <label class="custom-control-label" for="cumple_cedula">No/Sí</label>
                </div>
                {{-- <label for="" class="txt-tamaño">Cumple<font class="asterisco">*</font></label>
            <div class="switch">
                <label>
                    No
                    <input type="checkbox" name="cumple" wire:model.live.debounce.800ms="cumple">
                    <span class="lever"></span>
                    Si
                </label>
            </div> --}}
            </div>
        </div>
    </div>

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
