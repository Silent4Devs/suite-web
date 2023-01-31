@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.plan-auditoria.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Plan de Auditoría</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.plan-auditoria.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                {{ Form::hidden('pdf-value', 'planAuditoria') }}

                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label><i class="fas fa-ticket-alt iconos-crear"></i>Id</label>
                    <input class="form-control {{ $errors->has('id_auditoria') ? 'is-invalid' : '' }}" type="text" name="id_auditoria"
                        id="id_auditoria"  value="{{ old('id_auditoria', '') }}" maxlength="255">
                    @if ($errors->has('id_auditoria'))
                        <div class="text-danger">
                            {{ $errors->first('id_auditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-8 col-lg-8">
                    <label class="required"><i class="fas fa-clipboard-list iconos-crear"></i>Nombre de auditoría</label>
                    <input class="form-control {{ $errors->has('nombre_auditoria') ? 'is-invalid' : '' }}" type="text" maxlength="255"
                    name="nombre_auditoria" id="nombre_auditoria" value="{{ old('nombre_auditoria', '') }}" required>
                    @if ($errors->has('nombre_auditoria'))
                        <div class="text-danger">
                            {{ $errors->first('nombre_auditoria') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.auditoriaInterna.fields.alcance_helper') }}</span>
                </div>

                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="fecha_inicio_auditoria" class="required"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de inicio</label>
                    <input class=" mt-2 form-control  {{ $errors->has('fecha_inicio_auditoria') ? 'is-invalid' : '' }}"
                        name="fecha_inicio_auditoria" type="date" id="fecha_inicio_auditoria"
                        min="1945-01-01" value="{{ old('fecha_inicio_auditoria') }}" required>
                    @if ($errors->has('fecha_inicio_auditoria'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_inicio_auditoria') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="fecha_fin_auditoria" class="required"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha fin</label>
                    <input class=" mt-2 form-control  {{ $errors->has('fecha_fin_auditoria') ? 'is-invalid' : '' }}" type="date"
                        name="fecha_fin_auditoria" id="fecha_fin_auditoria"
                        min="1945-01-01" value="{{ old('fecha_fin_auditoria') }}" required>
                    @if ($errors->has('fecha_fin_auditoria'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_fin_auditoria') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                    <label for="id_equipo_auditores"><i
                            class="fas fa-users iconos-crear"></i>Equipo auditoría</label>
                    <select multiple
                        class="form-control select2 {{ $errors->has('id_equipo_auditores') ? 'is-invalid' : '' }}"
                        name="equipo[]" id="id_equipo_auditores">
                        @foreach ($equipoauditorias as $equipoauditoria)
                            <option value="{{ $equipoauditoria->id }}"
                                {{ old('id_equipo_auditores') == $equipoauditoria->id ? 'selected' : '' }}>
                                {{ $equipoauditoria->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('equipoauditoria'))
                        <div class="invalid-feedback">
                            {{ $errors->first('equipoauditoria') }}
                        </div>
                    @endif
                </div>


                <div class="form-group col-md-12">
                    <label for="objetivo" class="required"><i
                            class="fas fa-bullseye iconos-crear"></i>Objetivo de la auditoría</label>
                    <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}" name="objetivo"
                        id="objetivo" required>{{ old('objetivo') }}</textarea>
                    @if ($errors->has('objetivo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('objetivo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planAuditorium.fields.objetivo_helper') }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label for="alcance" class="required"><i
                            class="fas fa-chart-line iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.alcance') }}</label>
                    <textarea class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}" name="alcance"
                        id="alcance" required>{{ old('alcance') }}</textarea>
                    @if ($errors->has('alcance'))
                        <div class="invalid-feedback">
                            {{ $errors->first('alcance') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planAuditorium.fields.alcance_helper') }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="criterios" class="required"><i
                            class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.criterios') }}</label>
                    <textarea class="form-control {{ $errors->has('criterios') ? 'is-invalid' : '' }}" name="criterios"
                        id="criterios" required>{{ old('criterios') }}</textarea>
                    @if ($errors->has('criterios'))
                        <div class="invalid-feedback">
                            {{ $errors->first('criterios') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planAuditorium.fields.criterios_helper') }}</span>
                </div>
                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                    <label for="documentoauditar"><i
                            class="fas fa-file-alt iconos-crear"></i>{{ trans('cruds.planAuditorium.fields.documentoauditar') }}</label>
                    <textarea class="form-control {{ $errors->has('documentoauditar') ? 'is-invalid' : '' }}"
                        name="documentoauditar" id="documentoauditar">{{ old('documentoauditar') }}</textarea>
                    @if ($errors->has('documentoauditar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('documentoauditar') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.planAuditorium.fields.documentoauditar_helper') }}</span>
                </div>



                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.plan-auditoria.index') }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection


@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $("#id_equipo_auditores").select2({
                theme: "bootstrap4",
            });



        CKEDITOR.replace('criterios', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

        CKEDITOR.replace('documentoauditar', {
            toolbar: [{
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                    'Bold', 'Italic'
                ]
            }, {
                name: 'clipboard',
                items: ['Link', 'Unlink']
            }, ]
        });

        CKEDITOR.replace('objetivo', {
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
                ]
            });


            CKEDITOR.replace('alcance', {
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
                ]
            });


    });
    </script>




@endsection


