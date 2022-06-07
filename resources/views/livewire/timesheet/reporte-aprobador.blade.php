<div class="w-100">
    <div class="row">
        <div class="col-12">

            @foreach($empleados_children as $empleado)
                <table>
                    <tbody>
                        <tr>
                            <td>{{ $empleado->name }}</td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
        </div>
    </div>
</div>
