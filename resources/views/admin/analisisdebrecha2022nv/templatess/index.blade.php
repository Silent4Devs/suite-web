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
        }

        .encabezado {
            background-color: rgb(43, 102, 157);
            color: white;
            margin-top: -10px;
        }
    </style>

    <h5 class="col-12 titulo_general_funcion">Análisis de Brechas - Template</h5>

    <div class="card card-body instrucciones">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('assets/Rectángulo 2344@2x.png') }}"
                    style="margin: 9px 10px 10px 10px; width: 128px; height: 119px;">
            </div>
            <div class="col-md-10">
                <div class="pt-2">
                    <h5>Crea tu template</h5>
                    <p class="letra-subtitulo-template mb-2">Genera tus preguntas y personaliza tus campos según lo
                        requieras
                    </p>
                    <p class="letra-subtitulo-template mb-2">Elaboraremos nuestro cuestionario que nos permitirá evaluar el
                        cumplimiento de nuestra norma seleccionada.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Aqui se necesita el livewire --}}

    @livewire('secciones-template')
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
