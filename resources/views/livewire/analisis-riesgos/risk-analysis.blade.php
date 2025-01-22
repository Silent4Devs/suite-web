<div>
    <div>
        {{-- Template selector and carrucel --}}
        <div class="mt-4 card shadow-sm" >
            <div class="card-body">
                <h5 class="title-carrucel">Template de Analisis de riesgos</h5>
                <h6 style="margin-bottom: :0px;">Seleciona el template que utilizarás para evaluar el nivel de cumplimiento de tu organización</h6>
                <hr class="hr-custom" style="margin-bottom: 24px;">
                <a class="btn-show-todos" href="{{ route('admin.top-template-analisis-riesgos') }}">
                    Ver todos los templates <span class="material-symbols-outlined" style="font-size: 18px;">arrow_forward</span>
                </a>

                <div class="content-limit caja-carrusel">
                    <div class="arrow-carrusel-izq" style="margin-right: 10px;">
                        <i class="material-icons-outlined">arrow_back_ios</i>
                    </div>
                    <div class="carrusel-infinito" style="margin: 0px 10px 0px 10px;">
                        @foreach ($templates as $index => $analisis)
                            <div class="item-carrusel" style="{{ $index == 0 ? 'margin-left:25px;' : '' }}"
                                wire:click="SelectCard({{ $analisis->id }})">
                                <span title="{{ $analisis->nombre }}">
                                    <div class="card card-carrusel"
                                        style="{{ $selectedCard === $analisis->id ? 'background-color: #3AAE65;' : '' }}">
                                        <div class="card-body" style="padding: 18px 32px 10px 29px;">
                                            <div class="row">
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <div class="col-2">
                                                        <i class="material-icons-outlined" style="font-size:32px;">
                                                            bookmark_border
                                                        </i>
                                                    </div>
                                                    <div class="col-10" style="padding-right:0;">
                                                        <h6 style="margin-bottom: 0px;">
                                                            {{ \Illuminate\Support\Str::limit($analisis->nombre, 20, $end = '...') }}
                                                        </h6>
                                                        <p class="m-0">Selecciona tu template</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="arrow-carrusel-der" style="margin-left: 10px;">
                        <i class="material-icons-outlined">arrow_forward_ios</i>
                    </div>
                </div>

                <div class="d-flex justify-content-end" >
                    <a class="btn tb-btn-primary" href="{{ route('admin.templates.create') }}">
                        Crear template +
                    </a>
                </div>
            </div>
        </div>
        {{-- Form --}}
        <div class="mt-4 card card-body shadow-sm" >
            <h5 class="title-form">Datos generales del Análisis</h5>
            <hr class="hr-custom">
            <form wire:submit.prevent={{ $view == 'create' ? 'save' : 'update' }} style="margin-top: 23.5px">
                {{-- @csrf --}}
                <div class="row">
                    <div class="form-group col-md-3 col-lg-3 col-sm-12 anima-focus">
                        <input class="form-control {{ $errors->has('fecha') ? 'is-invalid' : '' }}" type="text"
                            id="fecha" min="1945-01-01" disabled wire:model.lazy="fecha" style="background:#EBF9FF;">
                        @if ($errors->has('fecha'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha') }}
                            </div>
                        @endif
                        <label for="Fecha">Fecha</label>
                        <span class="material-symbols-outlined" style="position: absolute; top:0; right:35px; top:10px; font-size:22px;">
                            calendar_today
                        </span>
                    </div>
                    <input type="hidden" name="fecha" value="{{ date('Y-m-d') }}">
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-lg-6 col-sm-12 anima-focus">
                        <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                            name="nombre" id="nombre" value="{{ old('nombre', '') }}" required wire:model.lazy="name"
                            placeholder="">
                        <label for="nombre">Nombre *</label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 col-lg-6 col-sm-12 anima-focus">


                        <input class="form-control" type="text" id="norma" disabled wire:model.lazy="norma">

                        <label for="norma">Norma</label>
                    </div>


                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-sm-6 anima-focus">
                        <select class="form-control {{ $errors->has('elaboro_id') ? 'is-invalid' : '' }}" name="elaboro_id"
                            id="elaboro_id" required wire:model.lazy="elaboro_id">
                            <option value disabled {{ old('elaboro_id', null) === null ? 'selected' : '' }}>
                                Selecciona una opción</option>
                            @foreach ($colaboradores as $key => $label)
                                <option data-puesto="{{ $label->puesto }}" data-area="{{ $label->area->area }}"
                                    value="{{ $label->id }}">
                                    {{ $label->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="elaboro_id">Elaboró </label>
                        @if ($errors->has('elaboro_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('elaboro_id') }}
                            </div>
                        @endif
                    </div>

                    <div>
                    </div>
                    <div wire:ignore class="form-group col-md-3 col-sm-3 col-lg-3 anima-focus">
                        <div class="form-control d-flex align-items-center" id="id_puesto" readonly></div>
                        <label for="id_puesto">Puesto</label>
                    </div>
                    @if ($errors->has('id_puesto'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_puesto') }}
                        </div>
                    @endif


                    <div wire:ignore class="form-group col-md-3 col-sm-3 col-lg-3 anima-focus">
                        <div class="form-control d-flex align-items-center" id="id_area" readonly></div>
                        <label for="id_area"><i class="fas fa-street-viewa iconos-crear"></i>Área</label>
                    </div>
                    @if ($errors->has('id_area'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_area') }}
                        </div>
                    @endif

                </div>
                <div class="text-right form-group col-12">
                    <button class="btn btn tb-btn-primary">
                        {{ $view == 'create' ? 'Guardar' : 'Actualizar' }}
                    </button>
                </div>
            </form>
        </div>
        {{-- List register --}}
        <div  class="mt-4 card card-body shadow-sm" >
            <h5 class="title-list">Análisis de Riesgos</h5>
            <hr class="hr-custom">
            <div class="container-items">
                @foreach ($registers as $register )
                <div class="card shadow-sm list-item " id="{{$register->id}}">
                    <div class="card-header item-header">
                        <h6 class="item-title">{{$register->fecha}}</h6>
                        <div style="position: absolute; right: 0px;">
                            <div class="d-flex options">
                                <div class="caja-options card card-body" style="border-radius: 0px !important;">
                                    <a class="d-flex align-items-center" href="{{ route('admin.show-risk-analysis', $register->id) }}">
                                        <i class="material-symbols-outlined icon-option">
                                            visibility
                                            </i>
                                        <p class="m-0">Ver</p>
                                    </a>
                                    <div class="d-flex align-items-center">
                                        <i class="material-symbols-outlined icon-option">
                                            edit
                                        </i>
                                        <p class="m-0">Editar</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="material-symbols-outlined icon-option">
                                            delete
                                        </i>
                                        <p class="m-0">Eliminar</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="material-symbols-outlined icon-option">
                                            disabled_by_default
                                        </i>
                                        <p class="m-0">Finalizar</p>
                                    </div>
                                </div>
                                <button class="btn">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <h6 class="item-name">
                            {{$register->name}}
                        </h6>
                        <p class="item-norma">
                            {{$register->norma->norma}}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let elaboro = document.querySelector('#elaboro_id');
                let area_init = elaboro.options[elaboro.selectedIndex].getAttribute('data-area');
                let puesto_init = elaboro.options[elaboro.selectedIndex].getAttribute('data-puesto');

                document.getElementById('id_puesto').innerHTML = recortarTexto(puesto_init);
                document.getElementById('id_area').innerHTML = recortarTexto(area_init);
                elaboro.addEventListener('change', function(e) {
                    e.preventDefault();
                    let area = this.options[this.selectedIndex].getAttribute('data-area');
                    let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                    document.getElementById('id_puesto').innerHTML = recortarTexto(puesto);
                    document.getElementById('id_area').innerHTML = recortarTexto(area);
                })

                function recortarTexto(texto, length = 30)
                {
                    let trimmedString = texto?.length > length ?
                        texto.substring(0, length - 3) + "..." :
                        texto;
                    return trimmedString;
                }
            });
        </script>
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('limpiarNameInput', function() {
                    // Limpiar el campo de entrada de "name" utilizando JavaScript
                    document.getElementById('id_area').textContent = "";
                    document.getElementById('id_puesto').textContent = "";

                });

                Livewire.on('edit', function() {
                    let elaboro = document.querySelector('#elaboro_id');
                    let area_init = elaboro.options[elaboro.selectedIndex].getAttribute('data-area');
                    let puesto_init = elaboro.options[elaboro.selectedIndex].getAttribute('data-puesto');

                    document.getElementById('id_puesto').innerHTML = recortarTexto(puesto_init);
                    document.getElementById('id_area').innerHTML = recortarTexto(area_init);
                    elaboro.addEventListener('change', function(e) {
                        e.preventDefault();
                        let area = this.options[this.selectedIndex].getAttribute('data-area');
                        let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                        document.getElementById('id_puesto').innerHTML = recortarTexto(puesto);
                        document.getElementById('id_area').innerHTML = recortarTexto(area);
                    })

                    function recortarTexto(texto, length = 30) {
                        let trimmedString = texto?.length > length ?
                            texto.substring(0, length - 3) + "..." :
                            texto;
                        return trimmedString;
                    }
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Livewire.on("selectedCardAlert", function() {
                    Swal.fire({
                        title: "Importante",
                        text: "Seleciona un template del carrusel",
                        imageUrl: @json($imagenID),
                        imageWidth: 100,
                        imageHeight: 100,
                        imageAlt: "Custom image",
                        customClass: {
                            popup: 'rounded-card'
                        }
                    });
                })
            });
        </script>
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('limpiarNameInput', function() {
                    // Limpiar el campo de entrada de "name" utilizando JavaScript
                    document.getElementById('id_area').textContent = "";
                    document.getElementById('id_puesto').textContent = "";

                });

                // Livewire.on('edit', function() {
                //     let elaboro = document.querySelector('#id_elaboro');
                //     let area_init = elaboro.options[elaboro.selectedIndex].getAttribute('data-area');
                //     let puesto_init = elaboro.options[elaboro.selectedIndex].getAttribute('data-puesto');

                //     document.getElementById('id_puesto').innerHTML = recortarTexto(puesto_init);
                //     document.getElementById('id_area').innerHTML = recortarTexto(area_init);
                //     elaboro.addEventListener('change', function(e) {
                //         e.preventDefault();
                //         let area = this.options[this.selectedIndex].getAttribute('data-area');
                //         let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                //         document.getElementById('id_puesto').innerHTML = recortarTexto(puesto);
                //         document.getElementById('id_area').innerHTML = recortarTexto(area);
                //     })

                //     function recortarTexto(texto, length = 30) {
                //         let trimmedString = texto?.length > length ?
                //             texto.substring(0, length - 3) + "..." :
                //             texto;
                //         return trimmedString;
                //     }

                // });
            });
        </script>
    </div>

