<div class="row">
    <div class="col-12">
        <div class="row fs-consulta">
            <div class="col-5 align-items-end ">
                Evaluación realizada por:
                <strong>
                    @if ($tipo != 'autoevaluacion' && $tipo != 'jefe')
                        @if (auth()->user()->empleado)
                            @if ($evaluado->id != auth()->user()->empleado->id)
                                {{ $evaluador['nombre'] }}<br>
                                @if ($evaluacion->estatus != 3)
                                    <a href="/admin/recursos-humanos/evaluacion-360/evaluacion/{{$evaluacion->id}}/reactivar/{{$evaluado->id}}/{{$evaluador['id']}}"
                                        class="btn btn-primary btn-xs" title="Reactivar">Reactivar Evaluación</a>
                                @endif
                            @else
                                Evaluador
                            @endif
                        @endif
                    @else
                        {{ $evaluador['nombre'] }} <br>
                        @if ($evaluacion->estatus != 3)
                            <a href="/admin/recursos-humanos/evaluacion-360/evaluacion/{{$evaluacion->id}}/reactivar/{{$evaluado->id}}/{{$evaluador['id']}}"
                                class="btn btn-primary btn-xs" title="Reactivar">Reactivar Evaluación</a>
                        @endif
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

@if ($tipo == 'autoevaluacion')
<table id="autoevaluacion" hidden>
    <thead>
        <tr>
            <td>{{'Evaluado: '.$evaluado->name}}</td>
            <td>{{'Tipo de evaluación: '.$lista_autoevaluacion->first()['tipo'] }}</td>
            <td>{{ 'Valor total: '.$lista_autoevaluacion->first()['peso_general'] }}%</td>
        </tr>
        <tr>
            <td>
                {{'Evaluacion realizada por: '.$evaluador['nombre']}}
            </td>
            <td>Tipo</td>
            <td>Alcanzado</td>
            <td>Meta</td>
            <td>Calificación</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($evaluador['competencias'] as $idx => $competencia)
        <tr>
            <td>
                {{ $idx + 1 }}.- {{ $competencia['competencia'] }}
            </td>
            <td>
                {{ $competencia['tipo_competencia'] }}
            </td>
            <td>
                {{ $competencia['calificacion'] }}
            </td>
            <td>
                {{ $competencia['meta'] }}
            </td>
            <td>
                {{ $competencia['porcentaje'] }}
            </td>
            {{-- <div class="text-center border col-1">
            {{ $competencia['peso'] }} %
        </div> --}}
        </tr>
    @endforeach
    </tbody>
    <tr></tr>
</table>
@endif

@if ($tipo == 'jefe')
<table id="jefe" hidden>
    <thead>
        <tr>
            <td>{{'Evaluado: '.$evaluado->name}}</td>
            <td>{{'Tipo de evaluacion: '.$lista_jefe_inmediato->first()['tipo'] }}</td>
            <td>{{ 'Valor total: '.$lista_jefe_inmediato->first()['peso_general'] }}%</td>
        </tr>
        <tr>
            <td>
                {{'Evaluacion realizada por: '.$evaluador['nombre']}}
            </td>
            <td>Tipo</td>
            <td>Alcanzado</td>
            <td>Meta</td>
            <td>Calificación</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($evaluador['competencias'] as $idx => $competencia)
        <tr>
            <td>
                {{ $idx + 1 }}.- {{ $competencia['competencia'] }}
            </td>
            <td>
                {{ $competencia['tipo_competencia'] }}
            </td>
            <td>
                {{ $competencia['calificacion'] }}
            </td>
            <td>
                {{ $competencia['meta'] }}
            </td>
            <td>
                {{ $competencia['porcentaje'] }}
            </td>
            {{-- <div class="text-center border col-1">
            {{ $competencia['peso'] }} %
        </div> --}}
        </tr>
    @endforeach
    </tbody>
</table>
@endif

@if ($tipo == 'equipo')
<table id="equipo" hidden>
    <thead>
        <tr>
            <td>{{'Evaluado: '.$evaluado->name}}</td>
            <td>Tipo de evaluación: Subordinado</td>
            <td> {{ 'Valor total: '.$lista_equipo_a_cargo->first()['peso_general'] }}%</td>
        </tr>
        <tr>
            <td>
                {{'Evaluacion realizada por: '.$evaluador['nombre'] }}
            </td>
            <td>Tipo</td>
            <td>Alcanzado</td>
            <td>Meta</td>
            <td>Calificación</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($evaluador['competencias'] as $idx => $competencia)
        <tr>
            <td>
                {{ $idx + 1 }}.- {{ $competencia['competencia'] }}
            </td>
            <td>
                {{ $competencia['tipo_competencia'] }}
            </td>
            <td>
                {{ $competencia['calificacion'] }}
            </td>
            <td>
                {{ $competencia['meta'] }}
            </td>
            <td>
                {{ $competencia['porcentaje'] }}
            </td>
            {{-- <div class="text-center border col-1">
            {{ $competencia['peso'] }} %
        </div> --}}
        </tr>
    @endforeach
    </tbody>
    <tr></tr>
</table>
@endif

@if ($tipo == 'misma_area')
<table id="misma_area" hidden>
    <thead>
        <tr>
            <td>{{'Evaluado: '.$evaluado->name}}</td>
            <td> Tipo de evaluación: Par </td>
            <td> {{ 'Valor total: '.$lista_misma_area->first()['peso_general'] }}%</td>
        </tr>
        <tr>
            <td>
                {{'Evaluacion realizada por: '.$evaluador['nombre'] }}
            </td>
            <td>Tipo</td>
            <td>Alcanzado</td>
            <td>Meta</td>
            <td>Calificación</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($evaluador['competencias'] as $idx => $competencia)
        <tr>
            <td>
                {{ $idx + 1 }}.- {{ $competencia['competencia'] }}
            </td>
            <td>
                {{ $competencia['tipo_competencia'] }}
            </td>
            <td>
                {{ $competencia['calificacion'] }}
            </td>
            <td>
                {{ $competencia['meta'] }}
            </td>
            <td>
                {{ $competencia['porcentaje'] }}
            </td>
            {{-- <div class="text-center border col-1">
            {{ $competencia['peso'] }} %
        </div> --}}
        </tr>
    @endforeach
    </tbody>
    <tr></tr>
</table>
@endif
