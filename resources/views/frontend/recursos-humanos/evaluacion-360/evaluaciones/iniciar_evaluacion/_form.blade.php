<div>
    <div class="m-0">
        <label for="fecha_inicio">Selecciona la Fecha de inicio de la evaluación <span
                class="text-danger">*</span></label>
        <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="fecha_inicio" id="fecha_inicio">
        <span class="errors fecha_inicio_error text-danger"></span>
        <small id="fecha_inicioHelp" class="form-text text-muted">Selecciona la fecha en que será iniciada la
            evaluación</small>
    </div>
    <div class="mt-3">
        <label for="fecha_fin">Selecciona la Fecha de fin de la evaluación <span class="text-danger">*</span></label>
        <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
        <span class="errors fecha_fin_error text-danger"></span>
        <small id="fecha_finHelp" class="form-text text-muted">Selecciona la fecha en que será finalizada la
            evaluación</small>
    </div>
</div>
