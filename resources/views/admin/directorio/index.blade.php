@extends('layouts.admin_glosario')
@section('content')



    <style type="text/css">
        #jquerydata_tablenoabecedario {
            display: none !important;
        }

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

        #dom_length label{
            color:white;

        }

        #dom_length:before{
            content:"Mostrar" !important;
            color:#111 !important;
            margin-right:-30px !important;
            position:relative;
            z-index:2;

        }

        #dom_length:after{
            content:"empleados" !important;
            color:#111 !important;
            margin-left:-35px !important;
            position:relative;
            z-index:2;

        }

        .responsive-table{

            margin-top:200px !important;
        }

        #dom_filter label:before{
            content:"Buscar" !important;
            color:#111 !important;
            margin-right:-30px !important;
            position:relative;
            z-index:2;


        }

        #dom_filter label{
            color:white;
        }

        dataTables_filter{
            padding-bottom: 30px !important;
        }

        .thead-dark{

            display:none;
        }

        #dom_length{
            margin-top:50px!important;
        }

        #dom_filter{
            margin-top:-43px!important;

        }

        #dom_wrapper{

            border-bottom: solid 2px #345183 !important;
            width: 100% !important;
        }


    </style>

    <h5 class="col-12 titulo_general_funcion">Directorio de Empleados</h5>
    
    <div id="desk" class="mt-5 card" style="">


        <div class="card-body datatable-fix ">

            <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183 !important;">
            </div>

            <table id="dom" class="responsive-table" style="width: 100%; margin-top:50px !important">
                <thead class="thead-dark">

                    <tr>

                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody class="mt-4 mb-3 w-100">
                    <div class="mt-4 mb-3 w-100">
                    </div>
                    {{-- @foreach ($sugerencias as $sugerencia) --}}
                    @foreach ($empleados as $empleado)

                        <tr>

                            <td >

                                <img src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado->avatar }}"
                                    class="img_empleado" title="{{ $empleado->name }}">

                            </td>

                            <td>
                                {{-- <div>
                                    <strong class="nombre-empleado" style="color:#345183;">{{ $empleado->name }}</strong>
                                    @if (is_null($empleado->telefono_movil))
                                        <p>Sin teléfono</p>
                                    @else
                                        <p><i class="mr-2 fas fa-phone"></i>{{ $empleado->telefono_movil }} </p>
                                    @endif
                                </div> --}}
                                {{ $empleado->name }}
                                @if ($empleado->mostrar_telefono)
                                @if (is_null($empleado->telefono_movil))
                                <p>Sin teléfono</p>
                                @else
                                <p><i class="mr-2 fas fa-phone"></i>{{ $empleado->telefono_movil }} </p>
                                @endif
                                @else
                                <p>Sin teléfono</p>
                                @endif



                            </td>

                            <td>
                                <div>
                                    @if (is_null($empleado->area))
                                        <label>No hay información registrada</label>
                                    @else
                                        <strong>Área: {{ $empleado->area->area }}</strong>
                                    @endif
                                    @if (is_null($empleado->supervisor))
                                        <label>No hay información registrada</label>
                                    @else
                                        <p>{{ $empleado->supervisor ? $empleado->supervisor->name : 'sin supervisor' }}
                                        </p>

                                    @endif
                                </div>

                            </td>

                            <td>
                                <div>
                                    @if (is_null($empleado->puestoRelacionado))
                                        <label>No hay información registrada</label>
                                    @else
                                      <div><strong
                                                class="mr-2">Puesto:</strong>{{ $empleado->puestoRelacionado->puesto }}</div>
                                    @endif
                                    @if (is_null($empleado->email))
                                        <label>No hay información registrada</label>
                                    @else
                                        <p class="text-muted">{{ $empleado->email }}</p>
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


        var _alphabetSearch = '';

        $.fn.dataTable.ext.search.push(function(settings, searchData) {
            if (!_alphabetSearch) {
                return true;
            }
            console.log(searchData[1].trim().charAt(0).toUpperCase(), _alphabetSearch);
            if (searchData[1].trim().charAt(0).toUpperCase()==_alphabetSearch) {
                return true;
            }

            return false;
        });


        $(document).ready(function() {
            var table = $('#dom').DataTable();
            var selector = $(".nombre-empleado");
            var columnData = table.column(1).data();
            console.log(columnData);

            var bins = bin(columnData);
            var alphabet = $('<div class="alphabet"/>').append('');

            $('<span class="clear active"/>')
                .data('letter', '')
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

            alphabet.insertBefore(table.table().container());

            alphabet.on('click', 'span', function() {
                alphabet.find('.active').removeClass('active');
                $(this).addClass('active');
                console.log($(this).data('letter'));
                _alphabetSearch = $(this).data('letter');
                table.draw();
            });
        });


    </script>

    <script>
    //   $(document).ready(function(){
    //     console.log('hola');
    //     document.querySelector('#dom_length label').replace(Show, "mostrar");
    //   });


    </script>


@endsection
