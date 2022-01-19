<style>
    .select2-selection--multiple {
        overflow: hidden !important;
        height: auto !important;
        padding: 0 5px 5px 5px !important;
    }

    .select2-container {
        margin-top: 10px !important;
    }

</style>
<div class="row">
    <div class="col-12">
        <p class="text-muted m-0"><i class="fas fa-info-circle"></i> Establece la conducta esperada para esta competencia
        </p>
        <p id="nivelEditCreate" class="text-muted m-0"> <i class="fas fa-circle-notch fa-spin mr-2"></i> Cargando...</p>
    </div>
    <div class="col-sm-12 col-lg-12 col-md-12 col-12" style="margin-top:30px;">
        <div class="form-group">
            <label for="definicion">
                <i class="fas fa-pencil-alt iconos-crear"></i> Descripción de la conducta esperada
            </label>
            <textarea class="form-control {{ $errors->has('definicion') ? 'is-invalid' : '' }}" name="definicion" id=""
                cols="30" rows="10">{{ old('definicion') }}</textarea>
            <small id="definicionHelp" class="form-text text-muted">Ingresa la descripción de la conducta esperada por
                parte de los empleados de la organización para este nivel.</small>
            <span class="errors definicion_error text-danger"></span>
        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        CKEDITOR.replace('definicion', {
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
    })
</script>
