@extends('layouts.admin')
@section('content')

    <style>
        .dotverde {
            height: 15px;
            width: 15px;
            background-color: green;
            border-radius: 50%;
            display: inline-block;
        }

        .dotyellow {
            height: 15px;
            width: 15px;
            background-color: yellow;
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

    </style>

    {{ Breadcrumbs::render('admin.indicadores-sgsis.create') }}

    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong>Evaluaciones Indicadores SGSI</h3>
        </div>
        <div class="card-body">

            @livewire('indicadores-sgsi-component', ['indicadoresSgsis' => $indicadoresSgsis])
        </div>
    </div>

    <script>
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
    </script>

@endsection
