@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.envio-documentos.index') !!}">Solicitud de Mensajería</a>
        </li>
        <li class="breadcrumb-item active">Ver</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Ver: Solicitud de Mensajería</h5>
    <div class="mt-4 card">
        <div class="card-body">


            <div class="row">
                <!-- Categoria Enabled-->
                <div class="col-12 col-sm-12">
                    <div class="text-center form-group"
                        style="background-color:#345183; border-radius: 100px; color: white;">
                        DETALLES DE LA SOLICITUD
                    </div>
                    <!-- Categoria Field -->
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <fieldset disabled>
                                <label for="disabledTextInput"><i
                                        class="fa-solid fa-calendar-check iconos-crear"></i>Estatus:</label>
                                @switch($envio->status)
                                    @case(1)
                                        <input type="text" class="form-control" value="En recolección" style="text-align:center;">
                                    @break

                                    @case(2)
                                        <input type="text" class="form-control" value="En camino" style="text-align:center;">
                                    @break

                                    @case(3)
                                        <input type="text" class="form-control" value="Entregado" style="text-align:center;">
                                    @break

                                    @case(4)
                                        <input type="text" class="form-control" value="Devolución" style="text-align:center;">
                                    @break

                                    @default
                                        <input type="text" class="form-control" value="Por asignar" style="text-align:center;">
                                @endswitch

                            </fieldset>
                        </div>
                        <div class="form-group col-sm-6">
                            <fieldset disabled>
                                <label for="disabledTextInput"><i class="fa-solid fa-calendar-check iconos-crear"></i>Fecha
                                    de la Solicitud:</label>
                                <input type="text" class="form-control"
                                    value="{{ $envio->fecha_solicitud ?: 'Por asignar' }}" style="text-align: center">
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <fieldset disabled>
                                <label for="disabledTextInput"><i class="fa-solid fa-calendar-check iconos-crear"></i>Nombre
                                    del Coordinador:</label>
                                <input type="text" class="form-control" value="{{ $envio->coordinador->name }}"
                                    style="text-align: center">
                            </fieldset>
                        </div>
                        <div class="form-group col-sm-6">
                            <fieldset disabled>
                                <label for="disabledTextInput"><i class="fa-solid fa-calendar-check iconos-crear"></i>Nombre
                                    del Mensajero:</label>
                                <input type="text" class="form-control" value="{{ $envio->mensajero->name }}"
                                    style="text-align: center">
                            </fieldset>
                        </div>
                    </div>
                    <div class="text-center form-group"
                        style="background-color:#345183; border-radius: 100px; color: white;">
                        DETALLES DEL DESTINO
                    </div>
                    <div class="row">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th style="max-width: 75px;">
                                        Nombre de quien recibe:
                                    </th>
                                    <td>
                                        {{ $envio->destinatario ?: 'No definido' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="min-width: 75px;">
                                        Teléfono de quien recibe:
                                    </th>
                                    <td>
                                        {{ $envio->telefono ?: 'No definido' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="min-width: 75px;">
                                        Lugar:
                                    </th>
                                    <td>
                                        {{ $envio->lugar ?: 'No definido' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="min-width: 75px;">
                                        Dirección:
                                    </th>
                                    <td>
                                        {{ $envio->descripcion ?: 'No definido' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="min-width: 75px;">
                                        Fecha limite:
                                    </th>
                                    <td>
                                        {{ $envio->fecha_limite ?: 'No definido' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="min-width: 75px;">
                                        Horario desde:
                                    </th>
                                    <td>
                                        {{ $envio->hora_recepcion_inicio ?: 'No definido' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="min-width: 75px;">
                                        Hasta:
                                    </th>
                                    <td>
                                        {{ $envio->hora_recepcion_fin ?: 'No definido' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="min-width: 75px;">
                                        Notas:
                                    </th>
                                    <td>
                                        {{ $envio->notas ?: 'No definido' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Submit Field -->
                    <div class="text-right form-group col-12">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Regresar</a>
                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection
