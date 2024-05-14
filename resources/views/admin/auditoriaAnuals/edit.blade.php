@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.auditoria-anuals.create') }}
    <h5 class="col-12 titulo_general_funcion">Programa Anual de Auditoría </h5>
            <div class="card card-body" style="background-color: #5397D5; color: #fff;">
                <div class="d-flex" style="gap: 25px;">
                    <img src="{{ asset('img/audit_port.jpg') }}" alt="Auditoria" style="width: 200px;">
                    <div>
                        <br>
                        <h4>¿Qué es Programa Anual de Auditoria?</h4>
                        <p>
                            Define y documenta de manera detallada qué trabajo se llevará a cabo y qué no se incluirá dentro de los
                            límites del proyecto.
                        </p>
                        <p>
                            Es un paso crucial que establece las bases para la planificación y ejecución exitosa de un proyecto, ya
                            que ayuda a evitar
                            la expansión no controlada del proyecto y asegura que todas las partes involucradas tengan una
                            comprensión clara de lo que se espera.
                        </p>
                    </div>
                </div>
            </div>
<div class="mt-4 card">
    <div class="card-body">
        <form method="POST" class="row" action="{{ route("admin.auditoria-anuals.update", [$auditoriaAnual->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group col-md-12 col-sm-12">
                <label for="nombre" class="required"><i class="fas fa-clipboard-list iconos-crear"></i>Nombre</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                    name="nombre" id="nombre" value="{{ old('nombre', $auditoriaAnual->nombre) }}" required>
                @if ($errors->has('nombre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 mb-3">
                <span style="font-size: 15px; font-weight: bold;">
                    Periodo</span>
            </div>

            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                <label for="fechainicio"> <i class="fas fa-calendar-alt iconos-crear"></i>Fecha de inicio</label>
                <input class="form-control {{ $errors->has('fechainicio') ? 'is-invalid' : '' }}" type="date"
                name="fechainicio" id="fechainicio" min="1945-01-01"
                value="{{ old('fechainicio', $auditoriaAnual->fechainicio ? \Carbon\Carbon::parse($auditoriaAnual->fechainicio)->format('Y-m-d') : null) }}">
                @if($errors->has('fechainicio'))
                <div class="invalid-feedback">
                    {{ $errors->first('fechainicio') }}
                </div>
                @endif
            </div>

            <div class="form-group col-sm-12 col-md-6 col-lg-6">
                <label for="fechafin"> <i class="fas fa-calendar-alt iconos-crear"></i>Fecha fin</label>
                <input class="form-control {{ $errors->has('fechafin', $auditoriaAnual->fechafin) ? 'is-invalid' : '' }}" type="date"
                name="fechafin" id="fechafin" min="1945-01-01"
                value="{{ old('fechafin', $auditoriaAnual->fechafin ? \Carbon\Carbon::parse($auditoriaAnual->fechafin)->format('Y-m-d') : null) }}">
                @if($errors->has('fechafin'))
                <div class="invalid-feedback">
                    {{ $errors->first('fechafin') }}
                </div>
                @endif
            </div>

            <div class="form-group col-md-12 col-sm-12  mt-3">
                <label for="objetivo" class="required"><i class="fas fa-bullseye iconos-crear"></i>Objetivo</label>
                <textarea class="form-control {{ $errors->has('objetivo') ? 'is-invalid' : '' }}"
                    name="objetivo" id="objetivo" required>{{ old('objetivo', $auditoriaAnual->objetivo) }}</textarea>
                @if($errors->has('objetivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objetivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaAnual.fields.observaciones_helper') }}</span>
            </div>

            <div class="form-group col-md-12 col-sm-12  mt-3">
                <label for="alcance" class="required"><i class="fas fa-chart-line iconos-crear"></i>Alcance</label>
                <textarea class="form-control {{ $errors->has('alcance') ? 'is-invalid' : '' }}"
                    name="alcance" id="alcance" required>{{ old('alcance', $auditoriaAnual->alcance) }}</textarea>
                @if($errors->has('alcance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alcance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.auditoriaAnual.fields.observaciones_helper') }}</span>
            </div>


            <div class="text-right form-group col-12">
                <a href="{{ route("admin.auditoria-anuals.index") }}" class="btn_cancelar">Cancelar</a>
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
