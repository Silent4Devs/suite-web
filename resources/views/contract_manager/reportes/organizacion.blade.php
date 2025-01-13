<div class="caja-blue mb-4">
    <div>
        <img src="{{ asset('img/welcome-blue.svg') }}" alt="" style="height: 200px;">
    </div>
    <div>
        <h4 style="font-size: 22px; font-weight: bolder;">REPORTE ORGANIZACIÓN</h4>
        <h5 class="text-left" style="font-size: 17px; margin-top:10px;">En esta sección puedes ver datos de la organización</h5>
        <p class="m-1" style="width: 60%;">
            Aquí podrás acceder y consultar de manera rápida y sencilla,
            los datos generales de la organización, facilitando el acceso a la información clave
            y asegurando un manejo eficiente de los recursos disponibles
        </p>
        <button wire:click="imprimirReporteOrganizacion()" class="btn mt-2"
            style="background-color: #fff; color: var(--color-tbj) !important;">
            <i class="fas fa-print"></i>Imprimir Reporte
        </button>
    </div>
</div>

@if (!$organizacion)
    <div class="card">
        <p style="padding: 20px;">
            No se ha registrado organización
        </p>
    </div>
@endif
@isset($organizacion)
    <div class="card" style="width: 100%;">
        <div id="miorganizacion_reporte" class="card-content">
            <div class="flex header-doc">
                <div class="flex-item item-doc-img">
                    @if ($organizacion->logo)
                        <img src="{{ asset($organizacion->logo) }}" style="width: 100%; max-width: 150px;">
                    @else
                        <img src="{{ asset('img/global/silent4business.png') }}" style="width: 100%; max-width: 150px;">
                    @endif
                </div>
                <div class="flex-item" style="font-family: Arial, sans-serif; color: #333;">
                    <p style="margin: 5px 0;">
                        <strong style="color: #49598A;">Nombre:</strong> {{ $organizacion->empresa }}
                    </p>
                    <p style="margin: 5px 0;">
                        <strong style="color: #49598A;">Dirección:</strong>
                        {{ $organizacion->direccion }}
                    </p>
                    <p style="margin: 5px 0;">
                        <strong style="color: #49598A;">Teléfono:</strong> {{ $organizacion->telefono }}
                    </p>
                    <p style="margin: 5px 0;">
                        <strong style="color: #49598A;">Correo:</strong>
                        <a href="mailto:{{ $organizacion->correo }}"
                            style="text-decoration: none; color: #1d72b8;">{{ $organizacion->correo }}</a>
                    </p>
                    <p style="margin: 5px 0;">
                        <strong style="color: #49598A;">Página web:</strong>
                        <a href="{{ $organizacion->pagina_web }}" target="_blank"
                            style="text-decoration: none; color: #1d72b8;">{{ $organizacion->pagina_web }}</a>
                    </p>
                </div>

                <div class="flex-item item-header-doc-info"
                    style="text-align: center; font-family: Arial, sans-serif; color: #333;">
                    <h4
                        style="font-size: 20px; color: #49598A; margin: 10px 0; font-weight: bold; text-transform: uppercase;">
                        Reporte de la Organización
                    </h4>
                    <p style="font-size: 14px; margin: 5px 0; color: #666;">
                        <strong>Fecha de consulta:</strong> {{ date('d/m/y') }}
                    </p>
                </div>
            </div>
            <div class="doc-blue p-4">
                <table class="line_dato text-white">
                    <tr>
                        <th>Productos o Servicios </th>
                        <th>Giro</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $organizacion->servicios }} </div>
                        </td>
                        <td>
                            <div>{{ $organizacion->giro }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato text-white">
                    <tr>
                        <th>Misión </th>
                        <th>Visión</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{!! strip_tags($organizacion->mision) !!}</div>
                        </td>
                        <td>
                            <div>{!! strip_tags($organizacion->vision) !!}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="p-4" style= "background-color: #EEFCFF">
                <table class="line_dato p-4">
                    <tr>
                        <th> Valores </th>
                        <th> Antecedentes</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{!! strip_tags($organizacion->valores) !!} </div>
                        </td>
                        <td>
                            <div>{!! strip_tags($organizacion->antecedentes) !!} </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endisset
