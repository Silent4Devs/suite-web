@extends('layouts.admin')
@section('content')

    <style type="text/css">

        .datos_der_cv{
            color: #fff;

        }
        .tabla_verde{
            color: #fff !important;
        }

        .tabla_verde.table-striped tbody tr:nth-of-type(odd), table.table tbody tr:nth-child(even) {
            background-color: rgba(0, 0, 0, 0);
        }
        .tabla_verde th{
            background-color:rgb(0, 0, 0, 0) !important;
        }
        @media print{
            header{
                display:none !important;
            }
            .ps__rail-y{
                display:none !important;
            }
            .ps__thumb-y{
                display:none !important;
            }
            .titulo_general_funcion{
                display:none !important;
            }
            #sidebar{
                display:none !important;
            }
            body{
                background-color: #fff !important;
            }
            #but{
                display:none !important;
            }
            .datos_der_cv{
                margin-right: -50px !important;


            }
            .table th td:nth-child(1) {
                min-width: 100px;
            }
        }
    </style>

    {{-- {{ Breadcrumbs::render('mi-perfil-puesto') }} --}}

    {{-- @if (is_null($visualizarEmpleados->name)) --}}
    {{-- <label class="ml-4">Sin registro</label> --}}
    {{-- @else --}}
    <h5 class="col-12 titulo_general_funcion">Folio {{$accionCorrectiva->folio}}</h5>
    {{-- @endif --}}
    {{-- {{$accionCorrectiva->reporto}} --}}
    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body" id="imp1">

                    {{-- <div class="col-md-4"> --}}
                        {{-- <div class="mb-4 d-flex" style="margin-left: 70%;position: absolute;top: 4%;" >
                            <a class="btn btn-danger" href="javascript:window.print()" id="but" >Imprimir</a>
                        </div> --}}


                    {{-- </div> --}}
                    @php
                        use App\Models\Organizacion;
                        $organizacion = Organizacion::first();
                        $logotipo = $organizacion->logotipo;
                    @endphp
                    <div class="caja_img_logo">
                        <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width: 100px;">
                    </div>

                    <div class="row medidas d-flex" style="justify-content: space-between;">
                        <div class="mt-4 ml-4 col-sm-12 datos_iz_cv">
                            <div class="mb-4 d-flex" style="margin-left: 70%;position: absolute;top: 4%;" >
                                <span style="margin-right: 10px;"><strong>Fecha de la AC</strong></span>
                                <span class="">{{$accionCorrectiva->fecharegistro ? \Carbon\Carbon::parse($accionCorrectiva->fecharegistro)->format('d-m-Y') : 'sin registro' }}</span>
                            </div>
                            <h5 class="py-2 pl-2"
                                style="font-size:15pt; color:#0CA193">
                                Folio {{ $accionCorrectiva->folio ?? 'sin registro' }}</h5>
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="text-align: center;">
                                <span style="font-size: 24px; font-weight: bold;">{{$accionCorrectiva->tema ?? 'sin registro'}}</span>
                            </div>


                            <div class="mt-4 mb-3 w-100 dato_mairg">
                                <div class="form-group">
                                    <span><strong style="color:#0CA193">Causa de origen : </strong> <strong>{{$accionCorrectiva->causaorigen ?? 'sin registro' }} </strong></span>
                                </div>
                                <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                    <span style="font-size: 17px; font-weight: bold;">
                                        Descripción</span>
                                </div>
                                <div class="form-group">
                                    <span style="text-align: justify;">{!!$accionCorrectiva->descripcion ?? 'sin registro' !!}  </span>
                                </div>
                                <div class="form-group">
                                    <span style="text-align: justify;"><strong style="color:#0CA193;">Área(s) afectada(s) : </strong>{{$accionCorrectiva->areas ?? 'sin registro' }}  </span>
                                </div>
                                <div class="form-group">
                                    <span style="text-align: justify;"><strong style="color:#0CA193;">Proceso(s) afectado(s) : </strong>{{$accionCorrectiva->procesos ?? 'sin registro' }}  </span>
                                </div>
                                <div class="form-group">
                                    <span style="text-align: justify;"><strong style="color:#0CA193;">Activo(s) afectado(s) : </strong>{{$accionCorrectiva->activos ?? 'sin registro' }}  </span>
                                </div>
                                <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                    <span style="font-size: 17px; font-weight: bold;">
                                        Comentarios</span>
                                </div>
                                <div class="form-group">
                                    <span style="text-align: justify;">{!!$accionCorrectiva->comentarios ?? 'sin registro' !!}  </span>
                                </div>
                            </div>
                            <table class="w-100 mb-5 mt-5">
                                <thead style="background-color:#0CA193;color:#fff;text-align:center">
                                    <tr>
                                        <th style = "width: 50% !important;">
                                            Reportó
                                        </th>
                                        <th style = "width: 50% !important;">
                                            Registró
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align:center; vertical-align: initial;">
                                            <img src="{{ asset('storage/empleados/imagenes') }}/{{ $accionCorrectiva->reporto->name ? $accionCorrectiva->reporto->avatar : "user.png"}}"
                                                class="img_empleado text-center mt-1">
                                            <br>
                                            <span><strong>{{ $accionCorrectiva->reporto ? $accionCorrectiva->reporto->name : 'Sin definir' }}</strong></span>
                                            <br>
                                            <span>{{ $accionCorrectiva->reporto ? $accionCorrectiva->reporto->puesto : 'Sin definir'}}</span>
                                            <br>
                                            <span style="color:#0CA193">{{$accionCorrectiva->reporto ? $accionCorrectiva->reporto->area->area : 'Sin definir'  }}</span>
                                        </td>


                                        <td style="text-align:center; vertical-align: initial;">
                                            <img src="{{ asset('storage/empleados/imagenes') }}/{{ $accionCorrectiva->empleados ? $accionCorrectiva->empleados->avatar : "user.png"}}"
                                                class="img_empleado text-center mt-1">
                                            <br>
                                            <span><strong>{{ $accionCorrectiva->empleados ? $accionCorrectiva->empleados->name : 'Sin definir' }}</strong></span>
                                            <br>
                                            <span>{{ $accionCorrectiva->empleados ? $accionCorrectiva->empleados->puesto : 'Sin definir'}}</span>
                                            <br>
                                            <span style="color:#0CA193">{{ $accionCorrectiva->empleados ? $accionCorrectiva->empleados->area->area : 'Sin definir' }}</span>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>



@endsection
@section('scripts')
{{-- <script>
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
</script> --}}
@endsection
