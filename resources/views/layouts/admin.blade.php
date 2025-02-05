<!DOCTYPE html>
<html lang="esp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trans('panel.site_title') }}</title>

    <!-- Principal Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/loader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/yearpicker.css') }}">

    @vite(['public/css/app.css' . config('app.cssVersion')])
    @vite(['public/css/global/style.css' . config('app.cssVersion')])
    @vite(['public/css/global/admin.css' . config('app.cssVersion')])
    @vite(['public/css/rds.css' . config('app.cssVersion')])
    {{-- @vite(['public/css/global/darkMode.css']) --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/global/responsive.css') }}{{ config('app.cssVersion') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/global/darkMode.css') }}{{ config('app.cssVersion') }}"> --}}
    @yield('css')
    @yield('styles')
    <!-- End Principal Styles -->

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://storage.googleapis.com/non-spec-apps/mio-icons/latest/outline.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,300,0,0" />
    <!-- End Fonts -->

    <!-- Extra Styles -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <!-- x-editable -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/jquery-editable/jquery-ui-datepicker/css/redmond/jquery-ui-1.10.3.custom.min.css"
        integrity="sha512-4E8WH1J08+TC3LLRtjJdA8OlggQvj5LN+TciGGwJWaQtFXj0BoZPKT9gIHol283GiUfpKPVk54LJfur5jfiRxA=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css"
        integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"
        integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/plugins/monthSelect/style.min.css"
        integrity="sha512-V7B1IY1DE/QzU/pIChM690dnl44vAMXBidRNgpw0mD+hhgcgbxHAycRpOCoLQVayXGyrbC+HdAONVsF+4DgrZA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- End Extra Styles -->

    @livewireStyles

    {{-- Laravel vite --}}
    @vite(['resources/sass/app.scss'])
    @vite(['resources/js/app.js'])

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon_tabantaj_v2.png') }}">
    {{-- library mathjs --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.4.0/math.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

</head>
<style>
    .toast {
        background-color: #28a745 !important;
        /* Verde bootstrap */
        /* Azul */
        color: #ffffff !important;
        /* Texto blanco */
    }

    .toast .toast-close-button {
        color: #ffffff !important;
    }
</style>

<body class="menu-global-position-bottom">
    <div id="loading">
        <img id="loading-image" src="https://i.pinimg.com/originals/07/24/88/0724884440e8ddd0896ff557b75a222a.gif"
            alt="Loading...">
    </div>
    @php

        use App\Models\Organizacion;
        use App\Models\User;
        use App\Models\Empleado;
        $databaseName = \DB::connection()->getDatabaseName();
        $usuario = Auth::user();
        $empleado = Empleado::getMyEmpleadodata($usuario->empleado_id);
        $organizacion = Organizacion::getLogo();
        if (!is_null($organizacion)) {
            $logotipo = $organizacion->logotipo;
        } else {
            $logotipo = 'logotipo-tabantaj.png';
        }

        $hoy_format_global = \Carbon\Carbon::now()->format('d/m/Y');
    @endphp

    <div class="patrials-global">
        @include('partials.header')

        @include('partials.menu-slider')

        @include('partials.custom-design')
    </div>

    {{-- @include('partials.menu') --}}

    <div class="c-wrapper" id="contenido_body_general_wrapper">
        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid" id="app">

                    @if (session('message'))
                        <div class="mb-2 row">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                            </div>
                        </div>
                </div>
                @endif
                <div id="errores_generales_admin_quitar_recursos">
                    @if ($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                @yield('content')
            </main>
        </div>
    </div>
    <form id="logoutform" action="{{ route('logout.leave') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <!-- incluir de footer -->

    <div id="elementos_imprimir" class="d-none">
        <div id="contenido_imprimir">

        </div>
    </div>

    <div id="tabla_imprimir_global" class="d-none">
        <div id="contenido_imprimir">
            <table class="encabezado-print">
                <tr>
                    <td style="width: 25%;">
                        <img src="{{ asset($logotipo) }}" class="img_logo" style="height: 70px;">
                    </td>
                    <td style="width: 50%;">
                        <h4><strong>{{ !is_null($organizacion) ? $organizacion->empresa : 'Tabantaj' }}</strong></h4>
                        <div id="titulo_tabla"></div>
                    </td>
                    <td style="width: 25%;" class="encabezado_print_td_no_paginas">
                        Fecha: {{ $hoy_format_global }} <br>
                    </td>
                </tr>
            </table>

            <table class="table mt-3 w-100" id="tabla_blanca_imprimir_global">

            </table>
        </div>
    </div>

    <div class="barra-herramientas-bottom-molbile">
        <a href="{{ route('admin.inicio-Usuario.index') }}#datos" class="btn-barra-bottom-mobile"
            {{ request()->is('admin/inicioUsuario') || request()->is('admin/inicioUsuario/*') || request()->is('admin/competencias/*/cv') ? 'style=color:#3086AF !important;"' : '' }}>
            <i class="bi bi-file-person"></i>
            <p>Perfil</p>
        </a>
        <a href="{{ route('admin.timesheet-create') }}" class="btn-barra-bottom-mobile"
            {{ request()->is('admin/timesheet') || request()->is('admin/timesheet/*') ? 'style=color:#3086AF !important;"' : '' }}>
            <i class="bi bi-calendar3-range"></i>
            <p>Timesheet</p>
        </a>
        <a href="{{ route('admin.systemCalendar') }}" class="btn-barra-bottom-mobile"
            {{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'style=color:#3086AF !important;"' : '' }}>
            <i class="bi bi-calendar3"></i>
            <p>Calendario</p>
        </a>
        <a href="{{ route('admin.portal-comunicacion.index') }}" class="btn-barra-bottom-mobile"
            {{ request()->is('admin/portal-comunicacion') || request()->is('admin/portal-comunicacion/*') ? 'style=color:#3086AF !important;"' : '' }}>
            <i class="bi bi-newspaper"></i>
            <p>Comunicación</p>
        </a>
    </div>

    <div class="box-chat">
        <livewire:asistente />
    </div>

    <!-- inicia sección de script -->
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    {{-- Librerías para visualizar en campo el dolar --}}
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- Notificaciones push desktop --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/push.min.js"
        integrity="sha512-DjIQO7OxE8rKQrBLpVCk60Zu0mcFfNx2nVduB96yk5HS/poYZAkYu5fxpwXj3iet91Ezqq2TNN6cJh9Y5NtfWg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script async>
        window.onload = function() {
            // Check if the browser supports notifications
            if (!("Notification" in window)) {
                console.error("This browser does not support desktop notifications.");
            }
        };
    </script>
    {{-- Notificaciones push desktop --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')
    @livewireScripts
    <x-livewire-alert::scripts />

    <script defer src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- js para validaciones globales -->
    <!--<script src="{{ asset('js/validations.js') }}"></script>-->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
    <script src="https://unpkg.com/@coreui/coreui@3.4.0/dist/js/coreui.bundle.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"
        defer></script> {{-- quitar script en el glosario --}}
    <script src="{{ asset('js/buttons.print.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script defer src="{{ asset('js/yearpicker.js') }}"></script>
    {{-- <script src="https://cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script> --}}
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    {{-- <script defer src="//unpkg.com/alpinejs" defer></script> --}}
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- x editable -->
    <script defer src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <!-- termina sección de script -->


    <script async>
        document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                    "body").style.visibility = "hidden";
                document.querySelector(
                    "#loading").style.visibility = "visible";
            } else {
                document.querySelector(
                    "#loading").style.display = "none";
                document.querySelector(
                    "body").style.visibility = "visible";
            }
        };
    </script>
    <script defer>
        function imprimirElemento(elemento) {
            let elemento_seleccionado = document.getElementById(elemento);
            let contenido_imprimir = document.getElementById('contenido_imprimir').innerHTML = elemento_seleccionado
                .innerHTML;
            document.querySelector('#elementos_imprimir').classList.remove('d-none');

            document.querySelector('#contenido_body_general_wrapper').classList.add('vista_print');
            document.querySelector('.patrials-global').classList.add('vista_print');
            document.querySelector('.box-chat').classList.add('vista_print');
            document.querySelector('.barra-herramientas-bottom-molbile').classList.add('vista_print');
            print();
            document.querySelector('#elementos_imprimir').classList.add('d-none');
            document.querySelector('#contenido_body_general_wrapper').classList.remove('vista_print');
            document.querySelector('.patrials-global').classList.remove('vista_print');
            document.querySelector('.box-chat').classList.remove('vista_print');
            document.querySelector('.barra-herramientas-bottom-molbile').classList.remove('vista_print');
        }

        function imprimirTabla(elemento, html = `
                    <h5>
                        <strong>
                            Registros
                        </strong>
                        <font style="font-weight: lighter;">

                        </font>
                    </h5>
                `) {
            let elemento_seleccionado = document.getElementById(elemento);
            document.getElementById('tabla_blanca_imprimir_global').innerHTML = elemento_seleccionado.innerHTML;
            document.getElementById('titulo_tabla').innerHTML = html;

            document.querySelector('#tabla_imprimir_global').classList.remove('d-none');

            document.querySelector('#contenido_body_general_wrapper').classList.add('vista_print');
            document.querySelector('.patrials-global').classList.add('vista_print');
            document.querySelector('.box-chat').classList.add('vista_print');
            document.querySelector('.barra-herramientas-bottom-molbile').classList.add('vista_print');
            print();
            document.querySelector('#elementos_imprimir').classList.add('d-none');
            document.querySelector('#contenido_body_general_wrapper').classList.remove('vista_print');
            document.querySelector('.patrials-global').classList.remove('vista_print');
            document.querySelector('.box-chat').classList.remove('vista_print');
            document.querySelector('.barra-herramientas-bottom-molbile').classList.remove('vista_print');
        }
    </script>

    {{-- daterangepicker --}}
    <script defer>
        @if ($usuario->empleado)
            window.NotificationUser = {!! json_encode(['user' => auth()->check() ? $usuario->empleado->id : null]) !!};
        @else
            window.NotificationUser = 1
        @endif
    </script>

    <script>
        $(document).ready(function() {
            $('.c-sidebar-nav').animate({
                scrollTop: $(".c-active").offset()?.top - 350
            }, 0);
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(".btn_bajar_scroll").click(function() {
            $("lemnt_row_menu").fadeIn(0);
            $('.c-sidebar-nav').delay(1000).scrollTop(900);
        });
    </script>

    <script defer>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>

    <!-- x-editable -->
    <script defer>
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.ajaxOptions = {
            type: 'PUT'
        };

        @yield('x-editable')
    </script>
    <!-- x-editable -->


    <script>
        $(function() {
            let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
            let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
            let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
            let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
            let printButtonTrans = '{{ trans('global.datatables.print') }}'
            let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
            let selectAllButtonTrans = '{{ trans('global.select_all') }}'
            let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

            let languages = {
                //'es': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                'es': {
                    decimal: "",
                    emptyTable: "No hay registros",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 to 0 of 0 registros",
                    infoFiltered: "(Filtrado de _MAX_ total registros)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "Mostrar _MENU_ registros",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "Sin resultados encontrados",
                    paginate: {
                        first: "Primero",
                        last: "Ultimo",
                        next: "Siguiente",
                        previous: "Anterior",
                    },
                },
            };

            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
                className: 'btn'
            })
            $.extend(true, $.fn.dataTable.defaults, {
                // language: {
                //     url: languages['{{ app()->getLocale() }}']
                // },
                language: {
                    decimal: "",
                    emptyTable: "No hay registros",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 to 0 of 0 registros",
                    infoFiltered: "(Filtrado de _MAX_ total registros)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "Mostrar _MENU_ registros",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "Sin resultados encontrados",
                    paginate: {
                        first: "Primero",
                        last: "Ultimo",
                        next: '<i class="fas fa-chevron-right"></i>',
                        previous: '<i class="fas fa-chevron-left"></i>',
                    },
                },
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }, {
                    orderable: false,
                    searchable: false,
                    targets: -1
                }],
                // select: {
                //     style: 'multi+shift',
                //     selector: 'td:first-child'
                // },
                order: [],
                scrollX: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, 50, 100, -1],
                    [5, 10, 20, 50, 100, "Todos"]
                ],
                //dom: 'lBfrtip<"actions">',
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12 p-0'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
                buttons: [{
                        extend: 'selectAll',
                        className: 'btn-primary',
                        text: selectAllButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        },
                        action: function(e, dt) {
                            e.preventDefault()
                            dt.rows().deselect();
                            dt.rows({
                                search: 'applied'
                            }).select();
                        }
                    },
                    {
                        extend: 'selectNone',
                        className: 'btn-primary',
                        text: selectNoneButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'copy',
                        className: 'btn-default',
                        text: copyButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-default',
                        text: csvButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-default',
                        text: excelButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-default',
                        text: pdfButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-default',
                        text: printButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        className: 'btn-default',
                        text: colvisButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });

            $.fn.dataTable.ext.classes.sPageButton = '';
        });
    </script>

    {{-- responsive --}}
    <script type="text/javascript">
        $(document).ready(function() {
            if ($(window).width() <= 800) {
                $('body').addClass('body-responsive-mobile');
            }
        });
        $(window).resize(function() {
            if ($(window).width() <= 800) {
                $('body').addClass('body-responsive-mobile');
            } else {
                $('body').removeClass('body-responsive-mobile');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".notifications-menu").on('click', function() {
                if (!$(this).hasClass('open')) {
                    $('.notifications-menu .label-warning').hide();
                    $.get('/admin/user-alerts/read');
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(".caja_botones_menu a").click(function() {
            $(".caja_botones_menu a").removeClass("btn_activo");
            $(".caja_botones_menu a:hover").addClass("btn_activo");
        });
    </script>

    {{-- menus tabs --}}
    <script type="text/javascript">
        $(".caja_botones_menu a").click(function() {
            $(".caja_botones_menu a").removeClass("btn_activo");
            $(".caja_botones_menu a:hover").addClass("btn_activo");
        });
    </script>

    <script type="text/javascript">
        $(".caja_botones_menu a").click(function() {
            $("section").removeClass("caja_tab_reveldada");
            var id_seccion = $(".caja_botones_menu a:hover").attr('data-tabs');
            $(document.getElementById(id_seccion)).addClass("caja_tab_reveldada");
        });
        $('.modal').on('shown.bs.modal', function(event) {
            let modalBackDrop = document.querySelector('.modal-backdrop');
            if (modalBackDrop) {
                modalBackDrop.style.width = "100%";
                modalBackDrop.style.height = "100%"
            }
        })
    </script>

    <script>
        $('.li-click-list-header').click(function() {
            $('.li-click-list-header:hover').toggleClass('active-ul-header');
        });
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    @yield('scripts')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery-idletimer/1.0.0/idle-timer.min.js"
        integrity="sha512-hh4Bnn1GtJOoCXufO1cvrBF6BzRWBp7rFiQCEdSRwwxJVdCIlrp6AWeD8GJVbnLO9V1XovnJSylI5/tZGOzVAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(".animated-over .form-control").change(function(e) {
            console.log(e.target);
            if (e.target.value == "") {
                $(e.target).removeClass("input-content-animated");
            } else {
                $(e.target).addClass("input-content-animated");
            }
        });
    </script>

    <script>
        function menuHeader() {
            document.querySelector('header').classList.toggle('mostrar-menu');
            document.querySelector('.btn-menu-header').classList.toggle('active');
            document.querySelector('.bg-black-header-menu').classList.toggle('active');
        }
    </script>

    <script defer>
        var inputs = document.querySelectorAll('input[type="text"]');
        var inputTextarea = document.querySelectorAll('textarea');
        // Agregar un event listener a cada elemento input
        inputs.forEach(function(input) {
            validate(input, 250);
        });
        inputTextarea.forEach(function(input) {
            validate(input, 490);
        });

        function validate(input, caracteres) {
            var nuevoSpan = document.createElement('span');
            nuevoSpan.textContent = '¡Estas a punto de llegar a los ' + caracteres + ' caracteres!';
            nuevoSpan.style.color = 'red';
            input.addEventListener('input', function() {
                // Acciones a realizar cuando se ingresa texto en un input
                console.log('Se ingresó texto en el input con ID:', input.id);
                if (input.value.length > caracteres) {
                    nuevoSpan.style.display = 'block';
                    if (input.nextSibling) {
                        console.log('si hay un elemento despues', input.nextElementSibling);
                        var elemento = input.nextElementSibling;
                        elemento.parentNode.insertBefore(nuevoSpan, elemento.nextSibling);
                    } else {
                        console.log('no hay elemento');
                        input.parentNode.insertBefore(nuevoSpan, input.nextSibling);
                    }

                } else {
                    nuevoSpan.style.display = 'none';
                }
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let lineActiveNav = document.createElement('div');
            lineActiveNav.classList.add('line-active-nav');

            document.querySelectorAll('.nav-tabs').forEach(element => {
                element.appendChild(lineActiveNav);
            });
        });
        $('.nav-link').click(function moveLineNav(e) {
            let boundLink = e.target.getBoundingClientRect();
            let boundNav = document.querySelector('.nav.nav-tabs:hover').getBoundingClientRect();

            let offsetTop = boundLink.top - boundNav.top + boundLink.height - 10;
            let offsetLeft = boundLink.left - boundNav.left;

            let line = document.querySelector('.nav-tabs:hover .line-active-nav');

            line.style.top = offsetTop + 'px';
            line.style.left = offsetLeft + 25 + 'px';
            line.style.width = boundLink.width - 50 + 'px';
        });
    </script>

    <script>
        function handleSwitchChange(event) {
            const isChecked = event.target.checked;
            let cambiar = isChecked ? 1 : 2;

            $.ajax({
                url: '{{ route('admin.estado-disponibilidad') }}',
                type: 'POST', // Change the request method to POST
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    cambiar: cambiar
                },
                success: function(response) {
                    // Handle success response
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: "Se ha cambiado su estado de disponibilidad con éxito.",
                        showConfirmButton: false,
                        timer: 1500,
                        onClose: function() {
                            // Reload the page after the alert disappears
                            window.location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }

            });
        }
    </script>
</body>

</html>
