<div class="row" style="margin-top: 30px; margin-left: 10px;">
    <div class="col l6">
        <label for="search">Buscador</label>
        <input type="text" class="form-control" wire:model="search" placeholder="Buscar...">
        {{-- <span>Usted está buscando: <strong>{{ $search }}</strong></span> --}}
    </div>

    <div wire:ignore class="input-field col l6 row"
        style="margin-bottom: 0; margin-top: 1.87rem; display: flex; align-items: center; justify-content: center">
        <div class="col l3" style="margin: 0; text-align: end"><span>Mostrar</span></div>
        <div class="col l3" style="margin: 0">
            <select class="select_pagination_niveles" wire:model="pagination">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="col l3" style="margin: 0;text-align: left">
            <span>registros</span>
        </div>
    </div>
</div>
<div class="table-responsive" style="margin-top: 30px;">
    @if ($nivelesServicio->count())
        <table class="table">
            <thead>
                <tr>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('id')">
                        <p class="grey-text letra-ngt">ID</p>
                        @if ($sort == 'id')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('nombre')">
                        <p class="grey-text letra-ngt">Nombre</p>
                        @if ($sort == 'nombre')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('descripcion')">
                        <p class="grey-text letra-ngt">Descripción</p>
                        @if ($sort == 'descripcion')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('periodo_evaluacion')">
                        <p class="grey-text letra-ngt">Periodo evaluación</p>
                        @if ($sort == 'periodo_evaluacion')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    <th style="cursor: pointer; vertical-align: top" wire:click="order('area')">
                        <p class="grey-text letra-ngt">Área</p>
                        @if ($sort == 'area')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt" style="float: right"></i>
                            @else
                                <i class="fas fa-sort-alpha-down" style="float: right"></i>
                            @endif
                        @else
                            <i class="fas fa-sort" style="float: right"></i>
                        @endif
                    </th>
                    @if (!$show_contrato)
                        <th style="vertical-align: top">
                            <p class="grey-text letra-ngt">Evaluar</p>
                        </th>
                        <th style="vertical-align: top">
                            <p class="grey-text letra-ngt">Consultar</p>
                        </th>
                        <th style="vertical-align: top">
                            <p class="grey-text letra-ngt">Editar</p>
                        </th>
                        <th style="vertical-align: top">
                            <p class="grey-text letra-ngt">Eliminar</p>
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($nivelesServicio as $tem)
                    <tr>
                        <td>{{ $tem->id }}</td>
                        <td>{{ $tem->nombre }}</td>
                        <td>{{ $tem->descripcion != null ? $tem->descripcion : 'Sin descripción' }}</td>
                        <td>
                            @if ($tem->periodo_evaluacion == 0)
                                Por Definir
                            @elseif($tem->periodo_evaluacion == 1)
                                Unica Vez
                            @elseif($tem->periodo_evaluacion == 2)
                                Diario
                            @elseif($tem->periodo_evaluacion == 3)
                                Semanal
                            @elseif($tem->periodo_evaluacion == 4)
                                Quincenal
                            @elseif($tem->periodo_evaluacion == 5)
                                Mensual
                            @elseif($tem->periodo_evaluacion == 6)
                                Bimestral
                            @elseif($tem->periodo_evaluacion == 7)
                                Trimestral
                            @elseif($tem->periodo_evaluacion == 8)
                                Semestral
                            @elseif($tem->periodo_evaluacion == 9)
                                Anual
                            @elseif($tem->periodo_evaluacion == 10)
                                Multianual
                            @endif
                        </td>
                        <td>{{ $tem->area }}</td>
                        @if (!$show_contrato)
                            <td>
                                <!-- Modal Trigger -->
                                <a class="waves-effect waves-light btn modal-trigger" target="_blank"
                                    href="{!! route('contract_manager.contratos-katbol.evaluacion', [$tem->id]) !!}"> <i class="large material-icons">insert_chart</i>
                                </a>
                            </td>
                            <td>
                                <button wire:click="show({{ $tem->id }})" class="btn purple">
                                    <i class="material-icons">remove_red_eye</i>
                                </button>
                            </td>
                            <td>
                                <a href="#form_niveles">
                                    <button wire:click="edit({{ $tem->id }})" class="btn blue">
                                        <i class="material-icons">create</i>
                                    </button>
                                </a>
                            </td>
                            <td>

                                <button wire:click="$emit('triggerDeleteNiveles',{{ $tem->id }})" class="btn red">
                                    <i class="material-icons">delete</i>
                                </button>

                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        @if ($search != null || $search != '')
            <br>
            <div
                style="background-color: #f8f8f8;padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            color: rgb(0, 0, 0);
            border-radius: 4px;
            font-size: 18px">
                <i class="fas fa-exclamation-circle"></i> No existe ningún registro coincidente
            </div>
        @else
            <br>
            <div
                style="background-color: #f8f8f8;padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            color: rgb(0, 0, 0);
            border-radius: 4px;
            font-size: 18px">
                <i class="fas fa-exclamation-circle"></i> Sin registros en la tabla
            </div>
        @endif
    @endif

</div>

{{ $nivelesServicio->links() }}
<script>
    $(document).ready(function() {
        $('.select_pagination_niveles').change(function(e) {
            e.preventDefault();
            @this.set('pagination', e.target.value);
        });
    });
    window.addEventListener('paginador-niveles', function(e) {
        $('.select_pagination_niveles').formSelect();
    });
    document.addEventListener('confirmDeleteNivelesEvent', function(e) {
        Swal.fire({
            title: '¿Esta seguro que desea eliminarla?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('destroy', e.detail.tem_id)
                //console.log(e);
            }
        })

    });


    window.addEventListener('contentChanged', event => {
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
                weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
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
