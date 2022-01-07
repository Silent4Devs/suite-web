@extends('layouts.admin')
@section('content')



{{ Breadcrumbs::render('admin.entendimiento-organizacions.create') }}
<h5 class="col-12 titulo_general_funcion">Registrar: FODA </h5>
<div class="mt-4 card">
 
    <div class="card-body">
        <form method="POST" action="{{ route('admin.entendimiento-organizacions.store') }}" class="row">
            @csrf
            @include('admin.entendimientoOrganizacions._form', [
            'btnText' => 'Guardar',
            ])

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
