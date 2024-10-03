@extends('layouts.admin')
@section('content')
    <style>
        html {
            scroll-behavior: smooth;

        }

        .caja_graficas,
        .caja_table {
            margin: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.12);
        }

        .caja_graficas h5,
        .caja_table h5 {
            width: 100%;
            height: 40px;
            color: #fff;
            box-shadow: 0px 3px 5px 1px #888;
            margin-bottom: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 7px;
        }

        .caja_graficas a {
            width: 150px;
            height: 30px;
            background: #459e9e;
            margin-top: 30px;
            border-radius: 6px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-decoration: none;
            opacity: 0.8;
            transition: 0.1s;
            margin-left: calc(100% - 150px);
            box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.3);
        }


        .caja_graficas a:hover {
            opacity: 1;
            box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.2);
        }


        .especificaciones .iconos_espec {
            font-size: 15pt;
        }

        .especificaciones label {
            font-size: 12pt;
            margin-left: 20px;
            color: #888;
        }

        .espec {
            background-color: #A13D86;
        }

        .plan {
            background-color: #3D72A1;
        }

        .check {
            background-color: #DBA82D;
        }

        .act {
            background-color: #2DB7DB;
        }

        .card_info {
            position: relative;
            padding: 0;
            margin: 10px;
            box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.12);
            height: 100px;
        }

        .card_info div {
            position: absolute;
            top: 15px;
            left: 20px;
            width: 70px;
            height: 70px;
            border-radius: 100px;
            background-color: rgba(255, 255, 255, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card_info i {
            font-size: 25pt;
            color: #fff;
        }

        .card_info h6 {
            position: absolute;
            font-size: 16pt;
            color: #fff;
            top: 20px;
            left: 120px;
            font-weight: bolder;
        }

        .card_info span {
            position: absolute;
            color: #fff;
            font-size: 10pt;
            top: 50px;
            left: 120px;
        }


        body.c-dark-theme .caja_graficas h5 {
            box-shadow: 0px 3px 7px -1px rgba(0, 0, 0, 0.3);
        }



        .menu_a {
            width: 100%;
            background-color: var(--color-tbj);
            height: 40px;
            position: sticky;
            top: 56px;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            transition: 0.1s;
            border-bottom-right-radius: 6px;
            border-bottom-left-radius: 6px;
        }



        .menu_a a,
        .menu_a button {
            outline: inherit;
            box-shadow: none;
            border: none;
            width: 200px;
            height: 30px;
            background-color: #fff;
            margin: 10px;
            color: #fff;
            font-size: 15pt;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            transition: 0.1s;
        }

        .menu_a a:hover,
        .menu_a button:hover {
            text-decoration: none;
            background-color: rgba(0, 0, 0, 0.2);
        }

        section:target {
            padding-top: 100px;
            margin-top: -100px;
        }



        @media(max-width: 1131px) {
            .caja_graficas {
                width: calc(50% - 20px) !important;
            }
        }

        @media(max-width: 780px) {
            .caja_graficas {
                width: 100% !important;
            }
        }

        @media(max-width: 600px) {
            .especificaciones {
                margin-top: 60px;
            }
        }

        .breadcrumb {
            margin-bottom: 0 !important;
        }
    </style>

    <div class="content">
        {{ Breadcrumbs::render('dashboard-iso27001') }}
        <div class="menu_a">
            <a href="#iso27001">ISO 27001</a>
            <a href="#capacitaciones">Capacitaciones</a>

            <button
                onclick="printJS({
                            printable: 'impreso_row',
                            type: 'html',
                            css: 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
                            css: '{{ asset('css/dashboard/printDashboard.css') }}',
                            })">
                <i class="mr-2 fas fa-print"></i>
                Imprimir
            </button>
        </div>

        <div id="impreso_row">
            <section id="iso27001">
                @include('home_dash_iso27001')

                <section id="capacitaciones" class="mt-5">
                    @include('home_dash_capacitaciones')
                </section>
        </div>
    </div>
    <!--col-->
@endsection
