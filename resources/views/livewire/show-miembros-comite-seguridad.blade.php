<div class="form-group col-md-12">

            <form method="POST" class="row" action="{{ route("admin.comiteseguridads.saveMember", [$id_comite]) }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group col-sm-6 anima-focus">
                        <select class="form-control  {{ $errors->has('colaborador') ? 'is-invalid' : '' }}"
                            name="id_asignada" id="id_asignada" wire:model.defer="colaborador">
                            <option value="">Seleccione una opción</option>
                            @foreach ($empleados as $empleado)
                                <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                    data-area="{{ $empleado->area->area }}">
                                    {{ $empleado->name }}
                                </option>
                            @endforeach
                        </select>
                        {!! Form::label('id_asignada', 'Nombre del Integrante*', ['class' => 'asterisco']) !!}
                    </div>

                    <div class="form-group col-sm-6 anima-focus">
                        <input class="form-control {{ $errors->has('nombrerol') ? 'is-invalid' : '' }}" type="text"
                            name="nombrerol" id="nombrerol" placeholder=" " required>
                        {!! Form::label('nombrerol', 'Rol que desempeña*', ['class' => 'asterisco']) !!}
                    </div>

                    <div class="form-group col-sm-12 col-md-12 col-lg-12 anima-focus">
                        <textarea required class="form-control" id="responsabilidades" name="responsabilidades"  placeholder=" " rows="4"></textarea>
                        {!! Form::label('responsabilidades', 'Descripción*', ['class' => 'asterisco']) !!}
                    </div>

                <div class="text-right form-group col-12">
                    <button class="btn" type="submit">
                        Agregar integrantes al comite +
                    </button>
                </div>
            </form>


    @include('partials.flashMessages')
    <div class="datatable-fix datatable-rds">
        <h3 class="title-table-rds">Miembros  del  Comites</h3>
        @include('admin.comiteseguridads.table_miembros')
    </div>



</div>
<script>

    document.addEventListener('DOMContentLoaded', () => {
        Livewire.on('cerrar-modal', (event) => {
            $('#exampleModal').modal('hide');
            $('.modal-backdrop').hide();
            if (event.editar) {
                toastr.success('Editado con éxito');
            } else {
                toastr.success('Creado con éxito');
            }

        })
        Livewire.on('abrir-modal', () => {
            $('#exampleModal').modal('show');
            $('.select2').select2({
                theme: 'bootstrap4'
            });

        })
        Livewire.on('editarParteInteresada', () => {


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
