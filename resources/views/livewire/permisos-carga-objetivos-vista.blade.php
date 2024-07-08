<div>
    <div class="card card-body">
        <div class="info-first-config">
            <h4 class="title-config">Permisos</h4>
            <p>Define que perfiles podrán cargar objetivos en la plantilla</p>
            <hr class="my-4">
        </div>

        @foreach ($permisos as $permiso)
            @switch($permiso->perfil)
                @case('Administrador')
                    <div class="row">
                        <div class="col-2">
                            <strong>Administradores</strong>
                            <div class="mt-2">
                                <input type="checkbox" @if ($permiso->permisos_asignacion) checked @endif
                                    wire:change="cambioPermiso('administradores', $event.target.checked)">
                            </div>
                        </div>
                        <div class="col-10">
                            Los administradores definidos en la lista de distribución podrán realizar la carga de objetivos.
                        </div>
                    </div>
                @break

                @case('Jefe Inmediato')
                    <div class="row">
                        <div class="col-2">
                            <strong>Jefes inmediatos</strong>
                            <div class="mt-2">
                                <input type="checkbox" @if ($permiso->permisos_asignacion) checked @endif
                                    wire:change="cambioPermiso('jefes-inmediatos', $event.target.checked)">
                            </div>
                        </div>
                        <div class="col-10">
                            Al habilitar esta opción, los jefes de cada área podrán realizar la carga de los objetivos de sus
                            subordinados.
                        </div>
                    </div>
                @break

                @case('Colaborador')
                    <div class="row">
                        <div class="col-2">
                            <strong>Colaboradores</strong>
                            <div class="mt-2">
                                <input type="checkbox" @if ($permiso->permisos_asignacion) checked @endif
                                    wire:change="cambioPermiso('colaboradores', $event.target.checked)">
                            </div>
                        </div>
                        <div class="col-10">
                            Al habilitar esta opción, todos los colaboradores de la organización podrán cargar sus objetivos.
                            (Estos se enviaran a su aprobación al jefe inmediato)
                            <div class="d-flex align-items-center mt-2" style="gap: 8px;">
                                <label for="" class="mb-0">Objetivos</label>
                                <input type="checkbox" @if ($permiso->permisos_asignacion || $permiso->permiso_objetivos) checked @endif
                                    wire:change="cambioPermiso('colaboradores-objetivos', $event.target.checked)">

                                <label for="" class="mb-0 ml-4">Escalas</label>
                                <input type="checkbox" @if ($permiso->permisos_asignacion || $permiso->permiso_escala) checked @endif
                                    wire:change="cambioPermiso('colaboradores-escalas', $event.target.checked)">
                            </div>
                        </div>
                    </div>
                @break

                @default
            @endswitch
        @endforeach

    </div>
</div>
