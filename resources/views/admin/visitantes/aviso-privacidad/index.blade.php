@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Aviso de Privacidad</h5>
    <div class="card">
        <div class="card-body">
            <span><i class="fas fa-info-circle"></i></span>
            <p style="display: inline-block" id="ultima-modificacion">
                Última modificación realizada el
                <strong>{{ \Carbon\Carbon::parse($aviso_privacidad->updated_at)->format('d-m-Y H:i:s') }}</strong>
            </p>
            <form action="{{ route('admin.visitantes.aviso-privacidad.store') }}">

                <textarea name="aviso-privacidad" id="aviso-privacidad" cols="30" rows="20"
                    style="width: 100%; min-height: 300px; border: 2px solid #A5C2FF;
                    border-radius: 8px; font-size: 14px; background-color: white;
                    padding: 20px; resize: both; overflow: auto; color: black;">
                    {!! $aviso_privacidad->aviso_privacidad !!}
                </textarea>
                
            </form>
            {{-- Regresar al menú --}}
            <a href="{{ route('admin.visitantes.menu') }}" class="mt-4 btn btn-primary float-right">
                Regresar
            </a>
        </div>
    </div>

    <style>
        textarea:focus {
            outline: none;
            border: 2px solid #74b9ff; /* Azul cielo */
            box-shadow: 0 0 8px rgba(116, 185, 255, 0.8); /* Brillo azul */
        }
    </style>


@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            let aviso_privacidad = @json($aviso_privacidad);
            CKEDITOR.replace('aviso-privacidad', {
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
            CKEDITOR.instances['aviso-privacidad'].on('key', function() {
                let url = "{{ route('admin.visitantes.aviso-privacidad.store') }}";
                setTimeout(() => {
                    $.ajax({
                        type: "POST",
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            'aviso_privacidad': CKEDITOR.instances['aviso-privacidad']
                                .getData()
                        },
                        dataType: "JSON",
                        success: function(response) {
                            document.getElementById('ultima-modificacion').innerHTML =
                                `Ultima modificación realizada el <strong>${response.updated_at}</strong>`;
                        }
                    });
                }, 1000);
            });


        });
    </script>
@endsection
