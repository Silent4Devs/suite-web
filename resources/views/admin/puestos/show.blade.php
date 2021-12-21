@extends('layouts.admin')
@section('content')



    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong>Perfil de Puesto</strong></h3>
        </div>

        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body">

                    @php
                        use App\Models\Organizacion;
                        $organizacion = Organizacion::first();
                        $logotipo = $organizacion->logotipo;
                    @endphp

                    <div class="row mb-5">
                        <div class="col-sm-12 col-md-3">
                            <div class="text-center d-flex flex-column align-items-center">
                                <img class="img-fluid img-profile" style="position: relative;"
                                    src="{{ asset($logotipo) }}">

                            </div>
                        </div>

                        <div class="col-sm-12 col-md-9">
                            <h3 class="mb-1 mt-3 ml-4" style="color:#0CA193;">  {{ $puesto->puesto }} </h3>

                            {{-- <h5 class="py-2 pl-2 ml-3"
                            style="color:#fff; font-weight:bold; background-color:#7F7F7F; width:80%">
                            {{ $puesto->puesto }} </h5> --}}


                                <div class="ml-4 mt-5" style="text-align: justify !important;">
                                    {{-- <h5 class="d-inline-block; ">
                                    </h5>
                                    <hr class="hr-custom-title"> --}}

                                    <div  class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #0CA193;">
                                        <span style="font-size: 17px; font-weight: bold;">
                                            <i class="mr-2 far fa-sticky-note"></i>Descripción</span>
                                    </div>

                                      <p style="text-align: justify !important;">  {!! $puesto->descripcion !!} </p>

                                </div>

                        </div>
                    </div>




                </div>
            </div>

        </div>

    </div>




@endsection
