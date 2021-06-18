@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.entendimiento-organizacions.create') }}

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body bg-primary align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"> <strong>Registrar:</strong> FODA </h3>
        </div>

        <div class="card-body">
            <form method="POST"
                action="{{ route('admin.entendimiento-organizacions.update', $entendimientoOrganizacion) }}" class="row">
                @csrf
                @method('PATCH')
                @include('admin.entendimientoOrganizacions._form', [
                'btnText' => 'Actualizar',
                ])
            </form>
        </div>
    </div>

    <script src="{{ asset('js/dark_mode.js') }}"></script>


@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('fortalezas', {
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
            CKEDITOR.replace('debilidades', {
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
            CKEDITOR.replace('oportunidades', {
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
            CKEDITOR.replace('amenazas', {
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
        });

    </script>
@endsection
