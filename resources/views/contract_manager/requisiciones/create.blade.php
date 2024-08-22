@extends('layouts.admin')

@section('content')
    <style>
        .chat-wrapper {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 500px;
            /* Aumenta el ancho de la caja */
            height: 350px;
            /* Aumenta el alto de la caja */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-box {
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            /* Transparente */
            border: 1px solid #ddd;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow: hidden;
            /* Para asegurar que los bordes redondeados se mantengan */
        }

        .chat-frame {
            flex: 1;
            margin: 10px;
            /* Espacio para crear el efecto de marco */
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            background: rgba(255, 255, 255, 0.9);
            /* Fondo transparente del marco */
        }

        .chat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: rgba(74, 144, 226, 0.9);
            color: white;
            position: relative;
        }

        .chat-header h3 {
            margin: 0;
            flex: 1;
            text-align: center;
        }


        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.5em;
            cursor: pointer;
        }

        .chat-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: rgba(249, 249, 249, 0.9);
            display: flex;
            flex-direction: column;
        }

        .chat-input {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
            background: rgba(245, 245, 245, 0.9);
        }

        .chat-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            margin-right: 10px;
        }

        .chat-input button {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            background: #4A90E2;
            color: white;
            cursor: pointer;
        }

        .chat-input button:hover {
            background: #357ABD;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 20px;
            max-width: 80%;
        }

        .bot-message {
            background: #e1f5fe;
            color: #0277bd;
        }

        .user-message {
            background: #c8e6c9;
            color: #388e3c;
            align-self: flex-end;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/requisitions/requisitions.css') }}{{ config('app.cssVersion') }}">
    <link rel="stylesheet" href="{{ asset('css/requisitions/jquery.signature.css') }}{{ config('app.cssVersion') }}">

    @livewire('requisiciones-create-component')
@endsection
