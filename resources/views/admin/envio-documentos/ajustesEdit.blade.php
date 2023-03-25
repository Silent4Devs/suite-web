@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.Ausencias.index') !!}">Ajustes Envios</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Ajustes: Envios</h5>
    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::model($ajustes, [
                'route' => ['admin.ajustes-envio-documentos-update', $ajustes->id],
                'method' => 'put',
            ]) !!}

            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="id_coordinador" class="required"><i
                            class="fa-solid fa-calendar-days iconos-crear"></i>Coordinador de envíos</label><i
                        class="fas fa-info-circle" style="font-size:12pt; float: right;"
                        title="Selecciona el colaborador responsable de coordinar los envíos."></i>
                    <select name="id_coordinador" class="form-control">
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id }}"
                                {{ $empleado->id == $ajustes->id_coordinador ? 'selected' : '' }}>
                                {{ $empleado->name }}</option>
                        @endforeach
                        <option disabled
                            {{ old('id_coordinador') == $ajustes->id_coordinador ? ' selected="selected"' : '' }}>
                            Seleccione...</option>
                    </select>
                </div>

                <div class="form-group col-sm-6">
                    <label for="id_mensajero" class="required"><i
                            class="fa-solid fa-calendar-days iconos-crear"></i>Mensajero</label><i
                        class="fas fa-info-circle" style="font-size:12pt; float: right;"
                        title="Selecciona el colaborador responsable de mensajería."></i>
                    <select name="id_mensajero" class="form-control">
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id }}"
                                {{ $empleado->id == $ajustes->id_mensajero ? 'selected' : '' }}>
                                {{ $empleado->name }}</option>
                        @endforeach
                        <option disabled {{ old('id_mensajero') == $ajustes->id_mensajero ? ' selected="selected"' : '' }}>
                            Seleccione...</option>
                    </select>
                </div>
            </div>

            <!-- Submit Field -->
            <div class="text-right form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
