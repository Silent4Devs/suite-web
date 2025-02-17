@extends('layouts.admin')
@section('content')
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Plan de Trabajo Base</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.plan-base-actividades.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="actividad"><i
                            class="fas fa-file-alt iconos-crear"></i>{{ trans('cruds.planBaseActividade.fields.actividad') }}</label>
                    <input class="form-control {{ $errors->has('actividad') ? 'is-invalid' : '' }}" type="text"
                        name="actividad" id="actividad" value="{{ old('actividad', '') }}" required>
                    @if ($errors->has('actividad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('actividad') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planBaseActividade.fields.actividad_helper') }}</span>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 col-sm-6>
                <label for="actividad_padre_id"><i
                            class="fas fa-clipboard-check iconos-crear"></i>{{ trans('cruds.planBaseActividade.fields.actividad_padre') }}</label>
                        <select class="form-control select2 {{ $errors->has('actividad_padre') ? 'is-invalid' : '' }}"
                            name="actividad_padre_id" id="actividad_padre_id">
                            @foreach ($actividad_padres as $id => $actividad_padre)
                                <option value="{{ $id }}"
                                    {{ old('actividad_padre_id') == $id ? 'selected' : '' }}>{{ $actividad_padre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('actividad_padre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('actividad_padre') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.planBaseActividade.fields.actividad_padre_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6 col-sm-6>
                <label for="ejecutar_id"><i
                            class="fas fa-cogs iconos-crear"></i>{{ trans('cruds.planBaseActividade.fields.ejecutar') }}</label>
                        <select class="form-control select2 {{ $errors->has('ejecutar') ? 'is-invalid' : '' }}"
                            name="ejecutar_id" id="ejecutar_id">
                            @foreach ($ejecutars as $id => $ejecutar)
                                <option value="{{ $id }}" {{ old('ejecutar_id') == $id ? 'selected' : '' }}>
                                    {{ $ejecutar }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('ejecutar'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ejecutar') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.planBaseActividade.fields.ejecutar_helper') }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="estatus_id"><i
                            class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.planBaseActividade.fields.estatus') }}</label>
                    <select class="form-control select2 {{ $errors->has('estatus') ? 'is-invalid' : '' }}"
                        name="estatus_id" id="estatus_id">
                        @foreach ($estatuses as $id => $estatus)
                            <option value="{{ $id }}" {{ old('estatus_id') == $id ? 'selected' : '' }}>
                                {{ $estatus }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('estatus'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estatus') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planBaseActividade.fields.estatus_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="responsable_id"><i
                            class="fas fa-user iconos-crear"></i>{{ trans('cruds.planBaseActividade.fields.responsable') }}</label>
                    <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                        name="responsable_id" id="responsable_id">
                        @foreach ($responsables as $id => $responsable)
                            <option value="{{ $id }}" {{ old('responsable_id') == $id ? 'selected' : '' }}>
                                {{ $responsable }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('responsable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('responsable') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planBaseActividade.fields.responsable_helper') }}</span>
                </div>
                <div class="form-group ">
                    <label for="colaborador_id"><i
                            class="fas fa-user iconos-crear"></i>{{ trans('cruds.planBaseActividade.fields.colaborador') }}</label>
                    <select class="form-control select2 {{ $errors->has('colaborador') ? 'is-invalid' : '' }}"
                        name="colaborador_id" id="colaborador_id">
                        @foreach ($colaboradors as $id => $colaborador)
                            <option value="{{ $id }}" {{ old('colaborador_id') == $id ? 'selected' : '' }}>
                                {{ $colaborador }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('colaborador'))
                        <div class="invalid-feedback">
                            {{ $errors->first('colaborador') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planBaseActividade.fields.colaborador_helper') }}</span>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="fecha_inicio"><i
                                class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.planBaseActividade.fields.fecha_inicio') }}</label>
                        <input class="form-control date {{ $errors->has('fecha_inicio') ? 'is-invalid' : '' }}"
                            type="text" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') }}">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                        @if ($errors->has('fecha_inicio'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_inicio') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.planBaseActividade.fields.fecha_inicio_helper') }}</span>
                    </div>
                    <div class="form-group  col-md-6 col-sm-6">
                        <label for="fecha_fin"><i
                                class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.planBaseActividade.fields.fecha_fin') }}</label>
                        <input class="form-control date {{ $errors->has('fecha_fin') ? 'is-invalid' : '' }}" type="text"
                            name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin') }}">
                        @if ($errors->has('fecha_fin'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_fin') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.planBaseActividade.fields.fecha_fin_helper') }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group  col-md-6 col-sm-6">
                        <label for="compromiso"><i
                                class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.planBaseActividade.fields.compromiso') }}</label>
                        <input class="form-control date {{ $errors->has('compromiso') ? 'is-invalid' : '' }}"
                            type="text" name="compromiso" id="compromiso" value="{{ old('compromiso') }}">
                        @if ($errors->has('compromiso'))
                            <div class="invalid-feedback">
                                {{ $errors->first('compromiso') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.planBaseActividade.fields.compromiso_helper') }}</span>
                    </div>
                    <div class="form-group  col-md-6 col-sm-6">
                        <label for="real"> <i
                                class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.planBaseActividade.fields.real') }}</label>
                        <input class="form-control date {{ $errors->has('real') ? 'is-invalid' : '' }}" type="text"
                            name="real" id="real" value="{{ old('real') }}">
                        @if ($errors->has('real'))
                            <div class="invalid-feedback">
                                {{ $errors->first('real') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.planBaseActividade.fields.real_helper') }}</span>
                    </div>
                </div>
                <div class="form-group col-12 text-right" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}"
                        class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        Dropzone.options.guiaDropzone = {
            url: '{{ route('admin.plan-base-actividades.storeMedia') }}',
            maxFilesize: 2, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2
            },
            success: function(file, response) {
                $('form').find('input[name="guia"]').remove()
                $('form').append('<input type="hidden" name="guia" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="guia"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($planBaseActividade) && $planBaseActividade->guia)
                    var file = {!! json_encode($planBaseActividade->guia) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="guia" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        };
    </script>
    <script>
        $('#fecha_fin').datepicker({
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
                                tooltip: 'Example tooltip',
                                    classes: 'active'
                            };
                        case 8:
                            return false;
                        case 12:
                            return "blue";
                    }
            }
        });

        $('#fecha_inicio').datepicker({
            format: "dd-mm-yyyy",
            todayBtn: true,
            orientation: "bottom right",
            autoclose: true,
            autoHide: true,
            beforeShowDay: function(date) {
                if (date.getMonth() == (new Date()).getMonth())
                    switch (date.getDate()) {
                        case 4:
                            return {
                                tooltip: 'Example tooltip',
                                    classes: 'active'
                            };
                        case 8:
                            return false;
                        case 12:
                            return "blue";
                    }
            }
        });
        $('#compromiso').datepicker({
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
                                tooltip: 'Example tooltip',
                                    classes: 'active'
                            };
                        case 8:
                            return false;
                        case 12:
                            return "blue";
                    }
            }
        });

        $('#real').datepicker({
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
                                tooltip: 'Seleccionar fecha',
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
