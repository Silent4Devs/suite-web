@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Registrar: Matríz de Riesgos</h5>
    <div class="mt-4 card">
         <div class="card-body">
            <form method="POST" action="{{ route('admin.analisis-riesgos.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="py-1 text-center form-group col-12" style="background-color:#345183; border-radius:100px; color: white;">DATOS GENERALES</div>

                <div class="form-group">
                    <p class="font-weight-bold" style="font-size:11pt;">Llene los siguientes campos según corresponda:</p>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 col-sm-4">
                        <label for="nombre"><i class="fas fa-table iconos-crear"></i>Nombre</label>
                        <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                            name="nombre" id="nombre" value="{{ old('nombre', '') }}">
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="tipo"><i class="fab fa-elementor iconos-crear"></i>Tipo </label>
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
                            id="fecha" value="{{ date('d-m-Y') }}" disabled>
                        @if ($errors->has('fecha'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha') }}
                            </div>
                        @endif
                    </div>
                    {{ Form::hidden('fecha', date('Y-m-d')) }}
                </div>

                <div class="row">
                    <div class="form-group col-md-4 col-sm-4">
                        <label for="id_empleado"><i class="fas fa-user-tie iconos-crear"></i>Elaboró </label>
                        <select class="form-control {{ $errors->has('id_empleado') ? 'is-invalid' : '' }}"
                            name="id_empleado" id="id_empleado">
                            <option value disabled {{ old('id_empleado', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach ($empleados as $key => $label)
                                <option value="{{ $label->id }}">{{ $label->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_empleado'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_empleado') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="id_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto </label>
                        <input class="form-control {{ $errors->has('id_puesto') ? 'is-invalid' : '' }}" type="text"
                            id="id_puesto" value="" disabled>
                        @if ($errors->has('id_puesto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_puesto') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4 col-sm-4">
                        <label for="id_area"><i class="fas fa-street-view iconos-crear"></i>Área </label>
                        <input class="form-control {{ $errors->has('id_area') ? 'is-invalid' : '' }}" type="text"
                            id="id_area" value="" disabled>
                        @if ($errors->has('id_area'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_area') }}
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
                        <label for="estatus"><i class="fas fa-traffic-light iconos-crear"></i>Estatus</label>
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

                <div class="text-right form-group col-12">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type=text/javascript>
        $('#id_empleado').change(function() {
            var elaboroID = $(this).val();
            if (elaboroID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/getEmployeeData') }}?id=" + elaboroID,
                    success: function(res) {
                        if (res) {
                            $("#id_puesto").empty();
                            $("#id_puesto").attr("value", res.puesto);
                            $("#id_area").empty();
                            $("#id_area").attr("value", res.area);
                        } else {
                            $("#id_puesto").empty();
                            $("#id_area").empty();
                        }
                    }
                });
            } else {
                $("#id_puesto").empty();
                $("#id_area").empty();
            }
        });
    </script>
@endsection
