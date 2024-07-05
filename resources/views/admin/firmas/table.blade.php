<table class="datatable datatable-lista-distribucion" id="datatable-lista-distribucion">
    <thead>
        <tr>
            <th style="width: 80rem;">
                Módulo
            </th>
            <th style="width: 80rem;">
                Submódulo
            </th>
            <th style="width: 80rem; position: relative; left: 2rem;">
                Aprobadores
            </th>
            <th style="width: 80rem;">
                Opciones
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($firmaModules as $firma)
        <tr>
            <td style="">{{ $firma->modulo->name }}</td> <!-- Ajusta 'nombre' según el campo real en tu tabla de módulos -->
            <td style="">{{ $firma->submodulo->name }}</td>
            <td style="">
                @if($firma->empleados->isNotEmpty())
                    <ul>
                        @foreach ($firma->empleados as $empleado)
                            <li>{{ $empleado->name }}</li> <!-- Asumiendo que 'name' es un campo en la tabla 'empleados' -->
                        @endforeach
                    </ul>
                @else
                    No participantes
                @endif
            </td>
            <td style="">
                <a href="{{ route('admin.module_firmas.edit', $firma->id) }}"><i
                        class="fas fa-edit"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
