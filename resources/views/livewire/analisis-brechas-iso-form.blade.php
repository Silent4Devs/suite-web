<div class="mt-4 card card-body">
    <style>
        .content-limit{
            display: block;
            width: 100%;
            max-width: 1050px;
            margin: auto;
        }
        .caja-carrusel{
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .carrusel-infinito{
            width: 100%;
            display: flex;
            align-items: start;
            gap: 20px;
            overflow: hidden;
            padding: 5px 0px;
        }
        .arrow-carrusel-izq, .arrow-carrusel-der{
            width: 70px;
            height: 325px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.1s;
        }
        .item-carrusel{
            min-width: 239px;
            width: 239px;
            height: auto;
            background-color: #fff;
            /* box-shadow: 0px 3px 6px #00000029; */
        }
        .card-carrusel{
            width: 100%;
            height: 77px;
           margin-bottom: 0px;
           background-color: #2496AE;
           color:#FFFFFF;
           border: 1px solid #CFCFCF;
           border-radius: 8px;
           box-shadow: 0px 1px 4px #0000000F;
        }

    </style>

    <div class="content-limit caja-carrusel">
        <div class="arrow-carrusel-izq" style="margin-right: 10px;">
            <i class="material-symbols-outlined">arrow_back_ios</i>
        </div>
        <div class="carrusel-infinito" style="margin: 0px 10px 0px 10px;">
            @foreach ($analisis_brechas as $index => $analisis_brecha )
            <div class="item-carrusel"  style="{{ $index == 0 ? 'margin-left:25px;' : '' }}">
                <div class="card card-carrusel">
                    <div class="card-body" style="padding: 18px 32px 10px 29px;">
                            <div class="row">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="col-2">
                                        <i class="material-icons-outlined" style="font-size:32px;">
                                            bookmark_border
                                        </i>
                                    </div>
                                    <div class="col-10">
                                       <h6>{{$analisis_brecha->nombre}}</h6>
                                       <p>Selecciona tu template</p>
                                    </div>
                                </div>
                            </div>
                        {{-- <i class="material-icons-outlined" style="font-size: 32px" >
                            bookmark_border
                        </i> --}}
                        {{-- {{$analisis_brecha->nombre}} --}}
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <div class="item-carrusel" style="margin-left: 25px;">
                <div class="card" style="margin-bottom: 0px;">
                    <div class="card-body">
                        hola
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="arrow-carrusel-der" style="margin-left: 25px;">
            <i class="material-symbols-outlined">arrow_forward_ios</i>
        </div>
    </div>

    <form wire:submit.prevent="save" wire:ignore>
        @csrf
        <div class="py-1 text-center form-group col-12" style="background-color:#345183; border-radius:100px; color: white;">DATOS GENERALES</div>
        <div class="form-group">
            <p class="font-weight-bold" style="font-size:11pt;">Llene los siguientes campos según corresponda:</p>
        </div>
        <div class="row">
            <div class="form-group col-md-3 col-lg-3 col-sm-12">
                <label for="fecha">Fecha</label>
                <input  class="form-control {{ $errors->has('fecha') ? 'is-invalid' : '' }}" type="text"
                    id="fecha" value="{{ date('d-m-Y') }}" min="1945-01-01" disabled wire:model.defer="fecha" >
                @if ($errors->has('fecha'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha') }}
                    </div>
                @endif
            </div>
            {{ Form::hidden('fecha', date('Y-m-d')) }}
        </div>
        <div class="row">
            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                <label for="nombre" class="required">Nombre</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                    name="nombre" id="nombre" value="{{ old('nombre', '') }}" required wire:model.defer="name">
                @if ($errors->has('nombre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-6 col-lg-6 col-sm-12">
                <label for="estatus">Estatus</label>
                <select class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" name="estatus"
                    id="estatus" required wire:model.defer="estatus" >
                    <option value disabled {{ old('estatus', null) === null ? 'selected' : '' }}>
                        Selecciona una opción</option>
                    @foreach (App\Models\AnalisisDeRiesgo::EstatusSelect as $key => $label)
                        <option value="{{ $key }}"
                            {{ old('estatus', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('estatus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estatus') }}
                    </div>
                @endif
            </div>

        </div>
        <div class="row">
            <div class="form-group col-md-6 col-sm-6">
                <label for="id_elaboro">Elaboró </label>
                <select class="form-control {{ $errors->has('id_elaboro') ? 'is-invalid' : '' }}"
                    name="id_elaboro" id="id_elaboro" required wire:model.defer="id_elaboro">
                    <option value disabled {{ old('id_elaboro', null) === null ? 'selected' : '' }}>
                        Selecciona una opción</option>
                    @foreach ($empleados as $key => $label)
                        <option data-puesto="{{ $label->puesto }}" data-area="{{ $label->area->area}}"
                            value="{{ $label->id }}">
                            {{ $label->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('id_elaboro'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_elaboro') }}
                    </div>
                @endif
            </div>

            <div class="form-group col-md-3 col-sm-3 col-lg-3">
                <label for="id_puesto">Puesto</label>
                <div class="form-control" id="id_puesto" readonly ></div>
            </div>
                @if ($errors->has('id_puesto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_puesto') }}
                    </div>
                @endif


            <div class="form-group col-md-3 col-sm-3 col-lg-3">
                <label for="id_area"><i class="fas fa-street-viewa iconos-crear"></i>Área</label>
                <div class="form-control" id="id_area" readonly></div>
            </div>
                @if ($errors->has('id_area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_area') }}
                    </div>
                @endif

        </div>
        <div class="text-right form-group col-12">
                    <button class="btn btn-light text-primary border border-primary" type="submit">
                        Crear Análisis de Brechas
                    </button>
        </div>
    </form>

    <div class="datatable-rds datatable-fix">
	            <table id="datatable_analisisbrechas" class="table w-100">
	                <thead class="w-100">
	                    <tr>
	                        <th>Id</th>
                            <th>Nombre</th>
	                        <th>Fecha</th>
                            <th>Elaboro</th>
	                    </tr>
	                </thead>
                    <tbody>
                    @foreach ( $analisis_brechas as $analisis_brecha )
                    <tr>
                        <td>
                            {{$analisis_brecha->id}}
                        </td>
                        <td>
                            {{$analisis_brecha->nombre}}
                        </td>
                        <td>
                            {{$analisis_brecha->fecha}}
                        </td>
                        <td>
                            {{$analisis_brecha->empleado->name}}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
    </div>

        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.on('limpiarNameInput', function () {
                    // Limpiar el campo de entrada de "name" utilizando JavaScript
                    document.getElementById('id_area').textContent="";
                    document.getElementById('id_puesto').textContent="";

                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let rigth_space = 25;
                $('.arrow-carrusel-izq').click(function() {
                    if (rigth_space < 25) {
                        rigth_space += 180;
                    }
                    $('.item-carrusel:first').css('margin-left', rigth_space + 'px');
                });
                $('.arrow-carrusel-der').click(function() {
                    // console.log($('.item-carrusel').length );
                    if (rigth_space >
                        -(($('.item-carrusel').length -3) * 239)) {
                        rigth_space -= 180;
                    }
                    // console.log(rigth_space);
                    $('.item-carrusel:first').css('margin-left', rigth_space + 'px');
                });

            });
        </script>

    </div>
