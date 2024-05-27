<div class="row" style="margin-top: 30px; margin-left: 10px;">
    <div class="col l6">
        <label for="search">Buscador</label>
        <input type="text" wire:model.live.debounce.800ms="search" class="form-control" placeholder="Buscar...">
        {{-- <span>Usted está buscando: <strong>{{ $search }}</strong></span> --}}
    </div>

    <div wire:ignore class="input-field col l6 row"
        style="margin-bottom: 0; margin-top: 1.87rem; display: flex; align-items: center; justify-content: center">
        <div class="col l3" style="margin: 0; text-align: end"><span>Mostrar</span></div>
        <div class="col l3" style="margin: 0">
            <select class="select_pagination_cierre_contrato" wire:model.live="pagination">
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
    @if ($cierrecontratos->count())
        <table class="table">
            <thead>
                <tr>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('aspectos')">
                        <p class="grey-text letra-ngt">Aspectos para validación de cierre</p>
                        @if ($sort == 'aspectos')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('cumple')">
                        <p class="grey-text letra-ngt">Cumple</p>
                        @if ($sort == 'cumple')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('observaciones')">
                        <p class="grey-text letra-ngt">
                            @for ($i = 0; $i < 10; $i++)
                                &nbsp;
                            @endfor
                            &nbsp;Observaciones
                        </p>
                        @if ($sort == 'observaciones')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    @if (!$show_contrato)
                        <th style="vertical-align: top">
                            <p class="grey-text letra-ngt">Editar</p>
                        </th>
                        <th style="vertical-align: top">
                            <p class="grey-text letra-ngt">Eliminar</p>
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($cierrecontratos as $em)
                    <tr>
                        <td>{{ $em->aspectos }}</td>
                        <td>
                            @if ($em->cumple)
                                <i class="material-icons green-text">check</i>
                            @else
                                <i class="material-icons red-text">close</i>
                            @endif
                        </td>
                        <td>{{ $em->observaciones }}</td>
                        @if (!$show_contrato)
                            <td>
                                <a href="#form_cierre">
                                    <button wire:click="edit({{ $em->id }})" class="btn blue">
                                        <i class="material-icons">create</i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <button wire:click="$dispatch('triggerDeleteCierre',{{ $em->id }})" class="btn red">
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
                <i class="fas fa-exclamation-circle"></i> No existe ningún registro coincidente
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
        {{ $cierrecontratos->links('livewire::simple-tailwind') }}
    </div>

</div>
<script>
    $(document).ready(function() {
        $('.select_pagination_cierre_contrato').change(function(e) {
            e.preventDefault();
            @this.set('pagination', e.target.value);
        });
    });
    window.addEventListener('paginador-cierre-contrato', function(e) {
        $('.select_pagination_cierre_contrato').formSelect();
    });
    document.addEventListener('confirmDeleteCierreEvent', function(e) {
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
