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
    </style>
    <h5 class="col-12 titulo_general_funcion">Empleados</h5>
    <div class="mt-5 card">
        <div class="card-body datatable-fix">
            <div class="d-flex justify-content-between" style="justify-content: flex-end !important;">
                @can('bd_empleados_configurar_vista_datos')
                    <div class="p-2">
                        <a href="{{ url('admin/panel-inicio') }}" style="text-align: right;padding-right: 20px;"
                            class="btn btn-success btn-sm active" role="button" aria-pressed="true"><i
                                class="pl-2 pr-3 fas fa-plus"></i> Configurar vista datos</a>
                    </div>
                @endcan
                <div class="p-2">
                    <a href="{{ route('admin.empleado.importar') }}" style="text-align: right;padding-right: 20px;"
                        class="btn btn-success btn-sm active" role="button" aria-pressed="true"><i
                            class="fas fa-file-upload"></i> Importar datos</a>
                </div>
            </div>
            <table id="dom" class="table table-bordered w-100 datatable-perspectiva" style="width: 100%">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">Avatar</th>
                        <th style="vertical-align: top">N° Empleado</th>
                        <th style="vertical-align: top">Nombre</th>
                        <th style="vertical-align: top">Email</th>
                        <th style="vertical-align: top">Telefono</th>
                        <th style="vertical-align: top">Area</th>
                        <th style="vertical-align: top">Puesto</th>
                        <th style="vertical-align: top">Supervisor</th>
                        <th style="vertical-align: top">Antiguedad</th>
                        <th style="vertical-align: top">Estatus</th>
                        <th style="vertical-align: top">Sede</th>
                        <th style="vertical-align: top">Fecha Nacimiento</th>
                        <th style="vertical-align: top">Opciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            @if ($empleado->avatar_ruta)
                                <td><img src="{{ asset($empleado->avatar_ruta) }}" width="32px"
                                        alt="{{ $empleado->name }}"></td>
                            @else
                                <td>Sin Perfil</td>
                            @endif
                            @if ($empleado->n_empleado)
                                <td>{{ $empleado->n_empleado }}</td>
                            @else
                                <td>Sin Registro</td>
                            @endif
                            <td>{{ $empleado->name }}</td>
                            <td>{{ $empleado->email }}</td>
                            @if ($empleado->telefono)
                                <td>{{ $empleado->telefono }}</td>
                            @else
                                <td>Sin Registro</td>
                            @endif
                            <td>{{ $empleado->area->area }}</td>
                            <td>{{ $empleado->puesto }}</td>
                            @if (optional($empleado->supervisor)->name)
                                <td>{{ optional($empleado->supervisor)->name }}</td>
                            @else
                                <td>Sin Registro</td>
                            @endif
                            <td>{{ $empleado->antiguedad }}</td>
                            <td>{{ $empleado->estatus }}</td>
                            @if (optional($empleado->sede)->sede)
                                <td>{{ optional($empleado->sede)->sede }}</td>
                            @else
                                <td>Sin Registro</td>
                            @endif
                            @if ($empleado->cumpleaños)
                                <td>{{ $empleado->cumpleaños }}</td>
                            @else
                                <td>Sin Registro</td>
                            @endif
                            <td>
                                <a href="{{ route('admin.empleados.edit', $empleado->id) }}"><i
                                        class="fas fa-edit"></i></a>

                                <a href="{{ route('admin.empleados.show', $empleado->id) }}"><i class="fas fa-eye"></i></a>

                                <a href="{{ route('admin.empleado.solicitud-baja', $empleado->id) }}"><i
                                        class="fas fa-trash-alt text-danger"></i></a>

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
            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar empleado',
                url: "{{ route('admin.empleados.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };

            dtButtons.push(btnAgregar);

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
