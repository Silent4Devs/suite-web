{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/iconos.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/letra.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/titulos.css') }}"> --}}


<section id="form_entregable">
    <div>
        <!-- No Contrato Field -->
        <input wire:model="contrato_id" type="hidden" value="{{ $contrato_id }}">
        {{-- <div class="mb-4 row"> --}}
        <!-- Area Field -->
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-6">
                <label for="" class="txt-tamaño"><i class="fas fa-paste iconos-crear"></i>Nombre entregable
                    <font class="asterisco">*</font>
                </label>
                <input type="text" wire:model.debounce.800ms="nombre_entregable" class="form-control" required>
                @error('nombre_entregable')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="distancia form-group col-md-6">
                <label for="" class="txt-tamaño"><i class="fas fa-file-alt iconos-crear"></i>Descripción
                    <font class="asterisco">*</font>
                </label>
                <textarea wire:model.debounce.800ms="descripcion" style="padding:15px;" class="form-control" required></textarea>
                @error('descripcion')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-4">
                <div wire:ignore>
                    <label for="" class="txt-tamaño"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha
                        entrega inicial<font class="asterisco">*</font></label>
                    <input type="date" wire:model.defer="plazo_entrega_inicio" class="form-control" min="1945-01-01"
                        required>
                </div>
                @error('plazo_entrega_inicio')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="distancia form-group col-md-4">
                <div wire:ignore>
                    <label for="" class="txt-tamaño"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha
                        entrega final<font class="asterisco">*</font></label>
                    <input type="date" wire:model.defer="plazo_entrega_termina" class="form-control" min="1945-01-01"
                        required>
                </div>
                @error('plazo_entrega_termina')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="distancia form-group col-md-4">
                <div wire:ignore>
                    <label for="" class="txt-tamaño"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha
                        entrega real<font class="asterisco">*</font></label>
                    <input type="date" wire:model.fechas="entrega_real" class="form-control" min="1945-01-01"
                        required>
                </div>
                @error('entrega_real')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-4">
                <label for="" class="txt-tamaño"><i class="fas fa-thumbs-down iconos-crear"></i>
                    <i class="fas fa-thumbs-up iconos-crear" style="margin-left:2px;"></i>Cumple<font class="asterisco">
                        *</font></label>
                <div class="switch">
                    <label class="grey-text letra-ngt">
                        Si
                        <input type="checkbox" name="cumplimiento" class="cumplimiento form-control"
                            wire:model.debounce.800ms="cumplimiento" required>
                        <span class="lever"></span>
                    </label>
                </div>
            </div>
            <div class="distancia form-group col-md-4">
                <label for="" class="txt-tamaño"><i class="fas fa-file iconos-crear"></i>Factura Relacionada
                    <font class="asterisco">*</font>
                </label>
                <select name="factura_id" id="factura_id" class="form-control" wire:model.defer="factura_id" required>
                    <option value="">Sin factura</option>
                    @foreach ($facturas_entregables as $facturas)
                        }
                        <option value="{{ $facturas->id }}">{{ $facturas->no_factura }}</option>
                    @endforeach
                </select>
                @error('factura_id')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>

            <!--row-->
        </div>
        <!-- Nombre Servicio Field -->
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-6">
                <label for="" class="txt-tamaño"><i class="fas fa-calendar-alt iconos-crear"></i>Observaciones
                    <font class="asterisco">*</font>
                </label><br>
                <textarea wire:model.debounce.800ms="observaciones" style="padding:15px;" class="form-control" required></textarea>
                @error('observaciones')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
            <div class="distancia form-group col-md-6" wire:ignore>

                @if (is_null($organizacion))
                @else
                    <div class="file-field input-field">
                        <div class="btn" style="margin-right: 8px">
                            <span>DOCUMENTO</span>
                            <input class="input_file_validar" type="file" wire:model="pdf"
                                accept="{{ $organizacion ? $organizacion->formatos : '.docx,.pdf,.doc,.xlsx,.pptx,.txt' }}"
                                id="upload{{ $iteration1 }}" class="input_file_validar">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" wire:model="pdf" placeholder="Elegir factura" readonly>
                        </div>
                    </div>
                @endif
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

                {{-- @if ($document_entregable)
                        <a href="{{ asset('storage/contratos/' . $contrato->id . '_contrato_' . $contrato->no_contrato . '/entregables/pdf/' . $document_entregable) }}" target="_blank" class=" descarga_archivo" style="margin-left:20px;">
                            <i class="fas fa-file-download iconos-crear"></i> Descargar
                        </a>
                    @endif --}}
            </div>

            <div class="input-field col l12 m12 s12" x-data="{ show: @entangle('aplica_deductiva') }">
                <div class="distancia form-group col-md-6" wire:ignore>
                    <label for="" class="txt-tamaño"><i class="fas fa-clipboard iconos-crear"></i>¿Aplica
                        deductiva/penalización?<font class="asterisco">*</font></label>
                    Si
                    <div class="switch">
                        <label class="grey-text letra-ngt">
                            <input type="checkbox" class="aplica_deductiva form-control"
                                wire:model="aplica_deductiva" @change="show = !show">
                            <span class="lever"></span>
                        </label>
                    </div>
                </div>
                <div class="distancia form-group col-md-6" x-show="show">
                    <div class="distancia form-group col-md-12">
                        <label for="" class="txt-tamaño"><i class="fas fa-calendar-alt iconos-crear"></i>¿Por
                            qué aplica la
                            Deductiva/Penalización?<font class="asterisco">*</font></label>
                        <textarea wire:model.debounce.800ms="justificacion_deductiva_penalizacion" style="padding:15px;" class="form-control"
                            required></textarea>
                        @error('justificacion_deductiva_penalizacion')
                            <span class="red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="distancia form-group col-md-12">
                        <label for="" class="txt-tamaño">Monto Deductiva/Penalización</label>
                        <input type="text" wire:model.debounce.800ms="deductiva_penalizacion"
                            class="form-control deductiva_penalizacion">
                        @error('deductiva_penalizacion')
                            <span class="red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="distancia form-group col-md-12">
                        <label for="" class="txt-tamaño"><i class="fas fa-file iconos-crear"></i>Factura
                            Relacionada<font class="asterisco">*</font></label>
                        <select name="deductiva_factura_id" id="deductiva_factura_id" class="form-control"
                            wire:model.defer="deductiva_factura_id">
                            <option value="">Sin factura</option>
                            @foreach ($facturas_entregables as $facturas)
                                }
                                <option value="{{ $facturas->id }}">{{ $facturas->no_factura }}</option>
                            @endforeach
                        </select>
                        @error('deductiva_factura_id')
                            <span class="red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="distancia form-group col-md-12">
                        <label for="" class="txt-tamaño"><i class="far fa-credit-card iconos-crear"></i>Nota
                            de crédito<font class="asterisco">*</font></label>
                        <input type="text" wire:model.debounce.800ms="nota_credito" class="form-control">
                        @error('nota_credito')
                            <span class="red-text">{{ $message }}</span>
                        @enderror
                        </divclass=>
                    </div>
                </div>


            </div>
        </div>
</section>
<script>
    $(document).ready(function() {
        // window.initSelect2=()=>{
        //     $('#facturas').select2({width:'resolve'});
        // }
        // window.livewire.on('select2',()=>{
        //     console.log('hola');
        //     initSelect2();
        // })
        // $('#factura_id').select2('destroy');
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
{{-- <script>
    document.addEventListener('DOMContentLoaded', ()=>{
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

</script> --}}
