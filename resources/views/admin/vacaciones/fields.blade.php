<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-6 anima-focus">
        {!! Form::text('nombre', null, [
            'class' => 'form-control',
            'minlength' => 1,
            'maxlength' => 255,
            'placeholder' => '',
            'required',
        ]) !!}
        <label for="nombre" class="required">Nombre del lineamiento de Vacaciones:</label>
        {{-- {!! Form::label('nombre', 'Nombre:', ['class' => 'required']) !!} --}}
    </div>
    <div class="form-group col-sm-6 anima-focus">
        {{-- <i class="fas fa-info-circle" style="font-size:12pt; float: right;"
            title="Tipo de discriminación de días;
            1.- Natural (Se cuenta de Lunes a Domingo)
            2.- Habil ((Se cuenta de Lunes a Viernes)"></i> --}}
        <select id="tipo_conteo" name="tipo_conteo" class="form-control" required>
            <option value="1" {{ old('tipo_conteo') == $vacacion->tipo_conteo ? ' selected="selected"' : '' }}>
                Día Natural</option>
            <option value="2" {{ old('tipo_conteo') == $vacacion->tipo_conteo ? ' selected="selected"' : '' }}>
                Día Hábil</option>
            <option disabled {{ old('tipo_conteo') == $vacacion->tipo_conteo ? ' selected="selected"' : '' }}>
                Seleccione...</option>
        </select>
        <label for="tipo_conteo">Tipo de
            conteo <sup class="asterisco">*</sup></label>
    </div>
</div>

<!-- Descripcion Field -->
<div class="row">
    <div class="form-group col-sm-12 anima-focus">
        {{-- <i
        class="fas fa-file-alt iconos-crear"></i> --}}
        <textarea class="form-control" id="descripcion" name="descripcion" rows="2">
                {{ old('descripcion', $vacacion->descripcion) }}
            </textarea>
        <label for="descripcion">Descripción <sup class="asterisco">*</sup></label>
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
    <div class="form-group col-sm-3 anima-focus">
        {{-- <i class="fas fa-info-circle" style="font-size:12pt; float: right;"
            title="Año en el que empezara a aplicar las vacaciones"></i> --}}
        {!! Form::number('inicio_conteo', null, [
            'class' => 'form-control',
            'min' => 1,
            'placeholder' => ' ',
            'required',
        ]) !!}
        <label for="inicio_conteo"> Año de inicio del beneficio <sup class="asterisco">*</sup></label>
        {{-- {!! Form::label('inicio_conteo', 'Año de inicio:', ['class' => 'required']) !!} --}}
    </div>
    <!-- Categoria Field -->
    <div class="form-group col-sm-3 anima-focus">
        {{-- <i class="fas fa-info-circle" style="font-size:12pt; float: right;"
            title="Año en el que empezara a aplicar las vacaciones"></i> --}}
        {!! Form::number('fin_conteo', null, [
            'class' => 'form-control',
            'min' => 1,
            'placeholder' => ' ',
            'required',
        ]) !!}
        <label for="fin_conteo"> Año fin del beneficio <sup class="asterisco">*</sup></label>
        {{-- {!! Form::label('inicio_conteo', 'Año de inicio:', ['class' => 'required']) !!} --}}
    </div>
</div>
<!-- Categoria Field -->
<div class="row">
    <div class="form-group col-sm-3 anima-focus">
        {{-- <i class="fas fa-info-circle" style="font-size:12pt; float: right;"
        title="Días otorgados en el lapso de años seleccionados anteriormente"></i> --}}
        {!! Form::number('dias', null, [
            'class' => 'form-control',
            'min' => 1,
            'max' => 24,
            'placeholder' => ' ',
            'required',
        ]) !!}
        <label for="dias">Días a gozar:<sup class="asterisco">*</sup></label>
    </div>

    {{-- <div class="form-group col-sm-6">
        <i
        class="fas fa-info-circle" style="font-size:12pt; float: right;"
        title="Incremento de días anual en el lapso seleccionado"></i>{!! Form::label('incremento_dias', 'Incremento de días anual:', ['class' => 'required']) !!}
        {!! Form::number('incremento_dias', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255, 'placeholder' => 'Ingrese numero de días a incrementar...']) !!}
    </div> --}}

    <div class="form-group col-sm-3 anima-focus">
        {{-- <i class="fas fa-info-circle" style="font-size:12pt; float: right;"
            title="Medida de tiempo para aplicar proxima regla;
        1.- Aniversario (Cuando el colaborador cumpla años en la organización)
        2.- Anual (Cada inicio de año calendario)"></i> --}}
        <select id="periodo_corte" name="periodo_corte" class="form-control" required>
            <option value="1" {{ old('periodo_corte') == $vacacion->periodo_corte ? ' selected="selected"' : '' }}>
                Aniversario
            </option>
            <option value="2" {{ old('periodo_corte') == $vacacion->periodo_corte ? ' selected="selected"' : '' }}>
                Anual</option>
            <option disabled {{ old('periodo_corte') == $vacacion->periodo_corte ? ' selected="selected"' : '' }}>
                Seleccione...</option>
        </select>
        <label for="periodo_corte">Reinicio de conteo<sup class="asterisco">*</sup></label>
    </div>
</div>

<hr>

<span style="color: #306BA9; font-size:18px;">Colaboradores a los que aplica : </span>

@php
    $visible = $vacacion->afectados == 2 ? true : false;
@endphp
<div class="mt-3" x-data="{ open: @js($visible) }">

    <div class="form-check">
        <input class="form-check-input" type="radio" name="afectados" value="1" x-on:click="open = false"
            {{ old('afectados', $vacacion->afectados) == 1 ? 'checked' : '' }}>
        <label class="form-check-label" for="exampleRadios1">
            Toda la Empresa <sup class="asterisco">*</sup>
        </label>
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="afectados" value="2" x-on:click="open = true"
            {{ old('afectados', $vacacion->afectados) == 2 ? 'checked' : '' }}>
        <label class="form-check-label" for="exampleRadios2">
            Área(s) Especificas <sup class="asterisco">*</sup>
        </label>
    </div>

    <div class="form-group anima-focus" x-show="open">
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
        <label for="normas">Área(s) a aplicar</label>
    </div>
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
