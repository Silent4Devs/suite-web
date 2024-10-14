<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="row">
        <div class="form-group col-md-4">
            <label for="no_contrato" class="txt-tamaño">Tipo
                Cambio
                <font class="asterisco">*
                </font>
            </label>

            <div id="contenedor_dolares">
                <select name="tipo_cambio" wire:model.live="tipo_cambio" id="tipo_cambio"
                {{-- id="dolares_filtro" --}}
                 class="form-control" required>
                    <option value="">Seleccione una moneda</option>
                    @foreach ($divisas as $key => $divisa)
                        <option value='{{ $divisa }}'>{{ $divisa }}</option>
                    @endforeach
                </select>

                @if ($errors->has('tipo_cambio'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('tipo_cambio') }}
                    </div>
                @endif
            </div>
        </div>

        @if ($moneda_extranjera)
            <div class="form-group col-md-4">
                <label for="valor_dolar" class="txt-tamaño">
                    Valor de la moneda (a día de hoy)
                </label>
                <input class="form-control" type="number" step=".01" name="valor_dolar" id="valor_dolar" wire:model="valor_moneda" wire:change="valorManual($event.target.value)"
                    @if (!$edit_moneda)
                        disabled
                    @endif>
            </div>
            <div class="form-group col-md-4 d-flex align-items-center">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="edit_moneda" id="edit_moneda" wire:model.live="edit_moneda">
                    <label class="form-check-label" for="edit_moneda" style="font-size:16px;">
                        Ingresar valor de la moneda manualmente.
                    </label>
                </div>
            </div>
        @endif
    </div>

    @if ($moneda_extranjera)
        {{-- <div id="campos_dolares" class="{{ $contratos->tipo_cambio == 'USD' ? '' : 'd-none' }}">--}}
        <div class="col l12 m12 s12">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="monto_dolares" class="txt-tamaño">
                                Monto de
                                pago ({{$tipo_cambio}})
                            </label>
                            <input type="number" wire:model="monto_dolares" name="monto_dolares" wire:change="convertirME($event.target.value,'monto')" id="monto_dolares" class="form-control" step=".01">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="maximo_dolares" class="txt-tamaño">
                                Monto
                                Máximo ({{$tipo_cambio}})
                            </label>
                            <input type="number" wire:model="maximo_dolares" name="maximo_dolares" wire:change="convertirME($event.target.value,'maximo')" id="dolar_maximo" class="form-control" step=".01">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="minimo_dolares" class="txt-tamaño">
                                Monto
                                Mínimo ({{$tipo_cambio}})
                            </label>
                            <input type="number" wire:model="minimo_dolares" name="minimo_dolares" wire:change="convertirME($event.target.value,'minimo')" id="dolar_minimo" class="form-control" step=".01">
                        </div>
                    </div>
        </div>
    @endif

    <div class="row" style="margin-top: 20px; margin-left: 10px; margin-right: 10px;">
        <div class="form-group col-md-4">
            <label for="monto_pago" class="txt-tamaño">Monto de
                Pago M.X.N.<font class="asterisco">*</font></label>
                <input type="number" name="monto_pago" wire:model.live="monto_pago" class="form-control" step=".01" required>
            @if ($errors->has('monto_pago'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('monto_pago') }}
                </div>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label for="maximo" class="txt-tamaño">Monto
                máximo
                M.X.N.<font class="asterisco">*</font></label>
                <input type="number" name="maximo" wire:model.live="maximo" class="form-control" step=".01" required>
        </div>
        <div class="form-group col-md-4">
            <label for="minimo" class="txt-tamaño">Monto
                mínimo
                M.X.N.<font class="asterisco">*</font></label>
                <input type="number" name="minimo" wire:model.live="minimo" class="form-control" step=".01" required>
        </div>
    </div>
</div>
