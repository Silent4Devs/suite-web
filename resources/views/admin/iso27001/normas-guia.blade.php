@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/guia_iso.css') }}">
@endsection
@section('content')
    <h5 class="titulo_general_funcion">GESTIÓN NORMATIVA</h5>

    <div class="card card-body px-5">
        <h2 class="title-normas-iso">Normas</h2>
        <div class="d-flex mt-5 caja-cards-normas justify-content-center" style="gap: 20px;">
            <a href="#" class="disabled">
                <div class="card card-norma" style="background-color: #FFF0C5;">
                    <div class="card-img">
                        <img src="{{ asset('img/iso/iso23.png') }}" alt="">
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">CONTINUIDAD DE NEGOCIO 22301</h4>
                        <p>
                            La norma ISO 22301 define los requisitos que deben cumplir los sistemas de gestión de la
                            continuidad
                            del negocio (SGCN) para asegurar que una organización pueda continuar operando durante y después
                            de
                            situaciones de crisis, como desastres naturales, ciberataques, pandemias, conflictos armados o
                            cualquier otra situación que pueda interrumpir sus actividades.
                        </p>
                    </div>
                </div>
            </a>
            <a href="#" class="disabled">

                <div class="card card-norma" style="background-color: #FFD4DB;">
                    <div class="card-img">
                        <img src="{{ asset('img/iso/iso28.png') }}" alt="">
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">GESTIÓN DE LA CALIDAD 9001</h4>
                        <p>
                            El objetivo de la norma es ayudar a las organizaciones a mejorar su capacidad para proporcionar
                            productos y servicios que cumplan con los requisitos del cliente y los requisitos legales y
                            reglamentarios aplicables.
                        </p>
                        <p>
                            La norma puede ayudar a las organizaciones a mejorar su eficiencia, reducir los costos y
                            aumentar la
                            satisfacción del cliente.
                        </p>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.iso27001.guia') }}">
                <div class="card card-norma" style="background-color: #E1E7FF;">
                    <div class="card-img">
                        <img src="{{ asset('img/iso/iso14.png') }}" alt="">
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">SEGURIDAD DE LA INFORMACIÓN 27001</h4>
                        <p>
                            Es un estándar internacional que establece los requisitos para un sistema de gestión de la
                            seguridad
                            de la información (SGSI).
                        </p>
                        <p>
                            La ISO 27001 se basa en el enfoque de gestión de riesgos para la seguridad
                            de la información. Este enfoque implica la identificación, evaluación y mitigación de los
                            riesgos de
                            seguridad de la información que enfrenta una organización.
                        </p>
                    </div>
                </div>
            </a>
            <a href="#" class="disabled">
                <div class="card card-norma" style="background-color: #BED6F9;">
                    <div class="card-img">
                        <img src="{{ asset('img/iso/iso22.png') }}" alt="">
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">GESTIÓN DEL SERVICIO 2000</h4>
                        <p>
                            Es un estándar internacional que establece los requisitos para un sistema de gestión de
                            servicios de
                            TI. La ISO 20000 se basa en el enfoque de procesos para la gestión de servicios de TI.
                        </p>
                        <p>
                            Este enfoque implica la identificación, documentación, implementación y mejora de los procesos
                            de
                            gestión de servicios de TI.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
