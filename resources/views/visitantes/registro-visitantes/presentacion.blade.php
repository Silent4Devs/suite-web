@extends('layouts.visitantes')
@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">

    <style>
        html,
        body {
            margin: 0;
            height: 100%;
        }

        .box {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1766BB;
            color: white;
            flex-wrap: wrap;
        }

        .logo {
            background-image: url('/storage/images/Grupo 2794.jpg');
        }

        .left-section {
            flex: 2;
            padding: 40px;
        }

        .right-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #3C78D8;
            padding: 20px;
            height: inherit;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: left;
            color: #2E2E2E;
            width: 220px;
            margin: 10px;
            display: inline-block;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            color: #2E2E2E;
        }

        .card p {
            font-family: 'Roboto', sans-serif;
        }

        .card i {
            font-size: 40px;
        }

        .entrada {
            color: green;
        }

        .salida {
            color: goldenrod;
        }

        .texto-chico {
            font-size: 18px;
            margin: 0;
        }

        .texto-grande {
            font-size: 22px;
            font-weight: bold;
        }

        .presentacion {
            width: 100%;
            padding-left: 21%;
        }
    </style>

    <div class="box row w-100 p-0 m-0">
        <div class="left-section text-center">
            <div class="text-start">
                <div class="presentacion">
                    <img class="mb-3" src="{{ url('storage/images/Grupo_2794.png') }}" alt="Logo">
                    <h1>Bienvenido</h1>
                    <h3>Registra tu visita</h3>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4 gap-4">
                <a href="{{ route('visitantes.index') }}" class="card">
                    <img class="mb-3" src="{{ url('storage/images/Grupo_2771.png') }}" alt="Logo">
                    <p class="texto-chico">Registrar </p>
                    <p class="texto-grande">Entrada
                        <img class="float-end ms-5" src="{{ url('storage/images/Grupo_2764.png') }}" alt="Logo">
                    </p>
                </a>
                <a href="{{ route('visitantes.salida') }}" class="card">
                    <img class="mb-3" src="{{ url('storage/images/Grupo_2770.png') }}" alt="Logo">
                    <p class="texto-chico">Registrar </p>
                    <p class="texto-grande">Salida
                        <img class="float-end ms-5" src="{{ url('storage/images/Grupo_2768.png') }}" alt="Logo">

                    </p>
                </a>
            </div>
        </div>
        <div class="right-section text-center">
            <div>
                <p>Escanea el QR para registrar tu entrada</p>
                    {!! QrCode::size(180)->generate(route('visitantes.index')) !!}
            </div>
        </div>
    </div>
@endsection
