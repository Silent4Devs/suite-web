@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.partes-interesadas.create') }}


    <h5 class="col-12 titulo_general_funcion">Registrar: Partes Interesadas</h5>
    <div class="mt-4 card">

        <div class="card-body">
            <form method="POST" action="{{ route('admin.partes-interesadas.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                {{ Form::hidden('pdf-value', 'PartesInt') }}
                <div class="form-group col-md-12">
                    <label class="required" for="parteinteresada"> <i class="fas fa-user-tie iconos-crear"></i>
                        {{ trans('cruds.partesInteresada.fields.parteinteresada') }}</label>
                    <input class="form-control {{ $errors->has('parteinteresada') ? 'is-invalid' : '' }}" type="text"
                        name="parteinteresada" wire:model.lazy="parteinteresada" id="parteinteresada"
                        value="{{ old('parteinteresada', '') }}" required>
                    @if ($errors->has('parteinteresada'))
                        <div class="invalid-feedback">
                            {{ $errors->first('parteinteresada') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.partesInteresada.fields.parteinteresada_helper') }}</span>
                </div>

                {{-- @livewire('show-partes-interesadas')

                <div wire:ignore>
                    <div class="form-group col-md-12">
                        <label class="required" for="requisitos"> <i class="fas fa-clipboard-list iconos-crear"></i>
                            {{ trans('cruds.partesInteresada.fields.requisitos') }}</label>
                        <textarea class="form-control {{ $errors->has('requisitos') ? 'is-invalid' : '' }}"
                            name="requisitos" id="requisitos"
                            wire:model.lazy="requisitos">{{ old('requisitos') }}</textarea>
                        @if ($errors->has('requisitos'))
                            <div class="invalid-feedback">
                                {{ $errors->first('requisitos') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.partesInteresada.fields.requisitos_helper') }}</span>
                    </div>
                </div> --}}
                {{-- @livewire('partes-interesadas-component') --}}

                <div class="text-right form-group col-md-12">
                    <a href="{{ route('admin.partes-interesadas.index') }}" class="btn_cancelar">Cancelar</a>
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
            $("#clausulas").select2({
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
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript',
                            'Superscript',
                            '-',
                            'CopyFormatting', 'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent',
                            '-',
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

    <script src="{{ asset('js/dark_mode.js') }}"></script>
@endsection
