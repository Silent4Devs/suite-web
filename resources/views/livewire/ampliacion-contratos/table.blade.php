<table class="table">
    <thead>
        <tr>
            <th class="letra-ngt grey-text">No. Contrato</th>
            <th class="letra-ngt grey-text">Importe</th>
            <th class="letra-ngt grey-text">Monto total ampliado</th>
            <th class="letra-ngt grey-text">Fecha inicio</th>
            <th class="letra-ngt grey-text">Fecha fin</th>
            @if (!$show_contrato)
                <th class="letra-ngt grey-text">Editar</th>
                <th class="letra-ngt grey-text">Eliminar</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($ampliaciones as $ampliacion)
            <tr>
                <td>{{ $ampliacion->contrato->no_contrato }}</td>
                <td>$ {{ number_format($ampliacion->importe, 2) }}</td>
                <td>$ {{ number_format($ampliacion->monto_total_ampliado, 2) }}</td>
                <td>
                    <i class="fas fa-calendar-alt"></i>
                    {{ date('d-m-Y', strtotime($ampliacion->fecha_inicio)) }}
                </td>
                <td>
                    <i class="fas fa-calendar-alt"></i>
                    {{ date('d-m-Y', strtotime($ampliacion->fecha_fin)) }}
                </td>
                @if (!$show_contrato)
                    <td>
                        <a href="#form_ampliacion">
                            <button wire:click="edit({{ $ampliacion->id }})" class="btn blue">
                                <i class="material-icons">create</i>
                            </button>
                        </a>
                    </td>
                    <td>
                        <button wire:click="destroy({{ $ampliacion->id }})" class="btn red">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td>Sin ampliación registrada</td>
            </tr>
        @endforelse
    </tbody>
</table>
