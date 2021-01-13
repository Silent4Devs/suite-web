@extends('layouts.admin')
@section('content')

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card-body azul_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1  text-center text-white"><strong> Editar: </strong> Política SGSI </h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.politica-sgsis.update", [$politicaSgsi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="politicasgsi"><i class="fas fa-landmark iconos-crear"></i>{{ trans('cruds.politicaSgsi.fields.politicasgsi') }}</label>
                <textarea class="form-control {{ $errors->has('politicasgsi') ? 'is-invalid' : '' }}" name="politicasgsi" id="politicasgsi">{{ old('politicasgsi', $politicaSgsi->politicasgsi) }}</textarea>
                @if($errors->has('politicasgsi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('politicasgsi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.politicaSgsi.fields.politicasgsi_helper') }}</span>
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