@extends('layouts.admin')
@section('content')
    <style type="text/css">
        table {
            table-layout: fixed;
            width: 500px;
        }

        th,
        td {
            border: 1px solid blue;
            width: 130px;
            word-wrap: break-word
        }

        .btn-success-custom {
            background-color: #28a745;
            color: #fff;
        }

        .tb-btn-primary-custom {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    <h5 class="col-12 titulo_general_funcion">Requisiciones</h5>

    <div class="row">
        <div class="col-md-6">
            <!-- Botón 1 -->
            <button type="button"
                class="btn @if ($buttonSolicitante) btn-success-custom @else tb-btn-primary-custom @endif"
                id="filtrarBtn2" style="width: 100%;">Filtrar Requisiciones pendientes
                solicitantes</button>
        </div>

        <div class="col-md-6">
            <!-- Botón 2 -->
            <button type="button"
                class="btn @if ($buttonJefe) btn-success-custom @else tb-btn-primary-custom @endif"
                id="filtrarBtn1" style="width: 100%;">Filtrar requisiciones pendientes jefes</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- Botón 3 -->
            <button type="button"
                class="btn @if ($buttonFinanzas) btn-success-custom @else tb-btn-primary-custom @endif"
                id="filtrarBtn" style="width: 100%;">Filtrar requisiciones pendientes finanzas</button>
        </div>
        <div class="col-md-6">
            <!-- Botón 4 -->
            <button type="button"
                class="btn @if ($buttonCompras) btn-success-custom @else tb-btn-primary-custom @endif"
                id="filtrarBtn3" style="width: 100%;">Filtrar requisiciones pendientes
                compradores</button>
        </div>
    </div>


    <div class="mt-5 card">
        <div class="card-body datatable-fix">
            <table id="dom" class="table table-bordered w-100 datatable-perspectiva" style="width: 100%">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">Folio</th>
                        <th style="vertical-align: top">Fecha De Solicitud</th>
                        <th style="vertical-align: top">Referencia</th>
                        <th style="vertical-align: top">Proveedor</th>
                        <th style="vertical-align: top">Estatus</th>
                        <th style="vertical-align: top">Turno en firmar</th>
                        <th style="vertical-align: top">Proyecto</th>
                        <th style="vertical-align: top">Área que Solicita</th>
                        <th style="vertical-align: top">Solicitante</th>
                        <th style="vertical-align: top">Opciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($requisiciones as $requisicion)
                        <tr>
                            <td>RQ-00-00-{{ $requisicion->id }}</td>
                            <td>{{ $requisicion->fecha }}</td>
                            <td>{{ $requisicion->referencia }}</td>
                            <td>{{ $requisicion->proveedor_catalogo ?? ($requisicion->provedores_requisiciones->first()->contacto ?? 'Indistinto') }}
                            </td>
                            <td>
                                @switch($requisicion->estado)
                                    @case('curso')
                                        <h5><span class="badge badge-pill badge-primary">En curso</span></h5>
                                    @break

                                    @case('aprobado')
                                        <h5><span class="badge badge-pill badge-success">Aprobado</span></h5>
                                    @break

                                    @case('rechazado')
                                        <h5><span class="badge badge-pill badge-danger">Rechazado</span></h5>
                                    @break

                                    @case('firmada')
                                    @case('firmada_final')
                                        <h5><span class="badge badge-pill badge-success">Firmada</span></h5>
                                    @break

                                    @default
                                        <h5><span class="badge badge-pill badge-info">Por iniciar</span></h5>
                                @endswitch
                            </td>
                            @php
                                $user = Illuminate\Support\Facades\DB::table('users')
                                    ->select('id', 'name')
                                    ->where('id', $requisicion->id_user)
                                    ->first();
                            @endphp
                            <td>
                                @switch(true)
                                    @case(is_null($requisicion->firma_solicitante))
                                        <p>Solicitante: {{ $user->name ?? '' }}</p>
                                    @break

                                    @case(is_null($requisicion->firma_jefe))
                                        @php
                                            $employee = App\Models\User::find($requisicion->id_user);
                                            if ($requisicion->registroFirmas) {
                                                $supervisorName = $requisicion->registroFirmas->jefe->name;
                                            } elseif ($employee !== null) {
                                                if (
                                                    $employee->empleado !== null &&
                                                    $employee->empleado->supervisor !== null
                                                ) {
                                                    $supervisorName = $employee->empleado->supervisor->name;
                                                } else {
                                                    $supervisorName = 'N/A';
                                                }
                                            } else {
                                                $supervisorName = 'N/A';
                                            }
                                        @endphp
                                        <p>Jefe: {{ $supervisorName ?? '' }} </p>
                                    @break

                                    @case(is_null($requisicion->firma_finanzas))
                                        <p>Finanzas</p>
                                    @break

                                    @case(is_null($requisicion->firma_compras))
                                        @php
                                            $comprador = App\Models\ContractManager\Comprador::with('user')
                                                ->where('id', $requisicion->comprador_id)
                                                ->first();
                                        @endphp
                                        <p>Comprador: {{ $comprador->user->name }}</p>
                                    @break

                                    @default
                                        <h5><span class="badge badge-pill badge-success">Completado</span></h5>
                                @endswitch
                            </td>
                            <td>{{ $requisicion->contrato->nombre_servicio ?? 'Sin servicio disponible' }}</td>
                            <td>{{ $requisicion->area }}</td>
                            <td>{{ $requisicion->user }}</td>
                            <td>
                                <form
                                    action="{{ route('contract_manager.requisiciones.firmarAprobadores', $requisicion->id) }}"
                                    method="GET">
                                    @method('GET')
                                    <a
                                        href="{{ route('contract_manager.requisiciones.firmarAprobadores', $requisicion->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                </form>
                                @if (isset($requisicion->registroFirmas))
                                    @if ($requisicion->registroFirmas->duplicados($empleadoActual->id))
                                        <!-- Button trigger modal -->
                                        <a data-toggle="modal" data-target="#modal-{{ $requisicion->id }}">
                                            <i class="fa-solid fa-file-signature"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-{{ $requisicion->id }}" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1"
                                            aria-labelledby="modalLabel-{{ $requisicion->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel-{{ $requisicion->id }}">
                                                            Delegar Firma</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Seleccione al responsable al que delegará su firma</p>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="anima-focus">
                                                                    <select class="form-control" name="nuevo_responsable"
                                                                        id="nuevo_responsable-{{ $requisicion->id }}">
                                                                        @foreach ($sustitutosLD as $key => $sustituto)
                                                                            <option value="{{ $sustituto->id }}">
                                                                                {{ $sustituto->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <label
                                                                        for="nuevo_responsable-{{ $requisicion->id }}">Responsable</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                        <button type="button"
                                                            class="btn btn-primary cambiarResponsableButton"
                                                            data-requisicion-id="{{ $requisicion->id }}">Cambiar
                                                            Responsable</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    @if (session('mensaje'))
        <script>
            alert("{{ session('mensaje') }}");
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.cambiarResponsableButton').click(function() {
                let button = $(this);
                let requisicionId = button.data('requisicion-id');
                let nuevoResponsableId = $('#nuevo_responsable-' + requisicionId).val();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, cambiar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('contract_manager.requisiciones.cambiarResponsable') }}', // Replace with your route
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                requisicion_id: requisicionId,
                                nuevo_responsable: nuevoResponsableId
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Cambiado!',
                                    'El responsable ha sido cambiado.',
                                    'success'
                                ).then(() => {
                                    location
                                        .reload(); // Reload the page or do whatever you want after success
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'Hubo un problema al cambiar el responsable.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        (function() {

            // Search function
            $.fn.dataTable.Api.register('alphabetSearch()', function(searchTerm) {
                this.iterator('table', function(context) {
                    context.alphabetSearch = searchTerm;
                });

                return this;
            });

            // Recalculate the alphabet display for updated data
            $.fn.dataTable.Api.register('alphabetSearch.recalc()', function(searchTerm) {
                this.iterator('table', function(context) {
                    draw(
                        new $.fn.dataTable.Api(context),
                        $('div.alphabet', this.table().container())
                    );
                });

                return this;
            });


            // Search plug-in
            $.fn.dataTable.ext.search.push(function(context, searchData) {
                // Ensure that there is a search applied to this table before running it
                if (!context.alphabetSearch) {
                    return true;
                }

                if (searchData[1].charAt(0) === context.alphabetSearch) {
                    return true;
                }


                return false;
            });


            // Private support methods
            function bin(data) {
                var letter, bins = {};

                for (var i = 0, ien = data.length; i < ien; i++) {
                    letter = data[i].charAt(0).toUpperCase();

                    if (bins[letter]) {
                        bins[letter]++;
                    } else {
                        bins[letter] = 1;
                    }
                }

                return bins;
            }

            function draw(table, alphabet) {
                alphabet.empty();

                var columnData = table.column(1).data();
                var bins = bin(columnData);

                $('<span class="clear active"/>')
                    .data('letter', '')
                    .data('match-count', columnData.length)
                    .html('Todos')
                    .appendTo(alphabet);

                for (var i = 0; i < 26; i++) {
                    var letter = String.fromCharCode(65 + i);

                    $('<span/>')
                        .data('letter', letter)
                        .data('match-count', bins[letter] || 0)
                        .addClass(!bins[letter] ? 'empty' : '')
                        .html(letter)
                        .appendTo(alphabet);
                }

                $('<div class="alphabetInfo"></div>')
                    .appendTo(alphabet);
            }


            $.fn.dataTable.AlphabetSearch = function(context) {
                var table = new $.fn.dataTable.Api(context);
                var alphabet = $('<div class="alphabet"/>');

                draw(table, alphabet);

                // Trigger a search
                alphabet.on('click', 'span', function() {
                    alphabet.find('.active').removeClass('active');
                    $(this).addClass('active');

                    table
                        .alphabetSearch($(this).data('letter'))
                        .draw();
                });

                // Mouse events to show helper information
                alphabet
                    .on('mouseenter', 'span', function() {
                        alphabet
                            .find('div.alphabetInfo')
                            .css({
                                opacity: 1,
                                left: $(this).position().left,
                                width: $(this).width()
                            })
                            .html($(this).data('match-count'))
                    })
                    .on('mouseleave', 'span', function() {
                        alphabet
                            .find('div.alphabetInfo')
                            .css('opacity', 0);
                    });

                // API method to get the alphabet container node
                this.node = function() {
                    return alphabet;
                };
            };

            $.fn.DataTable.AlphabetSearch = $.fn.dataTable.AlphabetSearch;


            // Register a search plug-in
            $.fn.dataTable.ext.feature.push({
                fnInit: function(settings) {
                    var search = new $.fn.dataTable.AlphabetSearch(settings);
                    return search.node();
                },
                cFeature: 'A'
            });

        }());


        $(document).ready(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        // doc.styles.tableHeader.fontSize = 6.5;
                        // doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Usuarios ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend: 'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Restaurar a estado anterior',
                }

            ];
            var table = $('#dom').DataTable({
                buttons: dtButtons,

                // dom: 'AlBfrtip',
                dom: "<'row align-items-center justify-content-center col-12'<'text-center col-12 col-sm-12 col-md-12 col-lg-12'A><'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-5 col-lg-5'B><'col-md-4 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>"
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#filtrarBtn').click(function() {
                window.location.href = "{{ route('contract_manager.requisiciones.filtrarPorEstado') }}";
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#filtrarBtn1').click(function() {
                window.location.href = "{{ route('contract_manager.requisiciones.filtrarPorEstado1') }}";
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#filtrarBtn2').click(function() {
                window.location.href = "{{ route('contract_manager.requisiciones.filtrarPorEstado2') }}";
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#filtrarBtn3').click(function() {
                window.location.href = "{{ route('contract_manager.requisiciones.filtrarPorEstado3') }}";
            });
        });
    </script>
@endsection
