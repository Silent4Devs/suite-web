@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/global/foda/foda.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    <script script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <style>
        .btn-options-foda-card {
            position: absolute;
            right: 0;
            top: 7px;
        }
    </style>
    <h5 class="col-12 titulo_general_funcion">Análisis FODA</h5>

    <div class="text-right">
        <a href="{{ route('admin.entendimiento-organizacions.create') }}" class="btn btn-info"
            style="background-color: #0489FE !important;">
            Crear análisis FODA
        </a>
    </div>
    <div class="card-filtros-fodas mt-3">
        <div class="row">
            <div class="col-md-4">
                <label for="">Buscar</label>
                <input id="input-search" type="text" class="form-control" onkeyup="buscadorGlobal()">
            </div>

            <div class="col-md-4">
                <label for="">Buscar por Fecha</label>
                <input id="input-search-fechas" type="date" class="form-control" onchange="buscadorGlobal()">
            </div>

            {{-- <div class="col-md-4">
                <label for="">Buscar por Estatus</label>
                <select id="input-search-estatus" class="form-control" onchange="buscadorGlobal()">
                    <option value="">Seleccionar</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="aprobado">Aprobado</option>
                    <option value="rechazado">Rechazado</option>
                </select>
            </div> --}}

        </div>
    </div>

    <div class="caja-cards mt-5">
        @foreach ($query as $foda)
            {{-- <a href="{{ asset('admin/entendimiento-organizacions') }}/{{ $foda->id }}"> --}}
            <div class="card card-foda" style="min-height: 260px !important;">
                <div class="card-header">
                    <strong> {{ Carbon\Carbon::parse($foda->fecha)->format('d/m/Y') }}</strong>
                    <div class="dropdown btn-options-foda-card">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            @can('analisis_foda_ver')
                                <a class="dropdown-item"
                                    href="{{ asset('admin/entendimiento-organizacions') }}/{{ $foda->id }}">
                                    <i class="fa-solid fa-eye"></i>&nbsp;Ver</a>
                            @endcan
                            @can('analisis_foda_editar')
                                <a class="dropdown-item"
                                    href="{{ asset('admin/entendimiento-organizacions-foda-edit') }}/{{ $foda->id }}">
                                    <i class="fa-solid fa-pencil"></i>&nbsp;Editar</a>
                            @endcan
                            @can('analisis_foda_eliminar')
                                <a class="dropdown-item delete-item" onclick="deleteItem({{ $foda->id }})">
                                    <i class="fa-solid fa-trash"></i>&nbsp;Eliminar</a>
                            @endcan
                            {{-- <a class="dropdown-item disabled" href=#>
                                        <i class="fa-solid fa-trash"></i>&nbsp;Eliminar (En uso)</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body" style="margin-top: 5px;">
                    <h3>
                        {{ $foda->analisis }}
                    </h3>
                    <p>
                        <small>{{ $foda->id_elabora ? $foda->empleadoindiscriminado->name : 'No asignado' }}</small>
                    </p>
                    @switch($foda->estatus)
                        @case('Pendiente')
                            <span class="badge"
                                style="color: #FF9900; background-color: 'rgba(255, 200, 0, 0.2)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                <small>{{ $foda->estatus ?? 'Pendiente' }}</small>
                            </span>
                        @break

                        @case('Aprobado')
                            <span class="badge"
                                style="color: #039C55; background-color: 'rgba(3, 156, 85, 0.1)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                <small>{{ $foda->estatus ?? 'Aprobado' }}</small>
                            </span>
                        @break

                        @case('Rechazado')
                            <span class="badge"
                                style="color: #FF0000; background-color: 'rgba(221, 4, 131, 0.1)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                <small>{{ $foda->estatus ?? 'Rechazado' }}</small>
                            </span>
                        @break

                        @case('Borrador')
                            <span class="badge"
                                style="color: #0080FF; background-color: 'rgba(0, 128, 255, 0.1)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                <small>{{ $foda->estatus ?? 'Borrador' }}</small>
                            </span>
                        @break

                        @default
                            <span class="badge"
                                style="color: #0080FF; background-color: 'rgba(0, 128, 255, 0.1)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                <small>{{ $foda->estatus ?? 'Borrador' }}</small>
                            </span>
                    @endswitch

                    @php
                        $part = $modulo->participantes->count();
                        $participantCount = $part;
                    @endphp

                    <div class="row">
                        @foreach ($modulo->participantes->take(3) as $index => $participante)
                            <div class="col-3">
                                <img src="{{ asset('storage/empleados/imagenes') }}/{{ $participante->empleado->avatar }}"
                                    class="img_empleado" title="{{ $participante->empleado->name }}">
                            </div>
                        @endforeach
                        @if ($participantCount > 3)
                            <div class="col-2">
                                <button type="button" class="btn btn-round ml-2 rounded-circle"
                                    style="width: 35px; height: 35px; background-color: #fff8dc; padding: 0; position: relative; right: 1rem; border: 1px solid black; border-radius: 50%;"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal{{ $modulo->id }}">
                                    <span
                                        style="display: inline-block; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">+{{ $modulo->participantes->count() - 3 }}</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal{{ $modulo->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"
                    style="margin:50px 0px 50px 1230px; position: relative; top: 3rem; right: 2rem;"><i
                        class="fa-solid fa-x fa-2xl" style="color: #ffffff;"></i>
                </button>
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Modal content structure -->
                        <div class="modal-body">
                            <h5>Lista de Aprobadores</h5>

                            <hr>
                            <br>

                            @php
                                $levels = []; // Initialize an empty array to store levels temporarily
                            @endphp

                            @foreach ($modulo->participantes as $participante)
                                @php
                                    $nivel = $participante->nivel;
                                    $levels[$nivel][] = $participante; // Group participantes by their nivel
                                @endphp
                            @endforeach

                            <div class="row">
                                <div class="col-5">
                                    <h6 style="color:#057BE2; position: relative; left: 15rem;"> Nivel
                                    </h6>
                                </div>
                                <div class="col-5">
                                    <h6 style="color:#057BE2; position: relative; left: 15rem;"> Aprobadores
                                    </h6>
                                </div>
                            </div>

                            <br>
                            <br>
                            @foreach ($levels as $nivel => $participantesByLevel)
                                @php
                                    // Sort participantes by numero_orden within each nivel
                                    usort($participantesByLevel, function ($a, $b) {
                                        return $a->numero_orden <=> $b->numero_orden;
                                    });

                                @endphp

                                @if ($nivel == 0)
                                    {{-- <div class="row mb-3" style="position: relative; left: 6rem;">
                                        <div class="col-6">
                                            <br>
                                            <h6>Super Aprobadores</h6>
                                        </div>
                                        <div class="col-6">
                                            <div class="row" style="position: relative; right: 11rem;">
                                                @foreach ($participantesByLevel as $participante)
                                                    <div class="col-2">
                                                        <img src="{{ asset('storage/empleados/imagenes') }}/{{ $participante->empleado->avatar }}"
                                                            class="img_empleado"
                                                            title="{{ $participante->empleado->name }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div> --}}
                                @else
                                    <div class="row mb-3" style="position: relative; left: 10rem;">
                                        <div class="col-6">
                                            <br>
                                            <h6> Nivel {{ $nivel }}</h6> &nbsp;&nbsp;&nbsp;
                                        </div>
                                        <div class="col-4">
                                            <div class="row" style="position: relative;">
                                                @foreach ($participantesByLevel as $participante)
                                                    <div class="col-4">
                                                        <img src="{{ asset('storage/empleados/imagenes') }}/{{ $participante->empleado->avatar }}"
                                                            class="img_empleado"
                                                            title="{{ $participante->empleado->name }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- </a> --}}
        @endforeach
    </div>

    @if ($listavacia == 'vacia')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    // title: 'No es posible acceder a esta vista.',
                    imageUrl: `{{ asset('img/errors/cara-roja-triste.svg') }}`, // Replace with the path to your image
                    imageWidth: 100, // Set the width of the image as needed
                    imageHeight: 100,
                    html: `<h4 style="color:red;">No se ha agregado ningún colaborador a la lista</h4>
                    <br><p>No se ha agregado un responsable al flujo de aprobación de esta vista.</p><br>
                    <p>Es necesario acercarse con el administrador para solicitar que se agregue  un responsable, de lo contrario no podra registrar información en este módulo.</p>`,
                    // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to another view after user clicks OK
                        window.location.href =
                            '{{ route('admin.iso27001.guia') }}';
                    }
                });
            });
        </script>
    @elseif ($listavacia == 'baja')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    // title: 'No es posible acceder a esta vista.',
                    imageUrl: `{{ asset('img/errors/cara-roja-triste.svg') }}`, // Replace with the path to your image
                    imageWidth: 100, // Set the width of the image as needed
                    imageHeight: 100,
                    html: `<h4 style="color:red;">Colaborador dado de baja</h4>
                    <br><p>El colaborador responsable de este formulario ta no se encuentra dado de alta en el sistema.</p><br>
                    <p>Es necesario acercarse con el administrador para solicitar que se agregue un nuevo responsable, de lo contrario no podra registrar información en este módulo.</p>`,
                    // icon: '{{ session('status') === 'success' ? 'success' : 'error' }}',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to another view after user clicks OK
                        window.location.href =
                            '{{ route('admin.iso27001.guia') }}';
                    }
                });
            });
        </script>
    @endif
@endsection
<script>
    function buscadorGlobal() {
        var inputText, inputDate, inputEstatus, section, div, strong, p, select, i;
        inputText = document.getElementById("input-search");
        inputDate = document.getElementById("input-search-fechas");
        // inputEstatus = document.getElementById("input-search-estatus");

        var filterText = inputText.value.toUpperCase();
        var filterDate = inputDate.value;
        // var filterEstatus = inputEstatus.value.toLowerCase(); // Lowercase for easier comparison

        section = document.getElementsByClassName("caja-cards")[0];
        div = section.getElementsByClassName("card-foda");

        for (i = 0; i < div.length; i++) {
            strong = div[i].getElementsByTagName("strong")[0];
            p = div[i].getElementsByTagName("p")[0]; // Get the first <p> element within each card
            // select = div[i].getElementsByClassName("status")[0]; // Get the status span within each card

            if (strong && p
                //  && select
            ) {
                var cardDateText = strong.innerHTML.trim(); // Date from the card
                var cardText = div[i].getElementsByTagName("h3")[0].innerText.toUpperCase(); // Text from the card
                var paragraphText = p.innerText.toUpperCase(); // Text from the <p> element
                // var estatusText = select.innerText.toLowerCase(); // Status text from the span

                // Format card date to match input date format (yyyy-mm-dd)
                var cardDateFormatted = formatDate(cardDateText);

                if (
                    (filterText === '' || cardText.includes(filterText) || paragraphText.includes(filterText)) &&
                    (filterDate === '' || filterDate === cardDateFormatted)
                    //  &&
                    // (filterEstatus === '' || estatusText === filterEstatus)
                ) {
                    div[i].style.display = "";
                } else {
                    div[i].style.display = "none";
                }
            }
        }
    }

    // Helper function to format date from dd/mm/yyyy to yyyy-mm-dd
    function formatDate(dateString) {
        var parts = dateString.split('/');
        if (parts.length === 3) {
            return parts[2] + '-' + parts[1].padStart(2, '0') + '-' + parts[0].padStart(2, '0');
        }
        return null; // Return null for invalid dates
    }

    // Funcion para borrar el Análisis FODA

    @can('analisis_foda_eliminar')
        function deleteItem(itemId) {
            let deleteUrl = "{{ route('admin.entendimiento-organizacions.destroy', 'id') }}";
            //sE RECIBE EL ID Y SE REEMPLAZA en la ruta
            deleteUrl = deleteUrl.replace('id', itemId);
            //Mensaje de confirmacion
            if (confirm('¿Seguro que deseas eliminar el Análisis FODA?')) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: 'POST',
                    url: deleteUrl,
                    data: {
                        ids: [itemId],
                        _method: 'DELETE'
                    },
                    success: function(data) {
                        console.log('Item deleted successfully');
                        //Se recarga la pagina
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting item:', error);
                    }
                });
            }
        }
    @endcan
</script>
