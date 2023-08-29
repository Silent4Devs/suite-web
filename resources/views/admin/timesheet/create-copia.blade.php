@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}">

    {{ Breadcrumbs::render('timesheet-create') }}

    <h5 class="col-12 titulo_general_funcion">
        TimeSheet: <font style="font-weight:lighter;"> Registrar Jornada Laboral</font>
    </h5>

    <div class="card card-body">
        <div class="row">
            <x-loading-indicator />
            @livewire('timesheet.timesheet-horas-create-copia', ['proyectos' => $proyectos, 'tareas' => $tareas, 'origen' => 'create-copia', 'timesheet_id' => $timesheet->id])

        </div>
    </div>
@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
        $('.select2').select2({
            'theme': 'bootstrap4',
        });
    </script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            let fechasRegistradas = @json($fechasRegistradas);

            let dia_semana = @json($organizacion->dia_timesheet);

            function toISODate(d) {
                const z = n => ('0' + n).slice(-2);
                return d.getFullYear() + '-' + z(d.getMonth() + 1) + '-' + z(d.getDate());
            }


            $("#fecha_dia").flatpickr({
                "minDate": "{{ auth()->user()->empleado->fecha_min_timesheet }}",
                "maxDate": "{{ now()->endOfWeek()->format('Y-m-d') }}",
                "disable": [
                    function(date) {

                        if (dia_semana == 'Domingo') {
                            return (date.getDay() === 1 || date.getDay() === 2 || date.getDay() === 3 ||
                                date.getDay() === 4 || date.getDay() === 5 || date.getDay() === 6);
                        }
                        if (dia_semana == 'Lunes') {
                            return (date.getDay() === 0 || date.getDay() === 2 || date.getDay() === 3 ||
                                date.getDay() === 4 || date.getDay() === 5 || date.getDay() === 6);
                        }
                        if (dia_semana == 'Martes') {
                            return (date.getDay() === 0 || date.getDay() === 1 || date.getDay() === 3 ||
                                date.getDay() === 4 || date.getDay() === 5 || date.getDay() === 6);
                        }
                        if (dia_semana == 'Miércoles') {
                            return (date.getDay() === 0 || date.getDay() === 1 || date.getDay() === 2 ||
                                date.getDay() === 4 || date.getDay() === 5 || date.getDay() === 6);
                        }
                        if (dia_semana == 'Jueves') {
                            return (date.getDay() === 0 || date.getDay() === 1 || date.getDay() === 2 ||
                                date.getDay() === 3 || date.getDay() === 5 || date.getDay() === 6);
                        }
                        if (dia_semana == 'Viernes') {
                            return (date.getDay() === 0 || date.getDay() === 1 || date.getDay() === 2 ||
                                date.getDay() === 3 || date.getDay() === 4 || date.getDay() === 6);
                        }
                        if (dia_semana == 'Sábado') {
                            return (date.getDay() === 0 || date.getDay() === 1 || date.getDay() === 2 ||
                                date.getDay() === 3 || date.getDay() === 4 || date.getDay() === 5);
                        }
                    },
                    function(date) {
                        const rdatedData = fechasRegistradas;
                        return rdatedData.includes(toISODate(date));
                    }
                ],
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                            'Sábado'],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct',
                            'Nov', 'Dic'
                        ],
                        longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
            });
        });

        // --------------------------------------------------------

        document.querySelector('.tabla-llenar-horas').addEventListener('change', (e) => {

            if (e.target.type == 'number') {
                if (Number(e.target.value) > 24) {
                    e.target.value = 24;
                }
                if (Number(e.target.value) <= 0) {
                    e.target.value = null;
                }
                updateValue(e.srcElement.getAttribute('data-i'));
            }

            if (e.target.type == 'checkbox') {
                calcularSumatoriasFacturables();
            }
        });

        let contador_filas = @json($horas_count);
        for (var i = 1; i <= contador_filas; i++) {
            updateValue(i);
        }

        function updateValue(index) {

            const suma_horas = Number($('#ingresar_hora_lunes_' + index).val()) +
                Number($('#ingresar_hora_martes_' + index).val()) +
                Number($('#ingresar_hora_miercoles_' + index).val()) +
                Number($('#ingresar_hora_jueves_' + index).val()) +
                Number($('#ingresar_hora_viernes_' + index).val()) +
                Number($('#ingresar_hora_sabado_' + index).val()) +
                Number($('#ingresar_hora_domingo_' + index).val());


            document.getElementById('suma_horas_fila_' + index).textContent = suma_horas + ' h';

            sumarFilas();

            calcularSumatoriasFacturables();
        }

        function calcularSumatoriasFacturables() {

            // lunes ----------------------------------
            let input_lunes = document.querySelectorAll('input[data-dia="lunes"]');
            let suma_horas_lunes = 0;
            let suma_horas_lunes_no_fact = 0;
            input_lunes.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input')?.checked;
                if (es_facturable) {
                    suma_horas_lunes += Number(item.value);
                } else {
                    suma_horas_lunes_no_fact += Number(item.value);
                }
            });
            document.getElementById('suma_dia_lunes').innerText = suma_horas_lunes + ' h';
            document.getElementById('suma_dia_lunes_no_fact').innerText = suma_horas_lunes_no_fact + ' h';

            // martes ----------------------------------
            let input_martes = document.querySelectorAll('input[data-dia="martes"]');
            let suma_horas_martes = 0;
            let suma_horas_martes_no_fact = 0;
            input_martes.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input')?.checked;
                if (es_facturable) {
                    suma_horas_martes += Number(item.value);
                } else {
                    suma_horas_martes_no_fact += Number(item.value);
                }
            });
            document.getElementById('suma_dia_martes').innerText = suma_horas_martes + ' h';
            document.getElementById('suma_dia_martes_no_fact').innerText = suma_horas_martes_no_fact + ' h';

            // miercoles ----------------------------------
            let input_miercoles = document.querySelectorAll('input[data-dia="miercoles"]');
            let suma_horas_miercoles = 0;
            let suma_horas_miercoles_no_fact = 0;
            input_miercoles.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input')?.checked;
                if (es_facturable) {
                    suma_horas_miercoles += Number(item.value);
                } else {
                    suma_horas_miercoles_no_fact += Number(item.value);
                }
            });
            document.getElementById('suma_dia_miercoles').innerText = suma_horas_miercoles + ' h';
            document.getElementById('suma_dia_miercoles_no_fact').innerText = suma_horas_miercoles_no_fact + ' h';

            // jueves ----------------------------------
            let input_jueves = document.querySelectorAll('input[data-dia="jueves"]');
            let suma_horas_jueves = 0;
            let suma_horas_jueves_no_fact = 0;
            input_jueves.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input')?.checked;
                if (es_facturable) {
                    suma_horas_jueves += Number(item.value);
                } else {
                    suma_horas_jueves_no_fact += Number(item.value);
                }
            });
            document.getElementById('suma_dia_jueves').innerText = suma_horas_jueves + ' h';
            document.getElementById('suma_dia_jueves_no_fact').innerText = suma_horas_jueves_no_fact + ' h';

            // viernes ----------------------------------
            let input_viernes = document.querySelectorAll('input[data-dia="viernes"]');
            let suma_horas_viernes = 0;
            let suma_horas_viernes_no_fact = 0;
            input_viernes.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input')?.checked;
                if (es_facturable) {
                    suma_horas_viernes += Number(item.value);
                } else {
                    suma_horas_viernes_no_fact += Number(item.value);
                }
            });
            document.getElementById('suma_dia_viernes').innerText = suma_horas_viernes + ' h';
            document.getElementById('suma_dia_viernes_no_fact').innerText = suma_horas_viernes_no_fact + ' h';

            // sabado ----------------------------------
            let input_sabado = document.querySelectorAll('input[data-dia="sabado"]');
            let suma_horas_sabado = 0;
            let suma_horas_sabado_no_fact = 0;
            input_sabado.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input')?.checked;
                if (es_facturable) {
                    suma_horas_sabado += Number(item.value);
                } else {
                    suma_horas_sabado_no_fact += Number(item.value);
                }
            });
            document.getElementById('suma_dia_sabado').innerText = suma_horas_sabado + ' h';
            document.getElementById('suma_dia_sabado_no_fact').innerText = suma_horas_sabado_no_fact + ' h';

            // domingo ----------------------------------
            let input_domingo = document.querySelectorAll('input[data-dia="domingo"]');
            let suma_horas_domingo = 0;
            let suma_horas_domingo_no_fact = 0;
            input_domingo.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input')?.checked;
                if (es_facturable) {
                    suma_horas_domingo += Number(item.value);
                } else {
                    suma_horas_domingo_no_fact += Number(item.value);
                }
            });

            let total_h_fact = suma_horas_lunes + suma_horas_martes + suma_horas_miercoles + suma_horas_jueves +
                suma_horas_viernes + suma_horas_sabado + suma_horas_domingo;

            let total_h_no_fact = suma_horas_lunes_no_fact + suma_horas_martes_no_fact + suma_horas_miercoles_no_fact +
                suma_horas_jueves_no_fact + suma_horas_viernes_no_fact + suma_horas_sabado_no_fact +
                suma_horas_domingo_no_fact;

            document.getElementById('suma_dia_domingo').innerText = suma_horas_domingo + ' h';
            document.getElementById('suma_dia_domingo_no_fact').innerText = suma_horas_domingo_no_fact + ' h';

            document.getElementById('total_h_facts').innerText = 'Total: ' + total_h_fact + ' h';
            document.getElementById('total_h_no_facts').innerText = 'Total: ' + total_h_no_fact + ' h';

        }
        Livewire.on('calcularSumatoriasFacturables', () => {
            calcularSumatoriasFacturables();
        });

        setTimeout(() => {
            sumarFilas();
        }, 1000);

        function sumarFilas() {
            let total_horas_filas = 0;
            let tota_filas_elemnt = document.querySelectorAll('.total_filas');
            tota_filas_elemnt.forEach(item => {
                total_horas_filas += Number(item.innerHTML.split(' ')[0]);
            });
            document.getElementById('total_horas_filas').innerText = total_horas_filas + ' h';
        }

        // $('.ingresar_horas').focus(function(){
        //     let input_hora = $('.ingresar_horas:focus').attr('id');

        //     let input = document.getElementById(input_hora);

        //     input.addEventListener('input', updateValue);
        // });

        // function updateValue(e) {
        // 	console.log(e.srcElement.id('id'));
        // }
    </script>
@endsection
