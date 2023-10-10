<div>
    <div>
        <h5>Información del nivel de servicio</h5>
        <ul class="collection">
            <li class="collection-item"><span style="color: black">Nombre del servicio:</span>
                <span style="color: black;font-weight: bold">{{ $nivel_servicio->nombre }}</span>
            </li>
            <li class="collection-item"><span style="color: black">Métrica del servicio:</span>
                <span style="color: black;font-weight: bold">{{ $nivel_servicio->metrica }}</span>
            </li>
            <li class="collection-item"><span style="color: black">Unidad del
                    servicio:</span>
                <span style="color: black;font-weight: bold">{{ $nivel_servicio->unidad }}</span>
            </li>
            <li class="collection-item"><span style="color: black">SLA comprometido:</span>
                <span style="color: black;font-weight: bold">{{ $nivel_servicio->meta }}
                    {{ $nivel_servicio->unidad }}</span>
            </li>
        </ul>
    </div>
    <h5>Evaluaciones <span style="">({{ $total_evaluaciones }})</span></h5>
    @if ($total_evaluaciones > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Evaluación</th>
                        <th>Fecha</th>
                        <th>SLA Alcanzado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $resultado = []; ?>
                    @foreach ($EvaluacionServicio as $counter => $Es)
                        <tr>
                            <td>
                                {{ $EvaluacionServicio->firstItem() + $counter }}
                            </td>
                            <td>
                                {{ $Es->evaluacion }} {{ $Es->evaluacion_day }}
                            </td>
                            <td>
                                @if ($Es->fecha)
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ date('d-m-Y', strtotime($Es->fecha)) }}
                                @else
                                    Sin fecha registrada
                                @endif
                            </td>
                            <td>{{ $Es->promedio }} {{ $Es->promedio != null ? $nivel_servicio->unidad : null }}
                            </td>
                            <td>
                                <a href="#form_evaluacion">
                                    <button wire:click="edit({{ $Es->id }})" class="btn blue">
                                        <i class="material-icons">create</i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <button wire:click="destroy({{ $Es->id }})" class="btn red">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>
                        </tr>
                        <div style="display: none">
                            {{ $Es->promedio != null ? ($resultado[] = $Es->promedio) : null }}
                        </div>
                    @endforeach
                </tbody>
            </table>

            <br>
            {{ $EvaluacionServicio->links() }}
        </div>
        <div style="padding-top: 20px;">
            <span class="card-title activator grey-text text-darken-4">Promedio:
                @if (count($resultado))
                    {{ $media = number_format(array_sum($resultado) / count($resultado), 2) }}
                    {{ $nivel_servicio->unidad }}
                    <span style="font-size: 14px; font-weight: bold">
                        @if (count($resultado) == $total_evaluaciones)
                            (Se ha realizado todas las evaluaciones)
                        @else
                            (Actualmente se han realizado
                            {{ count($resultado) }} de un total de {{ $total_evaluaciones }} evaluaciones)
                        @endif

                    </span>
                @else
                    Aún no se ha realizado ninguna evaluación
                @endif

            </span>
            <span class="card-title activator grey-text text-darken-4">Promedio General:
                {{ $media = number_format($promedio_evaluaciones / $total_evaluaciones, 2) }}
                {{ $nivel_servicio->unidad }}</span>
            <div id="resultado">

            </div>
        </div>
    @else
        <br>
        <div
            style="background-color: #006847;padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            color: white;
            border-radius: 4px;
            font-size: 18px">
            <strong>Sin Novedades!</strong> No hay evaluaciones
        </div>
    @endif
    <script>
        window.addEventListener('contentChanged', event => {

            $(document).ready(function() { /// Wait till page is loaded
                $('#resultado').load('property-detailed.php #main', function() {
                    /// can add another function here
                });
            }); //// End of Wait till page is loaded
            //Datepicker
            $('.datepicker').datepicker({
                firstDay: true,
                format: 'dd-mm-yyyy',
                i18n: {
                    cancel: 'Cancelar',
                    clear: 'Limpar',
                    done: 'Ok',
                    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
                        "Septiembre", "Octubre", "Noviembre", "Diciembre"
                    ],
                    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Set", "Oct",
                        "Nov", "Dic"
                    ],
                    weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes",
                        "Sábado"
                    ],
                    weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    weekdaysAbbrev: ["D", "L", "M", "M", "J", "V", "S"]
                },
                //autoclose: false
            });
            //select
            document.addEventListener('DOMContentLoaded', function() {
                //select
                var elems = document.querySelectorAll('select');
                var instances = M.FormSelect.init(elems, options);
                //modal
                var elems = document.querySelectorAll('.modal');
                var instances = M.Modal.init(elems, options);
            });
        });
    </script>

</div>
