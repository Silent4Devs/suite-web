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

    <div id="desk" class="mt-5 card" style="">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Directorio de Empleados </strong></h3>
        </div>


        <div class="card-body datatable-fix">
            <table id="dom" class="responsive-table" style="width: 100%">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($sugerencias as $sugerencia) --}}
                    @foreach ($empleados as $empleado)
                        <tr>

                            <td>

                                <img src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado->avatar }}"
                                    class="img_empleado" title="{{ $empleado->name }}">

                            </td>

                            <td>
                                <div>
                                    <strong style="color:#0CA193;">{{ $empleado->name }}</strong>
                                    @if (is_null($empleado->telefono_movil))
                                        <p>Sin teléfono</p>
                                    @else
                                        <p><i class="mr-2 fas fa-phone"></i>{{ $empleado->telefono_movil }} </p>
                                    @endif
                                </div>

                            </td>

                            <td>
                                <div>
                                    @if (is_null($empleado->area ))
                                        <p>No hay información registrada</p>
                                    @else
                                         <strong>Área: {{ $empleado->area->area }}</strong>
                                    @endif
                                    @if (is_null($empleado->supervisor))
                                        <p>No hay información registrada</p>
                                    @else
                                    <p>{{ $empleado->supervisor ? $empleado->supervisor->name : 'sin supervisor' }}</p>

                                    @endif
                                </div>

                            </td>

                            <td>
                                <div>
                                    @if (is_null($empleado->puestoRelacionado ))
                                        <p>No hay información registrada</p>
                                    @else
                                    <label><strong
                                        class="mr-2">Puesto:</strong>{{ $empleado->puestoRelacionado->puesto }}</label>
                                    @endif
                                    @if (is_null($empleado->fecha_ingreso ))
                                        <p>No hay información registrada</p>
                                    @else
                                    <p>Ingreso: {{ $empleado->fecha_ingreso }}</p>
                                    @endif

                                </div>

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

        </script>
    @endsection
