@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/foda.css') }}">
@endsection
@section('content')
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
            <div class="card card-foda">
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
                <div class="card-body">
                    <h3>
                        {{ $foda->analisis }}
                    </h3>
                    <p>
                        <small>{{ $foda->id_elabora ? $foda->empleadoindiscriminado->name : 'No asignado' }}</small>
                    </p>
                    {{-- <span>
                        <small>{{ $foda->estatus ?? 'Pendiente' }}</small>
                    </span> --}}
                    {{-- Aqui ira un switch cuando se incluyan los estatus en los foda,
                        facilitara la busqueda con los filtros, ya que la forma de arriba
                        de reemplazar valor cuando no encuentra no esta funcionando --}}
                    {{-- <span class="status">Pendiente</span> --}}
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
