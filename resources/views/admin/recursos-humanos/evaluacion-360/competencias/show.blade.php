


@extends('layouts.admin')
@section('content')

<style>


    .competencia {
        clip-path: circle(120px at 50% 50%);
        width: 250px !important;
        height: 250px !important;
        min-width: 250px !important;
        max-width: 250px !important;

        max-height: 250px !important;
        min-height: 250px !important;
        margin:auto !important;
    }

</style>


    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items:center; color: #fff; background-color:#345183; font-size:20px;" class="card-header">
            <span><img class="img_empleado mr-4" src="{{$competencia->imagen_ruta}}">
            <strong>{{ $competencia->nombre }}</strong></span>
            <span class="mr-2">Tipo: {{ $competencia->tipo ? $competencia->tipo->nombre : '' }}</span>
        </div>
                <div class="card-body">
                    <div class="form-group">
                            <div>
                                <div>
                                    <div >
                                        <div class="modal-body">
                                            <div class="mt-3">
                                                <strong>Descripción: </strong>
                                                <p style="text-align: justify;">
                                                    {{$competencia->descripcion}}
                                                </p>
                                            </div>

                                            <div>
                                                <strong style="font-size: 15px;">Conductas</strong>

                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <td>Nivel</td>
                                                            <td>Conducta esperada</td>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if($competencia->opciones)
                                                            @foreach($competencia->opciones as $conducta)
                                                                <tr>
                                                                    <td>{{ $conducta->ponderacion }}</td>
                                                                    <td>{!! htmlspecialchars_decode($conducta->definicion) !!}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <a class="btn btn-default" href="{{ route('admin.ev360-competencias.index') }}">
                                        {{ trans('global.back_to_list') }}
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>
    </div>





@endsection

