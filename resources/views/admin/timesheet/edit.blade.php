@extends('layouts.admin')
@section('content')
	
	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;"> {{ $timesheet->fecha_dia }} | {{ $timesheet->empleado->name }} </font></h5>

	<div class="card card-body">
		<div class="row">

			@livewire('timesheet.timesheet-horas-filas', ['proyectos'=>$proyectos, 'tareas'=>$tareas, 'origen'=>'edit', 'timesheet_id'=>$timesheet->id])

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