@extends('layouts.admin')
@section('content')
    <style>
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
    </style>
    {{-- @can('glosario_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.glosarios.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.glosario.title_singular') }}
            </a>
        </div>
    </div>
    @endcan --}}
    <h5 class="col-12 titulo_general_funcion">Glosario</h5>
    <div class="mt-5 card">
        <div class="card-body datatable-fix">
            <table id="dom" class="responsive-table" style="width: 100%">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Concepto</th>
                        <th>Moduló</th>
                        <th>Definición</th>
                        {{-- <th>Explicación</th> --}}

                    </tr>
                </thead>
                <tbody>
                    @foreach ($glosarios as $glosario)
                        <tr>
                            <td style="font-size: 8pt;">{{ $glosario->numero }}</td>
                            <td style="font-size: 8pt;">{{ $glosario->concepto }}</td>
                            <td style="font-size: 8pt;">{{ $glosario->norma }}</td>
                            <td style="font-size: 8pt;">{{ $glosario->definicion }}</td>
                            {{-- <td style="font-size: 8pt;">{{$glosario->explicacion}}</td> --}}

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <!--Abecedario-->
    <script type="text/javascript">
        $(function() {
            // Search function
            $.fn.dataTable.Api.register('alphabetSearch()', function(searchTerm) {
                console.log('si');
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
    </script>
    <script>
        var table = $('#dom').DataTable({
            buttons: [],
            retrieve: true,
            aaSorting: [],
            dom: 'Alfrtip',
            alphabetSearch: true,
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    </script>
@endsection
