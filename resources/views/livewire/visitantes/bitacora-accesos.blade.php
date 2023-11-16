<div>
    <style>
        table.table thead {
            background: #eaedff !important;
            color: #848586 !important;
        }

        table {
            border-radius: 10px;
        }

        @media print {
            .print-block {
                display: grid !important;
            }

            header {
                display: none !important;
            }

            .ps__rail-y {
                display: none !important;
            }

            .ps__thumb-y {
                display: none !important;
            }

            .titulo_general_funcion {
                display: none !important;
            }

            #sidebar {
                display: none !important;
            }

            body {
                background-color: #fff !important;
            }

            #but {
                display: none !important;
            }

            .datos_der_cv {
                margin-right: -50px !important;
            }

            .table th td:nth-child(1) {
                min-width: 100px;
                color: white !important;
            }

            thead {
                color: white !important;
            }

            .print-none {
                display: none !important;
                color: white !important;
            }

            table.table thead {
                background: #eaedff !important;
                color: #848586 !important;
            }

            table {
                border-radius: 10px;
            }


        }
    </style>
    <x-loading-indicator />
    @php
        use App\Models\Area;
        if ($area) {
            $area_model = Area::select('id', 'area')->find($area);
        }
    @endphp
    @php
        use App\Models\Empleado;
        if ($colaborador) {
            $empleado_model = Empleado::select('id', 'name')->find($colaborador);
        }
    @endphp
    @php
        use App\Models\Organizacion;
        $organizacion = Organizacion::getFirst();
        $logotipo = $organizacion->logotipo;
        $empresa = $organizacion->empresa;
    @endphp

    <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px;">
        <div class="col-2 p-2" style="border-right: 2px solid #ccc">
            <img src="{{ asset($logotipo) }}" class="mt-2" style="width:90px;">
        </div>
        <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
            <span style="font-size:13px; text-transform: uppercase;color:#345183;">{{ $empresa }}</span>
            <br>
            <span style="color:#345183; font-size:15px;"><strong>Bitácora de Accesos</strong></span>
        </div>
        <div class="col-3 p-2">
            <span style="color:#345183;">Fecha:
                {{ \Carbon\Carbon::now()->format('d-m-Y h:i A') }}
            </span>
        </div>
    </div>

    @if ($tipoVista == 'bitacora')
        <div class="row print-none" x-data="{ show: true }">
            <div class="col-12">
                SECCIÓN DE FILTROS AVANZADOS <i style="cursor: pointer"
                    x-bind:class="show ? 'fas fa-minus' : 'fas fa-plus'" x-on:click="show=!show"></i>
            </div>
            <div class="col-12" x-show="show" x-transition>
                <div class="row">
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <i class="fas fa-filter mr-2"></i> Filtros
                            </div>
                            <div class="col-6">
                                <select wire:model="colaborador" class="custom-select" name=""
                                    id="" style="position: relative">
                                    <option value="" disabled selected>Filtrar por colaborador visitado</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                                    @endforeach
                                </select>
                                <i title="Limpiar Filtro" class="fas fa-times-circle"
                                    wire:click="limpiarFiltro('colaborador')"
                                    style="position:  absolute;top:0; right:4px; cursor: pointer;"></i>
                            </div>
                            <div class="col-6">
                                <select wire:model="area" class="custom-select" name="" id=""
                                    style="position: relative">
                                    <option value="" disabled selected>Filtrar por área visitada</option>
                                    @foreach ($areas as $area_it)
                                        <option value="{{ $area_it->id }}">{{ $area_it->area }}</option>
                                    @endforeach
                                </select>
                                <i title="Limpiar Filtro" class="fas fa-times-circle" wire:click="limpiarFiltro('area')"
                                    style="position:  absolute;top:0; right:4px; cursor: pointer;"></i>
                            </div>
                            <div class="col-12 mt-2 mb-2">
                                <input style="position: relative" wire:model="rangoFechas" class="form-control"
                                    type="text" id="rangoFechas" placeholder="Filtrar por rango de fechas" readonly
                                    wire:ignore>
                                <i title="Limpiar Filtro" class="fas fa-times-circle"
                                    wire:click="limpiarFiltro('rangoFechas')"
                                    style="position:  absolute;top:0; right:4px; cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <i class="fas fa-filter mr-2"></i> Opciones
                            </div>
                            <div class="col-12 mb-2">
                                <button class="btn btn-success" wire:click.prevent="search">
                                    <i class="fas fa-search"></i> Realizar Búsqueda
                                </button>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success" wire:click.prevent="default"
                                    style="background: #a7a7a7 !important">
                                    <i class="fas fa-times"></i> Resetear Valores&nbsp;&nbsp;&nbsp;
                                </button>
                            </div>
                        </div>
                        {{-- Code... --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-xl-6 col-md-12">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total de Visitantes</h5>
                                <span class="h2 font-weight-bold mb-0">{{ $total }}</span>
                            </div>
                            <div class="col-auto print-none">

                                <i class="fas fa-users text-dark" style="font-size: 45px;padding: 5px"></i>

                            </div>
                        </div>
                        @if ($fechaInicio)
                            <p class="mt-0 mb-0 text-sm">
                                <span class="text-nowrap">Desde el {{ $fechaInicio }} al {{ $fechaFin }}</span>
                            </p>
                        @endif
                        @if ($area)
                            <p class="mt-0 mb-0 text-sm">
                                <span class="text-nowrap">Con respecto a visitar el área:
                                    {{ $area_model->area }}</span>
                            </p>
                        @endif
                        @if ($colaborador)
                            <p class="mt-0 mb-0 text-sm">
                                <span class="text-nowrap">Con respecto a visitar a {{ $empleado_model->name }}</span>
                            </p>
                        @endif
                        @if ($search)
                            <p class="mt-0 mb-0 text-sm">
                                <span class="text-nowrap">Que contenga la búsqueda "{{ $search }}"</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    @endif
    <div class="row mt-2">
        <div class="col-6">
            <div class="row print-none">
                <div class="col-3">
                    <label for="perPage">Por página</label>
                    <select class="custom-select" name="" id="perPage" wire:model.live="perPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="-1">Todo</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row print-none">
                <div class="col-8"></div>
                <div class="col-4" style="text-align: end">
                    <label for="search"><i class="fas fa-search"></i> Buscar</label>
                    <input type="text" class="form-control" id="search" wire:model.live="search">
                </div>
            </div>
        </div>
        <div class="col-6 mt-4" style="color: #848586;">
            <p class="print-none">
                <span wire:click="exportarExcel" class="p-2"
                    style="border: 1px solid #848586;border-radius: 10px; cursor: pointer;"><i
                        class="fas fa-file-excel"></i> Exportar a Excel</span>
                <span onclick="print()" class="p-2"
                    style="border: 1px solid #848586;border-radius: 10px; cursor: pointer;"><i
                        class="fas fa-print"></i> Imprimir</span>
            </p>
        </div>
        <div class="col-6 mt-4" style="text-align: end">
            <p>{{ $textoFiltro }}</p>
        </div>
    </div>
    <table class="table table-responsive w-100">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre(s)</th>
                <th>Apellido(s)</th>
                <th>Dispositivos</th>
                <th>Motivo</th>
                <th>Visita</th>
                <th>Fecha de Entrada</th>
                <th>Hora de Entrada</th>
                <th>Fecha de Salida</th>
                <th>Hora de Salida</th>
                <th>Firma</th>
                @if ($tipoVista == 'autorizar')
                    <th>Opciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($visitantes as $visitante)
                <tr>
                    <td>
                        <img src="{{ $visitante->foto ? $visitante->foto : asset('assets/user.png') }}"
                            style="clip-path: circle();" width="50px" height="50px"
                            alt="{{ $visitante->nombre }}">
                    </td>
                    <td>{{ $visitante->nombre }}</td>
                    <td>{{ $visitante->apellidos }}</td>
                    <td>
                        @if ($visitante->dispositivos->count() > 0)
                            @foreach ($visitante->dispositivos as $item)
                                <p class="m-0">
                                    <strong>Dispositivo: </strong> {{ $item->dispositivo }}
                                </p>
                                <p class="m-0">
                                    <strong>Serie: </strong> {{ $item->serie }}
                                </p>
                                @if (!$loop->last)
                                    <hr style="1px solid red !important" class="my-1">
                                @endif
                            @endforeach
                        @else
                            Sin dispositivos registrados
                        @endif
                    </td>
                    <td>{{ $visitante->motivo }}</td>
                    <td>
                        @if ($visitante->tipo_visita == 'persona')
                            <p>{{ $visitante->empleado ? $visitante->empleado->name : 'N/A' }}</p>
                        @else
                            <p>{{ $visitante->area ? $visitante->area->area : 'N/A' }}</p>
                        @endif
                    </td>
                    <td>{{ $visitante->created_at->format('d-m-Y') }}</td>
                    <td>{{ $visitante->created_at->format('h:i A') }}</td>
                    <td>{{ $visitante->fecha_salida ? \Carbon\Carbon::parse($visitante->fecha_salida)->format('d-m-Y') : 'N/A' }}
                    <td>{{ $visitante->fecha_salida ? \Carbon\Carbon::parse($visitante->fecha_salida)->format('h:i A') : 'N/A' }}
                    </td>
                    <td>
                        @if ($visitante->firma)
                            <img width="50px" height="50px" src="{{ $visitante->firma }}" alt="firma">
                        @else
                            N/A
                        @endif
                    </td>
                    @if ($tipoVista == 'autorizar')
                        <td>
                            @if ($visitante->registro_salida)
                                <i class="fas fa-check text-success"
                                    wire:click.prevent="autorizarSalida('{{ $visitante->id }}')"></i>
                            @else
                                N/A
                            @endif
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No hay registros</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="row">
        <div class="col-12" style="text-align: end;justify-content: end;align-items: center;display: flex;">
            {{ $visitantes->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $("#rangoFechas").flatpickr({
                mode: "range",
                dateFormat: "Y-m-d",
            });

        })
    </script>
</div>
