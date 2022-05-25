@extends('layouts.admin')
@section('content')
	@php
        use App\Models\Organizacion;
    @endphp

	{{ Breadcrumbs::render('timesheet-create') }}
	
	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">
		{!! $timesheet->semana !!} |  <font style="font-weight:lighter;">{{ $timesheet->empleado->name }}</font>
	 </h5>

	<div class="card card-body">
		<div class="row">
			<div class="datatable-fix col-12" style="margin:auto;">
				<div class="col-12 d-flex justify-content-between mb-4">
					<div  class=""><strong>Fecha: </strong> {{ \Carbon\Carbon::parse($timesheet->fecha_dia)->format("d/m/Y") }}</div>
					<button class="btn btn-secundario" onclick="imprimirElemento('content_times_show_print');"><i class="fa-solid fa-print iconos_crear"></i> Imprimir</button>
				</div>
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
		                                <p class="parrafo">¿Está seguro que desea aprobar este registro?</p>
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
		                                            Cancelar
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
		                                <p class="parrafo">¿Está seguro que desea rechazar este registro?</p>
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
		                                            Cancelar
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

	{{-- print ___________________________________________________________________________________ --}}
	@php
        $organizacion = Organizacion::select('id', 'logotipo', 'empresa')->first();
        if (!is_null($organizacion)) {
            $logotipo = $organizacion->logotipo;
        } else {
            $logotipo = 'logotipo-tabantaj.png';
        }
    @endphp
	<style type="text/css">
		@page {
		  size: landscape;
		}	
	</style>
	
	<div id="content_times_show_print" class="solo-print">
		<table class="encabezado-print">
            <tr>
                <td style="width: 25%;">
                    <img src="{{ asset($logotipo) }}" class="img_logo" style="height: 70px;">
                </td>
                <td style="width: 50%;">
                    <h4><strong>{{ $organizacion->empresa }}</strong></h4>
                    <h5 style="font-weight: bolder;">Timesheet: <font style="font-weight:lighter;">{!! $timesheet->semana !!}</font></h5>
                    <div>{{ $timesheet->empleado->name }}</div>
                </td>
                <td style="width: 25%;"class="encabezado_print_td_no_paginas">
                    Fecha: {{ $hoy_format }} <br>
                </td>
            </tr>
        </table>
		<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">
			{!! $timesheet->semana !!} |  <font style="font-weight:lighter;">{{ $timesheet->empleado->name }}</font>
		 </h5>
		<table id="datatable_timesheet_create" class="table w-100">
            <thead>
                <tr>
                    <th style="min-width:200px;">Proyecto </th>
                    <th style="min-width:200px;">Tarea</th>
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
                           {{ $hora->proyecto->proyecto }}
                        </td>
                        <td>
                            {{ $hora->tarea->tarea }}
                        </td>
                        <td>
                        	@if($hora->facturable)
                            	<div class="btn btn-info" style="transform: scale(0.5);"><i class="fa-solid fa-check"></i></div>
                             @else
                             	<div class="btn btn-info" style="transform: scale(0.5); background-color: #ccc !important;"><i class="fa-solid fa-xmark"></i></div>
                            @endif
                        </td>
                        <td>
                            {{ $hora->horas_lunes }}
                        </td>
                        <td>
                            {{ $hora->horas_martes }}
                        </td>
                        <td>
                            {{ $hora->horas_miercoles }}
                        </td>
                        <td>
                            {{ $hora->horas_jueves }}
                        </td>
                        <td>
                            {{ $hora->horas_viernes }}
                        </td>   
                        <td>
                           	{{ $hora->horas_sabado }}
                        </td>   
                        <td>
                            {{ $hora->horas_domingo }}
                        </td> 
                        <td>
                            {{ $hora->descripcion }}
                        </td>                           
                    </tr>
                @endforeach

            </tbody>
        </table>
	</div>
	
@endsection