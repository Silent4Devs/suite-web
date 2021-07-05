@extends('layouts.admin')
@section('content')


    <div class="mt-5 card">

        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Áreas</strong></h3>
        </div>



        @if ($numero_areas > 0)

            <div class="row justify-content-center">
                @foreach ($area as $areas)
                    <div class="col-4 justify-content-center">
                        <div class="card justify-content-center">
                            <div class="card-header">

                            </div>

                            <div class="card-body">

                                {{-- <p><strong>Sede:</strong> {{  }}</p> --}}

                            </div>

                        </div>
                    </div>


                <div class=" col-12 d-flex justify-content-center">

                </div>
                @endforeach
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
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Aún no se han agregado áreas a la
                            organización
                            <a href="{{ route('admin.sedes.create') }}"><i class="fas fa-share"></i></a>
                        </p>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-center">
                <img src="{{ asset('img/areas.jpg') }}" class="mt-3"
                    style="height: 400px;">
            </div>
        @endif

    </div>





@endsection
