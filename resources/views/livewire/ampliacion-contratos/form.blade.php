<section id="form_ampliacion">
    <div>
        <input wire:model="contrato_id" type="hidden" value="{{ $contrato_id }}">
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <span class="spsty">
                Periodo de ampliación del contrato
            </span>
        </div>
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div wire:ignore class="distancia form-group col-md-6">
                <!-- Administrador Field -->
                Fecha de inicio<span class="asterisco">*</span>
                <input type="date" min="1945-01-01" wire:model.debounce.800ms="fecha_inicio"
                    fecha-fin="{{ $fecha_fin_contrato }}" class="form-control fecha_inicio fechas_ampliacion"
                    onchange="this.dispatchEvent(new InputEvent('input'))" style="margin-bottom: 0">

                @error('fecha_inicio')
                    <span class="red-text" style="margin-left: 5px">{{ $message }}</span>
                @enderror
            </div>
            <div wire:ignore class="distancia form-group col-md-6">
                Fecha de fin<font class="asterisco">*</font>
                <input type="date" min="1945-01-01" wire:model.debounce.800ms="fecha_fin"
                    class="form-control fecha_fin fechas_ampliacion"
                    onchange="this.dispatchEvent(new InputEvent('input'))" style="margin-bottom: 0">
                @error('fecha_fin')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            @error('fecha_fin')
                <span class="red-text" style="margin-left: 5px">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        Importe de ampliación del contrato
    </div>
    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="distancia form-group col-md-6">
            Importe<font class="asterisco">*</font>
            <input type="number" wire:model.debounce.800ms="importe" class="form-control numero-mascara importe"
                required max="100000000000">
            @error('importe')
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

        $(".numero-mascara").inputmask({
            alias: "currency",
            prefix: '$'
        });

        $('.importe').on('change', function(e) {
            @this.set('importe', e.target.value);
        });

        $('.maximo').on('change', function(e) {
            @this.set('maximo', e.target.value);
        });
        putFechas();
    });

    function putFechas() {
        let fecha_fin_attr = $(".fecha_inicio").attr('fecha-fin');
        let fecha_fin = moment(fecha_fin_attr, "YYYY-MM-DD");
        //let fecha_inicio_ampliacion;

        $('.fechas_ampliacion').datepicker({
            firstDay: true,
            format: 'dd-mm-yyyy',
            i18n: {
                cancel: 'Cancelar',
                clear: 'Limpar',
                done: 'Ok',
                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
                    "Octubre", "Noviembre", "Diciembre"
                ],
                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov",
                    "Dic"
                ],
                weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
            },
            //autoclose: false
        });



        $(".fecha_inicio").change(function(e) {
            e.preventDefault();
            let fecha_seleccionada = moment(e.target.value, 'DD-MM-YYYY');
            let es_fecha_antes_fecha_fin = fecha_seleccionada.isBefore(fecha_fin);
            let es_fecha_igual_fecha_fin = fecha_seleccionada.isSame(fecha_fin);
            if (es_fecha_antes_fecha_fin) {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'La fecha de inicio de ampliación no puede ser anterior a la fecha de fin del contrato',
                });
                @this.set('fecha_inicio', "");
            } else if (es_fecha_igual_fecha_fin) {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'La fecha de inicio de ampliación no puede ser igual a la fecha de fin del contrato',
                });
                @this.set('fecha_inicio', "");
            } else {
                //fecha_inicio_ampliacion = fecha_seleccionada;
                @this.set('fecha_fin', "");
                @this.set('fecha_inicio', e.target.value);
            }
        });

        $(".fecha_fin").change(function(e) {
            e.preventDefault();
            let fecha_inicio_ampliacion = moment($('.fecha_inicio').val(), 'DD-MM-YYYY');
            let fecha_seleccionada = moment(e.target.value, 'DD-MM-YYYY');
            let es_fecha_antes_fecha_fin = fecha_seleccionada.isBefore(fecha_inicio_ampliacion);
            let es_fecha_igual_fecha_fin = fecha_seleccionada.isSame(fecha_inicio_ampliacion);
            if (es_fecha_antes_fecha_fin) {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'La fecha de fin de ampliación no puede ser anterior a la fecha de inicio de ampliación',
                });
                @this.set('fecha_fin', "");
            } else if (es_fecha_igual_fecha_fin) {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'La fecha de fin de ampliación no puede ser igual a la fecha de inicio de ampliación',
                });
                @this.set('fecha_fin', "");
            } else {
                @this.set('fecha_fin', e.target.value);
            }
        });
    }



    // window.addEventListener('contentChanged', event => {
    //     //Datepicker
    //     $('.datepicker').datepicker({
    //         firstDay: true,
    //          format: 'dd-mm-yyyy',
    //         i18n: {
    //             cancel: 'Cancelar',
    //             clear: 'Limpar',
    //             done: 'Ok',
    //             months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    //             monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct", "Nov", "Dic"],
    //             weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
    //             weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
    //             weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
    //         },
    //         //autoclose: false
    //     });
    //     //select
    //     // $('select').formSelect();
    //     //M.AutoInit();
    // });
</script>
