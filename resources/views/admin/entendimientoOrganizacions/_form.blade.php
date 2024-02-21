<style>
    label {
        color: black !important;
    }

    .card {
        border-radius: 16px;
        /* box-shadow: 0px 1px 4px #0000000F; */
    }

    .form-group .required::after {
        content: " *";
        color: unset;
    }
</style>

<div class="card shadow-sm">
    <div class="card-body row">
        <div class="col-12">
            <span style="font-size: 17px; color:#306BA9;">
                @if ($isEdit)
                    Editar el análisis FODA
                @else
                    Crea el análisis FODA
                @endif
            </span>
            <hr>
        </div>
        <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-12">
            <input required  maxlength="255" class="form-control" type="text" name="analisis" id="analisis"
                value="{{ old('analisis', $entendimientoOrganizacion->analisis) }}" placeholder="">
            @if ($errors->has('analisis'))
                <div class="invalid-feedback  d-block">
                    {{ $errors->first('analisis') }}
                </div>
            @endif
            <label for="analisis" class="required">Nombre del Análisis</label>
        </div>
        <div class="form-group anima-focus col-sm-12 col-md-6 col-lg-6">
            <input required class="form-control" type="date" id="fecha" name="fecha"
                value="{{ old('fecha', $entendimientoOrganizacion->fecha) }}" placeholder="">
            @if ($errors->has('fecha'))
                <div class="invalid-feedback  d-block">
                    {{ $errors->first('fecha') }}
                </div>
            @endif
            <label class="required" for="fecha">Fecha de Creación</label>
        </div>
        <div class="form-group anima-focus col-sm-12 col-md-6 col-lg-6">
            <select required class="form-control  {{ $errors->has(' id_elabora') ? 'is-invalid' : '' }}"
                name="id_elabora" id="id_elabora">
                <option value="">Seleccione una opción</option>
                @foreach ($empleados as $empleado)
                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                        data-area="{{ $empleado->area->area }}"
                        {{ old('id_elabora', $entendimientoOrganizacion->id_elabora) == $empleado->id ? 'selected' : '' }}>
                        {{ $empleado->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('id_elabora'))
                <div class="invalid-feedback">
                    {{ $errors->first('id_elabora') }}
                </div>
            @endif
            <label class="required" for="id_elabora">Realizó</label>
        </div>
        <div class="form-group anima-focus col-md-6">
            <div class="form-control puesto-container" id="puesto_asignada" readonly></div>
            <label for="id_puesto_asignada">Puesto</label>
        </div>

    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body row">
        <div class="col-12">
            <span style="font-size: 17px; color:#306BA9;">
                Participantes
            </span>
            <hr>
        </div>
        <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
            <input type="hidden" id="id_empleado">
            <input class="form-control" type="text" id="participantes_search" placeholder="Buscar participante *"
                style="position: relative" autocomplete="off" />
            <i id="cargando_participantes" class="fas fa-cog fa-spin text-muted"
                style="position: absolute; top: 43px; right: 25px;"></i>
            <div id="participantes_sugeridos"></div>
            @if ($errors->has('participantes'))
                <span class="text-danger">
                    {{ $errors->first('participantes') }}
                </span>
            @endif
            <span class="help-block">{{ trans('cruds.recurso.fields.participantes_helper') }}</span>

        </div>
        <div class="form-group anima-focus  col-sm-12 col-md-12 col-lg-6">
            <input class="form-control" type="text" id="email" placeholder="" readonly
                style="cursor: not-allowed;" />
            <label for="email">Email</label>
        </div>
        <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
            <input class="form-control" type="text" id="puesto" placeholder="" readonly
                style="cursor: not-allowed" />
            <label for="email">Puesto</label>
        </div>
        <div class="form-group anima-focus col-sm-12 col-md-12 col-lg-6">
            <input class="form-control" type="text" id="area" placeholder="" readonly
                style="cursor: not-allowed" />
            <label for="area">Área</label>
        </div>
        <div class="col-12">
            <button id="btn-suscribir-participante" type="submit" class="btn text-primary"
                style="float: right; position: relative;">
                Agregar Participante <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>
</div>
<div class="card shadow-sm">
    <div class="card-body row">
        <div class="col-12">
            <span style="font-size: 17px; color:#306BA9;">
                Participantes
            </span>
            <hr>
        </div>
        @include('partials.flashMessages')
        <div class="datatable-fix datatable-rds" style="width: 100%;">
            <table id="tbl-participantes">
                <thead>
                    <tr>
                        <th style="width: 35%;">ID</th>
                        <th  style="width: 35%;">Nombre</th>
                        <th  style="width: 35%;">Puesto</th>
                        {{-- <th scope="col">Área</th> --}}
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($isEdit)
                        @foreach ($entendimientoOrganizacion->participantes as $participante)
                            <tr>
                                <td>{{ $participante->id }}</td>
                                <td>{{ $participante->name }}</td>
                                <td>{{ $participante->puesto }}</td>
                                <td>{{ $participante->email }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <input type="hidden" name="participantes" value="" id="participantes">
    </div>
</div>

{{-- @if ($isEdit)
    @livewire('fortalezas-component', ['foda_id' => $entendimientoOrganizacion->id])

    @livewire('oportunidades-component', ['foda_id' => $entendimientoOrganizacion->id])

    @livewire('debilidades-component', ['foda_id' => $entendimientoOrganizacion->id])

    @livewire('amenazas-component', ['foda_id' => $entendimientoOrganizacion->id])
@endif --}}

<div class="row">
    <div class="text-right form-group col-12"><br>
        <a href="{{ route('admin.entendimiento-organizacions.index') }}" class="btn_cancelar">Cancelar</a>
        <button id="btnGuardar" class="btn btn-danger" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function () {
            // Captura el evento de cambio en el select
            $('#id_elabora').change(function () {
                // Obtiene el valor seleccionado y el atributo de datos asociados
                var selectedOption = $(this).find(':selected');
                var puesto = selectedOption.data('puesto');

                // Actualiza el contenido del segundo div con el puesto correspondiente
                $('.puesto-container').text(puesto);
            });

            // Disparar el evento change inicialmente para que refleje el valor predeterminado si es necesario
            $('#id_elabora').change();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function(e) {

            let asignado = document.querySelector('#id_elabora');
            let area_init = asignado.options[asignado.selectedIndex].getAttribute('data-area');
            let puesto_init = asignado.options[asignado.selectedIndex].getAttribute('data-puesto');

            document.getElementById('puesto_asignada').innerHTML = recortarTexto(puesto_init);
            document.getElementById('area_asignada').innerHTML = recortarTexto(area_init);
            asignado.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('puesto_asignada').innerHTML = recortarTexto(puesto);
                document.getElementById('area_asignada').innerHTML = recortarTexto(area);
            })

            function recortarTexto(texto, length = 40) {
                let trimmedString = texto?.length > length ?
                    texto.substring(0, length - 3) + "..." :
                    texto;
                return trimmedString;
            }

        });
    </script>

    <script>
        $(document).ready(function() {

            window.tblParticipantes = $('#tbl-participantes').DataTable({
                buttons: []
            })
            $("#cargando_participantes").hide();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let url = "{{ route('admin.empleados.get') }}";
            $("#participantes_search").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: 'nombre=' + $(this).val(),
                    beforeSend: function() {
                        $("#cargando_participantes").show();
                    },
                    success: function(data) {
                        let lista = "<ul class='list-group id=empleados-lista' >";
                        $.each(data.usuarios, function(ind, usuario) {
                            var result = `{"id":"${usuario.id}",
                            "name":"${usuario.name}",
                            "email":"${usuario.email}",
                            "puesto":"${usuario.puesto}",
                            "area":"${usuario.area.area}"
                            }`;
                            lista +=
                                "<button type='button' class='px-2 py-1 text-muted list-group-item list-group-item-action' onClick='seleccionarUsuario(" +
                                result + ")' ><i class='mr-2 fas fa-user-circle'></i>" +
                                usuario.name + "</button>";
                        });
                        lista += "</ul>";

                        $("#cargando_participantes").hide();
                        $("#participantes_sugeridos").show();
                        let sugeridos = document.querySelector("#participantes_sugeridos");
                        sugeridos.innerHTML = lista;
                        $("#participantes_search").css("background", "#FFF");
                    }
                });

            });

            document.getElementById('btn-suscribir-participante').addEventListener('click', function(e) {
                e.preventDefault();
                suscribirParticipante()
            })

            document.getElementById('btnGuardar').addEventListener('click', function(e) {
                // e.preventDefault();
                enviarParticipantes();
            })

        });

        function seleccionarUsuario(user) {
            $("#participantes_search").val(user.name);
            $("#id_empleado").val(user.id);
            $("#email").val(user.email);
            $("#puesto").val(user.puesto);
            $("#area").val(user.area);
            $("#participantes_sugeridos").hide();
        }


        function suscribirParticipante() {
            //form-participantes

            let participantes = tblParticipantes.rows().data().toArray();
            // console.log(tblParticipantes.rows().data().toArray());
            let arrParticipantes = [];
            participantes.forEach(participante => {
                arrParticipantes.push(participante[0])
            });

            let id_empleado = $("#id_empleado").val();
            if (id_empleado == '') {
                Swal.fire('Debes de buscar un empleado', '', 'info')
            } else {
                if (!arrParticipantes.includes(id_empleado)) {
                    let nombre = $("#participantes_search").val();
                    let puesto = $("#puesto").val();
                    let email = $("#email").val();
                    let area = $("#area").val();
                    tblParticipantes.row.add([
                        id_empleado,
                        nombre,
                        puesto,
                        email,
                        area,
                    ]).draw();

                } else {
                    Swal.fire('Este participante ya ha sido agregado', '', 'error')
                }

                $("#participantes_search").val('');
                $("#id_empleado").val('');
                $("#email").val('');
                $("#puesto").val('');
                $("#area").val('');
            }
        }

        function enviarParticipantes() {
            let participantes = tblParticipantes.rows().data().toArray();
            let arrParticipantes = [];
            participantes.forEach(participante => {
                arrParticipantes.push(participante[0])

            });
            console.log(arrParticipantes);
            document.getElementById('participantes').value = arrParticipantes;
        }
    </script>
@endsection
