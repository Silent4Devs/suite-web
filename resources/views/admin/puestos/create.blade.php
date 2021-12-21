@extends('layouts.admin')
@section('content')

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Puesto</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.puestos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                <label class="required" for="puesto"><i class="fas fa-briefcase iconos-crear"></i>{{ trans('cruds.puesto.fields.puesto') }}</label>
                <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text" name="puesto" id="puesto" value="{{ old('puesto', '') }}" required>
                @if($errors->has('puesto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('puesto') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label for="descripcion"><i class="fas fa-file-signature iconos-crear"></i>{{ trans('cruds.puesto.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.puesto.fields.descripcion_helper') }}</span>
            </div> --}}

            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                <label for="descripcion"><i class="fas fa-file-signature iconos-crear"></i>Descripción<span class="text-danger">*</span></label>
                <textarea class="form-control date" type="text" name="descripcion" id="descripcion">
                                    {{ old('descripcion') }}
                                </textarea>
                @if ($errors->has('descripcion'))
                    <span class="text-danger">
                        {{ $errors->first('descripcion') }}
                    </span>
                @endif
            </div>

            <div class="form-group col-12 text-right" style="margin-left:15px;" >
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
