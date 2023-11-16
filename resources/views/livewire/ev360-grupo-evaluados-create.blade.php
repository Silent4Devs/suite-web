<div>
    <div>
        <button id="btnModalOpen" wire:click.prevent="openModal()" class="btn btn-sm btn-primary"><i
                class="mr-2 fas fa-plus-circle"></i>
            Crear Grupo
        </button>
    </div>
    <div wire:ignore.self class="modal fade" id="grupoModal" tabindex="-1" aria-labelledby="grupoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #345183;color: white;">
                    <h5 class="modal-title" id="grupoModalLabel"><i class="mr-2 fas fa-plus-circle"></i>Agregar
                        Grupo
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label for="nombreGrupo">Nombre del grupo: <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control {{ $errors->has('nombreGrupo') ? 'is-invalid' : '' }}"
                                    id="nombre" aria-describedby="nombre" wire:model="nombreGrupo"
                                    value="{{ old('nombreGrupo') }}" autocomplete="off">
                                <small>Ingresa la definición de la metrica del objetivo</small>
                                @if ($errors->has('nombreGrupo'))
                                    <span class="invalid-feedback">{{ $errors->first('nombreGrupo') }}</span>
                                @endif
                                <span class="text-danger nombre_error error-ajax"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <select class="form-control" wire:model="empleados" multiple
                                id="empleadosPertenecientes">
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
                    <button type="button" class="btn_cancelar" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="save">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('btnModalOpen').addEventListener('click', function(e) {
            e.preventDefault();
        });
        document.addEventListener('DOMContentLoaded', function() {
            window.livewire.on('openModalClick', () => {
                $('#grupoModal').modal('show');
            });
            window.livewire.on('grupoEvaluadosSaved', () => {
                $('#grupoModal').modal('hide');
                toastr.success('Grupo creado con éxito');
            });
        })
    </script>
</div>
