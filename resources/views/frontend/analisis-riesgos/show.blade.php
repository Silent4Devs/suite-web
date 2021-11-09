@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.analisis-riesgos.index') }}">Análisis de Riesgo</a>
        </li>
        <li class="breadcrumb-item active">Detalles</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Detalles</strong>
                            <a href="{{ route('admin.analisis-riesgos.index') }}" class="btn btn-light">Volver</a>
                        </div>
                        <div class="card-body">
                            @include('admin.analisis-riesgos.show_fields')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
