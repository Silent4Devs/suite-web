<div class="col-12">

    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
        <span style="font-size: 17px; font-weight: bold;">
            Fortalezas</span>
    </div>

    <div class="mt-2">
        <label for="fortaleza"><i class="fas fa-thumbs-up iconos-crear"></i>Nombre</label>
        <input class="form-control {{ $errors->has('fortaleza') ? 'is-invalid' : '' }}" wire:model.defer="fortaleza">
        @error('fortaleza')
            <small class="text-danger"><i class="fas fa-info-circle mr-2"></i>{{ $message }}</small>
        @enderror
    </div>

    {{-- <div class="mt-2">
            <label for="contacto"><i class="fas fa-clipboard-list iconos-crear"></i>Riesgo Asociado</label>
            <textarea class="form-control {{ $errors->has('contacto') ? 'is-invalid' : '' }}" wire:model.defer="riesgo">{{ old('riesgo') }}</textarea>
            <small class="text-danger errores descripcion_contacto_error"></small>
        </div> --}}


    <div class="mb-3 col-12 mt-4 " style="text-align: end">
        <button type="button" wire:click.prevent="{{ $view == 'create' ? 'save' : 'update' }}"
            class="btn btn-success">{{ $view == 'create' ? 'Agregar' : 'Actualizar' }}</button>
    </div>


    <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
        <table class="table w-100" id="contactos_table" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fortaleza</th>
                    <th style="min-width:100px;">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fortalezas as $index => $fortaleza)
                    <tr>
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td>
                            {{ $fortaleza->fortaleza }}
                        </td>
                        <td>
                            <i wire:click="destroy({{ $fortaleza->id }})" class="fas fa-trash-alt text-danger"></i>
                            <i class="fas fa-edit text-primary ml-2" wire:click="edit({{ $fortaleza->id }})"></i>
                            <i class="text-danger ml-2 fas fa-exclamation-triangle" wire:click="$emit('modalRiesgoFoda',{{$fortaleza->id}},'fortaleza')" data-toggle="modal"
                                data-target="#marcaslec" title="Asociar un Riesgo"></i>

                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="marcaslec" wire:ignore.self tabindex="-1"
        aria-labelledby="marcaslecLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Riesgos Asociados</h5>
                </div>
                <div class="modal-body">
                    <div>
                        @livewire('riesgos-foda')
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('abrirModalRiegos', () => {
                console.log('hola');
                $('#marcaslec').modal('show');
            })
        })
    </script>
</div>
