@extends('layouts.admin')
@section('content')

<div class="mt-4 card">
    <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Alta de Activo </h3>
    </div>

    <div class="card-body">
        <form method="POST" class="row" action="{{ route("admin.activos.update", [$activo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group col-md-12">
                <label class="required" for="nombreactivo_id"><i class="fas fa-chart-line iconos-crear"></i>Nombre del Activo</label>
                <input class="form-control {{ $errors->has('nombreactivo') ? 'is-invalid' : '' }}" type="text" name="nombreactivo"
                id="n_serie" value="{{ old('nombreactivo', $activo->nombreactivo) }}" required>
                @if($errors->has('nombreactivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombreactivo') }}
                    </div>
                @endif
                  <span class="help-block"></span>
            </div>




            <div class="form-group col-md-6">
                <label for="tipoactivo_id" class="required"><i class="fas fa-layer-group iconos-crear"></i>Categoría</label>
                <select class="form-control select2 {{ $errors->has('tipoactivo') ? 'is-invalid' : '' }}" name="tipoactivo_id" id="tipoactivo_id">
                    @foreach($tipoactivos as $id => $tipoactivo)
                        <option value="{{ $id }}" {{ (old('tipoactivo_id') ? old('tipoactivo_id') : $activo->tipoactivo->id ?? '') == $id ? 'selected' : '' }}>{{ $tipoactivo }}</option>
                    @endforeach
                </select>
                @if($errors->has('tipoactivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipoactivo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activo.fields.tipoactivo_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="subtipo_id" class="required"><i class="fas fa-adjust iconos-crear"></i>Subcategoría</label>
                <select class="form-control select2 {{ $errors->has('subtipo') ? 'is-invalid' : '' }}" name="subtipo_id" id="subtipo_id">
                    @foreach($subtipos as $id => $subtipo)
                        <option value="{{ $id }}" {{ (old('subtipo_id') ? old('subtipo_id') : $activo->subtipo->id ?? '') == $id ? 'selected' : '' }}>{{ $subtipo }}</option>
                    @endforeach
                </select>
                @if($errors->has('subtipo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subtipo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activo.fields.subtipo_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="descripcion"><i class="fas fa-align-left iconos-crear"></i>{{ trans('cruds.activo.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion', $activo->descripcion) }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activo.fields.descripcion_helper') }}</span>
            </div>


            <div class="form-group col-md-4">
                <label for="dueno_id"><i class="fas fa-user-tie iconos-crear"></i>Dueño</label>
                <select class="form-control select2 {{ $errors->has('dueno') ? 'is-invalid' : '' }}"
                    name="dueno_id" id="dueno_id">
                    @foreach ($empleados as $id => $empleado)
                    <option data-puesto="{{ $empleado->puesto}}" value="{{ $empleado->id }}" data-area="{{ $empleado->area->area}}" {{old('dueno_id',$activo->dueno_id)==$empleado->id ?"selected" :""}}>

                        {{ $empleado->name }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('empleados'))
                    <div class="invalid-feedback">
                        {{ $errors->first('empleados') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
            </div>

            <div class="form-group col-md-4">
                <label for="id_puesto_dueno"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                <div class="form-control" id="puesto_dueno"></div>
            </div>

            <div class="form-group col-md-4">
                <label for="id_area_dueno"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                <div class="form-control" id="area_dueno"></div>

            </div>

            <div class="form-group col-md-4">
                <label for="id_responsable"><i class="fas fa-user-tie iconos-crear"></i>Responsable</label>
                <select class="form-control select2 {{ $errors->has('puesto') ? 'is-invalid' : '' }}"
                    name="id_responsable" id="id_responsable">
                    @foreach ($empleados as $id => $empleado)
                    <option data-puesto="{{ $empleado->puesto}}" value="{{ $empleado->id }}" data-area="{{ $empleado->area->area}}" {{old('id_responsable',$activo->id_responsable)==$empleado->id ?"selected" :""}}>

                        {{ $empleado->name }}
                    </option>
                    @endforeach
                </select>
                @if ($errors->has('empleados'))
                    <div class="invalid-feedback">
                        {{ $errors->first('empleados') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
            </div>


            <div class="form-group col-md-4">
                <label for="id_responsable"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                <div class="form-control" id="puesto_responsable"></div>

            </div>



            <div class="form-group col-md-4">
                <label for="id_area_responsable"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                <div class="form-control" id="area_responsable"></div>

            </div>



            <div class="form-group col-md-6">
                <label for="ubicacion_id"><i class="fas fa-map-marker-alt iconos-crear"></i>{{ trans('cruds.activo.fields.ubicacion') }}</label>
                <select class="form-control select2 {{ $errors->has('ubicacion') ? 'is-invalid' : '' }}" name="ubicacion_id" id="ubicacion_id">
                    @foreach($ubicacions as $id => $ubicacion)
                        <option value="{{ $id }}" {{ (old('ubicacion_id') ? old('ubicacion_id') : $activo->ubicacion->id ?? '') == $id ? 'selected' : '' }}>{{ $ubicacion }}</option>
                    @endforeach
                </select>
                @if($errors->has('ubicacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ubicacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activo.fields.ubicacion_helper') }}</span>
            </div>


            <div class="form-group col-sm-6">
                <label class="required" for="marca">
                    Marca</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="marca"
                    id="marca" value="{{ old('marca', $activo->marca) }}" required>
                @if ($errors->has('marca'))
                    <div class="invalid-feedback">
                        {{ $errors->first('marca') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-sm-6">
                <label class="required" for="marca">
                    Modelo</label>
                <input class="form-control {{ $errors->has('modelo') ? 'is-invalid' : '' }}" type="text" name="modelo"
                    id="modelo" value="{{ old('modelo', $activo->modelo) }}" required>
                @if ($errors->has('modelo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('modelo') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-sm-6">
                <label class="required" for="n_serie"><i class="fas fa-barcode iconos-crear"></i>No de serie</label>
                <input class="form-control {{ $errors->has('n_serie') ? 'is-invalid' : '' }}" type="text" name="n_serie"
                    id="n_serie" value="{{ old('n_serie', $activo->n_serie) }}" required>
                @if ($errors->has('n_serie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('n_serie') }}
                    </div>
                @endif
            </div>


            <div class="form-group col-sm-6">
                <label class="required" for="n_serie"><i class="fas fa-barcode iconos-crear"></i>No de producto</label>
                <input class="form-control {{ $errors->has('n_serie') ? 'is-invalid' : '' }}" type="text" name="n_producto"
                    id="n_producto" value="{{ old('n_producto', $activo->n_producto) }}" required>
                @if ($errors->has('n_producto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('n_producto') }}
                    </div>
                @endif
            </div>


            <div class="form-group col-sm-6">
                <label class="required" for="n_serie"><i class="fas fa-calendar-alt iconos-crear"></i> Fecha de compra</label>
                <input class="form-control {{ $errors->has('fecha_compra') ? 'is-invalid' : '' }}" type="date" name="fecha_compra"
                    id="fecha_compra" value="{{ old('fecha_compra',$activo->fecha_compra) }}" required>
                @if ($errors->has('fecha_compra'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_compra') }}
                    </div>
                @endif
            </div>


            <div class="form-group col-sm-6">
                <label class="required" for="n_serie"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha fin de compra</label>
                <input class="form-control {{ $errors->has('fecha_fin') ? 'is-invalid' : '' }}" type="date" name="fecha_fin"
                    id="n_producto" value="{{ old('fecha_fin', $activo->fecha_fin) }}" required>
                @if ($errors->has('fecha_fin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_fin') }}
                    </div>
                @endif
            </div>



            <div class="text-right form-group col-12">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection


@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function(e) {

        let responsable=document.querySelector('#id_responsable');
        let area_init=responsable.options[responsable.selectedIndex].getAttribute('data-area');
            let puesto_init=responsable.options[responsable.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_responsable').innerHTML=puesto_init
            document.getElementById('area_responsable').innerHTML=area_init

            let dueno=document.querySelector('#dueno_id');
            let area=dueno.options[dueno.selectedIndex].getAttribute('data-area');
            let puesto=dueno.options[dueno.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_dueno').innerHTML=puesto
            document.getElementById('area_dueno').innerHTML=area

        responsable.addEventListener('change',function (e) {
            e.preventDefault();
            let area=this.options[this.selectedIndex].getAttribute('data-area');
            let puesto=this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_responsable').innerHTML=puesto
            document.getElementById('area_responsable').innerHTML=area
        })
        dueno.addEventListener('change',function (e) {
            e.preventDefault();
            let area=this.options[this.selectedIndex].getAttribute('data-area');
            let puesto=this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_dueno').innerHTML=puesto
            document.getElementById('area_dueno').innerHTML=area
        })
    })
</script>
@endsection
