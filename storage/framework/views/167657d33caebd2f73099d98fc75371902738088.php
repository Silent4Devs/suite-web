

<!-- Modal -->

<div class="modal fade" id="bienvenidoTABANTAJ" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="bienvenidoTABANTAJLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <h5 class="modal-title mb-2" id="bienvenidoTABANTAJLabel">BIENVENIDO A <?php echo e(env('APP_NAME')); ?>

                        <button style="display: inline-block" type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                    <img class="img-fluid" src="<?php echo e(asset('img/logo_policromatico.png')); ?>" alt="Logo Tabantaj"
                        width="140" height="140">
                    <h6 class="mt-4">
                        Nos alegra que hayas elegido TABANTAJ para tu organización, necesitas cargar información vital
                        para poder utilizar el sistema.
                        Nosotros te ayudaremos a que puedas configurar todo 😀.
                    </h6>
                </div>
                <div class="mt-4">
                    <div class="list-group">
                        <a href="<?php echo e(route('admin.organizacions.index')); ?>"
                            class="list-group-item list-group-item-action <?php echo e($existsOrganizacion ? 'active' : ''); ?>">
                            
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="bi bi-building"></i> Configurar Organización</h5>
                                <small>Ahora</small>
                            </div>
                            <p class="mb-1">Necesitas configurar tu organización para generar identidad dentro de
                                TABANTAJ</p>
                            <small>Solo necesitas dar clic y te llevaremos a donde debes crearla.</small>
                        </a>
                        <a href="<?php echo e(route('admin.areas.index')); ?>"
                            class="list-group-item list-group-item-action <?php echo e($existsAreas ? 'active' : ''); ?>">
                            
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="bi bi-building"></i> Añadir Áreas</h5>
                                <small>Ahora</small>
                            </div>
                            <p class="mb-1">Necesitas agregar las áreas de tu organización en TABANTAJ</p>
                            <small>Solo necesitas dar clic y te llevaremos a donde debes crearlas.</small>
                        </a>
                        <a href="<?php echo e(route('admin.puestos.index')); ?>"
                            class="list-group-item list-group-item-action <?php echo e($existsPuesto ? 'active' : ''); ?>">
                            
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="bi bi-person-video2"></i> Añadir Puestos</h5>
                                <small>Ahora</small>
                            </div>
                            <p class="mb-1">Necesitas agregar los puestos de tu organización en TABANTAJ</p>
                            <small>Solo necesitas dar clic y te llevaremos a donde debes crearlos.</small>
                        </a>
                        <a href="<?php echo e($existsAreas && $existsPuesto ? route('admin.empleados.index') : '#'); ?>"
                            class="list-group-item list-group-item-action <?php echo e($existsEmpleado ? 'active' : ''); ?>">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="bi bi-people"></i> Agregar Colaborador(es)</h5>
                                <small class="text-muted">Ahora</small>
                            </div>
                            <p class="mb-1">Necesitas generar colaboradores dentro de TABANTAJ para que todos
                                comiencen a
                                utilizar el sistema</p>
                            <?php if($existsAreas && $existsPuesto): ?>
                                <small class="text-muted">Es sencillo, da clic y te llevaremos al lugar donde podrás
                                    cargar
                                    la información</small>
                            <?php else: ?>
                                <small class="text-danger">NO PUEDES CREAR UN COLABORADOR HASTA QUE HAYAS CREADO
                                    ÁREAS y PUESTOS</small>
                            <?php endif; ?>
                        </a>
                        <a href="<?php echo e($existsEmpleado ? route('admin.users.index') : '#'); ?>"
                            class="list-group-item list-group-item-action <?php echo e($existsVinculoEmpleadoAdmin ? 'active' : ''); ?>">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="bi bi-person-plus"></i> Asociar un colaborador al usuario
                                    administrador</h5>
                                <small class="text-muted">Ahora</small>
                            </div>
                            <p class="mb-1">El usuario Administrador de TABANTAJ necesita tener asociado un
                                colaborador
                            </p>
                            <?php if($existsEmpleado): ?>
                                <small class="text-muted">Da clic y nosotros te llevaremos para que puedas
                                    asociarlo</small>
                            <?php else: ?>
                                <small class="text-danger">NO PUEDES ASOCIAR UN COLABORADOR HASTA QUE HAYAS CREADO
                                    UNO</small>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let existsEmpleado = <?php echo json_encode($existsEmpleado, 15, 512) ?>;
        let existsOrganizacion = <?php echo json_encode($existsOrganizacion, 15, 512) ?>;
        let existsVinculoEmpleadoAdmin = <?php echo json_encode($existsVinculoEmpleadoAdmin, 15, 512) ?>;
        if (!existsEmpleado ||
            !existsOrganizacion ||
            !existsVinculoEmpleadoAdmin) {
            $('#bienvenidoTABANTAJ').modal('show');
        }
    });
</script>
<?php /**PATH /var/www/html/resources/views/components/primeros-pasos.blade.php ENDPATH**/ ?>