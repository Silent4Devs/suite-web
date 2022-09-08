@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Aviso de Privacidad</h5>
    <div class="card">
        <div class="card-body">
            <span><i class="fas fa-info-circle"></i></span>
            <p style="display: inline-block" id="ultima-modificacion">
                Ultima modificación realizada el
                <strong>{{ \Carbon\Carbon::parse($quote->updated_at)->format('d-m-Y H:i:s') }}</strong>
            </p>
            <form action="{{ route('admin.visitantes.cita-textual.store') }}">
                <textarea name="cita-textual" id="cita-textual" cols="30" rows="10">
                    {!! $quote->quote !!}
                </textarea>

            </form>
            {{-- Regresar al menu --}}
            <a href="{{ route('admin.visitantes.menu') }}" class="mt-4 btn btn-success float-right">
                Regresar
            </a>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            let quote = @json($quote);
            CKEDITOR.replace('cita-textual', {
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
            CKEDITOR.instances['cita-textual'].on('key', function() {
                let url = "{{ route('admin.visitantes.cita-textual.store') }}";
                setTimeout(() => {
                    $.ajax({
                        type: "POST",
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            'quote': CKEDITOR.instances['cita-textual']
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
