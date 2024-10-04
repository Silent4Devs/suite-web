@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.dmaic.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.dmaics.update', [$dmaic->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="mejora_id">{{ trans('cruds.dmaic.fields.mejora') }}</label>
                    <select class="form-control select2 {{ $errors->has('mejora') ? 'is-invalid' : '' }}" name="mejora_id"
                        id="mejora_id">
                        @foreach ($mejoras as $id => $mejora)
                            <option value="{{ $id }}"
                                {{ (old('mejora_id') ? old('mejora_id') : $dmaic->mejora->id ?? '') == $id ? 'selected' : '' }}>
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
                <div class="form-group">
                    <label for="definir">{{ trans('cruds.dmaic.fields.definir') }}</label>
                    <textarea class="form-control {{ $errors->has('definir') ? 'is-invalid' : '' }}" name="definir" id="definir">{{ old('definir', $dmaic->definir) }}</textarea>
                    @if ($errors->has('definir'))
                        <div class="invalid-feedback">
                            {{ $errors->first('definir') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.definir_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="medir">{{ trans('cruds.dmaic.fields.medir') }}</label>
                    <textarea class="form-control {{ $errors->has('medir') ? 'is-invalid' : '' }}" name="medir" id="medir">{{ old('medir', $dmaic->medir) }}</textarea>
                    @if ($errors->has('medir'))
                        <div class="invalid-feedback">
                            {{ $errors->first('medir') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.medir_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="analizar">{{ trans('cruds.dmaic.fields.analizar') }}</label>
                    <textarea class="form-control {{ $errors->has('analizar') ? 'is-invalid' : '' }}" name="analizar" id="analizar">{{ old('analizar', $dmaic->analizar) }}</textarea>
                    @if ($errors->has('analizar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('analizar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.analizar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="implementar">{{ trans('cruds.dmaic.fields.implementar') }}</label>
                    <textarea class="form-control {{ $errors->has('implementar') ? 'is-invalid' : '' }}" name="implementar"
                        id="implementar">{{ old('implementar', $dmaic->implementar) }}</textarea>
                    @if ($errors->has('implementar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('implementar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.implementar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="controlar">{{ trans('cruds.dmaic.fields.controlar') }}</label>
                    <textarea class="form-control {{ $errors->has('controlar') ? 'is-invalid' : '' }}" name="controlar" id="controlar">{{ old('controlar', $dmaic->controlar) }}</textarea>
                    @if ($errors->has('controlar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('controlar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.controlar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="leccionesaprendidas">{{ trans('cruds.dmaic.fields.leccionesaprendidas') }}</label>
                    <textarea class="form-control {{ $errors->has('leccionesaprendidas') ? 'is-invalid' : '' }}" name="leccionesaprendidas"
                        id="leccionesaprendidas">{{ old('leccionesaprendidas', $dmaic->leccionesaprendidas) }}</textarea>
                    @if ($errors->has('leccionesaprendidas'))
                        <div class="invalid-feedback">
                            {{ $errors->first('leccionesaprendidas') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.dmaic.fields.leccionesaprendidas_helper') }}</span>
                </div>
                <div class="form-group">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
