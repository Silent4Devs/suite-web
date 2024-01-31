@extends('layouts.admin')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('../css/colores.css') }}">
    <h5 class="col-12 titulo_general_funcion">Registrar: Categoría</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categoria-capacitacion.store') }}" class="row">
                @csrf

                <div class="form-group col-sm-12 col-lg-12 col-md-12 anima-focus">
                    <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" placeholder="" type="text" name="nombre"
                        id="nombre" value="{{ old('nombre', '') }}" required maxlength="250">
                        {!! Form::label('nombre', 'Nombre de la Categoría*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                </div>
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.categoria-capacitacion.index') }}" class="btn" id="btn_cancelar" style="color:#057BE2;">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection
<style>

    #btn_cancelar{
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            border: 1px solid var(--unnamed-color-057be2);
            background: #FFFFFF 0% 0% no-repeat padding-box;
            border: 1px solid #057BE2;
            border-radius: 4px;
            opacity: 1;
            }
</style>
