@extends('layouts.admin')
@section('content')

	{{ Breadcrumbs::render('timesheet-create') }}
	
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
		 | {{ $timesheet->empleado->name }} </font></h5>

	<div class="card card-body">
		<div class="row">
			<div class="datatable-fix col-12" style="margin:auto;">
				<div  class="col-12 mb-4"><strong>Fecha: </strong> {{ \Carbon\Carbon::parse($timesheet->fecha_dia)->format("d/m/Y") }}</div>
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
		                        	@if($hora->facturable)
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

			
			@if(asset('admin/timesheet/aprobaciones') == redirect()->getUrlGenerator()->previous())
				<div class="col-12 d-flex justify-content-between">
					<button class="btn btn_cancelar">
						Regresar
					</button>
					<div class="">
	                    <button title="Rechazar" class="btn btn-info" style="background-color:#F05353; border: none;" data-toggle="modal" data-target="#modal_rechazar_{{ $timesheet->id}}">
	                        <i class="fa-solid fa-calendar-xmark"></i>
	                        Rechazar
	                    </button>
	                    <button title="Aprobar" class="btn btn-info" style="background-color: #3CA06C; border: none;" data-toggle="modal" data-target="#modal_aprobar_{{ $timesheet->id}}">
	                        <i class="fas fa-calendar-check"></i> 
	                        Aprobar
	                    </button>
	                </div>
				</div> 

				{{-- aprobar --}}
                <div class="modal fade" id="modal_aprobar_{{ $timesheet->id}}" tabindex="-1" role="dialog"
		            aria-labelledby="exampleModalLabel" aria-hidden="true">
		            <div class="modal-dialog" role="document">
		                <div class="modal-content">
		                    <div class="modal-body">
		                        <div class="delete">
		                            <div class="text-center">
		                                <i class="fa-solid fa-calendar-check" style="color: #3CA06C; font-size:60pt;"></i>
		                                <h1 class="my-4" style="font-size:14pt;">Aprobar Registro</h1>
		                                <p class="parrafo">¿Esta seguro que desea aprobar este registro?</p>
		                            </div>
		                            
		                            <div class="mt-4">
		                                <form action="{{ route('admin.timesheet-aprobar', ['id' => $timesheet->id]) }}" method="POST" class="row">
		                                    @csrf
		                                    <div class="form-group col-12">
		                                        <label><i class="fa-solid fa-comment-dots iconos_crear"></i> Comentarios</label>
		                                        <textarea class="form-control" name="comentarios"></textarea>
                                    			<small>Escriba sus comentarios para el solicitante.</small>
		                                    </div>
		                                    <div class="col-12 text-right">
		                                         <button title="Rechazar" class="btn btn_cancelar" data-dismiss="modal">
		                                            Canecelar
		                                        </button>
		                                        <button title="Rechazar" class="btn btn-info" style="border:none; background-color:#3CA06C;">
		                                            <i class="fas fa-calendar-check iconos_crear"></i>
		                                            Aceptar Registro
		                                        </button>
		                                    </div>

		                                </form>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>


		        {{-- rechazar --}}
		        <div class="modal fade" id="modal_rechazar_{{ $timesheet->id}}" tabindex="-1" role="dialog"
		            aria-labelledby="exampleModalLabel" aria-hidden="true">
		            <div class="modal-dialog" role="document">
		                <div class="modal-content">
		                    <div class="modal-body">
		                        <div class="delete">
		                            <div class="text-center">
		                                <i class="fa-solid fa-calendar-xmark" style="color: #F05353; font-size:60pt;"></i>
		                                <h1 class="my-4" style="font-size:14pt;">Rechazar Registro</h1>
		                                <p class="parrafo">¿Esta seguro que desea rechazar este registro?</p>
		                            </div>
		                            
		                            <div class="mt-4">
		                                <form action="{{ route('admin.timesheet-rechazar', ['id' => $timesheet->id]) }}" method="POST" class="row">
		                                    @csrf
		                                    <div class="form-group col-12">
		                                        <label><i class="fa-solid fa-comment-dots iconos_crear"></i> Comentarios</label>
		                                        <textarea class="form-control" name="comentarios"></textarea>
                                    			<small>Escriba las razones por la que rechaza este registro.</small>
		                                    </div>
		                                    <div class="col-12 text-right">
		                                        <button title="Rechazar" class="btn btn_cancelar" data-dismiss="modal">
		                                            Canecelar
		                                        </button>
		                                        <button title="Rechazar" class="btn btn-info" style="border:none; background-color:#F05353;">
		                                            <i class="fas fa-calendar-xmark iconos_crear"></i>
		                                            Rechazar Registro
		                                        </button>
		                                    </div>

		                                </form>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>                  
			@endif
		</div>
	</div>
	
@endsection