<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="grey-text letra-ngt">No. Proyecto</th>
                <th class="grey-text letra-ngt">Elaboró análisis</th>
                <th class="grey-text letra-ngt">Revisó los resultados</th>
                <th class="grey-text letra-ngt">Autorizó la cédula</th>
                <th class="grey-text letra-ngt">Cumple</th>
                @if (!$show_contrato)
                    <th class="grey-text letra-ngt">Editar</th>
                    <th class="grey-text letra-ngt">Histórico</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($cedulas as $cedula)
                <tr>
                    <td>{{ $cedula->contrato->no_contrato }}</td>
                    <td>{{ $cedula->elaboro }}</td>
                    <td>{{ $cedula->reviso }}</td>
                    <td>{{ $cedula->autorizo }}</td>
                    <td>
                        @if ($cedula->cumple)
                            <div style="display: flex; align-items: center">
                                <i class="material-icons green-text">check</i>
                                <span>Cumple</span>
                            </div>
                        @else
                            <div style="display: flex; align-items: center">
                                <i class="material-icons red-text">close</i>
                                <span> No cumple</span>
                            </div>
                        @endif
                    </td>
                    @if (!$show_contrato)
                        <td>
                            {{-- <a href="#form_cedula"> --}}
                            <a>
                                <button wire:click="edit({{ $cedula->id }})" class="btn blue">
                                    <i class="material-icons">create</i>
                                </button>
                            </a>
                            {{--  </td>
                        <td>
                            <button wire:click="$dispatch('triggerDeleteCumplimiento',{{$cedula->id}})" class="btn red">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>  --}}
                        <td>
                            {{-- <div x-data="{cedula_id:'{{ $cedula->id }}'}">
                                <button data-target="modal_historico" class="btn modal-trigger" data-position="bottom">
                                    <i class="fas fa-history"></i>
                                </button>
                                @livewire('cedula-cumplimiento.historico-component',['cedula_id'=>$cedula->id])
                            </div> --}}
                            <a class="btn" href="{{ route('contract_manager.cedula.historico', $cedula->id) }}"
                                target="_blank"><i class="fas fa-history"></i></a>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td>Sin cédula de cumplimiento registrada</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>




<script>
    document.addEventListener('confirmDeleteCedulaEvent', function(e) {
        Swal.fire({
            title: '¿Esta seguro que desea eliminarla?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('destroy', e.detail.cedula_id)
                //console.log(e.detail.factura_id);
            }
        })

    });
</script>
