<div class="form-group">
    <label for="nombre" class="required"><i class="fas fa-pencil mr-2"></i>Nombre</label>
    <input required type="text" value="{{ old('nombre', $tiposObjetivosSistema->nombre) }}" class="form-control" id="nombre"
        name="nombre" placeholder="">
    <p class="m-0"><small><i class="fas fa-info-circle mr-2"></i> El campo slug se genera automáticamente a partir
            del nombre, el slug debe ser único</small></p>
    @if ($errors->has('nombre'))
        <small class="text-danger">
            {{ $errors->first('nombre') }}
        </small>
    @endif
    <p class="m-0"><small><strong><i class="fas fa-info-circle mr-2"></i> Slug:</strong> <span
                id="slug"></span></small></p>
    @if ($errors->has('slug'))
        <small class="text-danger">
            {{ $errors->first('slug') }}
        </small>
    @endif
    <br>
    <label for="nombre"><i class="fas fa-pen mr-2"></i>Descripción</label>
    <textarea name="descripcion" class="form-control" id="descripcion" cols="10" rows="10">{{ old('descripcion', $tiposObjetivosSistema->descripcion) }}</textarea>
    @if ($errors->has('descripcion'))
        <small class="text-danger">
            {{ $errors->first('descripcion') }}
        </small>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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

            ]
        });
        let slugE = document.getElementById('slug');
        let nombreE = document.getElementById('nombre');
        slugE.innerHTML = obtenerSlug(nombreE.value) != '' ? obtenerSlug(nombreE.value) : 'Sin slug';

        nombreE.addEventListener('keyup', function() {
            slugE.innerHTML = obtenerSlug(this.value);
        });

        function obtenerSlug(value) {
            return value.toLowerCase().replace(/ /g, '-')
        }
    });
</script>
