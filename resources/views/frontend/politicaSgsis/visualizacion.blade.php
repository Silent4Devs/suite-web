@extends('layouts.frontend')
@section('content')

@section('styles')
    <style type="text/css">
        .caja_titulo {
            position: relative;
            width: 100%;
            height: 150px;
        }

        .logo_organizacion_politica {
            height: 150px;
            position: absolute;
            right: 50px;
            bottom: 0;
        }

        .caja_titulo h1 {
            position: absolute;
            width: 300px;
            font-weight: bold;
            color: #345183;
            bottom: 0;
        }
    </style>
@endsection
{{-- {{ Breadcrumbs::render('frontend.politicaSgsis.visualizacion') }} --}}
<div class="card card-body" style="margin-top: -50PX;">
    <div class="row" style="border-bottom: 2px solid #ccc;">
        <div class="col-12 caja_titulo">
            <h1>Politíca del SGSI</h1>

            @php
                use App\Models\Organizacion;
                $organizacion = Organizacion::getFirst();
                $logotipo = $organizacion->logotipo;
            @endphp
            <img src="{{ asset($logotipo) }}" class="logo_organizacion_politica">

        </div>
    </div>
    @if ($politicaSgsis)
        <div class="row" style="">
            <div class="col-lg-9">
                <p>
                    {!! $politicaSgsis->politicasgsi !!}
                </p>
            </div>

            <div class="mt-3 col-lg-3">
                <div class="form-group">
                    <label class="form-label"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de
                        publicación</label>
                    <div class="form-control">{{ $politicaSgsis->fecha_publicacion }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de entrada en
                        vigor</label>
                    <div class="form-control">{{ $politicaSgsis->fecha_entrada }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de
                        revisión</label>
                    <div class="form-control">{{ $politicaSgsis->fecha_revision }}</div>
                </div>
            </div>
            <strong class="col-12">Revisó:</strong><br /><br />
            <div class="form-group col-md-4">
                <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                <div class="form-control">{{ $politicaSgsis->reviso->name }}</div>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                <div class="form-control">{{ $politicaSgsis->reviso->puesto }}</div>
            </div>
            <div class="form-group col-md-4">
                <label class="form-label"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                <div class="form-control">{{ $politicaSgsis->reviso->area->area }}</div>
            </div>
        </div>
    @else
        <div class="row">
            <h1>Sin registro</h1>
        </div>
    @endif
</div>
@endsection
