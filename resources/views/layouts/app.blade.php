<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

<<<<<<< HEAD
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/auth/TBIconTabantaj.png') }}">

    <link rel="stylesheet" href="{{ asset('css/auth/TBlogin.css') }}">

=======
>>>>>>> f6b1792f7727ae93475b72414f9ea514b37ad056
    <title>{{ trans('panel.site_title') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/Silent4Business-Logo-Color.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon_tabantaj_v2.png') }}">
    @yield('styles')
    @livewireStyles
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('/img/logo_policromatico.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <style>
        html {
            height: 100%;
        }

        body {
            min-height: 100%;
        }
    </style>
</head>

<<<<<<< HEAD
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
=======


<body id="layout-app-body">
    <div class="flex-row align-items-center" style="height: 100vh">
        <div class="container-fluid" style="height: 100vh">
            @yield('content')
        </div>
    </div>
>>>>>>> f6b1792f7727ae93475b72414f9ea514b37ad056
    @yield('scripts')
    @livewireScripts

</body>

</html>
