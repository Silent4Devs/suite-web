<table class="datatable datatable-lista-distribucion" id="datatable-lista-distribucion">
    <thead>
        <tr>
            <th>
                Modulo
            </th>
            <th>
                Submodulo
            </th>
            <th>
                Aprobadores
            </th>
            <th style="min-width: 150px; max-width:150px;">

            </th>
        </tr>
    </thead>
</table>

@foreach ($participantes as $key => $row)
    <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal content structure -->
                <div class="modal-body">
                    <h5>Lista de Aprobadores</h5>

                    @php
                        $levels = []; // Initialize an empty array to store levels temporarily
                    @endphp

                    @foreach ($row->participantes as $participante)
                        @php
                            $nivel = $participante->nivel;
                            $levels[$nivel][] = $participante; // Group participantes by their nivel
                        @endphp
                    @endforeach

                    @foreach ($levels as $nivel => $participantesByLevel)
                        @php
                            // Sort participantes by numero_orden within each nivel
                            usort($participantesByLevel, function ($a, $b) {
                                return $a->numero_orden <=> $b->numero_orden;
                            });

                        @endphp

                        @if ($nivel == 0)
                            <div class="row mb-3">
                                <div class="col-6">
                                    <h6>Super Aprobadores</h6>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        @foreach ($participantesByLevel as $participante)
                                            <div class="col-2">
                                                <img src="{{ asset('storage/empleados/imagenes') }}/{{ $participante->empleado->avatar }}"
                                                    class="img_empleado" title="{{ $participante->empleado->name }}">
                                                <!-- Add other empleado details here -->
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row mb-3">
                                <div class="col-6">
                                    <h6>Nivel {{ $nivel }}</h6>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        @foreach ($participantesByLevel as $participante)
                                            <div class="col-2">
                                                <img src="{{ asset('storage/empleados/imagenes') }}/{{ $participante->empleado->avatar }}"
                                                    class="img_empleado" title="{{ $participante->empleado->name }}">
                                                <!-- Add other empleado details here -->
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach

