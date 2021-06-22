@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.partes-interesadas.create') }}

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">

       <h3 class="mb-1  text-center text-white"> <strong>Registrar:</strong> Partes Interesadas </h3>

    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.partes-interesadas.store") }}" enctype="multipart/form-data" class="row">
            @csrf
            {{ Form::hidden('pdf-value', 'PartesInt')}}
            <div class="form-group col-md-6">
                <label class="required" for="parteinteresada"> <i class="fas fa-user-tie iconos-crear"></i> {{ trans('cruds.partesInteresada.fields.parteinteresada') }}</label>
                <input class="form-control {{ $errors->has('parteinteresada') ? 'is-invalid' : '' }}" type="text" name="parteinteresada" id="parteinteresada" value="{{ old('parteinteresada', '') }}" required>
                @if($errors->has('parteinteresada'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parteinteresada') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.partesInteresada.fields.parteinteresada_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="requisitos"> <i class="fas fa-clipboard-list iconos-crear"></i> {{ trans('cruds.partesInteresada.fields.requisitos') }}</label>
                <input class="form-control {{ $errors->has('requisitos') ? 'is-invalid' : '' }}" type="text" name="requisitos" id="requisitos" value="{{ old('requisitos', '') }}" required>
                @if($errors->has('requisitos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requisitos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.partesInteresada.fields.requisitos_helper') }}</span>
            </div>
            <div class="form-group col-md-12">
                <label for="clausala"> <i class="far fa-file iconos-crear"></i> Cláusula</label>
                <textarea class="form-control {{ $errors->has('clausala') ? 'is-invalid' : '' }}" name="clausala" id="clausala">{{ old('clausala') }}</textarea>
                @if($errors->has('clausala'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clausala') }}
                    </div>
                @endif
                <span class="help-block">Cláusula que satisface el requisito de la parte interesada</span>
            </div>
            <div class="form-group col-md-12 text-right">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/dark_mode.js') }}"></script>


@endsection
