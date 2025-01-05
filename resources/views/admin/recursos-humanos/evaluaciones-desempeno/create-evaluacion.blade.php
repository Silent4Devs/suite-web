@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluaciones.css') }}{{ config('app.cssVersion') }}">

    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            color: #fff;
            font-size: 1.2rem;
        }

        .spinner-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .checkbox-large {
            width: 24px !important;
            height: 24px !important;
        }

        .form-check {
            justify-content: center; /* Centra el contenido horizontalmente */
            align-items: center;    /* Centra el contenido verticalmente */
            height: 100%;           /* Asegura que ocupe toda la altura de la fila */
        }

        input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #007bff;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
            margin-right: 5px;
        }

        input[type="radio"]:checked {
            background-color: #007bff;
            border-color: #007bff;
            box-shadow: 0 0 3px rgba(0, 123, 255, 0.5);
        }

        label {
            cursor: pointer;
        }

        .alert-danger {
            background: #FFFDE3 0% 0% no-repeat padding-box !important;
            box-shadow: 0px 2px 3px #00000024 !important;
            border: 2px solid #FFC400 !important;
            border-radius: 21px !important;
            opacity: 1 !important;
        }

        .step {
            list-style: none;
            margin: .2rem 0;
            width: 100%;
        }

        .step .step-item {
            -ms-flex: 1 1 0;
            flex: 1 1 0;
            margin-top: 0;
            min-height: 1rem;
            position: relative;
            text-align: center;
        }

        .step .step-item:not(:first-child)::before {
            background: #0069d9;
            content: "";
            height: 2px;
            left: -50%;
            position: absolute;
            top: 9px;
            width: 100%;
        }

        .step .step-item a {
            color: #acb3c2;
            display: inline-block;
            padding: 20px 10px 0;
            text-decoration: none;
        }

        .step .step-item a::before {
            background: #0069d9;
            border: .1rem solid #fff;
            border-radius: 50%;
            content: "";
            display: block;
            height: .9rem;
            left: 50%;
            position: absolute;
            top: .2rem;
            transform: translateX(-50%);
            width: .9rem;
            z-index: 1;
        }

        .step .step-item.active a::before {
            background: #fff;
            border: .1rem solid #0069d9;
        }

        .step .step-item.active~.step-item::before {
            background: #e7e9ed;
        }

        .step .step-item.active~.step-item a::before {
            background: #e7e9ed;
        }
    </style>
@endsection
@section('content')
    @livewire('create-evaluacion-desempeno')
@endsection
