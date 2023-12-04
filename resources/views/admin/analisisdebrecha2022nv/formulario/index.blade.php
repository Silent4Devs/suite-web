@extends('layouts.admin')

@section('content')
    @include('admin.analisisdebrecha2022nv.estilos')
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @include('partials.flashMessages')

    <h5 class="titulo">Formulario</h5>

    <div class="card instrucciones">
        <div class="card-body">
            <div class="row" style="padding-bottom: 10px;">
                <div class="col-2">
                    <img src="{{ asset('assets/Rectángulo 2344@2x.png') }}" alt="imagen_instrucciones">
                </div>
                <div class="col-10">
                    <h5>¿Que es? Dashboard Análisis de brechas</h5>
                    <p>Es una herramienta qye ayuda a las organizaciones s visualizar las brechas entre el estado actual y
                        el
                        estado deseado. Este dashboard suele incluir indicadores clave de rendimiento KPI que miden el
                        desempeño
                        de la organizacion en las areas que se estan analizando. El dashboard puede ser una herramienta
                        valiosa
                        para la gestion de las brechas. Al proporcionar una visión general de las brechas, ell dashboard
                        puede
                        ayudar a las organizaciones a priorizar las areas de mejora y a tomar medidas para cerrar las
                        brechas
                    </p>
                </div>
            </div>
        </div>
    </div>
    <livewire:evaluacion-analisis-brechas :id="$id" />
    {{-- @livewire('evaluacion-analisis-brechas', ['id' => $id]) --}}
@endsection
