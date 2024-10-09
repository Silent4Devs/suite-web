@extends('layouts.admin')
@section('content')
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> DMAIC </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.dmaics.store') }}" enctype="multipart/form-data" class="row">
                @csrf
                <div class="form-group col-12">
                    <label for="mejora_id"><i
                            class="fas fa-chart-bar iconos-crear"></i>{{ trans('cruds.dmaic.fields.mejora') }}</label>
                    <select class="form-control select2 {{ $errors->has('mejora') ? 'is-invalid' : '' }}" name="mejora_id"
                        id="mejora_id">
                        @foreach ($mejoras as $id => $mejora)
                            <option value="{{ $id }}" {{ old('mejora_id') == $id ? 'selected' : '' }}>
                                {{ $mejora }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('mejora'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mejora') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.mejora_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="definir"><i
                            class="fas fa-file-signature iconos-crear"></i>{{ trans('cruds.dmaic.fields.definir') }}</label>
                    <textarea class="form-control {{ $errors->has('definir') ? 'is-invalid' : '' }}" name="definir" id="definir">{{ old('definir') }}</textarea>
                    @if ($errors->has('definir'))
                        <div class="invalid-feedback">
                            {{ $errors->first('definir') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.definir_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="medir"><i
                            class="fas fa-signal iconos-crear"></i>{{ trans('cruds.dmaic.fields.medir') }}</label>
                    <textarea class="form-control {{ $errors->has('medir') ? 'is-invalid' : '' }}" name="medir" id="medir">{{ old('medir') }}</textarea>
                    @if ($errors->has('medir'))
                        <div class="invalid-feedback">
                            {{ $errors->first('medir') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.medir_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="analizar"><i
                            class="fas fa-search iconos-crear"></i>{{ trans('cruds.dmaic.fields.analizar') }}</label>
                    <textarea class="form-control {{ $errors->has('analizar') ? 'is-invalid' : '' }}" name="analizar" id="analizar">{{ old('analizar') }}</textarea>
                    @if ($errors->has('analizar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('analizar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.analizar_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="implementar"><i
                            class="fas fa-chart-bar iconos-crear"></i>{{ trans('cruds.dmaic.fields.implementar') }}</label>
                    <textarea class="form-control {{ $errors->has('implementar') ? 'is-invalid' : '' }}" name="implementar"
                        id="implementar">{{ old('implementar') }}</textarea>
                    @if ($errors->has('implementar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('implementar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.implementar_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="controlar"><i
                            class="fas fa-sitemap iconos-crear"></i>{{ trans('cruds.dmaic.fields.controlar') }}</label>
                    <textarea class="form-control {{ $errors->has('controlar') ? 'is-invalid' : '' }}" name="controlar" id="controlar">{{ old('controlar') }}</textarea>
                    @if ($errors->has('controlar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('controlar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.controlar_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="leccionesaprendidas"><i
                            class="fas fa-book iconos-crear"></i>{{ trans('cruds.dmaic.fields.leccionesaprendidas') }}</label>
                    <textarea class="form-control {{ $errors->has('leccionesaprendidas') ? 'is-invalid' : '' }}" name="leccionesaprendidas"
                        id="leccionesaprendidas">{{ old('leccionesaprendidas') }}</textarea>
                    @if ($errors->has('leccionesaprendidas'))
                        <div class="invalid-feedback">
                            {{ $errors->first('leccionesaprendidas') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.leccionesaprendidas_helper') }}</span>
                </div>
                <div class="form-group col-12 text-right">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
