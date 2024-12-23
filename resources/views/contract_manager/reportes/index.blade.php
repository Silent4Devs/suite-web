@extends('layouts.admin')
@section('content')
@section('titulo', 'Reportes')

<link rel="stylesheet" type="text/css" href="{{ asset('css/reports.css/reports.css') }}{{ config('app.cssVersion') }}" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href=" https://printjs-4de6.kxcdn.com/print.min.css">

<style type="text/css">
    .caja_general_p {
        display: flex;
        align-items: center;
    }

    .a_btn {
        width: 100px;
        height: 100px;
        /* background-color: #0ebfbf; */
        display: inline-block;
        position: relative;
        margin-left: 3%;
        text-align: center;
        border-radius: 5px;
        transition: 0.1s;
        /*box-shadow: 0px 3px 5px -2px #888;*/
    }

    .a_btn:hover {
        /*box-shadow: 0px 3px 6px 0px #888;*/
    }

    .icono_btn {
        position: absolute;
        top: 22px;
        font-size: 34pt;
        color: #fff !important;
    }

    .text_btn {
        position: absolute;
        top: 70px;
        font-size: 10pt;
        color: #fff !important;
    }

    section {
        display: none;
        width: 90%;
        max-width: 850px;
        min-height: 500px;
        margin: auto;
        overflow-x: auto;
        padding: 20px;
    }

    section:target {
        display: block;
    }

    section .card {
        width: 792px;
        margin: auto;
    }

    .seleccionar {
        margin-bottom: 20px;
    }

    @media(max-width: 1188px) {
        .caja_general_p {
            display: block;
        }

        .a_btn {
            margin-top: 10px;
        }
    }

    .logo_organizacion {
        width: 120px;
        height: 120px;
        margin: auto;

        @isset($logotipo->logotipo)
            background-image: url('{{ url('images/' . $logotipo->logotipo) }}');
        @endisset
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
    }

    .btn.tb-btn-primary {
        margin-top: 30px;
    }


    button i {
        margin-right: 10px;
    }

    h5 {
        margin-bottom: 20px;
        color: #777;
        border-bottom: 2px solid #bbb;
        text-align: right;
        padding-bottom: 9px;
    }


    .align {
        text-align: left !important;
        font-size: 18px;
        color: var(--color-tbj);
        opacity: 100% !important;
    }

    .titulo-form,
    .sub-titulo-form {
        font-size: 18px;
        color: var(--color-tbj);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
</style>

<div class="page-reportes">
    <div class="card card-content">
        @livewire('contract-manager.reportes-component')
    </div>

</div>

@endsection
