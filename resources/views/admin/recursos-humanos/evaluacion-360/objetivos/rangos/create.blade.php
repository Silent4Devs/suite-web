@extends('layouts.admin')

<head> <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
        integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

</head>

@section('content')
    <style>
        .instrucciones {
            background-color: rgb(52, 117, 178);
            color: white;
            border-radius: 8px !important;
            padding: 15px;
            margin-bottom: 20px;
        }

        .encabezado {
            background: #306BA9 0% 0% no-repeat padding-box;
            border-radius: 10px 10px 0px 0px;
            opacity: 1;
            color: white;
        }

        .card {
            margin-top: 0px !important;
            margin-bottom: 20px !important;
            border-radius: 14px;
            box-shadow: 0px 1px 4px #0000000F;
            opacity: 1;
        }

        .form-control {
            background: #F8FAFC 0% 0% no-repeat padding-box;
        }

        .color-picker {
            margin-top: 10px;
        }

        .titulo {
            font: #2567AE normal 600 18px/#2567AE Segoe UI;
            letter-spacing: var(--unnamed-character-spacing-0);
            text-align: left;
            font: normal normal 600 18px/24px Segoe UI;
            letter-spacing: 0px;
            color: #2567AE;
            opacity: 1;
        }
    </style>

    <h5 class="col-12 titulo">Análisis de Brechas - Template</h5>

    <div class="card card-body instrucciones">
        <div class="row no-gutters">
            <div class="col-md-auto"> <!-- Use col-md-auto to let Bootstrap determine the width based on content -->
                <img src="{{ asset('assets/Rectángulo 2344@2x.png') }}" style="width: 128px; height: 119px;">
            </div>
            <div class="col-md-10" style="margin-left: 10px;">
                <h3>Crea tu Catalogo Rangos</h3>
                <h4>Genera tus Parametros, valores y color con el que seran mostrados</h4>
                {{-- <p class="letra-subtitulo-template mb-2">Elaboraremos nuestro cuestionario que nos permitirá evaluar el cumplimiento de nuestra norma seleccionada.</p> --}}
            </div>
        </div>
    </div>

    {{-- Aqui se necesita el livewire --}}

    @livewire('rangos-objetivos')
@endsection

@section('scripts')
    <script>
        var sortable = new Sortable(document.getElementById('sortable-container'), {
            animation: 150, // Animation speed (in milliseconds)
            handle: '.drag-handle', // Selector for the drag handle
            // Additional options if needed
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
