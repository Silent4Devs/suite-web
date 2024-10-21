@extends('layouts.admin')
@section('content')
    <style type="text/css">
        table {
            width: 100%;
        }

        table td {
            text-align: justify;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            vertical-align: top;
        }

        div.alphabet {
            position: relative;
            display: table;
            width: 100%;
            margin-bottom: 1em;
        }

        div.alphabet span {
            display: table-cell;
            color: #3174c7;
            cursor: pointer;
            text-align: center;
            width: 3.5%
        }

        div.alphabet span:hover {
            text-decoration: underline;
        }

        div.alphabet span.active {
            color: black;
        }

        div.alphabet span.empty {
            color: red;
        }

        div.alphabetInfo {
            display: block;
            position: absolute;
            background-color: #111;
            border-radius: 3px;
            color: white;
            top: 2em;
            height: 1.8em;
            padding-top: 0.4em;
            text-align: center;
            z-index: 1;
        }

        .paginate_button {
            margin: 5px;
            padding: 5px 10px;
            background: #a3d6ed;
            cursor: pointer;
            border-radius: 4px;
            color: #fff;
        }

        body.c-dark-theme .paginate_button {
            background: #4488a7;
        }


        @media(max-width: 1050px) {
            table tr {
                display: flex;
                flex-direction: column;
            }
        }
    </style>
    <h5 class="col-12 titulo_general_funcion">Glosario</h5>
    <div class="mt-5 card">
        <div class="card-body datatable-fix">
            <div class="d-flex justify-content-end">
                <a class="boton-transparente boton-sin-borde" href="{{ route('descarga-glosarios') }}">
                    <!-- <img src="{{ asset('download_FILL0_wght300_GRAD0_opsz24.svg') }}" alt="Importar" class="icon"> -->
                    <i class="fas fa-file-excel icon" style="font-size: 1.5rem;color:#0f6935"></i>
                </a> &nbsp;&nbsp;&nbsp;
            </div>
            <table id="dom" class="table table-bordered w-100 datatable-glosario" style="width: 100%">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width:50px;">Inciso</th>
                        <th style="min-width:150px;">Concepto</th>
                        <th style="min-width:100px;">Moduló</th>
                        <th style="min-width:150px;">Definición</th>
                        <th style="min-width:150px;">Explicación</th>
                        <th style="min-width:100px;">Opción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($glosarios as $glosario)
                        <tr>
                            <td>{{ $glosario->numero }}</td>
                            <td>{{ $glosario->concepto }}</td>
                            <td>{{ $glosario->norma }}</td>
                            <td>{{ Str::limit($glosario->definicion, 60, '...') }}</td>
                            <td>{{ Str::limit($glosario->explicacion, 60, '...') }}</td>
                            <td>
                                <form action="{{ route('admin.glosarios.destroy', $glosario->id) }}" method="POST">
                                    <a href="{{ route('admin.glosarios.edit', $glosario->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="{{ route('admin.glosarios.show', $glosario->id) }}"><i
                                            class="fas fa-eye"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="delete"
                                        style="border: none; background-color:transparent;">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </form>
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

    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!--Abecedario-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script> --}}

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
                url: "{{ route('admin.glosarios.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
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
