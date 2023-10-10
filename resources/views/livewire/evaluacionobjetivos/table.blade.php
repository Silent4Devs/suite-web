<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Evaluación</th>
            <th scope="col">Fecha</th>
            <th scope="col">Resultado</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($evaluaciones as $evaluacion)
            <tr>
                <td>{{ $evaluacion->evaluacion }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($evaluacion->fecha)->format('d-m-Y') }}
                </td>
                <td>
                    @if ($evaluacion->resultado >= $objetivos->verde)
                        <span
                            class="dotverde"></span>&nbsp;&nbsp;&nbsp;{{ $evaluacion->resultado . ' ' . $objetivos->unidadmedida }}
                    @elseif ($evaluacion->resultado >= $objetivos->amarillo && $evaluacion->resultado < $objetivos->verde)
                        <span class="dotyellow"></span>&nbsp;&nbsp;&nbsp;
                        {{ $evaluacion->resultado . ' ' . $objetivos->unidadmedida }}
                    @else
                        <span
                            class="dotred"></span>&nbsp;&nbsp;&nbsp;{{ $evaluacion->resultado . ' ' . $objetivos->unidadmedida }}
                    @endif

                </td>
                <td>
                    <button wire:click="edit({{ $evaluacion->id }})" class="btn btn-info">
                        <i class="fas fa-pencil-alt"></i>
                    </button>

                </td>
                <td>
                    <button wire:click="delete({{ $evaluacion->id }})" class="btn btn-info"
                        style="background-color: red !important; border: none !important; opacity: 0.7;">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align-last:center">No hay evaluaciones</td>
            </tr>
        @endforelse
    </tbody>
</table>
