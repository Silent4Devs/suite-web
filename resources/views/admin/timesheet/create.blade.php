@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}">

    {{ Breadcrumbs::render('timesheet-create') }}

    <h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Registrar Jornada Laboral</font>
    </h5>

    @include('admin.timesheet.complementos.cards')

    <x-loading-indicator />
    @livewire('timesheet.timesheet-horas-filas', ['origen' => 'create', 'timesheet_id' => null])
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
                "maxDate": "{{ now()->addWeeks($organizacion->semanas_adicionales)->endOfWeek()->format('Y-m-d') }}",
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
                            'Sábado'
                        ],
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
                updateValue(e);
            }

            if (e.target.type == 'checkbox') {
                calcularSumatoriasFacturables();
            }
        });

        document.querySelector('.tabla-llenar-horas').addEventListener('click', (e) => {
            let element = e.target;
            if (e.target.tagName == 'I' || e.target.tagName == 'SMALL') {
                element = e.target.closest('div');
            }
            if (element.classList.contains('btn_destroy_tr')) {

                let tr_seleccionado = '#' + $('.btn_destroy_tr:hover').attr('data-tr');

                // limpiar datos de tr
                var inputs_clear = document.querySelectorAll(tr_seleccionado + ' input');
                for (var i = 0; i < inputs_clear.length; i++) {
                    inputs_clear[i].value = '';
                }
                document.querySelector(tr_seleccionado + ' .total_filas').textContent = '';
                $(tr_seleccionado + ' .select2').val(null).trigger('change');

                console.log('filas removs');
                Livewire.emit('removerFila');
            }
            if (element.classList.contains('btn_clear_tr')) {

                let tr_seleccionado = '#' + $('.btn_clear_tr:hover').attr('data-tr');

                document.querySelector(tr_seleccionado + ' textarea').value = null;
                document.querySelector(tr_seleccionado + ' #suma_horas_fila_1').innerText = '';
                let inputs_1 = document.querySelectorAll(tr_seleccionado + ' input');
                inputs_1.forEach(input => {
                    input.value = null;
                });
                calcularSumatoriasFacturables();
            }
        });

        function updateValue(e) {

            const suma_horas = Number($('#ingresar_hora_lunes_' + e.srcElement.getAttribute('data-i')).val()) +
                Number($('#ingresar_hora_martes_' + e.srcElement.getAttribute('data-i')).val()) +
                Number($('#ingresar_hora_miercoles_' + e.srcElement.getAttribute('data-i')).val()) +
                Number($('#ingresar_hora_jueves_' + e.srcElement.getAttribute('data-i')).val()) +
                Number($('#ingresar_hora_viernes_' + e.srcElement.getAttribute('data-i')).val()) +
                Number($('#ingresar_hora_sabado_' + e.srcElement.getAttribute('data-i')).val()) +
                Number($('#ingresar_hora_domingo_' + e.srcElement.getAttribute('data-i')).val());


            document.getElementById('suma_horas_fila_' + e.srcElement.getAttribute('data-i')).textContent = suma_horas +
                ' h';

            let horas_semana = [$(' [data-dia="' + e.srcElement.getAttribute('data-dia') + '"] ')];

            sumarFilas();
            calcularSumatoriasFacturables();
        }

        function calcularSumatoriasFacturables() {

            // lunes ----------------------------------
            let input_lunes = document.querySelectorAll('input[data-dia="lunes"]');
            let suma_horas_lunes = 0;
            let suma_horas_lunes_no_fact = 0;
            input_lunes.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input').checked;
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
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input').checked;
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
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input').checked;
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
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input').checked;
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
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input').checked;
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
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input').checked;
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
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) input').checked;
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

        function sumarFilas() {
            let total_horas_filas = 0;
            let tota_filas_elemnt = document.querySelectorAll('.total_filas');
            tota_filas_elemnt.forEach(item => {
                total_horas_filas += Number(item.innerHTML.split(' ')[0]);
            });
            document.getElementById('total_horas_filas').innerText = total_horas_filas + ' h';
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.tabla-llenar-horas tbody').click(function(e) {
                if (e.target.className == 'area-click-acordeon-time-mobile' && document.body.classList
                    .contains('body-responsive-mobile')) {
                    $('.tr-time-actividad-mobile:not(.tr-time-actividad-mobile:hover)').removeClass(
                        'ver-tr-time-mobile');
                    $('.tr-time-actividad-mobile:hover').toggleClass('ver-tr-time-mobile');
                }
            });
        });
    </script>

    <script>
        // Definimos una variable para almacenar el tiempo de inactividad
        let inactivityTimeout;
        const time = 1800000;



        function showInactiveMessage() {
            alert("Demasiado tiempo de inactividad al registrar horas");
            window.location.href = "{{ route('admin.timesheet-inicio') }}";
        }

        function resetInactivityTimeout() {
            clearTimeout(inactivityTimeout);

            inactivityTimeout = setTimeout(showInactiveMessage, time); // 60000 ms = 1 minuto
        }

        document.addEventListener("mousemove", resetInactivityTimeout);

        resetInactivityTimeout();
    </script>
@endsection
