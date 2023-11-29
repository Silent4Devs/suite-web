@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/foda.css') }}">
@endsection
@section('content')
    <h5 class="col-12 titulo_general_funcion">Análisis FODA</h5>

    <div class="card-filtros-fodas">
        <div class="row">
            <div class="col-md-6">
                <label for="">Buscar</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="">Fecha</label>
                <input type="date" class="form-control">
            </div>
        </div>
    </div>

    <div class="caja-cards mt-5">
        @foreach ($query as $foda)
            <a href="{{ asset('admin/entendimiento-organizacions') }}/{{ $foda->id }}">
                <div class="card card-foda">
                    <div class="card-header">
                        <strong> {{ Carbon\Carbon::parse($foda->fecha)->format('d/m/Y') }}</strong>
                    </div>
                    <div class="card-body">
                        <h3>
                            {{ $foda->analisis }}
                        </h3>
                        <p>
                            <small>{{ $foda->elaboro_id ? $foda->empleado->name : 'No asignado' }}</small>
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
