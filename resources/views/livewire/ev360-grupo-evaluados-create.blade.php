<div>
    <!-- Botón que abrirá el modal -->
    <a id="btnModalOpen" class="btn btn-sm tb-btn-primary"
    wire:click="openModal"
    onclick="showLoader()">
        <i class="mr-2 fas fa-plus-circle"></i> Crear Grupo
    </a>

    <!-- Loader -->
    <div id="loader" style="display: none; margin-left: 10px;">
        <i class="fas fa-spinner fa-spin"></i> Cargando...
    </div>

    @if ($open)
    <div id="grupoPanel" class="fixed-panel" style="width: 100%; max-width: 500px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); border: 1px solid #ddd; border-radius: 5px; background: white; z-index: 1050;">
        <div class="panel-header" style="background: #345183; color: white; padding: 15px; border-top-left-radius: 5px; border-top-right-radius: 5px;">
            <h5 class="panel-title" id="grupoPanelLabel">
                <i class="mr-2 fas fa-plus-circle"></i> Agregar Grupo
            </h5>
            <button type="button" class="close" onclick="document.getElementById('grupoPanel').style.display='none';" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="panel-body" style="padding: 15px;">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="form-group">
                        <label for="nombreGrupo">Nombre del grupo: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control {{ $errors->has('nombreGrupo') ? 'is-invalid' : '' }}" id="nombre" aria-describedby="nombre" wire:model.defer="nombreGrupo" value="{{ old('nombreGrupo') }}" autocomplete="off">
                        <small>Ingresa la definición de la metrica del objetivo</small>
                        @if ($errors->has('nombreGrupo'))
                            <span class="invalid-feedback">{{ $errors->first('nombreGrupo') }}</span>
                        @endif
                        <span class="text-danger nombre_error error-ajax"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12">
                    <select class="form-control" wire:model.defer="empleados" multiple id="empleadosPertenecientes">
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
        <div class="panel-footer" style="padding: 15px; text-align: right; border-top: 1px solid #ddd;">
            <button type="button" class="btn_cancelar" onclick="document.getElementById('grupoPanel').style.display='none';">Cerrar</button>
            <button type="button" class="btn btn-danger" wire:click.prevent="save">Guardar</button>
        </div>
    </div>

    <style>
    .fixed-panel {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    </style>

    @endif
</div>

<!-- jQuery (necesario para Bootstrap 4 y anteriores) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function showLoader() {
        // Mostrar el loader inmediatamente
        document.getElementById('loader').style.display = 'inline-block';
    }
</script>

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
