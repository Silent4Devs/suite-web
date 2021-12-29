@extends('layouts.admin')
@section('content')

@section('styles')
    <style type="text/css">
        .caja_titulo {
            position: relative;
            width: 100%;
        }

        .logo_organizacion_politica {
            height: 150px;
            position: absolute;
            right: 50px;
            bottom: 0;
        }

        .caja_titulo h1 {
            width: 300px;
            font-weight: bold;
            color: #00abb2;
            bottom: 0;
        }
        .form-group{
            color: #fff;
        }
        .iconos-crear{
            color: #fff !important;
        }
    </style>
@endsection
{{ Breadcrumbs::render('admin.politicaSgsis.visualizacion') }}
<div class="card card-body" style="margin-top: -50PX;">
    <div class="row" style="border-bottom: 2px solid #ccc;">
        <div class="col-12 caja_titulo">
            <h1>Politíca</h1>

        </div>
    </div>
    @if ($politicaSgsis)
        <div class="row" style="">
            <div class="col-lg-9">
                <p>
                    {!! $politicaSgsis->politicasgsi !!}
                </p>
            </div>

            <div class="col-lg-3" style="background-color:#00abb2; padding-top: 10px;">
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
                <strong style="color:#fff;">Revisó:</strong>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                    <div class="form-control">{{ $politicaSgsis->reviso->name }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control">{{ $politicaSgsis->reviso->puesto }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control">{{ $politicaSgsis->reviso->area->area }}</div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <h1>Sin registro</h1>
        </div>
    @endif
</div>
@endsection
