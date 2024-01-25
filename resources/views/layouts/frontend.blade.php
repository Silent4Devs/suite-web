<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon_tabantaj_v2.png') }}">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css"/>-->
    <!--<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet"/>-->
    <!--<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet"/>-->
    <!--<link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet"/>-->
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dark_mode.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/yearpicker.css') }}">
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

    <link rel="stylesheet" type="text/css" href=" https://printjs-4de6.kxcdn.com/print.min.css">
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('/img/logo_policromatico.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <style type="text/css">
        .select2-selection--multiple {
            overflow: hidden !important;
            height: auto !important;
            padding: 0 5px 5px 5px !important;
        }

        .select2-container {
            margin-top: 10px !important;
        }

        /*TOASTR*/
        #toast-container>div {
            opacity: 1 !important;
        }

        .toast-success {
            /* background-color: #06b966; */
            background-color: #06a755;
        }

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
            background-color: #345183;
        }

        .azul_silent {
            background-color: #2589AA;
        }

        .iconos_cabecera {
            color: #345183;
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
            color: #345183 !important;
        }

        .btn.btn-success,
        .btn.btn-danger {
            width: 150px;
            height: 35px;
            background-color: #345183 !important;
            color: #fff !important;
            border-radius: 100px;
            border: none !important;
        }

        .btn.btn-success:hover,
        .btn.btn-danger:hover {
            color: #345183 !important;
            background-color: rgba(0, 0, 0, 0) !important;
            box-shadow: 0 0 0 1px #345183;
        }

        .btn.btn-success:hover font {
            color: #345183 !important;
            background-color: rgba(0, 0, 0, 0) !important;
        }

        .btn_cancelar {
            width: 150px;
            height: 35px;
            background-color: #aaa !important;
            color: #fff !important;
            border-radius: 100px;
            border: none !important;
            transition: 0.2s;
            display: inline-block;
            text-align: center;
            padding-top: 5px;
        }

        .btn_cancelar:hover {
            color: #888 !important;
            background-color: rgba(0, 0, 0, 0) !important;
            box-shadow: 0 0 0 1px #888;
            text-decoration: none;
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

        .buscador-global {
            position: relative;
            display: inline-block;
            width: 100%;
            border-radius: 20px;
        }

        .buscador-global:focus {
            border: 2px solid rgb(0 171 178);
            box-shadow: none;
        }


        img.rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(12px at 50% 50%);
            /* height: 37px; */
        }

        .fm-breadcrumb .breadcrumb.active-manager {
            background-color: ##34518329;
            margin: -5px 0 0 0;
        }

        .breadcrumb-item.active {
            color: #000000;
        }
    </style>
    {{-- menu tabs --}}
    <style type="text/css">
        .caja_botones_menu {
            display: flex;
        }

        .caja_botones_menu a {
            text-decoration: none;
            display: inline-block;
            color: #345183;
            padding: 5px 20px;
            border-top: 1px solid #ccc !important;
            border-right: 1px solid #ccc;
            background-color: #f9f9f9;
            margin: 0;
            text-align: center;
            align-items: center;
        }

        .caja_botones_menu a:first-child {
            border-left: 1px solid #ccc;
        }

        .caja_botones_menu a:not(.caja_botones_menu a.btn_activo) {
            border-bottom: 1px solid #ccc;
        }

        .caja_botones_menu a i {
            margin-right: 7px;
            font-size: 15pt;
        }

        .caja_botones_menu a.btn_activo,
        .caja_botones_menu a.btn_activo:hover {
            background-color: #fff;
        }

        .caja_botones_menu a:hover {
            background-color: #f1f1f1;
        }

        .caja_caja_secciones {
            width: 100%;
        }

        .caja_secciones {
            width: 100%;
            display: flex;
        }

        .caja_secciones section {
            width: 0px;
            height: 0px;
            overflow: hidden;
            transition: 0.4s;
            opacity: 0;
        }

        .caja_tab_reveldada {
            height: auto !important;
            width: 100% !important;
            overflow: none;
            opacity: 1 !important;
        }

        .seccion_div {
            overflow: hidden;
            width: 990px;
        }

        .caja_tab_reveldada .seccion_div {
            overflow: hidden;
            transition-delay: 0.5s;
            width: 100%;
        }

        /*scroll style*/

        .scroll_estilo::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        .scroll_estilo::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0);
        }

        /* Handle */
        .scroll_estilo::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 50px;
        }

        /* Handle on hover */
        .scroll_estilo::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
    {{-- Estilos Select 2 --}}
    <style>
        /* line 1, ../scss/core.scss */
        .select2-selection--multiple {
            overflow: hidden !important;
            height: auto !important;
        }

        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            vertical-align: middle;
        }

        /* line 1, ../scss/_single.scss */
        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 38px;
            user-select: none;
            -webkit-user-select: none;
        }

        /* line 12, ../scss/_single.scss */
        .select2-container .select2-selection--single .select2-selection__rendered {
            display: block;
            padding-left: 8px;
            padding-right: 20px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* line 25, ../scss/_single.scss */
        .select2-container[dir="rtl"] .select2-selection--single .select2-selection__rendered {
            padding-right: 8px;
            padding-left: 20px;
        }

        /* line 1, ../scss/_multiple.scss */

        .select2-container .select2-selection--multiple {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            user-select: none;
            -webkit-user-select: none;
        }

        /* line 12, ../scss/_multiple.scss */
        .select2-container .select2-selection--multiple .select2-selection__rendered {
            display: inline-block;
            overflow: hidden;
            padding-left: 8px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* line 21, ../scss/_multiple.scss */
        .select2-container .select2-search--inline {
            float: left;
        }

        /* line 24, ../scss/_multiple.scss */
        .select2-container .select2-search--inline .select2-search__field {
            box-sizing: border-box;
            border: none;
            font-size: 100%;
            margin-top: 3px;
            margin-left: 3px;
        }

        /* line 31, ../scss/_multiple.scss */
        .select2-container .select2-search--inline .select2-search__field::-webkit-search-cancel-button {
            -webkit-appearance: none;
        }

        /* line 1, ../scss/_dropdown.scss */
        .select2-dropdown {
            background-color: white;
            border: 1px solid #DDD;
            border-radius: 4px;
            box-sizing: border-box;
            display: block;
            position: absolute;
            left: -100000px;
            width: 100%;
            z-index: 1051;
        }

        /* line 18, ../scss/_dropdown.scss */
        .select2-results {
            display: block;
        }

        /* line 22, ../scss/_dropdown.scss */
        .select2-results__options {
            list-style: none;
            list-style-type: none !important;
            margin: 0;
            padding: 0;
        }

        /* line 28, ../scss/_dropdown.scss */
        .select2-results__option {
            padding: 6px;
            user-select: none;
            -webkit-user-select: none;
        }

        /* line 34, ../scss/_dropdown.scss */
        .select2-results__option[aria-selected] {
            cursor: pointer;
        }

        /* line 39, ../scss/_dropdown.scss */
        .select2-container--open .select2-dropdown {
            left: 0;
        }

        /* line 43, ../scss/_dropdown.scss */
        .select2-container--open .select2-dropdown--above {
            border-bottom: none;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        /* line 49, ../scss/_dropdown.scss */
        .select2-container--open .select2-dropdown--below {
            border-top: none;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        /* line 55, ../scss/_dropdown.scss */
        .select2-search--dropdown {
            display: block;
            padding: 7px;
        }

        /* line 59, ../scss/_dropdown.scss */
        .select2-search--dropdown .select2-search__field {
            padding: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        /* line 64, ../scss/_dropdown.scss */
        .select2-search--dropdown .select2-search__field::-webkit-search-cancel-button {
            -webkit-appearance: none;
        }

        /* line 69, ../scss/_dropdown.scss */
        .select2-search--dropdown.select2-search--hide {
            display: none;
        }

        /* line 15, ../scss/core.scss */
        .select2-close-mask {
            border: 0;
            margin: 0;
            padding: 0;
            display: block;
            position: fixed;
            left: 0;
            top: 0;
            min-height: 100%;
            min-width: 100%;
            height: auto;
            width: auto;
            opacity: 0;
            z-index: 99;
            background-color: #fff;
            filter: alpha(opacity=0);
        }

        /* line 1, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single {
            background-color: #f0f0f0;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 2px;
        }

        /* line 6, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single:focus {
            outline: 0;
        }

        /* line 10, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 34px;
        }

        /* line 15, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single .select2-selection__clear {
            cursor: pointer;
            float: right;
            font-weight: bold;
        }

        /* line 21, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #999;
        }

        /* line 25, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px;
        }

        /* line 35, ../scss/theme/default/_single.scss */
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #888 transparent transparent transparent;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            left: 50%;
            margin-left: -4px;
            margin-top: -2px;
            position: absolute;
            top: 50%;
            width: 0;
        }

        /* line 56, ../scss/theme/default/_single.scss */
        .select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__clear {
            float: left;
        }

        /* line 60, ../scss/theme/default/_single.scss */
        .select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__arrow {
            left: 1px;
            right: auto;
        }

        /* line 68, ../scss/theme/default/_single.scss */
        .select2-container--default.select2-container--disabled .select2-selection--single {
            background-color: #eee;
            cursor: default;
        }

        /* line 72, ../scss/theme/default/_single.scss */
        .select2-container--default.select2-container--disabled .select2-selection--single .select2-selection__clear {
            display: none;
        }

        /* line 81, ../scss/theme/default/_single.scss */
        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #888 transparent;
            border-width: 0 4px 5px 4px;
        }

        /* line 1, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple {
            background-color: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.1);
            -webkit-border-radius: 2px;
            border-radius: 2px;
            cursor: text;
            height: 22px;
        }

        /* line 7, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            box-sizing: border-box;
            list-style: none;
            list-style-type: none !important;
            padding: 0 0 0 4px !important;
            margin: 0;
            padding: 0 5px;
            width: 100%;
        }

        /* line 15, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
            color: #999;
            margin-top: 5px;
            float: left;
        }

        /* line 23, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple .select2-selection__clear {
            cursor: pointer;
            float: right;
            font-weight: bold;
            margin-top: px;
            margin-right: 2px;
        }

        /* line 31, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #ffffff;
            background-color: #4a89dc;
            // border: 1px solid #ddd;
            border-radius: 2px;
            cursor: default;
            float: left;
            margin-right: 5px;
            margin-top: 1px;
            padding: 1px 2px 2px !important;
        }

        /* line 46, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            margin-right: 2px;
        }

        /* line 55, ../scss/theme/default/_multiple.scss */
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #333;
        }

        /* line 63, ../scss/theme/default/_multiple.scss */
        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice,
        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__placeholder {
            float: right;
        }

        /* line 67, ../scss/theme/default/_multiple.scss */
        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice {
            margin-left: 5px;
            margin-right: auto;
        }

        /* line 72, ../scss/theme/default/_multiple.scss */
        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove {
            margin-left: 2px;
            margin-right: auto;
        }

        /* line 80, ../scss/theme/default/_multiple.scss */
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: 1px solid #CCC;
            outline: 0;
        }

        /* line 87, ../scss/theme/default/_multiple.scss */
        .select2-container--default.select2-container--disabled .select2-selection--multiple {
            background-color: #eee;
            cursor: default;
        }

        /* line 92, ../scss/theme/default/_multiple.scss */
        .select2-container--default.select2-container--disabled .select2-selection__choice__remove {
            display: none;
        }

        /* line 6, ../scss/theme/default/layout.scss */
        .select2-container--default.select2-container--open.select2-container--above .select2-selection--single,
        .select2-container--default.select2-container--open.select2-container--above .select2-selection--multiple {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        /* line 13, ../scss/theme/default/layout.scss */
        .select2-container--default.select2-container--open.select2-container--below .select2-selection--single,
        .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        /* line 20, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #DDD;
        }

        /* line 22, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            outline: 0;
        }

        /* line 29, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-search--inline .select2-search__field {
            background: transparent;
            border: none;
            outline: 0;
        }

        /* line 36, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results>.select2-results__options {
            max-height: 200px;
            overflow-y: auto;
            padding: 2px !important;
        }

        /* line 42, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option[role=group] {
            padding: 0;
        }

        /* line 46, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option[aria-disabled=true] {
            color: #999;
        }

        /* line 50, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #EEE;
        }

        /* line 54, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option {
            padding-left: 1em;
        }

        /* line 57, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option .select2-results__group {
            padding-left: 0;
        }

        /* line 61, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -1em;
            padding-left: 2em;
        }

        /* line 65, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -2em;
            padding-left: 3em;
        }

        /* line 69, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -3em;
            padding-left: 4em;
        }

        /* line 73, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -4em;
            padding-left: 5em;
        }

        /* line 77, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -5em;
            padding-left: 6em;
        }

        /* line 88, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #4a89dc;
            color: white;
        }

        /* line 93, ../scss/theme/default/layout.scss */
        .select2-container--default .select2-results__group {
            cursor: default;
            display: block;
            padding: 6px;
        }
    </style>

    @yield('styles')
    @livewireStyles
</head>

<body>
    @include('partials.menutenant')
    <div class=" c-wrapper">
        <header class="px-3 c-header c-header-fixed" style="border: none;">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
                <i class="fas fa-fw fa-bars iconos_cabecera"></i>
            </button>


            <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="body"
                data-class="c-sidebar-lg-show" responsive="true">
                <i id="btnMenu" class="fas fa-fw fa-bars" style=""></i>
            </button>


            <form class="form-inline col-sm-3" style="position: relative;">

                {{-- <select class="form-control mr-sm-4 searchable-field "></select> --}}
                <input class="form-control buscador-global" type="search" id="buscador_global"
                    placeholder="Buscador..." autocomplete="off" />
                <i class="fas fa-spinner fa-pulse d-none" id="buscando" style="margin-left:-45px"></i>
                <div id="resultados_sugeridos"
                    style="background-color: #fff; width:150%; position: absolute;top:50px;left:0">
                </div>
            </form>

            <ul class="ml-auto c-header-nav">
                @if (count(config('panel.available_languages', [])) > 1)
                    <li class="c-header-nav-item dropdown d-md-down-none">
                        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            {{ strtoupper(app()->getLocale()) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach (config('panel.available_languages') as $langLocale => $langName)
                                <a class="dropdown-item"
                                    href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }}
                                    ({{ $langName }})
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endif

                {{-- @livewire('campana-notificaciones-component')
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
                    </script> --}}


                <ul class="ml-auto c-header-nav">

                    <li class="c-header-nav-item dropdown show"><a class="c-header-nav-link" data-toggle="dropdown"
                            href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="c-avatar">
                                <i class="fas fa-user-circle iconos_cabecera" style="font-size: 33px;"></i>
                                {{-- @if (auth()->user()->empleado)
                                    <img class="rounded-circle" style="height: 37px;clip-path: circle(18px at 50% 50%);"
                                        src="{{ asset('storage/empleados/imagenes/' . '/' . auth()->user()->empleado->avatar) }}"
                                        alt="{{ auth()->user()->empleado->name }}">
                                @else
                                    <i class="fas fa-user-circle iconos_cabecera" style="font-size: 33px;"></i>
                                @endif --}}
                            </div>
                        </a>
                        <div class="pt-0 mt-3 text-center dropdown-menu dropdown-menu-right hide"
                            style="width:300px;">
                            <div class="p-2">
                                <i class="fas fa-user-circle iconos_cabecera" style="font-size: 33px;"></i>
                                {{-- @if (auth()->user()->empleado)
                                    <img class="shadow rounded-circle"
                                        style="height: 90px;clip-path: circle(43px at 50% 50%);"
                                        src="{{ asset('storage/empleados/imagenes/' . '/' . auth()->user()->empleado->avatar) }}"
                                        alt="" srcset="">
                                @else
                                    <i class="fas fa-user-circle iconos_cabecera" style="font-size: 33px;"></i>
                                @endif --}}
                            </div>
                            <div>
                                {{-- @if (auth()->user()->empleado)
                                        <p class="m-0" style="font-weight: 600">
                                            {{ auth()->user()->empleado->name }}
                                        </p>
                                        @foreach (auth()->user()->roles as $rol)
                                            <span class="badge badge-dark"
                                                style="font-size:13px;">{{ $rol->title }}</span>
                                        @endforeach

                                    @else
                                        {{ auth()->user()->name }}
                                        <span>{{ auth()->user()->empleado->name }}</span>
                                    @endif --}}
                            </div>
                            {{-- <div class="py-2 dropdown-header bg-light"><strong>Ajustes</strong></div> --}}
                            <div class="px-3 mt-3 d-flex justify-content-between">
                                @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                                    @can('profile_password_edit')
                                        <a class="btn btn-sm shadow-xs border p-2 rounded {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                                            href="{{ route('profile.password.edit') }}">
                                            <i class="mr-1 fas fa-user-cog">
                                            </i>
                                            Conf. Perfil
                                        </a>
                                    @endcan
                                @endif
                                <a class="p-2 border rounded shadow-xs btn btn-sm" href="#">
                                    <i class="mr-1 fas fa-fw fa-lock">
                                    </i> Bloquear
                                </a>
                                <a class="p-2 border rounded shadow-xs btn btn-sm"
                                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                    <i class="mr-1 fas fa-sign-out-alt">
                                    </i> Salir
                                </a>
                            </div>
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

</body>

<script src="{{ asset('js/app.js') }}"></script>

<script src="https://unpkg.com/@coreui/coreui@3.4.0/dist/js/coreui.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
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
<script src="{{ asset('js/buttons.print.js') }}"></script>
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
<script src="{{ asset('js/yearpicker.js') }}"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>

<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

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
            scrollTop: $(".c-active").offset()?.top - 350
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-livewire-alert::scripts />
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
        let url = "{{ route('admin.globalStructureSearch') }}";
        $("#buscador_global").click(function(e) {
            e.preventDefault();
            let sugeridos = document.querySelector(
                "#resultados_sugeridos");
            sugeridos.innerHTML = "";
            this.value = "";
            $("#buscando").removeClass('d-block');
            $("#buscando").addClass('d-none');
        });
        $("#buscador_global").keyup(function() {
            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    term: $(this).val().toLowerCase()
                },
                beforeSend: function() {
                    $("#buscando").removeClass('d-none');
                    $("#buscando").addClass('d-block');
                },
                success: function(data) {
                    if (data.length == undefined) {
                        let filtro = "<ul class='list-group'>";
                        for (const [key, value] of Object.entries(data)) {
                            filtro += `
                                <a class="list-group-item list-group-item-action" href="${value}">
                                    <i class="mr-2 fas fa-search-location"></i>${key}
                                </a>
                            `;
                        }
                        filtro += "</ul>";
                        $("#buscando").removeClass('d-block');
                        $("#buscando").addClass('d-none');
                        // $("#resultados_sugeridos").show();
                        let sugeridos = document.querySelector(
                            "#resultados_sugeridos");
                        sugeridos.innerHTML = filtro;
                    } else if (data.length == 0) {
                        $("#buscando").removeClass('d-block');
                        $("#buscando").addClass('d-none');
                        let sugeridos = document.querySelector(
                            "#resultados_sugeridos");
                        sugeridos.innerHTML =
                            `<ul class='list-group'><li class="list-group-item">
                                    <i class="mr-2 fas fa-times-circle"></i>Sin resultados encontrados...
                                    </li>
                                </ul>`;
                    } else {
                        $("#buscando").removeClass('d-block');
                        $("#buscando").addClass('d-none');
                        let sugeridos = document.querySelector(
                            "#resultados_sugeridos");
                        sugeridos.innerHTML = "";
                    }

                    // $("#participantes_search").css("background", "#FFF");
                }
            });
        });
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
                markup += "<div class='searchable-field'>" + item.fields_formated[field] +
                    " : " +
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
</script>


@yield('scripts')

{{ \TawkTo::widgetCode('https://tawk.to/chat/5fa08d15520b4b7986a0a19b/default') }}


</html>
