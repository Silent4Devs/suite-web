@extends('layouts.admin_glosario')
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
            #dom_length label{
                color: #ffffff;
                margin-bottom: -1.4em;
            }
            .dataTables_length{
                margin-bottom: -1.4em !important;
            }
            #dom_length::before {
               content: "Mostrar";
            }
            #dom_length::after {
               content: "conceptos";
            }
            #dom_filter label{
                color: #ffffff;
            }
            #dom_filter::before {
               content: "Buscar";
            }
            #dom_info{
                color: #ffffff;
            }
            #dom_previous{
                position: relative !important;
                color: rgba(0, 0, 0, 0) !important;
            }
            #dom_previous::before {
                position: absolute;
                top: 0%;
                left: 0%;
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
               content: "Anterior";
               color: black !important;
            }
            #dom_next{
            position: relative !important;
            color: rgba(0, 0, 0, 0) !important;
            padding: 5px 20px !important;
            display: inline !important;
            }
            #dom_next::after {
                position: absolute;
                top: 0%;
                left: 0%;
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
               content: "Siguiente";
               color: black !important;
            }

            @media(max-width: 1050px) {
                table tr {
                    display: flex;
                    flex-direction: column;
                }
            }

        </style>
    @can('glosario_create')




        <!--
                                                                    <div style="margin-bottom: 10px;" class="row">
                                                                        <div class="col-lg-12">
                                                                            <a class="btn btn-success" href="{{ route('admin.glosarios.create') }}">
                                                                                {{ trans('global.add') }} {{ trans('cruds.glosario.title_singular') }}
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                -->

    @endcan
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
                    @foreach ( $glosarios as $glosario )
                    <tr>
                        <td style="font-size: 8pt;">{{$glosario->numero}}</td>
                        <td style="font-size: 8pt;">{{$glosario->concepto}}</td>
                        <td style="font-size: 8pt;">{{$glosario->norma}}</td>
                        <td style="font-size: 8pt;">{{$glosario->definicion}}</td>
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

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!--Abecedario-->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>


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
            var table = $('#dom').DataTable({
                dom: 'Alfrtip',


            });
        });

        $(document).ready(function() {
          document.getElementById('dom_info').content
        });

    </script>
@endsection
