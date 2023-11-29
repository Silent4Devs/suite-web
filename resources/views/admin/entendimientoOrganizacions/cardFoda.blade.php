@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/foda.css') }}">
@endsection
@section('content')
    <h5 class="col-12 titulo_general_funcion">Análisis FODA</h5>

    <div class="card-filtros-fodas">
        <div class="row">
            <div class="col-md-6">
                <label for="">Buscar</label>
                <input id="input-search" type="text" class="form-control" onkeyup="buscadorGlobal()">
            </div>

            <div class="col-md-6">
                <label for="">Buscar por Fecha</label>
                <input id="input-search-fechas" type="date" class="form-control" onchange="buscadorGlobal()">
            </div>

        </div>
    </div>

    <div class="caja-cards mt-5">
        @foreach ($query as $foda)
            <a href="{{ asset('admin/entendimiento-organizacions') }}/{{ $foda->id }}">
                <div class="card card-foda">
                    <div class="card-header">
                        <strong> {{ Carbon\Carbon::parse($foda->fecha)->format('d/m/Y') }}</strong>
                    </div>
                    <div class="card-body">
                        <h3>
                            {{ $foda->analisis }}
                        </h3>
                        <p>
                            <small>{{ $foda->elaboro_id ? $foda->empleado->name : 'No asignado' }}</small>
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
<script>
    function buscadorGlobal() {
        var inputText, inputDate, section, div, strong, i;
        inputText = document.getElementById("input-search");
        inputDate = document.getElementById("input-search-fechas");
        var filterText = inputText.value.toUpperCase();
        var filterDate = inputDate.value;

        section = document.getElementsByClassName("caja-cards")[0];
        div = section.getElementsByClassName("card-foda");

        for (i = 0; i < div.length; i++) {
            strong = div[i].getElementsByTagName("strong")[0];
            if (strong) {
                var cardDateText = strong.innerHTML.trim(); // Date from the card
                var cardText = div[i].getElementsByTagName("h3")[0].innerText.toUpperCase(); // Text from the card

                // Format card date to match input date format (yyyy-mm-dd)
                var cardDateFormatted = formatDate(cardDateText);

                if (
                    (filterText === '' || cardText.includes(filterText)) &&
                    (filterDate === '' || filterDate === cardDateFormatted)
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
</script>
