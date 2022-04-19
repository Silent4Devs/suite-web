<div class="form-group col-md-12">

    <div col-12 offset-10>
        @livewire('create-partes-interesadas',['id_interesado'=>$id_interesado])
    </div>

    <table class="table">
        <thead class="head-light">
            <tr>
                <th scope="col-6">Necesidades</th>
                <th scope="col-6">Expectativas</th>
                <th scope="col-6">Norma(s)</th>
                <th scope="col-6">Opciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <th style="min-width:130px;">{{ $data->necesidades }}</th>
                    <td style="min-width:100px;">{{ $data->expectativas }}</td>
                    <td style="min-width:40px; position:relative">
                        @if (!is_null($data->normas))
                            <ul>
                                @forelse ($data->normas as $norma)
                                    <li> {{ $norma->norma }}</li>
                                @empty
                                    Sin normas
                                @endforelse
                            </ul>
                        @endif
                    </td>
                    <td style="min-width:40px;">
                        <i class="fas fa-edit"
                            wire:click.prevent="$emit('editarParteInteresada',{{ $data->id }})"> </i>
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
        Livewire.on('abrirModalPartesInteresadas', () => {
            $('#NormasModal').modal('show');

        })
        Livewire.on('cerrarModalPartesInteresadas', () => {
            $('#NormasModal').modal('hide');
            $('.modal-backdrop').hide();

        })
    })
</script>
