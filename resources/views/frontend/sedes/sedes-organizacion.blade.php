@extends('layouts.frontend')
@section('content')

    {{ Breadcrumbs::render('admin.portal-comunicacion.sedes-organizacion') }}

    <div class="mt-5 card">

        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Sedes</strong></h3>
        </div>

        @if ($numero_sedes > 0)

            <div class="row justify-content-center">
                @foreach ($sede as $sedes)
                    <div class="col-4 justify-content-center">
                        <div class="card justify-content-center">
                            <div class="card-header">
                                @if (is_null($sedes->foto_sedes))
                                    <img class="card justify-content-center" style="height: 165px; margin:auto;"
                                        src="{{ asset('storage/sedes/imagenes/organizacion.png') }}" alt=""
                                        class="img-fluid">
                                @else
                                    <img class="card justify-content-center" style="height: 180px; margin:auto;"
                                        src="{{ asset('storage/sedes/imagenes/' . $sedes->foto_sedes) }}" alt=""
                                        class="img-fluid">

                                @endif

                            </div>

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-10">
                                        <p><strong>Sede:</strong> {{ $sedes->sede }}</p>

                                        <p><strong>Dirección:</strong> {{ $sedes->direccion }}</p>
                                    </div>
                                    <div class="col-2">
                                        <p><a href="sede-ubicacionorganizacion/{{ $sedes->id }}" target="_blank"><i
                                                    class="fas fa-map-marked-alt fa-2x text-info "></i></a></p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                @endforeach

                <div class=" col-12 d-flex justify-content-center">
                    {!! $sede->links() !!}
                </div>

            </div>


        @else

            <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">

                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Atención</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Aún no se han agregado Sedes a la
                            organización
                            <a href="{{ route('sedes.create') }}" class="item-right col-2 btn text-light"
                                style="background-color:rgb(85, 217, 226); float:right">Agregar</a>

                        </p>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-center">
                <img src="{{ asset('img/ubicacion.jpg') }}" alt="No se pudo cargar el organigrama" class="mt-3"
                    style="height: 390px;">
            </div>
        @endif

    </div>

@endsection
