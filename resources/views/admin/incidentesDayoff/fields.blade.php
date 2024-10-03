<div class="row">
    <!-- Nombre Field -->
    <div class="col-md-12 form-group anima-focus">
        <input type="text" id="nombre" name="nombre" class="form-control" minlength="1" maxlength="250" placeholder=""
            required value="{{ old('nombre', $vacacion->nombre) }}">
        <label for="nombre" class="required">Nombre <sup class="asterisco-required">*</sup></label>
    </div>
</div>

<!-- Descripcion Field -->
<div class="row">
    <div class="col-md-12 form-group anima-focus">
        <textarea class="form-control" placeholder="" id="descripcion" name="descripcion" style="height: 100px">
                {{ old('descripcion', $vacacion->descripcion) }}
            </textarea>
        <label for="descripcion">Descripción</label>
    </div>
</div>

<div class="row ">

    <div class="col-md-4 form-group anima-focus">
        <input type="number" id="dias_aplicados" name="dias_aplicados" class="form-control" min="1"
            max="365" placeholder="" required value="{{ old('dias_aplicados', $vacacion->dias_aplicados) }}">
        <label for="dias_aplicados" class="required">Días a aplicar <sup class="asterisco-required">*</sup></label>
    </div>

    <div class="col-md-4 form-group anima-focus">
        <input type="number" id="aniversario" name="aniversario" class="form-control" placeholder="Año a Afectar"
            value="{{ old('aniversario', $vacacion->aniversario) ?? $año }}" required readonly>
        <label for="aniversario" class="required">Año a Afectar <sup class="asterisco-required">*</sup></label>
    </div>

    <div class="col-md-4 form-group anima-focus">
        <select id="efecto" name="efecto" class="form-control" required>
            <option value="1" {{ old('efecto', $vacacion->efecto) == 1 ? ' selected="selected"' : '' }}>
                Sumar</option>
            <option value="2" {{ old('efecto', $vacacion->efecto) == 2 ? ' selected="selected"' : '' }}>
                Restar</option>
            <option disabled {{ old('efecto') == $vacacion->efecto ? ' selected="selected"' : '' }}>
                Seleccione...</option>
        </select>
        <label for="efecto" class="required">Acción <sup class="asterisco-required">*</sup></label>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-12">
        <h5>Colaboradores a los que aplicará la Regla</h5>
        @if ($errors->has('custom_error'))
            <div class="alert alert-danger">
                {{ $errors->first('custom_error') }}
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12 anima-focus">
        <select
            class="form-control js-example-basic-multiple empleados-select  {{ $errors->has('controles') ? 'is-invalid' : '' }}"
            name="areas[]" id="areas" multiple="multiple">
            @foreach ($areas as $area)
                <option value="{{ $area->id }}" data-empleado="{{ $area->area }}"
                    {{ old('areas', in_array($area->id, $areas_seleccionadas)) ? ' selected="selected"' : '' }}>
                    {{ $area->area }}
                </option>
            @endforeach
        </select>
        <label for="normas_areas" class="label-select">Areas</label>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12 anima-focus">
        <select
            class="form-control js-example-basic-multiple empleados-select  {{ $errors->has('controles') ? 'is-invalid' : '' }}"
            name="puestos[]" id="puestos" multiple="multiple">
            @foreach ($puestos as $puesto)
                <option value="{{ $puesto->id }}" data-empleado="{{ $puesto->puesto }}"
                    {{ old('puestos', in_array($puesto->id, $puestos_seleccionados)) ? ' selected="selected"' : '' }}>
                    {{ $puesto->puesto }}
                </option>
            @endforeach
        </select>
        <label for="normas_puestos" class="label-select">Puesto</label>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12 anima-focus">
        <select
            class="form-control js-example-basic-multiple empleados-select  {{ $errors->has('controles') ? 'is-invalid' : '' }}"
            name="empleados[]" id="empleados" multiple="multiple">
            @foreach ($empleados as $empleado)
                <option value="{{ $empleado->id }}" data-empleado="{{ $empleado->name }}"
                    {{ old('empleados', in_array($empleado->id, $empleados_seleccionados)) ? ' selected="selected"' : '' }}>
                    {{ $empleado->name }}
                </option>
            @endforeach
        </select>
        <label for="normas" class="label-select">Colaborador</label>
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {

            $('.empleados-select').select2({
                'theme': 'bootstrap4'
            });

        });
    </script>
@endsection
