<div>
    {{-- Porque ella no compite con nadie, nadie puede competir con ella. --}}
    <div class="card card-body">
        <h4 style="margin-bottom: 20px;">Historial de Cambios:</h4>

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
                    @forelse ($cambios['cambios'] as $cambio)
                        <tr>
                            <td>{{ getDiccionaryRequisionOrder($cambio->campo) }}</td>
                            <td>{{ $cambio->valor_anterior }}</td>
                            <td>{{ $cambio->valor_nuevo }}</td>
                            <td>
                                <img src="{{ asset('storage/empleados/imagenes') }}/{{ $cambio->empleado->avatar }}"
                                class="img_empleado"
                                title="{{ $cambio->empleado->name }}">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No hay cambios registrados para esta versión.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Controles de paginación -->
            <div class="d-flex justify-content-between align-items-center">
                <!-- Información de página actual -->
                <span>Página {{ $cambios['paginaActual'] }} de {{ ceil($cambios['total'] / $perPage) }}</span>

                <div>
                    <!-- Paginación numérica -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm">
                            <!-- Botón "Anterior" -->
                            @if ($cambios['paginaActual'] > 1)
                                <li class="page-item">
                                    <button wire:click="actualizarPagina({{ $cambios['version'] }}, {{ $cambios['paginaActual'] - 1 }})" class="page-link">
                                        {{-- Anterior --}}
                                        <
                                    </button>
                                </li>
                            @endif

                            <!-- Numeración de páginas -->
                            @for ($i = 1; $i <= ceil($cambios['total'] / $perPage); $i++)
                                <li class="page-item {{ $cambios['paginaActual'] == $i ? 'active' : '' }}">
                                    <button wire:click="actualizarPagina({{ $cambios['version'] }}, {{ $i }})" class="page-link">
                                        {{ $i }}
                                    </button>
                                </li>
                            @endfor

                            <!-- Botón "Siguiente" -->
                            @if ($cambios['paginaActual'] < ceil($cambios['total'] / $perPage))
                                <li class="page-item">
                                    <button wire:click="actualizarPagina({{ $cambios['version'] }}, {{ $cambios['paginaActual'] + 1 }})" class="page-link">
                                        {{-- Siguiente --}}
                                        >
                                    </button>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>

            <br> <!-- Espacio entre tablas -->
        @endforeach
    </div>
</div>
