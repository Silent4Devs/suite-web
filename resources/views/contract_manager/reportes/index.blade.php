@extends('layouts.admin')
@section('content')
@section('titulo', 'Reportes')

<link rel="preload" type="text/css" href="{{ asset('css/reports/reports.css') }}{{ config('app.cssVersion') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/reports/reports.css') }}{{ config('app.cssVersion') }}" />
{{-- <link rel="stylesheet" href="{{ asset('css/requisitions/requisitions.css') }}{{ config('app.cssVersion') }}"> --}}
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
        display: inline-block;
        position: relative;
        margin-left: 3%;
        text-align: center;
        border-radius: 5px;
        transition: 0.1s;
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
        width: 100%;
        min-height: 500px;
        margin: auto;
        overflow-x: auto;
    }

    section:target {
        display: block;
    }

    section .card {
        width: 100%;
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

    /* From Uiverse.io by PriyanshuGupta28 */
    .spinner {
        position: absolute;
        width: 9px;
        height: 9px;
    }

    .spinner div {
        position: absolute;
        width: 50%;
        height: 150%;
        background: #000000;
        transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1%));
        animation: spinner-fzua35 1s calc(var(--delay) * 1s) infinite ease;
    }

    .spinner div:nth-child(1) {
        --delay: 0.1;
        --rotation: 36;
        --translation: 150;
    }

    .spinner div:nth-child(2) {
        --delay: 0.2;
        --rotation: 72;
        --translation: 150;
    }

    .spinner div:nth-child(3) {
        --delay: 0.3;
        --rotation: 108;
        --translation: 150;
    }

    .spinner div:nth-child(4) {
        --delay: 0.4;
        --rotation: 144;
        --translation: 150;
    }

    .spinner div:nth-child(5) {
        --delay: 0.5;
        --rotation: 180;
        --translation: 150;
    }

    .spinner div:nth-child(6) {
        --delay: 0.6;
        --rotation: 216;
        --translation: 150;
    }

    .spinner div:nth-child(7) {
        --delay: 0.7;
        --rotation: 252;
        --translation: 150;
    }

    .spinner div:nth-child(8) {
        --delay: 0.8;
        --rotation: 288;
        --translation: 150;
    }

    .spinner div:nth-child(9) {
        --delay: 0.9;
        --rotation: 324;
        --translation: 150;
    }

    .spinner div:nth-child(10) {
        --delay: 1;
        --rotation: 360;
        --translation: 150;
    }

    @keyframes spinner-fzua35 {
        0%,
        10%,
        20%,
        30%,
        50%,
        60%,
        70%,
        80%,
        90%,
        100% {
            transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1%));
        }

        50% {
            transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1.5%));
        }
    }
</style>

<div class="page-reportes">
    <div>
        @livewire('contract-manager.reportes-component')
    </div>
</div>
