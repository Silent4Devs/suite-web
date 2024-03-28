<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <h5 class="titulo_general_funcion"> Evaluación Dashboard {{ $evaluacion->nombre }}</h5>

    <p>
        <small>
            No olvides realizar tu autoevaluacion asi como tambien evaluar a las personas que estan a tu cargo
        </small>
    </p>

    <div class="row mt-4">
        <div class="col-md-3">
            <a wire:click.prevent="enviarRecordatorio">
                <div class="w-100 p-3 text-center text-white rounded-lg" style="background-color: #2C9E7F;">
                    Enviar recordatorio de Evaluación
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a wire:click.prevent="cerrarEvaluacion">
                <div class="w-100 p-3 text-center text-white rounded-lg"
                    style="background-color: #DF5050; cursor: pointer;">
                    Cerrar Evaluación
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <div class="w-100 p-3 text-center text-white rounded-lg" style="background-color: #A650DF;">
                Modificar periodo de evaluación
            </div>
        </div>
        <div class="col-md-3">
            <div class="w-100 p-3 text-center text-white rounded-lg" style="background-color: #507BDF;">
                Generar Reporte
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-body">
                <table>
                    <thead>
                        <tr>
                            <th>
                                Nombre de Evaluación
                            </th>
                            <th>
                                Estatus
                            </th>
                            <th>
                                Inicio
                            </th>
                            <th>
                                Finaliza
                            </th>
                            <th>
                                Autor
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>{{ $evaluacion->nombre }}</p>
                            </td>
                            <td>
                                {{ $evaluacion->estatus_palabra }}
                            </td>
                            <td>
                                10/10/2023
                            </td>
                            <td>
                                10/10/2023
                            </td>
                            <td>
                                <div class="img-person">
                                    <img src="{{ $evaluacion->autor->avatar }}" alt="{{ $evaluacion->autor->name }}"
                                        title="{{ $evaluacion->autor->name }}">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-body">
                <div class="d-flex w-100">
                    <div class="">
                        <span>Evaluaciones contestadas</span>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $evaluacion->porcentaje_evaluaciones_completadas }}%"
                                aria-valuenow="{{ $evaluacion->total_evaluaciones_completadas }}" aria-valuemin="0"
                                aria-valuemax="{{ $evaluacion->total_evaluaciones }}"></div>
                        </div>
                    </div>
                    <div class="">
                        <span>Total</span>
                        <p>
                            {{ $evaluacion->total_evaluaciones_completadas }}/{{ $evaluacion->total_evaluaciones }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="font-size: 18px;">
        <div class="col-md-4">
            <div class="text-white d-flex align-items-center justify-content-between p-4 rounded-lg"
                style="background-color: #984F96;">
                <div>
                    <span>Promedio General</span>
                </div>
                <div>
                    <small>Resultado</small> <strong>75%</strong>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-white d-flex align-items-center justify-content-between p-4 rounded-lg"
                style="background-color: #984F96;">
                <div>
                    <span>Objetivos</span>
                </div>
                <div>
                    <small>Resultado</small> <strong>75%</strong>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-white d-flex align-items-center justify-content-between p-4 rounded-lg"
                style="background-color: #984F96;">
                <div>
                    <span>Competencias</span>
                </div>
                <div>
                    <small>Resultado</small> <strong>75%</strong>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4" style="font-size: 15px; color: #006DDB;">
        <div class="col-md-3">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Trimestre 1
                    </div>
                    <div>
                        <small>Promedio</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Trimestre 2
                    </div>
                    <div>
                        <small>Promedio</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary" style="opacity: 70%;">
                    <div>
                        Trimestre 3
                    </div>
                    <div>
                        <small>Promedio</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary" style="opacity: 70%;">
                    <div>
                        Trimestre 4
                    </div>
                    <div>
                        <small>Promedio</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-body mt-3">
        <h5>Resultado por área</h5>
        grahp
    </div>

    <div class="card card-body" style="background-color: #BF9CC4;">
        <div class="form-group">
            <select name="" id="area-select" wire:model="area_select" class="form-control"
                style="background-color: #fff;">
                <option value="" selected disabled>Área</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mt-4" style="font-size: 15px; color: #9E50AA;">
        <div class="col-md-4">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Promedio General
                    </div>
                    <div>
                        <small>Resultado</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Objetivos
                    </div>
                    <div>
                        <small>Resultado</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded-lg" style="background-color: #fff; box-shadow: 0px 1px 4px #0000000F;">
                <div class="d-flex align-items-center justify-content-between color-primary">
                    <div>
                        Competencias
                    </div>
                    <div>
                        <small>Resultado</small> <strong>67%</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-body">
                <h5>Cumplimiento de Objetivos</h5>
                grahp
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-body">
                <h5>Resultado de evaluación por escalas</h5>

                grahp
            </div>
        </div>
    </div>

    <div class="card card-body">
        <h5>Cumplimiento de Competencias</h5>
        graph
    </div>

    <div class="card card-body">
        <div class="d-flex w-100">
            <div class="">
                <span>Evaluaciones contestadas</span>
                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="">
                <span>Total</span>
                <p>
                    54/{{ $evaluacion->cuenta_evaluados_evaluaciones_totales }}
                </p>
            </div>
        </div>
    </div>

    <div class="card card-body">

        <div class="row">
            <div class="col-md-3 form-group">
                <select name="" id="" class="form-control">
                    <option value="" selected disabled>Área</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <select name="" id="" class="form-control">
                    <option disabled selected value="">Colaborador</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <select name="" id="" disabled select class="form-control">
                    <option value="">Evaluador</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Buscar ...">
            </div>
        </div>
    </div>

    <nav class="mt-5">
        <div class="nav nav-tabs" role="tablist" style="margin-bottom: 0px !important;">
            <a class="nav-link active" id="" data-type="empleados" data-toggle="tab"
                href="#nav-config-obj-1" role="tab" aria-controls="nav-empleados" aria-selected="true">
                Definir Categorías
            </a>
            <a class="nav-link" id="" data-type="calendario-comunicacion" data-toggle="tab"
                href="#nav-config-obj-2" role="tab" aria-controls="nav-config-obj-2" aria-selected="false">
                Definir Escalas
            </a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane mb-4 fade show active" id="nav-config-obj-1" role="tabpanel"
            aria-labelledby="nav-config-obj-1">
            <div class="card card-body">

                <table id="datatable-empleados-config-evaluaciones" class="table table-bordered w-100 datatable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Evaluadores</th>
                            <th>Avance</th>
                            <th>Actividad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nombre</td>
                            <td>Evaluadores</td>
                            <td>Avance</td>
                            <td>Actividad</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="tab-pane mb-4 fade" id="nav-config-obj-2" role="tabpanel" aria-labelledby="nav-config-obj-2">
            <div class="card card-body">
                <div class="datatable-fix">
                    <table id="" class="table table-bordered w-100 datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th colspan="8">RESULTADOS</th>
                                <th colspan="21">COMPETENCIAS</th>
                                <th colspan="20">OBJETIVOS</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Puesto y Área</th>
                                <th>Evaluadores</th>
                                <th>Competencias</th>
                                <th>Objetivos</th>
                                <th>Calificación</th>
                                <th>Nivel</th>

                                <th>Apego a procesos</th>
                                <th>Innovación y creatividad</th>
                                <th>Comunicación efectiva</th>
                                <th>Enfocque al cliente</th>
                                <th>Trabajo en equipo</th>
                                <th>Adaptabilidad al cambio</th>
                                <th>Solución de problemas y toma de desiciones</th>
                                <th>Liderazgo e influencia</th>
                                <th>Pensamiento estratégico</th>
                                <th>Planificación y organización</th>
                                <th>Negociación comercial</th>
                                <th>Analisis de negocio</th>
                                <th>Visión de negocio</th>
                                <th>Enfoque a resultados</th>
                                <th>Mejora continua</th>
                                <th>Búsqueda de información</th>
                                <th>Análisis y síntesis</th>
                                <th>Efectividad interpersonal (Empatía)</th>
                                <th>Negociación</th>
                                <th>Trabajo bajo presión</th>
                                <th>Impacto e influencia</th>

                                <th>Objetivo 1</th>
                                <th>%</th>
                                <th>Objetivo 2</th>
                                <th>%</th>
                                <th>Objetivo 3</th>
                                <th>%</th>
                                <th>Objetivo 4</th>
                                <th>%</th>
                                <th>Objetivo 5</th>
                                <th>%</th>
                                <th>Objetivo 6</th>
                                <th>%</th>
                                <th>Objetivo 7</th>
                                <th>%</th>
                                <th>Objetivo 8</th>
                                <th>%</th>
                                <th>Objetivo 9</th>
                                <th>%</th>
                                <th>Objetivo 10</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>Nombre</td>
                                <td>Puesto y Área</td>
                                <td>Evaluadores</td>
                                <td>Competencias</td>
                                <td>Objetivos</td>
                                <td>Calificación</td>
                                <td>Nivel</td>

                                <td>Apego a procesos</td>
                                <td>Innovación y creatividad</td>
                                <td>Comunicación efectiva</td>
                                <td>Enfocque al cliente</td>
                                <td>Trabajo en equipo</td>
                                <td>Adaptabilidad al cambio</td>
                                <td>Solución de problemas y toma de desiciones</td>
                                <td>Liderazgo e influencia</td>
                                <td>Pensamiento estratégico</td>
                                <td>Planificación y organización</td>
                                <td>Negociación comercial</td>
                                <td>Analisis de negocio</td>
                                <td>Visión de negocio</td>
                                <td>Enfoque a resultados</td>
                                <td>Mejora continua</td>
                                <td>Búsqueda de información</td>
                                <td>Análisis y síntesis</td>
                                <td>Efectividad interpersonal (Empatía)</td>
                                <td>Negociación</td>
                                <td>Trabajo bajo presión</td>
                                <td>Impacto e influencia</td>

                                <td>Objetivo 1</td>
                                <td>%</td>
                                <td>Objetivo 2</td>
                                <td>%</td>
                                <td>Objetivo 3</td>
                                <td>%</td>
                                <td>Objetivo 4</td>
                                <td>%</td>
                                <td>Objetivo 5</td>
                                <td>%</td>
                                <td>Objetivo 6</td>
                                <td>%</td>
                                <td>Objetivo 7</td>
                                <td>%</td>
                                <td>Objetivo 8</td>
                                <td>%</td>
                                <td>Objetivo 9</td>
                                <td>%</td>
                                <td>Objetivo 10</td>
                                <td>%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
