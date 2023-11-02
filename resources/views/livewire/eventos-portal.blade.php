<div class="row">
    <style type="text/css">
        .modal {}

        .modal-content {
            box-shadow: 0px 0px 0px 5000px rgba(0, 0, 0, 0.2) !important;
        }

        .titulo_acordeon_eventos {
            all: unset;
            padding: 10px;
            font-size: 16px;
            color: #747474;
        }

        .acordeon_separado {
            margin-top: 15px;
        }

        .titulos_acordeon_i_name_i {
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .titulos_acordeon_i_name_i span {
            margin-right: 20px;
        }

        .indicador_numero {
            background-color: #3086AF;
            color: #fff !important;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
            padding: 0;
            margin: 0;
            border-radius: 50px;
            position: absolute;
            top: 0px;
            left: 25px;
            font-size: 10px !important;
        }
    </style>

    <script src="https://cdn.ckeditor.com/4.17.1/standard-all/ckeditor.js"></script>


    <div class="col-lg-12 caja_btn_silent">
        <div class="card card-body" style="padding:5px 20px !important;">
            @can('portal_comunicacion_mostrar_organizacion')
                <a class="btn-silent" href="{{ asset('admin/organizacions/visualizarorganizacion') }}">
                    <i class="bi bi-building mr-2"></i>
                    <span>Organización</span>
                </a>
            @endcan
            @can('portal_comunicacion_mostrar_sedes')
                <a class="btn-silent" href="{{ asset('admin/sedes/organizacion') }}">
                    <i class="bi bi-geo-alt mr-2"></i>
                    <span>Sedes</span>
                </a>
            @endcan
            @can('portal_comunicacion_mostrar_areas')
                <a href="{{ route('admin.areas.renderJerarquia') }}" class="btn-silent">
                    <i class="bi bi-geo mr-2"></i>
                    <span>Áreas</span>
                </a>
            @endcan
            @can('portal_comunicacion_mostrar_mapa_de_procesos')
                <a href="{{ route('admin.procesos.mapa') }}" class="btn-silent">
                    <i class="bi bi-file-post mr-2"></i>
                    <span> Mapa de procesos </span>
                </a>
            @endcan
            @can('portal_comunicacion_mostrar_organigrama')
                <a class="btn-silent" href="{{ asset('admin/organigrama') }}">
                    <i class="bi bi-diagram-3"></i>
                    <span>Organigrama</span>
                </a>
            @endcan
            @can('portal_comunicacion_mostrar_directorio')
                <a class="btn-silent" href="{{ asset('admin/directorio') }}">
                    <i class="bi bi-journal mr-2"></i>
                    <span>Directorio</span>
                </a>
            @endcan
            @can('portal_comunicacion_mostrar_documentos')
                <a class="btn-silent" href="{{ asset('admin/documentos/publicados') }}">
                    <i class="bi bi-folder2 mr-2"></i>
                    <span>Documentos</span>
                </a>
            @endcan
            @if ($politica_existe != 0)
                @can('portal_comunicacion_mostrar_politicas')
                    <a class="btn-silent" href="{{ asset('admin/politica-sgsis/visualizacion') }}">
                        <i class="bi bi-collection mr-2"></i>
                        <span>Políticas</span>
                    </a>
                @endcan
            @endif
            @if ($comite_existe != 0)
                @can('portal_comunicacion_mostrar_comites')
                    <a class="btn-silent" href="{{ asset('admin/comiteseguridads/visualizacion') }}">
                        <i class="bi bi-person-bounding-box mr-2"></i>
                        <span>Comités</span>
                    </a>
                @endcan
            @endif
            @if ($empleado_asignado)
                @can('portal_comunicacion_mostrar_reportar')
                    <a class="btn-silent" href="{{ asset('admin/portal-comunicacion/reportes') }}">
                        <i class="bi bi-flag mr-2"></i>
                        <span>Reportar</span>
                    </a>
                @endcan
            @endif
            <a class="btn-silent" href="{{ asset('admin/portal-comunicacion/reportes') }}">
                <i class="bi bi-flag mr-2"></i>
                <span>FODA</span>
            </a>
        </div>

    </div>
    <div class="col-lg-12">
        <div class="card card-body cuadro_empleados scroll_estilo" style="padding:0px !important;">

            @can('portal_comunicacion_mostrar_nuevos_ingresos')
                <div x-data="{ active: 1 }" class="acordeon_separado">
                    <div x-data="{
                        id: 1,
                        get expanded() {
                            return this.active === this.id
                        },
                        set expanded(value) {
                            this.active = value ? this.id : null
                        },
                    }" role="region">
                        <div class="titulos_acordeon_i_name_i" x-on:click="expanded = !expanded" :aria-expanded="expanded">
                            <p class="titulo_acordeon_eventos">
                                <i class="mr-3 far fa-user"></i>
                                Nuevos ingresos
                                <span class="indicador_numero">{{ $nuevos_contador_circulo }}</span>
                            </p>
                            <span x-show="expanded" aria-hidden="true"><i class="fas fa-chevron-up"></i></span>
                            <span x-show="!expanded" aria-hidden="true"><i class="fas fa-chevron-down"></i></span>
                        </div>

                        <div x-show="expanded" x-collapse>
                            <div class="caja_nuevo">
                                @forelse($nuevos as $nuevo)
                                    <div class="nuevo">
                                        <div class="img_nuevo">
                                            <img src="{{ asset('storage/empleados/imagenes/' . $nuevo->avatar) }}"
                                                class="">
                                        </div>
                                        <h5 class="nombre_nuevo">{{ $nuevo->name }}</h5>
                                        <div class="datos_nuevo">
                                            <p>{{ $nuevo->puesto }}<br>
                                                @if (is_null($nuevo->area->area))
                                                    No hay Area
                                                @else
                                                    {{ $nuevo->area->area }}
                                                @endif
                                            </p>
                                            <h6 class="mt-3">Fecha de ingreso</h6>
                                            <span>{{ \Carbon\Carbon::parse($nuevo->antiguedad)->format('d-m-Y') }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="nuevo">No hay nuevos ingresos registrados en este mes.</div>
                                @endforelse

                            </div>
                        </div>

                    </div>
                </div>
            @endcan


            @can('portal_comunicacion_mostrar_cumpleaños')
                <div x-data="{ active: 1 }" class="acordeon_separado">
                    <div x-data="{
                        id: 1,
                        get expanded() {
                            return this.active === this.id
                        },
                        set expanded(value) {
                            this.active = value ? this.id : null
                        },
                    }" role="region">

                        <div class="titulos_acordeon_i_name_i" x-on:click="expanded = !expanded" :aria-expanded="expanded">
                            <p class="titulo_acordeon_eventos">
                                <i class="mr-3 fas fa-birthday-cake"></i>
                                Cumpleaños
                                <span class="indicador_numero">{{ $cumpleaños_contador_circulo }}</span>
                            </p>
                            <span x-show="expanded" aria-hidden="true"><i class="fas fa-chevron-up"></i></span>
                            <span x-show="!expanded" aria-hidden="true"><i class="fas fa-chevron-down"></i></span>
                        </div>

                        <div x-show="expanded" x-collapse>
                            <div class="caja_nuevo" id="contenedor_cumples">
                                @forelse($cumpleaños as $cumple)
                                    <div class="nuevo">
                                        <div class="img_nuevo">
                                            <img src="{{ asset('storage/empleados/imagenes/' . $cumple->avatar) }}"
                                                class="">

                                        </div>
                                        <h5 class="nombre_nuevo">{{ $cumple->name }}</h5>
                                        <div class="datos_nuevo">
                                            <p>{{ $cumple->puesto }}<br>
                                                @if (is_null($cumple->area->area))
                                                    No hay Area
                                                @else
                                                    {{ $cumple->area->area }}
                                                @endif
                                            </p>
                                            <h6 class="mt-3">Fecha de cumpleaños</h6>
                                            @php
                                                $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                                                $fecha = \Carbon\Carbon::createFromFormat('Y-m-d', $cumple->cumpleaños);
                                                $mes = $meses[$fecha->format('n') - 1];
                                                $inputs['Fecha'] = $fecha->format('d') . ' de ' . $mes;
                                            @endphp

                                            <span>{{ $inputs['Fecha'] }}</span>

                                            @php
                                                $cumples_felicitados_like_contador_usuarios = App\Models\FelicitarCumpleaños::where('cumpleañero_id', $cumple->id)
                                                    ->whereYear('created_at', $hoy->format('Y'))
                                                    ->where('like', true)
                                                    ->count();

                                                $cumples_felicitados_like_contador = App\Models\FelicitarCumpleaños::where('cumpleañero_id', $cumple->id)
                                                    ->where('felicitador_id', auth()->user()->empleado->id)
                                                    ->whereYear('created_at', $hoy->format('Y'))
                                                    ->where('like', true)
                                                    ->count();

                                                $cumples_felicitados_like = App\Models\FelicitarCumpleaños::where('cumpleañero_id', $cumple->id)
                                                    ->where('felicitador_id', auth()->user()->empleado->id)
                                                    ->whereYear('created_at', $hoy->format('Y'))
                                                    ->where('like', true)
                                                    ->first();

                                                $cumples_felicitados_comentarios_contador = App\Models\FelicitarCumpleaños::where('cumpleañero_id', $cumple->id)
                                                    ->where('felicitador_id', auth()->user()->empleado->id)
                                                    ->whereYear('created_at', $hoy->format('Y'))
                                                    ->where('like', false)
                                                    ->where('comentarios', '!=', null)
                                                    ->count();

                                                $cumples_felicitados_comentarios = App\Models\FelicitarCumpleaños::where('cumpleañero_id', $cumple->id)
                                                    ->where('felicitador_id', auth()->user()->empleado->id)
                                                    ->whereYear('created_at', $hoy->format('Y'))
                                                    ->where('like', false)
                                                    ->where('comentarios', '!=', null)
                                                    ->first();
                                            @endphp
                                            <div class="opciones_felicitar">
                                                <button style="all:unset;"
                                                    {{ $cumples_felicitados_like_contador == 0 ? 'wire:click=felicitarCumpleaños(' . $cumple->id . ')' : 'wire:click=felicitarCumpleañosDislike(' . $cumples_felicitados_like->id . ')' }}>


                                                    @if ($cumples_felicitados_like_contador_usuarios == 0)
                                                        <i class="far fa-thumbs-up" style="color:#888;"></i>
                                                        <font style="color:#888">
                                                            {{ $cumples_felicitados_like_contador_usuarios }}
                                                        </font>
                                                    @else
                                                        <i class="fas fa-thumbs-up" style="color:#345183;"></i>
                                                        <font style="color:#345183">
                                                            {{ $cumples_felicitados_like_contador_usuarios }}
                                                        </font>
                                                    @endif

                                                    <i class="fas fa-spinner fa-spin"
                                                        style="font-size: 15pt; background-color: rgba(255, 255, 255, 0.3); margin-left:-30px; position: absolute;"
                                                        wire:loading>
                                                    </i>
                                                </button>
                                                <i class="fas fa-comment-dots btn_modal modal_comentarios"
                                                    {{-- data-toggle="modal"
                                                    data-target="#cumpleaños_comentarios_Modal" --}}
                                                    data-comentarios-contador="{{ $cumples_felicitados_comentarios_contador }}"
                                                    data-cumple-id="{{ $cumple->id }}"
                                                    data-comentarios-id="{{ $cumples_felicitados_comentarios ? $cumples_felicitados_comentarios->id : null }}"
                                                    data-comentarios-comentarios="{{ $cumples_felicitados_comentarios ? $cumples_felicitados_comentarios->comentarios : null }}"
                                                    data-cumple-nombre="{{ $cumple->name }}"></i>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="nuevo">No hay cumpleaños registrados en este mes.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endcan


            @can('portal_comunicacion_mostrar_aniversarios')
                <div x-data="{ active: 1 }" class="acordeon_separado">
                    <div x-data="{
                        id: 1,
                        get expanded() {
                            return this.active === this.id
                        },
                        set expanded(value) {
                            this.active = value ? this.id : null
                        },
                    }" role="region">

                        <div class="titulos_acordeon_i_name_i" x-on:click="expanded = !expanded"
                            :aria-expanded="expanded">
                            <p class="titulo_acordeon_eventos">
                                <i class="mr-3 fas fa-medal"></i>
                                Aniversarios
                                <span class="indicador_numero">{{ $aniversarios_contador_circulo }}</span>
                            </p>
                            <span x-show="expanded" aria-hidden="true"><i class="fas fa-chevron-up"></i></span>
                            <span x-show="!expanded" aria-hidden="true"><i class="fas fa-chevron-down"></i></span>
                        </div>

                        <div x-show="expanded" x-collapse>
                            <div class="caja_nuevo">
                                @forelse($aniversarios as $aniversario)
                                    @if (\Carbon\Carbon::createFromTimeStamp(strtotime($aniversario->antiguedad))->diffInYears() > 0)
                                        <div class="nuevo">
                                            <div class="img_nuevo">
                                                <img src="{{ asset('storage/empleados/imagenes/' . $aniversario->avatar) }}"
                                                    class="">
                                            </div>
                                            <h5 class="nombre_nuevo">{{ $aniversario->name }}</h5>
                                            <div class="datos_nuevo">
                                                <p>{{ $aniversario->puesto }}<br>
                                                    @if (is_null($aniversario->area->area))
                                                        No hay Area
                                                    @else
                                                        {{ $aniversario->area->area }}
                                                    @endif
                                                </p>
                                                <h6 class="mt-3">Antigüedad</h6>
                                                <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($aniversario->antiguedad))->diffInYears() }}
                                                    año(s)
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="nuevo">No hay aniversarios registrados en este mes.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endcan


            <div class="modal fade" id="cumpleaños_comentarios_Modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">

                            <label><i class="fas fa-birthday-cake iconos-crear"></i> Envia tus felicitaciones a <strong
                                    id="nombre_cumple" style="color: #3086AF;"></strong></label>

                            <div id="formulario_comentarios"></div>
                            <div style="background-color: rgba(255, 255, 255, 0.1); position:fixed; z-index:99999999; width: 100%; height: 100%; justify-content: center; align-items: center; top: 0; left:0;"
                                wire:loading.flex>
                                <i class="fas fa-spinner fa-spin" style="font-size: 15pt;"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        @section('scripts')
            @parent
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('contenedor_cumples').addEventListener('click', function(e) {
                        if (e.target.classList.contains('modal_comentarios')) {

                            document.getElementById('formulario_comentarios').innerHTML = null;

                            const comentarios_contador = e.target.getAttribute('data-comentarios-contador');
                            const cumple_id = e.target.getAttribute('data-cumple-id');
                            const comentarios_id = e.target.getAttribute('data-comentarios-id');
                            const comentarios_comentarios = e.target.getAttribute('data-comentarios-comentarios');
                            const cumple_nombre = e.target.getAttribute('data-cumple-nombre');

                            console.log(comentarios_contador, cumple_id, comentarios_id, comentarios_comentarios,
                                cumple_nombre);

                            document.getElementById('nombre_cumple').innerHTML = cumple_nombre;

                            if (Number(comentarios_contador) == 0) {


                                document.getElementById('formulario_comentarios').innerHTML = `

                            <div>
                                <div class="form-group">
                                    <textarea class="comentario" name="comentario" wire:model="comentarios" class="form-control" data-sample-short></textarea>
                                </div>
                                <div class="form-group text-right">
                                <button type="submit" id="btn_guardar" data-funcion="felicitarCumplesComentarios" data-cumple-id="${cumple_id}" class="btn btn-success">Enviar</button>
                                </div>
                            </div>
                        `;
                            } else {
                                document.getElementById('formulario_comentarios').innerHTML = `

                            <div>
                                <div class="form-group">
                                    <textarea class="comentario" name="comentario" wire:model="comentarios_update" class="form-control" data-sample-short>${comentarios_comentarios}</textarea>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" id="btn_actualizar" data-funcion="felicitarCumplesComentariosUpdate" data-comentario-id="${comentarios_id}" class="btn btn-success btn_almacenar">Enviar</button>
                                </div>
                            </div>
                        `;
                            }



                            $('#cumpleaños_comentarios_Modal').modal('show');
                        }
                    });




                    document.querySelector('.modal').addEventListener('click', function(e) {
                        if (e.target.getAttribute('id') == 'btn_guardar') {
                            @this.set('comentarios', CKEDITOR.instances.comentario.getData());
                            const funcion = e.target.getAttribute('data-funcion');
                            const cumple_id = e.target.getAttribute('data-cumple-id');
                            @this.call(funcion, cumple_id);
                        }
                        if (e.target.getAttribute('id') == 'btn_actualizar') {
                            @this.set('comentarios_update', CKEDITOR.instances.comentario.getData());
                            const funcion = e.target.getAttribute('data-funcion');
                            const coment_id = e.target.getAttribute('data-comentario-id');
                            @this.call(funcion, coment_id);
                        }
                    });

                    window.livewire.on('comentario-almacenado', function() {
                        $('.modal').modal('hide');
                    });
                });
                $('.modal').on('show.bs.modal', function(event) {

                    console.log(event.target);

                    var users = [{
                                id: 1,
                                avatar: 'm_1',
                                fullname: 'Charles Flores',
                                username: 'cflores'
                            },
                            {
                                id: 2,
                                avatar: 'm_2',
                                fullname: 'Gerald Jackson',
                                username: 'gjackson'
                            },
                            {
                                id: 3,
                                avatar: 'm_3',
                                fullname: 'Wayne Reed',
                                username: 'wreed'
                            },
                            {
                                id: 4,
                                avatar: 'm_4',
                                fullname: 'Louis Garcia',
                                username: 'lgarcia'
                            },
                            {
                                id: 5,
                                avatar: 'm_5',
                                fullname: 'Roy Wilson',
                                username: 'rwilson'
                            },
                            {
                                id: 6,
                                avatar: 'm_6',
                                fullname: 'Matthew Nelson',
                                username: 'mnelson'
                            },
                            {
                                id: 7,
                                avatar: 'm_7',
                                fullname: 'Randy Williams',
                                username: 'rwilliams'
                            },
                            {
                                id: 8,
                                avatar: 'm_8',
                                fullname: 'Albert Johnson',
                                username: 'ajohnson'
                            },
                            {
                                id: 9,
                                avatar: 'm_9',
                                fullname: 'Steve Roberts',
                                username: 'sroberts'
                            },
                            {
                                id: 10,
                                avatar: 'm_10',
                                fullname: 'Kevin Evans',
                                username: 'kevans'
                            },

                            {
                                id: 11,
                                avatar: 'w_1',
                                fullname: 'Mildred Wilson',
                                username: 'mwilson'
                            },
                            {
                                id: 12,
                                avatar: 'w_2',
                                fullname: 'Melissa Nelson',
                                username: 'mnelson'
                            },
                            {
                                id: 13,
                                avatar: 'w_3',
                                fullname: 'Kathleen Allen',
                                username: 'kallen'
                            },
                            {
                                id: 14,
                                avatar: 'w_4',
                                fullname: 'Mary Young',
                                username: 'myoung'
                            },
                            {
                                id: 15,
                                avatar: 'w_5',
                                fullname: 'Ashley Rogers',
                                username: 'arogers'
                            },
                            {
                                id: 16,
                                avatar: 'w_6',
                                fullname: 'Debra Griffin',
                                username: 'dgriffin'
                            },
                            {
                                id: 17,
                                avatar: 'w_7',
                                fullname: 'Denise Williams',
                                username: 'dwilliams'
                            },
                            {
                                id: 18,
                                avatar: 'w_8',
                                fullname: 'Amy James',
                                username: 'ajames'
                            },
                            {
                                id: 19,
                                avatar: 'w_9',
                                fullname: 'Ruby Anderson',
                                username: 'randerson'
                            },
                            {
                                id: 20,
                                avatar: 'w_10',
                                fullname: 'Wanda Lee',
                                username: 'wlee'
                            }
                        ],
                        tags = [
                            'american',
                            'asian',
                            'baking',
                            'breakfast',
                            'cake',
                            'caribbean',
                            'chinese',
                            'chocolate',
                            'cooking',
                            'dairy',
                            'delicious',
                            'delish',
                            'dessert',
                            'desserts',
                            'dinner',
                            'eat',
                            'eating',
                            'eggs',
                            'fish',
                            'food',
                            'foodgasm',
                            'foodie',
                            'foodporn',
                            'foods',
                            'french',
                            'fresh',
                            'fusion',
                            'glutenfree',
                            'greek',
                            'grilling',
                            'halal',
                            'homemade',
                            'hot',
                            'hungry',
                            'icecream',
                            'indian',
                            'italian',
                            'japanese',
                            'keto',
                            'korean',
                            'lactosefree',
                            'lunch',
                            'meat',
                            'mediterranean',
                            'mexican',
                            'moroccan',
                            'nom',
                            'nomnom',
                            'paleo',
                            'poultry',
                            'snack',
                            'spanish',
                            'sugarfree',
                            'sweet',
                            'sweettooth',
                            'tasty',
                            'thai',
                            'vegan',
                            'vegetarian',
                            'vietnamese',
                            'yum',
                            'yummy'
                        ];

                    CKEDITOR.replace('comentario', {
                        plugins: 'mentions,emoji,basicstyles,undo,link,wysiwygarea,toolbar, pastefromgdocs, pastefromlibreoffice, pastefromword',
                        contentsCss: [
                            'http://cdn.ckeditor.com/4.17.1/full-all/contents.css',
                            'https://ckeditor.com/docs/ckeditor4/4.17.1/examples/assets/mentions/contents.css'
                        ],
                        height: 150,
                        toolbar: [{
                                name: 'document',
                                items: ['Undo', 'Redo']
                            },
                            {
                                name: 'basicstyles',
                                items: ['Bold', 'Italic', 'Strike']
                            },
                            {
                                name: 'links',
                                items: ['EmojiPanel', 'Link', 'Unlink']
                            }
                        ],
                        mentions: [{
                                feed: dataFeed,
                                itemTemplate: '<li data-id="{id}">' +
                                    '<img class="photo" src="assets/mentions/img/{avatar}.jpg" />' +
                                    '<strong class="username">{username}</strong>' +
                                    '<span class="fullname">{fullname}</span>' +
                                    '</li>',
                                outputTemplate: '<a href="mailto:{username}@example.com">@{username}</a><span>&nbsp;</span>',
                                minChars: 0
                            },
                            {
                                feed: tags,
                                marker: '#',
                                itemTemplate: '<li data-id="{id}"><strong>{name}</strong></li>',
                                outputTemplate: '<a href="https://example.com/social?tag={name}">{name}</a><span>&nbsp;</span>',
                                minChars: 1
                            }
                        ],
                        removeButtons: 'PasteFromWord'
                    });

                    function dataFeed(opts, callback) {
                        var matchProperty = 'username',
                            data = users.filter(function(item) {
                                return item[matchProperty].indexOf(opts.query.toLowerCase()) == 0;
                            });

                        data = data.sort(function(a, b) {
                            return a[matchProperty].localeCompare(b[matchProperty], undefined, {
                                sensitivity: 'accent'
                            });
                        });

                        callback(data);
                    }

                });
            </script>
        @endsection
    </div>
