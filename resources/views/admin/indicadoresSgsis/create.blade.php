@extends('layouts.admin')
@section('content')
    <style>
        .dotverde {
            height: 15px;
            width: 15px;
            background-color: #38c172;
            border-radius: 50%;
            display: inline-block;
        }

        .dotyellow {
            height: 15px;
            width: 15px;
            background-color: orange;
            border-radius: 50%;
            display: inline-block;
        }

        .dotred {
            height: 15px;
            width: 15px;
            background-color: red;
            border-radius: 50%;
            display: inline-block;
        }


        @font-face {
            font-family: 'Digital';

        }

        .result {
            background: #DEDFDB;
            color: #3b3b32;
            width: 90%;
            margin: 8px 0px 20px 10px;
            height: 50px;
            overflow: hidden;
            font-family: Digital;
            text-align: right;
            line-height: 46px;
            padding-right: 10px;
            font-size: 20px;
            box-shadow: inset 0 0px 8px rgba(0, 0, 0, 0.5), inset 0px 2px 0 #a1a1a1;

        }

        .numbers {
            padding: 0;
            margin: 0;
        }

        .numbers>li {
            background: #efefef;
            padding: 10px;
            font-family: Share;
            width: 15%;
            list-style: none;
            float: left;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            color: #737373;
            font-size: 20px;
            box-shadow: 0 5px 0 #a1a1a1, 0 2px 5px rgba(0, 0, 0, .75);
            text-align: center;
            transition: all .07s ease;
            -webkit-transition: all .07s ease;
            -moz-transition: all .07s ease;
        }

        .numbers>li:active {
            position: relative;
            top: 5px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, .4);
        }

        .numbers>li:last-child {
            width: 34%;
            /*margin-top: -48px;*/
        }

        .numbers>li:nth-child(16) {
            height: 52px;
            line-height: 40px;
        }

        .calc {
            background: #D1D1D1;
            width: 350px;
            /*position: absolute;*/
            top: 5%;
            left: 50%;
            margin: auto;
            padding: 10px;
            border-radius: 5px;
            height: 370px;
            text-align: center;
            box-shadow: 0 6px 0 #a1a1a1, 0 8px 10px rgba(0, 0, 0, .75);

        }
    </style>

    {{ Breadcrumbs::render('admin.indicadores-sgsis.create') }}
    <h5 class="col-12 titulo_general_funcion">Indicadores del Sistema de Gestión</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
            <div>
                <br>
                <br>
                <h4>¿Qué es Indicadores del Sistema de Gestión?  </h4>
                <p>
                    Marcadores que proporcionan la información necesaria para tomar decisiones y ajustar estrategias según sea necesario.
                </p>
                <p>
                </p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.indicadores-sgsis.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mt-4 card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6 anima-focus">
                        <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" placeholder="" type="text" maxlength="255"
                            name="nombre" id="nombre" value="{{ old('nombre', '') }}" required>
                            {!! Form::label('nombre', 'Nombre del indicador*', ['class' => 'asterisco']) !!}
                        @if ($errors->has('nombre'))
                            <div class="text-danger">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group col-sm-6 col-md-6 col-lg-6 anima-focus">
                        <select class="form-control {{ $errors->has('id_area') ? 'is-invalid' : '' }}"
                            name="id_area" id="id_area" required>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">
                                    {{ $area->area }}
                                </option>
                            @endforeach
                        </select>
                        {!! Form::label('id_area', 'Área*', ['class' => 'asterisco']) !!}
                        @if ($errors->has('id_area'))
                            <div class="text-danger">
                                {{ $errors->first('id_area') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-4 mt-3 anima-focus">
                            <select class="form-control {{ $errors->has('id_empleado') ? 'is-invalid' : '' }}"
                                name='id_empleado' id='responsable_id' required>
                                <option value="">Seleccione un responsable</option>
                                @foreach ($responsables as $responsable)
                                    <option value="{{ $responsable->id }}" data-area="{{ $responsable->area->area }}"
                                        data-puesto="{{ $responsable->puesto }}">
                                        {{ $responsable->name }} </option>
                                @endforeach
                            </select>
                            {!! Form::label('id_empleado', 'Responsable*', ['class' => 'asterisco']) !!}
                            @if ($errors->has('id_empleado'))
                                <div class="text-danger">
                                    {{ $errors->first('id_empleado') }}
                                </div>
                            @endif
                    </div>

                    <div class="form-group col-md-4 mt-3 anima-focus">
                        <div class="form-control" id="responsable_puesto" readonly></div>
                        {!! Form::label('responsable_puesto', 'Puesto*', ['class' => 'asterisco']) !!}
                    </div>


                    <div class="form-group col-sm-12 col-md-4 col-lg-4 mt-3 anima-focus">
                        <div class="form-control" id="responsable_area" readonly></div>
                        {!! Form::label('responsable_area', 'Área*', ['class' => 'asterisco']) !!}
                    </div>
                </div>

                <div class="row">

                    <div class="form-group col-sm-12 anima-focus">
                            <select class="form-control select2 {{ $errors->has('id_proceso') ? 'is-invalid' : '' }}"
                                name="id_proceso" id="id_proceso" required>
                                <option value="">Seleccione un proceso</option>
                                @foreach ($procesos as $proceso)
                                    <option value="{{ $proceso->id }}">
                                        {{ $proceso->codigo }}/{{ $proceso->nombre }}</option>
                                @endforeach
                            </select>
                            {!! Form::label('id_proceso', 'Proceso*', ['class' => 'asterisco']) !!}
                            @if ($errors->has('id_proceso'))
                                <div class="text-danger">
                                    {{ $errors->first('id_proceso') }}
                                </div>
                            @endif
                    </div>

                </div>
                <div class="form-group anima-focus">
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                        id="descripcion">{{ old('descripcion') }}</textarea>
                        {!! Form::label('id_proceso', 'Descripción*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('descripcion'))
                        <div class="text-danger">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.sede.fields.descripcion_helper') }}</span>
                </div>
                <h4 class="text-primary">Rangos</h4>
                <hr>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <div class="form-group">
                            <label class="required" for="rojo"><span class="dotred"></span> De 0 a <span
                                    id="textorojo"></span></label>
                            <input class="form-control {{ $errors->has('rojo') ? 'is-invalid' : '' }}" type="number"
                                name="rojo" id="rojo" value="{{ old('rojo', '') }}" min="0" required>
                            @if ($errors->has('rojo'))
                                <div class="text-danger">
                                    {{ $errors->first('rojo') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group col-sm-4">
                        <div class="form-group">
                            <label class="required" for="amarillo"><span class="dotyellow"></span> De <span
                                    id="textorojo2"></span> a <span id="textoamarillo"></span>:</label>
                            <input class="form-control {{ $errors->has('amarillo') ? 'is-invalid' : '' }}" type="number"
                                name="amarillo" id="amarillo" value="{{ old('amarillo', '') }}" min="0" required>
                            @if ($errors->has('amarillo'))
                                <div class="text-danger">
                                    {{ $errors->first('amarillo') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label class="required" for="verde">
                            <span class="dotverde"></span>
                            De <span id="textoamarillo2"></span> a <span id="textoverde"></span>:</label>
                        <input class="form-control {{ $errors->has('verde') ? 'is-invalid' : '' }}" type="number"
                            name="verde" id="verde" value="{{ old('verde', '') }}" placeholder="" min="0"
                            required>
                        @if ($errors->has('verde'))
                            <div class="text-danger">
                                {{ $errors->first('verde') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-2 anima-focus">
                        <input class="form-control {{ $errors->has('unidadmedida') ? 'is-invalid' : '' }}" placeholder="" type="text"
                            name="unidadmedida" id="unidadmedida" value="{{ old('unidadmedida', '') }}" required>
                            {!! Form::label('unidadmedida', 'Unidad*', ['class' => 'asterisco']) !!}
                        @if ($errors->has('unidadmedida'))
                            <div class="text-danger">
                                {{ $errors->first('unidadmedida') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>

                    <div class="form-group col-sm-2 anima-focus">
                            <input class="form-control {{ $errors->has('meta') ? 'is-invalid' : '' }}" placeholder="" type="text"
                                name="meta" id="meta" value="{{ old('meta', '') }}" required>
                                {!! Form::label('meta', 'Meta*', ['class' => 'asterisco']) !!}
                            @if ($errors->has('meta'))
                                <div class="text-danger">
                                    {{ $errors->first('meta') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                    </div>

                    <div class="form-group col-sm-6 col-md-4 col-lg-4 anima-focus">
                            <input class="form-control {{ $errors->has('frecuencia') ? 'is-invalid' : '' }}" placeholder="" maxlength="255"
                                type="text" name="frecuencia" id="frecuencia" value="{{ old('frecuencia', '') }}"
                                required>
                                {!! Form::label('frecuencia', 'Frecuencia*', ['class' => 'asterisco']) !!}
                            @if ($errors->has('frecuencia'))
                                <div class="text-danger">
                                    {{ $errors->first('frecuencia') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                    </div>

                    <div class="form-group col-sm-2 anima-focus">
                            <input class="yearpicker form-control" {{ $errors->has('ano') ? 'is-invalid' : '' }} 
                                type="text" name="ano"  id="ano" value="{{ old('ano', '') }}" required>
                                {!! Form::label('ano', 'Año*', ['class' => 'asterisco']) !!}
                            @if ($errors->has('ano'))
                                <div class="text-danger">
                                    {{ $errors->first('ano') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                    </div>
                    <div class="form-group col-sm-2 anima-focus">
                            <input class="form-control {{ $errors->has('no_revisiones') ? 'is-invalid' : '' }}" placeholder=""
                                type="number" name="no_revisiones" id="no_revisiones" min="0"
                                value="{{ old('no_revisiones', '') }}" required>
                                {!! Form::label('no_revisiones', 'Revisiones*', ['class' => 'asterisco']) !!}
                            @if ($errors->has('no_revisiones'))
                                <div class="text-danger">
                                    {{ $errors->first('no_revisiones') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                    </div>
                </div>

                <h4 class="text-primary">Generación de fórmula</h4>
                <input id="formula" name="formula" readonly class="form-control" type="text" placeholder="Formula generada"
                    required><br>
                {{-- <button class="btn btn-info" id="abrir_generador">Abrir generador</button>&nbsp;&nbsp; --}}
                <hr>

                <div class="row" id="calculadora_generador">
                    <div class="col-sm-6 align-items-center">
                        <div class="container">
                            <div class="calc">
                                <input type="text" id="calculadora" name="calculadora" class="result" readonly >
                                <ul class="numbers">
                                    <li class="btnNumber" value="00">c</li>
                                    <li class="btnNumber" value="11">.</li>
                                    <li class="btnNumber" value="1">1</li>
                                    <li class="btnNumber" value="2">2</li>
                                    <li class="btnNumber" value="3">3</li>
                                    <li class="btnNumber" value="22">*</li>
                                    <li class="btnNumber" value="33">/</li>
                                    <li class="btnNumber" value="4">4</li>
                                    <li class="btnNumber" value="5">5</li>
                                    <li class="btnNumber" value="6">6</li>
                                    <li class="btnNumber" value="44">+</li>
                                    <li class="btnNumber" value="55">-</li>
                                    <li class="btnNumber" value="7">7</li>
                                    <li class="btnNumber" value="8">8</li>
                                    <li class="btnNumber" value="9">9</li>
                                    <li class="btnNumber" value="77">(</li>
                                    <li class="btnNumber" value="88">)</li>
                                    <li class="btnNumber" value="66">0</li>
                                    <li id="generar" class="btn btn-primary">Generar</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-sm-6">

                        <div class="form-inline">
                            <div class="mb-2 form-group">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                                    value="Añadir una variable:" disabled>
                            </div>
                            <div class="mb-2 form-group mx-sm-3">
                                <input id="variable" class="form-control" type="text" placeholder="Variable"><br>
                            </div>
                            <button id="añadir" class="btn btn-success" type="button">Añadir</button>
                        </div>

                        <table id="mytable" class="table mt-3 table-bordered table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Variable</th>
                                <th>Utilizar</th>
                                <th>Eliminar</th>
                            </tr>
                        </table>

                    </div>

                    <div class="mt-4 text-right form-group col-12">
                        <a href="{{ route('admin.indicadores-sgsis.index') }}" class="btn_cancelar">Cancelar</a>
                        <input type="submit" value="Guardar" class="btn btn-success btn_enviar_form_modal">
                    </div>
                </div>
            </div>



        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        //script para rangos de valores
        var n = document.getElementById("rojo");
        var m = document.getElementById("amarillo");
        var o = document.getElementById("verde");

        n.addEventListener("keyup", function(e) {
            rojo = document.getElementById("rojo").value;
            document.getElementById("textorojo").innerHTML = rojo
            document.getElementById("textorojo2").innerHTML = parseInt(rojo) + 1
            document.getElementById("amarillo").min = parseInt(rojo) + 1;
        });

        m.addEventListener("keyup", function(e) {
            amarillo = document.getElementById("amarillo").value;
            document.getElementById("textoamarillo").innerHTML = amarillo
            document.getElementById("textoamarillo2").innerHTML = parseInt(amarillo) + 1
        });

        o.addEventListener("keyup", function(e) {
            verde = document.getElementById("verde").value;
            document.getElementById("textoverde").innerHTML = verde
            document.getElementById("verde").min = parseInt(amarillo) + 1;
        });
        //script para rangos de valores
    </script>

    <script>
        //variables para tabla y formula
        $(document).ready(function() {
            //obtenemos el valor de los input
            var i = 1; //contador para asignar id al boton que borrara la fila

            $('#añadir').click(function() {
                var variable = document.getElementById("variable").value;

                //input valida que no sea vacio
                if (variable === '') {
                    alert("Por favor, introduzca una variable");
                    return false;
                }

                var fila = '<tr id="row' + i + '">' +
                    '<td>' + i + '</td>' +
                    '<td>' + variable + '</td>' +
                    '<td><button type="button" name="usar" id="' + i +
                    '" class="btn btn-info btnAñadir" value="' + variable + '">Usar</button></td>' +
                    '<td><button type="button" name="remove" id="' + i +
                    '" class="btn btn-danger btn_remove">Quitar</button></td>' +
                    '</tr>'; //esto seria lo que contendria la fila

                $('#mytable tr:first').after(fila);
                i++;
                document.getElementById("variable").value = "";

            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                //cuando da click obtenemos el id del boton
                $('#row' + button_id + '').remove(); //borra la fila
                //limpia el para que vuelva a contar las filas de la tabla
                //$("#adicionados").text("");
                var nFilas = $("#mytable tr").length;
                //$("#adicionados").append(nFilas - 1);
            });

            $(document).on('click', '.btnAñadir', function() {
                var value = $(this).attr("value");
                var elInput = document.getElementById("calculadora");
                elInput.value += "!$" + value + "!";

            });
        });
    </script>

    <script>
        document.querySelectorAll("li.btnNumber").forEach(function(elem) {
            elem.addEventListener('click', agregarTexto, false);
        });

        function agregarTexto() {
            var btnValor = this.value;
            var elInput = document.getElementById("calculadora");
            if (btnValor === 00) {
                document.getElementById("calculadora").value = "";
            } else if (btnValor === 11) {
                elInput.value += ".";
            } else if (btnValor === 22) {
                elInput.value += "*";
            } else if (btnValor === 33) {
                elInput.value += "/";
            } else if (btnValor === 44) {
                elInput.value += "+";
            } else if (btnValor === 55) {
                elInput.value += "-";
            } else if (btnValor === 66) {
                elInput.value += "0";
            } else if (btnValor === 77) {
                elInput.value += "(";
            } else if (btnValor === 88) {
                elInput.value += ")";
            } else {
                elInput.value += btnValor;
            }

        }
    </script>

    <script>
        //variables para boton generar en calculadora
        $(document).ready(function() {
            $('#generar').click(function() {
                var calculadora = document.getElementById("calculadora").value;

                //input valida que no sea vacio
                if (calculadora === '') {
                    alert("Por favor, ingrese una formula");
                    return false;
                }

                document.getElementById("formula").value = calculadora;

            });

            $(".yearpicker").yearpicker()

        });
    </script>

    <script>
        $("#abrir_generador").click(function() {
            $("#calculadora_generador").show("slow", function() {
                window.scrollTo(0, document.body.scrollHeight);
                $("#abrir_generador").hide();
            });
        });
    </script>


    <script>
        if (document.querySelector('#responsable_id') != null) {

            let responsable = document.querySelector('#responsable_id');
            let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
            let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');
            document.getElementById('responsable_puesto').innerHTML = recortarTexto(puesto_init);
            document.getElementById('responsable_area').innerHTML = recortarTexto(area_init);

            responsable.addEventListener('change', function(e) {
                e.preventDefault();
                let area = e.target.options[e.target.selectedIndex].getAttribute('data-area');
                let puesto = e.target.options[e.target.selectedIndex].getAttribute('data-puesto');
                console.log(e.target.options[e.target.selectedIndex]);
                document.getElementById('responsable_puesto').innerHTML = recortarTexto(puesto)
                document.getElementById('responsable_area').innerHTML = recortarTexto(area)
            })
        }

        function recortarTexto(texto, length = 30) {
            let trimmedString = texto?.length > length ?
                texto.substring(0, length - 3) + "..." :
                texto;
            return trimmedString;
        }
    </script>
@endsection
