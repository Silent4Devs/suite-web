@extends('layouts.admin')
@section('content')
    <style>
        .select2-search.select2-search--inline {
            margin-top: -20px !important;
        }

        .titulo-matriz {
            text-align: left;
            font: 20px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }

        .radius {
            border-radius: 16px;
            box-shadow: none;
        }

        .titulo-card {
            text-align: left;
            font: 20px Roboto;
            color: #306BA9;
        }

        .boton-cancelar {
            background-color: white;
            border-color: #057BE2;
            font: 14px Roboto;
            color: #057BE2;
            border-radius: 4px;
            width: 148px;
            height: 48px;
            align-content: center;
        }

        .boton-cancel {
            background-color: white;
            border-color: #057BE2;
            font: 14px Roboto;
            color: #057BE2;
            border-radius: 4px;
            width: 148px;
            height: 48px;
            align-content: center;
        }

        .boton-enviar {
            background-color: #057BE2;
            border-color: #057BE2;
            font: 14px Roboto;
            color: white;
            border-radius: 4px;
            width: 148px;
            height: 48px;
        }

        .borde-color {
            border-radius: 8px;
            border-color: black;
            background-color: white;
        }

        .form {
            background: #F8FAFC;
            border-radius: 4px;
            opacity: 1;
        }

        .letra-etiqueta-flotante {
            font: 14px Roboto;
            color: #606060;
            text-align: left;
        }
    </style>
    {{ Breadcrumbs::render('admin.matriz-requisito-legales.create') }}
    <h5 class="col-12 titulo-matriz">Matriz de Requisitos Legales y Regulatorios</h5>
    <div class="card radius" style="background-color: #5397D5;">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:150px; height:137px;"
                    class="mt-3 mb-3 ml-3 img-fluid">
            </div>
            <div class="col-md-10 mt-3">
                <div style="font:20px Segoe UI;color:white;" class="mr-2">
                    ¿Qué es? Matriz de Requisitos Legales y Regulatorios
                </div>
                <div style="font: 14px Segoe UI;color:white;"class="mt-3 mr-2">
                    Es una herramienta utilizada en el ámbito empresarial y de gestión para
                    rastrear y gestionar los requisitos legales y regulaciones aplicables a una organización.
                </div>
                <div style="font: 12px Segoe UI;color:white;"class="mr-5 mt-3 mb-3">
                    Esta matriz tiene como objetivo principal ayudar a las empresas a garantizar que están
                    cumpliendo con todas las leyes, regulaciones y normativas relevantes que se aplican a sus
                    operaciones.
                </div>
            </div>
        </div>
    </div>


    <div>
        <button wire:click='test'>
            hola
        </button>
    </div>




    <div class="mt-4 card" style="border-radius: 8px;">
        <div class="card-body pb-0">
            <form method="POST" action="{{ route('admin.matriz-requisito-legales.store') }}" enctype="multipart/form-data"
                class="row">
                @csrf
                <div class="form-group col-12">
                    <p class="titulo-card" style="">
                        Requisito Legal
                    </p>
                    <hr>
                </div>

                <div class="form-group col-12">
                    <div class="form-floating">
                        <input required class="form-control {{ $errors->has('nombrerequisito') ? 'is-invalid' : '' }} form "
                            type="text" name="nombrerequisito" id="nombrerequisito"
                            value="{{ old('nombrerequisito', '') }}" style="height:55px;"
                            placeholder="Nombre del requisito legal, regulatorio, contractual o estatutario">
                        @if ($errors->has('nombrerequisito'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombrerequisito') }}
                            </div>
                        @endif
                        <label style="color:#606060;font-size:14px;" for="nombrerequisito">
                            Nombre del requisito legal, regulatorio, contractual o estatutario</label>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <div class="form-floating">
                        <input type="text"
                            class="form-control {{ $errors->has('formacumple') ? 'is-invalid' : '' }} form"
                            name="formacumple" id="formacumple" value="{{ old('formacumple', '') }}"
                            aria-describedby="textExample1" placeholder="Cláusula, sección o apartado aplicable*"
                            style="height:55px;" />
                        <label class="" style="color:#606060;font-size:14px;" for="formacumple">Cláusula, sección o
                            apartado
                            aplicable*</label>
                    </div>
                </div>

                @if ($errors->has('formacumple'))
                    <div class="invalid-feedback">
                        {{ $errors->first('formacumple') }}
                    </div>
                @endif

                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.formacumple_helper') }}</span>
        </div>

        <div class="row" style="padding-left:24px; padding-right:24px;">
            <div class="col-sm-6">
                <div class="form-floating">
                    <input class="form-control {{ $errors->has('fechaexpedicion') ? 'is-invalid' : '' }} form"
                        type="date" name="fechaexpedicion" id="fechaexpedicion" min="1945-01-01"
                        value="{{ old('fechaexpedicion') }}">
                    @if ($errors->has('fechaexpedicion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechaexpedicion') }}
                        </div>
                    @endif
                    <label for="fechaexpedicion"></i> Fecha de
                        publicación</label>
                </div>
                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion_helper') }}</span>
            </div>
            <div class="col-sm-6">
                <div class="form-floating">
                    <input class="form-control date {{ $errors->has('fechavigor') ? 'is-invalid' : '' }} form"
                        type="date" name="fechavigor" id="fechavigor" min="1945-01-01" value="{{ old('fechavigor') }}">
                    @if ($errors->has('fechavigor'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechavigor') }}
                        </div>
                    @endif
                    <label for="fechavigor">
                        {{ trans('cruds.matrizRequisitoLegale.fields.fechavigor') }}</label>
                </div>
                <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechavigor_helper') }}</span>
            </div>
        </div>


        <div class="form-group col-sm-12 mt-4">
            <div class="form-floating" style="padding-left:6px;padding-right:6px;">
                <textarea required class="form-control {{ $errors->has('requisitoacumplir') ? 'is-invalid' : '' }} form"
                    style="height:200px;" name="requisitoacumplir" placeholder="Descripción del requisito a cumplir*"
                    id="requisitoacumplir">{{ old('requisitoacumplir') }}</textarea>
                @if ($errors->has('requisitoacumplir'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requisitoacumplir') }}
                    </div>
                @endif
                <label style="color:#606060;font-size:14px;" for="requisitoacumplir">
                    Descripción del requisito a cumplir*</label>
            </div>
        </div>
        </form>
        <a type="button" class="btn btn-light mr-auto mb-3" wire:model="addAlcance1"
            style="background-color: white; border-color:white; color:#057BE2;">
            Añadir nuevo Requisito
            <i class="fa-solid fa-plus" style="color: #057BE2;"></i>
        </a>
    </div>


    @foreach ($alcance_s1 as $key => $p)
        <div class="my-2 col-12" style="text-align: end;">
            <a class="btn trash-button" wire:click.prevent="removeAlcance1({{ $key }})">
                <i class="fas fa-trash-alt" style="color: rgb(0, 0, 0); font-size: 15pt;" title="Eliminar"></i>
            </a>
        </div>
        <div class="mt-4 card" style="border-radius: 8px;">
            <div class="card-body pb-0">
                <form method="POST" action="{{ route('admin.matriz-requisito-legales.store') }}"
                    enctype="multipart/form-data" class="row">
                    @csrf
                    <div class="form-group col-11" style="margin-bottom:0px;">
                        <p class="titulo-card" style="margin-bottom:0px;">
                            Requisito Legal
                        </p>
                    </div>
                    <div class="form-group col-1"style="margin-bottom:0px;">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn" style="background-color: white; box-shadow:none;"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-regular fa-trash-can fa-2xl" style="color: #606060;"></i>
                        </button>
                    </div>

                    <div class="mb-3">
                        <hr>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" style="margin-top: 150px;">
                            <div class="modal-content text-center">
                                <div class="modal-body">
                                    <div class="mt-5 mb-3" style="font:20px Segoe UI;color:#306BA9;">
                                        ¿Estás seguro que deseas eliminar este elemento?
                                    </div>
                                    <i class="mt-5 mb-5 fa-regular fa-trash-can fa-2xl" style="color: #606060;"></i>
                                    <div class="row mb-5 mt-2">
                                        <div class="col-md-6" style="padding-left: 50px;">
                                            <button type="button" class="btn btn-outline-primary"
                                                style="width: 175px;
                                                    height: 39px;font:14px Roboto;border: 1px solid;color:#057BE2;border-radius:6px;"
                                                data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                        <div class="col-md-6"
                                            style="
                                            padding-right: 50px;">
                                            <button type="button" data-bs-dismiss="modal" class="btn btn-primary"
                                                style="width: 175px;
                                                    height: 39px;box-shadow:none;border-radius:6px;">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <div class="form-floating">
                            <input required
                                class="form-control {{ $errors->has('nombrerequisito') ? 'is-invalid' : '' }} form "
                                type="text" name="nombrerequisito" id="nombrerequisito"
                                value="{{ old('nombrerequisito', '') }}" style="height:55px;"
                                placeholder="Nombre del requisito legal, regulatorio, contractual o estatutario">
                            @if ($errors->has('nombrerequisito'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nombrerequisito') }}
                                </div>
                            @endif
                            <label style="color:#606060;font-size:14px;" for="nombrerequisito">
                                Nombre del requisito legal, regulatorio, contractual o estatutario</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="form-floating">
                            <input type="text"
                                class="form-control {{ $errors->has('formacumple') ? 'is-invalid' : '' }} form"
                                name="formacumple" id="formacumple" value="{{ old('formacumple', '') }}"
                                aria-describedby="textExample1" placeholder="Cláusula, sección o apartado aplicable*"
                                style="height:55px;" />
                            <label class="" style="color:#606060;font-size:14px;" for="formacumple">Cláusula,
                                sección o
                                apartado
                                aplicable*</label>
                        </div>
                    </div>

                    @if ($errors->has('formacumple'))
                        <div class="invalid-feedback">
                            {{ $errors->first('formacumple') }}
                        </div>
                    @endif

                    <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.formacumple_helper') }}</span>
            </div>

            <div class="row" style="padding-left:24px; padding-right:24px;">
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input class="form-control {{ $errors->has('fechaexpedicion') ? 'is-invalid' : '' }} form"
                            type="date" name="fechaexpedicion" id="fechaexpedicion" min="1945-01-01"
                            value="{{ old('fechaexpedicion') }}">
                        @if ($errors->has('fechaexpedicion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fechaexpedicion') }}
                            </div>
                        @endif
                        <label for="fechaexpedicion"></i> Fecha de
                            publicación</label>
                    </div>
                    <span
                        class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion_helper') }}</span>
                </div>
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input class="form-control date {{ $errors->has('fechavigor') ? 'is-invalid' : '' }} form"
                            type="date" name="fechavigor" id="fechavigor" min="1945-01-01"
                            value="{{ old('fechavigor') }}">
                        @if ($errors->has('fechavigor'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fechavigor') }}
                            </div>
                        @endif
                        <label for="fechavigor">
                            {{ trans('cruds.matrizRequisitoLegale.fields.fechavigor') }}</label>
                    </div>
                    <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.fechavigor_helper') }}</span>
                </div>
            </div>


            <div class="form-group col-sm-12 mt-4">
                <div class="form-floating" style="padding-left:6px;padding-right:6px;">
                    <textarea required class="form-control {{ $errors->has('requisitoacumplir') ? 'is-invalid' : '' }} form"
                        style="height:200px;" name="requisitoacumplir" placeholder="Descripción del requisito a cumplir*"
                        id="requisitoacumplir">{{ old('requisitoacumplir') }}</textarea>
                    @if ($errors->has('requisitoacumplir'))
                        <div class="invalid-feedback">
                            {{ $errors->first('requisitoacumplir') }}
                        </div>
                    @endif
                    <label style="color:#606060;font-size:14px;" for="requisitoacumplir">
                        Descripción del requisito a cumplir*</label>
                </div>
            </div>
            </form>
            <button type="button" class="btn btn-light mr-auto mb-3"
                style="background-color: white; border-color:white; color:#057BE2;" wire:model="addAlcance1">
                Añadir nuevo Requisito
                <i class="fa-solid fa-plus" style="color: #057BE2;"></i>
            </button>
        </div>
        <div class="my-2 col-12" style="text-align: end;">
            <button class="btn trash-button" wire:click.prevent="removeAlcance1({{ $key }})">
                <i class="fas fa-trash-alt" style="color: rgb(0, 0, 0); font-size: 15pt;" title="Eliminar"></i>
            </button>
        </div>
    @endforeach
    <div class="text-right form-group col-12">
        <span class="help-block">{{ trans('cruds.matrizRequisitoLegale.fields.requisitoacumplir_helper') }}
        </span>
        <a href="{{ route('admin.matriz-requisito-legales.index') }}" class="btn boton-cancelar">
            <div class="mt-2">Cancelar</div>
        </a>
        <button class="btn boton-enviar ml-2 mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
@endsection
