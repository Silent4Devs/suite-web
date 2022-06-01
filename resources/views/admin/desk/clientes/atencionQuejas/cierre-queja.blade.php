<div class="px-1 py-2 mx-3 mb-4 rounded shadow col-12" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
    <div class="row w-100">
        <div class="text-center col-1 align-items-center d-flex justify-content-center">
            <div class="w-100">
                <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
            </div>
        </div>
        <div class="col-11">
            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones
            </p>
            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor
                conteste el siguiente formulario para el cierre de la queja.
            </p>
            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">
            </p>

        </div>
    </div>
</div>

<div class="mt-4 form-group col-md-12">
    <label class="form-label"><i class="fas fa-question-circle iconos-crear"></i>¿Se cumplieron las acciones comprometidas por el responsable
        de la atención de la queja?
    </label>
</div>

<div class="row col-12">
    <div class="card-body" style="margin-top:-30px;">
        <div class="aCumplidoResponsable">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="cumplio_ac_responsable" id="cumplioResponsable"
                    value="1"
                    {{ old('cumplio_ac_responsable', $quejasClientes->cumplio_ac_responsable) == true ? 'checked' : '' }}>
                <label class="form-check-label" for="cumplio_ac_responsable">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="cumplio_ac_responsable" value="2"
                    {{ old('cumplio_ac_responsable', $quejasClientes->cumplio_ac_responsable) == false ? 'checked' : '' }}>
                <label class="form-check-label" for="cumplio_ac_responsable">
                    No
                </label>
            </div>
        </div>
    </div>
</div><br>

<div class="form-group col-md-12 col-sm-12 col-lg-12" style="margin-top:-30px">
    <label class="form-label">¿Por qué?</label><sup>*</sup>
    <textarea name="porque_no_cumplio_responsable"
        class="form-control">{{ $quejasClientes->porque_no_cumplio_responsable }}</textarea>
    <span class="porque_no_cumplio_responsable_error text-danger errores"></span>
</div>

<div class="mt-4 form-group col-md-12">
    <label class="form-label"><i class="fas fa-question-circle iconos-crear"></i>¿Se cumplieron las acciones comprometidas en el tiempo establecido?
    </label>
</div>

<div class="row col-12">
    <div class="card-body" style="margin-top:-30px;">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="cumplio_fecha" id="cumplioResponsable" value="1"
                {{ old('cumplio_fecha', $quejasClientes->cumplio_fecha) == true ? 'checked' : '' }}>
            <label class="form-check-label" for="cumplio_fecha">
                Sí
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="cumplio_fecha" value="2"
                {{ old('cumplio_fecha', $quejasClientes->cumplio_fecha) == false ? 'checked' : '' }}>
            <label class="form-check-label" for="cumplio_fecha">
                No
            </label>
        </div>
    </div>
</div><br>

<div class=" form-group col-md-12">
    <label class="form-label"><i class="fas fa-question-circle iconos-crear"></i>¿El cliente ha quedado conforme con la solución otorgada?
    </label>
</div>

<div class="row col-12">
    <div class="card-body" style="margin-top:-30px;">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="conforme_solucion" id="conforme_solucion" value="1"
                {{ old('conforme_solucion', $quejasClientes->conforme_solucion) == true ? 'checked' : '' }}>
            <label class="form-check-label" for="conforme_solucion">
                Sí
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="conforme_solucion" value="2"
                {{ old('conforme_solucion', $quejasClientes->conforme_solucion) == false ? 'checked' : '' }}>
            <label class="form-check-label" for="conforme_solucion">
                No
            </label>
        </div>
    </div>
</div><br>

<div class="form-group col-md-12">
    <label class="form-label"><i class="fas fa-question-circle iconos-crear"></i>¿Realizar el cierre de la queja?
    </label>
</div>

<div class="row col-12">
    <div class="card-body" style="margin-top:-30px;">
        <div class="preguntaCierreTicket">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="cerrar_ticket" id="cerrarTicket" value="1"
                    {{ old('cerrar_ticket', $quejasClientes->cerrar_ticket) == true ? 'checked' : '' }}>
                <label class="form-check-label" for="cerrar_ticket">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="cerrar_ticket" value="2"
                    {{ old('cerrar_ticket', $quejasClientes->cerrar_ticket) == false ? 'checked' : '' }}>
                <label class="form-check-label" for="cerrar_ticket">
                    No
                </label>
            </div>
        </div>
    </div>
</div><br>

<div class="form-group col-md-12 col-sm-12 col-lg-12" style="margin-top:-30px">
    <label class="form-label">¿Por qué?</label><sup>*</sup>
    <textarea name="porque_no_cierre_ticket"
        class="form-control">{{ $quejasClientes->porque_no_cierre_ticket }}</textarea>
        <span class="porque_no_cierre_ticket_error text-danger errores"></span>
</div>

<div class="form-group col-md-12">
    <label class="form-label"><i class="fas fa-question-circle iconos-crear"></i>¿Notificar al responsable de la atención?
    </label>
</div>

<div class="row col-12">
    <div class="card-body" style="margin-top:-35px;">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="notificar_atencion_queja_no_aprobada" id="cerrarTicket" value="1"
                {{ old('notificar_atencion_queja_no_aprobada', $quejasClientes->notificar_atencion_queja_no_aprobada) == true ? 'checked' : '' }}>
            <label class="form-check-label" for="notificar_atencion_queja_no_aprobada">
                Sí
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="notificar_atencion_queja_no_aprobada" value="2"
                {{ old('notificar_atencion_queja_no_aprobada', $quejasClientes->notificar_atencion_queja_no_aprobada) == false ? 'checked' : '' }}>
            <label class="form-check-label" for="notificar_atencion_queja_no_aprobada">
                No
            </label>
        </div>
    </div>
</div><br>

<div class="mt-4 text-right form-group col-12">
    <a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cerrar</a>
    <button type="submit" class="btn btn-success" id="btn-guardar-cierre">Guardar</button>
</div>
