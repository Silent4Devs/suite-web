<div class="row">
    <div class="col-lg-12 caja_btn_silent">
        <a class="btn-silent" href="{{ asset('admin/organizacions') }}"><i class="mr-2 fas fa-building"></i>
            <span>Organización</span></a>
        <a class="btn-silent" href="{{ asset('admin/sedes/organizacion') }}"><i
                class="mr-2 fas fa-map-marked-alt "></i> <span>Sedes</span></a>
        <a href="{{ route('admin.areas.renderJerarquia') }}" class="btn-silent">
            <i class="fab fa-adn iconos_menu mr-2"></i>
            <span>Áreas</span>
        </a>
        <a href="{{ route('admin.procesos.mapa') }}" class="btn-silent">
            <i class="fas fa-dice-d20 iconos_menu mr-2"></i>
            <span> Mapa de procesos </span>
        </a>
        <a class="btn-silent" href="{{ asset('admin/organigrama') }}"><i class="mr-2 fas fa-sitemap"></i>
            <span>Organigrama</span></a>
        <a class="btn-silent" href="{{ asset('admin/directorio') }}"><i class=" mr-2 fas fa-address-book"></i>
            <span>Directorio</span></a>
        <a class="btn-silent" href="{{ asset('admin/documentos/publicados') }}"><i class="mr-2 fas fa-folder"></i>
            <span>Documentos</span></a>
        <a class="btn-silent" href="{{ asset('admin/politica-sgsis/visualizacion') }}"><i
                class="mr-2 fas fa-file"></i> <span>Política SGSI</span></a>
        <a class="btn-silent" href="{{ asset('admin/comiteseguridads/visualizacion') }}"><i
                class="mr-2 fas fa-users"></i> <span>Comité del SGSI</span></a>

        @if ($empleado_asignado)
            <a class="btn-silent" href="{{ asset('admin/portal-comunicacion/reportes') }}"><i
                    class="mr-2 fas fa-hand-paper"></i> <span>Reportar</span></a>
        @endif

    </div>
    <div class="mt-5 col-lg-12">
        <div class="cuadro_empleados scroll_estilo">
            <h2 class="titulo-seccion"><i class="mr-3 far fa-user"></i>Nuevos ingresos</h2>
            <div class="caja_nuevo">
                @forelse($nuevos as $nuevo)
                    <div class="nuevo">
                        <div class="img_nuevo">
                            <img src="{{ asset('storage/empleados/imagenes/' . $nuevo->avatar) }}"
                                class="img_empleado">
                        </div>
                        <h5 class="nombre_nuevo">{{ $nuevo->name }}</h5>
                        <div class="datos_nuevo">
                            <p>{{ $nuevo->puesto }}<br>
                                @if (is_null($nuevo->area->area))
                                    No hay Area
                                @else
                                    {{ $nuevo->area->area }}
                                @endif
                            </p>
                            <h6 class="mt-3">Fecha de ingreso</h6>
                            <span>{{ \Carbon\Carbon::parse($nuevo->antiguedad)->format('d-m-Y') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="nuevo">No hay nuevos ingresos registrados en este mes.</div>
                @endforelse

            </div>

            <h2 class="mt-5 titulo-seccion"><i class="mr-3 fas fa-birthday-cake"></i>Cumpleaños</h2>
            <div class="caja_nuevo">
                @forelse($cumpleaños as $cumple)
                    <div class="nuevo">
                        <div class="img_nuevo">
                            @foreach ($nuevos as $nuevo)
                                <img src="{{ asset('storage/empleados/imagenes/' . $nuevo->avatar) }}"
                                    class="img_empleado">
                            @endforeach
                        </div>
                        <h5 class="nombre_nuevo">{{ $cumple->name }}</h5>
                        <div class="datos_nuevo">
                            <p>{{ $cumple->puesto }}<br>
                                @if (is_null($cumple->area->area))
                                    No hay Area
                                @else
                                    {{ $cumple->area->area }}
                                @endif
                            </p>
                            <h6 class="mt-3">Fecha de cumpleaños</h6>
                            @php
                                $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                                $fecha = \Carbon\Carbon::createFromFormat('Y-m-d', $cumple->cumpleaños);
                                $mes = $meses[$fecha->format('n') - 1];
                                $inputs['Fecha'] = $fecha->format('d') . ' de ' . $mes;
                            @endphp

                            <span>{{ $inputs['Fecha'] }}</span>

                            @php
                                $cumpleaños_felicitados_like_contador = App\Models\FelicitarCumpleaños::where('cumpleañero_id', $cumple->id)
                                    ->where('felicitador_id', auth()->user()->empleado->id)
                                    ->whereYear('created_at', $hoy->format('Y'))
                                    ->where('like', true)
                                    ->count();

                                $cumpleaños_felicitados_like = App\Models\FelicitarCumpleaños::select('id', 'felicitador_id', 'created_at', 'created_at')
                                    ->where('cumpleañero_id', $cumple->id)
                                    ->where('felicitador_id', auth()->user()->empleado->id)
                                    ->whereYear('created_at', $hoy->format('Y'))
                                    ->where('like', true)
                                    ->first();

                                $cumpleaños_felicitados_comentarios_contador = App\Models\FelicitarCumpleaños::where('cumpleañero_id', $cumple->id)
                                    ->where('felicitador_id', auth()->user()->empleado->id)
                                    ->whereYear('created_at', $hoy->format('Y'))
                                    ->where('like', false)
                                    ->where('comentarios', '!=', null)
                                    ->count();

                                $cumpleaños_felicitados_comentarios = App\Models\FelicitarCumpleaños::where('cumpleañero_id', $cumple->id)
                                    ->where('felicitador_id', auth()->user()->empleado->id)
                                    ->whereYear('created_at', $hoy->format('Y'))
                                    ->where('like', false)
                                    ->where('comentarios', '!=', null)
                                    ->first();
                            @endphp
                            <div class="opciones_felicitar">
                                @if ($cumpleaños_felicitados_like_contador == 0)
                                    <button style="all:unset;" wire:click="felicitarCumpleaños({{ $cumple->id }})"><i
                                            class="far fa-thumbs-up" style="color:#888;"></i>
                                        <font style="color:#888;">{{ $cumpleaños_felicitados_like_contador }}</font>
                                    </button>
                                @else
                                    <button style="all:unset;"
                                        wire:click="felicitarCumpleañosDislike({{ $cumpleaños_felicitados_like->id }})"><i
                                            class="fas fa-thumbs-up"></i>
                                        <font style="color:#00abb2;">{{ $cumpleaños_felicitados_like_contador }}
                                        </font>
                                    </button>
                                @endif
                                <i class="fas fa-comment-dots" data-toggle="modal"
                                    data-target="#cumpleaños_comentarios_Modal_{{ $cumple->id }}"></i>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="cumpleaños_comentarios_Modal_{{ $cumple->id }}" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">

                                    <label>Comentarios {{ $cumple->id }}</label>
                                    @if ($cumpleaños_felicitados_comentarios_contador == 0)
                                        <form wire:submit.prevent="felicitarCumplesComentarios({{ $cumple->id }})">
                                            <div class="form-group">
                                                <textarea wire:model="comentarios" class="form-control"></textarea>sin
                                                comntes
                                            @else
                                                <form
                                                    wire:submit.prevent="felicitarCumplesComentariosUpdate({{ $cumpleaños_felicitados_comentarios->id }})">
                                                    @csrf
                                                    <div class="form-group">
                                                        <textarea wire:model="comentarios_update"
                                                            class="form-control">{{ $cumpleaños_felicitados_comentarios->comentarios }}</textarea>con
                                                        coments
                                    @endif

                                </div>
                                <button type="submit" class="btn btn-success">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        @empty
            <div class="nuevo">No hay cumpleaños registrados en este mes.</div>
            @endforelse
        </div>

        <h2 class="mt-5 titulo-seccion"><i class="mr-3 fas fa-medal"></i>Aniversarios</h2>
        <div class="caja_nuevo">
            <div class="caja_nuevo">
                @forelse($aniversarios as $aniversario)

                    @if (\Carbon\Carbon::parse($aniversario->antiguedad)->format('Y') < $hoy->format('Y'))
                        <div class="nuevo">
                            <div class="img_nuevo">
                                @foreach ($nuevos as $nuevo)
                                    <img src="{{ asset('storage/empleados/imagenes/' . $nuevo->avatar) }}"
                                        class="img_empleado">
                                @endforeach
                            </div>
                            <h5 class="nombre_nuevo">{{ $aniversario->name }}</h5>
                            <div class="datos_nuevo">
                                <p>{{ $aniversario->puesto }}<br>
                                    @if (is_null($aniversario->area->area))
                                        No hay Area
                                    @else
                                        {{ $aniversario->area->area }}
                                    @endif
                                </p>
                                <h6 class="mt-3">Antigüedad</h6>
                                <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($aniversario->antiguedad))->diffInYears() }}
                                    año(s)
                                </span>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="nuevo">No hay aniversarios registrados en este mes.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>
