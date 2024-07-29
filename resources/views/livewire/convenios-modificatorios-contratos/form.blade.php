<link rel="stylesheet" type="text/css" href="{{ asset('css/iconos.css') }}{{config('app.cssVersion')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/letra.css') }}{{config('app.cssVersion')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/titulos.css') }}{{config('app.cssVersion')}}">


<section id="form_entregable">
    <div>
        <!-- No Contrato Field -->
        <input wire:model.live="contrato_id" type="hidden" value="{{ $contrato_id }}">

        <!-- Area Field -->
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-6">
                Nombre del Convenio<font class="asterisco">*</font>
                <input type="text" maxlength="250" wire:model.live.debounce.800ms="no_convenio" class="form-control">
                @error('no_convenio')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="distancia form-group col-md-6" wire:ignore>
                Fecha del Convenio:<font class="asterisco">
                    *</font>
                <input type="date" wire:model.live.debounce.800ms="fecha" min="1945-01-01" class="form-control" required>
                @error('fecha')
                    <span class="red-text" style="margin-left: 9px">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="input-field form-group col-md-6">
            @if (is_null($organizacion))
            @else
                <div class="custom-file">
                    {{-- <div class="btn"> --}}
                    <span>PDF</span>
                    <input class="form-control" type="file" wire:model.live.debounce.800ms="convenios_file" accept=".pdf"
                        id="upload {{ $iteration }}" readonly>
                    {{-- </div> --}}
                    {{-- <div class="file-path-wrapper">
                        <input class="file-path validate" wire:model.live.debounce.800ms="convenios_file"
                            placeholder="Elegir convenio pdf" readonly>
                    </div> --}}
                </div>
            @endif


            <div wire:loading wire:target="convenios_file" class="s-12">
                <div class="progress">
                    <div class="indeterminate"></div>
                </div>
                <div>Cargando archivo</div>
            </div>
            <div class="ml-4 display-flex">
                <label class="red-text">{{ $errors->first('Type') }}</label>
                @error('convenios_file')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="input-field distancia form-group col-md-12">
            Descripción
            <textarea wire:model.live.debounce.800ms="descripcion" id="textarea1" style="padding:15px;" class="form-control"></textarea>
            @error('descripcion')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        Inputmask.extendAliases({
            pesos: {
                prefix: "$ ",
                groupSeparator: ".",
                alias: "numeric",
                placeholder: "0",
                autoGroup: true,
                digits: 2,
                digitsOptional: false,
                clearMaskOnLostFocus: false
            }
        });
        $(".deductiva_penalizacion").inputmask({
            alias: "currency",
            prefix: '$'
        });

        $('.deductiva_penalizacion').on('change', function(e) {
            @this.set('deductiva_penalizacion', e.target.value);
        });
    });
</script>
<script>
    window.addEventListener('contentChanged', event => {
        //Datepicker
        $('.datepicker').datepicker({
            firstDay: true,
            format: 'dd-mm-yyyy',
            i18n: {
                cancel: 'Cancelar',
                clear: 'Limpar',
                done: 'Ok',
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
                    "Septiembre", "Octubre", "Noviembre", "Diciembre"
                ],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct",
                    "Nov", "Dic"
                ],
                weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
            },
            //autoclose: false
        });
        //select
        $('select').formSelect();
        //M.AutoInit();
    });
</script>
