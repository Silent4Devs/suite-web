@extends('layouts.admin')
@section('content')

    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong>Análisis de Riesgo</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.analisis-riesgos.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group" style="margin-top:15px; width:100%; height:25px; background-color:#1BB0B0">
                    <p class"text-center text-light" style="font-size:11pt; width:100%; margin-left:370px; color:#ffffff;">DATOS
                        GENERALES</p>
                </div>

                <div class="form-group">
                    <p class="font-weight-bold" style="font-size:11pt;">Llene los siguientes campos según corresponda:</p>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 col-sm-4">
                        <label for="nombre"><i class="fas fa-cog iconos-crear"></i>Nombre</label>
                        <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                            name="nombre" id="nombre" value="{{ old('nombre', '') }}">
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="tipo"><i class="fas fa-chart-line iconos-crear"></i>Tipo </label>
                        <select class="form-control {{ $errors->has('tipo') ? 'is-invalid' : '' }}" name="tipo" id="tipo">
                            <option value disabled {{ old('tipo', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (App\Models\AnalisisDeRiesgo::TipoSelect as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('tipo', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('tipo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tipo') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="fecha"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha</label>
                        <input class="form-control {{ $errors->has('fecha') ? 'is-invalid' : '' }}" type="text"
                            name="fecha" id="fecha" value="{{ old('fecha', '') }}">
                        @if ($errors->has('fecha'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 col-sm-4">
                        <label for="porcentaje_implementacion"><i class="fas fa-percentage iconos-crear"></i>%
                            Implementacion</label>
                        <input class="form-control {{ $errors->has('porcentaje_implementacion') ? 'is-invalid' : '' }}"
                            type="text" name="porcentaje_implementacion" id="porcentaje_implementacion"
                            value="{{ old('porcentaje_implementacion', '') }}">
                        @if ($errors->has('porcentaje_implementacion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('porcentaje_implementacion') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="id_elaboro"><i class="fas fa-chart-line iconos-crear"></i>Elaboro </label>
                        <select class="form-control {{ $errors->has('id_elaboro') ? 'is-invalid' : '' }}" name="id_elaboro"
                            id="id_elaboro">
                            <option value disabled {{ old('id_elaboro', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach ($empleados as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('id_elaboro', '') === (string) $key ? 'selected' : '' }}>{{ $label->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_elaboro'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_elaboro') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="estatus"><i class="fas fa-cog iconos-crear"></i>Estatus</label>
                        <select class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" name="estatus"
                            id="estatus">
                            <option value disabled {{ old('estatus', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach (App\Models\AnalisisDeRiesgo::EstatusSelect as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('estatus', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('estatus'))
                            <div class="invalid-feedback">
                                {{ $errors->first('estatus') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group col-12 text-right">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#fecha').datepicker({
            format: "dd-mm-yyyy",
            todayBtn: true,
            language: "es",
            orientation: "bottom right",
            autoclose: true,
            autoHide: true,
            beforeShowDay: function(date) {
                if (date.getMonth() == (new Date()).getMonth())
                    switch (date.getDate()) {
                        case 4:
                            return {
                                tooltip: 'Seleccione una fecha',
                                    classes: 'active'
                            };
                        case 8:
                            return false;
                        case 12:
                            return "blue";
                    }
            }
        });
    </script>
@endsection
