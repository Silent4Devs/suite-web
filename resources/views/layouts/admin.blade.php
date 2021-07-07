<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ trans('panel.site_title') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet"/>-->
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css"
          rel="tylesheet"/>-->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/Silent4Business-Logo-Color.png') }}">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css"/>-->
    <!--<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"/>-->
    <!--<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet"/>-->
    <!--<link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet"/>-->
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dark_mode.css') }}">
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
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style type="text/css">
        /* DATATABLE */
        .datatable-fix table.dataTable thead .sorting:after {
            opacity: 0.5;
            content: "\f0dc";
            font-family: "Font Awesome 5 Free";
        }

        .datatable-fix table.dataTable thead .sorting_asc:after {
            opacity: 0.5;
            content: "\f0de";
            font-family: "Font Awesome 5 Free";
        }

        .datatable-fix table.dataTable thead .sorting_desc:after {
            opacity: 0.5;
            content: "\f0dd";
            font-family: "Font Awesome 5 Free";
        }

        table.dataTable {
            border-collapse: collapse !important;
        }

        /*body::before {
            content: "";
            position: fixed;
            background: url({{ asset('img/auth-bg2.jpg') }});
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: -1;
            filter: grayscale(100%) brightness(230%);
            opacity: 0.2;
        }*/
        .btn-read {
            display: inline-block;
            cursor: pointer;
            transition: .2s ease-out;
            padding: 1px 4px;
            border-radius: 5px;
        }

        .btn-read:hover {
            color: rgb(47, 231, 1);
            transform: scale(1.2);
            transition: .2s ease-in;
        }

        .iconos-crear {
            font-size: 15pt;
            color: #00a57e;
            margin-right: 10px;
        }

        .verde_silent {
            background-color: #0CA193;
        }

        .azul_silent {
            background-color: #2589AA;
        }

        .iconos_cabecera {
            color: #00abb2;
            font-size: 1.2rem;
        }


        body,
        .iconos_cabecera {
            transition: 0s;
        }

        body {
            background-color: #F2F4F6;
        }

        #btnDark {
            cursor: pointer;
        }

        .iconos_cabecera:active {
            transform: scale(0.8);
            transition: 0.06s;
            opacity: 0.7;
        }

        .flex-column {
            background: rgba(0, 0, 0, 0);
        }

        header {
            box-shadow: 6px 0px 6px 1px rgba(0, 0, 0, 0.5);
            z-index: 6;
        }



        .glyphicon-ok::before {
            content: "\f00c";
        }

        .glyphicon-remove::before {
            content: "\f00d";
        }

        .glyphicon {
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-style: normal;
        }


        .card.vrd-agua {
            border-radius: 100px !important;
            overflow: hidden;
        }


        .card {
            border: none !important;
            box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.12);
        }

        .card-body.align-self-center {
            margin-top: -65px !important;

            background-color: rgba(0, 0, 0, 0) !important;
            box-shadow: none !important;
            border-radius: 0 !important;

        }

        .card-body.align-self-center h3,
        .card-body.align-self-center h3 i {
            color: #008186 !important;
        }




        .btn.btn-success {
            width: 150px;
            height: 35px;
            background-color: #00abb2 !important;
            color: #fff !important;
            border-radius: 100px;
            border: none !important;
        }

        .btn:hover.btn-success {
            color: #00abb2 !important;
            background-color: rgba(0, 0, 0, 0) !important;
            box-shadow: 0 0 0 1px #00abb2;
        }

        .btn:hover.btn-success font {
            color: #00abb2 !important;
            background-color: rgba(0, 0, 0, 0) !important;
        }







        ol.breadcrumb {
            background-color: rgba(0, 0, 0, 0);
            top: 50px;
            margin-left: -20px;
            margin-top: -40px;
            margin-bottom: 60px;
            border: none;
            opacity: 0.6;
        }

        ol.breadcrumb:hover {
            opacity: 1;
        }

        .c-header.c-header-fixed {
            z-index: 10 !important;
        }



        .c-sidebar-backdrop {
            z-index: 9 !important;
        }

    </style>
    @yield('styles')
    @livewireStyles
</head>

<body class="">
    @include('partials.menu')
    <div class="c-wrapper">
        <header class="px-3 c-header c-header-fixed" style="border: none;">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
                <i class="fas fa-fw fa-bars iconos_cabecera"></i>
            </button>


            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="body"
                data-class="c-sidebar-lg-show" responsive="true">
                <i id="btnMenu" class="fas fa-fw fa-bars" style=""></i>
            </button>


            <form class="form-inline">

                <select class="form-control mr-sm-2 searchable-field ">

                </select>
            </form>

            <ul class="ml-auto c-header-nav">
                @if (count(config('panel.available_languages', [])) > 1)
                    <li class="c-header-nav-item dropdown d-md-down-none">
                        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            {{ strtoupper(app()->getLocale()) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach (config('panel.available_languages') as $langLocale => $langName)
                                <a class="dropdown-item"
                                    href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }}
                                    ({{ $langName }})</a>
                            @endforeach
                        </div>
                    </li>
                @endif

                @livewire('campana-notificaciones-component')
                @livewire('tareas-notificaciones-component')
                <ul class="ml-auto c-header-nav">
                    <li class="px-2 c-header-nav-item c-d-legacy-none">
                        <div id="btnDark">
                            <i class="fas fa-moon iconos_cabecera"></i>
                            </i>

                        </div>
                    </li>
                </ul>
                <script>
                    const btnDark = document.querySelector('#btnDark');

                    btnDark.addEventListener('click', () => {
                        document.body.classList.toggle('c-dark-theme');

                        if (document.body.classList.contains('c-dark-theme')) {
                            localStorage.setItem('dark-mode', 'true');
                        } else {
                            localStorage.setItem('dark-mode', 'false');
                        }
                    });

                    if (localStorage.getItem('dark-mode') === 'true') {
                        document.body.classList.add('c-dark-theme');
                    } else {
                        document.body.classList.remove('c-dark-theme');
                    }
                </script>


                <ul class="ml-auto c-header-nav">

                    <li class="c-header-nav-item dropdown show"><a class="c-header-nav-link" data-toggle="dropdown"
                            href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="c-avatar"><i class="fas fa-user-circle iconos_cabecera"
                                    style="font-size: 33px;"></i></div>
                        </a>
                        <div class="pt-0 dropdown-menu dropdown-menu-right hide">

                            <div class="py-2 dropdown-header bg-light"><strong>Ajustes</strong></div>
                            @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                                @can('profile_password_edit')

                                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                                        href="{{ route('profile.password.edit') }}">
                                        <i class="fas fa-user-circle c-sidebar-nav-icon">
                                        </i>
                                        Perfil
                                    </a>

                                @endcan
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-fw fa-lock c-sidebar-nav-icon">
                                </i> Bloquear</a>
                            <a class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                <i class="fas fa-fw fa-sign-out-alt c-sidebar-nav-icon">
                                </i> Cerrar sesión</a>
                        </div>
                    </li>

                </ul>
            </ul>
        </header>

        <div class="c-body">
            <main class="c-main">


                <div class="container-fluid" id="app">
                    @if (session('message'))
                        <div class="mb-2 row">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                            </div>
                        </div>
                    @endif
                    @if ($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('content')

                </div>


            </main>
            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        <!-- incluir de footer -->
        {{-- @include('partials.footer') --}}
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.4.0/dist/js/coreui.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    </script>
    <script src="{{ asset('push/bin/push.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js">
    </script> --}}
    {{-- <script src="https://unpkg.com/@coreui/coreui@3.2/dist/js/coreui.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"
        defer></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js">
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>

    <script>
        window.Laravel = {!! json_encode([
    'user' => auth()->check() ? auth()->user()->id : null,
]) !!};
    </script>


    <script src="{{ asset('js/main.js') }}"></script>

    <!-- x editable -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('.c-sidebar-nav').animate({
                scrollTop: $(".c-active").offset().top - 350
            }, 0);
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/vue@v0.3.x/dist/livewire-vue.js"></script>
    <!-- x-editable -->
    <script>
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
                select: {
                    style: 'multi+shift',
                    selector: 'td:first-child'
                },
                order: [],
                scrollX: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, 50, 100, -1],
                    [5, 10, 20, 50, 100, "Todos"]
                ],
                //dom: 'lBfrtip<"actions">',
                dom: "<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
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
    <script>
        $(document).ready(function() {
            $('.searchable-field').select2({
                minimumInputLength: 3,
                ajax: {
                    url: '{{ route('admin.globalSearch') }}',
                    dataType: 'json',
                    type: 'GET',
                    delay: 200,
                    data: function(term) {
                        return {
                            search: term
                        };
                    },
                    results: function(data) {
                        return {
                            data
                        };
                    }
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                templateResult: formatItem,
                templateSelection: formatItemSelection,
                placeholder: '{{ trans('global.search') }}...',
                language: {
                    inputTooShort: function(args) {
                        var remainingChars = args.minimum - args.input.length;
                        var translation = '{{ trans('global.search_input_too_short') }}';

                        return translation.replace(':count', remainingChars);
                    },
                    errorLoading: function() {
                        return '{{ trans('global.results_could_not_be_loaded') }}';
                    },
                    searching: function() {
                        return '{{ trans('global.searching') }}';
                    },
                    noResults: function() {
                        return '{{ trans('global.no_results') }}';
                    },
                }

            });

            function formatItem(item) {
                if (item.loading) {
                    return '{{ trans('global.searching') }}...';
                }
                var markup = "<div class='searchable-link' href='" + item.url + "'>";
                markup += "<div class='searchable-title'>" + item.model + "</div>";
                $.each(item.fields, function(key, field) {
                    markup += "<div class='searchable-fields'>" + item.fields_formated[field] + " : " +
                        item[field] + "</div>";
                });
                markup += "</div>";

                return markup;
            }

            function formatItemSelection(item) {
                if (!item.model) {
                    return '{{ trans('global.search') }}...';
                }
                return item.model;
            }

            $(document).delegate('.searchable-link', 'click', function() {
                var url = $(this).attr('href');
                window.location = url;
            });
        });
    </script>

    @yield('scripts')


</body>

</html>
