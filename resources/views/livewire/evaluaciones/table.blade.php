<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Evaluación</th>
            <th scope="col">Fecha</th>
            <th scope="col">Resultado</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($evaluaciones as $evaluacion)
            <tr>
                <td>{{ $evaluacion->evaluacion }}</td>
                <td>{{ $evaluacion->fecha }}</td>
                <td>
                    @if ($evaluacion->resultado >= $indicadoresSgsis->verde)
                        <span class="dotverde"></span> {{ $evaluacion->resultado . $indicadoresSgsis->unidadmedida }}
                    @elseif ($evaluacion->resultado >= $indicadoresSgsis->amarillo && $evaluacion->resultado <
                            $indicadoresSgsis->verde)
                            <span class="dotyellow"></span>
                            {{ $evaluacion->resultado . $indicadoresSgsis->unidadmedida }}
                        @else
                            <span class="dotred"></span>{{ $evaluacion->resultado . $indicadoresSgsis->unidadmedida }}
                    @endif

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
