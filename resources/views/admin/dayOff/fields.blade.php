<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-6 anima-focus">
        {{-- <i class="fas fa-id-card iconos-crear"></i><i
        class="fas fa-info-circle" style="font-size:12pt; float: right;"
        title="Nombre del lineamiento"></i> --}}
        {!! Form::text('nombre', null, [
            'class' => 'form-control',
            'minlength' => 1,
            'maxlength' => 255,
            'placeholder' => '',
            'required',
        ]) !!}
        {!! Form::label('nombre', 'Nombre del lineamiento de DayOff:', ['class' => 'asterisco']) !!}
    </div>
    <div class="form-group col-sm-6 anima-focus">
        {{-- <i class="fa-solid fa-calendar-days iconos-crear"></i> --}}
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
        <label for="tipo_conteo" class="asterisco"> Tipo de
            conteo</label>
    </div>
</div>

<div class="row">
    <!-- Descripcion Field -->
    <div class="form-group col-sm-12 anima-focus">
        {{-- <i
                class="fas fa-file-alt iconos-crear"></i> --}}
        <textarea class="form-control" id="descripcion" name="descripcion" rows="2" placeholder=" ">
                {{ old('descripcion', $vacacion->descripcion) }}
            </textarea>
        {!! Form::label('descripcion', 'Descripción:') !!}
    </div>
</div>

<div class="row" x-data="{ otro: {{ old('inicio_conteo', $vacacion->inicio_conteo) == 2 ? 'true' : 'false' }} }">
    <div class="form-group col-sm-3">
        {!! Form::label('inicio_conteo', 'Inicio del beneficio', ['class' => 'required']) !!}
        <div class="form-check col-12">
            <input class="form-check-input" type="radio" name="inicio_conteo" value="1" x-on:click="otro = false"
                {{ old('inicio_conteo', $vacacion->inicio_conteo) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="exampleRadios1">
                Al ingreso
            </label>
        </div>

        <div class="form-check col-12 mt-2">
            <input class="form-check-input" type="radio" name="inicio_conteo" value="2" x-on:click="otro = true"
                {{ old('inicio_conteo', $vacacion->inicio_conteo) == 2 ? 'checked' : '' }}>
            <label class="form-check-label" for="exampleRadios2">
                Otro
            </label>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-3 mt-4" x-show="otro">
            <div class="form-floating">
                <input type="number" class="form-control" id="meses" name="meses"
                    value="{{ old('meses', $vacacion->meses) }}" placeholder="Ingrese numero de meses..."
                    x-bind:disabled="!otro" required>
                <label for="meses">Inicio del beneficio en meses:</label>
            </div>
        </div>
    </div>
</div><br>

<div class="row">
    <!-- Categoria Field -->
    <div class="form-group col-sm-3 anima-focus">
        {{-- <i class="fa-solid fa-calendar-day iconos-crear"></i><i class="fas fa-info-circle"
            style="font-size:12pt; float: right;" title="Días otorgados por la organización"></i> --}}
        {!! Form::number('dias', null, [
            'class' => 'form-control',
            'min' => 1,
            'max' => 365,
            'placeholder' => '',
            'required',
        ]) !!}
        {!! Form::label('dias', 'Días a gozar:', ['class' => 'required']) !!}
    </div>
    {{-- <div class="form-group col-sm-6">
        <i class="fa-solid fa-arrow-up-9-1 iconos-crear"></i>{!! Form::label('incremento_dias', 'Incremento de días:', ['class' => 'required']) !!}
        {!! Form::number('incremento_dias', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255,'placeholder' =>'Ingrese numero de días a incrementar...']) !!}
    </div> --}}


    <div class="form-group col-sm-3 anima-focus">
        {{-- <i class="fa-solid fa-calendar-plus iconos-crear"></i><i class="fas fa-info-circle"
            style="font-size:12pt; float: right;"
            title="Medida de tiempo para aplicar proxima regla;
        1.- Aniversario (Cuando el colaborador cumpla años en la organizacíon)
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
        {!! Form::label('periodo_corte', 'Periodo de corte', ['class' => 'required']) !!}
    </div>
</div>
<div class="row">

    <div class="form-group col-sm-12">
        <label for="afectados" class="required">
            {{-- <i class="fa-solid fa-people-line iconos-crear"></i> --}}
            Colaboradores a los que aplica :
        </label>
        @if ($errors->has('custom_areas'))
            <div class="alert alert-danger">
                {{ $errors->first('custom_areas') }}
            </div>
        @endif
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
            <label for="normas" class="label-select">
                {{-- <i
                    class="fa-solid fa-arrows-down-to-people iconos-crear"></i> --}}
                Área(s) a
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
