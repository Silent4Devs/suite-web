<div class="form-group col-md-12">

    <div col-12 offset-10>
        @livewire('auditoria-interna-hallazgos', ['auditoria_internas_id' => $auditoria_internas_id])
    </div>

    <table class="table">
        <thead class="head-light">
            <tr>
                <th scope="col-6">Requisito</th>
                <th scope="col-6">Descripción</th>
                <th scope="col-6">Clasificación</th>
                <th scope="col-6">Proceso relacionado</th>
                <th scope="col-6">Área relacionada</th>
                <th scope="col-6">Opciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td style="min-width:130px;">{{ $data->incumplimiento_requisito}}</td>
                    <td style="min-width:100px;">{{ $data->descripcion }}</td>
                    <td style="min-width:100px;">{{ $data->clasificacion_hallazgo }}</td>
                    <td style="min-width:100px;">{{$data->procesos ? $data->procesos->nombre : 'n/a'}}</td>
                    <td style="min-width:100px;">{{$data->areas ? $data->areas->area : 'n/a'}}</td> 
                    <td style="min-width:40px;">
                        <i class="fas fa-edit" wire:click.prevent="$dispatch('editarParteInteresada',{{ $data->id }})">
                        </i>
                        {{-- <i class="fas fa-project-diagram"
                            wire:click.prevent="$dispatch('agregarNormas',{{ $data->id }})"> </i> --}}
                        <i class="fas fa-trash-alt text-danger"
                            wire:click.prevent="$dispatch('eliminarParteInteresada',{{ $data->id }})"> </i>
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
