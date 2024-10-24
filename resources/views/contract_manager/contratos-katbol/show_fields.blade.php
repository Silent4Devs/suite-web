<div class="col l8 m12 s12">
    <div class="card hoverable">
        <div class="card-content">

            <table data-toggle="table">
                <thead class="thead-dark">
                    <tr>
                        <th>N° Contrato</th>
                        <th>Tipo de contrato</th>
                        <th>Nombre del Servicio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <label for="no_contrato">No. de Contrato:</label>
                            <span>{{ $contrato->no_contrato }}</span>
                        </td>
                        <td>
                            <label for="tipo_contrato">Tipo de Contrato:</label>
                            <span>{{ $contrato->tipo_contrato }}</span>
                        </td>
                        <td>
                            <label for="nombre_servicio">Nombre del Servicio:</label>
                            <span>{{ $contrato->nombre_servicio }}</span>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>
</div>

<div class="col l4 m12 s12">
    <div class="card hoverable">
        <div class="card-content center-align">

            <table data-toggle="table">
                <thead>
                    <tr>
                        <th>Nombre del proveedor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <label for="nombre_proveedor">Nombre del Proveedor:</label>
                            <span>{{ $contrato->nombre_proveedor }}</span>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>

<div class="col l8 m12 s12">
    <div class="card hoverable align-items-center">
        <div class="card-content">

            <table data-toggle="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Objetivo del Proyecto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <label for="objetivo">Objetivo:</label>
                            <span>{{ $contrato->objetivo }}</span>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>
</div>

<div class="col l4 m12 s12">
    <div class="card hoverable">
        <div class="card-content center-align">

            <table data-toggle="table">
                <thead>
                    <tr>
                        <th>Nombre del Administrador del Contrato y Cargo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <label for="administrador_contrato">Administrador del Contrato:</label>
                            <span>{{ $contrato->administrador_contrato }}</span>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>

<div class="col l8 m12 s12">
    {{-- <div class="card hoverable align-items-center">
        <div class="card-panel">
            Elaboro el análisis:
            <div class="inline input-field">
                {!! Form::label('elaboro')!!}
                <span>{{ $contrato->laboro }}</span>
            </div>
            Revisó los resultados:
            <div class="inline input-field">
                {!! Form::label('reviso')!!}
                <span>{{ $contrato->reviso }}</span>
            </div>
            Autorizó la cédula:
            <div class="inline input-field">
                {!! Form::label('autorizo')!!}
                <span>{{ $contrato->autorizo }}</span>
            </div>
            Cumple:
            <div class="inline input-field">
                {!! Form::label('cumple')!!}
            </div> --}}

</div>
</div>
</div>

<div class="col l4 m12 s12">
    <div class="card hoverable">
        <div class="card-content center-align">

            <table data-toggle="table">
                <thead>
                    <tr>
                        <th>Fecha de firma</th>
                        <th>Periocidad de pagos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            24/11/2020
                        </td>
                        <td>
                            Mensual
                        </td>
                    </tr>
                </tbody>
            </table>

            <table data-toggle="table">
                <thead>
                    <tr>
                        <th>Monto de pago</th>
                        <th>Incluye Monto Máximo y Mínimo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            $5000
                        </td>
                        <td>
                            $6000
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
