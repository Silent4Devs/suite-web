<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/auth/TBlogin.css') }}">

    <title>{{ trans('panel.site_title') }}</title>
    @yield('styles')
    @livewireStyles
</head>

<body>
    <main class="content-main">
        <div class="present-tbj">
            <div class="logo-box">
                <img src="{{ asset('img/auth/TBlogoLoginMobile.png') }}" class="isotipo" alt="Logo">
                <div class="box-circle-color">
                    <img src="{{ asset('img/auth/TBLogoColorCircle.png') }}" class="logo-circle" alt="Logo circulo">
                </div>
            </div>
        </div>
        <div class="aside-tbj">
            <div>
                @yield('content')
            </div>
        </div>
    </main>

    @yield('scripts')
    @livewireScripts
</body>

</html>
