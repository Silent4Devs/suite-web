<div class="row">
    <!-- Nombre Field -->
    <div class="col-md-6">
        <div class="form-group anima-focus">
            <input type="text" id="nombre" name="nombre" class="form-control" maxlength="250" placeholder="" required
                value="{{ old('nombre', $vacacion->nombre) }}">
            <label for="nombre" class="required">Nombre <sup class="asterisco-required">*</sup></label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group anima-focus">
            <input type="number" id="dias_aplicados" name="dias_aplicados" class="form-control" max="24"
                placeholder="" required min="1" value="{{ old('dias_aplicados', $vacacion->dias_aplicados) }}">
            <label for="dias_aplicados" class="required">Días a aplicar <sup class="asterisco-required">*</sup></label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group anima-focus">
            <input type="number" id="aniversario" name="aniversario" class="form-control" min="1" max="100"
                placeholder="" value="{{ old('aniversario', $vacacion->aniversario) }}" required>
            <label for="aniversario" class="required">Aniversario afectado <sup
                    class="asterisco-required">*</sup></label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group anima-focus">
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
</div>

<!-- Descripcion Field -->
<div class="row">
    <div class="col-md">
        <div class="form-group anima-focus">
            <textarea class="form-control" placeholder="" id="descripcion" name="descripcion" style="height: 100px">{{ old('descripcion', $vacacion->descripcion) }}</textarea>
            <label for="descripcion">Descripción</label>
        </div>
    </div>
</div>

<hr>

<span class="sub-title-vac">Colaboradores a los que aplicará la Regla</span>

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
        @if ($errors->has('areas'))
            <div class="invalid-feedback">
                {{ $errors->first('areas') }}
            </div>
        @endif
        <label for="normas_areas">Areas</label>
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
        @if ($errors->has('puestos'))
            <div class="invalid-feedback">
                {{ $errors->first('puestos') }}
            </div>
        @endif
        <label for="normas_puestos">Puesto</label>
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
        @if ($errors->has('empleados'))
            <div class="invalid-feedback">
                {{ $errors->first('empleados') }}
            </div>
        @endif
        <label for="normas" class="label-select">Colaborador</label>
    </div>
</div>

<!-- Submit Field -->

{{-- <div class="text-right form-group col-12">
    <div class="d-grid gap-2 d-md-block">
        <a type="button" href="{{ redirect()->route('admin.incidentes-vacaciones.index') }}"
            class="btn btn-outline-primary btn-md">Cancelar</a>
        <button class="btn btn-danger" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</div> --}}

@section('scripts')
    <script>
        $(document).ready(function() {

            $('.empleados-select').select2({
                'theme': 'bootstrap4'
            });

        });
    </script>
@endsection
