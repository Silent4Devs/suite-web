<div class="form-group col-md-12">

    <label for="exampleInputEmail1"> <i class="fas fa-id-card iconos-crear"></i>3.¿Quién le proporciona esta
        información?</label>

    <div class="row">
        @livewire('create-propociona-informacion', ['cuestionario_id' => $cuestionario_id])
    </div>

    <table class="table">
        <thead class="head-light">
            <tr>
                <th scope="col-6">Interno / Externo</th>
                <th scope="col-6">Nombre</th>
                <th scope="col-6">Puesto</th>
                <th scope="col-6">Correo electrónico:</th>
                <th scope="col-6">Ext.:</th>
                <th scope="col-6">Ubicación</th>
                <th scope="col-6">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <th style="min-width:130px;">
                        @if ($data->interno_externo == 1 )
                        <div style="text-align: left;">Interno</div>
                        @elseif ($data->interno_externo == 2)
                         <div style="text-align: left;">Externo</div>
                        @else
                         <div style="text-align: left;">No definido</div>
                        @endif
                    </th>
                    <th style="min-width:130px;">
                        <div style="text-align: left;">{{ $data->nombre }}</div>
                    </th>
                    <td style="min-width:100px;">
                        <div style="text-align: left;">{{ $data->puesto }}</div>
                    </td>
                    <td style="min-width:100px;">
                        <div style="text-align: left;">{{ $data->correo_electronico }}</div>
                    </td>
                    <td style="min-width:50px;">
                        <div style="text-align: left;">{{ $data->extencion }}</div>
                    </td>
                    <td style="min-width:100px;">
                        <div style="text-align: left;">{{ $data->ubicacion }}</div>
                    </td>
                    <td style="min-width:40px;">
                        <i class="fas fa-edit"
                            wire:click.prevent="$dispatch('editarFuenteInformacion',{{ $data->id }})">
                        </i>
                        {{-- <i class="fas fa-project-diagram"
                            wire:click.prevent="$dispatch('agregarNormas',{{ $data->id }})"> </i> --}}
                        <i class="fas fa-trash-alt text-danger"
                            wire:click.prevent="$dispatch('eliminarFuenteInformacion',{{ $data->id }})"> </i>
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
