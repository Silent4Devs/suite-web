<div class="form-group col-md-12">

    <div col-12 offset-10>
        @livewire('create-partes-interesadas',['id_interesado'=>$id_interesado])
    </div>

<br>
<br>
<div class="card card-body">
    @include('partials.flashMessages')
    <div class="datatable-fix datatable-rds">
        <table class="datatable">
            <thead>
                <tr>
                    <th>Necesidades</th>
                    <th>Expectativas</th>
                    <th>Norma(s)</th>
                    <th>Opciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <th>{{ $data->necesidades }}</th>
                        <td>{{ $data->expectativas }}</td>
                        <td>
                            @if (!is_null($data->normas))
                                    @forelse ($data->normas as $norma)
                                        <span> {{ $norma->norma }}</span>
                                    @empty
                                        Sin normas
                                    @endforelse
                            @endif
                        </td>
                        <td>
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
        Livewire.on('abrirModalPartesInteresadas', () => {
            $('#NormasModal').modal('show');

        })
        Livewire.on('cerrarModalPartesInteresadas', () => {
            $('#NormasModal').modal('hide');
            $('.modal-backdrop').hide();

        })
    })
</script>
