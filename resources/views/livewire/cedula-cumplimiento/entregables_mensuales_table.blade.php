<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Programada&nbsp;@for ($i = 0; $i < 10; $i++)
                        &nbsp;
                    @endfor
                </th>
                <th>&nbsp;&nbsp;&nbsp;Real&nbsp;@for ($i = 0; $i < 20; $i++)
                        &nbsp;
                    @endfor
                </th>
                <th>Desfase</th>
                <th>Observaciones</th>
                <th>Cumple</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entregables as $entregable)
                <tr>
                    <td>
                        {{ $entregable->no_entrega }}
                    </td>
                    <td style="padding: 5px; width:40%">
                        {{ $entregable->nombre_entregable }}
                    </td>
                    <td>
                        @if (!is_null($entregable->plazo_entrega_termina))
                            <i class="fas fa-calendar-alt"></i>
                            {{ $entregable->plazo_entrega_termina != null ? \Carbon\Carbon::createFromFormat('Y-m-d', $entregable->plazo_entrega_termina)->format('d-m-Y') : null }}
                        @endif
                    </td>
                    <td>
                        @if (!is_null($entregable->entrega_real))
                            <i class="fas fa-calendar-alt"></i>
                            {{ $entregable->entrega_real != null ? \Carbon\Carbon::createFromFormat('Y-m-d', $entregable->entrega_real)->format('d-m-Y') : null }}
                        @endif
                    </td>
                    <td>
                        @if (!is_null($entregable->entrega_real) && !is_null($entregable->plazo_entrega_termina))
                            @if (
                                \Carbon\Carbon::parse($entregable->plazo_entrega_termina)->diffInDays(
                                    \Carbon\Carbon::parse($entregable->entrega_real),
                                    false) < 0)
                                <i class="fas fa-calendar-plus" style="color:#17de8c"></i>
                                {{-- {{ \Carbon\Carbon::parse($entregable->plazo_entrega_termina)->diffInDays(\Carbon\Carbon::parse($entregable->entrega_real), false) }}
                            días --}}
                                Sin desfase
                            @elseif(
                                \Carbon\Carbon::parse($entregable->plazo_entrega_termina)->diffInDays(
                                    \Carbon\Carbon::parse($entregable->entrega_real),
                                    false) == 0)
                                <i class="fas fa-calendar-plus" style="color:#17de8c"></i>
                                {{-- {{ \Carbon\Carbon::parse($entregable->plazo_entrega_termina)->diffInDays(\Carbon\Carbon::parse($entregable->entrega_real), false) }}
                            días --}}
                                Sin desfase
                            @else
                                <i class="fas fa-calendar-times" style="color:#ff4e4b"></i>
                                {{ \Carbon\Carbon::parse($entregable->plazo_entrega_termina)->diffInDays(\Carbon\Carbon::parse($entregable->entrega_real), false) }}
                                días
                            @endif
                        @endif

                    </td>
                    <td>
                        {{ $entregable->observaciones }}
                    </td>
                    <td>
                        @if ($entregable->cumple)
                            <div style="display: flex; align-items: center">
                                <i class="material-icons green-text">check</i>
                                <span>Cumple</span>
                            </div>
                        @else
                            <div style="display: flex; align-items: center">
                                <i class="material-icons red-text">close</i>
                                <span> No cumple</span>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
