<div class="row" style="margin-top: 30px; margin-left: 10px;">
    <div class="col l6">
        <label for="search">Busca un número de convenio</label>
        <input type="text" wire:model.live.debounce.800ms="search" class="form-control"
            placeholder="Busca un número de convenio">
        {{-- <span>Usted está buscando: <strong>{{ $search }}</strong></span> --}}
    </div>
    <div wire:ignore class="input-field col l6 row"
        style="margin-bottom: 0; margin-top: 1.87rem; display: flex; align-items: center; justify-content: center">
        <div class="col l3" style="margin: 0; text-align: end"><span>Mostrar</span></div>
        <div class="col l3" style="margin: 0">
            <select class="select_pagination" wire:model.live="pagination">
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
    @if ($convenio->count())
        <table class="table" style="margin-top: 30px;">
            <thead>
                <tr>
                    <th style="cursor: pointer; vertical-align: top; text-align:center" class="letra-ngt grey-text">
                        &nbsp;&nbsp;&nbsp;No.&nbsp;Convenio&nbsp;@for ($i = 0; $i < 10; $i++)
                            &nbsp;
                        @endfor
                    </th>
                    <th class="letra-ngt grey-text">
                        &nbsp;&nbsp;&nbsp;&nbsp;Fecha&nbsp;@for ($i = 0; $i < 13; $i++)
                            &nbsp;
                        @endfor
                    </th>
                    <th class="letra-ngt grey-text">Convenios&nbsp;&nbsp;</th>
                    <th class="letra-ngt grey-text center-align" style="margin-left:50px;">
                        <div class="valign-wrapper" style="margin-left:50px !important;">
                            <p style="margin-left:50px !important;" class="center-align"> Descripción&nbsp;@for ($i = 0; $i < 50; $i++)
                                    &nbsp;
                                @endfor
                            </p>
                        </div>
                    </th>
                    @if (!$show_contrato)
                        <th class="letra-ngt grey-text">Editar</th>
                        <th class="letra-ngt grey-text">Eliminar</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($convenio as $convenios)
                    <tr>
                        <td>{{ $convenios->no_convenio }}</td>
                        <td>
                            <i class="fas fa-calendar-alt"></i>
                            {{ date('d-m-Y', strtotime($convenios->fecha)) }}
                        </td>
                        <td>&nbsp;&nbsp;
                            <a wire:click="exportConvenios({{ $convenios->id }})"
                                class="btn-floating deep-purple waves-effect waves-light red"><i
                                    class="material-icons">file_download</i></a>
                        </td>
                        <td>{{ $convenios->descripcion }}</td>
                        @if (!$show_contrato)
                            <td>
                                <a href="#form_ampliacion">
                                    <button wire:click="edit({{ $convenios->id }})" class="btn blue">
                                        <i class="material-icons">create</i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <button wire:click="destroy({{ $convenios->id }})" class="btn red">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td>Sin ampliación registrada</td>
                    </tr>
                @endforelse
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

    <div class="col-6 p-0" style="display: flex;justify-content: end">
        {{ $convenio->links('livewire::simple-tailwind') }}
    </div>
</div>
{{-- <div class="row">
    <div class="col-6 p-0">
        <strong>
            Mostrando {{ $perPage }} de {{ $totalRegistrosMostrando }} resultados @if ($estatus)
                <span class="badge badge-primary">(filtrando por {{ $estatus }})</span>
            @endif
        </strong>
    </div>
</div> --}}
<script>
    $(document).ready(function() {
        $('.select_pagination').change(function(e) {
            e.preventDefault();
            @this.set('pagination', e.target.value);
        });
    });
    window.addEventListener('paginadorConvenios', function(e) {
        $('.select_pagination').formSelect();
    });
    document.addEventListener('confirmDeleteEvent', function(e) {
        Swal.fire({
            title: '¿Esta seguro que desea eliminarla?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('destroy', e.detail.convenio_id)
                //console.log(e.detail.factura_id);
            }
        })

    });
</script>
