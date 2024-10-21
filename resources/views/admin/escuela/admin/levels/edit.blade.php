@extends('layouts.admin')

@section('title', 'Editar nivel')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h5 class="col-12 titulo_general_funcion">Editar Nivel</h5>
    <div class="card">
        <div class="card-body">
            <h5>Nivel</h5>
            <div>

                {!! Form::model($level, ['route' => ['admin.levels.update', $level], 'method' => 'put']) !!}
                <span style="color: var(--color-tbj);">Nombre</span><span style="color: #AF3041;">*</span>
                <div class="row align-items-start">
                    <div class="col-9">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del nivel']) !!}
                    </div>


                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <div class="mt-4 text-right">
                    {!! Form::submit('ACTUALIZAR NIVEL', [
                        'class' => 'btn btn-primary',
                    ]) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
