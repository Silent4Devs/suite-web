@extends('layouts.admin')
@section('content')
	
	<h5 class="col-12 titulo_general_funcion">TimeSheet: Vista {fecha y empleado}</h5>

	<div class="card card-body">
		<div class="row">
			
	        <table id="datatable_timesheet_create" class="table table-responsive w-100">
	            <thead class="w-100">
	                <tr>
	                    <th style="min-width:200px;">Proyecto </th>
	                    <th style="min-width:200px;">Tarea</th>
	                    <th>Factible</th>
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
	                {{-- {{ $contador }} --}}
	                @foreach()
	                    <tr>
	                        <td>
	                            <div class="form-group"></div>
	                        </td>
	                        <td>
	                            <div class="form-group"></div>
	                        </td>
	                        <td>
	                            <div class="form-group"></div>
	                        </td>
	                        <td>
	                            <div class="form-group"></div>
	                        </td>
	                        <td>
	                            <div class="form-group"></div>
	                        </td>
	                        <td>
	                            <div class="form-group"></div>
	                        </td>
	                        <td>
	                            <div class="form-group"></div>
	                        </td>
	                        <td>
	                            <div class="form-group"></div>
	                        </td>   
	                        <td>
	                           	<div class="form-group"></div>
	                        </td>   
	                        <td>
	                            <div class="form-group"></div>
	                        </td> 
	                        <td>
	                            <div class="form-group"></div>
	                        </td>                           
	                    </tr>
	                @endforeach

	            </tbody>
	        </table>

		</div>
	</div>
	
@endsection