@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('perfil-puesto-edit', $puesto) }}
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Editar: </strong> Puesto </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.puestos.update', [$puesto->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="puesto">{{ trans('cruds.puesto.fields.puesto') }}</label>
                        <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text" name="puesto"
                            id="puesto" value="{{ old('puesto', $puesto->puesto) }}" required>
                        @if ($errors->has('puesto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('puesto') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span>
                    </div>
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label for="id_reporta"><i class="fas fa-user-tie iconos-crear"></i>Reporta a</label>
                        <select class="form-control {{ $errors->has('id_reporta') ? 'is-invalid' : '' }}" name="id_reporta" id="id_reporta" value="{{ $puesto->id_reporta }}">
                            @foreach ($reportas as $reporta)
                            <option  value="{{ $reporta->id }}" {{ $puesto->id_reporta == $reporta->id ? 'selected' : '' }}>
                                {{$reporta->name}}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('reporta'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_reporta') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label for="id_area"><i class="fas fa-user-tie iconos-crear"></i>Área</label>
                        <select class="form-control {{ $errors->has('id_area') ? 'is-invalid' : '' }}" name="id_area" id="id_area" value="{{ $puesto->id_area}}">
                            @foreach ($areas as $area)
                            <option  value="{{ $area->id }}" {{ $puesto->id_area == $area->id ? 'selected' : '' }}>
                                {{ $area->area }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_area'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_area') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="descripcion">{{ trans('cruds.puesto.fields.descripcion') }}</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                        name="descripcion"
                        id="descripcion">{{ old('descripcion', strip_tags($puesto->descripcion)) }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.puesto.fields.descripcion_helper') }}</span>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="estudios"><i class="fas fa-file-signature iconos-crear"></i>Estudios<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="estudios" id="estudios">
                                            {{ old('estudios', strip_tags($puesto->estudios)) }}
                                        </textarea>
                        @if ($errors->has('estudios'))
                            <span class="text-danger">
                                {{ $errors->first('estudios') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="experiencia"><i class="fas fa-file-signature iconos-crear"></i>Experiencia<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="experiencia" id="experiencia">
                                            {{ old('experiencia', strip_tags($puesto->experiencia)) }}
                                        </textarea>
                        @if ($errors->has('experiencia'))
                            <span class="text-danger">
                                {{ $errors->first('experiencia') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="conocimientos"><i class="fas fa-file-signature iconos-crear"></i>Conocimientos<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="conocimientos" id="conocimientos">
                                            {{ old('conocimientos', strip_tags($puesto->conocimientos)) }}
                                        </textarea>
                        @if ($errors->has('conocimientos'))
                            <span class="text-danger">
                                {{ $errors->first('conocimientos') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="certificaciones"><i class="fas fa-file-signature iconos-crear"></i>Certificaciones<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="certificaciones" id="certificaciones">
                                            {{ old('certificaciones', strip_tags($puesto->certificaciones)) }}
                                        </textarea>
                        @if ($errors->has('certificaciones'))
                            <span class="text-danger">
                                {{ $errors->first('certificaciones') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="conocimientos_esp"><i class="fas fa-file-signature iconos-crear"></i>Conocimientos Especiales<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="conocimientos_esp" id="conocimientos_esp">
                                            {{ old('conocimientos_esp', strip_tags($puesto->conocimientos_esp)) }}
                                        </textarea>
                        @if ($errors->has('conocimientos_esp'))
                            <span class="text-danger">
                                {{ $errors->first('conocimientos_esp') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-sm-3 col-md-3 col-lg-3">
                        <label for="idioma"><i class="fas fa-user-tie iconos-crear"></i>Idioma</label>
                        <select class="form-control {{ $errors->has('idioma') ? 'is-invalid' : '' }}" name="idioma" id="idioma" value="{{ $puesto->idioma}}">
                            @foreach ($lenguajes as $lenguaje)
                            <option  value={{$lenguaje->abr}} >{{ $lenguaje->idioma }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('idioma'))
                        <div class="invalid-feedback">
                            {{ $errors->first('idioma') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-3 col-md-3 col-lg-3">
                        <label class="required" for="porcentaje"><i
                                class="fas fa-briefcase iconos-crear"></i>Porcentaje</label>
                        <input class="form-control {{ $errors->has('porcentaje') ? 'is-invalid' : '' }}" type="number" name="porcentaje"
                            id="porcentaje" value="{{ old('porcentaje',strip_tags($puesto->porcentaje)) }}"  min="0" max="100" required>
                        @if ($errors->has('porcentaje'))
                            <div class="invalid-feedback">
                                {{ $errors->first('porcentaje') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="sueldo"><i
                                class="fas fa-briefcase iconos-crear"></i>Sueldo</label>
                        <input class="form-control {{ $errors->has('sueldo') ? 'is-invalid' : '' }}" type="number" name="sueldo"
                            id="sueldo" value="{{ old('sueldo',strip_tags($puesto->sueldo)) }}" required>
                        @if ($errors->has('sueldo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('sueldo') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label for="lugar_trabajo"><i class="fas fa-user-tie iconos-crear"></i>Lugar de trabajo</label>
                        <select class="form-control {{ $errors->has('lugar_trabajo') ? 'is-invalid' : '' }}" name="lugar_trabajo" id="lugar_trabajo" >
                            <option value="{{ $puesto->lugar_trabajo}}" selected>Selecciona</option>
                            <option value="Home Office">Home Office</option>
                            <option value="Oficina">Oficina</option>
                            <option value="Cliente">Cliente</option>
                        </select>
                        @if ($errors->has('lugar_trabajo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lugar_trabajo') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="horario"><i
                                class="fas fa-briefcase iconos-crear"></i>Horario</label>
                        <input class="form-control {{ $errors->has('horario') ? 'is-invalid' : '' }}" type="text" name="horario"
                            id="horario" value="{{ old('horario', strip_tags($puesto->horario)) }}" required>
                        @if ($errors->has('horario'))
                            <div class="invalid-feedback">
                                {{ $errors->first('horario') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="edad"><i
                                class="fas fa-briefcase iconos-crear"></i>Edad</label>
                        <input class="form-control {{ $errors->has('edad') ? 'is-invalid' : '' }}" type="number" name="edad"
                            id="edad" value="{{ old('edad', strip_tags($puesto->edad)) }}" required>
                        @if ($errors->has('edad'))
                            <div class="invalid-feedback">
                                {{ $errors->first('edad') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="genero"><i
                                class="fas fa-briefcase iconos-crear"></i>Género</label>
                        <select class="form-control {{ $errors->has('genero') ? 'is-invalid' : '' }}" name="genero" id="genero">
                            <option value="" selected>Selecciona</option>
                            <option value="Office">Hombre</option>
                            <option value="Oficina">Mujer</option>
                            <option value="Cliente">Indistinto</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="estado_civil"><i
                                class="fas fa-briefcase iconos-crear"></i>Estado Civil</label>
                        <select class="form-control {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}" name="estado_civil" id="estado_civil">
                            <option value="" selected>Selecciona</option>
                            <option value="Office">Soltero(a)</option>
                            <option value="Oficina">Casado(a)</option>
                            <option value="Cliente">Indistinto</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
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
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('descripcion', {
                toolbar: [{
                        name: 'styles',
                        items: ['Styles', 'Format', 'Font', 'FontSize']
                    },
                    {
                        name: 'colors',
                        items: ['TextColor', 'BGColor']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker'],
                        items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                    }, {
                        name: 'clipboard',
                        groups: ['undo'],
                        items: ['Undo', 'Redo']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    },
                    {
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup'],
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                            '-',
                            'CopyFormatting', 'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                            'Blockquote',
                            '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                            'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'insert',
                        items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar']
                    },
                    '/',


                    // {
                    //     name: 'others',
                    //     items: ['-']
                    // }
                ]
            });

        });
    </script>

@endsection
