@extends('layouts.admin')
@section('content')
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Editar: </strong> Categoría </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.faq-categories.update', [$faqCategory->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="category">{{ trans('cruds.faqCategory.fields.category') }}</label>
                    <input class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" type="text"
                        name="category" id="category" value="{{ old('category', $faqCategory->category) }}" required>
                    @if ($errors->has('category'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.faqCategory.fields.category_helper') }}</span>
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
