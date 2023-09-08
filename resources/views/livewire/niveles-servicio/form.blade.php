<section id="form_niveles">

    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="distancia form-group col-md-8">
            <label for="no_contrato" class="txt-tamaño">Nombre<font class="asterisco">*</font></label>
            <input type="text" maxlength="250" wire:model.debounce.800ms="nombre" class="form-control" required>
            @error('nombre')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
        <div class="distancia form-group col-md-4">
            <label for="no_contrato" class="txt-tamaño">Métrica<font class="asterisco">*</font></label>
            <input type="text" maxlength="250" wire:model.debounce.800ms="metrica" class="form-control" required>
            @error('metrica')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="distancia form-group col-md-6">
            <label for="no_contrato" class="txt-tamaño">Unidad<font class="asterisco">*</font></label>
            <input type="text" maxlength="250" wire:model.debounce.800ms="unidad" class="form-control" required>
            @error('unidad')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
        <div class="distancia form-group col-md-6">
            <label for="no_contrato" class="txt-tamaño">Área<font class="asterisco">*</font></label>
            <input type="text" maxlength="250" wire:model.debounce.800ms="area" class="form-control" required>
            @error('area')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="distancia form-group col-md-4">
            <label for="no_contrato" class="txt-tamaño">SLA comprometido<font class="asterisco">*</font></label>
            <input type="number" wire:model.debounce.800ms="meta" class="form-control" required step="0.1">
            @error('meta')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="distancia form-group col-md-4" wire:ignore>
            <label for="no_contrato" class="txt-tamaño">Periodo
                evaluación<font class="asterisco">*</font></label>
            <select class="browser-default form-control" name="periodo_evaluacion"
                wire:model.debounce.800ms="periodo_evaluacion" class="form-control" required>
                <option value="" disabled selected>Escoga una opción</option>
                <option value="0">Por definir</option>
                <option value="1">Unica vez</option>
                <option value="2">Diario</option>
                <option value="3">Semanal</option>
                <option value="4">Quincenal</option>
                <option value="5">Mensual</option>
                <option value="6">Bimestral</option>
                <option value="7">Trimestral</option>
                <option value="8">Semestral</option>
                <option value="9">Anual</option>
                <option value="10">Multianual</option>
            </select>
            @error('periodo_evaluacion')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="distancia form-group col-md-4">
            <label for="no_contrato" class="txt-tamaño">Revisiones
                <font class="asterisco">*</font>
            </label>
            <input id="revisiones_no" type="number" wire:model.debounce.800ms="revisiones" class="form-control"
                required>
            @error('revisiones')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="distancia form-group col-md-12">
            <label for="no_contrato" class="txt-tamaño">Descripción<font class="asterisco">*</font></label><br>
            <textarea wire:model.debounce.800ms="descripcion" id="textarea1" style="padding:15px;" class="form-control" required></textarea>
            @error('descripcion')
                <span class="red-text">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="distancia form-group col-md-12">
            <label for="no_contrato" class="txt-tamaño">Información<font class="asterisco">*</font></label><br>
            <textarea wire:model.debounce.800ms="info_consulta" id="textarea2" class="form-control" style="padding:15px;"
                required>
        </textarea>
            @error('info_consulta')
                <span class="red-text">{{ $message }}</span>
            @enderror

        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('select[name="periodo_evaluacion"]').on('change', function(
            e) { // mantienen el valor del input al enviar con livewire
            @this.set('periodo_evaluacion', e.target.value);
            if (e.target.value == -1) {
                @this.set('revisiones', 0);
                document.getElementById('revisiones_no').setAttribute('disabled', true);
            } else if (e.target.value == 1) {
                @this.set('revisiones', 1);
                document.getElementById('revisiones_no').setAttribute('disabled', true);
            } else {
                // @this.set('revisiones', null);
                document.getElementById('revisiones_no').removeAttribute('disabled')
            }
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
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems, options);
        });
        $('#periodo').formSelect();
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
