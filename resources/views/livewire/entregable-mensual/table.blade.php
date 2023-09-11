<div class="row" style="margin-top: 30px; margin-left: 10px;">
    <div class="col l6">
        <label for="search">Busca por nombre o descripción del
            entregable</label>
        <input type="text" wire:model="search" class="form-control" placeholder="Buscar entregable">
        {{-- <span>Usted está buscando: <strong>{{ $search }}</strong></span> --}}
    </div>

    <div wire:ignore class="input-field col l6 row"
        style="margin-bottom: 0; margin-top: 1.87rem; display: flex; align-items: center; justify-content: center">
        <div class="col l3" style="margin: 0; text-align: end"><span>Mostrar</span></div>
        <div class="col l3" style="margin: 0">
            <select class="select_pagination_entregables" wire:model="pagination">
                <option value="3">3</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="col l3" style="margin: 0;text-align: left">
            <span>registros</span>
        </div>
    </div>
</div>

<div class="table-responsive" style="margin-top: 30px;">
    @if ($entregamensuales->count())
        <table id="tblEntregables" class="table">
            <thead>
                <tr>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('nombre_entregable')">
                        <p class="grey-text letra-ngt">Nombre&nbsp;entregable&nbsp;@for ($i = 0; $i < 25; $i++)
                                &nbsp;
                            @endfor
                        </p>
                    </th>
                    <th style="cursor: pointer; vertical-align: top; min-width: 500px !important;"
                        wire:click="order('descripcion')">
                        <p class="grey-text letra-ngt">Descripción&nbsp;@for ($i = 0; $i < 60; $i++)
                                &nbsp;
                            @endfor
                        </p>
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('plazo_entrega_inicio')">
                        <p class="grey-text letra-ngt">Plazo&nbsp;entrega inicio</p>
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('plazo_entrega_termina')">
                        <p class="grey-text letra-ngt">Plazo&nbsp;entrega termina</p>
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('entrega_real')">
                        <p class="grey-text letra-ngt">&nbsp;Entrega&nbsp;real&nbsp;</p>
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('plazo_entrega_termina')">
                        <p class="grey-text letra-ngt">Factura&nbsp;Relacionada</p>
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('cumplimiento')">
                        <p class="grey-text letra-ngt">Cumplimiento</p>
                    </th>
                    <th style="cursor: pointer; vertical-align: top; min-width: 300px !important;"
                        wire:click="order('observaciones')">
                        <p class="grey-text letra-ngt">Observaciones&nbsp;@for ($i = 0; $i < 60; $i++)
                                &nbsp;
                            @endfor
                        </p>
                    </th>
                    <th style="vertical-align:top">
                        <p class="grey-text letra-ngt">PDF</p>
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('aplica_deductiva')">
                        <p class="grey-text letra-ngt">Aplica Deductiva / Penalización</p>
                    </th>
                    <th style="cursor: pointer; vertical-align: top"
                        wire:click="order('justificacion_deductiva_penalizacion')">
                        <p class="grey-text letra-ngt">Justificación&nbsp;Deductiva/Penalización&nbsp;@for ($i = 0; $i < 40; $i++)
                                &nbsp;
                            @endfor
                        </p>
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('deductiva_penalizacion')">
                        <p class="grey-text letra-ngt">Monto Deductiva / Penalización</p>
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('deductiva_factura_id')">
                        <p class="grey-text letra-ngt">No&nbsp;de&nbsp;Factura
                        </p>
                    </th>
                    @if (!$show_contrato)
                        <th style="vertical-align: top">
                            <p class="grey-text" style="font-size:17px;font-weight:bold;">Editar</p>
                        </th>
                        <th style="vertical-align: top">
                            <p class="grey-text" style="font-size:17px;font-weight:bold;">Eliminar</p>
                        </th>
                    @endif

                </tr>
            </thead>
            <tbody>
                @foreach ($entregamensuales as $em)
                    <tr>
                        <td class="alineacion">{{ $em->nombre_entregable }}</td>
                        <td class="alineacion">{{ $em->descripcion }}</td>
                        <td class="alineacion">
                            {{ $em->plazo_entrega_inicio != null ? date('d-m-Y', strtotime($em->plazo_entrega_inicio)) : '' }}
                        </td>
                        <td class="alineacion">
                            {{ $em->plazo_entrega_termina != null ? date('d-m-Y', strtotime($em->plazo_entrega_termina)) : '' }}
                        </td>
                        <td class="alineacion">
                            {{ $em->entrega_real != null ? date('d-m-Y', strtotime($em->entrega_real)) : '' }}</td>
                        <td class="alineacion">
                            @if (is_null($em->factura))
                                <p style="text-align:center">No hay factura relacionada</p>
                            @else
                                <p style="text-align:center">{{ $em->factura->no_factura }}</p>
                            @endif
                        </td>
                        <td class="alineacion">
                            @if ($em->cumplimiento)
                                <i class="material-icons green-text">check</i>
                            @else
                                <i class="material-icons red-text">close</i>
                            @endif
                        </td>
                        <td class="alineacion">{{ $em->observaciones }}</td>
                        <td style="text-align:center">
                            @if ($em->pdf == null)
                                -
                            @else
                                <a wire:click="exportPdf({{ $em->entregable_id }})"
                                    class="btn-floating teal waves-effect waves-light red"><i
                                        class="material-icons">file_download</i></a>
                            @endif
                        </td>
                        <td style="text-align: center !important; width:100%">
                            @if ($em->aplica_deductiva)
                                <i class="material-icons green-text">check</i>
                            @else
                                <i class="material-icons red-text">close</i>
                            @endif
                        </td>
                        <td class="alineacion">{{ $em->justificacion_deductiva_penalizacion }}</td>
                        <td>{{ $em->deductiva_penalizacion > 0 ? "$ " . number_format($em->deductiva_penalizacion, 2) : '' }}
                        </td>
                        <td class="alineacion">
                            @if (is_null($em->deductivaFactura))
                                <p style="text-align:center">No hay factura relacionada</p>
                            @else
                                <p style="text-align:center">{{ $em->deductivaFactura->no_factura }}</p>
                            @endif
                        </td>
                        @if (!$show_contrato)
                            <td class="alineacion">
                                <a href="#form_entregable">
                                    <button wire:click="edit({{ $em->entregable_id }})" class="btn blue">
                                        <i class="material-icons">create</i>
                                    </button>
                                </a>
                            </td>
                            <td class="alineacion">
                                <button wire:click="$emit('triggerDeleteEntregable',{{ $em->entregable_id }})"
                                    class="btn red">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        @if ($search != null || $search != '')
            <br>
            <div
                style="background-color: #f8f8f8;padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            color: rgb(0, 0, 0);
            border-radius: 4px;
            font-size: 18px">
                <i class="fas fa-exclamation-circle"></i> No existe ningún número de factura coincidente
            </div>
        @else
            <br>
            <div
                style="background-color: #f8f8f8;padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            color: rgb(0, 0, 0);
            border-radius: 4px;
            font-size: 18px">
                <i class="fas fa-exclamation-circle"></i> Sin registros en la tabla
            </div>
        @endif
    @endif
</div>
{{ $entregamensuales->links() }}


<script>
    $(document).ready(function() {
        $('.select_pagination_entregables').change(function(e) {
            e.preventDefault();
            @this.set('pagination', e.target.value);
        });
    });
    window.addEventListener('paginador-entregables', function(e) {
        $('.select_pagination_entregables').formSelect();
    });
    document.addEventListener('confirmDeleteEntregableEvent', function(e) {
        Swal.fire({
            title: '¿Esta seguro que desea eliminarla?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('destroy', e.detail.em_id)
                //console.log(e.detail.factura_id);
            }
        })

    });
</script>
