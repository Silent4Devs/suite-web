    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/letra.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/titulos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/iconos.css') }}"> --}}

    <style>
        .iconos-crear {
            font-size: 20pt;
            margin-right: 18px;
        }
    </style>
    <section id="form_factura">
        <div>
            <!-- No Contrato Field -->
            <input wire:model.defer="contrato_id" type="hidden" value="{{ $contrato_id }}">
            <div class="row" style="margin-left: 10px;margin-right: 10px;">
                <div class="distancia form-group col-md-6">
                    <label for="no_contrato" class="txt-tamaño">No.
                        factura<font class="asterisco">*</font></label>
                    <input type="text" maxlength="50" wire:model.defer="no_factura" class="form-control" required>
                    @error('no_factura')
                        <span class="red-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="distancia form-group col-md-6" wire:ignore>
                    {{-- Monto Factura --}}
                    <label for="no_contrato" class="txt-tamaño">Monto
                        factura<font class="asterisco">*</font></label>
                    <input type="number" min="0" wire:model.defer="monto_factura" id="monto_factura"
                        class="form-control" required>
                    @error('monto_factura')
                        <span class="red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row" style="margin-left: 10px;margin-right: 10px;">
                <!-- Fechas-->

                <div class="distancia form-group col-md-4">
                    <div wire:ignore>
                        <label for="no_contrato" class="txt-tamaño">Fecha
                            recepción<font class="asterisco">*
                            </font></label>
                        <input id="" type="date" min="1945-01-01" wire:model.defer="fecha_recepcion"
                            class="form-control" style="margin-bottom: 0" required>
                    </div>
                    @error('fecha_recepcion')
                        <span class="red-text" style="margin-left: 9px">{{ $message }}</span>
                    @enderror
                </div>

                <div class="distancia form-group col-md-4">
                    <div wire:ignore>
                        <label for="no_contrato" class="txt-tamaño">Fecha
                            liberación<font class="asterisco">*
                            </font></label>
                        <input id="" type="date" min="1945-01-01" wire:model.defer="fecha_liberacion"
                            class="form-control" style="margin-bottom: 0" required>
                    </div>
                    @error('fecha_liberacion')
                        <span class="red-text" style="margin-left: 9px">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row" style="margin-left: 10px;margin-right: 10px;">
                {{-- Concepto --}}
                <div class="distancia form-group col-md-12">
                    <label for="no_contrato" class="txt-tamaño">Concepto
                        <font class="asterisco">*</font>
                    </label><br>
                    <textarea class="form-control" wire:model.defer="concepto" required></textarea>
                    @error('concepto')
                        <span class="red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            {{-- <div class="col s12 m4">
                        <div  class="input-field col s12">
                            <small>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;"><i
                                        class="fas fa-file-invoice iconos-crear"></i>Estatus<font class="asterisco">*
                                    </font>
                                </p>
                            </small>
                            <select id="estatus" name="estatus" wire:model.debounce.800ms="estatus" class="form-control select_ajax_live estatus"
                                style="margin-bottom: 0px">
                                <option value="" disabled selected>Elige una opción</option>
                                <option value="recibido">Recibido</option>
                                <option value="progreso">Progreso</option>
                                <option value="pagada">Pagada</option>
                            </select>
                        </div>
                        @error('estatus') <span class="red-text" style="margin-left: 9px">{{ $message }}</span>
                        @enderror
                    </div> --}}
            <!-- Estatus Field -->
            <div class="input-field form-group col-md-6" wire:ignore>
                <div class="custom-file">
                    {{-- <div class="btn"> --}}
                    <span>PDF</span>
                    <input class="form-control" type="file" wire:model.defer="pdf" accept=".pdf"
                        id="upload{{ $iteration }}" readonly>
                    {{-- </div> --}}
                    {{-- <div class="file-path-wrapper">
                        <input class="file-path validate" wire:model.defer="pdf" placeholder="Elegir factura pdf"
                            readonly>
                    </div> --}}
                </div>

                <div wire:loading wire:target="pdf" class="s-12">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                    <div>Cargando archivo</div>
                </div>
                <div class="ml-4 display-flex">
                    <label class="red-text">{{ $errors->first('Type') }}</label>
                    @error('pdf')
                        <span class="red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="input-field form-group col-md-6" wire:ignore>
                <div class="custom-file">
                    {{-- <div class="btn"> --}}
                    <span>XML</span>
                    <input type="file" class="form-control" wire:model.defer="xml" accept="text/xml"
                        id="upload{{ $iteration1 }}" readonly>
                    {{-- </div> --}}
                    {{-- <div class="file-path-wrapper">
                        <input class="file-path validate" wire:model.defer="xml" placeholder="Elegir factura xml"
                            readonly>
                    </div> --}}
                </div>
                <div wire:loading wire:target="xml">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                    <div>Cargando archivo</div>
                </div>
                <div class="ml-4 display-flex">
                    <label class="red-text">{{ $errors->first('Type') }}</label>
                    @error('xml')
                        <span class="red-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        {{-- <div class="row">
                    <div  class="input-field col s12 m4">
                        <small>
                            <p class="grey-text" style="font-size:17px;font-weight:bold;"><i
                                    class="fas fa-thumbs-down iconos-crear"></i>
                                Cumple<font
                                    class="asterisco">
                                    *</font>
                            </p>
                        </small>
                        <br>
                        <div class="switch">
                            <label>
                                No
                                <input type="checkbox" id="cumple" name="cumple" wire:model.debounce.800ms="cumple">

                                <span class="lever"></span>
                                Si
                            </label>
                        </div>
                    </div>
                    <!-- Revisiones -->
                    <div class="input-field col s12 m4">
                        <small>
                            <p class="grey-text" style="font-size:17px;font-weight:bold;"><i
                                    class="fas fa-clipboard-list iconos-crear"></i>No. revisiones<font
                                    class="asterisco">* </font>
                            </p>
                        </small> <input type="number"wire:model.debounce.800ms="no_revisiones" class="form-control" min="0">
                        @error('no_revisiones') <span class="red-text">{​​{​​ $message }​​}​​</span> @enderror
                    </div>
                    <div class="input-field col s12 m4">
                        <small>
                            <p class="grey-text" style="font-size:17px;font-weight:bold;"><i
                                    class="fas fa-clipboard-list iconos-crear"></i>No de CXL
                            </p>
                        </small> <input type="number" wire:model.debounce.800ms="n_cxl" class="form-control" min="0">
                        @error('n_cxl') <span class="red-text">{​​{​​ $message }​​}​​</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <div  class="input-field col s12 m6">
                            <small>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">
                                    Posee la leyenda de conformidad al final de la factura
                                </p>
                            </small>
                            <br>
                            <div class="switch">
                                <label>
                                    No
                                    <input type="checkbox" id="conformidad" name="conformidad" wire:model.debounce.800ms="conformidad">

                                    <span class="lever"></span>
                                    Si
                                </label>
                            </div>
                    </div>
                    <div  class="input-field col s12 m6">
                            <small>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">
                                    Posee la firma autógrafa del Supervisor y/o Administrador del contrato
                                </p>
                            </small>
                            <br>
                            <div class="switch">
                                <label>
                                    No
                                    <input type="checkbox" id="firma" name="firma" wire:model.debounce.800ms="firma">

                                    <span class="lever"></span>
                                    Si
                                </label>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12">
                        <small>
                            <p class="grey-text" style="font-size:17px;font-weight:bold;"><i
                                    class="fas fa-search iconos-crear"></i>Hallazgos / Comentarios</p>
                        </small>
                        <textarea style="padding:15px;" type="text" maxlength="255" wire:model.debounce.800ms="hallazgos_comentarios"
                            class="text_area"></textarea>
                        @error('hallazgos_comentarios') <span class="red-text">{{ $message }}</span> @enderror
                    </div>
                </div> --}}



        <!--row-->

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

            $("#monto_factura").inputmask({
                alias: "currency",
                prefix: '$'
            });

            $('select[name="estatus"]').on('change', function(
                e) { // mantienen el valor del input al enviar con livewire
                @this.set('estatus', e.target.value);
            });

            $('#monto_factura').on('change', function(e) {
                @this.set('monto_factura', e.target.value);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('.fechas').datepicker({
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
                    weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes",
                        "Sábado"
                    ],
                    weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
                },
                //autoclose: false
            });
        })
        window.addEventListener('contentChanged', event => {
            //Datepicker
            $('.fechas').datepicker({
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
                    weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes",
                        "Sábado"
                    ],
                    weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
                },
                //autoclose: false
            });
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
                    weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes",
                        "Sábado"
                    ],
                    weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
                },
                //autoclose: false
            });
            //select
            // $('.estatus').formSelect();
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
            //M.AutoInit();
            //@this.set('cumple', true);

            //@this.set('no_revisiones', 0);
        });

        /* window.addEventListener('cumple', event => {
             $toggle('cumple')
         });*/

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
