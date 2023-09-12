<div class="row" style="margin-top: 15px; margin-bottom: 20px;">
    <div class="col l6">
        <label for="search">Busca un número de factura</label>
        <input type="text" class="form-control" wire:model="search" placeholder="Busca un número de factura">
        {{-- <span>Usted está buscando: <strong>{{ $search }}</strong></span> --}}
    </div>

    <div class="input-field col l6 row"
        style="margin-bottom: 0; margin-top: 1.87rem; display: flex; align-items: center; justify-content: center">
        <div class="col l3" style="margin: 0; text-align: end"><span>Mostrar</span></div>
        <div class="col l3" style="margin: 0">
            <select class="select_pagination" wire:model="pagination">
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
<div class="table-responsive">
    @if ($facturas->count())
        <table class="table">
            <thead>
                <tr>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('no_factura')">
                        <p class="grey-text letra-ngt">No.&nbsp;factura&nbsp;</p>&nbsp;
                        @if ($sort == 'no_factura')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('fecha_recepcion')">
                        <p class="grey-text letra-ngt">&nbsp;&nbsp;&nbsp;Recepción&nbsp;@for ($i = 0; $i < 10; $i++)
                            @endfor
                        </p>
                        @if ($sort == 'fecha_recepcion')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    <th style="cursor: pointer; vertical-align: top;" wire:click="order('fecha_liberacion')">
                        <p class="grey-text letra-ngt">&nbsp;&nbsp;&nbsp;Liberación&nbsp;@for ($i = 0; $i < 10; $i++)
                            @endfor
                        </p>
                        @if ($sort == 'fecha_liberacion')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('no_revisiones')">
                        <p class="grey-text letra-ngt">No.&nbsp;revisiones</p>
                        @if ($sort == 'no_revisiones')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    {{-- <th style="cursor: pointer; vertical-align: top" wire:click="order('cumple')">
                        <p class="grey-text letra-ngt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cumple&nbsp;&nbsp;&nbsp;</p>
                        @if ($sort == 'cumple')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th> --}}
                    <th style="vertical-align:top">
                        <p class="grey-text letra-ngt">Subtotal</p>
                    </th>
                    <th style="vertical-align:top">
                        <p class="grey-text letra-ngt">IVA</p>
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('monto_factura')">
                        <p class="grey-text letra-ngt">Monto&nbsp;total</p>
                        @if ($sort == 'monto_factura')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('estatus')">
                        <p class="grey-text letra-ngt">Estatus</p>
                        @if ($sort == 'estatus')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    <th style="cursor: pointer; vertical-align: top">
                        <p class="grey-text letra-ngt">Revisiones</p>
                    </th>
                    <th style="vertical-align:top">
                        <p class="grey-text letra-ngt">XML</p>
                    </th>
                    <th style="vertical-align:top">
                        <p class="grey-text letra-ngt">PDF</p>
                    </th>
                    @if (!$show_contrato)
                        <th style="vertical-align:top">
                            <p class="grey-text letra-ngt">Editar</p>
                        </th>
                        <th style="vertical-align:top">
                            <p class="grey-text letra-ngt">Eliminar</p>
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                    <tr>
                        <td>{{ $factura->no_factura }}</td>
                        <td>
                            <i class="fas fa-calendar-alt"></i>
                            {{ $factura->fecha_recepcion ? date('d-m-Y', strtotime($factura->fecha_recepcion)) : '' }}
                        </td>
                        <td>
                            <i class="fas fa-calendar-alt"></i>
                            {{ $factura->fecha_liberacion ? date('d-m-Y', strtotime($factura->fecha_liberacion)) : '' }}
                        </td>
                        <td style="text-align: center">{{ $factura->no_revisiones }}</td>
                        {{-- <td>
                            @for ($i = 0; $i < 10; $i++)
                                &nbsp;
                                @endfor @if ($factura->cumple)
                                    <i class="material-icons green-text">check</i>
                                @else
                                    <i class="material-icons red-text">close</i>
                                @endif
                        </td> --}}
                        <td>${{ number_format($factura->monto_factura / 1.16, 2) }}</td>
                        <td>${{ number_format(($factura->monto_factura / 1.16) * 0.16, 2) }}</td>
                        <td>${{ number_format($factura->monto_factura, 2) }}</td>
                        <td>{{ $factura->estatus }}</td>
                        <td>
                            <a wire:click="revisionesfunction({{ $factura->id }})"
                                class="waves-effect waves-light btn modal-trigger" target="_blank"
                                title="Agregar revision">
                                <i class="large material-icons">insert_chart</i>
                            </a>
                        </td>
                        <td style="text-align: center">
                            @if ($factura->xml == null)
                                -
                            @else
                                <a wire:click="exportXml({{ $factura->id }})"
                                    class="btn-floating teal waves-effect waves-light red"><i
                                        class="material-icons">file_download</i></a>
                            @endif
                        </td>
                        <td style="text-align: center">
                            @if ($factura->pdf == null)
                                -
                            @else
                                <a wire:click="exportPdf({{ $factura->id }})"
                                    class="btn-floating deep-purple waves-effect waves-light red"><i
                                        class="material-icons">file_download</i></a>
                            @endif
                        </td>
                        @if (!$show_contrato)
                            <td>
                                <a href="#form_factura">
                                    <button wire:click="edit({{ $factura->id }})" class="btn blue">
                                        <i class="material-icons">create</i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <button wire:click="$emit('triggerDeleteFactura',{{ $factura->id }})"
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

    <div class="col-12 d-flex justify-content-end">
        {{ $facturas->links('livewire::simple-tailwind') }}
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        $('.select_pagination').change(function(e) {
            e.preventDefault();
            @this.set('pagination', e.target.value);
        });
    });
    window.addEventListener('paginadorFacturas', function(e) {
        $('.select_pagination').formSelect();
    });
    document.addEventListener('confirmDeleteEventFactura', function(e) {
        ;
        Swal.fire({
            title: '¿Esta seguro que desea eliminar la factura?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('destroy', e.detail.factura_id)
                //console.log(e.detail.factura_id);
            }
        })

    });
</script>
