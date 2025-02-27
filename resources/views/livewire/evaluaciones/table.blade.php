@if (empty($this->rangos_ind))
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
        @foreach ($evaluaciones as $evaluacion)
            <tr>
                <td>{{ $evaluacion->evaluacion }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($evaluacion->fecha)->format('d-m-Y') }}
                </td>
                <td>
                    @if ($evaluacion->resultado >= $indicadoresSgsis->verde)
                        <span
                            class="dotverde"></span>&nbsp;&nbsp;&nbsp;{{ $evaluacion->resultado . $indicadoresSgsis->unidadmedida }}
                    @elseif ($evaluacion->resultado >= $indicadoresSgsis->amarillo && $evaluacion->resultado < $indicadoresSgsis->verde)
                        <span class="dotyellow"></span>&nbsp;&nbsp;&nbsp;
                        {{ $evaluacion->resultado . ' ' . $indicadoresSgsis->unidadmedida }}
                    @else
                        <span
                            class="dotred"></span>&nbsp;&nbsp;&nbsp;{{ $evaluacion->resultado . ' ' . $indicadoresSgsis->unidadmedida }}
                    @endif

                </td>
                <td>
                    <button wire:click="edit({{ $evaluacion->id }})" class="btn btn-info">
                        {{-- <i class="fas fa-pencil-alt"></i> --}}
                        <i class="fas fa-edit"></i>
                    </button>

                </td>
                <td>
                    <button wire:click="delete({{ $evaluacion->id }})" class="btn"
                        style="background-color:red; color:white; opacity:0.8;">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
@else
    @if ($this->rangos_ind->flujo === "ascendente")
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
                @foreach ($evaluaciones as $evaluacion)
                    <tr>
                        <td>{{ $evaluacion->evaluacion }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($evaluacion->fecha)->format('d-m-Y') }}
                        </td>
                        <td>
                            @if ($evaluacion->resultado >= $indicadoresSgsis->verde)
                                <span
                                    class="dotverde"></span>&nbsp;&nbsp;&nbsp;{{ $evaluacion->resultado . $indicadoresSgsis->unidadmedida }}
                            @elseif ($evaluacion->resultado >= $indicadoresSgsis->amarillo && $evaluacion->resultado < $indicadoresSgsis->verde)
                                <span class="dotyellow"></span>&nbsp;&nbsp;&nbsp;
                                {{ $evaluacion->resultado . ' ' . $indicadoresSgsis->unidadmedida }}
                            @else
                                <span
                                    class="dotred"></span>&nbsp;&nbsp;&nbsp;{{ $evaluacion->resultado . ' ' . $indicadoresSgsis->unidadmedida }}
                            @endif

                        </td>
                        <td>
                            <button wire:click="edit({{ $evaluacion->id }})" class="btn btn-info">
                                {{-- <i class="fas fa-pencil-alt"></i> --}}
                                <i class="fas fa-edit"></i>
                            </button>

                        </td>
                        <td>
                            <button wire:click="delete({{ $evaluacion->id }})" class="btn"
                                style="background-color:red; color:white; opacity:0.8;">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
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
                @foreach ($evaluaciones as $evaluacion)
                    <tr>
                        <td>{{ $evaluacion->evaluacion }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($evaluacion->fecha)->format('d-m-Y') }}
                        </td>
                        <td>
                            @if ($evaluacion->resultado <= $indicadoresSgsis->verde)
                                <span
                                    class="dotverde"></span>&nbsp;&nbsp;&nbsp;{{ $evaluacion->resultado . $indicadoresSgsis->unidadmedida }}
                            @elseif ($evaluacion->resultado <= $indicadoresSgsis->amarillo && $evaluacion->resultado > $indicadoresSgsis->verde)
                                <span class="dotyellow"></span>&nbsp;&nbsp;&nbsp;
                                {{ $evaluacion->resultado . ' ' . $indicadoresSgsis->unidadmedida }}
                            @else
                                <span
                                    class="dotred"></span>&nbsp;&nbsp;&nbsp;{{ $evaluacion->resultado . ' ' . $indicadoresSgsis->unidadmedida }}
                            @endif

                        </td>
                        <td>
                            <button wire:click="edit({{ $evaluacion->id }})" class="btn btn-info">
                                {{-- <i class="fas fa-pencil-alt"></i> --}}
                                <i class="fas fa-edit"></i>
                            </button>

                        </td>
                        <td>
                            <button wire:click="delete({{ $evaluacion->id }})" class="btn"
                                style="background-color:red; color:white; opacity:0.8;">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endif



<div class="mt-4 text-right col-sm-12 col-lg-12 col-md-12">
    <a href="{{ route('admin.indicadores-sgsis.index') }}" class="btn btn-outline-primary" type="submit">Cerrar</a>
</div>
