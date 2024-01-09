<link rel="stylesheet" type="text/css" href="{{ asset('css/letra.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/titulos.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/iconos.css') }}">


<style type="text/css">
    .nav_contratos {
        background: linear-gradient(104deg, rgba(0, 188, 214, 1) 38%, rgba(0, 214, 194, 1) 100%) !important;
        width: 95%;
        border-bottom-right-radius: 100px;
        border-top-right-radius: 100px;
        color: #fff !important;
        box-shadow: 4px 4px 8px -2px rgba(0, 0, 0, 0.5);
    }

    .nav_contratos .material-icons {
        color: #fff !important;
    }


    body.tema3 .nav_contratos {
        background: rgba(0, 0, 0, 0.6) !important;
    }

    body.tema3 .nav_contratos .material-icons {
        color: #fff !important;
    }

    body.tema4 .nav_contratos {
        background: #dfdfdf !important;
        box-shadow: 0px 0px 0px 0px #fff !important;
    }
</style>

<section id="form_evaluacion">
    <div>
        <!-- No Contrato Field -->
        <input wire:model.live="nivel_id" type="hidden" value="{{ $nivel_id }}">
        <div class="mb-4 row">
            <!-- Nombre Servicio Field -->
            @if (!is_null($evaluacion_props))
                <div class="row">
                    <p style="font-size: 16px; margin-left: 20px">Evaluación seleccionada con la fecha: <i
                            class="fas fa-calendar-alt"
                            style="padding: 0 5px 0 10px"></i><span>{{ date('d-m-Y', strtotime($evauacion_props['fecha'])) }}</span>
                    </p>
                </div>
            @endif
        </div>
        <div class="row">
            <div wire:ignore class="input-field col s12 m4">
                <small class="grey-text" style="font-size:17px;font-weight:bold;">Fecha<font class="asterisco">*</font>
                    </small>
                <input type="date" wire:model.live.debounce.800ms="fecha" class="form-control" min="1945-01-01" required>
                @error('fecha')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field col s12 m4" style="margin-left: 15px">
                <small class="grey-text" style="font-size:17px;font-weight:bold;">SLA Alcanzado<font class="asterisco">*
                    </font></small>
                <input type="number" wire:model.live.debounce.800ms="resultado" class="form-control" min="0"
                    max="{{ is_null($evauacion_props) ? 0 : $evauacion_props['meta'] }}" required>
                @error('resultado')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!--row-->
    </div>
    </div>
</section>

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
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems, options);
        });

    });

    //Script dinamico para formulario select
    $(document).ready(function() {
        $("select").change(function() {
            $(this).find("option:selected").each(function() {
                var optionValue = $(this).attr("value");
                if (optionValue) {
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else {
                    $(".box").hide();
                }
            });
        }).change();
    });
</script>
