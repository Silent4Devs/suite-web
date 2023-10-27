@extends('layouts.admin')
@section('content')
    <style type="text/css">
        .datos_der_cv {
            color: #fff;

        }

        .tabla_verde {
            color: #fff !important;
        }

        .tabla_verde.table-striped tbody tr:nth-of-type(odd),
        table.table tbody tr:nth-child(even) {
            background-color: rgba(0, 0, 0, 0);
        }

        .tabla_verde th {
            background-color: rgb(0, 0, 0, 0) !important;
        }

        @media print {
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
        }
    </style>

    {{-- {{ Breadcrumbs::render('mi-perfil-puesto') }} --}}

    {{-- @if (is_null($visualizarEmpleados->name)) --}}
    {{-- <label class="ml-4">Sin registro</label> --}}
    {{-- @else --}}

    <h5 class="col-12 titulo_general_funcion">Datos de {{ $visualizarEmpleados->name }}</h5>
    {{-- @endif --}}
    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">

                <div class="card-body" id="imp1">

                    {{-- <div class="col-md-4"> --}}
                    <div class="mb-4 d-flex" style="margin-left: 70%;position: absolute;top: 4%;">
                        <a class="btn btn-danger" href="javascript:window.print()" id="but">Imprimir</a>
                    </div>
                    {{-- </div> --}}
                    @php
                        use App\Models\Organizacion;
                        $organizacion = Organizacion::getFirst();
                        $logotipo = $organizacion->logotipo;
                    @endphp
                    <div class="caja_img_logo">
                        <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width: 100px;">
                    </div>

                    <div class="row medidas d-flex" style="justify-content: space-between;">
                        <div class="mt-4 ml-4 col-sm-7 datos_iz_cv">
                            <h5 class="py-2 pl-2"
                                style="color:#fff; font-weight:bold; background-color:#7F7F7F; width:100%">
                                {{ $visualizarEmpleados->puesto }}</h5>
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Datos Laborales</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Nombre</strong>
                                        <div>{{ $visualizarEmpleados->name }}</div>
                                </div>
                                <div class="col-4">
                                    <span><strong>N° de empleado</strong>
                                        <div>{{ $visualizarEmpleados->n_empleado }}</div>
                                </div>
                                <div class="col-4">
                                    <span><strong>Área</strong>
                                        <div>{{ $visualizarEmpleados->area->area }}</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                @if (is_null($visualizarEmpleados->supervisor))
                                    <div class="col-4">
                                        <span><strong>Nivel Jerárquico</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Nivel Jerárquico</strong>
                                            <span>{{ $visualizarEmpleados->supervisor->name }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->perfil))
                                    <div class="col-4">
                                        <span><strong>Nivel Jerárquico</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Nivel Jerárquico</strong>
                                            <span>{{ $visualizarEmpleados->perfil->nombre }}</span>
                                    </div>
                                @endif

                                <div class="col-4">
                                    <span><strong>Género</strong>
                                        <div>{{ $visualizarEmpleados->genero }}</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Estatus</strong>
                                        <div>{{ $visualizarEmpleados->estatus }}</div>
                                </div>
                                <div class="col-4">
                                    <span><strong>Correo electrónico</strong>
                                        <div>{{ $visualizarEmpleados->email }}</div>
                                </div>

                                @if (is_null($visualizarEmpleados->telefono_movil))
                                    <div class="col-4">
                                        <span><strong>Teléfono móvil</strong></span>
                                        <span style="margin-left: 3px;">No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Teléfono móvil</strong>
                                            <span>{{ $visualizarEmpleados->telefono_movil }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Teléfono de oficina</strong></span>
                                    <div>{{ $visualizarEmpleados->telefono }}</div>
                                </div>
                                @if (is_null($visualizarEmpleados->extension))
                                    <div class="col-4">
                                        <span><strong>Ext.</strong>
                                            <span style="margin-left: 3px;">No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Ext.</strong>
                                            <span>{{ $visualizarEmpleados->extension }}</span>
                                    </div>
                                @endif

                                <div class="col-4">
                                    <span><strong>Sede</strong>
                                        <div>
                                            {{ $visualizarEmpleados->sede ? $visualizarEmpleados->sede->sede : 'Sin dato' }}
                                        </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Fecha de ingreso</strong>
                                        <div>{{ $visualizarEmpleados->antiguedad }}</div>
                                </div>


                                @if (is_null($visualizarEmpleados->direccion))
                                    <div class="col-4">
                                        <span><strong>Dirección</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Dirección</strong>
                                            <span>{{ $visualizarEmpleados->direccion }}</span>
                                    </div>
                                @endif
                                @if (is_null($visualizarEmpleados->tipo_contrato_empleados_id))
                                    <div class="col-4">
                                        <span><strong>Tipo de contrato</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Tipo de contrato</strong>
                                            <span>{{ $visualizarEmpleados->tipo_contrato_empleados_id }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">

                                @if (is_null($visualizarEmpleados->terminacion_contrato))
                                    <div class="col-4">
                                        <span><strong>Fecha de terminación de contrato</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Fecha de terminación de contrato</strong>
                                            <span>{{ $visualizarEmpleados->terminacion_contrato }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->esquema_contratacion))
                                    <div class="col-4">
                                        <span><strong>Esquema de contratación</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Esquema de contratación</strong>
                                            <span>{{ $visualizarEmpleados->esquema_contratacion }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Datos Financieros</span>
                            </div>
                            <div class="row mb-3">
                                @if (is_null($visualizarEmpleados->banco))
                                    <div class="col-4">
                                        <span><strong>Banco</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Banco</strong>
                                            <span>{{ $visualizarEmpleados->banco }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->cuenta_bancaria))
                                    <div class="col-4">
                                        <span><strong>Cuenta Bancaria</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Cuenta Bancaria</strong>
                                            <span>{{ $visualizarEmpleados->cuenta_bancaria }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->clabe_interbancaria))
                                    <div class="col-4">
                                        <span><strong>Clave Interbancaria</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Clave Interbancaria</strong>
                                            <span>{{ $visualizarEmpleados->clabe_interbancaria }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">
                                @if (is_null($visualizarEmpleados->centro_costos))
                                    <div class="col-4">
                                        <span><strong>Centro de costos</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Centro de costos</strong>
                                            <span>{{ $visualizarEmpleados->centro_costos }}</span>
                                    </div>
                                @endif
                                @if (is_null($visualizarEmpleados->salario_bruto))
                                    <div class="col-4">
                                        <span><strong>Salario Bruto</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Salario Bruto</strong>
                                            <span>{{ $visualizarEmpleados->salario_bruto }}</span>
                                    </div>
                                @endif
                                @if (is_null($visualizarEmpleados->salario_diario))
                                    <div class="col-4">
                                        <span><strong>Salario Diario</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Salario Diario</strong>
                                            <span>{{ $visualizarEmpleados->salario_diario }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">
                                @if (is_null($visualizarEmpleados->salario_diario_integrado))
                                    <div class="col-4">
                                        <span><strong>Salario Diario Integrado</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Salario Diario Integrado</strong>
                                            <span>{{ $visualizarEmpleados->salario_diario_integrado }}</span>
                                    </div>
                                @endif
                                @if (is_null($visualizarEmpleados->salario_base_mensual))
                                    <div class="col-4">
                                        <span><strong>Salario Base Mensual</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Salario Base Mensual</strong>
                                            <span>{{ $visualizarEmpleados->salario_base_mensual }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->pagadora_actual))
                                    <div class="col-4">
                                        <span><strong>Pagadora Actual</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Pagadora Actual</strong>
                                            <span>{{ $visualizarEmpleados->pagadora_actual }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">

                                @if (is_null($visualizarEmpleados->periodicidad_nomina))
                                    <div class="col-4">
                                        <span><strong>Periodicidad de nómina</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Periodicidad de nómina</strong>
                                            <span>{{ $visualizarEmpleados->periodicidad_nomina }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <span><strong>Beneficiarios</strong>
                                        {{-- <div>{{$visualizarEmpleados->salario_base_mensual}}</div> --}}
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Parentesco</th>
                                                    <th>Porcentaje</th>
                                                    <th>Edad</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($beneficiarios as $beneficiario)
                                                    <tr>
                                                        <td>{{ $beneficiario->nombre }}</td>
                                                        <td>{{ $beneficiario->parentesco }}</td>
                                                        <td>{{ $beneficiario->porcentaje }}</td>
                                                        <td>{{ $beneficiario->edad }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                            </div>

                            <div class="row mb-3">

                                @if (is_null($visualizarEmpleados->entidad_crediticias_id))
                                    <div class="col-4">
                                        <span><strong>Entidad crediticia</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Entidad crediticia</strong>
                                            <span>{{ $visualizarEmpleados->entidad_crediticias_id }}</span>
                                    </div>
                                @endif
                                @if (is_null($visualizarEmpleados->numero_credito))
                                    <div class="col-4">
                                        <span><strong>Número de crédito</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Número de crédito</strong>
                                            <span>{{ $visualizarEmpleados->numero_credito }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->descuento))
                                    <div class="col-4">
                                        <span><strong>Descuento</strong>
                                            <span>No especificado</span>
                                    </div>
                                @else
                                    <div class="col-4">
                                        <span><strong>Descuento</strong>
                                            <span>{{ $visualizarEmpleados->descuento }}</span>
                                    </div>
                                @endif
                            </div>
                            <p style="text-align:justify">
                                {{-- {!!$puesto->descripcion!!} --}}
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Perfil Profesional</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <span><strong>Resumen</strong>
                                        <div>{{ $visualizarEmpleados->resumen }}</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <span><strong>Certificaciones</strong>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Vigencia</th>
                                                    <th>Estatus</th>
                                                    <th>Documento</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($certificados as $certificado)
                                                    <tr>
                                                        <td>{{ $certificado->nombre }}</td>
                                                        <td>{{ $certificado->vigencia }}</td>
                                                        <td>{{ $certificado->estatus }}</td>
                                                        <td>{{ $certificado->documento }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-12">
                                    <span><strong>Capacitaciones</strong>
                                        <div>{{ $visualizarEmpleados->resumen }}</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <span><strong>Experiencia Profesional</strong>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Vigencia</th>
                                                    <th>Estatus</th>
                                                    <th>Documento</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($certificados as $certificado)
                                                    <tr>
                                                        <td>{{ $certificado->nombre }}</td>
                                                        <td>{{ $certificado->vigencia }}</td>
                                                        <td>{{ $certificado->estatus }}</td>
                                                        <td>{{ $certificado->documento }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                            </div>

                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Expediente</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    {{-- <span><strong>Experiencia Profesional</strong> --}}
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Número</th>
                                                <th>Documento</th>
                                                {{-- <th>Estatus</th> --}}

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($expedientes as $expediente)
                                                <tr>
                                                    <td>{{ $expediente->nombre }}</td>
                                                    <td>{{ $expediente->numero }}</td>
                                                    <td>{{ $expediente->documentos }}</td>
                                                    {{-- <td>{{ $expediente->estatus}}</td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>


                        <div class="mt-4 col-sm-4 datos_der_cv">
                            <div
                                style="background: linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); height:100%; padding:10px;">
                                <div class="mt-3 mb-4 w-100" style="border-bottom: solid 2px #fff;">
                                    <span class="text-white " style="font-size: 14px; font-weight: bold;">
                                        Datos Personales</span>
                                </div>
                                <strong><i class="ml-2 mr-2 fas fa-home text-white"></i>Domicilio</strong>

                                @if (is_null($visualizarEmpleados->calle))
                                    <label class="ml-4">No especificado</label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>Calle {{ $visualizarEmpleados->calle }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->num_exterior))
                                    <label class="ml-4"></label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>Núm. Exterior {{ $visualizarEmpleados->num_exterior }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->num_interior))
                                    <label class="ml-4"></label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>Núm. Interior {{ $visualizarEmpleados->num_interior }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->colonia))
                                    <label class="ml-4"></label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>Colonia {{ $visualizarEmpleados->colonia }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->delegacion))
                                    <label class="ml-4"></label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>Delegación o Municipio {{ $visualizarEmpleados->delegacion }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->estado))
                                    <label class="ml-4"></label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>Estado {{ $visualizarEmpleados->estado }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->pais))
                                    <label class="ml-4"></label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>País {{ $visualizarEmpleados->pais }}</span>
                                    </div>
                                @endif

                                @if (is_null($visualizarEmpleados->cp))
                                    <label class="ml-4"></label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>C.P. {{ $visualizarEmpleados->cp }}</span>
                                    </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-phone text-white"></i>Teléfono de casa</strong>

                                @if (is_null($visualizarEmpleados->telefono_casa))
                                    <label class="ml-4">No especificado</label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>{{ $visualizarEmpleados->telefono_casa }}</span>
                                    </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-envelope text-white"></i>Correo Personal</strong>

                                @if (is_null($visualizarEmpleados->correo_personal))
                                    <label class="ml-4">No especificado</label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>{{ $visualizarEmpleados->correo_personal }}</span>
                                    </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-book text-white"></i>Estado civil</strong>
                                {{-- <h5><i class="ml-2 mr-2 far fa-building text-white" ></i>Estado civil</h5> --}}

                                @if (is_null($visualizarEmpleados->estado_civil))
                                    <label class="ml-4">No especificado</label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>{{ $visualizarEmpleados->estado_civil }}</span>
                                    </div>
                                @endif
                                <br>
                                <strong style="margin-right: 55px;"><i
                                        class="ml-2 mr-2 fas fa-clinic-medical text-white"></i>NSS</strong>
                                {{-- <h5><i class="ml-2 mr-2 far fa-building text-white" ></i>NSS</h5> --}}

                                @if (is_null($visualizarEmpleados->NSS))
                                    <label class="ml-4">No especificado</label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>{{ $visualizarEmpleados->NSS }}</span>
                                    </div>
                                @endif
                                <br>
                                <strong style="margin-right: 55px;"><i
                                        class="ml-2 mr-2 fas fa-address-card text-white"></i>CURP</strong>
                                @if (is_null($visualizarEmpleados->CURP))
                                    <label class="ml-4">No especificado</label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>{{ $visualizarEmpleados->CURP }}</span>
                                    </div>
                                @endif
                                <br>
                                <strong style="margin-right: 55px;"><i
                                        class="ml-2 mr-2 fas fa-address-card text-white"></i>RFC</strong>
                                @if (is_null($visualizarEmpleados->RFC))
                                    <label class="ml-4">No especificado</label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>{{ $visualizarEmpleados->RFC }}</span>
                                    </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-birthday-cake text-white"></i>Fecha de
                                    nacimiento</strong>
                                @if (is_null($visualizarEmpleados->cumpleaños))
                                    <label class="ml-4">No especificado</label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>{{ $visualizarEmpleados->cumpleaños }}</span>
                                    </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-map-marker-alt text-white"></i>Lugar de
                                    nacimiento</strong>
                                @if (is_null($visualizarEmpleados->lugar_nacimiento))
                                    <label class="ml-4">No especificado</label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>{{ $visualizarEmpleados->lugar_nacimiento }}</span>
                                    </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-globe-americas text-white"></i>País de
                                    nacimiento</strong>
                                @if (is_null($visualizarEmpleados->nacionalidad))
                                    <label class="ml-4">No especificado</label>
                                @else
                                    <div style="margin-left:28px;">

                                        <span>{{ $visualizarEmpleados->nacionalidad }}</span>
                                    </div>
                                @endif
                                <br>
                                {{-- {{$contactos}} --}}
                                <strong><i class="ml-2 mr-2 fas fa-users text-white"></i>Contáctos de emergencia</strong>
                                <table class="table tabla_verde table-responsive scroll_estilo">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Parentesco</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contactos as $contacto)
                                            <tr>
                                                <td>{{ $contacto->nombre }}</td>
                                                <td>{{ $contacto->telefono }}</td>
                                                <td>{{ $contacto->parentesco }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-users text-white"></i>Dependientes económicos</strong>
                                <table class="table tabla_verde">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Parentesco</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dependientes as $dependiente)
                                            <tr>
                                                <td>{{ $dependiente->nombre }}</td>
                                                <td>{{ $dependiente->parentesco }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- @if (is_null($visualizarEmpleados->nacionalidad))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">

                                    <span>{{ $visualizarEmpleados->nacionalidad}}</span>
                                </div>
                                @endif --}}
                                <br>
                                {{-- <strong><i class="ml-2 mr-2 fas fa-clock text-white"></i>Horario</strong> --}}
                                <br>
                                {{-- @if (is_null($puesto->horario))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    <span>{{ $puesto->horario}}</span>
                                </div>
                                 @endif --}}
                                <br>
                                {{-- <div class="mt-3 mb-4 w-100" style="border-bottom: solid 2px #fff;">
                                    <span class="text-white " style="font-size: 14px; font-weight: bold;">
                                       Competencias</span>
                                </div> --}}
                                <div style="margin-left:28px; margin-top: 13px;">
                                    {{-- @foreach ($puesto->competencias as $competencia)
                                    <li><strong>{{$competencia->competencia->nombre}}</strong><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nivel esperado: {{$competencia->nivel_esperado}}</li>
                                    @endforeach --}}
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('scripts')
    <script>
        function imprim1(imp1) {
            var printContents = document.getElementById('imp1').innerHTML;
            w = window.open();
            w.document.write(printContents);
            w.document.close(); // necessary for IE >= 10
            w.focus(); // necessary for IE >= 10
            w.print();
            w.close();
            return true;
        }
    </script>
@endsection
