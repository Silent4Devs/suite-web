<div class="form-group col-md-12">

    <div col-12 offset-10>
        @livewire('plan-auditoria-actividades-component', ['plan_auditoria_id' => $plan_auditoria_id])
    </div>

    <table class="table">
        <thead class="head-light">
            <tr>
                <th scope="col-6">Actividad</th>
                <th scope="col-6">Fecha de auditoria</th>
                <th scope="col-6">Horario de inicio</th>
                <th scope="col-6">Horario de término</th>
                <th scope="col-6">Auditado</th>
                <th scope="col-6">Auditor</th>
                <th scope="col-6">Opciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td style="min-width:130px;">{{ $data->actividad_auditar}}</td>
                    <td style="min-width:100px;">{{ $data->fecha_auditoria ? \Carbon\Carbon::parse($data->fecha_auditoria)->format('d-m-Y') : null }}</td>
                    <td style="min-width:100px;">{{ $data->horario_inicio }}</td>
                    <td style="min-width:100px;">{{ $data->horario_termino }}</td>
                    <td style="min-width:130px;"><img class="img_empleado"
                            src="{{ asset('storage/empleados/imagenes') }}/{{ $data->auditado ? $data->auditado->avatar : 'user.png' }}"
                            title="{{ $data->auditado->name ?? ''}}"></td>
                    <td style="min-width:100px;">{{$data->nombre_auditor}}</td>
                    <td style="min-width:40px;">
                        <i class="fas fa-edit" wire:click.prevent="$emit('editarParteInteresada',{{ $data->id }})">
                        </i>
                        {{-- <i class="fas fa-project-diagram"
                            wire:click.prevent="$emit('agregarNormas',{{ $data->id }})"> </i> --}}
                        <i class="fas fa-trash-alt text-danger"
                            wire:click.prevent="$emit('eliminarParteInteresada',{{ $data->id }})"> </i>
                    </td>
                    {{-- <td> @livewire('edit-partes-interesadas',['id_requisito'=>$data->id])</td> --}}
                </tr>
            @endforeach

        </tbody>
    </table>


</div>
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
