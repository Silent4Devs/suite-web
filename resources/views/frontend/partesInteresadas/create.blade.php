@extends('layouts.frontend')
@section('content')


{{-- {{ Breadcrumbs::render('frontend.partes-interesadas.create') }} --}}



    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">

            <h3 class="mb-1 text-center text-white"> <strong>Registrar:</strong> Partes Interesadas </h3>

        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('partes-interesadas.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                {{ Form::hidden('pdf-value', 'PartesInt') }}
                <div class="form-group col-md-12">
                    <label class="required" for="parteinteresada"> <i class="fas fa-user-tie iconos-crear"></i>
                        {{ trans('cruds.partesInteresada.fields.parteinteresada') }}</label>
                    <input class="form-control {{ $errors->has('parteinteresada') ? 'is-invalid' : '' }}" type="text"
                        name="parteinteresada" id="parteinteresada" value="{{ old('parteinteresada', '') }}" required>
                    @if ($errors->has('parteinteresada'))
                        <div class="invalid-feedback">
                            {{ $errors->first('parteinteresada') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.partesInteresada.fields.parteinteresada_helper') }}</span>
                </div>
                <div class="form-group col-md-12">
                    <label class="required" for="requisitos"> <i class="fas fa-clipboard-list iconos-crear"></i>
                        {{ trans('cruds.partesInteresada.fields.requisitos') }}</label>
                    <textarea class="form-control {{ $errors->has('requisitos') ? 'is-invalid' : '' }}" name="requisitos"
                        id="requisitos">{{ old('requisitos') }}</textarea>
                    @if ($errors->has('requisitos'))
                        <div class="invalid-feedback">
                            {{ $errors->first('requisitos') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.partesInteresada.fields.requisitos_helper') }}</span>
                </div>


                {{-- <div class="form-group col-sm-12">
                    <label for="clausala"><i class="far fa-file iconos-crear"></i> Cláusula(s)</label>
                    <select class="form-control {{ $errors->has('clausala') ? 'is-invalid' : '' }}" name="clausala"
                        id="clausala" class="select2" multiple>
                        <option value disabled >
                            Selecciona una opción</option>
                        @foreach (App\Models\PartesInteresada::CLAUSULA_SELECT as $id => $clausula)
                            <option value="{{ $id }}"
                                {{ (old('clausala') ? old('clausala') : $clausula->clausala ?? '') == $id ? 'selected' : '' }}>
                                {{ $clausula }} </option>
                        @endforeach
                    </select>
                    <span class="errors tipo_error"></span>
                </div> --}}


                <div class="form-group col-sm-12">
                    <label for="clausulas"><i class="far fa-file iconos-crear"></i> Cláusula(s)</label>
                    <select class="form-control {{ $errors->has('clausulas') ? 'is-invalid' : '' }}" name="clausulas[]"
                        id="clausulas" multiple>
                        <option value disabled >Selecciona una opción</option>
                        @foreach ($clausulas as $clausula)
                            <option value="{{ $clausula->id }}">
                                {{ $clausula->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <span class="errors tipo_error"></span>
                </div>




                <div class="text-right form-group col-md-12">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('scripts')


<script type="text/javascript">


    $(document).ready(function() {
        $("#clausulas").select2({
            theme: "bootstrap4",
        });
    });


</script>

    <script>
        $(document).ready(function() {
            $("#clausala").select2({
                theme: "bootstrap4",
            });
        });
    </script>

<script src="{{ asset('js/dark_mode.js') }}"></script>

@endsection
