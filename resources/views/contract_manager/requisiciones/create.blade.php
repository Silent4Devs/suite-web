@extends('layouts.admin')

@section('content')
@section('titulo', 'Crear Requisicion')

    <link rel="stylesheet" href="{{asset('css/requisiciones.css')}}">

    {{-- {{ Breadcrumbs::render('proveedores_create') }} --}}

    @livewire('requisiciones-create-component')

    {{--  @livewire('data-doc')  --}}

@endsection

@section('scripts')
    <script>
        Livewire.on('render_firma', (id_tab) => {
            var signaturePad = $('#firma_content').signature({
                syncField: '#firma',
                syncFormat: 'PNG',
                change: function(event, ui) {
                    if (signaturePad.signature().length > 0) {
                        // La firma está presente, lo que indica que se ha terminado de firmar
                        console.log("Firma completada");
                        // Ejecutar código adicional aquí
                        // ...
                        console.log('ferras');
                    } else {
                        // La firma está vacía, lo que indica que aún no se ha firmado
                        console.log("No se ha firmado");
                    }
                }
            });

            $('#clear').click(function(e) {
                e.preventDefault();
                signaturePad.signature('clear');
                $("#firma").val('');
            });
        });
    </script>
@endsection
