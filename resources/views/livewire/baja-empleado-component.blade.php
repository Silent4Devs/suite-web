<div>
    <x-loading-indicator />
    <div class="row p-2">
        <div class="col-4 border p-2 text-center">
            <img src="{{ $logo }}" alt="" style="width: 80px">
        </div>
        <div class="col-4 border p-2" style="text-align: center">
            <h5 style="text-transform: uppercase">{{ $empresa }}</h5>
            <strong>BAJA DE EMPLEADO</strong>
        </div>
        <div class="col-4 border p-2">
            <p>Área: <strong>GESTIÓN DE TALENTO</strong></p>
            <p>Fecha: {{ now()->format('d/m/Y') }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-2">
            <x-card-guia title='Importante'
                message='Al dar de baja al empleado <strong>{{ $empleado->name }}</strong> se eliminará automáticamente el usuario asociado al mismo.' />
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-6" style="padding: 0 10px">
            <label for="fecha_baja"><i class="fas fa-calendar-day mr-2"></i>Fecha
                de Baja <small class="text-danger">*</small></label>
            <div class="input-group mb-2">
                <input wire:ignore type="date" id="fecha_baja" wire:model.defer="fechaBaja"
                    class="fecha_flatpickr form-control">
                {{-- errors --}}
                @error('fechaBaja')
                    <small class="invalid-feedback d-block">
                        <i class="fas fa-info-circle mr-1"></i>{{ $message }}
                    </small>
                @enderror
            </div>
        </div>
        <div class="col-12" style="padding: 0 10px">
            <div class="w-100" wire:ignore>
                <label for="fecha_baja"><i class="fas fa-info-circle mr-2"></i>Razón de Baja <small
                        class="text-danger">*</small></label>
                <textarea name="razonBaja" id="razonBaja" cols="30" rows="10" wire:model.defer="razonBaja"></textarea>
            </div>
            @error('razonBaja')
                <small class="invalid-feedback d-block">
                    <i class="fas fa-info-circle mr-1"></i>{{ $message }}
                </small>
            @enderror
        </div>
        {{-- errors --}}

    </div>
    {{-- <div class="row mt-4">
        <div class="col-6 p-0">
            <div class="list-group m-0" wire:ignore>
                <a class="list-group-item {{ $empleado->onlyChildren->count() > 0 ? '' : 'active' }}">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">ORGANIGRAMA</h5>
                        <small><i class="fas fa-sitemap mr-2"></i>{{ $empleado->onlyChildren->count() }} colaboradores
                            a su
                            cargo
                        </small>
                    </div>
                    <p class="mb-1">Debes seleccionar un nuevo colaborador a cargo</p>
                    <div class="row">
                        <div class="col-12 p-0 mb-2">
                            <select wire:ignore class="form-control form-control-sm select2" id="empleadosSelect">
                                <option value="">Seleccione un colaborador</option>
                                @foreach ($empleados as $empleado_it)
                                    <option value="{{ $empleado_it->id }}">{{ $empleado_it->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @foreach ($empleado->onlyChildren as $child)
                            <div class="col-6 p-3 border rounded">
                                <div class="text-center">
                                    <img src="{{ $child->avatar_ruta }}" title="{{ $child->name }}"
                                        alt="{{ Str::limit($child->name, 10, '...') }}"
                                        style="width: 60px; circle(30px at 50% at 50%)">
                                </div>
                                <p class="mb-0">{{ Str::limit($child->name, 24, '...') }}</p>
                            </div>
                        @endforeach
                    </div>
                </a>
            </div>
        </div>
        <div class="col-6 p-2 border">
            <div class="list-group m-0" wire:ignore>
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">COMITES DE SEGURIDAD</h5>
                    <small><i class="fas fa-info-circle mr-2"></i>{{ $comites->count() }}
                        comite(s) de seguridad</small>
                </div>
                @foreach ($comites as $key => $comite_it)
                    <a class="list-group-item {{ $comites->count() > 0 ? '' : 'active' }}" style="position:relative">
                        <span class="badge badge-dark"
                            style="position: absolute;top:-5px;left:-5px">{{ $key + 1 }}</span>
                        <p class="mb-1">Debes seleccionar un nuevo colaborador a cargo</p>
                        <div class="mb-2">
                            <select wire:ignore class="form-control form-control-sm select2">
                                <option value="">Seleccione un colaborador</option>
                                @foreach ($empleados as $empleado_it)
                                    <option value="{{ $empleado_it->id }}">{{ $empleado_it->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="m-0">{{ $comite_it->nombrerol }}</p>
                        <small style="font-size:10px">{{ $comite_it->responsabilidades }}</small>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-6 p-2 border">
            <div class="list-group m-0" wire:ignore>
                <div class="d-flex w-100 justify-content-between mb-2">
                    <h5 class="mb-1">DOCUMENTOS QUE DEBE APROBAR</h5>
                    <small><i class="fas fa-info-circle mr-2"></i>{{ $documentosQueDeboAprobar->count() }}
                        documento(s) por aprobar</small>
                </div>
                @foreach ($documentosQueDeboAprobar as $key => $revision)
                    <a class="list-group-item {{ $documentosQueDeboAprobar->count() > 0 ? '' : 'active' }}"
                        style="position:relative">
                        <span class="badge badge-dark"
                            style="position: absolute;top:-5px;left:-5px">{{ $key + 1 }}</span>
                        <p class="mb-1">Debes seleccionar un nuevo colaborador a cargo</p>
                        <div class="mb-2">
                            <select wire:ignore class="form-control form-control-sm select2">
                                <option value="">Seleccione un colaborador</option>
                                @foreach ($empleados as $empleado_it)
                                    <option value="{{ $empleado_it->id }}">{{ $empleado_it->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="m-0">
                            {{ Str::limit($revision->documento ? $revision->documento->codigo : 'Sin Código Asignado', 40, '...') }}
                            -
                            {{ Str::limit($revision->documento ? $revision->documento->nombre : 'Sin Documento Asignado', 40, '...') }}
                        </p>
                        <small style="font-size:10px">
                            Tipo:
                            {{ $revision->documento ? $revision->documento->tipo : 'El tipo no ha sido asignado' }}
                            Versión:
                            {{ $revision->documento ? $revision->documento->version : 'La versión no ha sido asignada' }}
                            Fecha de Solicitud:
                            {{ $revision->documento ? $revision->fecha_solicitud : 'La fecha de solicitud no ha sido asignada' }}
                        </small>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-6 p-2 border">
            <div class="list-group m-0" wire:ignore>
                <div class="d-flex w-100 justify-content-between mb-2">
                    <h5 class="mb-1">DOCUMENTOS QUE LE DEBEN APROBAR</h5>
                    <small><i class="fas fa-info-circle mr-2"></i>{{ $documentosQueMeDebenAprobar->count() }}
                        documento(s) por aprobar</small>
                </div>
                @foreach ($documentosQueMeDebenAprobar as $key => $revision)
                    <a class="list-group-item {{ $documentosQueMeDebenAprobar->count() > 0 ? '' : 'active' }}"
                        style="position:relative">
                        <span class="badge badge-dark"
                            style="position: absolute;top:-5px;left:-5px">{{ $key + 1 }}</span>
                        <p class="mb-1">Debes seleccionar un nuevo colaborador a cargo</p>
                        <div class="mb-2">
                            <select wire:ignore class="form-control form-control-sm select2">
                                <option value="">Seleccione un colaborador</option>
                                @foreach ($empleados as $empleado_it)
                                    <option value="{{ $empleado_it->id }}">{{ $empleado_it->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="m-0">
                            {{ Str::limit($revision->documento ? $revision->documento->codigo : 'Sin Código Asignado', 40, '...') }}
                            -
                            {{ Str::limit($revision->documento ? $revision->documento->nombre : 'Sin Documento Asignado', 40, '...') }}
                        </p>
                        <small style="font-size:10px">
                            Tipo:
                            {{ $revision->documento ? $revision->documento->tipo : 'El tipo no ha sido asignado' }}
                            Versión:
                            {{ $revision->documento ? $revision->documento->version : 'La versión no ha sido asignada' }}
                            Fecha de Solicitud:
                            {{ $revision->documento ? $revision->fecha_solicitud : 'La fecha de solicitud no ha sido asignada' }}
                        </small>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="col-6 p-2 border">
            <div class="list-group m-0" wire:ignore>
                <div class="d-flex w-100 justify-content-between mb-2">
                    <h5 class="mb-1">ACTIVOS</h5>
                    <small><i class="fas fa-info-circle mr-2"></i>Es responsable de {{ $misActivos->count() }}
                        activo(s)</small>
                </div>
                @if (count($misActivos) === 0)
                    Sin activos asignados actualmente
                @else
                    @foreach ($misActivos as $key => $activo_it)
                        <a class="list-group-item" style="position:relative">
                            <span class="badge badge-dark"
                                style="position: absolute;top:-5px;left:-5px">{{ $key + 1 }}</span>
                            <span class="p-2 border"><strong>ID: </strong>{{ $activo_it->id }}</span>
                            <span class="p-2 border"><strong>Activo:
                                </strong>{{ $activo_it->nombreactivo }}</span>
                            <span class="p-2 border"><strong>No. Serie: </strong>{{ $activo_it->n_serie }}</span>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>      
    </div> --}}
    <div class="row">
        <div class="col-12 mt-2 p-0 pr-2" style="text-align:end">
            <button class="btn btn-success" id="darDeBaja">Dar de Baja</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('baja', (e) => {
                Swal.fire({
                    title: "Empleado dado de baja",
                    text: "El empleado ha sido dado de baja exitosamente",
                    icon: "success",
                }).then(() => {
                    window.location.href = "{{ route('admin.empleados.index') }}";
                });
            });

            document.getElementById('darDeBaja').addEventListener('click', function() {
                Swal.fire({
                    title: "¿Estás seguro(a)?",
                    text: "El empleado será dado de baja",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, dar de baja",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.value) {
                        @this.darDeBaja();
                    }
                });
            });

            window.initSelect = () => {
                $('.select2').select2({
                    placeholder: 'Seleccione un colaborador',
                    allowClear: true,
                    width: '100%'
                });
            }
            initSelect();

            Livewire.on('select2', () => {
                initSelect();
            });

            $('.select2').on('select2:select', function(e) {
                @this.set('nuevoSupervisor', Number(e.params.data.id));
                @this.cambiarSupervisor();
            });

            //CKEDITOR
            const editor = CKEDITOR.replace(
                'razonBaja', {
                    toolbar: [{
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                            'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                            'Bold', 'Italic'
                        ]
                    }, {
                        name: 'clipboard',
                        items: ['Link', 'Unlink']
                    }, ],
                    // Remove the redundant buttons from toolbar groups defined above.
                    removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
                });
            editor.on('change', function(event) {
                @this.set('razonBaja', event.editor.getData(), true);
            })
        });
    </script>
</div>
