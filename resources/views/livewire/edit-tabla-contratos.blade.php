<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="col s12 m12">
        <div class="card">
            <div class="card-body blue-text" style="overflow-x:auto !important;">
                <h3>Contrato</h3>
                <table class="refresco table" id="tblContrato">
                    <thead style="overflow-x:auto !important;">
                        <tr>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">No. contrato</p>
                            </th>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Vigencia</p>
                            </th>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Fase</p>
                            </th>
                            <th>
                                @if ($contratos->tipo_cambio == 'USD')
                                    <p></p>
                                @else
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">IVA&nbsp;@for ($i = 0; $i < 20; $i++)
                                            &nbsp;
                                        @endfor
                                    </p>
                                @endif

                            </th>
                            <th>
                                @if ($contratos->tipo_cambio == 'USD')
                                    <p></p>
                                @else
                                    <p class="grey-text" style="font-size:17px;font-weight:bold;">Subtotal&nbsp;
                                        @for ($i = 0; $i < 20; $i++)
                                            &nbsp;
                                        @endfor
                                    </p>
                                @endif
                            </th>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Monto&nbsp;total&nbsp;
                                    @for ($i = 0; $i < 15; $i++)
                                        &nbsp;
                                    @endfor
                                </p>
                            </th>
                            <th>
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Estado</p>
                            </th>
                            <th style="text-align: center">
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Habilitar ampliación</p>
                            </th>
                            <th style="text-align: center">
                                <p class="grey-text" style="font-size:17px;font-weight:bold;">Convenio Modificatorio</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contrato_importe_total = $contratos->monto_pago;
                        @endphp
                        @foreach ($contratos->ampliaciones as $ampliacion)
                            @php
                                $contrato_importe_total += $ampliacion->importe;
                            @endphp
                        @endforeach
                        <tr class="black-text">
                            <td>{{ $contratos->no_contrato }}</td>
                            <td>
                                <i class="fas fa-calendar-alt"></i>
                                {{ $contratos->vigencia_contrato }}
                            </td>
                            <td>{{ $contratos->fase }}</td>
                            <td>
                                @if ($contratos->tipo_cambio == 'USD')
                                    <p></p>
                                @else
                                    $ {{ number_format(($contrato_importe_total / 1.16) * 0.16, 2) }}
                                @endif

                            </td>
                            <td>
                                @if ($contratos->tipo_cambio == 'USD')
                                    <p></p>
                                @else
                                    $ {{ number_format($contrato_importe_total / 1.16, 2) }}
                                @endif
                            </td>
                            <td>
                                $ {{ number_format($contrato_importe_total, 2) }}
                            </td>
                            <td>
                                @if ($contratos->estatus == 'vigentes')
                                    Vigente
                                @elseif($contratos->estatus == 'renovaciones')
                                    Renovación
                                @else
                                    Cerrado
                                @endif
                            </td>
                            <td style="text-align: center">
                                <p style="width:100%; text-align:center;">
                                    <label style="width:100% !important;">
                                        <input type="checkbox" wire:model="contrato_ampliado" class="checkbox" />
                                        <span></span>
                                    </label>
                                </p>
                            </td>
                            <td style="text-align: center">
                                <p style="width:100%; text-align:center;">
                                    <label style="width:100% !important;">
                                        <input type="checkbox" wire:model="convenio_modificatorio"
                                            class="checkbox_convenios" />
                                        <span></span>
                                    </label>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
