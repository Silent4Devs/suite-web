@inject('Empleado', 'App\Models\Empleado')

<style type="text/css">
    .td_div_recursos{
        width: 100px;
        display: flex;
        overflow-x: auto;
    }
</style>
<div class="card-body datatable-fix">
    <table id="tabla_usuario_actividades" class="table">
        <thead>
            <tr>
                <th>Actividad</th>
                {{-- <th>Categoria</th> --}}
                {{-- <th>Urgencia</th> --}}
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Compartida con</th>
                {{-- <th>Asignada por</th> --}}
                <th>Estatus</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actividades as $task)
            <tr>
                <td>{{ $task['name'] }}</td>
                {{-- <td>Categoria</td> --}}
                {{-- <td>Urgencia</td> --}}
                <td>{{ \Carbon\Carbon::createFromTimestamp($task['start'] / 1000)->toDateTimeString()}}</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp($task['end'] / 1000)->toDateTimeString()}}</td>
                <td>
                    <div class="td_div_recursos">
                        @foreach($task['assigs'] as $assig)
                            @php
                                $foto = 'user.png';
                                $empleado = $Empleado->where('id', intval($assig['resourceId']))->first();
                                if ($empleado) {

                                    if ($empleado->foto != null) {
                                        $foto = $empleado->foto;
                                    }
                                    else{
                                        $genero = $empleado->genero;
                                        if ($genero == 'M') {
                                            $foto = 'woman.png';
                                        }
                                        if ($genero == 'H'){
                                            $foto = 'man.png';
                                        }    
                                    } 
                                }
                            @endphp
                            @if($empleado)
                                <img src="{{asset('storage/empleados/imagenes/'.$foto)}}" class="rounded-circle {{$empleado->id == auth()->user()->empleado->id ? 'd-none':''}}" title="{{ $empleado->name }}">
                                {{$empleado->id == auth()->user()->empleado->id ? '':''}}
                            @endif
                        @endforeach
                    </div>
                </td>
                {{-- <td>Asignada por</td> --}}
                <td>{{ $task['status'] }}</td>
                <td class="opciones_iconos">
                    <i class="fas fa-trash-alt"></i>
                    <i class="fas fa-file-alt"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
            let dtButtons = [{
                        extend: 'csvHtml5',
                        title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar CSV',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar Excel',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar PDF',
                        orientation: 'portrait',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        },
                        customize: function(doc) {
                            doc.pageMargins = [20, 60, 20, 30];
                            // doc.styles.tableHeader.fontSize = 7.5;
                            // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10 
                        }
                    },
                    {
                        extend: 'print',
                        title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Imprimir',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Seleccionar Columnas',
                    },
                    {
                        extend: 'colvisGroup',
                        text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                        className: "btn-sm rounded pr-2",
                        show: ':hidden',
                        titleAttr: 'Ver todo',
                    },
                    {
                        extend: 'colvisRestore',
                        text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Restaurar a estado anterior',
                    }

                ];
            $("#tabla_usuario_actividades").DataTable({
                buttons: dtButtons,
            });
        });





    </script>
@endsection