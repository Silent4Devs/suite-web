@php
    // if ($dias_disponibles == null) {
    //     $valor = 'no tienes dias disponibles';
    //     $mostrar = false;
    // } else {
    //     $valor = $dias_disponibles;
    //     $mostrar = true;
    // }

    if ($dias_pendientes >= 1) {
        $leyenda_dias_pendientes = true;
    } else {
        $leyenda_dias_pendientes = false;
    }

@endphp

{{-- Leyenda dias Pendientes --}}
<div class="row" x-data="{ open: @js($leyenda_dias_pendientes) }">
    <!-- Categoria Enabled-->
    <div class="col-12 col-sm-12" x-show="open">
        <div class="px-1 py-2 mb-4 rounded " style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">

                        <i class="fa-solid fa-file-circle-exclamation mr-3" style="color: #3B82F6; font-size: 30px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">¡IMPORTANTE!</p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A "> Actualmente tienes
                        <strong>{{ $dias_pendientes }} día(s)</strong> en estado de <strong>"Pendientes"</strong>, los
                        cuales están descontados y en caso de ser rechazados estos serán reembolsados.
                    </p>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>

{{-- Formulario Vacaciones --}}


<div class="row">
    <!-- Categoria Enabled-->
    <div class="col-12 col-sm-12" x-show="open">
        <!-- Categoria Field -->
        <div class="row">
            <div class="form-group col-sm-6 mt-2">
                <fieldset disabled>
                    <label for="disabledTextInput"><i class="fa-solid fa-calendar-check iconos-crear"></i>Días
                        disponibles:</label>
                    <input type="text" id="dias_disponibles" class="form-control" value="{{ $dias_disponibles }}"
                        style="text-align: center">
                </fieldset>
            </div>
            <div class="form-group col-sm-6 ">
                <fieldset disabled>
                    <label for="disabledTextInput"><i class="bi bi-calendar2-event-fill iconos-crear"></i>Válidos hasta
                        el:</label>
                    <input type="text" id="validos_hasta" class="form-control" value="31-12-{{ $año }}"
                        style="text-align: center">
                </fieldset>

            </div>
        </div>
        <!-- Categoria Field -->
        <div class="row">
            <div class="form-group col-sm-6">
                <i class="fa-solid fa-file-circle-check iconos-crear"></i>
                <label for="fecha_inicio" class="required">Fecha de inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio"
                    class="form-control"
                    placeholder="Ingrese la fecha en que inician sus vacaciones..."
                    value="{{ old('fecha_inicio') }}">
                @error('fecha_inicio')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Fecha de fin Field -->
            <div class="form-group col-sm-6">
                <i class="fa-solid fa-file-circle-xmark iconos-crear"></i>
                <label for="fecha_fin" class="required">Fecha de fin:</label>
                <input type="date" name="fecha_fin" id="fecha_fin"
                    class="form-control"
                    placeholder="Ingrese la fecha en que terminan sus vacaciones..."
                    value="{{ old('fecha_fin') }}">
                @error('fecha_fin')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- Días solicitados Field -->
        <div class="row">
            <div class="form-group col-sm-12">
                <i class="bi bi-calendar-week-fill iconos-crear"></i>
                <label for="dias_solicitados" class="required">Días solicitados:</label>
                <input type="number" name="dias_solicitados" id="dias_solicitados"
                    class="form-control"
                    placeholder="0"
                    readonly
                    style="text-align:center"
                    value="{{ old('dias_solicitados') }}">
                @error('dias_solicitados')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <x-loading-indicator />
        <!-- Descripcion Field -->
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="descripcion">
                    <i class="fas fa-file-alt iconos-crear"></i>Comentarios para el aprobador:
                </label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="2">{{ old('descripcion', $vacacion->descripcion) }}</textarea>
            </div>
        </div>

        <input type="hidden"
            value="{{ auth()->user()->empleado ? explode(' ', auth()->user()->empleado->id)[0] : '' }}"
            name="empleado_id">
        <input type="hidden" value="{{ $año }}" name="año">
        <input type="hidden" value="{{ $autoriza }}" name="autoriza">
        <!-- Submit Field -->
        <div class="text-right form-group col-12">
            <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
            <button class="btn btn-primary" id="enviar" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
    </div>



</div>




@section('scripts')
    <script>
        function getBusinessDatesCount(startDate, endDate) {
            let count = 0;
            const curDate = new Date(startDate.getTime());
            while (curDate <= endDate) {
                const dayOfWeek = curDate.getDay();
                if (dayOfWeek !== 5 && dayOfWeek !== 6) count++;
                curDate.setDate(curDate.getDate() + 1);
            }

            return count;
        }

        document.getElementById('fecha_inicio').addEventListener('change', (e) => {
            let fecha1 = document.getElementById('fecha_fin').value;
            let fecha2 = document.getElementById('fecha_inicio').value;
            let limite = Number(document.getElementById('dias_disponibles').value);
            let tipo_conteo = @json($tipo_conteo);
            let dias = NaN;
            if (tipo_conteo == 2) {
                let startDate = new Date(fecha2);
                let endDate = new Date(fecha1);
                dias = getBusinessDatesCount(startDate, endDate);
                dias = dias == 0 ? NaN : dias;

            } else {
                var aFecha1 = fecha1.split('-');
                var aFecha2 = fecha2.split('-');
                var fFecha1 = Date.UTC(aFecha1[0], aFecha1[1] - 1, aFecha1[2]);
                var fFecha2 = Date.UTC(aFecha2[0], aFecha2[1] - 1, aFecha2[2]);
                var dif = fFecha2 - fFecha1;
                dias = Math.floor((dif / (24 * 60 * 60 * 1000)) * (-1) + 1);


            }


            if (!isNaN(dias)) {
                if (dias > 0) {
                    if (dias < 2) {
                        if (dias <= limite) {
                            $("#dias_solicitados").attr("value", dias);
                        } else {
                            alert(
                                "Los dias solicitados no pueden ser mayores a los disponibles, ¡Intentalo de nuevo!"
                            );
                            $("#dias_solicitados").attr("value", 0);
                            document.getElementById("fecha_inicio").value = "";
                        }
                    } else {
                        alert(
                            "Los dias solicitados no pueden ser continuos, solo selecciona 1, ¡Intentalo de nuevo!"
                        );
                        $("#dias_solicitados").attr("value", 0);
                        document.getElementById("fecha_inicio").value = "";
                    }
                } else {
                    alert("La fecha de fin no puede ser menor a la de incio, ¡Intentalo de nuevo!");
                    $("#dias_solicitados").attr("value", 0);
                    document.getElementById("fecha_inicio").value = "";
                }
            }
        })

        document.getElementById('fecha_fin').addEventListener('change', (e) => {
            let fecha1 = document.getElementById('fecha_fin').value;
            let fecha2 = document.getElementById('fecha_inicio').value;
            let limite = Number(document.getElementById('dias_disponibles').value);
            let tipo_conteo = @json($tipo_conteo);
            let dias = NaN;
            if (tipo_conteo == 2) {
                let startDate = new Date(fecha2);
                let endDate = new Date(fecha1);
                dias = getBusinessDatesCount(startDate, endDate);


            } else {

                var aFecha1 = fecha1.split('-');
                var aFecha2 = fecha2.split('-');
                var fFecha1 = Date.UTC(aFecha1[0], aFecha1[1] - 1, aFecha1[2]);
                var fFecha2 = Date.UTC(aFecha2[0], aFecha2[1] - 1, aFecha2[2]);
                var dif = fFecha2 - fFecha1;
                dias = Math.floor((dif / (24 * 60 * 60 * 1000)) * (-1) + 1);
            }
            console.log(dias);
            if (!isNaN(dias)) {
                if (dias > 0) {
                    if (dias < 2) {
                        if (dias <= limite) {
                            $("#dias_solicitados").attr("value", dias);
                        } else {
                            alert(
                                "Los dias solicitados no pueden ser mayores a los disponibles, ¡Intentalo de nuevo!"
                            );
                            $("#dias_solicitados").attr("value", 0);
                            document.getElementById("fecha_fin").value = "";
                        }
                    } else {
                        alert(
                            "Recuerda que solo podrás solicitar un dia a la vez de los dias disponibles ¡Intentalo de nuevo!"
                        );
                        $("#dias_solicitados").attr("value", 0);
                        document.getElementById("fecha_fin").value = "";
                    }

                } else {
                    alert("La fecha de fin no puede ser menor a la de incio, ¡Intentalo de nuevo!");
                    $("#dias_solicitados").attr("value", 0);
                    document.getElementById("fecha_fin").value = "";
                }
            }
        })
        document.getElementById('enviar').addEventListener('click', (e) => {
            document.getElementById('loaderComponent').style.display = 'block';
        })
    </script>
@endsection
