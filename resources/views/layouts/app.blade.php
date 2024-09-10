<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/auth/TBIconTabantaj.png') }}">

    <link rel="stylesheet" href="{{ asset('css/auth/TBlogin.css') }}">

    <title>{{ trans('panel.site_title') }}</title>
    @yield('styles')
    @livewireStyles
</head>

<body class="@yield('classBody')">
    <button class="btn-animation-stop"><img src="{{ asset('img/auth/icon-next.svg') }}" alt="Icon next"></button>
    <main class="content-main">
        <div class="present-tbj">
            <div class="logo-box">
                <img src="{{ asset('img/auth/TBlogoLoginMobile.png') }}" class="isotipo" alt="Logo">
                <div class="box-circle-color">
                    <img src="{{ asset('img/auth/TBLogoColorCircle.png') }}" class="logo-circle" alt="Logo circulo">
                </div>
            </div>
            <div class="box-title-tbj">
                <img src="{{ asset('img/auth/TBlogoLoginLetras.png') }}" alt="Logo Tabantaj" class="tbj-title">
                <h2 class="text-by">
                    By <strong>Silent</strong>for<strong>Business</strong>
                </h2>
            </div>
            <h1 class="text-bienvenidos">
                <strong> Bienvenidos al </strong> Sistema Integral de Gestión Empresarial
            </h1>
        </div>
        <div class="aside-tbj">
            <div class="aside-box-content">
                @yield('content')
            </div>
        </div>
    </main>


    <script src="{{ asset('js/auth/app.js') }}"></script>
    @yield('scripts')
    @livewireScripts
</body>

</html>
