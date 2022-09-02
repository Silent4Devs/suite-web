@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Mostrar Mátriz de Impacto
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.analisis-impacto.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>

                <div class="row">
                    <!-- Button trigger modal -->
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#procesos">
                            1.0
                            <br>Procesos
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#matriz_bia">
                            2.0
                            <br>Matriz BIA
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#entradas_salidas">
                            3.0
                            <br>Entradas y Salidas
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tecnologica">
                            4.0
                            <br>Inf. Tecnológica
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#requerimientos_minimos">
                            5.0
                            <br>Requerimientos minimos
                        </button>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#respaldo">
                            6.0
                            <br>Respaldo-registros vitales
                        </button>
                    </div>
                </div>

                <!-- Modal>1.0 Procesos-->
                <div class="modal fade" id="procesos" tabindex="-1" aria-labelledby="procesos" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">1.0 Procesos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th colspan="7">Procesos</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">ID</th>
                                            <th scope="col">Dirección</th>
                                            <th scope="col">Área</th>
                                            <th scope="col">Macroproceso</th>
                                            <th scope="col">Proceso</th>
                                            <th scope="col">Subproceso</th>
                                            <th scope="col">CANTIDAD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuestionario as $data)
                                            <tr style="font-size: 11px;">
                                                <th scope="row">{{ $data->id_proceso }}</th>
                                                <td>{{ $data->direccion }}</td>
                                                <td>{{ $data->area }}</td>
                                                <td>{{ $data->macroproceso ?: 'N/A' }}</td>
                                                <td>{{ $data->nombre_proceso }}</td>
                                                <td>{{ $data->subproceso ?: 'N/A' }}</td>
                                                <td>{{ $data->id ?: 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                  <!-- Modal>2.0 2.0 Matriz BIA-->
                  <div class="modal fade" id="matriz_bia" tabindex="-1" aria-labelledby="matriz_bia" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">1.0 Procesos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th colspan="7">Procesos</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">ID</th>
                                            <th scope="col">Dirección</th>
                                            <th scope="col">Área</th>
                                            <th scope="col">Macroproceso</th>
                                            <th scope="col">Proceso</th>
                                            <th scope="col">Subproceso</th>
                                            <th scope="col">CANTIDAD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuestionario as $data)
                                            <tr style="font-size: 11px;">
                                                <th scope="row">{{ $data->id_proceso }}</th>
                                                <td>{{ $data->direccion }}</td>
                                                <td>{{ $data->area }}</td>
                                                <td>{{ $data->macroproceso ?: 'N/A' }}</td>
                                                <td>{{ $data->nombre_proceso }}</td>
                                                <td>{{ $data->subproceso ?: 'N/A' }}</td>
                                                <td>{{ $data->id ?: 'N/A' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal 3.0 Entradas y salidas-->
                <div class="modal fade" id="entradas_salidas" tabindex="-1" aria-labelledby="entradas_salidas"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">3.0 Entradas y salidas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th scope="col">#</th>
                                            <th scope="col" style="min-width: 200px;">Dirección</th>
                                            <th scope="col" style="min-width: 200px;">Área</th>
                                            <th scope="col" style="min-width: 200px;">Proceso</th>
                                            <th scope="col">Subproceso</th>
                                            <th scope="col" style="min-width: 200px;">Insumo/ Entrada
                                                (Documentos, Correo electrónico, Oficios, Reportes, etc.)</th>
                                            <th scope="col" style="min-width: 200px;">Empresa, Área, Sistema o Proceso
                                                de
                                                Origen</th>
                                            <th scope="col">Interno / Externo</th>
                                            <th scope="col">¿Quién le proporciona esta información?</th>
                                            <th scope="col">Puesto</th>
                                            <th scope="col">Correo electrónico</th>
                                            <th scope="col">Ext.</th>
                                            <th scope="col">Ubicación</th>
                                            <th scope="col" style="min-width: 200px;">De que manera se recibe la
                                                información
                                                (Entrega Física / Correo Electrónico / Consulta en Aplicativo o Base de
                                                Datos / Consulta en Portal Web)</th>
                                            <th scope="col" style="min-width: 200px;">Salida
                                                (Documentos, Correo electrónico, Oficios, Reportes, etc.)</th>
                                            <th scope="col">Interno / Externo</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Puesto</th>
                                            <th scope="col">Correo electrónico:</th>
                                            <th scope="col">Ext.</th>
                                            <th scope="col">Ubicación</th>
                                            <th scope="col" style="min-width: 200px;">¿Cómo valida que el proceso se
                                                realizó correctamente?
                                                (Carta o firma de aceptación, Acuse de Recibido, Notificación, etc..)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuestionario as $data)
                                            <tr style="font-size: 11px;">
                                                <td rowspan="{{ $data->diferencia_flujo_informacion[1] }}">
                                                    <div style="text-align: left;">P00{{ $data->id }}</div>
                                                </td>
                                                <td rowspan="{{ $data->diferencia_flujo_informacion[1] }}">
                                                    <div style="text-align: left;">{{ $data->direccion }}</div>
                                                </td>
                                                <td rowspan="{{ $data->diferencia_flujo_informacion[1] }}">
                                                    <div style="text-align: left;">{{ $data->area }}</div>
                                                </td>
                                                <td rowspan="{{ $data->diferencia_flujo_informacion[1] }}">
                                                    <div style="text-align: left;">{{ $data->nombre_proceso }}</div>
                                                </td>
                                                <td rowspan="{{ $data->diferencia_flujo_informacion[1] }}">
                                                    <div style="text-align: left;">{{ $data->subproceso ?: 'N/A' }}</div>
                                                </td>
                                                <td rowspan="{{ $data->diferencia_flujo_informacion[1] }}">
                                                    <div style="text-align: left;">{{ $data->flujo_q_1 ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->diferencia_flujo_informacion[1] }}">
                                                    <div style="text-align: left;">{{ $data->flujo_q_2 ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->diferencia_flujo_informacion[1] }}">
                                                    <div style="text-align: left;">Interno</div>
                                                </td>
                                                @php
                                                    $persona_proporciona = $data->proporcionaInformacion->first();
                                                @endphp
                                                <td>
                                                    <div style="text-align: left;">{{ $persona_proporciona->nombre }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>

                                                <td rowspan="{{ $data->diferencia_flujo_informacion[1] }}">
                                                    <div style="text-align: left;">{{ $data->flujo_q_4 ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td rowspan="{{ $data->diferencia_flujo_informacion[1] }}">
                                                    <div style="text-align: left;">{{ $data->flujo_q_6 ?: 'No definido' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td rowspan="2">
                                                    <div style="text-align: left;">
                                                        {{ $data->flujo_q_10 ?: 'No definido' }}</div>
                                                </td>
                                            </tr>
                                            @php
                                                $persona_proporciona_array = $data->proporcionaInformacion->shift();
                                            @endphp
                                          
                                                
                                       
                                            <tr>

                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">Buscando..</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal>4.0 Inf. Tecnológica-->
                <div class="modal fade" id="tecnologica" tabindex="-1" aria-labelledby="tecnologica"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">4.0 Información Tecnológica</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th colspan="9">Infraestructura Tecnológica</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">#</th>
                                            <th scope="col">Dirección</th>
                                            <th scope="col">Área</th>
                                            <th scope="col">Proceso</th>
                                            <th scope="col">Subproceso</th>
                                            <th scope="col">Aplicaciones</th>
                                            <th scope="col">Herramientas</th>
                                            <th scope="col">Base de Datos</th>
                                            <th scope="col">Otros</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tecnologica as $data)
                                            <tr style="font-size: 11px;">
                                                <th scope="row">
                                                    <div style="text-align: left;">P00{{ $data->cuestionario->id }}</div>
                                                </th>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->cuestionario->direccion }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->cuestionario->area }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->nombre_proceso }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->subproceso ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->aplicativos ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->sistemas ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->base_datos ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->otro ?: 'N/A' }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal>5.0 Requerimientos minimos-->
                <div class="modal fade" id="requerimientos_minimos" tabindex="-1"
                    aria-labelledby="requerimientos_minimos" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">5.0 Requerimientos minimos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;text-align:center;">
                                            <th colspan="5">Información General</th>
                                            <th colspan="15">REQUERIMIENTOS MINIMOS PARA LA OPERACIÓN Y RECUPERACIÓN</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px; text-align:center;">
                                            <th colspan="5" style="background-color: #9C1A3B;"></th>
                                            <th colspan="7">Recursos Humanos</th>
                                            <th colspan="2">EQUIPOS DE COMPUTO</th>
                                            <th colspan="2">LINEAS TELEFONICAS</th>
                                            <th colspan="2">IMPRESORA/MULTIFUNCIONAL</th>
                                            <th colspan="2">OTROS</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">#</th>
                                            <th scope="col" style="min-width: 200px;">Dirección</th>
                                            <th scope="col" style="min-width: 200px;">Área</th>
                                            <th scope="col" style="min-width: 200px;">Proceso</th>
                                            <th scope="col">Subproceso</th>
                                            <th scope="col">#personas en Op. Normal</th>
                                            <th scope="col" style="min-width: 100px;">Empresa/Área</th>
                                            <th scope="col" style="min-width: 150px;">Nombre</th>
                                            <th scope="col">Puesto</th>
                                            <th scope="col">Rol</th>
                                            <th scope="col">Ext.</th>
                                            <th scope="col">#</th>
                                            <th scope="col">Op. Normal</th>
                                            <th scope="col">En contingencia</th>
                                            <th scope="col">Op. Normal</th>
                                            <th scope="col">En contingencia</th>
                                            <th scope="col">Op. Normal</th>
                                            <th scope="col">En contingencia</th>
                                            <th scope="col">Op. Normal</th>
                                            <th scope="col">En contingencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($personas_contingencia as $data)
                                            <tr style="font-size: 11px;">
                                                <td scope="row">
                                                    <div style="text-align: left;">P00{{ $data->cuestionario->id }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->cuestionario->direccion }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->cuestionario->area }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->nombre_proceso }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->subproceso ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_total_personas_normal }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->empresa }} </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->nombre }} {{ $data->a_paterno }} {{ $data->a_materno }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->puesto }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->rol }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->tel }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_total_personas_contingencia }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_equipo_computo_normal ?: 'N/A' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_equipo_computo_contingencia ?: 'N/A' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_telefonia_normal ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_telefonia_contingencia ?: 'N/A' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_impresora_normal ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_impresora_contingencia ?: 'N/A' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_otros_normal ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->cuestionario->cantidad_otros_contingencia ?: 'N/A' }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal>6.0 Respaldo-registros vitales-->
                <div class="modal fade" id="respaldo" tabindex="-1" aria-labelledby="respaldo" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">6.0 Respaldo-registros vitales</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr style="background-color: #9C1A3B; font-size: 12px;">
                                            <th colspan="5">Información General</th>
                                            <th colspan="4">Respaldos de Información</th>
                                        </tr>
                                        <tr style="background-color: #8f8f8f; font-size: 12px;">
                                            <th scope="col">#</th>
                                            <th scope="col" style="min-width: 200px;">Dirección</th>
                                            <th scope="col" style="min-width: 200px;">Área</th>
                                            <th scope="col" style="min-width: 200px;">Proceso</th>
                                            <th scope="col">Subproceso</th>
                                            <th scope="col" style="min-width: 200px;">¿Se ejecutan respaldos fuera del
                                                equipo de computo de los archivos necesarios para ejecutar el proceso?.</th>
                                            <th scope="col" style="min-width: 200px;">Archivos o Registros
                                                respaldados/Archivos o Registros que se deberían respaldar.</th>
                                            <th scope="col" style="min-width: 200px;">¿Alguien mas tiene accesos al
                                                respaldo?.</th>
                                            <th scope="col" style="min-width: 200px;">¿De que manera se tienen
                                                resguardados los usuarios y contraseñas que utiliza para el acceso a
                                                sistemas necesarios en este proceso?.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuestionario as $data)
                                            <tr style="font-size: 11px;">
                                                <th scope="row">
                                                    <div style="text-align: left;">P00{{ $data->id }}</div>
                                                </th>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->direccion }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->area }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->nombre_proceso }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">{{ $data->subproceso ?: 'N/A' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->respaldo_q_21 ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->respaldo_q_20 ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->respaldo_q_22 ?: 'No definido' }}</div>
                                                </td>
                                                <td>
                                                    <div style="text-align: left;">
                                                        {{ $data->respaldo_q_23 ?: 'No definido' }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>




























                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.analisis-impacto.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
