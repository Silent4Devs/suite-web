@extends('layouts.admin')
@section('content')

    <style type="text/css">
        .card_textarea{
            background-color: rgba(0, 0, 0, 0.03);
        }
    </style>
    
    <h5 class="col-12 titulo_general_funcion">Perfil de Puesto: <strong>{{$puesto->puesto}}</strong></h5>

    <div class="card-body card">

        <div class="row">

            <div class="form-group col-md-4">
                <label for="puesto"><i class="fas fa-briefcase iconos-crear"></i>Nombre del puesto</label>
                <div class="form-control">{{$puesto->puesto}}</div>
            </div>

            <div class="form-group col-md-4">
                <label for="id_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                <div class="form-control">{{ $puesto->id_area ? $puesto->area->area : ''}}</div>
            </div>

            <div class="form-group col-md-4">
                <label for="fecha_puesto"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de creación</label>
                <div class="form-control">{{$puesto->fecha_puesto}}</div>
            </div>

            @if($puesto->empleados)

                <div class="form-group col-md-4">
                    <label for="id_reporta"><i class="fas fa-user-tie iconos-crear"></i>Reportará a</label>
                    <div class="form-control">{{$puesto->empleados->name}}</div>
                </div>

                <div class="form-group col-md-4">
                    <label for="id_puesto_reviso"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <div class="form-control">{{$puesto->empleados->puesto}}</div>
                </div>

                <div class="form-group col-md-4">
                    <label for="id_area_reviso"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                    <div class="form-control">{{ $puesto->id_reporta ? $puesto->empleados->area->area : ''}}</div>
                </div>
            @endif

            <div class="form-group col-md-6">
                <label for="lugar_trabajo"><i class="far fa-building iconos-crear"></i>Lugar de trabajo</label>
                <div class="form-control">{{$puesto->lugar_trabajo}}</div>
            </div>

            <div class="form-group col-md-6">
                <label class="" for="horario"><i class="fas fa-business-time iconos-crear"></i>Horario laboral</label>
                <div class="form-control">{{$puesto->horario}}</div>
            </div>

            <div class="form-group col-12">
                <label for="descripcion"><i class="fas fa-clipboard-list iconos-crear"></i>Descripción del puesto</label>
                <div class="card-body card mt-2 card_textarea">{!! htmlspecialchars_decode($puesto->descripcion) !!}</div>
            </div>

            <div class="form-group col-12">
                <label for="estudios"><i class="fas fa-graduation-cap iconos-crear"></i>Educación Academica(estudios)<span class="text-danger">*</span></label>
                <div class="card-body card mt-2 card_textarea">{!! htmlspecialchars_decode($puesto->estudios) !!}</div>
            </div>

            <div class="form-group col-12">
                <label for="experiencia"><i class="fas fa-briefcase iconos-crear"></i>Experiencia Profesional</label>
                <div class="card-body card mt-2 card_textarea">{!! htmlspecialchars_decode($puesto->experiencia) !!}</div>
            </div>

            <div class="form-group col-12">
                <label for="conocimientos"><i class="fas fa-chalkboard-teacher iconos-crear"></i>Conocimientos</label>
                <div class="card-body card mt-2 card_textarea">{!! htmlspecialchars_decode($puesto->conocimientos) !!}</div>
            </div>
        
        </div>
    </div>
@endsection


@section('scripts')

    

@endsection