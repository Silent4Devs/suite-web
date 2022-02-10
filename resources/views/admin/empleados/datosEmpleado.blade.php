@extends('layouts.admin')
@section('content')

    <style type="text/css">

        .datos_der_cv{
            color: #fff;
        }

    </style>

    {{-- {{ Breadcrumbs::render('mi-perfil-puesto') }} --}}


    <h5 class="col-12 titulo_general_funcion">Datos de {{$visualizarEmpleados->name}}</h5>
    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body">


                    @php
                        use App\Models\Organizacion;
                        $organizacion = Organizacion::first();
                        $logotipo = $organizacion->logotipo;
                    @endphp
                    <div class="caja_img_logo">
                        <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width: 100px;">
                    </div>
                    <div class="row medidas">
                        <div class="mt-4 ml-4 col-md-7 datos_iz_cv">
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
                                    <div>{{$visualizarEmpleados->name}}</div>
                                </div>
                                <div class="col-4">
                                    <span><strong>N° de empleado</strong>
                                    <div>{{$visualizarEmpleados->n_empleado}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Área</strong>
                                    <div>{{$visualizarEmpleados->area->area}}</div>
                                </div>  
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Jefe inmediato</strong>
                                    <div>{{$visualizarEmpleados->supervisor_id}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Nivel Jerárquico</strong>
                                    <div>{{$visualizarEmpleados->perfil_empleado_id}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Género</strong>
                                    <div>{{$visualizarEmpleados->genero}}</div>
                                </div>  
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Estatus</strong>
                                    <div>{{$visualizarEmpleados->estatus}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Correo electrónico</strong>
                                    <div>{{$visualizarEmpleados->email}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Teléfono móvil</strong>
                                    <div>{{$visualizarEmpleados->telefono_movil}}</div>
                                </div>  
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Teléfono de oficina</strong>
                                    <div>{{$visualizarEmpleados->telefono}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Ext.</strong>
                                    <div>{{$visualizarEmpleados->extension}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Teléfono móvil</strong>
                                    <div>{{$visualizarEmpleados->telefono_movil}}</div>
                                </div>  
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Sede</strong>
                                    <div>{{$visualizarEmpleados->sede_id}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Fecha de ingreso</strong>
                                    <div>{{$visualizarEmpleados->antiguedad}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Dirección</strong>
                                    <div>{{$visualizarEmpleados->direccion}}</div>
                                </div>  
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Tipo de contrato</strong>
                                    <div>{{$visualizarEmpleados->tipo_contrato_empleados_id}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Fecha de terminación de contrato</strong>
                                    <div>{{$visualizarEmpleados->terminacion_contrato}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Esquema de contratación</strong>
                                    <div>{{$visualizarEmpleados->esquema_contratacion}}</div>
                                </div>  
                            </div>

                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Datos Financieros</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Banco</strong>
                                    <div>{{$visualizarEmpleados->banco}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Cuenta Bancaria</strong>
                                    <div>{{$visualizarEmpleados->cuenta_bancaria}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Clave Interbancaria</strong>
                                    <div>{{$visualizarEmpleados->clabe_interbancaria}}</div>
                                </div>  
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Centro de costos</strong>
                                    <div>{{$visualizarEmpleados->centro_costos}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Salario Bruto</strong>
                                    <div>{{$visualizarEmpleados->salario_bruto}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Salario Diario</strong>
                                    <div>{{$visualizarEmpleados->salario_diario}}</div>
                                </div>  
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Salario Diario Integrado</strong>
                                    <div>{{$visualizarEmpleados->salario_diario_integrado}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Salario Base Mensual</strong>
                                    <div>{{$visualizarEmpleados->salario_base_mensual}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Pagadora Actual</strong>
                                    <div>{{$visualizarEmpleados->pagadora_actual}}</div>
                                </div>  
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Periodicidad de nómina</strong>
                                    <div>{{$visualizarEmpleados->periodicidad_nomina}}</div>
                                </div>  
                                <div class="col-8">
                                    <span><strong>Beneficiarios</strong>
                                    {{-- <div>{{$visualizarEmpleados->salario_base_mensual}}</div> --}}
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Parentesco</th>
                                                <th>Porcentaje</th>
                                                <th>Edad</th>
                    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($beneficiarios as $beneficiario)
                                                <tr>
                                                    <td>{{ $beneficiario->nombre}}</td>
                                                    <td>{{ $beneficiario->parentesco}}</td>
                                                    <td>{{ $beneficiario->edad}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> 
  
                             </div>
                             <div class="row mb-3">
                                <div class="col-4">
                                    <span><strong>Entidad crediticia</strong>
                                    <div>{{$visualizarEmpleados->entidad_crediticias_id}}</div>
                                </div> 
                                <div class="col-4">
                                    <span><strong>Número de crédito</strong>
                                    <div>{{$visualizarEmpleados->numero_credito}}</div>
                                </div>  
                                <div class="col-4">
                                    <span><strong>Descuento</strong>
                                    <div>{{$visualizarEmpleados->descuento}}</div>
                                </div>  
                            </div>
                            <p style="text-align:justify">
                                {{-- {!!$puesto->descripcion!!} --}}
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Perfil Profesional</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <span><strong>Resumen</strong>
                                    <div>{{$visualizarEmpleados->resumen}}</div>
                                </div> 
                                <div class="col-6">
                                    <span><strong>Certificaciones</strong>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Vigencia</th>
                                                    <th>Estatus</th>
                                                    <th>Documento</th>
                        
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($certificados as $certificado)
                                                    <tr>
                                                        <td>{{ $certificado->nombre}}</td>
                                                        <td>{{ $beneficiario->vigencia}}</td>
                                                        <td>{{ $beneficiario->estatus}}</td>
                                                        <td>{{ $beneficiario->documento}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{-- <ul>
                                            @foreach($certificados as $certificado)
                                                <li>
                                                    <div>{{$certificado->nombre}}</div>
                                                </li>
                                            @endforeach
                                        </ul> --}}
                                </div>
                               
                                {{-- <div class="col-4">
                                    <span><strong>Descuento</strong>
                                    <div>{{$visualizarEmpleados->descuento}}</div>
                                </div>   --}}
                            </div>

                            {{-- @foreach($puesto->responsabilidades as $responsabilidad)
                            <div>
                                <span>{{$responsabilidad->actividad}}</span>
                                <br>
                                <span><strong>Resultado:&nbsp;</strong>{{$responsabilidad->resultado}}</span>
                                <br>
                                <span><strong>Indicador:&nbsp;</strong>{{$responsabilidad->indicador}}</span>
                                <br>
                                <span><strong>Tiempo:&nbsp;</strong>{{$responsabilidad->tiempo_asignado}}</span>
                             </div>
                             <br>
                            @endforeach --}}

                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Expediente</span>
                            </div>
                            {{-- @foreach($puesto->herramientas as $herramienta)
                            <div>
                                <strong style="color:#00A57E;text-transform: uppercase">
                                    {{$herramienta->nombre_herramienta}}
                                </strong>
                                <br>
                                <span>{{$herramienta->descripcion_herramienta}}</span>
                            </div>
                            <br>
                           @endforeach --}}

                            {{-- <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                            <span style="font-size: 17px; font-weight: bold;">
                                Experiencia Profesional</span>
                            </div> --}}
                            <p style="text-align:justify">
                                {{-- {!!$puesto->experiencia!!} --}}
                            </p>
                            {{-- <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Educación Académica</span>
                            </div> --}}
                            <p style="text-align:justify">
                                {{-- {!!$puesto->estudios!!} --}}

                            </p>
                            {{-- <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Conocimientos</span>
                            </div> --}}
                            <p style="text-align:justify">
                                {{-- {!!$puesto->conocimientos!!} --}}
                            </p>
                        
                        </div>


                        <div class="mt-4 col-md-4 datos_der_cv">
                            <div
                                style="background: linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); height:100%; padding:10px;">
                                {{-- <div class="text-center w-100"><img class="mt-3"
                                        style="height: 100px; clip-path: circle(50px at 50% 50%); margin:auto"
                                        src="{{ asset('storage/empleados/imagenes/') . '/' . $empleadoModel->Avatar }}"
                                        alt=""></div> --}}
                                <div class="mt-3 mb-4 w-100" style="border-bottom: solid 2px #fff;">
                                    <span class="text-white " style="font-size: 14px; font-weight: bold;">
                                       Datos Personales</span>
                                </div>
                                <strong><i class="ml-2 mr-2 far fa-building text-white"></i>Domicilio</strong>
                                {{-- <h5><i class="ml-2 mr-2 far fa-building text-white" ></i>Domicilio</h5> --}}

                                @if (is_null($visualizarEmpleados->calle))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>Calle {{ $visualizarEmpleados->calle}}</span>
                                </div>
                                @endif

                                @if (is_null($visualizarEmpleados->num_exterior))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>Núm. Exterior {{ $visualizarEmpleados->num_exterior}}</span>
                                </div>
                                @endif

                                @if (is_null($visualizarEmpleados->num_interior))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>Núm. Interior {{ $visualizarEmpleados->num_interior}}</span>
                                </div>
                                @endif

                                @if (is_null($visualizarEmpleados->colonia))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>Colonia {{ $visualizarEmpleados->colonia}}</span>
                                </div>
                                @endif

                                @if (is_null($visualizarEmpleados->delegacion))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>Delegación o Municipio {{ $visualizarEmpleados->delegacion}}</span>
                                </div>
                                @endif

                                @if (is_null($visualizarEmpleados->estado))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>Estado {{ $visualizarEmpleados->estado}}</span>
                                </div>
                                @endif

                                @if (is_null($visualizarEmpleados->pais))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>País {{ $visualizarEmpleados->pais}}</span>
                                </div>
                                @endif

                                @if (is_null($visualizarEmpleados->cp))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>C.P. {{ $visualizarEmpleados->cp}}</span>
                                </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 far fa-building text-white"></i>Teléfono de casa</strong>
                                {{-- <h5><i class="ml-2 mr-2 far fa-building text-white" ></i>Teléfono de casa</h5> --}}

                                @if (is_null($visualizarEmpleados->telefono_casa))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>{{ $visualizarEmpleados->telefono_casa}}</span>
                                </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 far fa-building text-white"></i>Correo Personal</strong>
                                {{-- <h5><i class="ml-2 mr-2 far fa-building text-white" ></i>Correo Personal</h5> --}}

                                @if (is_null($visualizarEmpleados->correo_personal))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>{{ $visualizarEmpleados->correo_personal}}</span>
                                </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 far fa-building text-white"></i>Estado civil</strong>
                                {{-- <h5><i class="ml-2 mr-2 far fa-building text-white" ></i>Estado civil</h5> --}}

                                @if (is_null($visualizarEmpleados->estado_civil))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>{{ $visualizarEmpleados->estado_civil}}</span>
                                </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 far fa-building text-white"></i>NSS</strong>
                                {{-- <h5><i class="ml-2 mr-2 far fa-building text-white" ></i>NSS</h5> --}}

                                @if (is_null($visualizarEmpleados->NSS))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>{{ $visualizarEmpleados->NSS}}</span>
                                </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 far fa-building text-white"></i>CURP</strong>
                                @if (is_null($visualizarEmpleados->CURP))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>{{ $visualizarEmpleados->CURP}}</span>
                                </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 far fa-building text-white"></i>RFC</strong>
                                @if (is_null($visualizarEmpleados->RFC))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>{{ $visualizarEmpleados->RFC}}</span>
                                </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-birthday-cake text-white"></i>Fecha de nacimiento</strong>
                                @if (is_null($visualizarEmpleados->cumpleaños))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>{{ $visualizarEmpleados->cumpleaños}}</span>
                                </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-birthday-cake text-white"></i>Lugar de nacimiento</strong>
                                @if (is_null($visualizarEmpleados->lugar_nacimiento))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>{{ $visualizarEmpleados->lugar_nacimiento}}</span>
                                </div>
                                @endif
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-birthday-cake text-white"></i>País de nacimiento</strong>
                                @if (is_null($visualizarEmpleados->nacionalidad))
                                <label class="ml-4">Sin registro</label>
                                @else
                                <div style="margin-left:28px;">
                                    
                                    <span>{{ $visualizarEmpleados->nacionalidad}}</span>
                                </div>
                                @endif
                                <br>
                                {{-- {{$contactos}} --}}
                                <strong><i class="ml-2 mr-2 fas fa-birthday-cake text-white"></i>Contáctos de emergencia</strong>
                                {{-- <ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-4">
                                    @foreach($contactos as $contacto)
                                        <li>
                                            <div class="thumb">
                                                <h3 class="thumbTitle">Nombre: {{$contacto->nombre}}</h3>
                                                <h3 class="thumbTitle">Teléfono: {{$contacto['telefono']}}</h3>
                                                <h3 class="thumbTitle">Parentesco: {{$contacto['parentesco']}}</h3>
                                               
                                            </div>
                                        </li>
                                    @endforeach
                                </ul> --}}
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Parentesco</th>
                
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contactos as $contacto)
                                            <tr>
                                                <td>{{ $contacto->nombre}}</td>
                                                <td>{{ $contacto->telefono }}</td>
                                                <td>{{ $contacto->parentesco}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <strong><i class="ml-2 mr-2 fas fa-birthday-cake text-white"></i>Dependientes económicos</strong>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Parentesco</th>
                
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dependientes as $dependiente)
                                            <tr>
                                                <td>{{ $dependiente->nombre}}</td>
                                                <td>{{ $dependiente->parentesco}}</td>
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
                                   {{-- @foreach($puesto->competencias as $competencia)
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
