<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="card card-body">
        <h4 style="margin-bottom: 20px;">Historial de Cambios:</h4>

        @if (!empty($resultadoRequisiciones))
            @foreach ($resultadoRequisiciones as $cambios)
                <h5 style="margin-bottom: 10px;">Versión: {{ $cambios['version'] }}</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Campo</th>
                            <th>Valor Anterior</th>
                            <th>Valor Modificado</th>
                            <th>Autor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($cambios['cambios']))
                            @foreach ($cambios['cambios'] as $cambio)
                                <tr>
                                    <td>{{ getDiccionaryRequisionOrder($cambio->campo) }}</td>
                                    <td>{{ $cambio->valor_anterior }}</td>
                                    <td>{{ $cambio->valor_nuevo }}</td>
                                    <td>{{ $cambio->empleado->name }}</td>
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
</div>
