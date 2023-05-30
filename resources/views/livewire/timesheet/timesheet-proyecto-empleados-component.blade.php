<div class="w-100">
    
    <div class="datatable-fix w-100 mt-4">
        <table id="datatable_timesheet_proyectos" class="table w-100 tabla-animada">
            <thead class="w-100">
                <tr>
                    <th>Nombre </th>
                    <th>Área </th>
                    <th style="max-width:150px !important; width:150px ;">Opciones</th>
                </tr>
            </thead>

            <tbody style="position:relative;">
                @foreach ($proyecto_empleados as $proyect_empleado)
                    <tr>
                        <td>{{ $proyecto->identificador }} </td>
                        <td>{{ $proyecto->proyecto }} </td>
                        <td>ops</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>
