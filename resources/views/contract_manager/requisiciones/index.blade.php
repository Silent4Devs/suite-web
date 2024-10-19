@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Requisiciones</h5>
    <div class="mt-5 card">
        <div class="card-body">
            <form class="text-right" action="{{ route('contract_manager.requisiciones.indexAprobadores') }}" method="GET">
                @method('GET')
                <a class="btn btn-primary" href="{{ route('contract_manager.requisiciones.create') }}">Agregar</a>
                <button class="btn btn-primary" type="submit" title="Aprobadores">
                    Aprobadores
                </button>
                <a class="btn btn-primary" href="{{ route('contract_manager.requisiciones.archivo') }}">Archivados</a>
            </form>
            <table id="dom" class="table w-100 datatable-perspectiva" style="width: 100%">
                <thead class="">
                    <tr>
                        <th style="vertical-align: top; min-width: 100px;">Folio</th>
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

                                    @case('cancelada')
                                        <h5><span class="badge badge-pill badge-danger">Cancelada</span></h5>
                                    @break

                                    @case('rechazado')
                                        <h5><span class="badge badge-pill badge-danger">Rechazado</span></h5>
                                    @break

                                    @case('firmada')
                                        <h5><span class="badge badge-pill badge-success">Firmada</span></h5>
                                    @break

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
                                            $employee = App\Models\User::find($requisicion->id_user)->empleado;
                                            if ($requisicion->registroFirmas) {
                                                $supervisorName = $requisicion->registroFirmas->jefe->name;
                                            } elseif ($employee !== null && $employee->supervisor !== null) {
                                                $supervisorName = $employee->supervisor->name;
                                            } else {
                                                $supervisorName = 'N/A'; // Or any default value you prefer
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
                                        <p>Comprador: {{ $comprador->name }}</p>
                                    @break

                                    @default
                                        <h5><span class="badge badge-pill badge-success">Completado</span></h5>
                                @endswitch
                            </td>
                            <td>{{ $requisicion->contrato->nombre_servicio ?? 'Sin servicio disponible' }}</td>
                            <td>{{ $requisicion->area }}</td>
                            <td>{{ $requisicion->user }}</td>
                            <td>

                                {{-- @if ($requisicion->estado === 'rechazado')
                                    <a href="{{ route('contract_manager.requisiciones.edit', $requisicion->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                @endif --}}

                                <a href="{{ route('contract_manager.requisiciones.show', $requisicion->id) }}"><i
                                        class="fa-solid fa-print"></i></a>


                                <a
                                    onclick="mostrarAlerta2('{{ route('contract_manager.requisiciones.estado', $requisicion->id) }}')"><i
                                        class="fa-solid fa-box-archive"></i></a>

                                <a
                                    onclick="mostrarAlerta('{{ route('contract_manager.requisiciones.destroy', $requisicion->id) }}')"><i
                                        class="fas fa-trash text-danger"></i></a>

                                @if ($requisicion->estado == 'cancelada')
                                    <a href="{{ route('contract_manager.requisiciones.edit', $requisicion->id) }}"><i
                                            class="fas fa-pen"></i></a>
                                @endif

                                @if ($requisicion->estado == 'curso')
                                    <a
                                        onclick="mostrarAlerta3('{{ route('contract_manager.requisiciones.cancelarRequisicion', $requisicion->id) }}', 1, {{ $requisicion->id }})"><i
                                            class="fa-regular fa-rectangle-xmark"></i></a>
                                @elseif($requisicion->estado == 'aprobado' || $requisicion->estado == 'firmada')
                                    <a
                                        onclick="mostrarAlerta3('{{ route('contract_manager.requisiciones.cancelarRequisicion', $requisicion->id) }}', 2, {{ $requisicion->id }})"><i
                                            class="fa-regular fa-rectangle-xmark"></i></a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@section('scripts')
    @parent

    <script>
        function mostrarAlerta(url) {
            console.log('URL para eliminar:', url);
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'No podrás deshacer esta acción',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                            method: 'GET', // Cambia a 'DELETE' si es necesario
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok ' + response.statusText);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire('¡Eliminado!', 'El elemento ha sido eliminado.', 'success')
                                    .then(() => {
                                        window.location.reload(); // Refresca la página
                                    });
                            } else {
                                window.location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            window.location.reload();
                        });
                }
            });
        }

        function mostrarAlerta2(url) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'No podrás deshacer esta acción',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, archivar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Coloca aquí la lógica para eliminar el elemento
                    // Esto puede incluir una solicitud AJAX al servidor o cualquier otra lógica de eliminación
                    // Una vez que el elemento se haya eliminado, puedes mostrar un mensaje de éxito
                    Swal.fire('Archivado!', 'El elemento ha sido archivado.', 'success');
                    window.location.href = url;
                }
            });
        }

        function mostrarAlerta3(url, tipo, id) {
            let titleText = tipo == 1 ?
                '¿Está seguro de cancelar la requisición RQ-' + id + '?' :
                '¿Está seguro de cancelar la requisición RQ-' + id +
                '? Al realizar esta acción también se cancelará la orden de compra.';

            Swal.fire({
                title: titleText,
                text: 'No podrás deshacer esta acción',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la solicitud AJAX usando fetch
                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('¡Cancelado!', 'La Requisición ha sido cancelada.', 'success').then(
                                    () => {
                                        window.location.reload(); // Refresca la página
                                    });
                            } else {
                                Swal.fire('Error', 'No se pudo cancelar la requisición. Inténtelo de nuevo.',
                                    'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error', 'Hubo un problema al procesar la solicitud.', 'error');
                            console.error('Error:', error);
                        });
                }
            });
        }
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
            // let btnAgregar = {
            //     text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //     titleAttr: 'Agregar empleado',
            //     url: "{{ route('contract_manager.requisiciones.create') }}",
            //     className: "btn-xs btn-outline-success rounded ml-2 pr-3",
            //     action: function(e, dt, node, config) {
            //         let {
            //             url
            //         } = config;
            //         window.location.href = url;
            //     }
            // };

            // dtButtons.push(btnAgregar);

            var table = $('#dom').DataTable({
                buttons: dtButtons,

                // dom: 'AlBfrtip',
                dom: "<'row align-items-center justify-content-center col-12'<'text-center col-12 col-sm-12 col-md-12 col-lg-12'A><'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-5 col-lg-5'B><'col-md-4 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>"
            });
        });
    </script>
@endsection
