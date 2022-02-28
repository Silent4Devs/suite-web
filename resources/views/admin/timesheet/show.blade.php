@extends('layouts.admin')
@section('content')
	
	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;"> {{ $timesheet->fecha_dia }} | {{ $timesheet->empleado->name }} </font></h5>

	<div class="card card-body">
		<div class="row">
			<div class="datatable-fix" style="margin:auto;">
				<div  class="col-12 mb-4"><strong>Fecha: </strong> {{ $timesheet->fecha_dia }}</div>
		        <table id="datatable_timesheet_create" class="table table-responsive w-100">
		            <thead>
		                <tr>
		                    <th style="min-width:250px;">Proyecto </th>
		                    <th style="min-width:250px;">Tarea</th>
		                    <th>Facturable</th>
		                    <th style="min-width:55px;">Lunes</th>
		                    <th style="min-width:55px;">Martes</th>
		                    <th style="min-width:55px;">Miercoles</th>
		                    <th style="min-width:55px;">Jueves</th>
		                    <th style="min-width:55px;">Viernes</th>
		                    <th style="min-width:55px;">Sabado</th>
		                    <th style="min-width:55px;">Domingo</th>
		                    <th style="min-width:200px;">Descripción</th>
		                </tr>
		            </thead>
		            <tbody>
		                @foreach($horas as $hora)
		                    <tr>
		                        <td>
		                            <div class="form-control">{{ $hora->proyecto->proyecto }}</div>
		                        </td>
		                        <td>
		                            <div class="form-control">{{ $hora->tarea->tarea }}</div>
		                        </td>
		                        <td>
		                        	@if(!$hora->facturable)
		                            	<div class="btn btn-info" style="transform: scale(0.5);"><i class="fa-solid fa-check"></i></div>
		                             @else
		                             	<div class="btn btn-info" style="transform: scale(0.5); background-color: #ccc !important;"><i class="fa-solid fa-xmark"></i></div>
		                            @endif
		                        </td>
		                        <td>
		                            <div class="form-control">{{ $hora->horas_lunes }}</div>
		                        </td>
		                        <td>
		                            <div class="form-control">{{ $hora->horas_martes }}</div>
		                        </td>
		                        <td>
		                            <div class="form-control">{{ $hora->horas_miercoles }}</div>
		                        </td>
		                        <td>
		                            <div class="form-control">{{ $hora->horas_jueves }}</div>
		                        </td>
		                        <td>
		                            <div class="form-control">{{ $hora->horas_viernes }}</div>
		                        </td>   
		                        <td>
		                           	<div class="form-control">{{ $hora->horas_sabado }}</div>
		                        </td>   
		                        <td>
		                            <div class="form-control">{{ $hora->horas_domingo }}</div>
		                        </td> 
		                        <td>
		                            <div class="form-control">{{ $hora->descripcion }}</div>
		                        </td>                           
		                    </tr>
		                @endforeach

		            </tbody>
		        </table>
			</div>

		</div>
	</div>
	
@endsection