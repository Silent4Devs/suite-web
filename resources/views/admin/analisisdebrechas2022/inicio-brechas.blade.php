@extends('layouts.admin')
@section('styles')
    {{-- <style>
        .card-blue-brechas {
            background-color: #306BA9;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .card-blue-brechas img {
            width: 130px;
        }

        .card-img-brecha {
            width: 400px;
            gap: 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card-img-brecha {
            width: 300px;
        }
    </style> --}}
    <style>
        .instrucciones {
            background-color: rgb(52, 117, 178);
            color: white;
            border-radius: 8px !important;
            padding: 15px;
            margin-bottom: 20px;
        }

        .encabezado {
            background: #306BA9 0% 0% no-repeat padding-box;
            border-radius: 10px 10px 0px 0px;
            opacity: 1;
            color: white;
        }

        /* .card {
            margin-top: 0px !important;
            margin-bottom: 20px !important;
            border-radius: 14px;
            box-shadow: 0px 1px 4px #0000000F;
            opacity: 1;
        } */
        /* .card-img-brecha {
            width: 400px;
            gap: 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card-img-brecha {
            width: 300px;
        } */

        .form-control {
            background: #F8FAFC 0% 0% no-repeat padding-box;
        }

        .color-picker {
            margin-top: 10px;
        }

        .titulo {
            font: #2567AE normal 600 18px/#2567AE Segoe UI;
            letter-spacing: var(--unnamed-character-spacing-0);
            text-align: left;
            font: normal normal 600 18px/24px Segoe UI;
            letter-spacing: 0px;
            color: #2567AE;
            opacity: 1;
        }
    </style>
@endsection
@section('content')
    <h5 class="titulo">Análisis de Brechas </h5>

    @include('partials.flashMessages')

    {{-- <div class="card-blue-brechas">
        <img src="{{ asset('img/brechas-blue.png') }}" alt="">
        <div>
            <h3 style="font-size: 20px">¿Qué es? Dashboard Análisis de Brechas</h3>
            <p>
                Es una herramienta visual que ayuda a las organizaciones a visualizar las brechas entre el estado actual y
                el estado deseado. Este dashboard suele incluir indicadores clave de rendimiento (KPI) que miden el
                desempeño de la organización en las áreas que se están analizando.El dashboard puede ser una herramienta
                valiosa para la gestión de las brechas. Al proporcionar una visión general de las brechas, el dashboard
                puede ayudar a las organizaciones a priorizar las áreas de mejora y a tomar medidas para cerrar las brechas.
            </p>
        </div>
    </div> --}}

    <div class="card card-body instrucciones">
        <div class="row no-gutters">
            <div class="col-md-auto"> <!-- Use col-md-auto to let Bootstrap determine the width based on content -->
                <img src="{{ asset('img/brechas-blue.png') }}" style="width: 128px; height: 119px;">
            </div>
            <div class="col-md-10" style="margin-left: 10px;">
                <h3>¿Qué es? Dashboard Análisis de Brechas</h3>
                <p style="font-size:14px; font:normal;">Es una herramienta visual que ayuda a las organizaciones a visualizar las brechas entre el estado actual y
                    el estado deseado. Este dashboard suele incluir indicadores clave de rendimiento (KPI) que miden el
                    desempeño de la organización en las áreas que se están analizando.El dashboard puede ser una herramienta
                    valiosa para la gestión de las brechas. Al proporcionar una visión general de las brechas, el dashboard
                    puede ayudar a las organizaciones a priorizar las áreas de mejora y a tomar medidas para cerrar las brechas.</p>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center" style="gap: 20px;">
        {{-- <div class="card card-body card-img-brecha">
            <img src="{{ asset('img/brechas-inicio-a.png') }}" alt="">
            <h4>Templates</h4>
            <a href="" class="btn btn-info">Generar</a>
        </div>

        <div class="card card-body card-img-brecha">
            <img src="{{ asset('img/brechas-inicio-b.png') }}" alt="">
            <h4>Análisis de brechas</h4>
            <a href="" class="btn btn-info">Generar</a>
        </div> --}}
        <div class="card" style="width: 410px;">
            <div class="card-body">
                <img src="{{ asset('img/brechas-inicio-a.png') }}" alt="">
                <div class="d-flex flex-column align-items-center">
                    <h4>Templates</h4>
                    <a href="{{route('admin.templates.create')}}" class="btn btn-info">Generar</a>
                </div>
            </div>
        </div>
        <div class="card" style="width: 410px;">
            <div class="card-body">
                <img src="{{ asset('img/brechas-inicio-b.png') }}" alt="">
                <div class="d-flex flex-column align-items-center">
                    <h4>Análisis de brechas</h4>
                    <a href="{{route('admin.analisisdebrechas-2022.create')}}" class="btn btn-info">Generar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
