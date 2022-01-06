@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.partes-interesadas.create') }}

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"> <strong>Editar:</strong> Partes Interesadas </h3>
        </div>

        <div class="card-body">
            <form method="POST" class="row"
                action="{{ route('admin.partes-interesadas.update', [$partesInteresada->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group col-md-12">
                    <label class="required" for="parteinteresada"><i
                            class="fas fa-user-tie iconos-crear"></i>{{ trans('cruds.partesInteresada.fields.parteinteresada') }}</label>
                    <input class="form-control {{ $errors->has('parteinteresada') ? 'is-invalid' : '' }}" type="text"
                        name="parteinteresada" id="parteinteresada"
                        value="{{ old('parteinteresada', $partesInteresada->parteinteresada) }}" required>
                    @if ($errors->has('parteinteresada'))
                        <div class="invalid-feedback">
                            {{ $errors->first('parteinteresada') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.partesInteresada.fields.parteinteresada_helper') }}</span>
                </div>
                <div class="form-group col-md-12">
                    <label class="required" for="requisitos"><i
                            class="fas fa-clipboard-list iconos-crear"></i>{{ trans('cruds.partesInteresada.fields.requisitos') }}</label>
                    <textarea class="form-control {{ $errors->has('requisitos') ? 'is-invalid' : '' }}" name="requisitos"
                        id="requisitos">{{ old('requisitos', $partesInteresada->requisitos) }}</textarea>
                    @if ($errors->has('requisitos'))
                        <div class="invalid-feedback">
                            {{ $errors->first('requisitos') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.partesInteresada.fields.requisitos_helper') }}</span>
                </div>

                <div class="form-group col-md-12 col-sm-12">
                    <label for="clausala"><i class="far fa-file iconos-crear"></i> Cláusula(s)</label>
                    <select class="form-control {{ $errors->has('clausala') ? 'is-invalid' : '' }}" name="clausala"
                        id="clausala" class="select2" multiple>
                        <option value disabled>
                            Selecciona una opción</option>
                        @foreach (App\Models\PartesInteresada::CLAUSULA_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('clausala', $partesInteresada->clausala) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}</option>

                        @endforeach
                    </select>
                    @if ($errors->has('clausala'))
                        <div class="invalid-feedback">
                            {{ $errors->first('clausala') }}
                        </div>
                    @endif
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

    <script>
        $(document).ready(function() {
            $("#clausala").select2({
                theme: "bootstrap4",
            });
        });

        $(document).ready(function() {
            CKEDITOR.replace('requisitos', {
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
