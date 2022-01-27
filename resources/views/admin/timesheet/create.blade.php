@extends('layouts.admin')
@section('content')
	
    <style type="text/css">
        .ingresar_horas{
            width: 50px;
            margin: auto;
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
    </style>

	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Llenar Horas</font> </h5>

	<div class="card card-body">
		<div class="row">
			
            @livewire('timesheet.timesheet-horas-filas', ['proyectos'=>$proyectos, 'tareas'=>$tareas])

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