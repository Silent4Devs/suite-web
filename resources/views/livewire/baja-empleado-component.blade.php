<div>
    <div class="row border p-2">
        <div class="col-4 text-center">
            <img src="{{ $logo }}" alt="" style="width: 100px">
        </div>
        <div class="col-8" style="text-align: end">
            <h3 style="text-transform: uppercase">{{ $empresa }}</h3>
            <h6>GESTIÓN DE TALENTO</h6>
            <strong>BAJA DE EMPLEADO</strong>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-6 p-0">
            <div class="list-group m-0">
                <a class="list-group-item {{ $empleado->children->count() > 0 ? '' : 'active' }}">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">ORGANIGRAMA</h5>
                        <small><i class="fas fa-sitemap mr-2"></i>{{ $empleado->children->count() }} colaboradores a su
                            cargo
                        </small>
                    </div>
                    <p class="mb-1">Debes seleccionar un nuevo colaborador a cargo</p>
                    {{-- SELECT --}}
                    <div class="row">
                        <div class="col-12 p-0 mb-2">
                            <select wire:ignore class="form-control form-control-sm" id="empleadosSelect">
                                <option value="">Seleccione un colaborador</option>
                                @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @foreach ($empleado->children as $colaborador)
                            <div class="col-6 p-3 border rounded">
                                <div class="text-center">
                                    <img src="{{ $colaborador->avatar_ruta }}" title="{{ $colaborador->name }}"
                                        alt="{{ Str::limit($colaborador->name, 10, '...') }}"
                                        style="width: 100px; circle(50px at 50% at 50%)">
                                </div>
                                <p class="mb-0">{{ $colaborador->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </a>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.initSelect = () => {
                $('#empleadosSelect').select2({
                    placeholder: 'Seleccione un colaborador',
                    allowClear: true,
                    width: '100%'
                });
            }
            initSelect();

            Livewire.on('select2', () => {
                initSelect();
            });

            $('#empleadosSelect').on('select2:select', function(e) {
                @this.set('nuevoSupervisor', Number(e.params.data.id));
                @this.cambiarSupervisor();
            });
        });
    </script>
</div>
