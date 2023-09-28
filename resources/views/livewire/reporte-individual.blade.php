<div>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <div class="container-fluid mb-4">
        <div class="row justify-content-center row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
            @foreach ($clasificaciones as $clasif)
                <div class="col mt-4">
                    <div class="card card-body" style="background-color: #e0f4b8">
                        <h5>{{ $clasif->nombre_clasificaciones }}</h5><br>
                        <h6>1</h6>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 col-md-3 col-lg-4">
                    <h6>Datos Generales*</h6>
                    <label class="form-label select-label">Clausulas</label>
                    <select id="textSelect" class="form-control select">
                        @foreach ($clausulas as $claus)
                            <option value="{{ $claus->id }}">{{ $claus->nombre_clausulas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="row">
        {{-- <a class="btn btn-primary"
            href="{{ route('admin.auditoria-internas.createReporteIndividual', $id_auditoria) }}">Crear Parte
            Interesada</a> --}}
        {{-- <button>Documentar Hallazgo</button> --}}
        <div class="form-group col-md-12">

            <div class="row col-12 ml-5">
                <div class="mb-3 col-12 mt-4 " style="text-align: end">
                    <button type="button" wire:click.prevent="create" class="btn btn-success">Agregar</button>
                </div>
            </div>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ 'Agregar' }} Hallazgos</h5>

                            <input id="auditoria_internas_id" name="auditoria_internas_id" type="hidden"
                                value=" {{ $id_auditoria }}" wire:model.defer="auditoria_internas_id">

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label class="required" for="incumplimiento_requisito">
                                        Requisito</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('incumplimiento_requisito') ? 'is-invalid' : '' }}"
                                        name="incumplimiento_requisito" id="incumplimiento_requisito"
                                        wire:model.defer="incumplimiento_requisito" required />
                                    @if ($errors->has('incumplimiento_requisito'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('incumplimiento_requisito') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label class="required" for="descripcion">
                                        Descripción</label>
                                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion"
                                        wire:model.defer="descripcion" required></textarea>
                                    @if ($errors->has('descripcion'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('descripcion') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <h5>Subtema</h5>

                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label class="required" for="no_tipo">
                                        No. de Tipo</label>
                                    <input type="number" min="1" max="100000"
                                        class="form-control {{ $errors->has('no_tipo') ? 'is-invalid' : '' }}"
                                        name="no_tipo" id="no_tipo" wire:model.defer="no_tipo"></input>
                                    @if ($errors->has('no_tipo'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('no_tipo') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label class="required" for="titulo">
                                        Titulo</label>
                                    <input type="text"
                                        class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}"
                                        name="titulo" id="titulo" wire:model.defer="titulo" />
                                    @if ($errors->has('titulo'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('titulo') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <label class="required" for="clasificacion_id">Clasificación del
                                        Hallazgo</label>
                                    <select name="clasificacion_id" id="clasificacion_id"
                                        class="form-control select {{ $errors->has('clasificacion_id') ? 'is-invalid' : '' }}"
                                        wire:model.defer="clasificacion_id">
                                        <option value="">Seleccione una Clasificación</option>
                                        @foreach ($clasificaciones as $clasif)
                                            <option value="{{ $clasif->id }}">{{ $clasif->nombre_clasificaciones }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('clasificacion_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('clasificacion_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="proceso_id">Proceso</label>
                                    <select class="form-control {{ $errors->has('proceso') ? 'is-invalid' : '' }}"
                                        name="proceso_id" id="proceso_id" wire:model.defer="proceso">
                                        <option value="">Seleccione un proceso</option>
                                        @foreach ($procesos as $proceso)
                                            <option value="{{ $proceso->id }}">
                                                {{ $proceso->codigo }}/{{ $proceso->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('proceso'))
                                        <div class="text-danger">
                                            {{ $errors->first('proceso') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-12 col-lg-12">
                                    <label for="area">Área</label>
                                    <div class="form-control">{{ auth()->user()->empleado->area->area }}</div>
                                    {{-- <input hidden type="text" name="area_id" id="area_id"
                                        wire:model.defer="area_id" value="{{ auth()->user()->empleado->area_id }}"> --}}
                                    {{-- <select class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}"
                                        name="area_id" id="area_id" wire:model.defer="area">
                                        <option value="{{ auth()->user()->empleado->area_id }}" readonly>
                                            {{ auth()->user()->empleado->area->area }}</option>
                                    </select>
                                    @if ($errors->has('area'))
                                        <div class="text-danger">
                                            {{ $errors->first('area') }}
                                        </div>
                                    @endif --}}
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary"
                                wire:click.prevent="{{ 'save' }}">{{ 'Guardar' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-body">
        <div class="form-group col-md-12">

            {{-- <div col-12 offset-10>
                @livewire('auditoria-interna-hallazgos', ['auditoria_internas_id' => $id_auditoria])
            </div> --}}

            <table class="table">
                <thead class="head-light">
                    <tr>
                        <th scope="col-6">Requisito</th>
                        <th scope="col-6">Descripción</th>
                        <th scope="col-6">Subtema</th>
                        <th scope="col-6">Opciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            {{--     <td style="min-width:130px;">{{ $data->incumplimiento_requisito }}</td>
                        <td style="min-width:100px;">{{ $data->descripcion }}</td>
                        <td style="min-width:100px;">{{ $data->clasificacion_id }}</td>
                        <td style="min-width:100px;">{{ $data->procesos ? $data->procesos->nombre : 'n/a' }}</td>
                        <td style="min-width:100px;">{{ $data->areas ? $data->areas->area : 'n/a' }}</td>
                        <td style="min-width:40px;">
                            <i class="fas fa-edit"
                                wire:click.prevent="$emit('editarParteInteresada',{{ $data->id }})">
                            </i>
                            <i class="fas fa-trash-alt text-danger"
                                wire:click.prevent="$emit('eliminarParteInteresada',{{ $data->id }})"> </i>
                        </td> --}}
                            <td style="min-width:130px;">{{ $data->incumplimiento_requisito }}</td>
                            <td style="min-width:100px;">{{ $data->descripcion }}</td>
                            <td style="min-width:100px;">Subtema</td>
                            <td style="min-width:40">
                                <div class="dropdown">
                                    <button class="btn btn-outline-dark dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ url('admin/auditorias/clasificacion-auditorias/edit/${data}') }}">
                                            <i class="fa-solid fa-pencil"></i>&nbsp;Editar</a>
                                        <a class="dropdown-item"
                                            href="{{ url('admin/auditorias/clasificacion-auditorias/delete/${data}') }}">
                                            <i class="fa-solid fa-trash"></i>&nbsp;Eliminar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="min-width:100px;">{{ $data->procesos ? $data->procesos->nombre : 'n/a' }}</td>
                            <td style="min-width:100px;">{{ $data->areas ? $data->areas->area : 'n/a' }}</td>
                            <td style="min-width:100px;">
                                {{ $data->clasificacion->nombre_clasificaciones ?? $data->clasificacion_hallazgo }}
                            </td>
                            <td style="min-width:40px;">
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="row mb-3">
            <div class="col s12">
                <div class="form-group col-sm-12 right " style="margin: 0; text-align: end">
                    <div><span>Mostrar</span>
                        <select class="select_pagination" wire:model="pagination">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span>registros</span>
                    </div>
                </div>
            </div>
            <div>
                {{ $datas->links() }}
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('cerrar-modal', (event) => {
                $('#exampleModal').modal('hide');
                $('.modal-backdrop').hide();


            })
            Livewire.on('abrir-modal', () => {
                $('#exampleModal').modal('show');
                $('.select2').select2({
                    theme: 'bootstrap4'
                });

            })
            Livewire.on('editarParteInteresada', () => {
                console.log('hola');


            });
            Livewire.on('abrirModalPartesInteresadas', () => {
                $('#NormasModal').modal('show');
                setTimeout(() => {
                    CKEDITOR.replace('responsabilidades', {
                        toolbar: [{
                            name: 'paragraph',
                            groups: ['list', 'indent', 'blocks', 'align'],
                            items: ['NumberedList', 'BulletedList', '-', 'Outdent',
                                'Indent', '-',
                                'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                                'JustifyBlock', '-',
                                'Bold', 'Italic'
                            ]
                        }, {
                            name: 'clipboard',
                            items: ['Link', 'Unlink']
                        }, ]
                    });
                }, 1500);
            })
            Livewire.on('cerrarModalPartesInteresadas', () => {
                $('#NormasModal').modal('hide');
                $('.modal-backdrop').hide();

            })
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('id_auditado').addEventListener('change', (e) => {
                let seleccionado = e.target.options[e.target.selectedIndex];
                let puesto = seleccionado.getAttribute('data-puesto')
                let area = seleccionado.getAttribute('data-area')
                console.log(seleccionado);
                document.getElementById('puesto_asignada').innerHTML = puesto;
                document.getElementById('area_asignada').innerHTML = area;
            })
            Livewire.on('cargar-puesto', (empleado) => {
                console.log(empleado);
                let select = document.getElementById('id_auditado');
                let seleccionado = select.options[select.selectedIndex];
                let puesto = seleccionado.getAttribute('data-puesto')
                let area = seleccionado.getAttribute('data-area')
                console.log(seleccionado);
                document.getElementById('puesto_asignada').innerHTML = puesto;
                document.getElementById('area_asignada').innerHTML = area;
            })

            Livewire.on('abrir-modal', () => {
                document.getElementById('puesto_asignada').innerHTML = '';
                document.getElementById('area_asignada').innerHTML = '';
            })


            let editor = CKEDITOR.replace('responsabilidades', {
                toolbar: [{
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                        'Bold', 'Italic'
                    ]
                }, {
                    name: 'clipboard',
                    items: ['Link', 'Unlink']
                }, ]
            });
            editor.on('change', function(event) {
                console.log(event.editor.getData())
                @this.set('responsabilidades', event.editor.getData());
            })
            Livewire.on('cerrar-modal', () => {
                CKEDITOR.instances.responsabilidades.setData('');
            })
            Livewire.on('editar-modal', (data) => {
                CKEDITOR.instances.responsabilidades.setData(data);
            })

            window.initSelect2 = () => {
                $('.select2').select2({
                    'theme': 'bootstrap4'
                });
                $('#proceso_id').on('select2:select', function(e) {
                    var data = e.params.data;
                    console.log(data);
                    @this.set('proceso', data.id);
                });
            }

            initSelect2();

            Livewire.on('select2', () => {
                initSelect2();
            });


        })
    </script>
@endsection
