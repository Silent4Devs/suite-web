@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/pasarelaPago/pasarelaPago.css') }}">
@endsection
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    <div class="menu-pasarela">
        <ul>
            <li> <strong> Aplicaciones </strong> </li>
            <li>
                <i class="material-symbols-outlined">apps</i>
                Todas las aplicaciones
            </li>
            <li>
                <i class="material-symbols-outlined">install_desktop</i>
                Actualizaciones
            </li>
        </ul>

        <ul class="mt-5">
            <li> <strong> Planes </strong> </li>
            <li>
                <i class="material-symbols-outlined">credit_card</i>
                Planes y Precios
            </li>
        </ul>

        <ul class="mt-5">
            <li> <strong> Aplicaciones </strong> </li>
            <li>
                <i class="material-symbols-outlined">school</i>
                Capacitación
            </li>
            <li>
                <i class="material-symbols-outlined">language</i>
                Gestión Normativa
            </li>
            <li>
                <i class="material-symbols-outlined">quick_reference</i>
                Planes de trabajo
            </li>
            <li>
                <i class="material-symbols-outlined">folder_managed</i>
                Gestor Documental
            </li>
            <li>
                <i class="material-symbols-outlined">install_desktop</i>
                Gestión de Talento
            </li>
            <li>
                <i class="material-symbols-outlined">quick_reference</i>
                Gestión Contractual
            </li>
            <li>
                <i class="material-symbols-outlined">gpp_maybe</i>
                Gestión de Riesgos
            </li>
            <li>
                <i class="material-symbols-outlined">groups</i>
                Visitantes
            </li>
        </ul>
    </div>
    <div>

    </div>
@endsection
@section('scripts')
@endsection
