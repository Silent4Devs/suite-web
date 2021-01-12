@extends('layouts.admin')
@section('content')

<style>

.tarjeta{

margin-left:50px;
margin-top:20px;
border-radius: 3px;
border:solid;
border-color: #ccc;
width: 430px;
border-width: 1px;
padding-left: 5px;
padding-bottom: 20px;
padding-right: 5px;
padding-top: 5px;
}
.imagen_organizacion{
border-radius: 3px;
border:solid;
border-color: #ccc;
margin-left:500px;
margin-top:-110px;
border-width: 1px;
width: 500px;


}

.boton_organizacion{
margin-left:310px;

}

	@media(max-width: 796px){

.tarjeta{

  margin-left:15px;
  margin-top:20px;
  border:none;

}

.imagen_organizacion{

margin-left:335px;
margin-top:-110px;
width: 340px;

}

.boton_organizacion{

margin-left:100px;

}

 }
</style>

        <div class="card mt-5">
            <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2  text-center text-white"><strong>Mi Organización</strong></h3>
            </div>

        <br>
        @include('layouts.errors')
        @include('flash::message')

        @if($empty == TRUE)
        <div class="col-lg-12">
            @if(!empty($count == 1))
            @else
                <a class="btn btn-success" href="{{ route('admin.organizacions.create') }}">
                    Agregar organización
                </a>
            @endif
            <a href="{!! route('admin.organizacions.edit', [$organizacion->id]) !!}"
               class='btn btn-info float-right'>
                Editar organización
            </a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="required" for="empresa"><i
                            class="far fa-building iconos-crear"></i> {{ trans('cruds.organizacion.fields.empresa') }}
                    </label>
                    <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text"
                           name="empresa" id="empresa" value="{{ $organizacion->empresa }}" disabled>
                    @if($errors->has('empresa'))
                        <div class="invalid-feedback">
                            {{ $errors->first('empresa') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span>
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="direccion"> <i
                            class="fas fa-map-marker-alt iconos-crear"></i> {{ trans('cruds.organizacion.fields.direccion') }}
                    </label>
                    <textarea class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" name="direccion"
                              id="direccion" disabled
                              style="min-height: 0px; max-height: 200px; height: 35px;">{{ $organizacion->direccion }}</textarea>
                    @if($errors->has('direccion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('direccion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.direccion_helper') }}</span>
                </div>
                <div class="form-group col-sm-6">
                    <label for="telefono"> <i
                            class="fas fa-phone iconos-crear"></i> {{ trans('cruds.organizacion.fields.telefono') }}
                    </label>
                    <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" type="number"
                           name="telefono" id="telefono" value="{{ $organizacion->telefono  }}" disabled>
                    @if($errors->has('telefono'))
                        <div class="invalid-feedback">
                            {{ $errors->first('telefono') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.telefono_helper') }}</span>
                </div>
                <div class="form-group col-sm-6">
                    <label for="correo"> <i
                            class="far fa-envelope iconos-crear"></i> {{ trans('cruds.organizacion.fields.correo') }}
                    </label>
                    <input class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}" type="email"
                           name="correo" id="correo" value="{{ $organizacion->correo  }}" disabled>
                    @if($errors->has('correo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('correo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.correo_helper') }}</span>
                </div>
                <div class="form-group col-sm-6">
                    <label for="pagina_web"> <i
                            class="fas fa-pager iconos-crear"></i> {{ trans('cruds.organizacion.fields.pagina_web') }}
                    </label>
                    <input class="form-control {{ $errors->has('pagina_web') ? 'is-invalid' : '' }}" type="text"
                           name="pagina_web" id="pagina_web" value="{{ $organizacion->pagina_web  }}" disabled>
                    @if($errors->has('pagina_web'))
                        <div class="invalid-feedback">
                            {{ $errors->first('pagina_web') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.pagina_web_helper') }}</span>
                </div>
                <div class="form-group col-sm-6">
                    <label for="giro"> <i
                            class="fas fa-briefcase iconos-crear"></i> {{ trans('cruds.organizacion.fields.giro') }}
                    </label>
                    <input class="form-control {{ $errors->has('giro') ? 'is-invalid' : '' }}" type="text" name="giro"
                           id="giro" value="{{ $organizacion->giro  }}" disabled>
                    @if($errors->has('giro'))
                        <div class="invalid-feedback">
                            {{ $errors->first('giro') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.giro_helper') }}</span>
                </div>
                <div class="form-group col-sm-12">
                    <label for="servicios"><i
                            class="fas fa-briefcase iconos-crear"></i> {{ trans('cruds.organizacion.fields.servicios') }}
                    </label>
                    <input class="form-control {{ $errors->has('servicios') ? 'is-invalid' : '' }}" type="text"
                           name="servicios" id="servicios" value="{{ $organizacion->servicios  }}" disabled>
                    @if($errors->has('servicios'))
                        <div class="invalid-feedback">
                            {{ $errors->first('servicios') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.servicios_helper') }}</span>
                </div>
                <div class="form-group col-sm-6">
                    <label for="mision"> <i
                            class="far fa-eye iconos-crear"></i> {{ trans('cruds.organizacion.fields.mision') }}</label>
                    <textarea class="form-control {{ $errors->has('mision') ? 'is-invalid' : '' }}" name="mision"
                              id="mision" disabled>{{ $organizacion->mision }}</textarea>
                    @if($errors->has('mision'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mision') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.mision_helper') }}</span>
                </div>
                <div class="form-group col-sm-6">
                    <label for="vision"> <i
                            class="far fa-eye iconos-crear"></i> {{ trans('cruds.organizacion.fields.vision') }}</label>
                    <textarea class="form-control {{ $errors->has('vision') ? 'is-invalid' : '' }}" name="vision"
                              id="vision" disabled>{{ $organizacion->vision }}</textarea>
                    @if($errors->has('vision'))
                        <div class="invalid-feedback">
                            {{ $errors->first('vision') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.vision_helper') }}</span>
                </div>
                <div class="form-group col-sm-6">
                    <label for="valores"> <i
                            class="far fa-heart iconos-crear"></i> {{ trans('cruds.organizacion.fields.valores') }}
                    </label>
                    <textarea class="form-control {{ $errors->has('valores') ? 'is-invalid' : '' }}" name="valores"
                              id="valores" disabled>{{ $organizacion->valores }}</textarea>
                    @if($errors->has('valores'))
                        <div class="invalid-feedback">
                            {{ $errors->first('valores') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.valores_helper') }}</span>
                </div>
                <div class="form-group col-sm-6">
                    <label for="logotipo"> <i
                            class="fas fa-image iconos-crear" ></i> {{ trans('cruds.organizacion.fields.logotipo') }}
                    </label>
                    <img src="{{ url('images/'.$logotipo->logotipo) }}" alt="" style="width: 480px; height: 150px;">
                @if($errors->has('logotipo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('logotipo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.organizacion.fields.logotipo_helper') }}</span>
                </div>
                <div class="form-group col-sm-12">
                    <label for="antecedentes"> <i
                            class="far fa-file-alt iconos-crear"></i> Antecedentes
                    </label>
                    <textarea class="form-control" name="actecedentes"
                              id="antecedentes" disabled>{{ $organizacion->antecedentes }}</textarea>
                    <span class="help-block">{{ trans('cruds.organizacion.fields.valores_helper') }}</span>
                </div>
            </div>
        </div>
        @else


    <div class="row">

              <div class=" tarjeta">
                  @if(!empty($count == 1))
                  @else
                      <span>Agregue los datos generales de su organización</span>
                      <br>
                      <br>
                      <a class="btn btn-success boton_organizacion"  href="{{ route('admin.organizacions.create') }}">
                          Agregar <strong>+</strong>
                      </a>
                  @endif
              </div>

              <div class=" imagen_organizacion">
                  <img src="../img/organizacion.jpeg" width="100%">
              </div>

      </div><!--row-->





            <div class="card-body">
                <div class="row">

                </div>
            </div>
        @endif
    </div>

@endsection
