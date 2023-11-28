<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-6">
        <div class="form-floating">
            {!! Form::text('nombre', null, [
                'class' => 'form-control',
                'maxlength' => 255,
                'placeholder' => 'Esciba nombre de la regla de vacaciones...',
            ]) !!}
            <label for="nombre">Nombre <sup class="asterisco">*</sup></label>
            {{-- {!! Form::label('nombre', 'Nombre:', ['class' => 'required']) !!} --}}
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{-- <i class="fas fa-info-circle" style="font-size:12pt; float: right;"
            title="Tipo de discriminación de días;
            1.- Natural (Se cuenta de Lunes a Domingo)
            2.- Habil ((Se cuenta de Lunes a Viernes)"></i> --}}
        <div class="form-floating">
            <select id="tipo_conteo" name="tipo_conteo" class="form-control">
                <option value="1" {{ old('tipo_conteo') == $vacacion->tipo_conteo ? ' selected="selected"' : '' }}>
                    Día Natural</option>
                <option value="2" {{ old('tipo_conteo') == $vacacion->tipo_conteo ? ' selected="selected"' : '' }}>
                    Día Hábil</option>
                <option disabled {{ old('tipo_conteo') == $vacacion->tipo_conteo ? ' selected="selected"' : '' }}>
                    Seleccione...</option>
            </select>
            <label for="tipo_conteo" class="required">Tipo de
                conteo</label>
        </div>
    </div>
</div>

<!-- Descripcion Field -->
<div class="row">
    <div class="form-group col-sm-12">
        {{-- <i
        class="fas fa-file-alt iconos-crear"></i> --}}
        <div class="form-floating">
            <textarea class="form-control" id="descripcion" name="descripcion" rows="2">{{ old('descripcion', $vacacion->descripcion) }}</textarea>
            <label for="descripcion">Descripción</label>
        </div>
        {{-- <label for="exampleFormControlTextarea1"> --}}
        {{-- {!! Form::label('descripcion', 'Descripción:') !!}
    </label> --}}
    </div>
</div>
{{-- <div class="form-group col-sm-6">
        {!! Form::label('inicio_conteo', 'Inicio', ['class' => 'required']) !!}
        <select id="inicio_conteo" name="inicio_conteo" class="form-control">
            <option value="1" {{ old('inicio_conteo') == $vacacion->inicio_conteo ? ' selected="selected"' : '' }}>Al ingreso</option>
            <option value="2" {{ old('inicio_conteo') == $vacacion->inicio_conteo ? ' selected="selected"' : '' }}>Después de 1 mes</option>
            <option value="3" {{ old('inicio_conteo') == $vacacion->inicio_conteo ? ' selected="selected"' : '' }}>Después de 6 meses</option>
            <option value="4" {{ old('inicio_conteo') == $vacacion->inicio_conteo ? ' selected="selected"' : '' }}>Después de 1 año</option>
            <option disabled {{ old('inicio_conteo') == $vacacion->inicio_conteo ? ' selected="selected"' : '' }}>Seleccione...</option>
        </select>
    </div> --}}
<!-- Categoria Field -->
<div class="row">
    <div class="form-group col-sm-3">
        <div class="form-floating">
            {{-- <i class="fas fa-info-circle" style="font-size:12pt; float: right;"
            title="Año en el que empezara a aplicar las vacaciones"></i> --}}
            {!! Form::number('inicio_conteo', null, [
                'class' => 'form-control',
                'min' => 1,
                'placeholder' => 'Ingrese el año en que se aplicara el beneficio...',
            ]) !!}
            <label for="inicio_conteo" class="required"> Año de inicio del beneficio</label>
            {{-- {!! Form::label('inicio_conteo', 'Año de inicio:', ['class' => 'required']) !!} --}}
        </div>
    </div>
    <!-- Categoria Field -->
    <div class="form-group col-sm-3">
        <div class="form-floating">
            {{-- <i class="fas fa-info-circle" style="font-size:12pt; float: right;"
            title="Año en el que empezara a aplicar las vacaciones"></i> --}}
            {!! Form::number('fin_conteo', null, [
                'class' => 'form-control',
                'min' => 1,
                'placeholder' => 'Ingrese el año en que se aplicara el beneficio...',
            ]) !!}
            <label for="fin_conteo" class="required"> Año fin del beneficio</label>
            {{-- {!! Form::label('inicio_conteo', 'Año de inicio:', ['class' => 'required']) !!} --}}
        </div>
    </div>
</div>
<!-- Categoria Field -->
<div class="row">
    <div class="form-group col-sm-3">
        <div class="form-floating">
            {{-- <i class="fas fa-info-circle" style="font-size:12pt; float: right;"
        title="Días otorgados en el lapso de años seleccionados anteriormente"></i> --}}
            {!! Form::number('dias', null, [
                'class' => 'form-control',
                'min' => 1,
                'max' => 24,
                'placeholder' => 'Ingrese numero inicial de días...',
            ]) !!}
            {!! Form::label('dias', 'Días a gozar:', ['class' => 'required']) !!}
        </div>
    </div>

    {{-- <div class="form-group col-sm-6">
        <i
        class="fas fa-info-circle" style="font-size:12pt; float: right;"
        title="Incremento de días anual en el lapso seleccionado"></i>{!! Form::label('incremento_dias', 'Incremento de días anual:', ['class' => 'required']) !!}
        {!! Form::number('incremento_dias', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'placeholder' => 'Ingrese numero de días a incrementar...']) !!}
    </div> --}}

    <div class="form-group col-sm-3">
        {{-- <i class="fas fa-info-circle" style="font-size:12pt; float: right;"
            title="Medida de tiempo para aplicar proxima regla;
        1.- Aniversario (Cuando el colaborador cumpla años en la organización)
        2.- Anual (Cada inicio de año calendario)"></i> --}}
        <div class="form-floating">
            <select id="periodo_corte" name="periodo_corte" class="form-control">
                <option value="1"
                    {{ old('periodo_corte') == $vacacion->periodo_corte ? ' selected="selected"' : '' }}>
                    Aniversario
                </option>
                <option value="2"
                    {{ old('periodo_corte') == $vacacion->periodo_corte ? ' selected="selected"' : '' }}>
                    Anual</option>
                <option disabled {{ old('periodo_corte') == $vacacion->periodo_corte ? ' selected="selected"' : '' }}>
                    Seleccione...</option>
            </select>
            {!! Form::label('periodo_corte', 'Reinicio de conteo', ['class' => 'required']) !!}
        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    <label for="afectados" class="required">
        Colaboradores a los que aplica :
    </label>

</div>
@php
    $visible = $vacacion->afectados == 2 ? true : false;
@endphp
<div class="col-12 form-group" x-data="{ open: @js($visible) }">

    <div class="form-check col-12">
        <input class="form-check-input" type="radio" name="afectados" value="1" x-on:click="open = false"
            {{ old('afectados', $vacacion->afectados) == 1 ? 'checked' : '' }}>
        <label class="form-check-label" for="exampleRadios1">
            Toda la Empresa
        </label>
    </div>

    <div class="form-check col-12 mt-2">
        <input class="form-check-input" type="radio" name="afectados" value="2" x-on:click="open = true"
            {{ old('afectados', $vacacion->afectados) == 2 ? 'checked' : '' }}>
        <label class="form-check-label" for="exampleRadios2">
            Área(s) Especificas
        </label>
    </div>

    <div class="form-group col-sm-12 mt-4" x-show="open">
        <label for="normas" class="label-select">Área(s) a
            aplicar</label>
        <select
            class="form-control js-example-basic-multiple areas-select  {{ $errors->has('controles') ? 'is-invalid' : '' }}"
            name="areas[]" id="areas" multiple="multiple" x-bind:disabled="!open">
            @foreach ($areas as $area)
                <option value="{{ $area->id }}" data-area="{{ $area->area }}"
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
    </div>
</div>


<!-- Submit Field -->
<div class="text-right form-group col-12">
    <a href="{{ route('admin.vacaciones.index') }}" class="btn btn-outline-primary">Regresar</a>
    <button class="btn btn-danger" type="submit">
        {{ trans('global.save') }}
    </button>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {

            $('.areas-select').select2({
                'theme': 'bootstrap4'
            });

        });
    </script>
@endsection
