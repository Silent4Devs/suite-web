<div >
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
            height: 50px;
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

    <div class="mt-4 card card-body">
        <div class="content-limit caja-carrusel">
            <div class="arrow-carrusel-izq" style="margin-right: 10px;">
                <i class="material-icons-outlined">arrow_back_ios</i>
            </div>
            <div class="carrusel-infinito" style="margin: 0px 10px 0px 10px;">
                @foreach ($templates as $index => $analisis_brecha )
                <div class="item-carrusel"  style="{{ $index == 0 ? 'margin-left:25px;' : '' }}" wire:click="SelectCard({{ $analisis_brecha->id }})">
                    <div class="card card-carrusel" style="{{$selectedCard === $analisis_brecha->id ? 'background-color: #3AAE65;' : '' }}">
                        <div class="card-body" style="padding: 18px 32px 10px 29px;">
                                <div class="row">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="col-2">
                                            <i class="material-icons-outlined" style="font-size:32px;">
                                                bookmark_border
                                            </i>
                                        </div>
                                        <div class="col-10" style="padding-right:0;">
                                           <h6 style="margin-bottom: 0px;">{{$analisis_brecha->nombre_template}}</h6>
                                           <p>Selecciona tu template</p>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="arrow-carrusel-der" style="margin-left: 25px;">
                <i class="material-icons-outlined">arrow_forward_ios</i>
            </div>
        </div>
        <div class="d-flex justify-content-start" style="padding-left: 160px;">
            <a href="{{route('admin.template-top')}}">Ver todos</a>
        </div>
        <div class="d-flex justify-content-end" style="padding-right: 110px;">
            <a class="btn btn-light text-primary border border-primary" href="{{route('admin.templates.create')}}">
                Crear template +
            </a>
        </div>
    </div>

    <div class="mt-4 card card-body">
        <form wire:submit.prevent={{ $view == 'create' ? 'save' : 'update' }}>
            {{-- @csrf --}}
            <h5 class="form-group col-12">Datos generales</h5>
            <hr>
            {{-- <div class="form-group">
                <p class="font-weight-bold" style="font-size:11pt;">Llene los siguientes campos según corresponda:</p>
            </div> --}}
            <div class="row">
                <div class="form-group col-md-3 col-lg-3 col-sm-12 anima-focus">
                    <input  class="form-control {{ $errors->has('fecha') ? 'is-invalid' : '' }}" type="text"
                    id="fecha" value="{{ date('d-m-Y') }}" min="1945-01-01" disabled wire:model.defer="fecha" >
                    @if ($errors->has('fecha'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha') }}
                        </div>
                        @endif
                    <label for="fecha">Fecha</label>
                </div>
                {{ Form::hidden('fecha', date('Y-m-d')) }}
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-lg-6 col-sm-12 anima-focus">
                    <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                    name="nombre" id="nombre" value="{{ old('nombre', '') }}" required wire:model.defer="name" placeholder="">
                    @if ($errors->has('nombre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                    @endif
                    <label for="nombre">Nombre *</label>
                </div>

                {{-- <div class="form-group col-md-6 col-lg-6 col-sm-12 anima-focus">
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
                    <label for="estatus">Estatus</label>
                </div> --}}
                <div class="form-group col-md-6 col-lg-6 col-sm-12 anima-focus">
                    {{-- <select class="form-control {{ $errors->has('norma') ? 'is-invalid' : '' }}" name="norma"
                        id="estatus" required wire:model.defer="norma" >
                        <option value disabled {{ old('norma', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach ($normas as $key => $label)
                            <option value="{{ $label->id }}"
                                {{ old('norma', '') === (string) $key ? 'selected' : '' }}
                                {{ $key == 0 ? '' : 'disabled'}}>{{ $label->norma }}
                            </option>
                            @endforeach
                    </select>
                    @if ($errors->has('norma'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estatus') }}
                        </div>
                    @endif --}}
                    <input  class="form-control" type="text"
                    id="norma" disabled wire:model.defer="norma"  >

                    <label for="norma">norma</label>
                </div>


            </div>
            <div class="row">
                <div class="form-group col-md-6 col-sm-6 anima-focus">
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
                    <label for="id_elaboro">Elaboró </label>
                    @if ($errors->has('id_elaboro'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_elaboro') }}
                        </div>
                    @endif
                </div>

                <div class="form-group col-md-3 col-sm-3 col-lg-3 anima-focus">
                    <div class="form-control" id="id_puesto" readonly ></div>
                    <label for="id_puesto">Puesto</label>
                </div>
                    @if ($errors->has('id_puesto'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_puesto') }}
                        </div>
                    @endif


                <div class="form-group col-md-3 col-sm-3 col-lg-3 anima-focus">
                    <div class="form-control" id="id_area" readonly></div>
                    <label for="id_area"><i class="fas fa-street-viewa iconos-crear"></i>Área</label>
                </div>
                    @if ($errors->has('id_area'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_area') }}
                        </div>
                    @endif

            </div>
            <div class="text-right form-group col-12">
                        <button class="btn btn-light text-primary border border-primary"  >
                            {{ $view == 'create' ? 'Crear Análisis de Brechas' : 'Actualizar Análisis de Brechas' }}
                        </button>
            </div>
        </form>
    </div>

    <div class="datatable-rds datatable-fix">
	            <table id="datatable_analisisbrechas" class="table w-100">
	                <thead>
	                    <tr>
	                        <th>Id</th>
                            <th>Nombre</th>
	                        <th>Fecha</th>
                            <th>Elaboro</th>
                            <th>norma</th>
                            <th></th>
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
                            <td>
                                @if (isset($analisis_brecha->norma_id))
                                    {{$analisis_brecha->norma->norma}}
                                @else
                                Norma no asignada
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" wire:click="edit({{ $analisis_brecha->id }})">
                                            <div class="d-flex align-items-start">
                                                <i class="material-icons-outlined" style="width: 24px;font-size:18px;">edit_outline</i>
                                                Editar
                                            </div>
                                        </a>
                                        <a class="dropdown-item" wire:click="$emit('delete',{{$analisis_brecha->id}})">
                                            <div class="d-flex align-items-start">
                                                <i class="material-icons-outlined" style="width: 24px;font-size:18px;">delete_outlined</i>
                                                Eliminar
                                            </div>
                                        </a>
                                    </div>
                                </div>
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

@yield('js')

<script>
 document.addEventListener("DOMContentLoaded", function() {
     Livewire.on("delete", id=>{
         Swal.fire({
             title: "Eliminar Análisis de brechas",
             text: "¿Esta seguro que desea eliminar?",
             icon: "warning",
             showCancelButton: true,
             confirmButtonColor: "#3085d6",
             cancelButtonColor: "#d33",
             confirmButtonText: "Eliminar",
             cancelButtonText: "Cancelar",
         }).then((result) => {
         if (result.isConfirmed) {
             Livewire.emitTo('analisis-brechas-iso-form','destroy',id);
             Swal.fire({
             title: "Eliminado",
             text: "El análisis de brechas se elimino con éxito",
             icon: "success"
             });
         }
         });
     })
 });
</script>

    </div>
