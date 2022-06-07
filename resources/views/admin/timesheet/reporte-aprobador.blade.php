@extends('layouts.admin')
@section('content')
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}">
	
	{{ Breadcrumbs::render('timesheet-reporte-aprobador') }}
	
	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Reporte Aprobador</font></h5>

	<div class="card card-body">

		@livewire('timesheet.reporte-aprobador')

	</div>
	
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">

    </script>
@endsection