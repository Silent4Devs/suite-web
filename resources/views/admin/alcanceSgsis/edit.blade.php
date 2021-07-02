@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.alcance-sgsis.create') }}

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px">
        <h3 class="mb-1  text-center text-white"><strong>
        Registrar:</strong> Determinación de Alcance </h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.alcance-sgsis.update", [$alcanceSgsi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="alcancesgsi"><i class="fas fa-shield-alt iconos-crear"></i>{{ trans('cruds.alcanceSgsi.fields.alcancesgsi') }}</label>
                <textarea class="form-control {{ $errors->has('alcancesgsi') ? 'is-invalid' : '' }}" name="alcancesgsi" id="alcancesgsi">{{ old('alcancesgsi', $alcanceSgsi->alcancesgsi) }}</textarea>
                @if($errors->has('alcancesgsi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alcancesgsi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.alcanceSgsi.fields.alcancesgsi_helper') }}</span>
            </div>
            <div class="form-group col-12 text-right">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection