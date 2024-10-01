<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-4 mt-4">
                <div class="card card-body justify-content-center" style="min-height:100px;">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h4>Evaluaciones En Curso</h4>
                        </div>
                        <div class="col-2 d-flex align-items-center">
                            <h3 class="d-inline mr-2">{{ $contadores['activo'] }}
                            </h3>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4 mt-4">
                <div class="card card-body justify-content-center" style="min-height:100px;">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h4>Evaluaciones Pausadas</h4>
                        </div>
                        <div class="col-2 d-flex align-items-center">
                            <h4 class="d-inline mr-2">{{ $contadores['pausado'] }}
                            </h4>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4 mt-4">
                <div class="card card-body justify-content-center" style="min-height:100px;">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <h5>Evaluaciones Completadas</h5>
                        </div>
                        <div class="col-2 d-flex align-items-center">
                            <h3 class="d-inline mr-2">{{ $contadores['cerrado'] }}
                            </h3>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="card card-body">
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
            </div>
        </div>

        <div class="text-left mt-4">
            <a href="{{ route('admin.rh.evaluaciones-desempeno.create-evaluacion') }}" class="btn btn-outline-primary"
                style="background-color: #59BB87 !important; color:#fff !important;">
                Crear Evaluación
            </a>
        </div>

        <div class="caja-cards mt-5">
            @foreach ($evaluaciones as $evaluacion)
                <div class="card card-foda" style="min-height: 260px !important;">
                    <div class="card-header">
                        <strong> {{ Carbon\Carbon::parse($evaluacion->created_at)->format('d/m/Y') }}</strong>
                        <div class="dropdown btn-options-foda-card">
                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if ($evaluacion->estatus == 1 || $evaluacion->estatus == 3)
                                    <a class="dropdown-item"
                                        href="{{ route('admin.rh.evaluaciones-desempeno.dashboard-evaluacion', $evaluacion->id) }}">
                                        <i class="fa-solid fa-eye"></i>&nbsp;Dashboard</a>
                                @endif
                                @if ($evaluacion->estatus == 0)
                                    <a class="dropdown-item"
                                        href="{{ route('admin.rh.evaluaciones-desempeno.edit-borrador', $evaluacion->id) }}">
                                        <i class="fa-solid fa-pencil"></i>&nbsp;Editar</a>
                                @endif
                                <a class="dropdown-item delete-item" onclick="deleteItem({{ $evaluacion->id }})">
                                    <i class="fa-solid fa-trash"></i>&nbsp;Eliminar</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="margin-top: 5px;">
                        <h3>
                            {{ $evaluacion->nombre }}
                        </h3>
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
    </div>

    <div class="card card-body mt-3">
        <div class="row">
            <div class="col-6">
                <h5>Resultado Anual</h5>
            </div>
            <div class="col-2">
                <div class="anima-focus">
                    <select class="form-control" name="ano_anual" id="ano_anual" wire:model.live="ano_anual">
                        <option value="todos" selected>Todos</option>
                        @foreach ($anos_evaluaciones as $key => $ano)
                            <option value="{{ $ano }}">{{ $ano }}</option>
                        @endforeach
                    </select>
                    <label for="ano_anual">Año</label>
                </div>
            </div>
            <div class="col-2">
                <div class="dropdown">
                    <button class="btn btn-secondary btn-lg dropdown-toggle form-control" type="button"
                        id="dropdownMenuButtonEmpleados" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"
                        style="text-align: initial; background-color:#fff; color:#3086AF !important; border: 1px solid #ced4da !important">
                        Tipo
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonEmpleados"
                        style="max-height: 200px; overflow-y: auto;">
                        <div class="dropdown-item">
                            <div class="row mt-2 mb-2">
                                <div class="col-3">
                                    <input type="checkbox" id="general_anual" class="form-check-input"
                                        style="transform: scale(2);" wire:model.live="general_anual">
                                </div>
                                <div class="col-9">
                                    <div class="text-wrap">
                                        General
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <div class="row mt-2 mb-2">
                                <div class="col-3">
                                    <input type="checkbox" id="objetivos_anual" class="form-check-input"
                                        style="transform: scale(2);" wire:model.live="objetivos_anual">
                                </div>
                                <div class="col-9">
                                    <div class="text-wrap">
                                        Objetivos
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <div class="row mt-2 mb-2">
                                <div class="col-3">
                                    <input type="checkbox" id="competencias_anual" class="form-check-input"
                                        style="transform: scale(2);" wire:model.live="competencias_anual">
                                </div>
                                <div class="col-9">
                                    <div class="text-wrap">
                                        Competencias
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="anima-focus">
                    <select class="form-control" name="area_anual" id="area_anual" wire:model.live="area_anual">
                        <option value="todas">Todas</option>
                        @foreach ($areas as $key => $area)
                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                        @endforeach
                    </select>
                    <label for="area_anual">Área</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="contenedor-principal" style="height:600px;">
                    <canvas id="resultadosanuales"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-body mt-3">
        <div class="row">
            <div class="col-6">
                <h5>Resultado Mensual</h5>
            </div>
            <div class="col-2">
                <div class="anima-focus">
                    <select class="form-control" name="mes_mensual" id="mes_mensual" wire:model.live="mes_mensual">
                        <option value="ninguno" selected>Seleccione un Mes del Año elegido</option>
                        @foreach ($meses_evaluaciones as $key => $mes)
                            <option value="{{ $key }}">{{ $mes }}</option>
                        @endforeach
                    </select>
                    <label for="ano_mensual">Mes</label>
                </div>
            </div>
            <div class="col-2">
                <div class="dropdown">
                    <button class="btn btn-secondary btn-lg dropdown-toggle form-control" type="button"
                        id="dropdownMenuButtonEmpleados" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"
                        style="text-align: initial; background-color:#fff; color:#3086AF !important; border: 1px solid #ced4da !important">
                        Tipo
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonEmpleados"
                        style="max-height: 200px; overflow-y: auto;">
                        <div class="dropdown-item">
                            <div class="row mt-2 mb-2">
                                <div class="col-3">
                                    <input type="checkbox" id="general_mensual" class="form-check-input"
                                        style="transform: scale(2);" wire:model.live="general_mensual">
                                </div>
                                <div class="col-9">
                                    <div class="text-wrap">
                                        General
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <div class="row mt-2 mb-2">
                                <div class="col-3">
                                    <input type="checkbox" id="objetivos_mensual" class="form-check-input"
                                        style="transform: scale(2);" wire:model.live="objetivos_mensual">
                                </div>
                                <div class="col-9">
                                    <div class="text-wrap">
                                        Objetivos
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <div class="row mt-2 mb-2">
                                <div class="col-3">
                                    <input type="checkbox" id="competencias_mensual" class="form-check-input"
                                        style="transform: scale(2);" wire:model.live="competencias_mensual">
                                </div>
                                <div class="col-9">
                                    <div class="text-wrap">
                                        Competencias
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="anima-focus">
                    <select class="form-control" name="area_mensual" id="area_mensual"
                        wire:model.live="area_mensual">
                        <option value="todas">Todas</option>
                        @foreach ($areas as $key => $area)
                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                        @endforeach
                    </select>
                    <label for="area_mensual">Area</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="contenedor-mensual" style="height:600px;">
                    <canvas id="resultadosmensuales"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- // const areas = @json($resArea['nombres'][$periodo_seleccionado]);
// const data = @json($resArea['resultados'][$periodo_seleccionado]); --}}
@section('scripts')
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

        function deleteItem(itemId) {
            let deleteUrl = "{{ route('admin.rh.evaluaciones-desempeno.borrar', 'id') }}";
            //sE RECIBE EL ID Y SE REEMPLAZA en la ruta
            deleteUrl = deleteUrl.replace('id', itemId);

            // Using SweetAlert for confirmation
            Swal.fire({
                title: '¿Seguro que deseas eliminar la Evaluación?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
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
                            Swal.fire({
                                title: 'Evaluación Eliminada',
                                icon: 'success',
                                button: "Entendido",
                            });
                            //Se recarga la pagina
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error deleting item:', error);
                        }
                    });
                }
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('livewire:initialized', function() {
            const data = @json($datos_evaluaciones_anuales);
            const general_anual = @json($general_anual);
            const objetivos_anual = @json($objetivos_anual);
            const competencias_anual = @json($competencias_anual);

            // Extract keys (years) and values (data points)
            const anos = Object.keys(data);
            const objetivos = anos.map(year => data[year]['objetivos']);
            const colorObjetivos = anos.map(year => data[year]['colorObjetivos']);
            const competencias = anos.map(year => data[year]['competencias']);
            const colorCompetencias = anos.map(year => data[year]['colorCompetencias']);
            const general = anos.map(year => data[year]['general']);
            const colorGeneral = anos.map(year => data[year]['colorGeneral']);

            // Construct datasets based on boolean values
            const datasets = [];

            if (objetivos_anual) {
                datasets.push({
                    label: 'Objetivos',
                    data: objetivos,
                    backgroundColor: colorObjetivos,
                    borderWidth: 1
                });
            }

            if (competencias_anual) {
                datasets.push({
                    label: 'Competencias',
                    data: competencias,
                    backgroundColor: colorCompetencias,
                    borderWidth: 1
                });
            }

            if (general_anual) {
                datasets.push({
                    label: 'General',
                    data: general,
                    backgroundColor: colorGeneral,
                    borderWidth: 1
                });
            }

            var ctx = document.getElementById('resultadosanuales').getContext('2d');
            chartRA = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: anos,
                    datasets: datasets
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    {{-- Codigo cambio de filtros --}}
    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('dataAnual', (datosAnualesWrapper) => {
                const datosAnuales = datosAnualesWrapper.datosAnuales;

                const anosAnual = datosAnuales.labels;

                const datasets = [];
                if (datosAnuales.filtro_objetivos_anual) {
                    const objetivosAnual = anosAnual.map(ano => datosAnuales.data[ano].objetivos);
                    const colorObjetivosAnual = anosAnual.map(ano => datosAnuales.data[ano].colorObjetivos);
                    datasets.push({
                        label: 'Objetivos',
                        data: objetivosAnual,
                        backgroundColor: colorObjetivosAnual,
                        borderWidth: 1
                    });
                }

                if (datosAnuales.filtro_competencias_anual) {
                    const competenciasAnual = anosAnual.map(ano => datosAnuales.data[ano].competencias);
                    const colorCompetenciasAnual = anosAnual.map(ano => datosAnuales.data[ano]
                        .colorCompetencias);
                    datasets.push({
                        label: 'Competencias',
                        data: competenciasAnual,
                        backgroundColor: colorCompetenciasAnual,
                        borderWidth: 1
                    });
                }

                if (datosAnuales.filtro_general_anual) {
                    const generalAnual = anosAnual.map(ano => datosAnuales.data[ano].general);
                    const colorGeneralAnual = anosAnual.map(ano => datosAnuales.data[ano].colorGeneral);
                    datasets.push({
                        label: 'General',
                        data: generalAnual,
                        backgroundColor: colorGeneralAnual,
                        borderWidth: 1
                    });
                }

                document.getElementById('resultadosanuales').remove();
                let canvas = document.createElement("canvas");
                canvas.id = "resultadosanuales";
                canvas.style.width = '100%';
                canvas.style.height = '100%';
                document.getElementById("contenedor-principal").appendChild(canvas);

                new Chart(document.getElementById('resultadosanuales'), {
                    type: 'bar',
                    data: {
                        labels: anosAnual,
                        datasets: datasets
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {

            const anos = @json($anos_evaluaciones);
            const data = @json($datos_evaluaciones_anuales);

            var ctx = document.getElementById('resultadosmensuales').getContext('2d');
            chartRA = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: anos,
                    datasets: [{
                        label: 'Objetivos',
                        data: data[0],
                        borderWidth: 1
                    }, {
                        label: 'Competencias',
                        data: data[1],
                        borderWidth: 1
                    }, {
                        label: 'General',
                        data: data[2],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('dataMensual', (datosMensualesWrapper) => {
                const datosMensuales = datosMensualesWrapper.datosMensuales;

                const mesSeleccionado = datosMensuales.labels[0]; // Solo un mes
                const datosMes = datosMensuales.data[mesSeleccionado];

                const datasets = [];
                if (datosMensuales.filtro_objetivos_mensual) {
                    const objetivosMensual = datosMes?.objetivos || 0;
                    const colorObjetivosMensual = datosMes?.colorObjetivos || 0;
                    datasets.push({
                        label: 'Objetivos',
                        data: [objetivosMensual],
                        backgroundColor: colorObjetivosMensual,
                        borderWidth: 1
                    });
                }

                if (datosMensuales.filtro_competencias_mensual) {
                    const competenciasMensual = datosMes?.competencias || 0;
                    const colorCompetenciasMensual = datosMes?.colorCompetencias || 0;
                    datasets.push({
                        label: 'Competencias',
                        data: [competenciasMensual],
                        backgroundColor: colorCompetenciasMensual,
                        borderWidth: 1
                    });
                }

                if (datosMensuales.filtro_general_mensual) {
                    const generalMensual = datosMes?.general || 0;
                    const colorGeneralMensual = datosMes?.colorGeneral || 0;
                    datasets.push({
                        label: 'General',
                        data: [generalMensual],
                        backgroundColor: colorGeneralMensual,
                        borderWidth: 1
                    });
                }

                // Eliminar el canvas existente y crear uno nuevo
                document.getElementById('resultadosmensuales').remove();
                let canvas = document.createElement("canvas");
                canvas.id = "resultadosmensuales";
                canvas.style.width = '100%';
                canvas.style.height = '100%';
                document.getElementById("contenedor-mensual").appendChild(canvas);

                // Crear el gráfico
                new Chart(document.getElementById('resultadosmensuales'), {
                    type: 'bar',
                    data: {
                        labels: [mesSeleccionado], // Solo un mes
                        datasets: datasets,
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection
