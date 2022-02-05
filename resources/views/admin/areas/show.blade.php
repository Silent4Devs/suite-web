@extends('layouts.admin')
@section('content')



       <h5 class="col-12 titulo_general_funcion">Área</h5>


    <div class="card-body">
        <div class="form-group">

            <div class="card">
                <div class="card-body">
                    <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                        {{ $area->area }}</div>
                    <div class="row col-12 mt-3">
                        <div class="col-6">
                            @if(is_null($area->foto_area))
                                No hay foto
                            @else
                            <img class="card justify-content-center" style="width:300px;"
                            src="{{asset("storage/areas/".$area->foto_area)}}" alt=""
                            class="img-fluid">
                            @endif
                        </div>
                        <div class="col-6">
                            <span><strong>Grupo:</strong> {{$area->grupo->nombre}}</span>
                            <br>
                            <span><strong>Reportará a:</strong> {{$area->supervisor->name}}</span>
                            <br>
                            <strong>Descripción: </strong>
                            <span>{{$area->descripcion}}</span>
                        </div>
                    </div>
                </div>
            </div>




            </card>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.areas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>




@endsection
