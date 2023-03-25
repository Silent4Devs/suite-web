<div class="row">
    <div class="col-12">
        <div class="mt-2 row fs-consulta">
            <div class="col-5 align-items-end ">
                Evaluación realizada por:
                <strong>
                    @if ($tipo != 'autoevaluacion' && $tipo != 'jefe')
                        @if (auth()->user()->empleado)
                            @if ($evaluado->id != auth()->user()->empleado->id)
                                {{ $evaluador['nombre'] }}
                            @else
                                Evaluador
                            @endif
                        @endif
                    @else
                        {{ $evaluador['nombre'] }}
                    @endif
                </strong>
                {{-- <span class="badge badge-primary">{{ $evaluador['tipo'] }}</span> --}}
            </div>
            <div class="text-center col-3" style="align-self: flex-end;"><small>Tipo</small></div>
            <div class="text-center col-1" style="align-self: flex-end;"><small>Alcanzado</small></div>
            <div class="text-center col-1" style="align-self: flex-end;"><small>Meta</small></div>
            <div class="text-center col-2" style="align-self: flex-end;"><small>Calificación</small></div>
            {{-- <div class="text-center col-1" style="align-self: flex-end;"><small>Peso</small></div> --}}
        </div>
    </div>
    <div class="col-12">
        @foreach ($evaluador['competencias'] as $idx => $competencia)
            <div class="row fs-consulta">
                <div class="text-white col-5" style="background: #3e3e3e; border: 1px solid #fff">
                    {{ $idx + 1 }}.- {{ $competencia['competencia'] }}
                </div>
                <div class="text-center border col-3" style="font-size:0.8vw">
                    {{ $competencia['tipo_competencia'] }}
                </div>
                <div class="text-center border col-1">
                    {{ $competencia['calificacion'] }}
                </div>
                <div class="text-center border col-1">
                    {{ $competencia['meta'] }}
                </div>
                <div class="text-center border col-2">
                    {{ $competencia['porcentaje'] }}
                </div>
                {{-- <div class="text-center border col-1">
                {{ $competencia['peso'] }} %
            </div> --}}
            </div>
        @endforeach
    </div>
</div>
