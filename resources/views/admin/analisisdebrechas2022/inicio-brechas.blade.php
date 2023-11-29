@extends('layouts.admin')
@section('styles')
    <style>
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
    </style>
@endsection
@section('content')
    <h5 class="titulo">Análisis de Brechas </h5>

    @include('partials.flashMessages')

    <div class="card-blue-brechas">
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
    </div>

    <div class="d-flex justify-content-center" style="gap: 20px;">
        <div class="card card-body card-img-brecha">
            <img src="{{ asset('img/brechas-inicio-a.png') }}" alt="">
            <h4>Templates</h4>
            <a href="" class="btn btn-info">Generar</a>
        </div>

        <div class="card card-body card-img-brecha">
            <img src="{{ asset('img/brechas-inicio-b.png') }}" alt="">
            <h4>Análisis de brechas</h4>
            <a href="" class="btn btn-info">Generar</a>
        </div>
    </div>
@endsection
