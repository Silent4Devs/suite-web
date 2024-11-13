@extends('layouts.admin')
@section('content')
    <style>
        .titulo-card {
            /* UI Properties */
            text-align: left;
            font: 16px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }

        .texto-card {
            text-align: left;
            font: 12px Segoe UI;
            letter-spacing: 0px;
            color: #FFFFFF;
            opacity: 1;
            margin-right: 30px;
            margin-left: 20px:
        }

        .titulo {
            text-align: left;
            font: normal normal 600 24px Segoe UI;
            letter-spacing: 0px;
            color: #2567AE;
            opacity: 1;
            margin-left: 5px;
            margin-bottom: 12px;
        }

        .card-t.card {
            background-color: #3B7EB2;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px;
        }

        .card-body.card {
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 14px;
            width: 410px;
        }

        .publicado {
            text-align: center;
            font: normal normal normal 10px/20px Roboto;
            letter-spacing: 0px;
            color: #039C55;
            opacity: 1;
            background: #E9FFE8 0% 0% no-repeat padding-box;
            border-radius: 7px;
            width: 50px;
        }

        .borrador{
            text-align: center;
            font: normal normal normal 10px/20px Roboto;
            letter-spacing: 0px;
            color: #FF9900;
            opacity: 1;
            background: #FFECAF 0% 0% no-repeat padding-box;
            border-radius: 7px;
            width: 80px;

        }
    </style>

@livewire('template-top-analisis-riesgos')
@endsection
