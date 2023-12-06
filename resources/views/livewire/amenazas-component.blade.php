<div class="col-12">
        <h6 class="title-foda-item d-inline">AMENAZAS</h6>
        <a class="d-inline" data-toggle="modal" data-target="#modalAmenazas">
            <i class="material-icons" style="cursor: pointer;">edit</i>
        </a>

        <div class="modal fade" id="modalAmenazas"  tabindex="-1" aria-labelledby="modalAmenazasLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-black">
                    <h5 class="modal-title" id="modalAmenazasLabel">Amenazas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mt-2">
                        <label for="amenaza"><i class="fas fa-bomb iconos-crear"></i>Nombre</label>
                        <input class="form-control {{ $errors->has('amenaza') ? 'is-invalid' : '' }} amenaza" id="amenaza" wire:model.defer="amenaza">
                        @error('amenaza')
                            <small class="text-danger"><i class="fas fa-info-circle mr-2"></i>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3 col-12 mt-4 " style="text-align: end">
                        <button type="button" wire:click.prevent="{{ $view == 'create' ? 'save' : 'update' }}"
                            class="btn btn-success">Agregar</button>
                    </div>
                    <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
                        <table class="table w-100" id="contactos_table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Amenaza</th>
                                    <th style="min-width:100px;">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($amenazas as $index => $amenaza)
                                    <tr>
                                        <td>
                                            {{ $index + 1 }}
                                        </td>
                                        <td>
                                            {{ $amenaza->amenaza }}
                                        </td>
                                        <td >
                                            <i wire:click="destroy({{ $amenaza->id }})" class="fas fa-trash-alt text-danger"></i>
                                            <i class="fas fa-edit text-primary  ml-2" wire:click="edit({{ $amenaza->id }})"></i>
                                            <i class="text-danger ml-2 fas fa-exclamation-triangle"
                                                wire:click="$emit('modalRiesgoFoda',{{ $amenaza->id }},'amenaza')" data-toggle="modal"
                                                data-target="#marcaslec" title="Asociar un Riesgo"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="marcaslec" wire:ignore.self tabindex="-1" aria-labelledby="marcaslecLabel"
                        aria-hidden="true">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" >Save changes</button>
                </div>
            </div>
            </div>
        </div>
        <p class="mt-3">
            @foreach ($amenazas as $amenaza)
                @if ($amenaza->tiene_riesgos_asociados)
                    <i class="text-danger mr-2 fas fa-exclamation-triangle" style="font-size:8pt"
                        title="Riesgo Asociado"></i>{{ $amenaza->amenaza }}. <br>
                @else
                    {{ $amenaza->amenaza }}. <br>
                @endif
            @endforeach
        </p>



    {{-- <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
        <span style="font-size: 17px; font-weight: bold;">
            Amenazas</span>
    </div> --}}

    {{-- <div class="mt-2">
        <label for="amenaza"><i class="fas fa-bomb iconos-crear"></i>Nombre</label>
        <input class="form-control {{ $errors->has('amenaza') ? 'is-invalid' : '' }} amenaza" id="amenaza" wire:model.defer="amenaza">
        @error('amenaza')
            <small class="text-danger"><i class="fas fa-info-circle mr-2"></i>{{ $message }}</small>
        @enderror
    </div> --}}

    {{-- <div class="mt-2">
        <label for="contacto"><i class="fas fa-clipboard-list iconos-crear"></i>Riesgo Asociado</label>
        <textarea class="form-control {{ $errors->has('contacto') ? 'is-invalid' : '' }}"
            wire:model.defer="riesgo">{{ old('riesgo') }}</textarea>
        <small class="text-danger errores descripcion_contacto_error"></small>
    </div> --}}


    {{-- <div class="mb-3 col-12 mt-4 " style="text-align: end">
        <button type="button" wire:click.prevent="{{ $view == 'create' ? 'save' : 'update' }}"
            class="btn btn-success">Agregar</button>
    </div>


    <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
        <table class="table w-100" id="contactos_table" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Amenaza</th>
                    <th style="min-width:100px;">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($amenazas as $index => $amenaza)
                    <tr>
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td>
                            {{ $amenaza->amenaza }}
                        </td>
                        <td >
                            <i wire:click="destroy({{ $amenaza->id }})" class="fas fa-trash-alt text-danger"></i>
                            <i class="fas fa-edit text-primary  ml-2" wire:click="edit({{ $amenaza->id }})"></i>
                            <i class="text-danger ml-2 fas fa-exclamation-triangle"
                                wire:click="$emit('modalRiesgoFoda',{{ $amenaza->id }},'amenaza')" data-toggle="modal"
                                data-target="#marcaslec" title="Asociar un Riesgo"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="marcaslec" wire:ignore.self tabindex="-1" aria-labelledby="marcaslecLabel"
        aria-hidden="true">
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
    </div> --}}

</div>


