@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/foda.css') }}{{ config('app.cssVersion') }}">
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
    <h5 class="col-12 titulo_general_funcion">Evaluaciones</h5>

    <div class="card-filtros-fodas mt-3">
        <div class="row">
            <div class="col-md-2">
                <label for="">Fecha</label>
                <input id="input-search-fechas" type="date" class="form-control" onchange="buscadorGlobal()">
            </div>

            <div class="col-md-8">
                <label for="">Buscar</label>
                <input id="input-search" type="text" class="form-control" onkeyup="buscadorGlobal()">
            </div>

            <div class="col-md-2">
                <a class="btn btn-primary" href="">Dashboard</a>
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

    <div class="text-left mt-4">
        <a href="{{ route('admin.rh.evaluaciones-desempeño.create-evaluacion') }}" class="btn btn-info"
            style="background-color: #59BB87 !important;">
            Crear Evaluación
        </a>
    </div>

    <div class="caja-cards mt-5">
        @foreach ($evaluaciones as $evaluacion)
            {{-- <a href="{{ asset('admin/entendimiento-organizacions') }}/{{ $evaluacion->id }}"> --}}
            <div class="card card-foda" style="min-height: 260px !important;">
                <div class="card-header">
                    <strong> {{ Carbon\Carbon::parse($evaluacion->created_at)->format('d/m/Y') }}</strong>
                    <div class="dropdown btn-options-foda-card">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            @can('analisis_foda_ver')
                                <a class="dropdown-item"
                                    href="{{ asset('admin/entendimiento-organizacions') }}/{{ $evaluacion->id }}">
                                    <i class="fa-solid fa-eye"></i>&nbsp;Ver</a>
                            @endcan
                            @can('analisis_foda_editar')
                                <a class="dropdown-item"
                                    href="{{ asset('admin/entendimiento-organizacions-foda-edit') }}/{{ $evaluacion->id }}">
                                    <i class="fa-solid fa-pencil"></i>&nbsp;Editar</a>
                            @endcan
                            @can('analisis_foda_eliminar')
                                <a class="dropdown-item delete-item" onclick="deleteItem({{ $evaluacion->id }})">
                                    <i class="fa-solid fa-trash"></i>&nbsp;Eliminar</a>
                            @endcan
                            {{-- <a class="dropdown-item disabled" href=#>
                                        <i class="fa-solid fa-trash"></i>&nbsp;Eliminar (En uso)</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body" style="margin-top: 5px;">
                    <h3>
                        {{ $evaluacion->nombre }}
                    </h3>
                    {{-- <p>
                        <small>{{ $evaluacion->id_elabora ? $evaluacion->empleadoindiscriminado->name : 'No asignado' }}</small>
                    </p> --}}
                    @switch($evaluacion->estatus)
                        @case(0)
                            <span class="badge"
                                style="color: #FF9900; background-color: 'rgba(255, 200, 0, 0.2)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                <small>Borrador</small>
                            </span>
                        @break

                        @case(1)
                            <span class="badge"
                                style="color: #039C55; background-color: 'rgba(3, 156, 85, 0.1)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                <small>Activa</small>
                            </span>
                        @break

                        @case(2)
                            <span class="badge"
                                style="color: #FF0000; background-color: 'rgba(221, 4, 131, 0.1)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                <small>Cancelada</small>
                            </span>
                        @break

                        @case(3)
                            <span class="badge"
                                style="color: #0080FF; background-color: 'rgba(0, 128, 255, 0.1)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                <small>Finalizada</small>
                            </span>
                        @break

                        @default
                            <span class="badge"
                                style="color: #0080FF; background-color: 'rgba(0, 128, 255, 0.1)'; border-radius: 7px; padding: 5px; font-weight: 300; font-size:16px;">
                                <small>Borrador</small>
                            </span>
                    @endswitch
                </div>
            </div>
        @endforeach
    </div>
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
