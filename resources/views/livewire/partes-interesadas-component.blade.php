<div>
    <div class="row">
        <div class="form-group col-sm-12" wire:ignore>
            <label for="norma"><i class="fas fa-ruler-vertical iconos-crear"></i> Norma(s)</label>
            <select class="form-control" name="norma" wire:model="norma_id" id="norma">
                <option value="0" selected>Selecciona una norma para mostrar su formulario</option>
                <option value="1">ISO 27001</option>
                <option value="1">ISO 9001</option>
            </select>
        </div>
    </div>
    <div wire:loading wire:target="norma_id">
        <div class="spinner-grow text-primary" role="status">
            <span class="visually-hidden"></span>
        </div>
        <div class="spinner-grow text-secondary" role="status">
            <span class="visually-hidden"></span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="visually-hidden"></span>
        </div>
        <div class="spinner-grow text-danger" role="status">
            <span class="visually-hidden"></span>
        </div>
        <div class="spinner-grow text-warning" role="status">
            <span class="visually-hidden"></span>
        </div>
        <div class="spinner-grow text-info" role="status">
            <span class="visually-hidden"></span>
        </div>
        <div class="spinner-grow text-light" role="status">
            <span class="visually-hidden"></span>
        </div>
        <div class="spinner-grow text-dark" role="status">
            <span class="visually-hidden"></span>
        </div>
        <strong>Loading...</strong>
    </div>
    <div wire:loading.remove wire:target="norma_id">
        @switch($norma_id)
            @case(0)
                <div class="row py-2">
                    <div class="col-12" align="center">
                        <img src="{{ asset('img/information.svg') }}" width="50%;" alt="information"
                            class="img-fluid">
                    </div>
                </div>
            @break
            @case(1)
                <form method="POST" action="{{ route('admin.partes-interesadas.store') }}" enctype="multipart/form-data"
                    class="row">
                    @csrf
                    {{ Form::hidden('pdf-value', 'PartesInt') }}
                    <div class="form-group col-md-12">
                        <label class="required" for="parteinteresada"> <i class="fas fa-user-tie iconos-crear"></i>
                            {{ trans('cruds.partesInteresada.fields.parteinteresada') }}</label>
                        <input class="form-control {{ $errors->has('parteinteresada') ? 'is-invalid' : '' }}" type="text"
                            name="parteinteresada" wire:model.lazy="parteinteresada" id="parteinteresada" value="{{ old('parteinteresada', '') }}" required>
                        @if ($errors->has('parteinteresada'))
                            <div class="invalid-feedback">
                                {{ $errors->first('parteinteresada') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.partesInteresada.fields.parteinteresada_helper') }}</span>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="required" for="requisitos"> <i class="fas fa-clipboard-list iconos-crear"></i>
                            {{ trans('cruds.partesInteresada.fields.requisitos') }}</label>
                        <textarea class="form-control {{ $errors->has('requisitos') ? 'is-invalid' : '' }}"
                            name="requisitos" id="requisitos" wire:model.lazy="requisitos">{{ old('requisitos') }}</textarea>
                        @if ($errors->has('requisitos'))
                            <div class="invalid-feedback">
                                {{ $errors->first('requisitos') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.partesInteresada.fields.requisitos_helper') }}</span>
                    </div>


                    {{-- <div class="form-group col-sm-12">
                    <label for="clausala"><i class="far fa-file iconos-crear"></i> Cláusula(s)</label>
                    <select class="form-control {{ $errors->has('clausala') ? 'is-invalid' : '' }}" name="clausala"
                        id="clausala" class="select2" multiple>
                        <option value disabled >
                            Selecciona una opción</option>
                        @foreach (App\Models\PartesInteresada::CLAUSULA_SELECT as $id => $clausula)
                            <option value="{{ $id }}"
                                {{ (old('clausala') ? old('clausala') : $clausula->clausala ?? '') == $id ? 'selected' : '' }}>
                                {{ $clausula }} </option>
                        @endforeach
                    </select>
                    <span class="errors tipo_error"></span>
                </div> --}}


                    <div class="form-group col-sm-12" wire:ignore>
                        <label for="clausulas"><i class="far fa-file iconos-crear"></i> Cláusula(s)</label>
                        <select class="form-control {{ $errors->has('clausulas') ? 'is-invalid' : '' }}"
                            name="clausulas[]" id="clausulas" multiple>
                            <option value disabled>Selecciona una opción</option>
                            @foreach ($clausulas as $clausula)
                                <option value="{{ $clausula->id }}">
                                    {{ $clausula->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <span class="errors tipo_error"></span>
                    </div>




                    <div class="text-right form-group col-md-12">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            @break
            @case(2)
                Iso 9001
            @break

            @default

        @endswitch
    </div>

    @section('scripts')
        <script type="text/javascript">
            window.addEventListener('formulario-updated', event => {
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

            })
        </script>

        <script src="{{ asset('js/dark_mode.js') }}"></script>


    @endsection


</div>
