<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Periodo</th>
                <th>Unidad</th>
                <th>SLA Comprometido</th>
                <th>Logro</th>
                <!--<th>SLA&nbsp;@for ($i = 0; $i < 20; $i++)
&nbsp;
@endfor
</th>-->
            </tr>
        </thead>
        <tbody>
            @foreach ($niveles_servicio as $nivel_servicio)
                <tr>
                    <td>{{ $nivel_servicio->id }}</td>
                    <td>{{ $nivel_servicio->nombre }}</td>
                    <td>
                        @switch (intval($nivel_servicio->periodo_evaluacion))
                            @case (1)
                                Unica vez
                            @break;
                            @case (2)
                                Diario
                            @break;
                            @case (3)
                                Semanal
                            @break;
                            @case (4)
                                Quincenal
                            @break;
                            @case (5)
                                Mensual
                            @break;
                            @case (6)
                                Bimestral
                            @break;
                            @case (7)
                                Trimestral
                            @break;
                            @case (8)
                                Semestral
                            @break;
                            @case (9)
                                Anual
                            @break;
                            @case (10)
                                Multianual
                            @break;

                            @default
                                No encontrado
                            @break;
                        @endswitch
                    </td>
                    <td>{{ $nivel_servicio->unidad }}</td>
                    <td>{{ $nivel_servicio->meta }} {{ $nivel_servicio->unidad }}</td>
                    <!--<td>{{ $nivel_servicio->p_general != null ? $nivel_servicio->p_general : '' }} {{ $nivel_servicio->unidad }}-->
                    </td>
                    @php
                        $sla = 0;
                        $color_sla = '';
                        $color_letra_sla = '';
                        if ($nivel_servicio->p_general != null) {
                            $sla = round(($nivel_servicio->p_general / $nivel_servicio->meta) * 100);
                            if ($sla > 60 && $sla <= 100) {
                                $color_sla = '#009999';
                                $color_letra_sla = 'white';
                            } elseif ($sla > 30 && $sla <= 60) {
                                $color_sla = '#FFC000';
                                $color_letra_sla = 'black';
                            } else {
                                $color_sla = '#FF6565';
                                $color_letra_sla = 'white';
                            }
                        } else {
                            $color_sla = '#FF6565';
                            $color_letra_sla = 'white';
                        }
                    @endphp
                    <td>
                        <strong style="padding:5px; border-radius:5px">
                            <span style="font-size:1em; color:{{ $color_sla }}"><i class="fas fa-tachometer-alt"></i>
                                <!--<span style="color:black">{{ $sla }}</span>-->
                                <span
                                    style="color:black">{{ $nivel_servicio->p_general != null ? $nivel_servicio->p_general : '' }}</span>
                            </span>
                            <span style="font-size:0.8em;">%</span>
                        </strong>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
