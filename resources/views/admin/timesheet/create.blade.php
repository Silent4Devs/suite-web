@extends('layouts.admin')
@section('content')
	
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}">

    <style type="text/css">
        .ingresar_horas{
            width: 70px;
            -webkit-appearance: textfield !important;
            margin: 0;
            -moz-appearance:textfield !important;
        }
        .table select{
            width: 100%;
            height: calc(1.6em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.6;
            color: #747474;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            justify-content: ;
        } 
        .flatpickr-disabled{
            color: #FFC5C5 !important;
        }   
    </style>

    {{ Breadcrumbs::render('timesheet-create') }}

	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Registrar Jornada Laboral</font> </h5>

	<div class="card card-body">
		<div class="row">
			
            @livewire('timesheet.timesheet-horas-filas', ['proyectos'=>$proyectos, 'tareas'=>$tareas, 'origen'=>'create', 'timesheet_id'=>null])

		</div>
	</div>
@endsection


@section('scripts')
    @parent

    <script type="text/javascript">
        $('.select2').select2({
            'theme' : 'bootstrap4',
        });
    </script>

    <script type="text/javascript">

        document.addEventListener('DOMContentLoaded', ()=>{
            let fechasRegistradas = @json($fechasRegistradas);

            let dia_semana = @json($organizacion->dia_timesheet);

            function toISODate(d) {
                const z = n => ('0' + n).slice(-2);
                return d.getFullYear() + '-' + z(d.getMonth()+1) + '-' + z(d.getDate()); 
            }


            $("#fecha_dia").flatpickr({
                "disable": [
                    function(date) {

                        if (dia_semana == 'Domingo') { 
                            return (date.getDay() === 1 || date.getDay() === 2 || date.getDay() === 3 || date.getDay() === 4 || date.getDay() === 5 || date.getDay() === 6);
                        }
                        if (dia_semana == 'Lunes') { 
                            return (date.getDay() === 0 || date.getDay() === 2 || date.getDay() === 3 || date.getDay() === 4 || date.getDay() === 5 || date.getDay() === 6);
                        }
                        if (dia_semana == 'Martes') { 
                            return (date.getDay() === 0 || date.getDay() === 1 || date.getDay() === 3 || date.getDay() === 4 || date.getDay() === 5 || date.getDay() === 6);
                        }
                        if (dia_semana == 'Miércoles') { 
                            return (date.getDay() === 0 || date.getDay() === 1 || date.getDay() === 2 || date.getDay() === 4 || date.getDay() === 5 || date.getDay() === 6);
                        }
                        if (dia_semana == 'Jueves') { 
                            return (date.getDay() === 0 || date.getDay() === 1 || date.getDay() === 2 || date.getDay() === 3 || date.getDay() === 5 || date.getDay() === 6);
                        }
                        if (dia_semana == 'Viernes') {
                            return (date.getDay() === 0 || date.getDay() === 1 || date.getDay() === 2 || date.getDay() === 3 || date.getDay() === 4 || date.getDay() === 6);
                        }
                        if (dia_semana == 'Sábado') { 
                            return (date.getDay() === 0 || date.getDay() === 1 || date.getDay() === 2 || date.getDay() === 3 || date.getDay() === 4 || date.getDay() === 5);
                        }
                    },
                    function(date){
                        const rdatedData = fechasRegistradas;
                        return rdatedData.includes (toISODate(date));
                    }
                ],
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                      shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                      longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
                    }, 
                    months: {
                      shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                      longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    },
                },
            });
        });

        // ---------------------------------------------------

        $('.btn_destroy_tr').click(function(){
            let tr_seleccionado = '#' + $('.btn_destroy_tr:hover').attr('data-tr');

            console.log(tr_seleccionado);

            $(tr_seleccionado).remove();
        }); 

        // --------------------------------------------------------

        $('.ingresar_horas').focus(function(){
            let input_hora = $('.ingresar_horas:focus').attr('id');

            let input = document.getElementById(input_hora);

            input.addEventListener('input', updateValue);
        });

        function updateValue(e) {

            const suma_horas =  Number($('#ingresar_hora_lunes_' + e.srcElement.getAttribute('data-i')).val())+
                                Number($('#ingresar_hora_martes_' + e.srcElement.getAttribute('data-i')).val())+
                                Number($('#ingresar_hora_miercoles_' + e.srcElement.getAttribute('data-i')).val())+
                                Number($('#ingresar_hora_jueves_' + e.srcElement.getAttribute('data-i')).val())+
                                Number($('#ingresar_hora_viernes_' + e.srcElement.getAttribute('data-i')).val())+
                                Number($('#ingresar_hora_sabado_' + e.srcElement.getAttribute('data-i')).val())+
                                Number($('#ingresar_hora_domingo_' + e.srcElement.getAttribute('data-i')).val());


            document.getElementById('suma_horas_fila_' + e.srcElement.getAttribute('data-i')).textContent = suma_horas + ' h';

            let horas_semana =   [$(' [data-dia="' + e.srcElement.getAttribute('data-dia') + '"] ')];
        }
    </script>
@endsection