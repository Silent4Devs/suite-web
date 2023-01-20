<div>
    <style>
        @keyframes eye {
            0% {
                transform: scale(.75);
            }

            20% {
                transform: scale(1);
            }

            40% {
                transform: scale(.75);
            }

            60% {
                transform: scale(1);
            }

            80% {
                transform: scale(.75);
            }

            100% {
                transform: scale(.75);
            }
        }

        .text-orange {
            color: orange !important;
        }

        .mayus {
            text-transform: uppercase;
        }

        .text-yellow {
            color: #f4c272 !important;
        }

        .table-scroll {
            display: block;
            height: 300px;
            overflow-y: scroll;
        }

        .con {
            cursor: pointer;
        }

        .tarjetas_seguridad_indicadores {
            width: 100%;
            height: 80px;
            color: #fff;
            font-size: 15pt;
            border-radius: 6px;
        }

        .tarjetas_seguridad_indicadores i {
            position: relative;
            font-size: 20pt;
            margin-right: 10px;
        }

        .far.fa-circle:after {
            content: "-";
            position: absolute;
            top: -18%;
            left: 33%;
            transform: scale(1.3);
        }

        .tarjetas_seguridad_indicadores div {
            width: 100%;
            text-align: center;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .numero {
            font-size: 20pt;
        }

        .botones_tabla {
            width: 100%;
            display: flex;
        }

    </style>


    <div class="pb-4 row">
        @if (count($mapas))
            <div class="col-md-3">
                <p class="text-xl text-gray-700">Análisis de riesgo:</p>
                <select class="form-control" wire:model="id_analisis">
                    <option value="" selected disabled>Seleccione una opción</option>
                        @foreach ($mapas as $mapa)
                        <option value="{{ $mapa?$mapa['id']:0}}">{{ $mapa?$mapa['nombre']:'' }}</option>
                        @endforeach
                </select>
            </div>
        @endif
        <div class="col-md-3">
            <p class="text-xl text-gray-700">Sede:</p>
            <select class="form-control" wire:model.debounce.500ms="sede_id">
                <option value="" selected disabled>Seleccione una sede</option>
                @foreach ($sedes as $sede)
                    <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <p class="text-xl text-gray-700">Area:</p>
            <select class="form-control" wire:model.debounce.500ms="area_id">
                <option value="" selected disabled>Seleccione un área</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                @endforeach
            </select>
        </div>
        @if(!count($mapas))
            <div class="col-md-3">
                <p class="text-xl text-gray-700">Proceso:</p>
                <select class="form-control" wire:model="proceso_id">
                    <option value="" selected disabled>Seleccione una proceso</option>
                    @foreach ($procesos as $proceso)
                        <option value="{{ $proceso->id }}">{{ $proceso->nombre }}</option>
                    @endforeach
                </select>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="py-2 d-flex justify-content-between">
                <label class="text-primary" style="font-size: 24px;">Total Riesgos Iniciales</label>
                <button class="btn btn-primary btn-sm" wire:click="clean">Ver todo</button>
            </div>
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="tarjetas_seguridad_indicadores"
                        style="background: linear-gradient(144deg, rgba(56, 198, 67, 1) 34%, rgba(57, 255, 220, 1) 100%);">
                        <div class="numero"><i class="fas fa-exclamation-triangle iconos_menu letra_blanca"></i>
                            {{ $bajos }}</div>
                        <div>Bajo(s)</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="tarjetas_seguridad_indicadores"
                        style="background: linear-gradient(144deg, rgba(239, 209, 0, 1) 33%,rgba(255, 255, 0, 1) 100%) ;">
                        <div class="numero"><i
                                class="fas fa-exclamation-triangle iconos_menu letra_blanca"></i>{{ $medios }}
                        </div>
                        <div>Medio(s)</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 ">
                    <div class="tarjetas_seguridad_indicadores"
                        style="background: linear-gradient(144deg, rgba(255, 115, 0, 1) 33%, rgba(237, 255, 86, 1) 100%);">
                        <div class="numero"><i
                                class="fas fa-exclamation-triangle iconos_menu letra_blanca"></i>{{ $altos }}
                        </div>
                        <div>Alto(s)</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="tarjetas_seguridad_indicadores"
                        style="background: linear-gradient(144deg, rgba(255, 61, 61, 1) 33%, rgba(255, 86, 223, 1) 100%);">
                        <div class="numero"><i
                                class="fas fa-exclamation-triangle iconos_menu letra_blanca"></i>{{ $muy_altos }}
                        </div>
                        <div>Muy alto(s) </div>
                    </div>
                </div>
            </div>
            <hr>
            <div wire:loading>
                <div class="spinner-grow text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-secondary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-success" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-danger" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-warning" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-info" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-light" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-grow text-dark" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <strong>Cargando...</strong>
            </div>
            <div class="calor">
                <div class="datosCalor">
                    <label class="text-primary" style="font-size: 20px;">Riesgo inicial</label>
                    <table class="table table-hover table-scroll">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Riesgo</th>
                                <th scope="col">Probabilidad</th>
                                <th scope="col">Impacto</th>
                                <th scope="col">Nivel riesgo</th>
                            </tr>
                        </thead>
                        @foreach ($listados as $listado)
                            <tr class="con">
                                <td>{{ $listado->id }}</td>
                                <td data-toggle="tooltip" data-placement="top" title="Pulse aquí para más información">
                                    <a target="_blank"
                                        href="{{ route('admin.matriz-riesgos.show', [$listado->id]) }}">{{ wordwrap($listado->descripcionriesgo, 10, "\n", true) }}</a>
                                </td>
                                <td>{{ $listado->probabilidad }}</td>
                                <td>{{ $listado->impacto }}</td>
                                <td>
                                    @switch($listado->nivelriesgo)
                                        @case(0)
                                            <span class="text-green mayus">Baja ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(9)
                                            <span class="text-yellow mayus">Media ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(18)
                                            <span class="text-yellow mayus">Alta ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(27)
                                            <span class="text-orange mayus">Muy Alta
                                                ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(36)
                                            <span class="text-danger mayus">Alta ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(54)
                                            <span class="text-danger mayus">Muy Alta
                                                ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @case(81)
                                            <span class="text-danger mayus">Muy Alta
                                                ({{ $listado->nivelriesgo }})</span>
                                        @break
                                        @default
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="mapaCalor">
                    <div>
                        <div class="txtVertical text-primary font-weight-bold"
                            style="position:absolute; margin-top: 20px;font-size: 20px; margin-left: 15px;">Impacto
                        </div>
                        <table>
                            <tr>
                                <td>Muy Alto</td>
                                <td class="amarillo" id="s_baja_p_muyAlta" wire:click="callQuery(0 , '1')">
                                    @if ($changer == '1')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $nula_muyalto }}
                                    @endif
                                </td>
                                <td class="naranja" id="s_media_p_muyAlta" wire:click="callQuery(27, '2')">
                                    @if ($changer == '2')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $baja_muyalto }}
                                    @endif
                                </td>
                                <td class="rojo" id="s_alta_p_muyAlta" wire:click="callQuery(54, '3')">
                                    @if ($changer == '3')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $media_muyalto }}
                                    @endif
                                </td>
                                <td class="rojo" id="s_muyAlta_p_muyAlta" wire:click="callQuery(81, '4')">
                                    @if ($changer == '4')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $alta_muyalto }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Alto</td>
                                <td class="amarillo" id="s_baja_p_alta" wire:click="callQuery(0, '5')">
                                    @if ($changer == '5')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $nula_alto }}
                                    @endif
                                </td>
                                <td class="amarillo" id="s_media_p_alta" wire:click="callQuery(18, '6')">
                                    @if ($changer == '6')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $baja_alto }}
                                    @endif
                                </td>
                                <td class="naranja" id="s_alta_p_alta" wire:click="callQuery(36, '7')">
                                    @if ($changer == '7')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $media_alto }}
                                    @endif
                                </td>
                                <td class="rojo" id="s_muyAlta_p_alta" wire:click="callQuery(54, '8')">
                                    @if ($changer == '8')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $alta_alto }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Medio</td>
                                <td class="verde" id="s_baja_p_media" wire:click="callQuery(0, '9')">
                                    @if ($changer == '9')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $nula_medio }}
                                    @endif
                                </td>
                                <td class="amarillo" id="s_media_p_media" wire:click="callQuery(9, '10')">
                                    @if ($changer == '10')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $baja_medio }}
                                    @endif
                                </td>
                                <td class="amarillo" id="s_alta_p_media" wire:click="callQuery(18, '11')">
                                    @if ($changer == '11')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $media_medio }}
                                    @endif
                                </td>
                                <td class="naranja" id="s_muyAlta_p_media" wire:click="callQuery(27, '12')">
                                    @if ($changer == '12')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $alta_medio }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Bajo</td>
                                <td class="verde" id="s_baja_p_baja" wire:click="callQuery(0, '13')">
                                    @if ($changer == '13')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $nula_bajo }}
                                    @endif
                                </td>
                                <td class="verde" id="s_media_p_baja" wire:click="callQuery(0, '14')">
                                    @if ($changer == '14')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $baja_bajo }}
                                    @endif
                                </td>
                                <td class="amarillo" id="s_alta_p_baja" wire:click="callQuery(0, '15')">
                                    @if ($changer == '15')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $media_bajo }}
                                    @endif
                                </td>
                                <td class="amarillo" id="s_muyAlta_p_baja" wire:click="callQuery(0, '16')">
                                    @if ($changer == '16')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $alta_bajo }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Bajo</td>
                                <td>Medio</td>
                                <td>Alto</td>
                                <td>Muy Alto</td>
                            </tr>
                        </table>
                        <div class="txtHorizontal text-primary font-weight-bold"
                            style="margin-left: 250px; font-size: 20px;">Probabilidad</div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-12">
            <label class="text-primary" style="font-size: 24px;">Total Riesgos Residuales</label>
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="tarjetas_seguridad_indicadores"
                        style="background: linear-gradient(144deg, rgba(56, 198, 67, 1) 34%, rgba(57, 255, 220, 1) 100%);">
                        <div class="numero"><i class="fas fa-exclamation-triangle iconos_menu letra_blanca"></i>
                            {{ $bajos_residual }}</div>
                        <div>Bajo(s)</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="tarjetas_seguridad_indicadores"
                        style="background: linear-gradient(144deg, rgba(239, 209, 0, 1) 33%,rgba(255, 255, 0, 1) 100%) ;">
                        <div class="numero"><i
                                class="fas fa-exclamation-triangle iconos_menu letra_blanca"></i>{{ $medios_residual }}
                        </div>
                        <div>Medio(s)</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 ">
                    <div class="tarjetas_seguridad_indicadores"
                        style="background: linear-gradient(144deg, rgba(255, 115, 0, 1) 33%, rgba(237, 255, 86, 1) 100%);">
                        <div class="numero"><i
                                class="fas fa-exclamation-triangle iconos_menu letra_blanca"></i>{{ $altos_residual }}
                        </div>
                        <div>Alto(s)</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="tarjetas_seguridad_indicadores"
                        style="background: linear-gradient(144deg, rgba(255, 61, 61, 1) 33%, rgba(255, 86, 223, 1) 100%);">
                        <div class="numero"><i
                                class="fas fa-exclamation-triangle iconos_menu letra_blanca"></i>{{ $muy_altos_residual }}
                        </div>
                        <div>Muy alto(s) </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="calor">
                <div class="datosCalor">
                    <label class="text-primary" style="font-size: 20px;">Riesgo residual</label>
                    <table class="table table-hover table-scroll">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Riesgo</th>
                                <th scope="col">Probabilidad</th>
                                <th scope="col">Impacto</th>
                                <th scope="col">Nivel riesgo</th>
                            </tr>
                        </thead>
                        @foreach ($listados_residual as $listado)
                            <tr class="con">
                                <td>{{ $listado->id }}</td>
                                <td data-toggle="tooltip" data-placement="top" title="Pulse aquí para más información">
                                    <a target="_blank"
                                        href="{{ route('admin.matriz-riesgos.show', [$listado->id]) }}">{{ wordwrap($listado->descripcionriesgo, 10, "\n", true) }}</a>
                                </td>
                                <td>{{ $listado->probabilidad_residual }}</td>
                                <td>{{ $listado->impacto_residual }}</td>
                                <td>
                                    @switch($listado->nivelriesgo_residual)
                                        @case(0)
                                            <span class="text-green mayus">Baja
                                                ({{ $listado->nivelriesgo_residual }})</span>
                                        @break
                                        @case(9)
                                            <span class="text-yellow mayus">Media
                                                ({{ $listado->nivelriesgo_residual }})</span>
                                        @break
                                        @case(18)
                                            <span class="text-yellow mayus">Alta
                                                ({{ $listado->nivelriesgo_residual }})</span>
                                        @break
                                        @case(27)
                                            <span class="text-orange mayus">Muy Alta
                                                ({{ $listado->nivelriesgo_residual }})</span>
                                        @break
                                        @case(36)
                                            <span class="text-danger mayus">Alta
                                                ({{ $listado->nivelriesgo_residual }})</span>
                                        @break
                                        @case(54)
                                            <span class="text-danger mayus">Muy Alta
                                                ({{ $listado->nivelriesgo_residual }})</span>
                                        @break
                                        @case(81)
                                            <span class="text-danger mayus">Muy Alta
                                                ({{ $listado->nivelriesgo_residual }})</span>
                                        @break
                                        @default
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                <div class="mapaCalor">
                    <div>
                        <div class="txtVertical text-primary font-weight-bold"
                            style="position:absolute; margin-top: 20px;font-size: 20px; margin-left: 15px;">Impacto
                        </div>
                        <table>
                            <tr>
                                <td>Muy Alto</td>
                                <td class="amarillo" id="s_baja_p_muyAlta" wire:click="callQueryResidual(0 , '1')">
                                    @if ($changer_residual == '1')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $nula_muyalto_r }}
                                    @endif
                                </td>
                                <td class="naranja" id="s_media_p_muyAlta" wire:click="callQueryResidual(27, '2')">
                                    @if ($changer_residual == '2')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $baja_muyalto_r }}
                                    @endif
                                </td>
                                <td class="rojo" id="s_alta_p_muyAlta" wire:click="callQueryResidual(54, '3')">
                                    @if ($changer_residual == '3')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $media_muyalto_r }}
                                    @endif
                                </td>
                                <td class="rojo" id="s_muyAlta_p_muyAlta" wire:click="callQueryResidual(81, '4')">
                                    @if ($changer_residual == '4')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $alta_muyalto_r }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Alto</td>
                                <td class="amarillo" id="s_baja_p_alta" wire:click="callQueryResidual(0, '5')">
                                    @if ($changer_residual == '5')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $nula_alto_r }}
                                    @endif
                                </td>
                                <td class="amarillo" id="s_media_p_alta" wire:click="callQueryResidual(18, '6')">
                                    @if ($changer_residual == '6')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $baja_alto_r }}
                                    @endif
                                </td>
                                <td class="naranja" id="s_alta_p_alta" wire:click="callQueryResidual(36, '7')">
                                    @if ($changer_residual == '7')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $media_alto_r }}
                                    @endif
                                </td>
                                <td class="rojo" id="s_muyAlta_p_alta" wire:click="callQueryResidual(54, '8')">
                                    @if ($changer_residual == '8')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $alta_alto_r }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Medio</td>
                                <td class="verde" id="s_baja_p_media" wire:click="callQueryResidual(0, '9')">
                                    @if ($changer_residual == '9')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $nula_medio_r }}
                                    @endif
                                </td>
                                <td class="amarillo" id="s_media_p_media" wire:click="callQueryResidual(9, '10')">
                                    @if ($changer_residual == '10')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $baja_medio_r }}
                                    @endif
                                </td>
                                <td class="amarillo" id="s_alta_p_media" wire:click="callQueryResidual(18, '11')">
                                    @if ($changer_residual == '11')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $media_medio_r }}
                                    @endif
                                </td>
                                <td class="naranja" id="s_muyAlta_p_media" wire:click="callQueryResidual(27, '12')">
                                    @if ($changer_residual == '12')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $alta_medio_r }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Bajo</td>
                                <td class="verde" id="s_baja_p_baja" wire:click="callQueryResidual(0, '13')">
                                    @if ($changer_residual == '13')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $nula_bajo_r }}
                                    @endif
                                </td>
                                <td class="verde" id="s_media_p_baja" wire:click="callQueryResidual(0, '14')">
                                    @if ($changer_residual == '14')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $baja_bajo_r }}
                                    @endif
                                </td>
                                <td class="amarillo" id="s_alta_p_baja" wire:click="callQueryResidual(0, '15')">
                                    @if ($changer_residual == '15')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $media_bajo_r }}
                                    @endif
                                </td>
                                <td class="amarillo" id="s_muyAlta_p_baja" wire:click="callQueryResidual(0, '16')">
                                    @if ($changer_residual == '16')
                                        <i class="fas fa-eye" id="eye"></i>
                                    @else
                                        {{ $alta_bajo_r }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Bajo</td>
                                <td>Medio</td>
                                <td>Alto</td>
                                <td>Muy Alto</td>
                            </tr>
                        </table>
                        <div class="txtHorizontal text-primary font-weight-bold"
                            style="margin-left: 250px; font-size: 20px;">Probabilidad</div>
                    </div>
                </div>
            </div>

        </div>
        <a href="{{ route('admin.matriz-seguridad', ['id' => $id_analisis]) }}" class="btn btn-danger">Cerrar</a>
    </div>

</div>
