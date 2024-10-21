@extends('layouts.admin')
@section('content')
    <div class="card mt-4">
        <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1  text-center text-white"><strong> Editar: </strong> Pregunta </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.faq-questions.update', [$faqQuestion->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="category_id">{{ trans('cruds.faqQuestion.fields.category') }}</label>
                    <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}"
                        name="category_id" id="category_id" required>
                        @foreach ($categories as $id => $category)
                            <option value="{{ $id }}"
                                {{ (old('category_id') ? old('category_id') : $faqQuestion->category->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $category }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.faqQuestion.fields.category_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="question">{{ trans('cruds.faqQuestion.fields.question') }}</label>
                    <textarea class="form-control {{ $errors->has('question') ? 'is-invalid' : '' }}" name="question" id="question"
                        required>{{ old('question', $faqQuestion->question) }}</textarea>
                    @if ($errors->has('question'))
                        <div class="invalid-feedback">
                            {{ $errors->first('question') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.faqQuestion.fields.question_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="answer">{{ trans('cruds.faqQuestion.fields.answer') }}</label>
                    <textarea class="form-control {{ $errors->has('answer') ? 'is-invalid' : '' }}" name="answer" id="answer" required>{{ old('answer', $faqQuestion->answer) }}</textarea>
                    @if ($errors->has('answer'))
                        <div class="invalid-feedback">
                            {{ $errors->first('answer') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.faqQuestion.fields.answer_helper') }}</span>
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
