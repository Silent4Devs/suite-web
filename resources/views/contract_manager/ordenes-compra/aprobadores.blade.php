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
    <h5 class="col-12 titulo_general_funcion">Ordenes de Compra</h5>

    <center>

        <!-- Botón 4 -->
        <button type="button"
            class="btn @if ($buttonCompras) btn-success-custom @else tb-btn-primary-custom @endif"
            id="filtrarBtn3" style="position: relative; left: -2rem;">Filtrar OC pendientes compradores</button>


        <!-- Botón 1 -->
        <button type="button"
            class="btn @if ($buttonSolicitante) btn-success-custom @else tb-btn-primary-custom @endif"
            id="filtrarBtn2" style="position: relative; left: 1rem;">Filtrar OC pendientes solicitantes</button>


        <!-- Botón 3 -->
        <button type="button"
            class="btn @if ($buttonFinanzas) btn-success-custom @else tb-btn-primary-custom @endif"
            id="filtrarBtn" style="position: relative; left: 4rem;">Filtrar OC pendientes finanzas</button>

    </center>


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
                            <td>OC-00-00-{{ $requisicion->id }}</td>
                            <td>{{ $requisicion->fecha }}</td>
                            <td>{{ $requisicion->referencia }}</td>
                            <td>{{ $requisicion->proveedor_catalogo ?? ($requisicion->provedores_requisiciones->first()->contacto ?? 'Indistinto') }}
                            </td>
                            <td>
                                @if (
                                    !$requisicion->firma_solicitante_orden &&
                                        !$requisicion->firma_comprador_orden &&
                                        !$requisicion->firma_finanzas_orden)
                                    <h5><span class="badge badge-pill badge-primary">Por iniciar</span></h5>
                                @elseif ($requisicion->firma_solicitante_orden && $requisicion->firma_comprador_orden && $requisicion->firma_finanzas_orden)
                                    <h5><span class="badge badge-pill badge-success">Firmada</span></h5>
                                @else
                                    <h5><span class="badge badge-pill badge-info">En curso</span></h5>
                                @endif

                            </td>
                            <td>
                                @switch(true)
                                    @case(is_null($requisicion->firma_comprador_orden))
                                        @php
                                            if ($requisicion->registroFirmas) {
                                                $compradorName =
                                                    $requisicion->obtener_responsable_comprador->name ?? false;
                                            } else {
                                                $compradorName = $requisicion->comprador->user->name;
                                            }
                                        @endphp

                                        @if ($compradorName === false)
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    Swal.fire({
                                                        title: 'Advertencia',
                                                        text: 'El comprador no ha sido identificado y sus suplentes no están disponibles. Por favor, contacte a un administrador.',
                                                        icon: 'warning',
                                                        confirmButtonText: 'Aceptar',
                                                        allowOutsideClick: false,
                                                    }).then(() => {
                                                        window.location.href = "{{ route('admin.inicio-Usuario.index') }}";
                                                    });
                                                });
                                            </script>
                                        @endif
                                        <p>Comprador: {{ $compradorName }}</p>
                                    @break

                                    @case(is_null($requisicion->firma_solicitante_orden))
                                        <p>Solicitante: {{ $requisicion->userSolicitante->name ?? '' }}</p>
                                    @break

                                    @case(is_null($requisicion->firma_finanzas_orden))
                                        @php
                                            if ($requisicion->registroFirmas) {
                                                $finanzasName =
                                                    $requisicion->obtener_responsable_finanzas_orden_compra->name ??
                                                    false;
                                            } else {
                                                $finanzasName = 'Sin identificar';
                                            }
                                        @endphp

                                        @if ($finanzasName === false)
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    Swal.fire({
                                                        title: 'Advertencia',
                                                        text: 'El responsable de finanzas no ha sido identificado y sus suplentes no están disponibles. Por favor, contacte a un administrador.',
                                                        icon: 'warning',
                                                        confirmButtonText: 'Aceptar',
                                                        allowOutsideClick: false,
                                                    }).then(() => {
                                                        window.location.href = "{{ route('admin.inicio-Usuario.index') }}";
                                                    });
                                                });
                                            </script>
                                        @endif
                                        <p>Finanzas: {{ $finanzasName }}</p>
                                    @break

                                    @default
                                        <h5><span class="badge badge-pill badge-success">Completado</span></h5>
                                @endswitch
                            </td>
                            <td>{{ $requisicion->contrato->nombre_servicio ?? 'Sin servicio disponible' }}</td>
                            <td>{{ $requisicion->area }}</td>
                            <td>{{ $requisicion->user }}</td>
                            <td>
                                @if ($requisicion->estado_orden != 'rechazado_oc' && $requisicion->estado_orden != 'cancelada')
                                    <form
                                        action="{{ route('contract_manager.orden-compra.firmarAprobadores', $requisicion->id) }}"
                                        method="GET">
                                        @method('GET')
                                        <a
                                            href="{{ route('contract_manager.orden-compra.firmarAprobadores', $requisicion->id) }}"><i
                                                class="fas fa-edit"></i></a>
                                    </form>
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
                window.location.href = "{{ route('contract_manager.orden-compra.filtrarPorEstado') }}";
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#filtrarBtn2').click(function() {
                window.location.href = "{{ route('contract_manager.orden-compra.filtrarPorEstado2') }}";
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#filtrarBtn3').click(function() {
                window.location.href = "{{ route('contract_manager.orden-compra.filtrarPorEstado3') }}";
            });
        });
    </script>
@endsection
