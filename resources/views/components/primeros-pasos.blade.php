{{-- <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bienvenidoTABANTAJ">
    Launch static backdrop modal
</button> --}}

<!-- Modal -->

<div class="modal fade" id="bienvenidoTABANTAJ" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="bienvenidoTABANTAJLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <h5 class="modal-title mb-2" id="bienvenidoTABANTAJLabel">BIENVENIDO A {{ env('APP_NAME') }}
                        <button style="display: inline-block" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                    <img class="img-fluid" src="{{ asset('img/logo_policromatico.png') }}" alt="Logo Tabantaj"
                        width="140" height="140">
                    <h6 class="mt-4">
                        Nos alegra que hayas elegido TABANTAJ para tu organización, necesitas cargar información vital
                        para poder utilizar el sistema.
                        Nosotros te ayudaremos a que puedas configurar todo 😀.
                    </h6>
                </div>
                <div class="mt-4">
                    <div class="list-group">
                        <a href="{{ route('admin.organizacions.index') }}"
                            class="list-group-item list-group-item-action {{ $existsOrganizacion ? 'active' : '' }}">
                            {{-- active --}}
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="bi bi-building"></i> Configurar Organización</h5>
                                <small>Ahora</small>
                            </div>
                            <p class="mb-1">Necesitas configurar tu organización para generar identidad dentro de
                                TABANTAJ</p>
                            <small>Solo necesitas dar clic y te llevaremos a donde debes crearla.</small>
                        </a>
                        <a href="{{ route('admin.areas.index') }}"
                            class="list-group-item list-group-item-action {{ $existsAreas ? 'active' : '' }}">
                            {{-- active --}}
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="bi bi-building"></i> Añadir Áreas</h5>
                                <small>Ahora</small>
                            </div>
                            <p class="mb-1">Necesitas agregar las áreas de tu organización en TABANTAJ</p>
                            <small>Solo necesitas dar clic y te llevaremos a donde debes crearlas.</small>
                        </a>
                        <a href="{{ route('admin.puestos.index') }}"
                            class="list-group-item list-group-item-action {{ $existsPuesto ? 'active' : '' }}">
                            {{-- active --}}
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="bi bi-person-video2"></i> Añadir Puestos</h5>
                                <small>Ahora</small>
                            </div>
                            <p class="mb-1">Necesitas agregar los puestos de tu organización en TABANTAJ</p>
                            <small>Solo necesitas dar clic y te llevaremos a donde debes crearlos.</small>
                        </a>
                        <a href="{{ $existsAreas && $existsPuesto ? route('admin.empleados.index') : '#' }}"
                            class="list-group-item list-group-item-action {{ $existsEmpleado ? 'active' : '' }}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="bi bi-people"></i> Agregar Colaborador(es)</h5>
                                <small class="text-muted">Ahora</small>
                            </div>
                            <p class="mb-1">Necesitas generar colaboradores dentro de TABANTAJ para que todos
                                comiencen a
                                utilizar el sistema</p>
                            @if ($existsAreas && $existsPuesto)
                                <small class="text-muted">Es sencillo, da clic y te llevaremos al lugar donde podrás
                                    cargar
                                    la información</small>
                            @else
                                <small class="text-danger">NO PUEDES CREAR UN COLABORADOR HASTA QUE HAYAS CREADO
                                    ÁREAS y PUESTOS</small>
                            @endif
                        </a>
                        <a href="{{ $existsEmpleado ? route('admin.users.index') : '#' }}"
                            class="list-group-item list-group-item-action {{ $existsVinculoEmpleadoAdmin ? 'active' : '' }}">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="bi bi-person-plus"></i> Asociar un colaborador al usuario
                                    administrador</h5>
                                <small class="text-muted">Ahora</small>
                            </div>
                            <p class="mb-1">El usuario Administrador de TABANTAJ necesita tener asociado un
                                colaborador
                            </p>
                            @if ($existsEmpleado)
                                <small class="text-muted">Da clic y nosotros te llevaremos para que puedas
                                    asociarlo</small>
                            @else
                                <small class="text-danger">NO PUEDES ASOCIAR UN COLABORADOR HASTA QUE HAYAS CREADO
                                    UNO</small>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let existsEmpleado = @json($existsEmpleado);
        let existsOrganizacion = @json($existsOrganizacion);
        let existsVinculoEmpleadoAdmin = @json($existsVinculoEmpleadoAdmin);
        if (!existsEmpleado ||
            !existsOrganizacion ||
            !existsVinculoEmpleadoAdmin) {
            $('#bienvenidoTABANTAJ').modal('show');
        }
    });
</script>
