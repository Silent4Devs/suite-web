<div class="col-4">
    <div class="row align-items-center">
        <div class="form-group col-md-11">
            <label for="id_amenaza"><i class="fas fa-fire iconos-crear"></i>Amenaza</label>
            <select class="procesoSelect form-control" name="id_amenaza" id="id_amenaza">
                <option value="">Seleccione una opción</option>
                @foreach ($amenazas as $amenaza)
                    <option {{ old('id_amenaza') == $amenaza->id ? ' selected="selected"' : '' }}
                        value="{{ $amenaza->id }}">{{ $amenaza->nombre }}
                    </option>
                @endforeach
            </select>

        </div>
        <div style="margin-top:17px;height: 28px !important;margin-left: -10px !important;">
            <button class="text-white btn btn-sm" style="background:#3eb2ad;height: 32px;" data-toggle="modal"
                data-target="#amenazaSelect" title="Agregar Amenaza" wire:click.prevent><i
                    class="fas fa-plus"></i></button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="amenazaSelect" tabindex="-1" aria-labelledby="amenazaSelect" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar: Amenaza</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-sm-12">
                        <label for="exampleInputEmail1" class="required"> <i
                                class="fas fa-id-card iconos-crear"></i>Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" wire:model="nombre">
                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Categoria Field -->
                    <div class="form-group col-sm-12">
                        <label for="exampleInputEmail1" class="required"><i
                                class="fas fa-th-list iconos-crear"></i>Categoría:</label>
                        <input type="text" class="form-control" id="categoria" name="categoria"
                            wire:model="categoria">
                        @error('categoria')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Descripcion Field -->
                    <div class="form-group col-sm-12">
                        <label for="exampleInputEmail1" class="required"> <i
                                class="fas fa-file-alt iconos-crear"></i>Descripción:</label>
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
