<div>
    <table class="table" id="tableTasks">
        <thead>
            <td>Plan Acción</td>
            <td>Tarea</td>
            <td>Estatus</td>
            <td>Fecha Inicio</td>
            <td>Fecha Fin</td>
            <td>Creación</td>
            <td>Opciones</td>
        </thead>
        <tbody>
            @foreach ($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->group->planAccion->title }}</td>
                    <td>{{ $tarea->title }}</td>
                    <td>
                        <select name="" class="custom-select select-tarea" tarea-id="{{ $tarea->id }}">
                            @foreach ($tarea->group->planAccion->groups as $group)
                                <option value="{{ $group->id }}" tarea-id="{{ $tarea->id }}"
                                    {{ $tarea->group->id == $group->id ? 'selected' : '' }}>
                                    {{ $group->label }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>{{ $tarea->fecha_inicio ?? 'N/A' }}</td>
                    <td>{{ $tarea->fecha_fin ?? 'N/A' }}</td>
                    <td>{{ $tarea->created_at->diffForHumans() }}</td>
                    <td>
                        @livewire('evidencia-task-kanban', ['taskId' => $tarea->id], key($tarea->id))
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('tableTasks').addEventListener('change', (e) => {
                if (e.target.classList.contains('select-tarea')) {
                    let groupId = e.target.value;
                    let taskId = e.target.getAttribute('tarea-id');
                    @this.taskGroupChange(taskId, groupId);
                }
            })
        });
    </script>

</div>
