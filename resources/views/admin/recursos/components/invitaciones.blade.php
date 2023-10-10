<div class="my-3">
    <div class="row">
        <div class="col-6">
            <h3>Información Actual de la Capacitación:</h3>
            <p>
                <strong>Titulo: </strong>
                <span id="titulo_invitaciones" style="text-transform: capitalize"></span>
            </p>
            <p>
                <strong>Categoría: </strong>
                <span id="categoria_invitaciones" style="text-transform: capitalize"></span>
            </p>
            <p>
                <strong>Tipo: </strong>
                <span id="tipo_invitaciones" style="text-transform: capitalize"></span>
            </p>
            <p>
                <strong>Modalidad: </strong>
                <span id="modalidad_invitaciones" style="text-transform: capitalize"></span>
            </p>
            <p>
                <strong>Ubicación: </strong>
                <span id="ubicacion_invitaciones" style="text-transform: capitalize"></span>
            </p>
            <p>
                <strong>Fecha: </strong>
                Del
                <span id="fecha_inicio_invitaciones" style="text-transform: capitalize"></span>
                al
                <span id="fecha_fin_invitaciones" style="text-transform: capitalize"></span>
            </p>
            <p>
                <strong>Instructor: </strong>
                <span id="instructor_invitaciones" style="text-transform: capitalize"></span>
            </p>
            <p>
                <strong>Descripción: </strong>
                <span id="descripcion_invitaciones" style="text-transform: capitalize"></span>
            </p>
        </div>
        <div class="col-6" id="participantes_invitaciones" style="max-height: 500px;overflow: auto;"></div>
        <div class="col-12">
            <label class="required" for="enviarInvitacionAhora"><i class="fas fa-calendar-day mr-1 iconos-crear"></i>Fecha Limite
                para confirmar asistencia</label>
        </div>
        <div class="col-6 form-group">
            <input required class="form-control" type="datetime-local" id="fechaLimite" name="fecha_limite"
                value="{{ old('fechaLimite', \Carbon\Carbon::parse($recurso->fecha_limite)->format('Y-m-d\TH:i')) }}">
            <small class="text-muted">Debe ser una fecha anterior o igual a la fecha de inicio de la
                capacitación</small>
            <span class="fecha_limite_error text-danger errores"></span>
        </div>
        <div class="col-6 form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="enviarInvitacionAhora" id="enviarInvitacionAhora1"
                    value="ahora" checked>
                <label class="form-check-label" for="enviarInvitacionAhora1">
                    <i class="fas fa-clock mr-2"></i>Enviar Invitación en este Momento
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="enviarInvitacionAhora" id="enviarInvitacionAhora2"
                    value="programar">
                <label class="form-check-label" for="enviarInvitacionAhora2">
                    <i class="fas fa-hourglass-start mr-2"></i>Programar Envío de Invitación
                </label>
            </div>
        </div>
        <div class="col-12" id="contenedorProgramarInvitaciones"></div>
    </div>
</div>
<div class="text-right form-group col-12">
    <a href="{{ route('admin.recursos.index') }}" class="btn_cancelar">Cancelar</a>
    <button class="btn btn-danger btnGuardarDraftRecurso" type="submit" id="btnGuardarDraftRecurso">
        Borrador
    </button>
    <button class="btn btn-danger btnGuardarRecurso" type="submit" id="btnGuardarRecurso">
        Enviar
    </button>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const enviarInvitacionAhora2 = document.querySelector('#enviarInvitacionAhora2');
        const enviarInvitacionAhora1 = document.querySelector('#enviarInvitacionAhora1');
        const contenedorProgramarInvitaciones = document.getElementById(
            'contenedorProgramarInvitaciones');
        const fechaLimite = document.getElementById('fechaLimite');
        enviarInvitacionAhora1.addEventListener('change', function(e) {
            if (e.target.checked) {
                contenedorProgramarInvitaciones.innerHTML = null;
            }
        })

        enviarInvitacionAhora2.addEventListener('change', function(e) {
            if (e.target.checked) {
                let html = `
                    <div>
                        <label for="enviarInvitacionAhora">
                            <i class="fas fa-calendar-day mr-1 iconos-crear"></i>
                            Programar Fecha de Envío de Invitación
                        </label>
                        <input class="form-control" type="datetime-local" id="fechaProgramarEnvioInvitacion" name="fecha_envio_invitacion">
                        <small class="text-muted">Debe seleccionar una fecha anterior como mínimo de 5 días a la fecha limite de la capacitación</small>
                        <span class="fecha_envio_invitacion_error text-danger errores"></span>
                    </div>
                `;
                contenedorProgramarInvitaciones.innerHTML = html;
            }
        })

        contenedorProgramarInvitaciones.addEventListener('change', function(e) {
            if (e.target.getAttribute('id') == 'fechaProgramarEnvioInvitacion') {
                let fechaSeleccionada = e.target.value;
                console.log(fechaSeleccionada);
                const f1 = new Date(fechaLimite.value)
                const f1Subs5Days = new Date(new Date()
                    .setDate(f1.getDate() - 5));
                if (new Date(fechaSeleccionada) >= f1Subs5Days) {
                    alert(
                        'Debe seleccionar una fecha anterior como mínimo de 5 días a la fecha limite de la capacitación'
                    )
                    document.getElementById('fechaProgramarEnvioInvitacion').value = new Date(new Date()
                            .setDate(f1.getDate() - 6))
                        .toISOString()
                        .substr(0, f1.toISOString().indexOf("."));
                }
                console.log(fechaSeleccionada);
            }
        })

    })
</script>
