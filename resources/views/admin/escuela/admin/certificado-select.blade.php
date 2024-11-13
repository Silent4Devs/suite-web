@extends('layouts.admin')

@section('content')
    <h5 class="titulo_general_funcion">Certificados</h5>

    <form action="{{ asset('admin/certificado-course-select') }}" method="POST">
        @csrf
        <div class="card card-body" id="certificados-select">
            <div class="d-flex justify-content-between">
                <h5 class="color-tbj">Certificado para Capacitaciones</h5>
            </div>
            <hr>
            <p>
                Selecciona y asigna el diseño del Certificado que se otorgará en la sección de Capacitaciones como
                predeterminado para tu empresa.
            </p>

            <div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start justify-content-center">
                            <label for="certificado1" style="width: 60%;">
                                <input type="radio" id="certificado1" name="certificado"
                                    {{ $org->certificado === 1 ? 'checked' : '' }} value="1">
                                <img src="{{ asset('img/escuela/certificaciones/certificado1.png') }}" alt=""
                                    style="width: 100%;">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start justify-content-center">
                            <label for="certificado2" style="width: 60%;">
                                <input type="radio" id="certificado2" name="certificado"
                                    {{ $org->certificado === 2 ? 'checked' : '' }} value="2">
                                <img src="{{ asset('img/escuela/certificaciones/certificado2.png') }}" alt=""
                                    style="width: 100%;">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="text-end">
                    <button class="btn btn-primary">Guardar seleccionado</button>
                </div>
            </div>
        </div>
    </form>
@endsection
