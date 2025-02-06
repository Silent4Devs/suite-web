@extends('layouts.admin')
@section('styles')
    <style>
        .instrucciones {
            background-color: #3B7EB2 !important;
            color: white !important;
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
    <h5 class="titulo">Análisis de Riesgos </h5>

    @include('partials.flashMessages')

    <div class="card card-body instrucciones">
        <div class="row ">
            <div class="col-md-auto"> <!-- Use col-md-auto to let Bootstrap determine the width based on content -->
                <img src="{{ asset('img/brechas-blue.png') }}" style="width: 192px; height: 119px;">
            </div>
            <div class="col-md-9" >
                <h3>¿Qué es? Análisis de Riesgos</h3>
                <p style="font-size:12px; font:normal;">El análisis de riesgos es un proceso que se utiliza para identificar, evaluar y gestionar los riesgos potenciales que pueden afectar a una empresa, proyecto o cualquier otra iniciativa. Es una herramienta fundamental para la toma de decisiones estratégicas, ya que permite anticipar posibles problemas y tomar medidas para prevenirlos o minimizar su impacto.El análisis de riesgos es un proceso que permite identificar, evaluar y gestionar los riesgos potenciales que pueden afectar a una empresa, proyecto o cualquier otra iniciativa.</p>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center" style="gap: 20px;">
        <div class="card" style="width: 410px;">
            <div class="card-body">
                <img src="{{ asset('img/brechas-inicio-a.png') }}" alt="">
                <div class="d-flex flex-column align-items-center">
                    <h4>Templates</h4>
                    <a href="{{route('admin.template-analisis-riesgo.create')}}" class="btn tb-btn-primary">Generar</a>
                </div>
            </div>
        </div>
        <div class="card" style="width: 410px;">
            <div class="card-body">
                <img src="{{ asset('img/brechas-inicio-b.png') }}" alt="">
                <div class="d-flex flex-column align-items-center">
                    <h4>Análisis de Riesgos</h4>
                    <a href="{{route('admin.risk-analysis-index')}}" class="btn tb-btn-primary">Generar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
