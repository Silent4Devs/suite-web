<div class="form-group col-12">
    <div class="row">
        <div class="form-group col-sm-12 col-md-6 col-lg-6">
            <label for="proceso_id"> <i class="far fa-calendar-alt iconos-crear"></i>Proceso</label>
            <select class="form-control" id="proceso_id" name="proceso_id" wire:model="procesoId">
                <option value="">-- Seleccionar Proceso --</option>
                @foreach ($procesos as $proceso)
                    <option value="{{ $proceso->id }}">{{ $proceso->proceso->codigo }}- {{ $proceso->proceso->nombre }}
                    </option>
                @endforeach

            </select>

        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-6">
            <label for="fecharegistro"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha y hora de
                levantamiento</label>
            <input class="form-control date {{ $errors->has('fecharegistro') ? 'is-invalid' : '' }}"
                type="datetime-local" name="fecharegistro" id="fecharegistro" value="{{ old('fecharegistro') }}">
            @if ($errors->has('fecharegistro'))
                <div class="invalid-feedback">
                    {{ $errors->first('fecharegistro') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row" >
        <div class="form-group col-md-6">
            <label for="valor_criticidad"><i class="fas fa-exclamation-triangle iconos-crear"></i>Impacto del riesgo
                evaluado</label>
            <div class="form-control" id="valorCriticidadTxt" style="text-align: center;"> {{ $impacto }}</div>
        </div>
        <div class="form-group col-md-6">
            <label for="valor_probabilidad"><i class="fas fa-exclamation-triangle iconos-crear"></i>Probabilidad del
                riesgo evaluado</label>
            <div class="form-control" id="valor_probabilidad"></div>
        </div>
    </div>

    <table class="table w-100 mt-4 " id="contactos_table" style="width:100%">
        <thead>

            <tr>
                <th>Probabilidad</th>
                <th>1.Muy Bajo</th>
                <th>2.Bajo</th>
                <th>3.Medio</th>
                <th>4.Alto</th>
                <th>5.Crítico</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    5. Muy probable
                </td>
                <td style="background-color:rgb(240, 240, 150); text-align:center !important;" class="coordenada-1-5">
                    Medio (5)
                </td>
                <td style="background-color:rgb(255, 194, 124);text-align:center !important;" class="coordenada-2-5">
                    Alto (10)
                </td>
                <td style="background-color:rgb(255, 194, 124);text-align:center !important;" class="coordenada-3-5">
                    Alto (15)
                </td>
                <td style="background-color:rgb(228, 130, 130);text-align:center !important;"class="coordenada-4-5">
                    Crítico (20)
                </td>
                <td style="background-color:rgb(228, 130, 130);text-align:center !important;"class="coordenada-5-5">
                    Crítico (25)
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td>
                    4. Probable
                </td>
                <td style="background-color:rgb(240, 240, 150); text-align:center !important;" class="coordenada-1-4">
                    Medio (4)
                </td>
                <td style="background-color:rgb(240, 240, 150); text-align:center !important;" class="coordenada-2-4">
                    Medio (8)
                </td>
                <td style="background-color:rgb(255, 194, 124); text-align:center !important;" class="coordenada-3-4">
                    Alto (12)
                </td>
                <td style="background-color:rgb(255, 194, 124); text-align:center !important;" class="coordenada-4-4">
                    Alto (16)
                </td>
                <td style="background-color:rgb(228, 130, 130); text-align:center !important;" class="coordenada-5-4">
                    Crítico (20)
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td>
                    3. Posible
                </td>
                <td style="background-color:rgb(133, 236, 142); text-align:center !important;" class="coordenada-1-3">
                    Bajo (3)
                </td>
                <td style="background-color:rgb(240, 240, 150); text-align:center !important;" class="coordenada-2-3">
                    Medio (6)
                </td>
                <td style="background-color:rgb(240, 240, 150); text-align:center !important;" class="coordenada-3-3">
                    Medio (9)
                </td>
                <td style="background-color:rgb(255, 194, 124); text-align:center !important;" class="coordenada-4-3">
                    Alto (12)
                </td>
                <td style="background-color:rgb(255, 194, 124); text-align:center !important;" class="coordenada-5-3">
                    Alto (15)
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td>
                    2. Poco Probable
                </td>
                <td style="background-color:rgb(133, 236, 142); text-align:center !important;" class="coordenada-1-2">
                    Bajo (2)
                </td>
                <td style="background-color:rgb(133, 236, 142); text-align:center !important;" class="coordenada-2-2">
                    Bajo (4)
                </td>
                <td style="background-color:rgb(240, 240, 150); text-align:center !important;" class="coordenada-3-2">
                    Medio (6)
                </td>
                <td style="background-color:rgb(240, 240, 150); text-align:center !important;" class="coordenada-4-2">
                    Medio (8)
                </td>
                <td style="background-color:rgb(255, 194, 124); text-align:center !important;" class="coordenada-5-2">
                    Alto (10)
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td>
                    1. Improbable
                </td>
                <td style="background-color:rgb(103, 207, 111); text-align:center !important;" class="coordenada-1-1">
                    Muy Bajo (1)
                </td>
                <td style="background-color:rgb(133, 236, 142); text-align:center !important;" class="coordenada-2-1">
                    Bajo (2)
                </td>
                <td style="background-color:rgb(133, 236, 142); text-align:center !important;" class="coordenada-3-1">
                    Bajo (3)
                </td>
                <td style="background-color:rgb(240, 240, 150); text-align:center !important;" class="coordenada-4-1">
                    Medio (4)
                </td>
                <td style="background-color:rgb(240, 240, 150); text-align:center !important;" class="coordenada-5-1">
                    Medio (5)
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table w-100 mt-4 mb-4" id="contactos_externos_table" style="width:100%">
        <thead>
            <tr>
                <th colspan="2" class="text-center">Descripción</th>

            </tr>
        </thead>
        <tbody id="contenedor_contactos_externos">
            <tr>
                <th>Muy alto</th>
                <th style="background-color:rgb(240, 240, 150);">Riesgo catastrófico que puede afectar la permanencia
                    del n_registro
                    y que genera impactos graves.
                </th>
            </tr>
            <tr>
                <th>Alto</th>
                <th style="background-color:rgb(240, 240, 150);">Riesgo intolerable para la organización que genera
                    impactos relevantes.
                </th>
            </tr>
            <tr>
                <th>Medio</th>
                <th style="background-color:rgb(240, 240, 150);">Riesgo moderado para la organización que genera
                    impactos significativos.
                </th>
            </tr>
            <tr>
                <th>Bajo</th>
                <th style="background-color:rgb(240, 240, 150);">Riesgo tolerable para la organización que no genera
                    impactos significativos.
                </th>
            </tr>
            <tr>
                <th>Muy bajo</th>
                <th style="background-color:rgb(240, 240, 150);">Sin riesgo para la organización y no genera algún
                    impacto significativo.
                </th>
            </tr>
        </tbody>
    </table>

    <div class="col-12">
        <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
            1. Clasificación del Activo relacionado
        </div>
    </div>
    {{-- Tabla Clasificación del Activo --}}
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="min-width: 100px;">ID Activo</th>
                    <th scope="col" style="min-width: 400px;">Nombre</th>
                    <th scope="col" style="min-width: 150px;">Criticidad</th>
                    <th scope="col" style="min-width: 150px;">Confidencialidad</th>
                </tr>
            </thead>
            <tbody>
                @if (is_array($activos) || is_object($activos))
                    @foreach ($activos as $activo)
                        <tr>
                            <th scope="row">{{ $activo->identificador }}</th>
                            <td>{{ $activo->activo_informacion }}</td>
                            <td>{{ $activo->valor_criticidad }}</td>
                            <td>{{ $activo->confidencialidad_id }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="col-12">
        <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
            2. Evaluación del riesgo a Aceptar
        </div>
    </div>

    <div class="col-12">
        <div class="text-center form-group"
            style="background-color:#c8cfdb; border-radius: 100px; color: rgb(8, 8, 8);">
            Impacto del Riesgo
        </div>
    </div>
    {{-- Tabla Impacto del Riesgo --}}
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="min-width: 200px;">Criterio</th>
                    <th scope="col" style="min-width: 100x;">Valor</th>
                    <th scope="col" style="min-width: 400px;">Detalle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Impacto Legal</th>
                    <td>{{ $legal }}</td>
                    <td>{{ $legalTxt }}</td>
                </tr>
                <tr>
                    <th scope="row">Impacto Cumplimiento</th>
                    <td>{{ $cumplimiento }}</td>
                    <td>{{ $cumplimientoTxt }}</td>
                </tr>
                <tr>
                    <th scope="row">Impacto Operacional</th>
                    <td>{{ $operacional }}</td>
                    <td>{{ $operacionalTxt }}</td>
                </tr>
                <tr>
                    <th scope="row">Impacto Reputacional</th>
                    <td>{{ $reputacional }}</td>
                    <td>{{ $reputacionalTxt }}</td>
                </tr>
                <tr>
                    <th scope="row">Impacto Tecnológico</th>
                    <td>{{ $tecnologico }}</td>
                    <td>{{ $tecnologicoTxt }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-12">
        <div class="text-center form-group"
            style="background-color:#c8cfdb; border-radius: 100px; color: rgb(8, 8, 8);">
            Escenarios de Riesgo
        </div>
    </div>
    {{-- Tabla Escenarios de Riesgo --}}
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="min-width: 100px;">Escenario</th>
                    <th scope="col" style="min-width: 500x; ">Descripción</th>
                    <th scope="col" style="min-width: 70px; ">Confidencialidad</th>
                    <th scope="col" style="min-width: 70px; ">Disponibilidad</th>
                    <th scope="col" style="min-width: 70px; ">Integridad</th>
                </tr>
            </thead>
            <tbody>
                @if (is_array($escenarios) || is_object($escenarios))
                    @foreach ($escenarios as $escenario)
                        @foreach ($escenario as $e)
                        @php
                            if (isset($e->confidencialidad)) {
                            array_push($promedioConfidencialidad,$e->confidencialidad);
                            array_push($promedioDisponibilidad,$e->disponibilidad);
                            array_push($promedioIntegridad,$e->integridad);
                            }

                        @endphp
                            <tr>
                                <th scope="row" style="font-size: 8pt;">{{ $e->nom_escenario }}</th>
                                <td style="font-size: 8pt;">{{ $e->descripcion }}</td>
                                <td style="font-size: 8pt;">
                                    <div style="text-align: center">{{ $e->confidencialidad }}</div>
                                </td>
                                <td style="font-size: 8pt;">
                                    <div style="text-align: center">{{ $e->disponibilidad }}</div>
                                </td>
                                <td style="font-size: 8pt;">
                                    <div style="text-align: center">{{ $e->integridad }}</div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                @endif
            </tbody>
        </table>
        @php
            $promedioConfidencialidad1 = round(array_sum($promedioConfidencialidad)/(count($promedioConfidencialidad)>0 ? count($promedioConfidencialidad):1));
            $promedioDisponibilidad1 = round(array_sum($promedioDisponibilidad)/(count($promedioDisponibilidad)>0 ? count($promedioDisponibilidad):1));
            $promedioIntegridad1 = round(array_sum($promedioIntegridad)/(count($promedioIntegridad)>0 ? count($promedioIntegridad):1));
            $probabilidad = round(($promedioConfidencialidad1 + $promedioIntegridad1 + $promedioIntegridad1)/3);
        @endphp
        <input id="copia_probabilidad" type="hidden" value='{{$probabilidad}}'/>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        document.getElementById('proceso_id').addEventListener('change', function(e){
            console.log('index');
            e.preventDefault();
            setTimeout(() => {
            let probabilidad = document.getElementById('copia_probabilidad').value;
            let impacto=@this.get('impacto');
            let coordenada = `.coordenada-${impacto}-${probabilidad}`;
            console.log(coordenada);
            if( document.querySelector(coordenada) != null){
                document.querySelector(coordenada).style.backgroundColor='black';
            }

            document.getElementById('valor_probabilidad').innerHTML=probabilidad
            }, 1000);

        })
    })


</script>
