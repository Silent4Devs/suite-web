@extends('layouts.admin')
@section('content')
    {{-- {{ Breadcrumbs::render('empleados-create') }} --}}

    <h5 class="col-12 titulo_general_funcion">Baja del Empleado: {{ $empleado->name }}</h5>
    <div class="mt-4 card">
        <div class="card-body">
            @livewire('baja-empleado-component', ['empleado' => $empleado])
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        renderizarFlatPickr();

        function renderizarFlatPickr() {
            $(".fecha_flatpickr").flatpickr({
                locale: {
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May',
                            'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov',
                            'Dic'
                        ],
                        longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril',
                            'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre',
                            'Diciembre'
                        ],
                    },
                },
            });
        }
    </script>
@endsection
