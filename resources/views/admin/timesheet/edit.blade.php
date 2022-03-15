@extends('layouts.admin')
@section('content')

	{{ Breadcrumbs::render('timesheet-edit') }}
	
	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">
		@if($timesheet->dia_semana == 'Domingo')
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->format("d/m/Y") }}
             -  
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->addDay(6)->format("d/m/Y") }}
        @endif
        @if($timesheet->dia_semana == 'Lunes')
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->subDay(1)->format("d/m/Y") }}
             -  
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->addDay(5)->format("d/m/Y") }}
        @endif
        @if($timesheet->dia_semana == 'Martes')
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->subDay(2)->format("d/m/Y") }}
             -  
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->addDay(4)->format("d/m/Y") }}
        @endif
        @if($timesheet->dia_semana == 'Miércoles')
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->subDay(3)->format("d/m/Y") }}
             -  
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->addDay(3)->format("d/m/Y") }}
        @endif
        @if($timesheet->dia_semana == 'Jueves')
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->subDay(4)->format("d/m/Y") }}
             -  
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->addDay(2)->format("d/m/Y") }}
        @endif
        @if($timesheet->dia_semana == 'Viernes')
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->subDay(5)->format("d/m/Y") }}
             -  
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->addDay(1)->format("d/m/Y") }}
        @endif
        @if($timesheet->dia_semana == 'Sábado')
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->subDay(6)->format("d/m/Y") }}
             -  
            {{  \Carbon\Carbon::parse($timesheet->fecha_dia)->format("d/m/Y") }}
        @endif
	 	| {{ $timesheet->empleado->name }} </font>
	 </h5>

	<div class="card card-body">
		<div class="row">

			@livewire('timesheet-horas-edit', ['proyectos'=>$proyectos, 'tareas'=>$tareas, 'origen'=>'edit', 'timesheet_id'=>$timesheet->id])

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
@endsection