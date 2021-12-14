@extends('layouts.admin')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/colores.css') }}">

<style>

input, textarea{

    border:none !important;
    border-bottom: 1px solid #1BB0B0 !important;
    border-radius: 0 !important;
    resize: none;
}
input{
    background-color: rgba(0,0,0,0) !important;
}
textarea{
    background-color: #fff;
}
.c_text{
    height:150px !important;
    overflow:auto !important;
    background-color:#f1f1f1;
    padding:10px;
    border-radius:5px;
}

</style>

@if (!is_null($organizacion))
<div class="card-body card">
    <div class="row">

        <div class="col-md-12 col-sm-12">
            <div class="card vrd-agua">
                <span class="mb-1 text-center text-white">DATOS GENERALES</span>
            </div>
        </div>

        <div class="row p-0 col-12" style="">
            <div class="col-md-6" style="margin-top:0px;transform: scale(0.7);margin-top:-40px;margin-right:10px;">
                <img class="bg-light" src="{{ url($logotipo) }}" alt="Card image" style="width:100%;">
                @if ($errors->has('logotipo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('logotipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organizacion.fields.logotipo_helper') }}</span>
            </div>

            <div class="col-md-6 row">
                <div class="form-group col-sm-12 col-md-12">
                    <label class="" for="empresa"><i class="far fa-building iconos-crear"></i> Nombre de la
                        Empresa
                    </label>
                    <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text"
                        name="empresa" id="empresa" value="{{ $organizacion->empresa }}" disabled>
                    @if ($errors->has('empresa'))
                        <div class="invalid-feedback">
                            {{ $errors->first('empresa') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span>
                </div>

                <div class="form-group col-sm-12">
                    <label class="" for="razon_social"><i class="far fa-building iconos-crear"></i> Razón Social</label>
                    <input class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}" type="text" name="razon_social" id="razon_social" value="{{ $organizacion->razon_social }}" disabled>
                    @if($errors->has('razon_social'))
                        <div class="invalid-feedback">
                            {{ $errors->first('razon_social') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-sm-12">
                    <label class="" for="rfc"><i class="fas fa-barcode iconos-crear"></i>RFC</label>
                    <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text" name="rfc" id="rfc" value="{{ $organizacion->rfc }}" disabled>
                    @if($errors->has('rfc'))
                        <div class="invalid-feedback">
                            {{ $errors->first('rfc') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <div class="row col-md-12">
            <div class="form-group col-sm-12 col-md-12">
                <label class="" for="direccion"> <i class="fas fa-map-marker-alt iconos-crear"></i>
                    {{ trans('cruds.organizacion.fields.direccion') }}
                </label>
                <input class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" type="text"
                    name="direccion" id="direccion" value=" {{ $organizacion->direccion }}" disabled>
                @if ($errors->has('direccion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('direccion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organizacion.fields.direccion_helper') }}</span>
            </div>

            <div class="form-group col-sm-12 col-md-4">
                <label for="telefono"> <i class="fas fa-phone iconos-crear"></i> Teléfono
                </label>
                <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" type="number"
                    name="telefono" id="telefono" value="{{ $organizacion->telefono }}" disabled>
                @if ($errors->has('telefono'))
                    <div class="invalid-feedback">
                        {{ $errors->first('telefono') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organizacion.fields.telefono_helper') }}</span>
            </div>


            <div class="form-group col-sm-12 col-md-4">
                <label for="correo"> <i class="far fa-envelope iconos-crear"></i>
                    {{ trans('cruds.organizacion.fields.correo') }}
                </label>
                <input class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}" type="email"
                    name="correo" id="correo" value="{{ $organizacion->correo }}" disabled>
                @if ($errors->has('correo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('correo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organizacion.fields.correo_helper') }}</span>
            </div>



            <div class="form-group col-sm-12 col-md-4">
                <label for="pagina_web"> <i class="fas fa-pager iconos-crear"></i> Página Web
                </label>
                <input class="form-control {{ $errors->has('pagina_web') ? 'is-invalid' : '' }}" type="text"
                    name="pagina_web" id="pagina_web" value="{{ $organizacion->pagina_web }}" disabled>
                @if ($errors->has('pagina_web'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pagina_web') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organizacion.fields.pagina_web_helper') }}</span>
            </div>
            <div class="form-group col-sm-3">
                <label class="" for="dia_inicio"><i class="fas fa-user-tie iconos-crear"></i>Día Laboral inicio</label>
                <input class="form-control {{ $errors->has('dia_inicio') ? 'is-invalid' : '' }}" type="text" name="dia_inicio" id="dia_inicio" value="{{ $organizacion->dia_inicio }}" disabled>
                @if($errors->has('dia_inicio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dia_inicio') }}
                    </div>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span> --}}
            </div>
            <div class="form-group col-sm-3">
                <label class="" for="hora_laboral_inicio"><i class="fas fa-user-clock iconos-crear"></i>Horario Laboral Inicio</label>
                <input class="form-control {{ $errors->has('hora_laboral_inicio') ? 'is-invalid' : '' }}" type="time" name="hora_laboral_inicio" id="hora_laboral_inicio" value="{{ $organizacion->hora_laboral_inicio }}" disabled>
                @if($errors->has('hora_laboral_inicio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hora_laboral_inicio') }}
                    </div>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span> --}}
            </div>
            <div class="form-group col-sm-3">
                <label class="" for="dia_fin"><i class="fas fa-user-tie iconos-crear"></i>Día Laboral Fin</label>
                <input class="form-control {{ $errors->has('dia_fin') ? 'is-invalid' : '' }}" type="text" name="dia_fin" id="dia_fin" value="{{ $organizacion->dia_fin }}" disabled>
                @if($errors->has('dia_fin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dia_fin') }}
                    </div>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span> --}}
            </div>
            <div class="form-group col-sm-3">
                <label class="" for="hora_laboral_fin"><i class="fas fa-user-clock iconos-crear"></i>Horario Laboral Fin</label>
                <input class="form-control {{ $errors->has('hora_laboral_fin') ? 'is-invalid' : '' }}" type="time" name="hora_laboral_fin" id="hora_laboral_fin" value="{{ $organizacion->hora_laboral_fin }}" disabled>
                @if($errors->has('hora_laboral_fin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hora_laboral_fin') }}
                    </div>
                @endif
                {{-- <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span> --}}
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="card vrd-agua">
                    <p class="mb-1 text-center text-white">DATOS COMPLEMENTARIOS</p>
                </div>
            </div>

            <div class="form-group  col-sm-12 col-md-6">
                <label class="" for="representante_legal"><i class="fas fa-user-tie iconos-crear"></i>Representante Legal</label>
                <input class="form-control {{ $errors->has('representante_legal') ? 'is-invalid' : '' }}" type="text" name="representante_legal" id="representante_legal" value="{{ $organizacion->representante_legal }}" disabled>
                @if($errors->has('representante_legal'))
                    <div class="invalid-feedback">
                        {{ $errors->first('representante_legal') }}
                    </div>
                @endif

            </div>


            <div class="form-group  col-sm-3 col-md-6">
                <label for="fecha_constitucion"> <i class="far fa-calendar-alt iconos-crear"></i>Fecha de constitución</label>
                <input class="form-control date {{ $errors->has('fecha_constitucion') ? 'is-invalid' : '' }}" type="date" name="fecha_constitucion" id="fecha_constitucion" value="{{ $organizacion->fecha_constitucion  }}" disabled>
                @if($errors->has('fecha_constitucion'))
                <div class="invalid-feedback">
                    {{ $errors->first('fecha_constitucion') }}
                </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="" for="num_empleados"><i class="fas fa-users iconos-crear"></i>Número de empleados</label>
                <input class="form-control {{ $errors->has('num_empleados') ? 'is-invalid' : '' }}" type="number" name="num_empleados" id="num_empleados" value="{{ $organizacion->num_empleados }}" disabled>
                @if($errors->has('num_empleados'))
                    <div class="invalid-feedback">
                        {{ $errors->first('num_empleados') }}
                    </div>
                @endif

            </div>
            <div class="form-group  col-sm-12 col-md-6">
                <label class="" for="tamano"><i class="fas fa-boxes iconos-crear"></i>Tamaño</label>
                <input class="form-control {{ $errors->has('tamano') ? 'is-invalid' : '' }}" type="text" name="tamano" id="tamano" value="{{ $organizacion->tamano }}" disabled>
                @if($errors->has('tamano'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tamano') }}
                    </div>
                @endif

            </div>


            <div class="form-group col-sm-12 col-md-6">
                <label for="giro"> <i class="fas fa-briefcase iconos-crear"></i>
                    {{ trans('cruds.organizacion.fields.giro') }}
                </label>
                <input class="form-control {{ $errors->has('giro') ? 'is-invalid' : '' }}" type="text"
                    name="giro" id="giro" value="{{ $organizacion->giro }}" disabled>
                @if ($errors->has('giro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('giro') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organizacion.fields.giro_helper') }}</span>
            </div>
            <div class="form-group col-sm-12 col-md-6">
                <label for="servicios"><i class="fas fa-briefcase iconos-crear"></i>
                    {{ trans('cruds.organizacion.fields.servicios') }}
                </label>
                <input class="form-control {{ $errors->has('servicios') ? 'is-invalid' : '' }}" type="text"
                    name="servicios" id="servicios" value="{{ $organizacion->servicios }}" disabled>
                @if ($errors->has('servicios'))
                    <div class="invalid-feedback">
                        {{ $errors->first('servicios') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organizacion.fields.servicios_helper') }}</span>
            </div>

            <div class="form-group col-sm-12 col-md-6">
                <label for="mision"> <i class="fas fa-flag iconos-crear"></i>
                    {{ trans('cruds.organizacion.fields.mision') }}</label>
                <div class="c_text">{!! $organizacion->mision !!}</div>
                @if ($errors->has('mision'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mision') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organizacion.fields.mision_helper') }}</span>
            </div>
            <div class="form-group col-sm-12 col-md-6">
                <label for="vision"> <i class="far fa-eye iconos-crear"></i>
                    {{ trans('cruds.organizacion.fields.vision') }}</label>
                <div class="c_text">{!! $organizacion->vision !!}</div>
                @if ($errors->has('vision'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vision') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organizacion.fields.vision_helper') }}</span>
            </div>
            <div class="form-group col-sm-12 col-md-6">
                <label for="valores"> <i class="far fa-heart iconos-crear"></i>
                    {{ trans('cruds.organizacion.fields.valores') }}
                </label>
                <div class="c_text">{!! $organizacion->valores !!}</div>
                @if ($errors->has('valores'))
                    <div class="invalid-feedback">
                        {{ $errors->first('valores') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.organizacion.fields.valores_helper') }}</span>
            </div>

            <div class="form-group col-sm-12 col-md-6">
                <label for="antecedentes"> <i class="far fa-file-alt iconos-crear"></i> Antecedentes
                </label>
                <div class="c_text" >{!! $organizacion->antecedentes !!}</div>
                <span class="help-block">{{ trans('cruds.organizacion.fields.valores_helper') }}</span>
            </div>
        </div>
    </div>
</div>
@else
<img src="{{asset('img/portal_404.png') }} " style="width: 40%;margin-left: 25%;">
@endif



@endsection
