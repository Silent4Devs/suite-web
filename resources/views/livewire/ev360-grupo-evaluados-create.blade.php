<div>
    <!-- Botón que abrirá el modal -->
    <a id="btnModalOpen" class="btn btn-sm tb-btn-primary" wire:click="openModal">
        <i class="mr-2 fas fa-plus-circle"></i> Crear Grupo
    </a>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade @if($open) show @endif" id="grupoModal" tabindex="-1" aria-labelledby="grupoModalLabel" aria-hidden="{{ $open ? 'false' : 'true' }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--color-tbj); color: white;">
                    <h5 class="modal-title" id="grupoModalLabel"><i class="mr-2 fas fa-plus-circle"></i>Agregar Grupo</h5>
                    <button type="button" class="close" wire:click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="nombreGrupo">Nombre del grupo: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control {{ $errors->has('nombreGrupo') ? 'is-invalid' : '' }}"
                                    id="nombre" aria-describedby="nombre" wire:model="nombreGrupo" value="{{ old('nombreGrupo') }}" autocomplete="off">
                                <small>Ingresa la definición de la metrica del objetivo</small>
                                @if ($errors->has('nombreGrupo'))
                                    <span class="invalid-feedback">{{ $errors->first('nombreGrupo') }}</span>
                                @endif
                                <span class="text-danger nombre_error error-ajax"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <select class="form-control" wire:model="empleados" multiple id="empleadosPertenecientes">
                                @foreach ($lista_empleados as $empleado)
                                    <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                @endforeach
                            </select>
                            <small>Manten presionada la tecla ctrl y selecciona a los empleados que formarán el grupo</small>
                            @if ($errors->has('empleados'))
                                <small class="text-danger">{{ $errors->first('empleados') }}</small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" wire:click="closeModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="save">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necesario para Bootstrap 4 y anteriores) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('livewire:load', function () {
        // Escuchar el evento emitido por Livewire
        Livewire.on('openModal', () => {
            console.log('Abriendo modal');
            $('#grupoModal').modal('show');
        });

        Livewire.on('closeModal', () => {
            console.log('Cerrando modal');
            $('#grupoModal').modal('hide');
        });
    });
</script>
