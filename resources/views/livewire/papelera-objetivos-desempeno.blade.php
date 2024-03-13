<div>
    <div class="datatable-fix">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Objetivos Estratégicos</th>
                    <th>Descripción</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($objetivos as $obj)
                    <tr>
                        <td>{{ $obj->categoria->nombre }}</td>
                        <td>{{ $obj->objetivo }}</td>
                        <td>{{ $obj->descripcion }}</td>
                        <td>Opciones</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- The whole world belongs to you. --}}
</div>
