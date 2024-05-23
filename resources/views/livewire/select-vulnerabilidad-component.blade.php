<div class="col-4">
    <div class="row align-items-center">
        <div class="form-group col-md-11">
            <label for="id_vulnerabilidad"><i class="fas fa-shield-alt iconos-crear"></i>Vulnerabilidad</label>
            <select class="procesoSelect form-control" name="id_vulnerabilidad" id="id_vulnerabilidad">
                <option value="">Seleccione una opción</option>
                @foreach ($vulnerabilidades as $vulnerabilidad)
                    <option {{ old('id_vulnerabilidad') == $vulnerabilidad->id ? ' selected="selected"' : '' }}
                        value="{{ $vulnerabilidad->id }}">{{ $vulnerabilidad->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div style="margin-top:17px;height: 28px !important;margin-left: -10px !important;">
            <button class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;" data-toggle="modal"
                data-target="#vulnerabilidadSelect" title="Agregar Vulnerabilidad" wire:click.prevent><i
                    class="fas fa-plus"></i></button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="vulnerabilidadSelect" tabindex="-1" aria-labelledby="vulnerabilidadSelect"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar: Vulnerabilidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group col-sm-12">
                            <label for="exampleInputEmail1" class="required"> <i
                                    class="fas fa-id-card iconos-crear"></i>Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                wire:model="nombre">
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Id Amenaza Field -->
                        <div class="form-group col-sm-12">
                            <i class="fas fa-skull-crossbones iconos-crear"></i>{!! Form::label('id_amenaza', 'Amenaza:') !!}
                            <select class="custom-select" id="valorAmenaza" name="valorAmenaza"
                                wire:model="valorAmenaza">
                                <option selected value="" >Seleccione una opción</option>
                                @forelse ($amenazas as $amenaza)
                                    <option value="{{ $amenaza->id }}">{{ $amenaza->nombre }}</option>
                                @empty
                                    <option value="" disabled>Sin Datos</option>
                                @endforelse
                            </select>
                            @error('valorAmenaza')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <!-- Descripcion Field --> --}}
                        <div class="form-group col-sm-12">
                            <label for="exampleInputEmail1" class="required"> <i class="fas fa-file-alt iconos-crear"></i>Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" wire:model="descripcion" rows="4">
                            </textarea>
                            @error('descripcion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="save">Guardar</button>
                </div>
            </div>
        </div>
    </div>


</div>
