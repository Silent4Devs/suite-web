
@extends('layouts.admin')
@section('content')

<link rel="stylesheet" type="text/css" href="{{asset('css/print_foda.css')}}">

<style>

@media print{
        .print-none{
            display: none !important;
        }
    }


</style>

<div class="print-none">
    {{ Breadcrumbs::render('admin.alcance-sgsis.create') }}
</div>
<div class="card">


    {{-- <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.alcance-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $alcanceSgsi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Nombre de Alcance
                        </th>
                        <td>
                            {{ $alcanceSgsi->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Descripción de Alcance
                        </th>
                        <td>
                            {{ $alcanceSgsi->alcancesgsi}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Apróbo
                        </th>
                        <td>
                            {{ $alcanceSgsi->empleado->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Fecha de publicación
                        </th>
                        <td>
                            {{ $alcanceSgsi->fecha_publicacion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Fecha de entrada en vigor
                        </th>
                        <td>
                            {{ $alcanceSgsi->fecha_entrada}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Fecha de revisión
                        </th>
                        <td>
                            {{ $alcanceSgsi->fecha_revision }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Normas
                        </th>
                        <td>
                            {{ $alcanceSgsi->normas }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.alcance-sgsis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div> --}}

    <div class="card-body">

        <button class="btn btn-danger print-none" style="position: absolute; right:20px;" onclick="javascript:window.print()">
            <i class="fas fa-print"></i>
            Imprimir
        </button>

        @php
            use App\Models\Organizacion;
            $organizacion = Organizacion::first();
            $logotipo = $organizacion->logotipo;
        @endphp
         <div class="row">
            <div class="col-4">
                <img src="{{ asset($logotipo) }}" class="mt-2 ml-4" style="width:130px;">
            </div>

            <div class="col-8 mt-4 ">
                <h3 class="mb-2 ml-5" style="color:#345183"><strong>Determinación de alcance</strong></h3>
            </div>
        </div>

        <div class="mt-5">
            <h5 class="col-12 text-center" style="font-size:13pt;"><strong>{{$alcanceSgsi->nombre?? 'sin registro'}}</strong></h5>
        </div>

        <div class="row mt-5 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">

            <div class="col-6 pl-0" style="border-right: 2px solid #ccc">
                <div class="row">
                    <div class="col-3">
                        <strong style="font-size:12px; color:#345183">Aprobó</strong>
                    </div>
                    <div class="col-9">
                        <p style="font-size:12px; color:#345183">
                            {{ Str::limit($alcanceSgsi->empleado->name, 25, '...') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <strong style="font-size:12px; color:#345183">Puesto</strong>
                    </div>
                    <div class="col-9">
                        <p style="font-size:12px; color:#345183">
                            {{ Str::limit($alcanceSgsi->empleado->puesto, 25, '...') }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <strong style="font-size:12px; color:#345183">Área</strong>
                    </div>
                    <div class="col-9">
                        <p style="font-size:12px; color:#345183">
                            {{ $alcanceSgsi->responsables ? $alcanceSgsi->area->area : 'Sin definir' }}
                        </p>
                    </div>
                </div>
            </div>

                <div class="col-6">
                    <div class="row">
                        <div class="col-5">
                            <strong style="font-size:12px; color:#345183">Fecha de publicación</strong>
                        </div>
                        <div class="col-7">
                            <p style="font-size:12px; color:#345183">{{$alcanceSgsi->fecha_publicacion}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <strong style="font-size:12px; color:#345183"> Fecha de entrada en vigor</strong>
                        </div>
                        <div class="col-7">
                            <p style="font-size:12px; color:#345183">{{$alcanceSgsi->fecha_entrada}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <strong style="font-size:12px; color:#345183"> Fecha de revisión</strong>
                        </div>
                        <div class="col-7">
                            <p style="font-size:12px; color:#345183">{{$alcanceSgsi->fecha_revision}}</p>
                        </div>
                    </div>
                </div>
        </div>

        <div class="mt-5 mb-3  dato_mairg" style="border-bottom: solid 2px #345183;">
            <span style="font-size: 17px; font-weight: bold; ml-4">
                Descripción</span>
        </div>

        <div class="px-2 mt-2">
             {!!$alcanceSgsi->alcancesgsi!!}
        </div>

        <div class="mt-5 mb-3  dato_mairg" style="border-bottom: solid 2px #345183;">
            <span style="font-size: 17px; font-weight: bold; ml-4">
                Normas</span>
        </div>

        <ul>
            @foreach($alcanceSgsi->normas as $norma)
            <li style="font-size:12px;">
                {{ $norma->norma }}
            </li>
            @endforeach
        </ul>

    </div>
</div>



@endsection


@section('scripts')

    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>


@endsection
