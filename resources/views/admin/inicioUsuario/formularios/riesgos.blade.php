@extends('layouts.admin')
@section('content')
<style type="text/css">
    sup {
        color: red;
    }

    ol.breadcrumb {
        margin-bottom: 0px;
    }

</style>>

    @if(asset('admin/inicioUsuario') == redirect()->getUrlGenerator()->previous())
        {{ Breadcrumbs::render('riesgos-create-perfil') }}
    @endif
    @if(asset('admin/portal-comunicacion/reportes') == redirect()->getUrlGenerator()->previous())
        {{ Breadcrumbs::render('riesgos-create-portal') }}
    @endif
    @if(asset('admin/desk') == redirect()->getUrlGenerator()->previous())
        {{ Breadcrumbs::render('riesgos-create') }}
    @endif

    <h5 class="col-12 titulo_general_funcion">Riesgo identificado</h5>
    <div class="container">
        <div class="card card_formulario">

            <div class="card-body">

                <div class="titulo-formulario">
                    <i class="bi bi-shield-exclamation mr-3"></i> Riesgo identificado
                </div>

                <hr style="">

                <div class="mt-4">
                    <strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clic en el botón "Enviar"
                </div>

                <form class="row" method="POST" action="{{ route('admin.reportes-riesgos-store') }}"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="mt-4 form-group col-12">
                        <label class="form-label">
                            <strong>Datos generales:</strong>
                        </label>
                    </div>
                    @if (auth()->user()->empleado)
                        <div class="mt-2 form-group col-4">
                            <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                            <div class="form-control">{{ Str::limit(auth()->user()->empleado->name, 30, '...') }}</div>
                        </div>

                        <div class="mt-2 form-group col-4">
                            <label class="form-label"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <div class="form-control">{{ auth()->user()->empleado->puesto }}</div>
                        </div>

                        <div class="mt-2 form-group col-4">
                            <label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i></i>Área</label>
                            <div class="form-control">{{ auth()->user()->empleado->area->area }}</div>
                        </div>

                        <div class="mt-2 form-group col-md-6">
                            <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo electrónico</label>
                            <div class="form-control">{{ auth()->user()->empleado->email }}</div>
                        </div>

                        <div class="mt-2 form-group col-md-6">
                            <label class="form-label"><i class="fas fa-phone iconos-crear"></i>Teléfono</label>
                            <div class="form-control">{{ auth()->user()->empleado->telefono }}</div>
                        </div>
                    @else
                        <p><strong>no hay un empleado vinculado a este usuario</strong></p>
                    @endif
                    <div class="mt-4 form-group col-12">
                        <label class="form-label">
                            <strong>Descripción del riesgo:</strong>
                        </label>
                    </div>



                    <div class="mt-2 form-group col-md-6">
                        <label class="form-label"><i class="fas fa-text-width iconos-crear"></i>Título corto del
                            riesgo<sup>*</sup></label>
                        <input class="form-control" name="titulo" required>
                    </div>

                    <div class="mt-2 form-group col-md-6">
                        <label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i> Fecha y hora de
                            identificación</label>
                        <input type="datetime-local" name="fecha" class="form-control">
                    </div>

                    <div class="mt-2 form-group col-md-4">
                        <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Sede</label>
                        <select class="form-control" name="sede">
                            <option disabled>seleccione sede</option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->sede }}">{{ $sede->sede }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-2 form-group col-md-8">
                        <label class="form-label"><i class="fas fa-map iconos-crear"></i> Ubicación exacta</label>
                        <input type="" name="ubicacion" class="form-control">
                    </div>

                    <div class="mt-2 form-group col-12">
                        <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Describa detalladamente el
                            riesgo identificado<sup>*</sup></label>
                        <textarea name="descripcion" class="form-control" required></textarea>
                    </div>

                    <div class="mt-2 form-group col-4 areas_multiselect">
                        <label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i>Áreas afectadas</label>
                        <select class="form-control" id="activos">
                            <option disabled selected>Seleccionar áreas</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->area }}">{{ $area->area }}
                                </option>
                            @endforeach
                        </select>
                        <textarea name="areas_afectados" class="form-control" id="texto_activos"></textarea>
                    </div>

                    <div class="mt-2 form-group col-4 procesos_multiselect">
                        <label class="form-label"><i class="fas fa-dice-d20 iconos-crear"></i>Procesos afectados</label>
                        <select class="form-control" id="activos">
                            <option disabled selected>Seleccionar procesos</option>
                            @foreach ($procesos as $proceso)
                                <option value="{{ $proceso->nombre }}">{{ $proceso->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <textarea name="procesos_afectados" class="form-control" id="texto_activos"></textarea>
                    </div>

                    <div class="mt-2 form-group col-4 activos_multiselect">
                        <label class="form-label"><i class="fa-fw fas fa-laptop iconos-crear"></i>Activos afectados</label>
                        <select class="form-control" id="activos">
                            <option disabled selected>Seleccionar afectados</option>
                            @foreach ($activos as $activo)
                                <option value="{{ $activo->nombreactivo }}">{{ $activo->nombreactivo }}
                                </option>
                            @endforeach
                        </select>
                        <textarea name="activos_afectados" class="form-control" id="texto_activos"></textarea>
                    </div>

                    <div class="mt-4 form-group col-12">
                        <label class="form-label"><i class="fas fa-file-import iconos-crear"></i>Evidencia</label>
                        <input type="file" name="evidencia[]" class="form-control" multiple="multiple">
                    </div>

                    <div class="mt-2 text-right form-group col-12">
                        <a href="{{ asset('admin/inicioUsuario') }}#reportes" class="btn btn_cancelar">Cancelar</a>
                        <input type="submit" class="btn btn-success" value="Enviar">
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection




@section('scripts')

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            let select_activos = document.querySelector('.areas_multiselect #activos');
            select_activos.addEventListener('change', function(e) {
                e.preventDefault();
                let texto_activos = document.querySelector('.areas_multiselect #texto_activos');

                texto_activos.value += `${this.value}, `;

            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            let select_activos = document.querySelector('.procesos_multiselect #activos');
            select_activos.addEventListener('change', function(e) {
                e.preventDefault();
                let texto_activos = document.querySelector('.procesos_multiselect #texto_activos');

                texto_activos.value += `${this.value}, `;

            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            let select_activos = document.querySelector('.activos_multiselect #activos');
            select_activos.addEventListener('change', function(e) {
                e.preventDefault();
                let texto_activos = document.querySelector('.activos_multiselect #texto_activos');

                texto_activos.value += `${this.value}, `;

            });
        });
    </script>

@endsection
