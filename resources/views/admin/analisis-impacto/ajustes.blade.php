@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.analisis-impacto.matriz') !!}">Matriz de Análisis de Impacto</a>
        </li>
        <li class="breadcrumb-item active">Ajustar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Ajustar: Priorización de impactos</h5>

    <div class="px-1 py-2 mb-4 rounded " style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
        <div class="row w-100">
            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                <div class="w-100">
                    <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                </div>
            </div>
            <div class="col-11">
                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En esta sección podrá ajustar los valores de
                    priorización de impactos.
                </p>

            </div>
        </div>
    </div>

    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::model($cuestionario, [
                'route' => ['admin.analisis-impacto.updateAjustesBIA', $cuestionario->id],
                'method' => 'put',
            ]) !!}

            <div class="row">
                <div class="form-group col-sm-6">
                    <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('impacto_operativo', 'Impacto Operativo:', ['class' => 'required']) !!}
                    {!! Form::number('impacto_operativo', null, [
                        'class' => 'form-control',
                        'placeholder' => '...',
                        'max' => '5',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('impacto_regulatorio', 'Impacto Regulatorio:', ['class' => 'required']) !!}
                    {!! Form::number('impacto_regulatorio', null, [
                        'class' => 'form-control',
                        'placeholder' => '...',
                        'max' => '5',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('impacto_reputacion', 'Impacto en la Reputación / Imagen Pública o Política:', [
                        'class' => 'required',
                    ]) !!}
                    {!! Form::number('impacto_reputacion', null, [
                        'class' => 'form-control',
                        'placeholder' => '...',
                        'max' => '5',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('impacto_social', 'Impacto Social:', ['class' => 'required']) !!}
                    {!! Form::number('impacto_social', null, [
                        'class' => 'form-control',
                        'placeholder' => '...',
                        'max' => '5',
                    ]) !!}
                </div>
            </div>
            <!-- Submit Field -->
            <div class="row">
                <div class="text-right form-group col-12">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </div>


            {!! Form::close() !!}
        </div>
    </div>
@endsection
