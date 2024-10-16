@extends('layouts.admin')

@section('content')
@section('titulo', 'Actualizar Requisicion')
<link rel="stylesheet" href="{{ asset('css/requisitions/requisitions.css') }}{{ config('app.cssVersion') }}">
{{-- {{ Breadcrumbs::render('proveedores_create') }} --}}

@livewire('requisiciones-edit-component', ['id_requisiciondata' => $id])

<div class="card card-body">
    <h4>Historial de Cambios:</h4>

    @if (!empty($resultadoRequisiciones))
        @foreach ($resultadoRequisiciones as $cambios)
            <h5>Versión: {{ $cambios['version'] }}</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>Valor Anterior</th>
                        <th>Valor Modificado</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($cambios['cambios']))
                        @foreach ($cambios['cambios'] as $cambio)
                            <tr>
                                <td>{{ $cambio->campo }}</td>
                                <td>{{ $cambio->valor_anterior }}</td>
                                <td>{{ $cambio->valor_nuevo }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">No hay cambios registrados para esta versión.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <br> <!-- Espacio entre tablas -->
        @endforeach
    @else
        <h6>No hay cambios registrados</h6>
    @endif

</div>
@endsection
