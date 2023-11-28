@extends('layouts.admin')
@section('content')
    @include('admin.analisisdebrecha2022nv.estilos')
    <style>
        .titulo {
            text-align: left;
            font: normal normal 600 24px Segoe UI;
            letter-spacing: 0px;
            color: #2567AE;
            opacity: 1;
            margin-left: 5px;
            margin-bottom: 12px;
        }
    </style>

    @include('partials.flashMessages')

    <h5 class="titulo">Formulario</h5>

    <div class="card instrucciones">
        <div class="card-body">
            <div class="col-3">

            </div>
            <div class="col-9">
                <h5>¿Que es? Dashboard Análisis de brechas</h5>
                <p>Es una herramienta qye ayuda a las organizaciones s visualizar las brechas entre el estado actual y el
                    estado deseado. Este dashboard suele incluir indicadores clave de rendimiento KPI que miden el desempeño
                    de la organizacion en las areas que se estan analizando. El dashboard puede ser una herramienta valiosa
                    para la gestion de las brechas. Al proporcionar una visión general de las brechas, ell dashboard puede
                    ayudar a las organizaciones a priorizar las areas de mejora y a tomar medidas para cerrar las brechas
                </p>
            </div>
        </div>
    </div>

    @livewire('evaluacion-analisis-brechas')
@endsection
